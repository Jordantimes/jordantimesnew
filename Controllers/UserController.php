<?php

include_once "../Methods/UserMethods.php";
include_once "../Methods/Additional.php";
include_once "../Models/CompanyModel.php";
include_once "../Models/CustomerModel.php";
include_once "../Models/GovernmentModel.php";


$Date = date("Y-m-d");
$Name = strtolower($_POST["Name"]);
$Phone = $_POST["Phone"];
$Email = strtolower($_POST["email"]);
$Password = $_POST["password"];
$Repeat_Password = $_POST["repeat_password"];
$Role = $_POST["role"];
$Code=$_POST["Code"];
$Company_ID;
$Company_ID_State = true;
$CreatedAt = $Date;
$UpdatedAt = $Date;

//Sign up code
if(isset($_POST["SignUp_Submit"])){
    if(empty($Name) || empty($Phone) || empty($Email) || empty($Password) || empty($Repeat_Password) || empty($Role)){
        header("location: ../Views/User/SignUp.html?Error=True");
        exit;
    }

    if($Password !== $Repeat_Password){
        header("location: ../Views/User/SignUp.html?Error=True");
        exit;
    }

    if(CheckEmail($Email)){
        header("location: ../Views/User/SignUp.html?Error=True");
        exit;
    }
    
    $Password = password_hash($Password, PASSWORD_DEFAULT);

    if($Role === "customer"){
        $CustomerARR = [
            $Name,
            $Email,
            $Phone,
            $Password,
            $Role,
            $CreatedAt,
            $UpdatedAt,
            0
        ];

        $CustomerARR[count($CustomerARR)] = 0;

        if(InsertCustomer($CustomerARR)){
            SendVerificationMail($Email,$Name);
            header("location: ../Views/User/SignUp.html");
            exit;
        }

        else{
            header("location: ../Views/User/SignUp.html?Error=True");
            exit;
        }
    }

    elseif($Role === "company"){
        if(CheckName($Name,$Role)){
            header("location: ../Views/User/SignUp.html?Error=True");
            exit;
        }
        
        while($Company_ID_State){
            $Company_ID = CreateCompanyID();
            $Company_ID_State = CheckCompanyID($Company_ID);
        }

        $CompanyARR = [
            $Company_ID,
            $Name,
            $Email,
            $Phone,
            $Password,
            $Role,
            $CreatedAt,
            $UpdatedAt,
            0
        ];
        
        if(InsertCompany($CompanyARR)){
            header("location: ../Views/User/SignUp.html");
            exit;
        }

        else{
            header("location: ../Views/User/SignUp.html?Error=True");
            exit;
        }
    }
}


//Log in code
elseif(isset($_POST["login_Submit"])){
    if(empty($Email) || empty($Password)){
        header("location: ../Views/User/LogIn.html?Error=True");
        exit;
    }

    $user = GetUserByEmail($Email);

    if(empty($user["id"])){
        header("location: ../Views/User/LogIn.html?Error=True");
        exit;
    }

    if($user["verified"] == false){
        SendVerificationMail($Email,$user["name"]);
        header("location: ../Views/User/LogIn.html?Error=NotVerified");
        exit;
    }

    if(!password_verify($Password , $user["password"])){
        header("location: ../Views/User/LogIn.html?Error=True");
        exit;
    }

    session_start();

    if($user["role"] === "customer"){
        $CustomerModel = new CustomerModel();
        $CustomerModel->ID = $user["id"];
        $CustomerModel->Name = $user["name"];
        $CustomerModel->Email = $user["email"];
        $CustomerModel->PhoneNumber = $user["phone"];

        $_SESSION["customer"] = $CustomerModel;

        header("location: ../Views/User/Customer.php");
        exit;
    }

    elseif($user["role"] === "company"){
        $CompanyModel = new CompanyModel();
        $CompanyModel->ID = $user["id"];
        $CompanyModel->CompanyID = $user["company_ID"];
        $CompanyModel->Name = $user["name"];
        $CompanyModel->Email = $user["email"];
        $CompanyModel->PhoneNumber = $user["phone"];
        
        $_SESSION["company"] = $CompanyModel;
        
        header("location: ../Views/User/Company.php");
        exit;
    }
}

elseif(isset($_POST["PasswordRestoreSubmit"])){
    if(empty($Email)){
        header("location: ../Views/User/ForgetPassword.html?Error=True");
        exit;
    }

    $user = GetUserByEmail($Email);

    if(empty($user["id"])){
        header("location: ../Views/User/ForgetPassword.html?Error=True");
        exit;
    }

    SendPasswordRecoveryMail($Email,$user["id"],$user["name"]);
    header("location: ../Views/User/ForgetPassword.html");
    exit;
}

elseif(isset($_POST["UpdatePassword"])){
    $Model = GetRecoveryPasswordCodeData($Code);

    if($Model === false){
        header("location: ../Views/User/ForgetPassword.html?Error=True");
        exit;
    }

    $CurrentDate = date('Y-m-d h:i:s');

    if($Model->Date > $CurrentDate){
        if(empty($Password) || empty($Repeat_Password)){
            header("location: ../Views/User/RecoverPassword.php?Error=True&Code=".$Model->Code);
            exit;
        }

        if($Password !== $Repeat_Password){
            header("location: ../Views/User/RecoverPassword.php?Error=True&Code=".$Model->Code);
            exit;
        }

        if(UpdateUserPassword($Model->ID,$Password)){
            header("location: ../Views/User/PasswordUpdated.html");
            exit;
        }

        else{
            header("location: ../Views/User/RecoverPassword.php?Error=True&Code=".$Model->Code);
            exit;
        }
    }

    else{
        header("location: ../Views/User/ForgetPassword.html?Error=TimeExceeded");
        exit;
    }
}

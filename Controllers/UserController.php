<?php

include_once "../Methods/UserMethods.php";
include_once "../Models/SignUpModel.php";
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
            $UpdatedAt
        ];

        InsertCustomer($CustomerARR);
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
            $UpdatedAt
        ];

        $CompanyARR[count($CompanyARR)] = 0;
        
        InsertCompany($CompanyARR);
    }

    header("location: ../Views/User/SignUp.html");
}


//Log in code
elseif(isset($_POST["login_Submit"])){
    if(empty($Email) || empty($Password)){
        header("location: ../Views/User/LogIn.html?Error=True");
        exit;
    }

    $user = GetUserByEmail($Email);

    if(!password_verify($Password , $user["password"])){
        header("location: ../Views/User/LogIn.html?Error=True");
        exit;
    }

    session_start();

    if($user["role"] === "customer"){
        $CustomerModel = new CustomerModel();
        $CustomerModel->Name = $user["name"];
        $CustomerModel->Email = $user["email"];
        $CustomerModel->PhoneNumber = $user["phone"];

        $_SESSION["customer"] = $CustomerModel;

        header("location: ../Views/User/Customer.php");
        exit;
    }

    elseif($user["role"] === "company"){
        $CompanyModel = new CompanyModel();
        $CompanyModel->CompanyID = $user["company_ID"];
        $CompanyModel->Name = $user["name"];
        $CompanyModel->Email = $user["email"];
        $CompanyModel->PhoneNumber = $user["phone"];
        
        $_SESSION["company"] = $CompanyModel;
        
        header("location: ../Views/User/Company.php");
        exit;
    }
}
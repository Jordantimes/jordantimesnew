<?php

    class User extends Controller{

        public function __construct(){
            $this->UserRepo = $this->Repository("User");
            $this->CustomerSignUpModel = $this->Model("CustomerSignUp");
            $this->CompanySignUpModel = $this->Model("CompanySignUp");
        }
    
        public function SignUp(){
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);
                
                $Date = date("Y-m-d");

                if(strtolower($_POST["Role"]) === "customer"){
                    $Data = [
                        "Name" => trim(ucwords(strtolower($_POST["name"]))),
                        "Email" => trim(strtolower($_POST["email"])),
                        "Phone" => trim($_POST["phone"]),
                        "Password" => trim($_POST["password"]),
                        "Repeat_Password" => trim($_POST["repeat_password"])
                    ];

                    foreach ($Data as $Value){
                        if(empty($Value)){
                            $this->view("User/SignUp" , $Error = ["Message" => "Empty input"]);
                            exit;
                        }
                    }

                    if($Data["Password"] !== $Data["Repeat_Password"]){
                        $this->view("User/SignUp" , $Error = ["Message" => "Password mismatch"]);
                        exit;
                    }

                    if($this->UserRepo->CheckEmail($Data["Email"])){
                        $this->view("User/SignUp" , $Error = ["Message" => "Email used"]);
                        exit;
                    }

                    $Data["Password"] = password_hash($Data["Password"], PASSWORD_DEFAULT);


                    $this->CustomerSignUpModel->Name = $Data["Name"];
                    $this->CustomerSignUpModel->Email = $Data["Email"];
                    $this->CustomerSignUpModel->Phone_Number = $Data["Phone"];
                    $this->CustomerSignUpModel->Password = $Data["Password"];
                    $this->CustomerSignUpModel->Role = $_POST["Role"];
                    $this->CustomerSignUpModel->CreatedAt = $Date;
                    $this->CustomerSignUpModel->UpdatedAt = $Date;
                    $this->CustomerSignUpModel->Verified = 0;


                    if($this->UserRepo->InsertCustomer($this->CustomerSignUpModel)){
                        $this->UserRepo->SendVerificationMail($this->CustomerSignUpModel->Email,$this->CustomerSignUpModel->Name);
                        header("location:".URLROOT."/User/LogIn");
                        exit;
                    }

                    else{
                        $this->view("User/SignUp" , $Error = ["Message" => "Something went wrong"]);
                        exit;
                    }
                }

                elseif(strtolower($_POST["Role"]) === "company"){
                    $Company_ID_State = true;
                    $Company_ID;

                    $Data = [
                        "Company_Number" => trim($_POST["company_number"]),
                        "Name" => trim(ucwords(strtolower($_POST["name"]))),
                        "Email" => trim(strtolower($_POST["email"])),
                        "Phone" => trim($_POST["phone"]),
                        "Password" => trim($_POST["password"]),
                        "Repeat_Password" => trim($_POST["repeat_password"])
                    ];

                    foreach ($Data as $Value){
                        if(empty($Value)){
                            $this->view("User/SignUp" , $Error = ["Message" => "Empty input"]);
                            exit;
                        }
                    }

                    if($Data["Password"] !== $Data["Repeat_Password"]){
                        $this->view("User/SignUp" , $Error = ["Message" => "Password mismatch"]);
                        exit;
                    }

                    if($this->UserRepo->CheckEmail($Data["Email"])){
                        $this->view("User/SignUp" , $Error = ["Message" => "Email used"]);
                        exit;
                    }

                    if($this->UserRepo->CheckCompanyNumber($Data["Company_Number"])){
                        $this->view("User/SignUp" , $Error = ["Message" => "Company number used"]);
                        exit;
                    }

                    if($this->UserRepo->CheckName($Data["Name"] , $_POST["Role"])){
                        $this->view("User/SignUp" , $Error = ["Message" => "Name used"]);
                        exit;
                    }

                    while($Company_ID_State){
                        $Company_ID = CreateCompanyID();
                        $Company_ID_State = $this->UserRepo->CheckCompanyID($Company_ID);
                    }

                    $Data["Password"] = password_hash($Data["Password"], PASSWORD_DEFAULT);


                    $this->CompanySignUpModel->Company_ID = $Company_ID;
                    $this->CompanySignUpModel->Company_Number = $Data["Company_Number"];
                    $this->CompanySignUpModel->Name = $Data["Name"];
                    $this->CompanySignUpModel->Email = $Data["Email"];
                    $this->CompanySignUpModel->Phone_Number = $Data["Phone"];
                    $this->CompanySignUpModel->Password = $Data["Password"];
                    $this->CompanySignUpModel->Role = $_POST["Role"];
                    $this->CompanySignUpModel->CreatedAt = $Date;
                    $this->CompanySignUpModel->UpdatedAt = $Date;
                    $this->CompanySignUpModel->Verified = 0;


                    if($this->UserRepo->InsertCompany($this->CompanySignUpModel)){
                        header("location:".URLROOT."/User/LogIn");
                        exit;
                    }

                    else{
                        $this->view("User/SignUp" , $Error = ["Message" => "Something went wrong"]);
                        exit;
                    }
                }

            }

            else{
                $this->view("User/SignUp");
            }
        }

        public function LogIn(){
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $Data = [
                    "Email" => strtolower($_POST["email"]),
                    "Password" => $_POST["password"]
                ];

                foreach ($Data as $Value){
                    if(empty($Value)){
                        $this->view("User/LogIn" , $Error = ["Message" => "Empty input"]);
                        exit;
                    }
                }

                $user = $this->UserRepo->GetUserByEmail($Data["Email"]);

                if(empty($user["id"])){
                    $this->view("User/LogIn" , $Error = ["Message" => "Invalid email"]);
                    exit;
                }

                if(!password_verify($Data["Password"] , $user["password"])){
                    $this->view("User/LogIn" , $Error = ["Message" => "Wrong password"]);
                    exit;
                }

                if($user["verified"] == false){
                    if($user["role"] === "customer"){
                        $this->UserRepo->SendVerificationMail($Data["Email"],$user["name"]);
                    }
                    $this->view("User/LogIn" , $Error = ["Message" => "User not verified"]);
                    exit;
                }

                session_start();

                if($user["role"] === "customer"){
                    $Customer = [
                        "ID" => $user["id"],
                        "Name" => $user["name"],
                        "Email" => $user["email"],
                        "Phone_Number" => $user["phone"]
                    ];
            
                    $_SESSION["Customer"] = serialize($Customer);
                    
                    header("location:".URLROOT."/Customer");
                    exit;
                }

                elseif($user["role"] === "company"){
                    $Company = [
                        "ID" => $user["id"],
                        "Company_ID" => $user["company_ID"],
                        "Company_Number" => $user["company_Number"],
                        "Name" => $user["name"],
                        "Email" => $user["email"],
                        "Phone_Number" => $user["phone"]
                    ];
                    
                    $_SESSION["Company"] = serialize($Company);
                    
                    header("location:".URLROOT."/Company");
                    exit;
                }

                elseif($user["role"] === "government"){
                    $Gov = [
                        "ID" => $user["id"],
                        "Email" => $user["email"]
                    ];

                    $_SESSION["Government"] = serialize($Gov);
                    
                    header("location:".URLROOT."/Government");
                    exit;
                }
            }

            else{
                $this->view("User/LogIn");
            }
        }

        public function ForgotPassword(){
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                if(empty($_POST["email"])){
                    $this->view("User/ForgotPassword" , $Error = ["Message" => "Empty input"]);
                    exit;
                }

                $user = $this->UserRepo->GetUserByEmail($_POST["email"]);

                if(empty($user["id"])){
                    $this->view("User/ForgotPassword" , $Error = ["Message" => "Invalid email"]);
                    exit;
                }

                SendPasswordRecoveryMail($_POST["email"],$user["id"],$user["name"]);
                $this->view("User/ForgotPassword");
                exit;
            }

            else{
                $this->view("User/ForgotPassword");
            }
        }

        public function ChangePassword(){
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $Data = [
                    "Code" => $_POST["Code"],
                    "Password" => $_POST["password"],
                    "Repeat_Password" => $_POST["repeat_password"]
                ];

                foreach ($Data as $Value){
                    if(empty($Value)){
                        $this->view("User/ChangePassword" , $Error = ["Message" => "Empty input" , "Code" => $Data["Code"]]);
                        exit;
                    }
                }

                if($Data["Password"] !== $Data["Repeat_Password"]){
                    $this->view("User/ChangePassword" , $Error = ["Message" => "Password mismatch" , "Code" => $Data["Code"]]);
                    exit;
                }

                $CurrentDate = date('Y-m-d h:i:s');


                $CodeData = GetRecoveryPasswordCodeData($Data["Code"]);

                if($CodeData === false){
                    $this->view("User/ChangePassword" , $Error = ["Message" => "Something went wrong"]);
                    exit;
                }

                if($CodeData["Date"] > $CurrentDate){
                    if(UpdateUserPassword($CodeData["ID"],$Data["Password"])){
                        $this->view("User/ChangePassword");
                        exit;
                    }

                    else{
                        $this->view("User/ChangePassword" , $Error = ["Message" => "Something went wrong"]);
                        exit;
                    }
                }

                else{
                    $this->view("User/ChangePassword" , $Error = ["Message" => "Time exceeded"]);
                    exit;
                }
            }

            else{
                $this->view("User/ChangePassword");
            }
        }
    }
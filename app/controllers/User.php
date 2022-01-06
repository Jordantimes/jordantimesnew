<?php

    class User extends Controller{

        public function __construct(){
            session_start();
            $this->UserRepo = $this->Repository("User");
            $this->CustomerSignUpModel = $this->Model("CustomerSignUp");
            $this->CompanySignUpModel = $this->Model("CompanySignUp");
        }
    
        public function SignUp(){
            $data = [
                "SignupType" => "",
                "Error" => [
                    "type" => "",
                    "message" => ""
                ]
            ];

            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);
            
                $Date = date("Y-m-d");

                if(strtolower($_POST["Role"]) === "customer"){
                    $data["SignupType"] = "Customer";

                    $Data = [
                        "Name" => trim(ucwords(strtolower($_POST["name"]))),
                        "Email" => trim(strtolower($_POST["email"])),
                        "Phone" => "+962-".trim($_POST["phone"]),
                        "Password" => trim($_POST["password"]),
                        "Repeat_Password" => trim($_POST["repeat_password"])
                    ];

                    foreach ($Data as $key => $Value){
                        if(empty($Value)){
                            $data["Error"]["type"] = $key;
                            $data["Error"]["message"] = "Empty input";

                            $this->view("User/SignUp" , $data);
                            exit;
                        }
                    }

                    if(strlen($Data["Phone"]) !== 14){
                        $data["Error"]["type"] = "Phone";
                        $data["Error"]["message"] = "Invalid phone number";

                        $this->view("User/SignUp" , $data);
                        exit;
                    }

                    if($Data["Password"] !== $Data["Repeat_Password"]){
                        $data["Error"]["type"] = "Password";
                        $data["Error"]["message"] = "Password mismatch";

                        $this->view("User/SignUp" , $data);
                        exit;
                    }

                    if($this->UserRepo->CheckEmail($Data["Email"])){
                        $data["Error"]["type"] = "Email";
                        $data["Error"]["message"] = "Email is used";

                        $this->view("User/SignUp" , $data);
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
                        echo "Something went wrong";
                    }
                }

                elseif(strtolower($_POST["Role"]) === "company"){
                    $data["SignupType"] = "Company";
                    $Company_ID_State = true;
                    $Company_ID;

                    $Data = [
                        "Company_Number" => trim($_POST["company_number"]),
                        "Name" => trim(ucwords(strtolower($_POST["name"]))),
                        "Email" => trim(strtolower($_POST["email"])),
                        "Phone" => "+962-".trim($_POST["phone"]),
                        "Password" => trim($_POST["password"]),
                        "Repeat_Password" => trim($_POST["repeat_password"])
                    ];

                    foreach ($Data as $key => $Value){
                        if(empty($Value)){
                            $data["Error"]["type"] = "C-".$key;
                            $data["Error"]["message"] = "Empty input";

                            $this->view("User/SignUp" , $data);
                            exit;
                        }
                    }

                    if(strlen($Data["Phone"]) !== 14){
                        $data["Error"]["type"] = "C-Phone";
                        $data["Error"]["message"] = "Invalid phone number";

                        $this->view("User/SignUp" , $data);
                        exit;
                    }

                    if($Data["Password"] !== $Data["Repeat_Password"]){
                        $data["Error"]["type"] = "C-Password";
                        $data["Error"]["message"] = "Password mismatch";

                        $this->view("User/SignUp" , $data);
                        exit;
                    }

                    if($this->UserRepo->CheckEmail($Data["Email"])){
                        $data["Error"]["type"] = "C-Email";
                        $data["Error"]["message"] = "Email is used";

                        $this->view("User/SignUp" , $data);
                        exit;
                    }

                    if($this->UserRepo->CheckCompanyNumber($Data["Company_Number"])){
                        $data["Error"]["type"] = "C-Company_Number";
                        $data["Error"]["message"] = "Company number is used";

                        $this->view("User/SignUp" , $data);
                        exit;
                    }

                    if($this->UserRepo->CheckName($Data["Name"] , $_POST["Role"])){
                        $data["Error"]["type"] = "C-Name";
                        $data["Error"]["message"] = "Name is used";

                        $this->view("User/SignUp" , $data);
                        exit;
                    }

                    while($Company_ID_State){
                        $Company_ID = CreateCompanyID();
                        $Company_ID_State = $this->UserRepo->CheckCompanyID($Company_ID);
                    }

                    $Data["Password"] = password_hash($Data["Password"], PASSWORD_DEFAULT);


                    $this->CompanySignUpModel->Company_ID = $Company_ID;
                    $this->CompanySignUpModel->Company_Number = $Data["Company_Number"];
                    $this->CompanySignUpModel->Image = "bus.png";
                    $this->CompanySignUpModel->Name = $Data["Name"];
                    $this->CompanySignUpModel->Email = $Data["Email"];
                    $this->CompanySignUpModel->Phone_Number = $Data["Phone"];
                    $this->CompanySignUpModel->Password = $Data["Password"];
                    $this->CompanySignUpModel->Role = $_POST["Role"];
                    $this->CompanySignUpModel->CreatedAt = $Date;
                    $this->CompanySignUpModel->UpdatedAt = $Date;
                    $this->CompanySignUpModel->Verified = 0;


                    if($this->UserRepo->InsertCompany($this->CompanySignUpModel)){
                        $this->UserRepo->SendWaitingNoticeMail($this->CustomerSignUpModel->Email,$this->CustomerSignUpModel->Name);
                        header("location:".URLROOT."/User/LogIn");
                        exit;
                    }

                    else{
                        echo "Something went wrong";
                    }
                }

            }

            else{
                $this->view("User/SignUp" , $data);
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
                    $this->view("User/LogIn" , $Error = ["Message" => "User not verified, an Email was sent to ".$Data["Email"]]);
                    exit;
                }

                session_start();

                if($user["role"] === "customer"){
                    $Customer = [
                        "ID" => $user["id"],
                        "Name" => $user["name"],
                        "Email" => $user["email"],
                        "Phone_Number" => $user["phone"],
                        "Role" => $user["role"]
                    ];
            
                    $_SESSION["USER"] = serialize($Customer);
                    
                    header("location:".URLROOT);
                    exit;
                }

                elseif($user["role"] === "company"){
                    $Company = [
                        "ID" => $user["id"],
                        "Company_ID" => $user["company_ID"],
                        "Company_Number" => $user["company_Number"],
                        "Image" => $user["image"],
                        "Name" => $user["name"],
                        "Email" => $user["email"],
                        "Phone_Number" => $user["phone"],
                        "Bio" => $user["bio"],
                        "Role" => $user["role"]
                    ];
                    
                    $_SESSION["USER"] = serialize($Company);
                    
                    header("location:".URLROOT."/Company/Trips");
                    exit;
                }

                elseif($user["role"] === "government"){
                    $Gov = [
                        "ID" => $user["id"],
                        "Email" => $user["email"],
                        "Role" => $user["role"]
                    ];

                    $_SESSION["USER"] = serialize($Gov);
                    
                    header("location:".URLROOT."/Government/Trips");
                    exit;
                }

                elseif($user["role"] === "admin"){
                    $Gov = [
                        "ID" => $user["id"],
                        "Email" => $user["email"],
                        "Role" => $user["role"]
                    ];

                    $_SESSION["USER"] = serialize($Gov);
                    
                    header("location:".URLROOT."/Admin");
                    exit;
                }
            }

            else{
                if(!empty($_SESSION["USER"])){
                    $USER = unserialize($_SESSION["USER"]);
                    $Role = $USER["Role"];
                    
                    if($Role === "government"){
                        header("location:".URLROOT."/Government/Trips");
                        exit;
                    }
            
                    elseif($Role === "company"){
                        header("location:".URLROOT."/Company/Trips");
                        exit;
                    }
                    
                    elseif($Role === "customer"){
                        header("location:".URLROOT);
                        exit;
                    }

                    elseif($Role === "admin"){
                        header("location:".URLROOT."/Company/Admin");
                        exit;
                    }
                }
                
                $this->view("User/LogIn");
            }
        }

        public function LogOut(){
            session_start();
            session_destroy();
            header("location:".URLROOT."/Home");
        }

        public function PasswordUpdate(){
            $USER = [];
                
            if(isset($_SESSION["USER"])){
                $USER = unserialize($_SESSION["USER"]);
            }

            $data = [
            "USER" => $USER
            ];

            if($_SERVER["REQUEST_METHOD"] === "POST"){
                if(empty($_POST["email"])){
                    $this->view("User/PasswordUpdate" , $Error = ["Message" => "Empty input"]);
                    exit;
                }

                $user = $this->UserRepo->GetUserByEmail($_POST["email"]);

                if(empty($user["id"])){
                    $this->view("User/PasswordUpdate" , $Error = ["Message" => "Invalid email"]);
                    exit;
                }

                $this->UserRepo->SendPasswordRecoveryMail($_POST["email"],$user["id"],$user["name"]);
                $this->view("User/PasswordUpdate", $data);
                exit;
            }

            else{
                $this->view("User/PasswordUpdate" , $data);
            }
        }

        public function ChangePassword(){
            $USER = [];
                
            if(isset($_SESSION["USER"])){
                $USER = unserialize($_SESSION["USER"]);
            }

            $data = [
            "USER" => $USER,
            "Message" => "",
            "Code" => ""
            ];
            
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $Data = [
                    "Code" => $_POST["Code"],
                    "Password" => $_POST["password"],
                    "Repeat_Password" => $_POST["repeat_password"]
                ];

                foreach ($Data as $Value){
                    if(empty($Value)){
                        $data["Message"] = "Empty input";
                        $data["Code"] = $Data["Code"];
                        $this->view("User/ChangePassword" , $data);
                        exit;
                    }
                }

                if($Data["Password"] !== $Data["Repeat_Password"]){
                    $data["Message"] = "Password mismatch";
                    $data["Code"] = $Data["Code"];
                    $this->view("User/ChangePassword" , $data);
                    exit;
                }

                $CurrentDate = date('Y-m-d h:i:s');


                $CodeData = $this->UserRepo->GetRecoveryPasswordCodeData($Data["Code"]);

                if($CodeData === false){
                    $data["Message"] = "Something went wrong";
                    $this->view("User/ChangePassword" , $data);
                    exit;
                }

                if($CodeData["Date"] > $CurrentDate){
                    if($this->UserRepo->UpdateUserPassword($CodeData["ID"],$Data["Password"])){
                        header("location: ".URLROOT."/User/LogIn");
                        exit;
                    }

                    else{
                        $data["Message"] = "Something went wrong";
                        $this->view("User/ChangePassword" , $data = ["Message" => "Something went wrong"]);
                        exit;
                    }
                }

                else{
                    $data["Message"] = "Something went wrong";
                    $this->view("User/ChangePassword" , $data);
                    exit;
                }
            }

            else{                
                $this->view("User/ChangePassword" , $data);
            }
        }

        //HTTP Request
        public function GetNotifications(){
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/JSON');
            header('Access-Control-Allow-Methods: GET');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

            $USER = unserialize($_SESSION["USER"]);
            $Data = $this->UserRepo->GetNotifications($USER["ID"] , $USER["Role"]);
 
            echo json_encode($Data);
        }


        //HTTP Request
        public function NotificationMarkUnread(){
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/JSON');
            header('Access-Control-Allow-Methods: POST');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

            $data = json_decode(file_get_contents("php://input"));
            $USER = unserialize($_SESSION["USER"]);

            if($this->UserRepo->MarkAsUnread($USER["ID"], $data->Values)){
                $JSON = [
                    "message" => "Updated"
                ];
    
                echo json_encode($JSON);
            }

            else{
                $JSON = [
                    "message" => "something went wrong"
                ];
    
                echo json_encode($JSON);
            }
            
        }

        //HTTP Request
        public function NotificationMarkread(){
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/JSON');
            header('Access-Control-Allow-Methods: POST');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

            $data = json_decode(file_get_contents("php://input"));
            $USER = unserialize($_SESSION["USER"]);

            if($this->UserRepo->MarkAsread($USER["ID"] , $data->Values)){
                $JSON = [
                    "message" => "Updated"
                ];
    
                echo json_encode($JSON);
            }

            else{
                $JSON = [
                    "message" => "something went wrong"
                ];
    
                echo json_encode($JSON);
            }
            
        }

        //HTTP Request
        public function NotificationDelete(){
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/JSON');
            header('Access-Control-Allow-Methods: POST');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

            $data = json_decode(file_get_contents("php://input"));
            $USER = unserialize($_SESSION["USER"]);

            if($this->UserRepo->DeleteNotifications($USER["ID"] , $data->Values)){
                $JSON = [
                    "message" => "Deleted"
                ];
    
                echo json_encode($JSON);
            }

            else{
                $JSON = [
                    "message" => "something went wrong"
                ];
    
                echo json_encode($JSON);
            }
            
        }
    }

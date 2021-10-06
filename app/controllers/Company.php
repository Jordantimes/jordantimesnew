<?php

    class Company extends Controller{

        public function __construct(){
            $this->CompanyRepo = $this->Repository("Company");
        }

        public function index(){
            session_start();
            
            if(empty($_SESSION["USER"])){
                header("location:".URLROOT."/User/LogIn");
                exit;
            }

            $USER= unserialize($_SESSION["USER"]);

            $this->view("Company/index");
        }

        public function edit_profile(){
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                session_start();
                $USER = unserialize($_SESSION["USER"]);
                $ID = $USER["ID"];

                $Data = [
                    "ID" => $ID,
                    "Name" => trim(ucwords(strtolower($_POST["name"]))),
                    "Email" => trim(strtolower($_POST["email"])),
                    "Phone" => trim($_POST["phone"]),
                    "Bio" => trim($_POST["bio"]),
                    "Image" => ""
                ];

                //Get all the image file attributes
                $file= $_FILES["image"];
                $file_tmp = $file["tmp_name"];
                $file_size = $file["size"];
                $file_error = $file["error"];
                $file_type = $file["type"];
                $file_name = $file["name"];

                if($file_error === 0){

                    //get the extension of the uploaded file
                    $file_explode_name = explode("." , $file_name);
                    $file_extension = strtolower(end($file_explode_name));

                    //alowed extensions 
                    $allowed = array("jpg" , "jpeg" , "png");

                    //if its allowed
                    if(in_array($file_extension , $allowed)){
                        if($file_error === 0){
                            if($file_size < 1000000){
                                //give the image a uniq ID so no other image can have the same one
                                //in a better practice the image id/name sould be checked if its used just like the email or username but this will do enough
                                $file_name_new = uniqid('',true).".".$file_extension;

                                //create a file destination and uplaod it
                                $file_destination = "images/users/companys/".$file_name_new;
                                move_uploaded_file($file_tmp , $file_destination);

                                //save the new image name in the DATA array to send to the update function
                                $Data["Image"] = $file_name_new;
                            }

                            else{
                                $this->view("Company/index" , $Error = ["Message" => "size not allowed"]);
                                exit;
                            }
                        }
                        
                        else{
                            $this->view("Company/index" , $Error = ["Message" => "upload error"]);
                            exit;
                        }
                    }

                    else{
                        $this->view("Company/index" , $Error = ["Message" => "extension not allowed"]);
                        exit;
                    }
                }

                //update profile when data is ready
                if($this->CompanyRepo->update_profile($Data)){
                    //update the session variable with the new data
                    $Company = [
                        "ID" => $USER["ID"],
                        "Company_ID" => $USER["Company_ID"],
                        "Company_Number" => $USER["Company_Number"],
                        "Name" => $Data["Name"],
                        "Image" => $USER["Image"],
                        "Email" => $Data["Email"],
                        "Phone_Number" => $Data["Phone"],
                        "Bio" => $Data["Bio"],
                        "Role" => $USER["Role"]
                    ];

                    if($Data["Image"] !== ""){
                        $Company["Image"] = $Data["Image"];
                    }
                    
                    $_SESSION["USER"] = serialize($Company);

                    header("location:".URLROOT."/Company");
                    exit;
                }

                else{
                    $this->view("Company/index" , $Error = ["Message" => "something went wrong"]);
                    exit;
                }
            }

            else{
                header("location:".URLROOT."/Company");
                exit;
            }
        }
    }
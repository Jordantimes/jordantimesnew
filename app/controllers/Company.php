<?php

    class Company extends Controller{

        public function __construct(){
            $this->CompanyRepo = $this->Repository("Company");
        }

        public function index($ViewBox = "Trips"){
            session_start();
            $USER;

            if(!empty($_SESSION["USER"])){
                $USER= unserialize($_SESSION["USER"]);

                if(strtolower($USER["Role"]) !== "company"){
                    header("location:".URLROOT."/".ucwords($USER["Role"]));
                    exit;
                }
            }

            else{
                header("location:".URLROOT."/User/LogIn");
                exit;
            }

            $ViewBox = trim(ucwords(strtolower($ViewBox)));

            $data = [
                "ViewBox" => $ViewBox,
                "USER" => $USER
            ];

            $this->view("Company/index" , $data);
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
                    $ResponseOBJ = $this->CompanyRepo->ImageUpload($file_tmp,$file_size,$file_error,$file_type,$file_name,"companys");

                    //save the new image name in the DATA array to send to the update function
                    if($ResponseOBJ["Name"]){
                        $Data["Image"] = $ResponseOBJ["Name"];
                    }

                    elseif($ResponseOBJ["Error"]){
                        $this->view("Company/index" , $data = ["Message" => "size not allowed" , "ViewBox" => "profile", "USER" => $USER]);
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

                    header("location:".URLROOT."/Company/Profile");
                    exit;
                }

                else{
                    $this->view("Company/index" , $data = ["Message" => "something went wrong", "ViewBox" => "profile", "USER" => $USER]);
                    exit;
                }
            }

            else{
                header("location:".URLROOT."/Company");
                exit;
            }
        }

        public function CreateTrip(){
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                session_start();
                $USER = unserialize($_SESSION["USER"]);
                $ID = $USER["ID"];

                $locations = [
                    "Amman",
                    "Zarqa",
                    "Irbid",
                    "Ajloun",
                    "Jarash",
                    "Al Balqa",
                    "Al Mafraq",
                    "Madaba",
                    "Al Tafele",
                    "Al Karak",
                    "Ma'an",
                    "Aqaba",
                ];

                $locationsAr = [
                    "عمان",
                    "الزرقاء",
                    "إربد",
                    "عجلون",
                    "جرش",
                    "البلقاء",
                    "المفرق",
                    "مادبا",
                    "الطفيلة",
                    "الكرك",
                    "معان",
                    "العقبة",
                ];

                $Data = [
                    "ID" => $ID,
                    "name" => "",
                    "nameAr" => "",
                    "start_location" => "",
                    "end_location" => "",
                    "start_date" => $_POST["start_date"],
                    "end_date" => $_POST["end_date"],
                    "days" => "",
                    "nights" => $_POST["nights"],
                    "image" => "",
                    "description" => $_POST["description"],
                    "descriptionAr" => $_POST["description_ar"],
                    "price" => $_POST["price"],
                    "breakfast" => isset($_POST["breakfast"]) ? 1 : 0,
                    "breakfast_price" => isset($_POST["breakfast"]) ? $_POST["breakfast_price"] : "",
                    "lunch" => isset($_POST["lunch"]) ? 1 : 0,
                    "lunch_price" => isset($_POST["lunch"]) ? $_POST["lunch_price"] : "",
                    "dinner" => isset($_POST["dinner"]) ? 1 : 0,
                    "dinner_price" => isset($_POST["dinner"]) ? $_POST["dinner_price"] : "",
                ];

                $destinations = $_POST["destination"];
                if(!isset($destinations) || empty($Data["start_date"]) || empty($Data["end_date"]) || empty($Data["price"])){
                    header("location:".URLROOT."/Company");
                    exit;
                }

                $date1 = new DateTime($Data["start_date"]);
                $date2 = new DateTime($Data["end_date"]);
                $interval = $date1->diff($date2);
                $Data["days"] = ($interval->days)+1;

                $Data["start_location"] = $destinations[0];
                $Data["end_location"] = $destinations[count($destinations) - 1];

                for ($i=0; $i < count($destinations); ++$i){ 
                    $i === count($destinations) - 1 ? $Data["name"].= $locations[$destinations[$i] - 1] : $Data["name"].= $locations[$destinations[$i] - 1]." - ";
                    $i === count($destinations) - 1 ? $Data["nameAr"].= $locationsAr[$destinations[$i] - 1] : $Data["nameAr"].= $locationsAr[$destinations[$i] - 1]." - ";
                }
                
                $file= $_FILES["image"];
                if($file["name"][0]){
                    $file_count = count($file["name"]);

                    for ($i=0; $i < $file_count; ++$i) { 
                        $file_tmp = $file["tmp_name"][$i];
                        $file_size = $file["size"][$i];
                        $file_error = $file["error"][$i];
                        $file_type = $file["type"][$i];
                        $file_name = $file["name"][$i];
                        
                        $ResponseOBJ = $this->CompanyRepo->ImageUpload($file_tmp,$file_size,$file_error,$file_type,$file_name,"trips");

                        //save the new image name in the DATA array to send to the update function
                        if($ResponseOBJ["Name"]){
                            $i === $file_count - 1 ? $Data["image"].= $ResponseOBJ["Name"] : $Data["image"].= $ResponseOBJ["Name"].",";
                        }
    
                        elseif($ResponseOBJ["Error"]){
                            $this->view("Company/index" , $data = ["Message" => "size not allowed" , "ViewBox" => "profile", "USER" => $USER]);
                            exit;
                        }
                    }
                }


                $this->CompanyRepo->CreateTrip($Data);

                header("location:".URLROOT."/Company");
                exit;
            }

            else{
                header("location:".URLROOT."/Company");
                exit;
            }
        }
    }

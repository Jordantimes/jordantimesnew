<?php

    class Customer extends Controller{

        public function __construct(){
            $this->CustomerRepo = $this->Repository("Customer");
            $this->SitesRepo = $this->Repository("Sites");
            $this->UserRepo = $this->Repository("User");
        }

        public function index($ViewBox = "Trips"){
            session_start();
            $USER;

            if(!empty($_SESSION["USER"])){
                $USER= unserialize($_SESSION["USER"]);
            }  else{
                header("location:".URLROOT."/User/LogIn");
                exit;
            }

            $ViewBox = trim(ucwords(strtolower($ViewBox)));

            $data = [
                "ViewBox" => $ViewBox,
                "USER" => $USER
            ];

            // $data["Sites"] = $this->SitesRepo->GetSiteByTripUserID((int)$data['USER']["ID"]);

            $this->view("Customer/index" , $data);
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
                ];

                

                //update profile when data is ready
                if($this->CustomerRepo->update_profile($Data)){
                    //update the session variable with the new data
                    $Company = [
                        "ID" => $USER["ID"],
                        "Name" => $Data["Name"],
                        "Email" => $Data["Email"],
                        "Phone_Number" => $Data["Phone"],
                        "Role" => $USER["Role"]
                    ];

                  
                    
                    $_SESSION["USER"] = serialize($Company);

                    header("location:".URLROOT."/Customer/Profile");
                    exit;
                }

                else{
                    $this->view("Customer/index" , $data = ["Message" => "something went wrong", "ViewBox" => "profile", "USER" => $USER]);
                    exit;
                }
            }

            else{
                header("location:".URLROOT."/Customer");
                exit;
            }
        }

        public function book(){
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                session_start();
                $USER = unserialize($_SESSION["USER"]);
                $Date = date("Y-m-d");

                $names = [];
                $phones = [];
                $ages = [];
                $ids= [];

                for($i = 0 ; $i < $_POST["passengers"] ; ++$i){
                    if(!empty($_POST["name".($i+1)]) && !empty($_POST["age".($i+1)]) && !empty($_POST["phone".($i+1)])){
                        array_push($names , trim($_POST["name".($i+1)]));
                        array_push($ages , trim($_POST["age".($i+1)]));
                        array_push($phones , trim($_POST["phone".($i+1)]));
                        array_push($ids , trim($_POST["id".($i+1)]));
                    }

                    else{
                        header("location:".URLROOT."/Customer/Book?trip=".$_POST["trip"]."&passengers=".$_POST["passengers"]);
                        exit;
                    }
                }

                for($i = 0 ; $i < $_POST["passengers"] ; ++$i){
                    $Data = [
                        $_POST["trip"],
                        $USER["ID"],
                        $names[$i],
                        $phones[$i],
                        $ages[$i],
                        $ids[$i],
                        $Date,
                        $Date,
                        0
                    ];

                    if(!$this->CustomerRepo->book_customer($Data)){
                        header("location:".URLROOT."/Customer/Book?trip=".$_POST["trip"]."&passengers=".$_POST["passengers"]);
                        exit;
                    }
                }

                $NotificationData = [
                    $_POST["company"],
                    "New customer has booked",
                    $names[0]." has booked in the ".$_POST["trip_name"]." trip with ".$_POST["passengers"]." passengers",
                    "company",
                    0,
                    $Date,
                    $Date
                ];

                $this->UserRepo->InsertNotification($NotificationData);

                header("location:".URLROOT);
                exit;
            }

            else{
                $passengers = empty($_GET["passengers"]) ? 1 : (int)$_GET["passengers"];
                $trip = empty($_GET["trip"]) ? "" : $_GET["trip"];
                
                if(!empty($trip)){ 
                    session_start();
                    $USER = unserialize($_SESSION["USER"]);
    
                    if(!isset($USER["ID"])){
                        $_SESSION["passengers"] = $passengers;
                        $_SESSION["trip"] = $trip;
    
                        header("location:".URLROOT."/User/LogIn");
                        exit;
                    }else{
                        $ID = $USER["ID"];
                    }
    
                    if($USER["Role"] !== "customer"){
                        header("location:".URLROOT."/Sites");
                        exit;
                    }
    
                    if($passengers > 6 || $passengers < 1){
                        $passengers = 1;
                    }
    
                    $Data = $this->SitesRepo->GetSiteByTripID($trip);
                    //print_r($Data);
    
                    $data = [
                        "USER" => $USER,
                        "passengers" => $passengers,
                        "trip" => $Data,
                        "trip_ID" => $trip
                    ];
    
                    $this->view("Customer/book" , $data);
                    exit;
                }
    
                else{
                    header("location:".URLROOT."/Sites");
                    exit;
                }
            }
        }

        public function Verify(){
            if(!empty($_GET["Code"])){
               if($this->CustomerRepo->VerifyCustomer($_GET["Code"])){
                $this->view("Customer/Verify");
                exit;
               }

               else{
                $this->view("Customer/Verify", $Error = ["Message" => "An error occurred"]);
                exit;
               }
            }

            else{
                $this->view("Customer/Verify", $Error = ["Message" => "An error occurred"]);
                exit;
            }
        }
    }

<?php

    class Admin extends Controller{

        public function __construct(){
            $this->SitesRepo = $this->Repository("Sites");
            $this->AdminRepo = $this->Repository("Admin");
            $this->UserRepo = $this->Repository("User");
        }

        public function index($ViewBox = "Trips"){
            session_start();
            $USER;

            if(!empty($_SESSION["USER"])){
                $USER= unserialize($_SESSION["USER"]);

                if(strtolower($USER["Role"]) !== "admin"){
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
                "USER" => $USER,
            ];

            $this->view("Admin/index" , $data);
        }

        public function GetUnverified(){
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/JSON');
            header('Access-Control-Allow-Methods: GET');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

            $data = $this->SitesRepo->GetUnverified();
            echo json_encode($data);
        }

        public function AcceptTrip(){
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/JSON');
            header('Access-Control-Allow-Methods: POST');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

            $Date = date("Y-m-d");
            $data = json_decode(file_get_contents("php://input"));

            if($this->AdminRepo->AcceptTrip($data->ID)){
                 $Site = $this->SitesRepo->GetSiteByTripID_unverified($data->ID); 

                $NotificationData = [
                    (int)$Site["company_id"],
                    "Trip accepted",
                    "The trip ".$Site["trip_name"]." was accepted by an admin.",
                    "company",
                    0,
                    $Date,
                    $Date
                ];
                
                $this->UserRepo->InsertNotification($NotificationData);

                echo json_encode(["message" => "Accepted"]);
            }

            else{
                echo json_encode(["message" => "Error"]);
            }
        }

        public function DeclineTrip(){
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/JSON');
            header('Access-Control-Allow-Methods: POST');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

            $Date = date("Y-m-d");
            $data = json_decode(file_get_contents("php://input"));

            if($this->AdminRepo->DeclineTrip($data->ID)){
                 $Site = $this->SitesRepo->GetSiteByTripID_unverified($data->ID); 

                $NotificationData = [
                    (int)$Site["company_id"],
                    "Trip declined",
                    "The trip ".$Site["trip_name"]." was declined by an admin.",
                    "company",
                    0,
                    $Date,
                    $Date
                ];

                $this->UserRepo->InsertNotification($NotificationData);

                echo json_encode(["message" => "Declined"]);
            }

            else{
                echo json_encode(["message" => "Error"]);
            }
        }
    }
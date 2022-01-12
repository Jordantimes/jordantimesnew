<?php

    class Government extends Controller{

        public function __construct(){
            $this->GovernmentRepo = $this->Repository("Government");
            $this->UserRepo = $this->Repository("User");
            $this->SitesRepo = $this->Repository("Sites");
            $this->CompanyRepo = $this->Repository("Company");
        }

        public function index($ViewBox = "Trips"){
            session_start();
            $USER;

            if(!empty($_SESSION["USER"])){
                $USER= unserialize($_SESSION["USER"]);

                if(strtolower($USER["Role"]) !== "government"){
                    header("location:".URLROOT."/".ucwords($USER["Role"]));
                    exit;
                }
            }

            else{
                header("location:".URLROOT."/User/LogIn");
                exit;
            }

            $sites = $this->SitesRepo->GetAllSites();
            $passengers = [];

            for($i = 0 ; $i < count($sites) ; ++$i){
                array_push($passengers,$this->SitesRepo->GetPassengersByTripID($sites[$i]["id"]));
            }

            $companys = $this->CompanyRepo->GetAllCompanys();

            $ViewBox = trim(ucwords(strtolower($ViewBox)));

            $data = [
                "ViewBox" => $ViewBox,
                "USER" => $USER,
                "Sites" => $sites,
                "Passengers" => $passengers,
                "Companys" => $companys
            ];
            
            $this->view("Government/index" , $data);
        }

        //JSON HTTP Request
        public function GetRequests(){
            header('Access-Control-Allow-Origin:'.URLROOT);
            header('Content-Type: application/JSON');
            header('Access-Control-Allow-Methods: GET');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

            $Data = $this->GovernmentRepo->GetRequests();

            echo json_encode($Data);
        }

        //JSON HTTP Request
        public function Accept(){
            header('Access-Control-Allow-Origin:'.URLROOT);
            header('Content-Type: application/JSON');
            header('Access-Control-Allow-Methods: POST');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

            $data = json_decode(file_get_contents("php://input"));

            $user = $this->UserRepo->GetUserByEmail($data->Email);
            $Notification = [
                $user["id"],
                "Account Notice",
                "Your account as a company has been accepted, you can now create and post your trips.",
                "company",
                0,
                date("Y-m-d"),
                date("Y-m-d")
            ];
            $this->UserRepo->InsertNotification($Notification);

            if($this->GovernmentRepo->AcceptCompany($data->Email)){
                $JSON = [
                    "message" => "Accepted"
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

        //JSON HTTP Request
        public function Decline(){
            header('Access-Control-Allow-Origin:'.URLROOT);
            header('Content-Type: application/JSON');
            header('Access-Control-Allow-Methods: POST');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

            $data = json_decode(file_get_contents("php://input"));

            if($this->GovernmentRepo->DeclineCompany($data->Email)){
                $JSON = [
                    "message" => "Declined"
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
        public function SearchRequests(){
            header('Access-Control-Allow-Origin:'.URLROOT);
            header('Content-Type: application/JSON');
            header('Access-Control-Allow-Methods: POST');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

            $data = json_decode(file_get_contents("php://input"));

            $Data = $this->GovernmentRepo->GetCompanyByNameOrNumber($data->Value);
                echo json_encode($Data);
        }
    }

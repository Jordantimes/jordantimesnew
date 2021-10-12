<?php

    class Government extends Controller{

        public function __construct(){
            $this->GovernmentRepo = $this->Repository("Government");
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

            $ViewBox = trim(ucwords(strtolower($ViewBox)));

            $data = [
                "ViewBox" => $ViewBox,
                "USER" => $USER
            ];
            
            $this->view("Government/index" , $data);
        }

        //JSON HTTP Request
        public function Requests(){
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/JSON');
            header('Access-Control-Allow-Methods: GET');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

            $Data = $this->GovernmentRepo->GetRequests();

            echo json_encode($Data);
        }

        //JSON HTTP Request
        public function Accept(){
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/JSON');
            header('Access-Control-Allow-Methods: POST');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

            $data = json_decode(file_get_contents("php://input"));

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
            header('Access-Control-Allow-Origin: *');
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
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/JSON');
            header('Access-Control-Allow-Methods: POST');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

            $data = json_decode(file_get_contents("php://input"));

            $Data = $this->GovernmentRepo->GetCompanyByNameOrNumber($data->Value);
                echo json_encode($Data);
        }
    }

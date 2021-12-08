<?php

class Sites extends Controller{

    public function __construct(){
        $this->SitesRepo = $this->Repository("Sites");
    }

    public function index(){
        session_start();
        $USER = [];
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $passengers = "";
        $Date = date("Y-m-d");
        $start_date = "";
        $end_date = "";
        $start_location = "";
        $end_location = "";
        $destination = [   
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

        if(!empty($_SESSION["USER"])){
            $USER= unserialize($_SESSION["USER"]);
        }

        if(isset($_GET["passengers"]) && $_GET["passengers"] !== ""){
            if($_GET["passengers"] <= 6 && $_GET["passengers"] >= 1){
                $passengers = $_GET["passengers"];
            }
        }

        else{
            $passengers = 1;
        }

        if(isset($_GET["start_date"]) && $_GET["start_date"] !== ""){
            $sd = date("Y-m-d",strtotime($_GET["start_date"]));
            if($sd >= $Date){
                $start_date = $sd;
            }
        }

        if(isset($_GET["end_date"]) && $start_date!== "" && isset($_GET["start_date"])){
            $ed = date("Y-m-d",strtotime($_GET["end_date"]));
            if($ed  >= date($start_date)){
                $end_date = $ed ;
            }
        }

        if(isset($_GET["start_location"]) && $_GET["start_location"] !== ""){
            if($_GET["start_location"] >= 0 && $_GET["start_location"] <= 12 ){
                $start_location = $_GET["start_location"];
            }
        }

        // if(isset($_GET["end_location"]) && $start_location !== "" && isset($_GET["start_location"])){
        //     if($_GET["end_location"] >= 0 && $_GET["end_location"] <= 12 && $_GET["end_location"] != $start_location){
        //         $end_location = $_GET["end_location"];
        //     }
        // }

        if(isset($_GET["end_location"])){
            $end_location = $_GET["end_location"];
        }

        $data = [
            "USER" => $USER,
            "Filter" => [
                "passengers" => $passengers,
                "start_date" => $start_date,
                "end_date" => $end_date,
                "start_location" => $start_location,
                "end_location" => $end_location,
                "start_location_name" => $start_location !== "" ? $destination[$start_location] : "",
                "end_location_name" => $end_location !== "" ? $destination[$end_location] : ""
            ],
            "Sites" => []
        ];

        $data["Sites"] = $this->SitesRepo->GetSites($data["Filter"],$page);
        
        $this->view("Sites/index" , $data);
    }
}

<?php

class Sites extends Controller{

    public function __construct(){}

    public function index(){
        session_start();
        $USER = [];
        $passengers = "-";
        $Date = date("2021-04-05");
        $start_date = "----/--/--";
        $end_date = "----/--/--";
        $start_location = "-";
        $end_location = "-";
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

        if(isset($_GET["p"]) && $_GET["p"] !== ""){
            if($_GET["p"] <= 6 && $_GET["p"] >= 1){
                $passengers = $_GET["p"];
            } else {$passengers = "-";}
        }

        if(isset($_GET["sd"]) && $_GET["sd"] !== ""){
            $sd = date("Y/m/d",strtotime($_GET["sd"]));
            if($sd >= $Date){
                $start_date = $sd;
            }
        }

        if(isset($_GET["ed"]) && $start_date!== "----/--/--" && isset($_GET["sd"])){
            $ed = date("Y/m/d",strtotime($_GET["ed"]));
            if($ed  >= date($start_date)){
                $end_date = $ed ;
            }
        }

        if(isset($_GET["sl"]) && $_GET["sl"] !== ""){
            if($_GET["sl"] >= 0 && $_GET["sl"] <= 12 ){
                $start_location = $_GET["sl"];
            }
        }

        if(isset($_GET["el"]) && $start_location !== "-" && isset($_GET["sl"])){
            if($_GET["el"] >= 0 && $_GET["el"] <= 12 ){
                $end_location = $_GET["el"];
            }
        }

        $data = [
            "USER" => $USER,
            "passengers" => $passengers,
            "start_date" => $start_date,
            "end_date" => $end_date,
            "start_location_name" => $start_location !== "-" ? $destination[$start_location] : "-",
            "end_location_name" => $end_location !== "-" ? $destination[$end_location] : "-",
            "start_location" => $start_location,
            "end_location" => $end_location,
        ];

        $this->view("Sites/index" , $data);
    }
}

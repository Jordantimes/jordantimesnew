<?php

class Home extends Controller{

    public function __construct(){}

    public function index(){
        session_start();
        $USER = [];
        
        if(isset($_SESSION["USER"])){
            $USER = unserialize($_SESSION["USER"]);
        }

        $data = [
            "USER" => $USER,
            "trip" => "",
            "passengers" => ""
        ];

        if(!empty($_SESSION["trip"])){
            if(!empty($USER["Role"])){
                if($USER["Role"] === "customer"){
                    $data["trip"] = $_SESSION["trip"];
                    $data["passengers"] = $_SESSION["passengers"];   
                }
    
                $_SESSION["trip"] = "";
                $_SESSION["passengers"] = "";
            }
        }

        $this->view("Home/index" , $data);
    }

    public function contact(){
        session_start();
        $USER = [];
        
        if(isset($_SESSION["USER"])){
            $USER = unserialize($_SESSION["USER"]);
        }

        $data = [
            "USER" => $USER,
        ];

        $this->view("Home/contact" , $data);
    }

    public function about(){
        session_start();
        $USER = [];
        
        if(isset($_SESSION["USER"])){
            $USER = unserialize($_SESSION["USER"]);
        }

        $data = [
            "USER" => $USER,
        ];

        $this->view("Home/about" , $data);
    }
}

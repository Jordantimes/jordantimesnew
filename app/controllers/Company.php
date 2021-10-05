<?php

    class Company extends Controller{

        public function __construct(){

        }

        public function index(){
            session_start();
            
            if(empty($_SESSION["USER"])){
                header("location:".URLROOT."/User/LogIn");
            }

            $USER= unserialize($_SESSION["USER"]);

            $this->view("Company/index");
        }
    }
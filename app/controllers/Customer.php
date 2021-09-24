<?php

    class Customer extends Controller{

        public function __construct(){
            $this->CustomerRepo = $this->Repository("Customer");
        }

        public function index(){
            $this->view("Customer/index");
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
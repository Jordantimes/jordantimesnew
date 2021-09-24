<?php

    class Company extends Controller{

        public function __construct(){

        }

        public function index(){
            $this->view("Company/index");
        }
    }
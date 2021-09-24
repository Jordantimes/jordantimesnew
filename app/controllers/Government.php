<?php

    class Government extends Controller{

        public function __construct(){

        }

        public function index(){
            $this->view("Government/index");
        }
    }
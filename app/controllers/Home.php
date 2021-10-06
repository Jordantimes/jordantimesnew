<?php

class Home extends Controller{

    public function __construct(){}

    public function index(){
        session_start();
        $this->view("Home/index");
    }

    public function contact(){
        session_start();
        $this->view("Home/contact");
    }
}
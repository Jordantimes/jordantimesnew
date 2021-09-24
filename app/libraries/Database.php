<?php

    class Database{
        private $DB_HOST = HOST;
        private $DB_USERNAME = USERNAME;
        private $DB_PASSWORD = PASSWORD;
        private $DB_NAME = DBNAME;
        
        private $statement;
        private $DB_HANDLER;
        private $error;

        public $Connection;


        public function __construct(){}

        public function __destruct(){}

        public function Connect(){
            try{
                $this->Connection = new PDO("mysql:host=" . $this->DB_HOST . ";dbname=" . $this->DB_NAME, $this->DB_USERNAME , $this->DB_PASSWORD);
                $this->Connection->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            }
    
                catch(PDOException $e){
                    echo "connection error: ". $e->getMessage();
                }
    
            return $this->Connection;
        }
    }
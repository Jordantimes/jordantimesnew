<?php

class DataBase{

    private $host = "localhost";
    private $username = "root";
    private $password = "bruhbruh";
    private $database_name = "jordantimes"; 
    public $connection;

    public function __construct(){}

    public function __destruct(){}

    public function Connect(){
        try{
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username , $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        }

            catch(PDOException $e){
                echo "connection error: ". $e->getMessage();
            }

        return $this->connection;
    }
}
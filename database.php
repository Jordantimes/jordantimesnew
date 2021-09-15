<?php

$hostname = "localhost";
$username ="root";
$password = "";
$dbname ="jordantimes";

// Connect to Database
$conn = mysqli_connect($hostname,$username,$password,$dbname);

// Check Connection 
if(!$conn){
    die("connection failed:" .mysqli_connect_error());
}


?>
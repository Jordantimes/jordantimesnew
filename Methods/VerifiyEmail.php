<?php

include "../Configration/Emails/EmailLibrary.php";
include "Additional.php";
include "../DAL/DAL.php";

$Code = $_GET["Code"];
$Code = str_replace(" ", "+", $Code);
$RawCode = CodeDecrypt($Code, EncryptionKey);

if($RawCode === false){
    header("location: ../Views/User/LogIn.php?Error=true");
    exit;
}

$Date = date("Y-m-d");

$table = "users";
$columns = "verified = true , UpdatedAt = '$Date'";
$expression = "email = '$RawCode'";

if(Update($table,$columns,$expression)){
    header("location: ../Views/User/LogIn.php");
    exit;
}

else{
    echo "Something went wrong.";
}

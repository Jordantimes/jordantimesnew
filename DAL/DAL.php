<?php

include "../Configration/DataBase.php";

function SelectAll(){

}

function SelectByCondition($table,$columns,$expression){
    $DataBase = new DataBase();
    $Connection = $DataBase->connect();

    $Query = "SELECT $columns FROM $table WHERE $expression";
    $stmt= $Connection->prepare($Query);
    $stmt->execute();

    $DataBase = Null;
    $Connection = NULL;

    return $stmt;
}

function Insert($table,$columns,$values){
    $DataBase = new DataBase();
    $Connection = $DataBase->connect();

    $Query = "INSERT INTO $table($columns) VALUES ($values)";
    $stmt= $Connection->prepare($Query);
    $stmt->execute();

    $DataBase = Null;
    $Connection = NULL;
}

function Update(){

}

function Delete(){

}
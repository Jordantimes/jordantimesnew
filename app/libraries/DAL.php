<?php

function SelectAll(){

}

function SelectByCondition($table,$columns,$expression){
    $DataBase = new DataBase();
    $Connection = $DataBase->Connect();
    
    $Query = "SELECT $columns FROM $table WHERE $expression";
    $stmt= $Connection->prepare($Query);
    $stmt->execute();

    $DataBase = Null;
    $Connection = NULL;

    return $stmt;
}

function Insert($table,$columns,$values){
    $DataBase = new DataBase();
    $Connection = $DataBase->Connect();

    $Query = "INSERT INTO $table($columns) VALUES ($values)";
    $stmt= $Connection->prepare($Query);
    $query_condition = $stmt->execute();

    $DataBase = Null;
    $Connection = NULL;

    return $query_condition;
}

function Update($table,$columns,$expression){
    $DataBase = new DataBase();
    $Connection = $DataBase->Connect();
    
    $Query = "UPDATE $table SET $columns WHERE $expression";
    $stmt= $Connection->prepare($Query);
    $query_condition = $stmt->execute();

    $DataBase = Null;
    $Connection = NULL;

    return $query_condition;
}

function Delete($table,$expression){
    $DataBase = new DataBase();
    $Connection = $DataBase->Connect();
    $Date = date("Y-m-d");
    
    $Query = "UPDATE $table SET isDeleted = true , UpdatedAt = '$Date' WHERE $expression";
    $stmt= $Connection->prepare($Query);
    $query_condition = $stmt->execute();

    $DataBase = Null;
    $Connection = NULL;

    return $query_condition;
}

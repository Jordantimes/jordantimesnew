<?php

include "../DAL/DAL.php";
include "Additional.php";

function InsertCompany($CompanyARR){
    $table = "users";
    $columns = "company_ID,name,email,phone,password,role,CreatedAt,UpdatedAt,verified";
    $values = NormalCombine($CompanyARR);

    Insert($table,$columns,$values);
}

function InsertCustomer($CustomerARR){
    $table = "users";
    $columns = "name,email,phone,password,role,CreatedAt,UpdatedAt";
    $values = NormalCombine($CustomerARR);

    Insert($table,$columns,$values);
}

function CheckEmail($Email){
    $table = "users";
    $columns = "email";
    $expression = "email = '$Email'";

    $result = SelectByCondition($table,$columns,$expression);

    $RowCount = $result->rowCount();

    if($RowCount === 0){
        return false;
    }

    return true;
}

function CheckName($Name,$Role){
    $table = "users";
    $columns = "name";
    $expression = "name = '$Name' AND role = '$Role'";

    $result = SelectByCondition($table,$columns,$expression);

    $RowCount = $result->rowCount();

    if($RowCount === 0){
        return false;
    }

    return true;
}

function CheckCompanyID($Company_ID){
    $table = "users";
    $columns = "name";
    $expression = "company_ID = '$Company_ID'";

    $result = SelectByCondition($table,$columns,$expression);

    $RowCount = $result->rowCount();

    if($RowCount === 0){
        return false;
    }

    return true;
}

function GetUserByEmail($Email){
    $table = "users";
    $columns = "*";
    $expression = "email = '$Email'";

    $result = SelectByCondition($table,$columns,$expression);
    $data = $result->fetch(PDO::FETCH_ASSOC);

    return $data;
}
<?php

    class CompanyRepo{
        public function update_profile($Data){
            $Date = date("Y-m-d");

            $table = "users";
            $columns = "name = '".$Data["Name"]."' , bio = '".$Data["Bio"]."' , email = '".$Data["Email"]."' , phone = '".$Data["Phone"]."', UpdatedAt = '$Date'";
            $expression = "id = ".$Data["ID"]." AND isDeleted = false";

            if($Data["Image"] !== ""){
                $columns .= ", image = '".$Data["Image"]."'";
            }

            return Update($table,$columns,$expression);
        }
    }
<?php

    class CustomerRepo{
        public function VerifyCustomer($Code){
            $Code = str_replace(" ", "+", $_GET["Code"]);
            $RawCode = CodeDecrypt($Code, EncryptionKey);
            
            if($RawCode === false){
                return false;
            }
            
            $Date = date("Y-m-d");
            
            $table = "users";
            $columns = "verified = true , UpdatedAt = '$Date'";
            $expression = "email = '$RawCode'";
            
            return Update($table,$columns,$expression);

        }

        public function update_profile($Data){
            $Date = date("Y-m-d");

            $table = "users";
            $columns = "name = '".$Data["Name"]."' , email = '".$Data["Email"]."' , phone = '".$Data["Phone"]."', UpdatedAt = '$Date'";
            $expression = "id = ".$Data["ID"]." AND isDeleted = false";


            return Update($table,$columns,$expression);
        }

        public function book_customer($Data){
            $table = "booked";
            $columns = "trip,user,name,phone,age,nationID,created_at,updated_at,is_deleted";
            $values = NormalCombine($Data);

            return Insert($table,$columns,$values);
        }
    }

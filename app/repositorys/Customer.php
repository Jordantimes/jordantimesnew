<?php

    class CustomerRepo{
        public function VerifyCustomer($Code){
            $Code = str_replace(" ", "+", $_GET["Code"]);
            $RawCode = CodeDecrypt($Code, EncryptionKey);
            
            if($RawCode === false){

            }
            
            $Date = date("Y-m-d");
            
            $table = "users";
            $columns = "verified = true , UpdatedAt = '$Date'";
            $expression = "email = '$RawCode'";
            
            return Update($table,$columns,$expression);

        }
    }
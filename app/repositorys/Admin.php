<?php

    class AdminRepo{
        public function GetSignUpCountPerMonth(){
            $data = [];

            $table= "users";
            $columns = "CreatedAt AS x,count(*) as y";
            $expression =  "role = 'company' AND isDeleted = false  GROUP BY year(CreatedAt),month(CreatedAt) ORDER BY year(CreatedAt),month(CreatedAt)";

            $result =  SelectByCondition($table,$columns,$expression);
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                array_push($data , $row);
            }

            return $data;
        }
        
        public function AcceptTrip($ID){
            $Date = date("Y-m-d");

            $table= "trips";
            $columns = "verified = true , updated_at = '$Date'";
            $expression =  "id = $ID AND is_deleted = false";

            return Update($table,$columns,$expression);
        }

        public function DeclineTrip($ID){
            $Date = date("Y-m-d");

            $table= "trips";
            $columns = "is_deleted = true , updated_at = '$Date'";
            $expression =  "id = $ID AND is_deleted = false";

            return Update($table,$columns,$expression);
        }
    }

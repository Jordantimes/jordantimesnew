<?php

    class AdminRepo{
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
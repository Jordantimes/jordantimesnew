<?php

    class SitesRepo{
        public function GetSites($filter,$page){
            $data = [];
            $table = "trips,users";
            $columns = "users.name as company_name,image,trips.id,trips.name,name_ar,start_location,end_location,start_date,end_date,
                        days,nights,description,description_ar,price,breakfast,breakfast_price,lunch,lunch_price,dinner,dinner_price,images,created_at";
            $expression = "is_deleted = false AND users.id = company";

            if(!empty($filter["start_date"])){
                $expression.= " AND start_date = '".$filter["start_date"]."'";
            }

            if(!empty($filter["end_date"])){
                $expression.= " AND end_date = '".$filter["end_date"]."'";
            }

            if(strlen($filter["start_location"]) > 0){
                $expression.= " AND start_location = ". ((int)$filter["start_location"]+1);
            }  
            
            if(strlen($filter["end_location"]) > 0){
                $expression.= " AND end_location = ". ((int)$filter["end_location"]+1);
            }  

            $result =  SelectByCondition($table,$columns,$expression);
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $row["images"] = explode("," , $row["images"]);
                array_push($data , $row);
            }

            return $data;
        }

        public function GetSiteByTripID($id){
            $data = null;
            $table = "trips,users";
            $columns = "users.id as company_id,users.name as company_name,image,trips.name,name_ar,start_location,end_location,start_date,end_date,
                        days,nights,description,description_ar,price,breakfast,breakfast_price,lunch,lunch_price,dinner,dinner_price,images,created_at";
            $expression = "trips.id = $id AND is_deleted = false AND users.id = company";

            $result =  SelectByCondition($table,$columns,$expression);
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $row["images"] = explode("," , $row["images"]);
                $data= $row;
            }

            return $data;
        }
    }

<?php

    class GovernmentRepo{
        public function GetRequests(){
            $table= "users";
            $columns = "company_ID,company_Number,name,email,phone,CreatedAt";
            $expression =  "verified = false AND role = 'company' AND isDeleted = false";
            
            $result = SelectByCondition($table,$columns,$expression);

            $Data = [];

            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                extract($row);

                $DataItems = [
                    "company_ID" => $row["company_ID"],
                    "company_Number" => $row["company_Number"],
                    "name" => $row["name"],
                    "email" => $row["email"],
                    "phone" => $row["phone"],
                    "CreatedAt" => $row["CreatedAt"]
                ];

                array_push($Data , $DataItems);
            }

            return $Data;
        }

        public function AcceptCompany($Email){
            $Date = date("Y-m-d");

            $table= "users";
            $columns = "verified = true , UpdatedAt = '$Date'";
            $expression =  "email = '$Email' AND role = 'company' AND isDeleted = false";

            return Update($table,$columns,$expression);
        }

        public function DeclineCompany($Email){
            $table= "users";
            $expression =  "email = '$Email' AND role = 'company' AND isDeleted = false";

            return Delete($table,$expression);
        }

        public function GetCompanyByNameOrNumber($Value){
            $Data = [];

            if(!empty($Value)){
                $table= "users";
                $columns = "company_ID,company_Number,name,email,phone,CreatedAt";
                $expression =  "verified = false AND role = 'company' AND isDeleted = false AND (name LIKE '%$Value%' OR company_Number LIKE '%$Value%')";
                
                $result = SelectByCondition($table,$columns,$expression);

                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    extract($row);

                    $DataItems = [
                        "company_ID" => $row["company_ID"],
                        "company_Number" => $row["company_Number"],
                        "name" => $row["name"],
                        "email" => $row["email"],
                        "phone" => $row["phone"],
                        "CreatedAt" => $row["CreatedAt"]
                    ];

                    array_push($Data , $DataItems);
                }
            }

            return $Data;
        }
    }

<?php

    class CompanyRepo{
        public function ImageUpload($file_tmp,$file_size,$file_error,$file_type,$file_name,$file_path){
            return ImageUpload($file_tmp,$file_size,$file_error,$file_type,$file_name,$file_path);
        }

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

        public function Createtrip($Data){
            $Date = date("Y-m-d");

            $trip_values=[
                $Data["ID"],
                $Data["name"],
                $Data["nameAr"],
                $Data["start_date"],
                $Data["end_date"],
                $Data["days"],
                $Data["nights"],
                $Data["description"],
                $Data["descriptionAr"],
                $Data["breakfast"],
                $Data["breakfast_price"],
                $Data["lunch"],
                $Data["lunch_price"],
                $Data["dinner"],
                $Data["dinner_price"],
                $Data["image"],
                $Date,
                $Date,
                0
            ];

            $table = "trips";
            $columns = "company,name,name_ar,start_date,end_date,days,nights,description,description_ar,breakfast,breakfast_price,lunch,lunch_price,dinner,dinner_price,images,created_at,updated_at,is_deleted";
            $values = NormalCombine($trip_values);
            
            return Insert($table,$columns,$values);
        }
    }

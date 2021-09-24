<?php

    class Controller{
        public function Repository($Repository){
            require_once "../app/repositorys/". $Repository .".php";

            $RepoName = $Repository."Repo";

            return new $RepoName();
        }

        public function Model($Model){
            require_once "../app/models/". $Model .".php";

            $ModelName = $Model."Model";

            return new $ModelName();
        }

        public function view($view ,$data = []){
            if(file_exists("../app/views/". $view .".php")){
                require_once "../app/views/". $view .".php";
            }

            else{
                die("View does not exist");
            }
        }
    }
<?php 

function NormalCombine($ARR){
    $string = "";

    for($i = 0 ; $i < count($ARR) ; ++$i){
        if(gettype($ARR[$i]) === "string"){
            $string.="'$ARR[$i]'";
        }

        else{
            $string .= $ARR[$i];
        }

        if($i < count($ARR) - 1){
            $string .= ",";
        }
    }

    return $string;
}

function CreateCompanyID(){
    $alphabet = [
    'A', 'B', 'C', 'D', 'E',
    'F', 'G', 'H', 'I', 'J',
    'K', 'L', 'M', 'N', 'O',
    'P', 'Q', 'R', 'S', 'T',
    'U', 'V', 'W', 'X', 'Y',
    'Z'
    ];

    $ID = "";

    for($i = 0 ; $i < 2 ; ++$i){
        $ID .= $alphabet[rand(0,25)]; 
    }

    $ID .= "-";
    $ID .= rand(1000,9999);

    return $ID;
}
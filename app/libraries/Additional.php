<?php

    function NormalCombine($Obj){
        $string = "";
        $Counter = 0;

        foreach($Obj as $Value){
            if(gettype($Value) === "string"){
                $string.="'$Value'";
            }

            else{
                $string .= $Value;
            }

            if($Counter < count((array)$Obj) - 1){
                $string .= ",";
            }

            $Counter++;
        }

        return $string;
    }

    function SendMail($From , $To , $Subject , $Body , $Key){
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom($From);
        $email->setSubject($Subject);
        $email->addTo($To);
        $email->addContent("text/html", $Body);
        $sendgrid = new \SendGrid($Key);
        try {
            $response = $sendgrid->send($email);
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
    
    function CodeEncrypt($plaintext, $key) {
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
    
        return $ciphertext;
    }
    
    function CodeDecrypt($ciphertext, $key) {
        $c = base64_decode($ciphertext);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        if (hash_equals($hmac, $calcmac))
        {
            return $original_plaintext;
        }
    
        else{
            return false;
        }
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

    function DateAndIdSlice($Code){
        $string = "";
        $Break = 3;
        $CodeData = [];
    
        for($i = 0 ; $i < strlen($Code) ; ++$i){
            $string .=$Code[$i];
    
            if($i === $Break){
                array_push($CodeData , (int)$string);
                $string = "";
    
                if($Break < 13){
                    $Break += 2;
                }
    
                continue;
            }
    
            if($i === 14){
                continue;
                $string = "";
            }
    
            if($i === strlen($Code) - 1){
                array_push($CodeData , (int)$string);
            }
        }
    
        return $CodeData;
    }
    
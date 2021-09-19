<?php
include "../DAL/DAL.php";
include "Additional.php";
include "../Services/Emails/EmailLibrary.php";
include "../Models/RecoveryPasswordCodeModel.php";

function InsertCompany($CompanyARR){
    $table = "users";
    $columns = "company_ID,name,email,phone,password,role,CreatedAt,UpdatedAt,verified";
    $values = NormalCombine($CompanyARR);

    return Insert($table,$columns,$values);
}

function InsertCustomer($CustomerARR){
    $table = "users";
    $columns = "name,email,phone,password,role,CreatedAt,UpdatedAt,verified";
    $values = NormalCombine($CustomerARR);

    return Insert($table,$columns,$values);
}

function CheckEmail($Email){
    $table = "users";
    $columns = "email";
    $expression = "email = '$Email' AND isDeleted = false";

    $result = SelectByCondition($table,$columns,$expression);

    $RowCount = $result->rowCount();

    if($RowCount === 0){
        return false;
    }

    return true;
}

function CheckName($Name,$Role){
    $table = "users";
    $columns = "name";
    $expression = "name = '$Name' AND role = '$Role' AND isDeleted = false";

    $result = SelectByCondition($table,$columns,$expression);

    $RowCount = $result->rowCount();

    if($RowCount === 0){
        return false;
    }

    return true;
}

function CheckCompanyID($Company_ID){
    $table = "users";
    $columns = "name";
    $expression = "company_ID = '$Company_ID' AND isDeleted = false";

    $result = SelectByCondition($table,$columns,$expression);

    $RowCount = $result->rowCount();

    if($RowCount === 0){
        return false;
    }

    return true;
}

function GetUserByEmail($Email){
    $table = "users";
    $columns = "*";
    $expression = "email = '$Email' AND isDeleted = false";

    $result = SelectByCondition($table,$columns,$expression);
    $data = $result->fetch(PDO::FETCH_ASSOC);

    return $data;
}

function SendPasswordRecoveryMail($To,$Id,$Name){
    $ReadyToEncryptCode = "";
    $ReadyToEncryptCode .=date("Y").date("m").date("d").date("h").date("i").date("s")."+".$Id;
    $Code =  CodeEncrypt($ReadyToEncryptCode, EncryptionKey);

    $From = From;
    $Subject = "JordanTimes password reset request";
    $Body = "
    <div style=' width: 100%;min-height: 600px;display: flex;align-items: center;justify-content: center;'>
    <div style='width: 385px;background-color: #faf8f3;box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.3);margin:auto;padding:32px'>
        <div style='text-align: center;'>
            <img src='https://cdn.discordapp.com/attachments/796055415364386896/888477028096045056/JT_Logo75.png' alt='JordanTimesLogo'>
        </div>
        <h2 style='text-align: left;font-size:24px;padding-top: 24px;'>
            Hello ".$Name.".
        </h2>

        <div style='text-align: left;font-size:16px;margin: 12px 0px 24px 0px;'>Your password reset link is ready by the button right below, please note that this link is only available for 
            <div style='display:inline-block;position:relative;background-color:rgba(240, 93, 94,0.3);'>
                30 minutes
            </div> 
            from the time that you have requested the password reset link.
        </div>

        <div style='width: 100%;display: flex;justify-content: center;padding-bottom:72px;'>
            <a href='http://localhost/JordanTimes/Views/User/RecoverPassword.php?Code=".$Code."' style='text-decoration: none; text-align: center;width: 100%;display: block;padding: 18px 12px;background-color:#f05d5e;color: #ffffff;font-size: 18px;'>Reset Password</a>
        </div>

        <div>
            <p style='font-size: 16px;'>This email was sent automatically, if you have any questions please send us an email on the E-mail link below, we wish you the best.</p>
            <a href='mailto:mail@mail.com' style='background-color:rgba(240, 93, 94,1); color:#ffffff; padding: 4px; text-decoration: none; font-size: 16px;'>mail@mail.com</a>
        </div>
    </div>
</div>
    ";
    $Key = SendGridKey;

    SendMail($From , $To , $Subject , $Body , $Key);
}

function GetRecoveryPasswordCodeData($Code){
    $Code = str_replace(" ", "+", $Code);
    $RawCode = CodeDecrypt($Code, EncryptionKey);

    if($RawCode === false){
        return false;
    }

    $CodeData = DateAndIdSlice($RawCode);
    $CodeID = $CodeData[6];
    $CodeDate= date("Y-m-d h:i:s", mktime($CodeData[3] , $CodeData[4] , $CodeData[5] ,$CodeData[1] ,$CodeData[2] ,$CodeData[0]));
    $CodeDate = date("Y-m-d h:i:s",  strtotime($CodeDate.'+30 minutes'));

    $Model = new RecoveryPasswordCodeModel();
    $Model->Code = $Code;
    $Model->ID =  $CodeID;
    $Model->Date = $CodeDate;

    return $Model;
}

function UpdateUserPassword($ID,$Password){
    $Date = date("Y-m-d");
    $Password = password_hash($Password , PASSWORD_DEFAULT);

    $table = "users";
    $columns = "password ='$Password' , UpdatedAt = '$Date'";
    $expression = "id = $ID";

    return Update($table,$columns,$expression);
}

function SendVerificationMail($To,$Name){
    $ReadyToEncryptCode = "";
    $ReadyToEncryptCode .=$To;
    $Code =  CodeEncrypt($ReadyToEncryptCode, EncryptionKey);

    $From = From;
    $Subject = "JordanTimes account verification";
    $Body = "
    <div style=' width: 100%;min-height: 600px;display: flex;align-items: center;justify-content: center;'>
    <div style='width: 385px;background-color: #faf8f3;box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.3);margin:auto;padding:32px'>
        <div style='text-align: center;'>
            <img src='https://cdn.discordapp.com/attachments/796055415364386896/888477028096045056/JT_Logo75.png' alt='JordanTimesLogo'>
        </div>
        <h2 style='text-align: left;font-size:24px;padding-top: 24px;'>
            Hello ".$Name.".
        </h2>

        <div style='text-align: left;font-size:16px;margin: 12px 0px 24px 0px;'>Your account verification link is ready:
        </div>

        <div style='width: 100%;display: flex;justify-content: center;padding-bottom:72px;'>
            <a href='http://localhost/JordanTimes/Methods/VerifiyEmail.php?Code=".$Code."' style='text-decoration: none; text-align: center;width: 100%;display: block;padding: 18px 12px;background-color:#f05d5e;color: #ffffff;font-size: 18px;'>Verify Account</a>
        </div>

        <div>
            <p style='font-size: 16px;'>This email was sent automatically, if you have any questions please send us an email on the E-mail link below, we wish you the best.</p>
            <a href='mailto:mail@mail.com' style='background-color:rgba(240, 93, 94,1); color:#ffffff; padding: 4px; text-decoration: none; font-size: 16px;'>mail@mail.com</a>
        </div>
    </div>
</div>
    ";
    $Key = SendGridKey;

    SendMail($From , $To , $Subject , $Body , $Key);
}

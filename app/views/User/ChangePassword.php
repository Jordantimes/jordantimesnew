<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php 
        if(!empty($data["Message"])){
            echo $data["Message"];
        }
    ?>

    <div class="main_view">
        <form action="<?php echo URLROOT; ?>/User/ChangePassword" method="POST">
            <?php
            if(!empty($data["Code"])){
            ?>
                <input type="hidden" name="Code" value ="<?php echo $data["Code"];?>">
            <?php
            }
            else{
            ?>
                <input type="hidden" name="Code" value ="<?php echo $_GET["Code"];?>">
            <?php
            }
            ?>
            <input type="password" name="password" placeholder="New password">
            <input type="password" name="repeat_password" placeholder="Repeat password">

            <button type="submit" name="ChangePasswordSubmit">Update new password</button>
        </form>
    </div>
</body>
</html>
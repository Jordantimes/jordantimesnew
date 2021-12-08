<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME?> - Update Password</title>
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Base.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\login.css";?>">
</head>
<body>
    <div class="main_view">
        <?php require_once APPROOT."\Views\INCLUDES\Header.php"; ?>
        
        <div class="content">
            <div class="form_container">
                <div class="form_header">
                    <h1>Update password</h1>
                </div>

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

                    <div class="input_wrapper">
                        <label for="">New password</label>
                        <input type="password" name="password">
                    </div>

                    <div class="input_wrapper">
                        <label for="">Reapeat password</label>
                        <input type="password" name="repeat_password" >
                    </div>

                    <?php 
                        if(!empty($data["Message"])){
                            echo "<p class='error'>".$data["Message"]."</p>";
                        }
                    ?>

                    <button type="submit" name="ChangePasswordSubmit" class="submit">Confirm new password</button>
                </form>
            </div>
        </div>

        <?php require_once APPROOT."\Views\INCLUDES\Footer.php"; ?>
    </div>
</body>
</html>

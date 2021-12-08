<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME?> - Restore Password</title>
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Base.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\login.css";?>">
</head>
<body>
    <div class="main_view">
        <?php require_once APPROOT."\Views\INCLUDES\Header.php"; ?>

        <div class="content">
            <div class="form_container">
                <div class="form_header">
                    <h1>Restore password</h1>
                </div>

                <form action="<?php echo URLROOT; ?>/User/PasswordUpdate" method="POST">
                    <div class="input_wrapper">
                        <label>E-mail</label>
                        <input type="email" name="email">
                    </div>

                    <?php 
                        if(!empty($data["Message"])){
                            echo "<p class='error'>".$data["Message"]."</p>";
                        }
                    ?>

                    <button type="submit" name="ForgotPasswordSubmit" class="submit">Send</button>
                </form>
            </div>
        </div>

        <?php require_once APPROOT."\Views\INCLUDES\Footer.php"; ?>
    </div>
</body>
</html>

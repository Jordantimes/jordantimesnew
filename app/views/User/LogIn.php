<?php
    session_start();
    session_destroy();
?>

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
        <form action="<?php echo URLROOT; ?>/User/LogIn" method="POST">
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">

            <button type="submit" name="login_Submit">Log in</button>
        </form>

        <a href="<?php echo URLROOT; ?>/User/ForgotPassword">Forgot password?</a>
    </div>
</body>
</html>

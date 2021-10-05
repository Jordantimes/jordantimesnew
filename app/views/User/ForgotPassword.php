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
        <form action="<?php echo URLROOT; ?>/User/ForgotPassword" method="POST">
            <label>Send password restoration to:</label>
            <input type="email" placeholder="Email" name="email">

            <button type="submit" name="ForgotPasswordSubmit">Send</button>
        </form>
    </div>
</body>
</html>
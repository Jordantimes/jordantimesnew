<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main_view">
        <?php 
        if(!empty($data["Message"])){
            echo $data["Message"];
        }
        ?>

        <form action="<?php echo URLROOT; ?>/User/SignUp" method="POST">
            <input type="text" name="name" placeholder="name">
            <input type="email" name="email" placeholder="email">
            <input type="text" name="phone" placeholder="phone">
            <input type="password" name="password" placeholder="password">
            <input type="password" name="repeat_password" placeholder="repeat_password">
            <input type="hidden" name="Role" value="customer">

            <button type="submit" name="SignUp_Submit">Sign up</button>
        </form>

        <br>

        <form action="<?php echo URLROOT; ?>/User/SignUp" method="POST">
            <input type="text" name="company_number" placeholder="company_number">
            <input type="text" name="name" placeholder="name">
            <input type="email" name="email" placeholder="email">
            <input type="text" name="phone" placeholder="phone">
            <input type="password" name="password" placeholder="password">
            <input type="password" name="repeat_password" placeholder="repeat_password">
            <input type="hidden" name="Role" value="company">

            <button type="submit" name="SignUp_Submit">Sign up</button>
        </form>        
    </div>
</body>
</html>
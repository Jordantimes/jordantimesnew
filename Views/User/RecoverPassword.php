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
        <form action="../../Controllers/UserController.php" method="POST">
            <input type="hidden" name="Code" value ="<?php echo $_GET["Code"];?>">
            <input type="password" name="password" placeholder="New password">
            <input type="password" name="repeat_password" placeholder="Repeat password">

            <button type="submit" name="UpdatePassword">Update new password</button>
        </form>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="mian_view">
        <form action="../../Controllers/UserController.php" method="POST">
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">

            <button type="submit" name="login_Submit">Log in</button>
        </form>

        <a href="ForgetPassword.html">Forgot password?</a>
    </div>
</body>
</html>
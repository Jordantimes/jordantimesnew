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
            <label>Send password restoration to:</label>
            <input type="email" placeholder="Email" name="email">

            <button type="submit" name="PasswordRestoreSubmit">Send</button>
        </form>
    </div>
</body>
</html>
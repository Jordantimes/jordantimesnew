<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME?> - Customer Verify</title>
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Base.css";?>">

    <style>
        .verify_wrapper h1{
            display: inline-block;
            position: relative;
            font-family: 'Poppins', sans-serif;
            font-size: 48px;
            margin-bottom:12px
        }

        .verify_wrapper h1::after{
            content: "";
            display: block;
            position: absolute;
            top: 60%;
            left: 0%;
            width: 100%;
            height: 16px;
            background-color: #F05D5E;
            opacity: 0.3;
        }

        p a{
            color : #000000
        }
    </style>
</head>
<body>
    <div class="main_view">

        <?php require_once APPROOT."\Views\INCLUDES\Header.php"; ?>

        <div class="content">
            <div class="verify_wrapper">
            <?php 
                if(!empty($data["Message"])){
            ?>
                <p>Something went wrong.</p>
            <?php
                }
                else{
            ?>
                <h1>Account verified.</h1>
                <p>Your account is now verified, you can close this page or click <a href="<?php echo URLROOT?>">here</a> to get redirected to the home page.</p>
            <?php
                }
            ?>
            </div>
        </div>

        <?php require_once APPROOT."\Views\INCLUDES\Footer.php"; ?>
    </div>
</body>
</html>

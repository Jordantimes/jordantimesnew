<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME?></title>
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Base.css";?>">
</head>
<body>
    <div class="main_view">
        <?php require_once APPROOT."\Views\INCLUDES\Header.php"; ?>

        <?php if(!empty($data["trip"])){ ?>
            <div>
                <a href="<?php echo URLROOT."/Customer/Book?trip=".$data["trip"]."&passengers=".$data["passengers"]?>">Continue</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>

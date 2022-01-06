<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME?> - Book</title>
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Base.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\book.css";?>">
</head>
<body>
    <div class="main_view">
        <?php require_once APPROOT."\Views\INCLUDES\Header.php"; ?>

        <div class="content">
            <?php if(isset($data["trip"]["company_name"])){ ?>
                <div class="site">
                    <div class="site_image">
                        <img src="<?php echo URLROOT."/public/Images/users/trips/".$data["trip"]["images"][0]?>" alt="site image">
                    </div>

                    <div class="site_info">
                        <div class="site_company_info">
                            <div><img class="company_picture" src="<?php echo URLROOT."/public/Images/users/companys/".$data["trip"]["image"]?>" alt="company picture"></div>
                            <div>
                                <div class="company_name"><?php echo $data["trip"]["company_name"]?></div>
                                <div class="site_created_at"><?php echo $data["trip"]["created_at"]?></div>
                            </div>
                        </div>
                        
                        <div class="site_info_upper">
                            <div class="site_upper_info_left">
                                <div class="site_name"><?php echo $data["trip"]["name"]?></div>
                                <div class="site_date">
                                    <span><?php echo $data["trip"]["start_date"]?></span>
                                    <span>-</span>
                                    <span><?php echo $data["trip"]["end_date"]?></span>
                                    <span>|</span>
                                    <span><?php echo $data["trip"]["days"]?> days, <?php echo $data["trip"]["nights"]?> nights</span>
                                </div>
                            </div>

                            <div class="site_upper_info_right">
                                <div class="site_price">
                                    USD<?php echo $data["passengers"]*($data["trip"]["price"] + $data["trip"]["breakfast_price"] + $data["trip"]["lunch_price"] + $data["trip"]["dinner_price"]);?>
                                </div>
                            </div>
                        </div>

                        <div class="site_info_lower">
                            <div class="site_description"><?php echo $data["trip"]["description"]?></div>

                            <div class="site_prices">
                                <div>- Trip base price <?php echo $data["trip"]["price"]?>USD</div>
                                <?php
                                    if(!empty($data["trip"]["breakfast_price"])){
                                        echo "<div>- Breakfast". $data["trip"]["breakfast_price"]."USD</div>";
                                    }

                                    if(!empty($data["trip"]["lunch_price"])){
                                        echo "<div>- Lunch". $data["trip"]["lunch_price"]."USD</div>";
                                    }

                                    if(!empty($data["trip"]["dinner_price"])){
                                        echo "<div>- Dinner". $data["trip"]["dinner_price"]."USD</div>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php 
                    
                ?>
                <div class="passengers_table">
                    <form action="<?php echo URLROOT."/Customer/Book"?>" method="POST">
                        <table>
                            <tr>
                                <th></th>
                                <th>Full name</th>
                                <th>Age</th>
                                <th>Phone number</th>
                                <th>National identification number</th>
                            </tr>

                            <tr>
                                <td><?php echo 1; ?></td>
                                <td><input type="text" name="name<?php echo 1; ?>" value="<?php echo $data["USER"]["Name"]; ?>"></td>
                                <td><input type="text" name="age<?php echo 1; ?>"></td>
                                <td><input type="text" name="phone<?php echo 1; ?>" value="<?php echo $data["USER"]["Phone_Number"]; ?>"></td>
                                <td><input type="text" name="id<?php echo 1; ?>"></td>
                            </tr>

                            <?php for($i = 1 ; $i < $data["passengers"] ; ++$i){?>
                                <tr>
                                    <td><?php echo $i+1; ?></td>
                                    <td><input type="text" name="name<?php echo $i+1; ?>"></td>
                                    <td><input type="text" name="age<?php echo $i+1; ?>"></td>
                                    <td><input type="text" name="phone<?php echo $i+1; ?>" value="+962-"></td>
                                    <td><input type="text" name="id<?php echo $i+1; ?>"></td>
                                </tr>
                            <?php } ?>
                        </table>

                        <div>
                            <input type="hidden" name="trip" value="<?php echo $data["trip_ID"]; ?>">
                            <input type="hidden" name="passengers" value="<?php echo $data["passengers"]; ?>">
                            <input type="hidden" name="company" value="<?php echo $data["trip"]["company_id"]; ?>">
                            <input type="hidden" name="trip_name" value="<?php echo $data["trip"]["name"]; ?>">
                            <button class="submit">Confirm check in</button>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>

        <?php require_once APPROOT."\Views\INCLUDES\Footer.php"; ?>
    </div>
</body>
</html>

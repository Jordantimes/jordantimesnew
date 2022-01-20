<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME?> - Customer</title>
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Base.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Notifications.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\pop_ups.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\alerts.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\CompanyIndex.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Navigators.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\calender.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\sites.css";?>">
</head>
<?php
error_reporting(E_ALL);

ini_set('display_errors', "On");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jordantimes";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


?>
<body>
    <div class="main_view">
        <div class="pop_ups_container">
            <div class="pop_up_content_container">
                <div class="pop_up_information"></div>
                <div class="pop_up_actions"></div>
            </div>
        </div>

        <?php require_once APPROOT."\Views\INCLUDES\Header.php"; ?>

        <div class="content">
            <div class="alert_container"></div>

            <div class="navigation_bar">
                <button class="navigation_button" <?php if($data["ViewBox"] === "Trips"){ echo "DisplayByURL='true'"; }?>>
                    <div class="navigation_button_text">Trips</div>
                    <div class="navigation_button_counter" id="trips_counter"></div>
                </button>

                <button class="navigation_button" <?php if($data["ViewBox"] === "Profile"){ echo "DisplayByURL='true'"; }?>>
                    <div class="navigation_button_text">Profile</div>
                    <div class="navigation_button_counter"></div>
                </button>

            </div>


            <div class="content_view_container">
                <div class="content_view_box" id="trips_view_box">
                    <div class="content_view_box_data_container">
                     <?php 
                     $userid=$data['USER']['ID'];
                     $sql = "SELECT * FROM booked where user=$userid group by trip DESC ";
                     $result = $conn->query($sql);
                     
                     if ($result->num_rows > 0) {
                       // output data of each row
                       while($row = $result->fetch_assoc()) {
                           $t=$row['trip'];
                        $sql2 = "SELECT * FROM trips where id=$t";
                        $result2 = $conn->query($sql2);

                        if ($result2->num_rows > 0) {
                            // output data of each row
                            while($row2 = $result2->fetch_assoc()) {

                                $row2["images"] = explode("," , $row2["images"]);


?>

<div class="pop_up_site_details_container"  id=<?php echo $row2["id"]  ?> style="bottom:0%;left:0%">
            <div class="pop_up_site_details">
                <div class="pop_up_close_button_wrapper">
                    <button class="close_button" id="pop_up_close" onclick="myFunction2(<?php echo $row2['id'] ?> )">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872    c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872    c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052    L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116    c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952    c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116    c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/>
                            </g>
                        </g>
                        </svg>
                    </button>
                </div>

                <div class="site_name_price_wrapper">
                    <div class="site_name"><?php echo     $row2["name"]  ?></div>
                    
                </div>

                <div class="site_images_preview_slider_wrapper">
                    <div class="site_images_preview_slider">
                        <div class="controlled_slider">
                            <div class="preview_image_container"><img class="preview_image" src=<?php echo 'http://localhost/JordanTimes/public/images/users/trips/'. $row2["images"][1] ?> alt=""></div>
                            <div class="preview_image_container"><img class="preview_image" src=<?php echo 'http://localhost/JordanTimes/public/images/users/trips/'. $row2["images"][2] ?> alt=""></div>
                            <div class="preview_image_container"><img class="preview_image" src=<?php echo 'http://localhost/JordanTimes/public/images/users/trips/'. $row2["images"][3] ?> alt=""></div>
                            <div class="preview_image_container"><img class="preview_image" src=<?php echo 'http://localhost/JordanTimes/public/images/users/trips/'. $row2["images"][4] ?> alt=""></div>

                        </div>
                    </div>

                    <div class="slider_navigators_wrapper">
                        <div class="slider_navigators"></div>
                    </div>
                </div>

                <div class="site_description_wrapper">
                    <div class="site_description_popedup">
                    <?php echo  $row2["description"] ?>
                    </div>
                </div>

                <div class="site_description_wrapper">
                    <div >
                    <h3>Passengers</h3>

<?php
 $tid=$row2['id'];
$sql3 = "SELECT * FROM booked where user=$userid and trip= $tid ";
                     $result3 = $conn->query($sql3);
                     
                     if ($result3->num_rows > 0) {
                       // output data of each row
                       while($row3 = $result3->fetch_assoc()) {
?>
<p style="color: #000;margin-top:10"><?php echo  $row3["name"] ?></p>


<?php
                       }}
?>


                    </div>
                </div>
            </div>
        </div>

            <button class="site" onclick="myFunction(<?php echo $row2['id'] ?> )">
                        <div class="site_image_wrapper" style="background-image: url(<?php echo 'http://localhost/JordanTimes/public/images/users/trips/'. $row2["images"][1] ?>);"></div>

                        <div class="site_information_wrapper">
                            <div class="site_name_price_wrapper">
                                <div class="site_name"><?php echo     $row2["name"]  ?></div>
                             <div></div>
                            </div>

                            <div class="site_description_wrapper">
                                
                                <div class="site_description">
<?php echo  $row2["description"] ?>
                            </div>
                            </div>

                            <div class="site_moredetails_wrapper" onclick="myFunction(<?php echo $row2['id'] ?> )">
                                <div class="moredetails" >More details</div>
                            </div>
                        </div>
                    </button>

<?php



                                
                               

                        }
                    } else {
                      echo "0 results";
                    }


                       }
                     } else {
                       echo "0 results";
                     }
                     $conn->close();
                     ?>

                    </div>
                </div>

                <div class="content_view_box" id="profile_view_box">
                    <div class="content_view_box_data_container">
                        <div class="profile_content">
                            <div class="profile_left_content">
                                <form action="<?php echo URLROOT;?>/Customer/edit_profile" method="POST" enctype="multipart/form-data">
                               


                                    <div class="data_wrapper">
                                        <label class="data_label">Name</label>
                                        <div class="data_div" name='name'><?php echo $data["USER"]["Name"];?></div>
                                    </div>

                               

                                    <div class="data_wrapper">
                                        <label class="data_label">Email</label>
                                        <div class="data_div" name='email'><?php echo $data["USER"]["Email"];?></div>
                                    </div>
                                    
                                    <div class="data_wrapper">
                                        <label class="data_label">Phone number</label>
                                        <div class="data_div" name='phone'><?php echo $data["USER"]["Phone_Number"];?></div>
                                    </div>

                                    <div class="submit_button_container"></div>
                                </form>

                                <div class="edit_profile_button_container">
                                    <button class="edit_profile_button">Edit profile</button>
                                </div>
                            </div>

                            <div class="profile_right_content">
                       

                                <div class="data_wrapper_static">
                                    <label class="data_label">Profile password</label>
                                    <a href="<?php echo URLROOT;?>/User/PasswordUpdate" target="_blank" class="update_password">Change profile password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content_view_box" id="notifications_view_box">
                    <div class="refresh_button_container">
                        <button class="refresh_button" id="refresh_notifications">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 489.533 489.533" style="enable-background:new 0 0 489.533 489.533;" xml:space="preserve">
                                <g>
                                    <path d="M268.175,488.161c98.2-11,176.9-89.5,188.1-187.7c14.7-128.4-85.1-237.7-210.2-239.1v-57.6c0-3.2-4-4.9-6.7-2.9   l-118.6,87.1c-2,1.5-2,4.4,0,5.9l118.6,87.1c2.7,2,6.7,0.2,6.7-2.9v-57.5c87.9,1.4,158.3,76.2,152.3,165.6   c-5.1,76.9-67.8,139.3-144.7,144.2c-81.5,5.2-150.8-53-163.2-130c-2.3-14.3-14.8-24.7-29.2-24.7c-17.9,0-31.9,15.9-29.1,33.6   C49.575,418.961,150.875,501.261,268.175,488.161z"/>
                                </g>
                            </svg>
                        </button>       
                    </div>     

                    <div class="content_view_box_data_container">
                        <div class="content_view_box_information" id="notifications_information"></div>

                        <div class="notifications_controls"></div>

                        <div class="notifications_table" id="notifications_table"></div>

                        <div class="view_more_container" id="notifications_view_more"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php require_once APPROOT."\Views\INCLUDES\Footer.php"; ?>
    </div>

    <script src="<?php echo URLROOT."\public\JS\config.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\CustomerIndex.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\Navigators.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\pop_ups.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\UserMessages.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\homesite.js";?>"></script>
</body>
</html>

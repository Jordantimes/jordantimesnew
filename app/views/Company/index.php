<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME?>Company</title>
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Base.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Notifications.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\pop_ups.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\alerts.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\CompanyIndex.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Navigators.css";?>">
</head>

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

                <button class="navigation_button" <?php if($data["ViewBox"] === "Notifications"){ echo "DisplayByURL='true'"; }?>>
                    <div class="navigation_button_text">Notifications</div>
                    <div class="navigation_button_counter" id="notifications_counter"></div>
                </button>
            </div>

            <div class="content_view_container">
                <div class="content_view_box" id="trips_view_box">
                    <div class="content_view_box_data_container">
                    </div>
                </div>

                <div class="content_view_box" id="profile_view_box">
                    <div class="content_view_box_data_container">
                        <div class="profile_content">
                            <div class="profile_left_content">
                                <form action="<?php echo URLROOT;?>/Company/edit_profile" method="POST" enctype="multipart/form-data">
                                    <label class="data_label">Company picture</label>
                                    <div class="profile_image_container">
                                        <div class="profile_image">
                                            <img class="profileIMG" src="<?php echo URLROOT."/public/images/users/companys/".$data["USER"]["Image"];?>" alt="Profile picture">
                                        </div>

                                        <div class="browse_image_container"></div>
                                    </div>


                                    <div class="data_wrapper">
                                        <label class="data_label">Company name</label>
                                        <div class="data_div" name='name'><?php echo $data["USER"]["Name"];?></div>
                                    </div>

                                    <div class="data_wrapper_textarea">
                                        <label class="data_label">Bio</label>
                                            <?php
                                            if(!empty($data["USER"]["Bio"])){?>
                                                <div class="data_div_textarea"><?php echo nl2br($data["USER"]["Bio"]);?></div>
                                            <?php }
                                            else{?>
                                                <div class="data_div_textarea" style="color:var(--text_side_color);">Your bio is empty!</div>
                                            <?php } ?>
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
                                    <label class="data_label">Company ID</label>
                                    <div class="data_div_static"><?php echo $data["USER"]["Company_ID"];?></div>
                                </div>
                                
                                <div class="data_wrapper_static">
                                    <label class="data_label">Company number</label>
                                    <div class="data_div_static"><?php echo $data["USER"]["Company_Number"];?></div>
                                </div>

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
    </div>

    <script src="<?php echo URLROOT."\public\JS\config.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\CompanyIndex.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\Navigators.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\pop_ups.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\UserMessages.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\Notifications.js";?>"></script>
</body>
</html>
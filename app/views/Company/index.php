<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME?> - Company</title>
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Base.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Notifications.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\pop_ups.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\alerts.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\CompanyIndex.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Navigators.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\calender.css";?>">
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
                                 <!-- <div class="data_wrapper_static">
                                    <label class="data_label">Company ID</label>
                                    <div class="data_div_static"><?php echo $data["USER"]["Company_ID"];?></div>
                                </div> -->
                                
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

        <button class="create_trip">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" role="img" aria-labelledby="plusIconTitle" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none">
            <path d="M20 12L4 12M12 4L12 20"/>
            </svg>

            <span>Create trip</span>
        </button>

        <div class="create_trip_pop_up_container">
            <div class="create_trip_pop_up">
                <h2>Create trip</h2>
                <form action="<?php echo URLROOT;?>/Company/CreateTrip" method="POST" enctype="multipart/form-data">
                    <div class="create_form_input">
                        <label>Destinations</label>
                        <div class="destination_input">
                            <input type="checkbox" name="destination[]" class="dest_checkbox">
                            <button class="destination_button" type="button">
                                <span class="destination_name">Select</span>
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    width="451.847px" height="451.847px" viewBox="0 0 451.847 451.847" style="enable-background:new 0 0 451.847 451.847;"
                                    xml:space="preserve">
                                    <g>
                                        <path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751
                                            c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0
                                            c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z"/>
                                    </g>
                                </svg>
                            </button>

                            <div class="destination_list" visibile="false"> 
                                <button for="0" value="0" type="button" class="dest_selection">Select</button>
                                <button for="0" value="1" type="button" class="dest_selection">Amman</button>
                                <button for="0" value="2" type="button" class="dest_selection">Zarqa</button>
                                <button for="0" value="3" type="button" class="dest_selection">Irbid</button>
                                <button for="0" value="4" type="button" class="dest_selection">Ajloun</button>
                                <button for="0" value="5" type="button" class="dest_selection">Jarash</button>
                                <button for="0" value="6" type="button" class="dest_selection">Al Balqa</button>
                                <button for="0" value="7" type="button" class="dest_selection">Al Mafraq</button>
                                <button for="0" value="8" type="button" class="dest_selection">Madaba</button>
                                <button for="0" value="9" type="button" class="dest_selection">Al Tafele</button>
                                <button for="0" value="10" type="button" class="dest_selection">Al Karak</button>
                                <button for="0" value="11" type="button" class="dest_selection">Ma'an</button>
                                <button for="0" value="12" type="button" class="dest_selection">Aqaba</button>
                            </div>

                            <button class="remove_destination_button" type="button">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872
                                                c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872
                                                c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052
                                                L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116
                                                c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952
                                                c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116
                                                c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/>
                                        </g>
                                    </g>
                                </svg>
                            </button>
                        </div>

                        <div class="destination_input">
                            <input type="checkbox" name="destination[]" class="dest_checkbox">
                            <button class="destination_button" type="button">
                                <span class="destination_name">Select</span>
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    width="451.847px" height="451.847px" viewBox="0 0 451.847 451.847" style="enable-background:new 0 0 451.847 451.847;"
                                    xml:space="preserve">
                                    <g>
                                        <path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751
                                            c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0
                                            c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z"/>
                                    </g>
                                </svg>
                            </button>

                            <div class="destination_list" visibile="false">
                                <button for="1" value="0" type="button" class="dest_selection">Select</button>
                                <button for="1" value="1" type="button" class="dest_selection">Amman</button>
                                <button for="1" value="2" type="button" class="dest_selection">Zarqa</button>
                                <button for="1" value="3" type="button" class="dest_selection">Irbid</button>
                                <button for="1" value="4" type="button" class="dest_selection">Ajloun</button>
                                <button for="1" value="5" type="button" class="dest_selection">Jarash</button>
                                <button for="1" value="6" type="button" class="dest_selection">Al Balqa</button>
                                <button for="1" value="7" type="button" class="dest_selection">Al Mafraq</button>
                                <button for="1" value="8" type="button" class="dest_selection">Madaba</button>
                                <button for="1" value="9" type="button" class="dest_selection">Al Tafele</button>
                                <button for="1" value="10" type="button" class="dest_selection">Al Karak</button>
                                <button for="1" value="11" type="button" class="dest_selection">Ma'an</button>
                                <button for="1" value="12" type="button" class="dest_selection">Aqaba</button>
                            </div>
                            
                            
                            <button class="remove_destination_button" type="button">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872
                                                c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872
                                                c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052
                                                L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116
                                                c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952
                                                c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116
                                                c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/>
                                        </g>
                                    </g>
                                </svg>
                            </button>
                        </div>

                        <button type="button" class="add_destination">
                            <span>Add destination</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" role="img" aria-labelledby="plusIconTitle" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none">
                                <path d="M20 12L4 12M12 4L12 20"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="create_form_input">
                        <input type="date" class="start_date_input" name="start_date">
                        <input type="date" class="end_date_input" name="end_date">

                        <label>Trip date</label>

                        <button class="date_button" id="trip_date_holder" type="button">
                            <span>
                                <span class="selected_start_date_holder">----/--/--</span> To <span class="selected_end_date_holder">----/--/--</span>
                            </span>

                            <div class="holder_arrow_nav">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="451.847px" height="451.847px" viewBox="0 0 451.847 451.847" style="enable-background:new 0 0 451.847 451.847;" xml:space="preserve">
                                    <g>
                                        <path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751   c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0   c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z"/>
                                    </g>
                                </svg>
                            </div>
                        </button>
                        
                        <div class="date_list" id="trip_date_list" visibility="hidden" calender_type="start">
                            <div class="calender_container">
                                <div class="calender_header">
                                    <div class="calender_name">Start date</div>
                                
                                <div class="nav_month_container">
                                    <button class="month_nav_left_wrapper" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="451.847px" height="451.847px" viewBox="0 0 451.847 451.847" style="enable-background:new 0 0 451.847 451.847;" xml:space="preserve">
                                            <g>
                                                <path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751   c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0   c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z"/>
                                            </g>
                                        </svg>
                                    </button>

                                    <div class="month_year_wrapper">
                                        <div class="month_year" id="start_date_month_year"></div>
                                    </div>

                                    <button class="month_nav_right_wrapper" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="451.847px" height="451.847px" viewBox="0 0 451.847 451.847" style="enable-background:new 0 0 451.847 451.847;" xml:space="preserve">
                                            <g>
                                                <path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751   c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0   c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z"/>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                </div>

                                <div class="days_names_wrapper">
                                    <div class="day_name">Su</div>
                                    <div class="day_name">Mo</div>
                                    <div class="day_name">Tu</div>
                                    <div class="day_name">We</div>
                                    <div class="day_name">Th</div>
                                    <div class="day_name">Fr</div>
                                    <div class="day_name">Sa</div>
                                </div>

                                <div class="days_wrapper" id="start_date_days_wrapper"></div>
                            </div>
                        </div>
                    </div>

                    <div class="create_form_input">
                        <label>Nights</label>
                        <input type="text" name="nights" class="nights_checkbox">

                        <button class="nights_button" type="button">
                                <span class="nights_holder">- days, - nights</span>
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    width="451.847px" height="451.847px" viewBox="0 0 451.847 451.847" style="enable-background:new 0 0 451.847 451.847;"
                                    xml:space="preserve">
                                    <g>
                                        <path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751
                                            c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0
                                            c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z"/>
                                    </g>
                                </svg>
                            </button>
                    
                        
                        <div class="nights_list" visibile="false"></div>
                    </div>

                    <div class="create_form_input">
                        <label>Images</label>
                        <input class='create_file_input' type='file' name='image[]' accept='.jpg, .jpeg, .png' multiple="true">

                        <div class="images_wrapper"></div>
                    </div>

                    <div class="create_form_input">
                        <label>Description</label>
                        <textarea name="description" class="description" rows="4"></textarea>
                    </div>

                    <div class="create_form_input">
                        <label>Description(العربية)</label>
                        <textarea name="description_ar" class="description description_ar" rows="4"></textarea>
                    </div>

                    <div class="create_form_input">
                        <label>Base price (USD)</label>
                        <input name="price" class="price_input"></input>
                    </div>

                    <div class="create_form_input">
                        <label>Aditional</label>
                        
                        <div class="aditional_input_wrapper">
                        <input type="checkbox" name="breakfast" id="breakfast" class="additional_checkbox">
                            <label for="breakfast">    
                                <div class="custom_checkbox">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M504.502,75.496c-9.997-9.998-26.205-9.998-36.204,0L161.594,382.203L43.702,264.311c-9.997-9.998-26.205-9.997-36.204,0
                                                    c-9.998,9.997-9.998,26.205,0,36.203l135.994,135.992c9.994,9.997,26.214,9.99,36.204,0L504.502,111.7
                                                    C514.5,101.703,514.499,85.494,504.502,75.496z"/>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                Breakfast(USD)
                            </label>
                            <input type="text" class="aditional_input" name="breakfast_price" disabled>
                        </div>

                        <div class="aditional_input_wrapper">
                            <input type="checkbox" name="lunch" id="lunch" class="additional_checkbox">
                            <label for="lunch">    
                                    <div class="custom_checkbox">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path d="M504.502,75.496c-9.997-9.998-26.205-9.998-36.204,0L161.594,382.203L43.702,264.311c-9.997-9.998-26.205-9.997-36.204,0
                                                        c-9.998,9.997-9.998,26.205,0,36.203l135.994,135.992c9.994,9.997,26.214,9.99,36.204,0L504.502,111.7
                                                        C514.5,101.703,514.499,85.494,504.502,75.496z"/>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    Lunch(USD)
                                </label>
                            <input type="text" class="aditional_input" name="lunch_price" disabled>
                        </div>

                        <div class="aditional_input_wrapper">
                            <input type="checkbox" name="dinner" id="dinner" class="additional_checkbox">
                            <label for="dinner">    
                                <div class="custom_checkbox">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M504.502,75.496c-9.997-9.998-26.205-9.998-36.204,0L161.594,382.203L43.702,264.311c-9.997-9.998-26.205-9.997-36.204,0
                                                    c-9.998,9.997-9.998,26.205,0,36.203l135.994,135.992c9.994,9.997,26.214,9.99,36.204,0L504.502,111.7
                                                    C514.5,101.703,514.499,85.494,504.502,75.496z"/>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                Dinner(USD)
                            </label>
                            <input type="text" class="aditional_input" name="dinner_price" disabled>
                        </div>
                    </div>

                    <div class="create_form_input">
                        <button type="button" id="cancel_create">Cancel</button>
                        <button>Create</button>
                    </div>
                </form>                                     
            </div>
        </div>
    </div>

    <script src="<?php echo URLROOT."\public\JS\config.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\CompanyIndex.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\Navigators.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\pop_ups.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\CreateTrip_popUp.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\UserMessages.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\Notifications.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\calender.js";?>"></script>
</body>
</html>

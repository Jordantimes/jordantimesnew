<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME?> - Government</title>
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Base.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Notifications.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\pop_ups.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\alerts.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\GovernmentIndex.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\sites.css";?>">
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

        <div class="pop_up_site_image_full_screen_view_container" condition="hidden">
            <div class="full_screen_image_container">
                <img class="full_screen_image" src="" alt="full screen view">
            </div>
        </div>

        <div class="pop_up_site_details_container" condition="hidden">
            <div class="pop_up_site_details">
                <!-- <form action="<?php echo URLROOT."/Customer/Book" ?>" method="GET"> -->
                    <div class="pop_up_close_button_wrapper">
                        <button class="close_button" id="pop_up_close" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872    c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872    c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052    L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116    c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952    c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116    c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/>
                                </g>
                            </g>
                            </svg>
                        </button>
                    </div>

                    <div class="site_company_info_popedup">
                        <div><img class="company_picture_popedup" src="" alt="company picture"></div>
                        <div>
                            <div class="company_name_popedup"></div>
                            <div class="site_created_at_popup"></div>
                        </div>
                    </div>

                    <div class="site_name_price_wrapper">
                        <div>
                            <div class="site_name_popedup"></div>
                            <div class="site_date_popedup">
                                <span class="site_start_date_popedup"></span>
                                <span>-</span>
                                <span class="site_end_date_popedup"></span>
                            </div>
                        </div>
                        <div class="site_price_popedup"></div>
                    </div>

                    <div class="site_images_preview_slider_wrapper">
                        <div class="site_images_preview_slider">
                            <div class="controlled_slider"></div>
                        </div>

                        <div class="slider_navigators_wrapper">
                            <div class="slider_navigators"></div>
                        </div>
                    </div>

                    <div class="site_description_wrapper">
                        <div class="site_description_popedup"></div>
                    </div>

                    <div class="site_additional_wrapper">
                        <div class="site_base_price_popedup"></div>
                        <div class="breakfast_price_popedup"></div>
                        <div class="lunch_price_popedup"></div>
                        <div class="dinner_price_popedup"></div>
                        <div class="total"></div>
                    </div>

                    <div class="passengers_container">
                        <h3>Passengers:</h3>
                        <div class="passengers_wrapper_popedup"></div>
                    </div>
                <!-- </form> -->
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

                <button class="navigation_button" <?php if($data["ViewBox"] === "Companys"){ echo "DisplayByURL='true'"; }?>>
                    <div class="navigation_button_text">Companys</div>
                    <div class="navigation_button_counter" id="companys_counter"></div>
                </button>

                <button class="navigation_button" <?php if($data["ViewBox"] === "Requests"){ echo "DisplayByURL='true'"; }?>>
                    <div class="navigation_button_text">Requests</div>
                    <div class="navigation_button_counter" id="requests_counter"></div>
                </button>

                <button class="navigation_button" <?php if($data["ViewBox"] === "Notifications"){ echo "DisplayByURL='true'"; }?>>
                    <div class="navigation_button_text">Notifications</div>
                    <div class="navigation_button_counter" id="notifications_counter"></div>
                </button>
            </div>

            <div class="content_view_container">
                <div class="content_view_box" id="trips_view_box">
                    <div class="content_view_box_data_container">
                        <?php if(count($data["Sites"]) > 0){ ?>
                            <div class="available_sites_wrapper">
                                <?php for ($i = 0 ; $i < count($data["Sites"]) ; ++$i) { ?>
                                    
                                    <button class="site" type="button" value="<?php echo $data["Sites"][$i]["id"]?>">
                                        <div class="site_image_wrapper">
                                            <?php
                                                for ($j=0; $j < count($data["Sites"][$i]["images"]) ; ++$j) { 
                                                    echo "<img src='".URLROOT."/public/images/users/trips/".$data["Sites"][$i]["images"][$j]."' alt='site_picture'>";
                                                }
                                            ?>
                                        </div>

                                        <div class="site_information_wrapper">
                                            <div class="site_header">
                                                <div class="site_header_left">
                                                    <div class="site_name"><?php echo $data["Sites"][$i]["name"]?></div>
                                                    <div class="site_company_info">
                                                    <div><?php echo "<img class='company_picture' src='".URLROOT."/public/images/users/companys/".$data["Sites"][$i]["image"]."' alt='company_picture'>"; ?></div>
                                                    <div>
                                                        <span class="company_name"><?php echo $data["Sites"][$i]["company_name"]?></span>
                                                        <span>.</span>
                                                        <span class="site_created_at"><?php echo $data["Sites"][$i]["created_at"]?></span>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="site_price">
                                                    USD<?php echo ($data["Sites"][$i]["price"]); ?>
                                                </div>
                                            </div>

                                            <div class="site_description_wrapper">
                                                <div class="site_description"><?php echo $data["Sites"][$i]["description"]?></div>
                                            </div>

                                            <div class="site_additional">
                                                <span class="breakfast_price"><?php echo $data["Sites"][$i]["breakfast"] ? $data["Sites"][$i]["breakfast_price"] : ""; ?></span>
                                                <span class="lunch_price"><?php echo $data["Sites"][$i]["lunch"] ? $data["Sites"][$i]["lunch_price"] : ""; ?></span>
                                                <span class="dinner_price"><?php echo $data["Sites"][$i]["dinner"] ? $data["Sites"][$i]["dinner_price"] : ""; ?></span>
                                                <span class="site_base_price"><?php echo $data["Sites"][$i]["price"]; ?></span>
                                                <span class="site_start_date"><?php echo $data["Sites"][$i]["start_date"]?></span>
                                                <span class="site_end_date"><?php echo $data["Sites"][$i]["end_date"]?></span>
                                                <span class="site_days"><?php echo $data["Sites"][$i]["days"]?></span>
                                                <span class="site_nights"><?php echo $data["Sites"][$i]["nights"]?></span>

                                                <div class="passengers_wrapper">
                                                    <table>
                                                        <tr>
                                                            <th></th>
                                                            <th>Name</th>
                                                            <th>Age</th>
                                                            <th>Phone</th>
                                                            <th>National ID</th>
                                                        </tr>
                                                        <?php for($j = 0 ; $j < count($data["Passengers"][$i]) ; ++$j){ ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $j+1; ?>
                                                                </td>

                                                                <td>
                                                                    <?php echo $data["Passengers"][$i][$j]["name"]; ?>
                                                                </td>

                                                                <td>
                                                                    <?php echo $data["Passengers"][$i][$j]["age"]; ?>
                                                                </td>

                                                                <td>
                                                                    <?php echo $data["Passengers"][$i][$j]["phone"]; ?>
                                                                </td>

                                                                <td>
                                                                    <?php echo $data["Passengers"][$i][$j]["nationID"]; ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="site_moredetails_wrapper">
                                                <div class="moredetails">More details</div>
                                            </div>
                                        </div>
                                    </button>
                                <?php } ?>
                            </div>
                        <?php } else{ ?>
                            <div class="empty_sites">
                                <div class="empty_sites_icon">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 330 330" style="enable-background:new 0 0 330 330;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <g>
                                                    <path d="M165,0.008C74.019,0.008,0,74.024,0,164.999c0,90.977,74.019,164.992,165,164.992s165-74.015,165-164.992     C330,74.024,255.981,0.008,165,0.008z M165,299.992c-74.439,0-135-60.557-135-134.992S90.561,30.008,165,30.008     s135,60.557,135,134.991C300,239.436,239.439,299.992,165,299.992z"/>
                                                    <path d="M165,130.008c-8.284,0-15,6.716-15,15v99.983c0,8.284,6.716,15,15,15s15-6.716,15-15v-99.983     C180,136.725,173.284,130.008,165,130.008z"/>
                                                    <path d="M165,70.011c-3.95,0-7.811,1.6-10.61,4.39c-2.79,2.79-4.39,6.66-4.39,10.61s1.6,7.81,4.39,10.61     c2.79,2.79,6.66,4.39,10.61,4.39s7.81-1.6,10.609-4.39c2.79-2.8,4.391-6.66,4.391-10.61s-1.601-7.82-4.391-10.61     C172.81,71.61,168.95,70.011,165,70.011z"/>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <span>Nothing is here...</span>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="content_view_box" id="companys_view_box">
                    <div class="companys_wrapper">
                        <?php for ($i=0; $i < count($data["Companys"]) ; ++$i) { ?>
                            <div class="company">
                                <div class="company_image_wrapper">
                                    <img src="<?php echo URLROOT."/public/Images/users/companys/".$data["Companys"][$i]["image"]?>" alt="company profie image">
                                </div>

                                <h3 class="company_name_wrapper"><?php echo $data["Companys"][$i]["name"]?></h3>

                                <div class="company_info_wrapper">
                                    <span class="company_info"><span>C ID: </span><?php echo $data["Companys"][$i]["company_ID"]?></span>
                                    <span class="company_info"><span>C Number: </span><?php echo $data["Companys"][$i]["company_Number"]?></span>
                                    <span class="company_info"><span>C E-mail: </span> <a href="mailto:<?php echo $data["Companys"][$i]["email"]?>"><?php echo $data["Companys"][$i]["email"]?></a></span>
                                    <span class="company_info"><span>C Phone number: </span><?php echo $data["Companys"][$i]["phone"]?></span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="content_view_box" id="requests_view_box">
                    <div class="view_box_search_container">
                        <input type="text" placeholder="Search by name or number..." class="gov_search_input" id="requests_search_input">
                        <button type="submit" class="gov_search_button" id="requests_search_button">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512.005 512.005" style="enable-background:new 0 0 512.005 512.005;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M505.749,475.587l-145.6-145.6c28.203-34.837,45.184-79.104,45.184-127.317c0-111.744-90.923-202.667-202.667-202.667    S0,90.925,0,202.669s90.923,202.667,202.667,202.667c48.213,0,92.48-16.981,127.317-45.184l145.6,145.6    c4.16,4.16,9.621,6.251,15.083,6.251s10.923-2.091,15.083-6.251C514.091,497.411,514.091,483.928,505.749,475.587z     M202.667,362.669c-88.235,0-160-71.765-160-160s71.765-160,160-160s160,71.765,160,160S290.901,362.669,202.667,362.669z"/>
                                    </g>
                                </g>
                                <g>
                            </svg>
                        </button>
                    </div>   

                    <div class="refresh_button_container">
                        <button class="refresh_button" id="refresh_requests">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 489.533 489.533" style="enable-background:new 0 0 489.533 489.533;" xml:space="preserve">
                                <g>
                                    <path d="M268.175,488.161c98.2-11,176.9-89.5,188.1-187.7c14.7-128.4-85.1-237.7-210.2-239.1v-57.6c0-3.2-4-4.9-6.7-2.9   l-118.6,87.1c-2,1.5-2,4.4,0,5.9l118.6,87.1c2.7,2,6.7,0.2,6.7-2.9v-57.5c87.9,1.4,158.3,76.2,152.3,165.6   c-5.1,76.9-67.8,139.3-144.7,144.2c-81.5,5.2-150.8-53-163.2-130c-2.3-14.3-14.8-24.7-29.2-24.7c-17.9,0-31.9,15.9-29.1,33.6   C49.575,418.961,150.875,501.261,268.175,488.161z"/>
                                </g>
                            </svg>
                        </button>       
                    </div>                 

                    <div class="content_view_box_data_container">
                        <div class="content_view_box_information" id="requests_information"></div>

                        <table class="requests_table" id="requests_table"></table>

                        <div class="view_more_container" id="requests_view_more"></div>
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
    <script src="<?php echo URLROOT."\public\JS\GovernmentIndex.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\Navigators.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\pop_ups.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\UserMessages.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\Notifications.js";?>"></script>

</body>
</html>

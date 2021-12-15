<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME?> - Customer</title>
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Base.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\sites.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Navigators.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\pop_ups.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\alerts.css";?>">

    <style>
        .decline_trip:hover,.accept_trip:hover{
            text-decoration: underline;
        }

        .decline_trip,.accept_trip{
            display: inline-block;
            padding: 7px 28px;
            border-radius: 50px;
            background-color: #f05d5e;
            color: #ffffff;
            font-family: inherit;
            font-size: 16px;
            margin-left: 12px;
            border: none;
            cursor: pointer;
        }

        .decline_trip{
            background-color: transparent;
            color: #000000;
            border: 1px #000000 solid
        }
    </style>
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

                <div style="display:flex; justify-content:flex-end;">
                    <button class="decline_trip">Decline</button>
                    <button class="accept_trip">Accept</button>
                </div>
            </div>
        </div>

        <?php require_once APPROOT."\Views\INCLUDES\Header.php"; ?>

        <div class="content">
            <div class="alert_container"></div>

            <div class="navigation_bar">
                <button class="navigation_button" <?php if($data["ViewBox"] === "Trips"){ echo "DisplayByURL='true'"; }?>>
                    <div class="navigation_button_text">UnVerified Trips</div>
                    <div class="navigation_button_counter" id="trips_counter"></div>
                </button>

            </div>

            <div class="content_view_container">
                <div class="content_view_box" id="trips_view_box">
                </div>
            </div>
        </div>

        <?php require_once APPROOT."\Views\INCLUDES\Footer.php"; ?>
    </div>

    <script src="<?php echo URLROOT."\public\JS\config.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\pop_ups.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\UserMessages.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\admin.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\Navigators.js";?>"></script>
    
</body>
</html>
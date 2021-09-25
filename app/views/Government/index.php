<?php
    session_start();

    if(empty($_SESSION["Government"])){
        header("location:".URLROOT."/User/LogIn");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME?>Government</title>
    <link rel="stylesheet" href="CSS/Base.css">
    <link rel="stylesheet" href="CSS/GovernmentIndex.css">
</head>
<body>
    <!-- <?php 
        print_r(unserialize($_SESSION["Government"]));
    ?> -->

    <div class="main_view">
        <div class="content">
            <div class="alert_container">
                <div class="alert" id="error_alert">
                    <div class="alert_title">
                        Something went wrong...
                    </div>
                    <div class="alert_icon_container" id="error_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872    c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872    c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052    L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116    c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952    c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116    c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/>
                                </g>
                            </g>
                            <g>
                        </svg>
                    </div>
                </div>

                <div class="alert" id="accepted_alert">
                    <div class="alert_title">
                        Company accepted
                    </div>

                    <div class="alert_icon_container">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M504.502,75.496c-9.997-9.998-26.205-9.998-36.204,0L161.594,382.203L43.702,264.311c-9.997-9.998-26.205-9.997-36.204,0    c-9.998,9.997-9.998,26.205,0,36.203l135.994,135.992c9.994,9.997,26.214,9.99,36.204,0L504.502,111.7    C514.5,101.703,514.499,85.494,504.502,75.496z"/>
                                </g>
                            </g>
                            <g>
                        </svg>
                    </div>
                </div>
                
                <div class="alert" id="declined_alert">
                    <div class="alert_title">
                        Company declined
                    </div>
                    <div class="alert_icon_container">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872    c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872    c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052    L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116    c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952    c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116    c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/>
                                </g>
                            </g>
                            <g>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="content_container">
                <div class="navigation_bar_container">
                    <div class="navigation_bar">
                        <div class="navigation_header_container">
                            <h3>Navigation</h3>
                        </div>
                        <div class="navigation_buttons_container">
                            <button class="navigation_button">Overview</button>
                            <button class="navigation_button">Requests</button>
                            <button class="navigation_button">Messeges</button>
                            <button class="navigation_button">Notifications</button>
                        </div>
                    </div>
                </div>

                <div class="content_view_container">
                    <div class="content_view_box" id="overview_view_box">
                        <div class="content_view_box_header">
                                <h3>Dashboard overview</h3>
                        </div>

                        <div class="grid_container">
                            <div class="overview_item">
                                <div class="overview_item_header">
                                    <h4>New requests</h4>
                                </div>

                                <div class="overview_item_data" id="requests_count">
                                    <div class="overview_count" id="requests_count_overview"></div>
                                    <div class="overview_info"  id="requests_count_overview_information"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="content_view_box" id="requests_view_box">
                        <div class="content_view_box_header">
                            <h3>Companys requests</h3>
                        </div>

                        <div class="content_view_box_data_container">
                            <div class="content_view_box_information" id="requests_information"></div>

                            <table class="content_table" id="requests_table"></table>

                            <div class="ViewIndexContainer" id="requests_indexes">
                                <div class="first" id="request_first_index"></div>
                                <div class="space" id="request_space_index_1"></div>
                                <div class="mid" id="request_mid_index"></div>
                                <div class="space" id="request_space_index_2"></div>
                                <div class="last" id="request_last_index"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="JS/config.js"></script>
    <script src="JS/GovernmentIndex.js"></script>
</body>
</html>

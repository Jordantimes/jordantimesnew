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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME?> - Sites</title>
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Base.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\sites.css";?>">

</head>
<body>
    <div class="main_view">
        <div class="pop_up_site_image_full_screen_view_container" condition="hidden">
            <div class="full_screen_image_container">
                <img class="full_screen_image" src="" alt="full screen view">
            </div>
        </div>

        <div class="pop_up_site_details_container" condition="hidden">
            <div class="pop_up_site_details">
                <div class="pop_up_close_button_wrapper">
                    <button class="close_button" id="pop_up_close">
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
                    <div class="site_name">Mercure Istanbul Altunizade</div>
                    <div class="site_price">
                        <span class="currency">USD</span>184
                    </div>
                </div>

                <div class="site_images_preview_slider_wrapper">
                    <div class="site_images_preview_slider">
                        <div class="controlled_slider">
                            <div class="preview_image_container"><img class="preview_image" src="../../Assets/Images/Index/hotels/hotel2.jpg" alt=""></div>
                            <div class="preview_image_container"><img class="preview_image" src="../../Assets/Images/Index/hotels/hotel_preview1.jpg" alt=""></div>
                            <div class="preview_image_container"><img class="preview_image" src="../../Assets/Images/Index/hotels/hotel_preview2.jpg" alt=""></div>
                            <div class="preview_image_container"><img class="preview_image" src="../../Assets/Images/Index/hotels/hotel_preview3.jpg" alt=""></div>
                            <div class="preview_image_container"><img class="preview_image" src="../../Assets/Images/Index/hotels/hotel_preview4.jpg" alt=""></div>
                            <div class="preview_image_container"><img class="preview_image" src="../../Assets/Images/Index/hotels/hotel_preview5.jpg" alt=""></div>
                            <div class="preview_image_container"><img class="preview_image" src="../../Assets/Images/Index/hotels/hotel_preview6.jpg" alt=""></div>
                            <div class="preview_image_container"><img class="preview_image" src="../../Assets/Images/Index/hotels/hotel_preview7.jpg" alt=""></div>
                            <div class="preview_image_container"><img class="preview_image" src="../../Assets/Images/Index/hotels/hotel_preview8.jpg" alt=""></div>
                            <div class="preview_image_container"><img class="preview_image" src="../../Assets/Images/Index/hotels/hotel_preview9.jpg" alt=""></div>
                            <div class="preview_image_container"><img class="preview_image" src="../../Assets/Images/Index/hotels/hotel_preview10.jpg" alt=""></div>
                        </div>
                    </div>

                    <div class="slider_navigators_wrapper">
                        <div class="slider_navigators"></div>
                    </div>
                </div>

                <div class="site_description_wrapper">
                    <div class="site_description_popedup">
                        With a stay at Mercure Istanbul Altunizade in Istanbul (Uskudar), you'll be a 4-minute drive from Maiden's Tower and 6 minutes from Bagdat Avenue.  This 4-star hotel is 5.3 mi (8.5 km) from Dolmabahce Palace and 6.1 mi (9.9 km) from Bosphorus Bridge.
                        Enjoy a range of recreational amenities, including a health club, an indoor pool, and a sauna. Additional amenities at this hotel include complimentary wireless Internet access, concierge services, and a television in a common area.
                        Make yourself at home in one of the 140 air-conditioned rooms featuring fireplaces and plasma televisions. Complimentary wireless Internet access keeps you connected, and cable programming is available for your entertainment. Conveniences include phones, as well as safes and desks.
                    </div>
                </div>

                <div class="checkin_wrapper">
                    <button class="check_in">Check in</button>
                </div>
            </div>
        </div>

        <?php require_once APPROOT."\Views\INCLUDES\Header.php"; ?>

        <form class="filter_form" action="#" method="GET">
            <div class="content_container" id="view_sites">
                <div class="filter_section_wrapper">
                        <div class="main_trip_values_section">
                            <div class="input_wrapper" id="passenger_input_wrapper">
                                <button class="value_holder" id="passenger_count_holder" type="button">
                                    <div class="holder_icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M443.383,225.513c-1.87-1.861-4.441-2.93-7.07-2.93c-2.64,0-5.21,1.069-7.07,2.93c-1.87,1.86-2.939,4.44-2.939,7.07    c0,2.63,1.069,5.21,2.939,7.069c1.851,1.86,4.431,2.931,7.07,2.931c2.63,0,5.21-1.07,7.07-2.931    c1.859-1.859,2.93-4.439,2.93-7.069C446.313,229.953,445.243,227.373,443.383,225.513z"/>
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path d="M476.747,20.661c-6.711-10.22-17-17.215-28.972-19.695c-11.967-2.479-24.192-0.152-34.411,6.56    c-10.22,6.711-17.215,17-19.695,28.972l-1.064,5.137c-7.764-22.803-29.375-39.258-54.771-39.258    c-31.902,0-57.855,25.954-57.855,57.855v8.701c0,16.646,7.076,31.663,18.366,42.227c-4.154,1.615-8.174,3.666-11.988,6.171    c-14.214,9.334-23.942,23.644-27.406,40.354l-8.159,40.65l-18.75,18.857h-78.055c-17.842,0-32.357,14.516-32.357,32.357    c0,4.375,0.877,8.547,2.458,12.357h-8.106c-18.792,0-35.227,12.701-39.965,30.888l-11.803,45.298    c-1.393,5.345,1.811,10.806,7.155,12.198c0.846,0.221,1.693,0.326,2.528,0.326c4.441-0.001,8.498-2.982,9.67-7.481l11.803-45.298    c2.444-9.38,10.921-15.931,20.612-15.931h146.491c2.67,0,5.229-1.067,7.106-2.965l50.624-51.142    c3.886-3.925,3.854-10.257-0.071-14.142c-3.926-3.887-10.257-3.854-14.142,0.071l-47.689,48.177H153.987    c-6.813,0-12.357-5.544-12.357-12.357c0-6.813,5.544-12.357,12.357-12.357h82.214c2.662,0,5.214-1.062,7.091-2.949l57.241-57.57    c3.895-3.916,3.876-10.248-0.04-14.143c-3.917-3.893-10.248-3.877-14.142,0.041l-10.003,10.061l2.198-10.949    c2.366-11.419,9.039-21.233,18.788-27.635c9.748-6.401,21.406-8.624,32.82-6.256c11.419,2.366,21.233,9.038,27.634,18.785    c6.401,9.748,8.623,21.404,6.257,32.823c-0.016,0.075-0.021,0.149-0.035,0.224L338.94,300.595    c-2.872,13.855-15.227,23.912-29.376,23.912H167.402c-23.447,0-43.087,18.059-45.509,40.99c-0.194,0.455-0.368,0.922-0.496,1.415    l-30.63,117.561c-1.154,4.431-5.159,7.525-9.738,7.525H57.804c-3.141,0-6.043-1.425-7.963-3.91    c-1.921-2.484-2.567-5.652-1.776-8.69l16.701-64.101c1.393-5.345-1.812-10.806-7.155-12.198    c-5.346-1.396-10.806,1.811-12.198,7.155l-16.701,64.101c-2.365,9.078-0.432,18.542,5.305,25.964    c5.736,7.423,14.407,11.68,23.788,11.68h23.224c13.681,0,25.644-9.246,29.092-22.483l23.196-89.03    c0.459,0.51,0.926,1.015,1.41,1.509c8.764,8.933,20.932,14.056,33.383,14.056h48.678l-34.199,82.104    c-1.285,3.086-0.943,6.61,0.911,9.393c1.854,2.781,4.977,4.452,8.32,4.452h154.263c3.344,0,6.466-1.671,8.32-4.452    c1.854-2.782,2.196-6.307,0.911-9.393l-34.199-82.104h50.129c21.59,0,40.438-15.344,44.818-36.483l21.891-105.633    c1.121-5.408-2.354-10.7-7.763-11.821c-5.404-1.115-10.7,2.354-11.821,7.763l-21.891,105.634    c-2.466,11.902-13.079,20.541-25.235,20.541H168.109c-7.115,0-14.079-2.938-19.106-8.063c-4.881-4.975-7.497-11.443-7.368-18.215    c0.267-13.932,11.826-25.267,25.768-25.267h142.163c23.583,0,44.173-16.761,48.959-39.853l54.729-264.099    c1.396-6.741,5.335-12.534,11.089-16.313c5.755-3.777,12.637-5.088,19.376-3.692c6.741,1.396,12.534,5.335,16.313,11.089    c3.778,5.754,5.09,12.636,3.692,19.376l-29.713,143.38c-1.121,5.408,2.354,10.7,7.763,11.821    c5.406,1.121,10.701-2.354,11.821-7.763l29.713-143.38C485.788,43.101,483.459,30.881,476.747,20.661z M299.448,416.05    l31.636,75.949H206.817l31.636-75.949H299.448z M337.833,106.787c-20.874,0-37.855-16.982-37.855-37.855v-8.701    c0-20.874,16.982-37.856,37.855-37.856c20.874,0,37.855,16.982,37.855,37.856v8.701    C375.689,89.805,358.707,106.787,337.833,106.787z M373.449,134.074c-3.309-4.739-7.174-8.958-11.515-12.565    c6.146-2.829,11.717-6.696,16.479-11.388L373.449,134.074z"/>
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path d="M71.947,368.141c-1.859-1.859-4.439-2.93-7.07-2.93c-2.63,0-5.21,1.07-7.069,2.93c-1.86,1.87-2.931,4.44-2.931,7.07    c0,2.64,1.07,5.21,2.931,7.07c1.859,1.869,4.439,2.93,7.069,2.93c2.631,0,5.2-1.061,7.07-2.93c1.86-1.851,2.93-4.431,2.93-7.07    C74.877,372.581,73.808,370.001,71.947,368.141z"/>
                                                    </g>
                                                </g>
                                            </svg>
                                    </div>
                                    <div class="holder_text">
                                        <span class="passenger_counter"><?php echo $data["passengers"]; ?></span> 
                                        Passenger(s)
                                    </div>

                                    <div class="holder_arrow_nav">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="451.847px" height="451.847px" viewBox="0 0 451.847 451.847" style="enable-background:new 0 0 451.847 451.847;" xml:space="preserve">
                                            <g>
                                                <path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751   c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0   c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z"/>
                                            </g>
                                        </svg>
                                    </div>
                                </button>
                                
                                <div class="holder_select_list" id="passsenger_count_list" visibility="hidden">
                                    <div class="option">
                                        <button class="passenger_click" type="button">
                                            <label>
                                                1 Passenger
                                            </label>
                                        </button>
                                    </div>
        
                                    <div class="option">
                                        <button class="passenger_click" type="button">
                                            <label>
                                                2 Passengers
                                            </label>
                                        </button>
                                    </div>
        
                                    <div class="option">
                                        <button class="passenger_click" type="button">
                                            <label>
                                                3 Passengers
                                            </label>
                                        </button>
                                    </div>
        
                                    <div class="option">
                                        <button class="passenger_click" type="button">
                                            <label>
                                                4 Passengers
                                            </label>
                                        </button>
                                    </div>
        
                                    <div class="option">
                                        <button class="passenger_click" type="button">
                                            <label>
                                                5 Passengers
                                            </label>
                                        </button>
                                    </div>
        
                                    <div class="option">
                                        <button class="passenger_click" type="button">
                                            <label>
                                                6 Passengers
                                            </label>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="input_wrapper" id="locations_input_wrapper">
                                <button class="value_holder" id="locations_holder" type="button">
                                    <div class="holder_icon">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 423.137 423.137" style="enable-background:new 0 0 423.137 423.137;" xml:space="preserve">
                                        <g>
                                            <path d="M323.823,189.154c0-19.335-15.73-35.066-35.066-35.066s-35.066,15.73-35.066,35.066s15.73,35.066,35.066,35.066   S323.823,208.49,323.823,189.154z M268.692,189.154c0-11.064,9.001-20.066,20.066-20.066s20.066,9.001,20.066,20.066   s-9.001,20.066-20.066,20.066S268.692,200.219,268.692,189.154z"/>
                                            <path d="M387.81,0H72.431c-2.306,0-4.571,0.176-6.784,0.515c-21.387,3.277-37.82,21.8-37.82,44.088v333.931   c0,24.594,20.009,44.603,44.604,44.603h72.52c10.085,0,19.395-3.368,26.875-9.033c0.325-0.213,0.632-0.461,0.928-0.73   c6.184-4.945,11.027-11.495,13.891-19.017H387.81c4.142,0,7.5-3.358,7.5-7.5V7.5C395.31,3.358,391.952,0,387.81,0z M77.609,74.207   c1.001-6.05,3.844-11.622,8.268-16.041c5.583-5.591,13.013-8.669,20.923-8.669h67.343c-2.34,14.002-14.536,24.71-29.192,24.71   H77.609z M72.431,15h72.52c1.53,0,3.034,0.117,4.502,0.342c10.79,1.653,19.679,9.154,23.323,19.155H106.8   c-11.92,0-23.12,4.642-31.53,13.063c-6.862,6.853-11.213,15.554-12.593,24.989c-11.544-4.041-19.85-15.038-19.85-27.945   C42.827,28.28,56.108,15,72.431,15z M42.827,77.927c7.882,7.01,18.251,11.279,29.604,11.279h14.72l65.772,65.771L42.827,265.073   V77.927z M174.554,378.534c0,7.124-2.53,13.668-6.739,18.781l-67.313-67.313c-2.929-2.929-7.678-2.929-10.606,0   c-2.929,2.929-2.929,7.678,0,10.606l65.585,65.585c-3.274,1.251-6.823,1.943-10.531,1.943h-72.52   c-16.323,0-29.604-13.28-29.604-29.603V293.54l19.07,19.07c1.464,1.464,3.384,2.197,5.303,2.197s3.839-0.732,5.303-2.197   c2.929-2.929,2.929-7.678,0-10.606l-22.697-22.697L83.7,245.413l90.854,90.854V378.534z M174.554,268.036   c-0.001,0.061-0.001,0.121,0,0.182v46.836l-80.248-80.248l69.222-69.222l11.025,11.025V268.036z M174.554,155.397l-66.191-66.19   h36.587c11.352,0,21.722-4.27,29.604-11.28V155.397z M178.275,15h84.946l-73.667,73.672V44.603   C189.554,33.251,185.285,22.882,178.275,15z M243.16,222.292c-16.401-22.569-13.988-53.268,5.74-72.996   c10.989-10.989,25.423-16.483,39.858-16.483s28.869,5.495,39.858,16.483c19.728,19.728,22.142,50.427,5.74,72.996l-45.598,62.742   L243.16,222.292z M265.03,277.899l-75.475,75.467v-82.139l40.914-40.922c0.188,0.267,0.366,0.54,0.558,0.805L265.03,277.899z    M238.293,138.69c-12.007,12.007-19.352,27.942-20.683,44.87c-0.893,11.362,0.972,22.701,5.305,33.086l-33.361,33.367V109.88   l11.989-11.983l38.823,38.823C239.668,137.365,238.971,138.012,238.293,138.69z M189.554,379.357v-4.778l84.404-84.395   l8.733,12.016c1.411,1.942,3.667,3.091,6.067,3.091s4.656-1.149,6.067-3.091l6.916-9.516l52.234,52.24l-34.441,34.433H189.554z    M380.31,379.357h-39.56l23.831-23.826l15.729,15.731V379.357z M380.31,350.047l-69.641-69.648l30.883-42.494l38.758,38.758   V350.047z M380.31,255.45l-30.072-30.072c7.402-12.568,10.819-27.176,9.668-41.818c-1.331-16.928-8.677-32.863-20.684-44.87   c-2.079-2.079-4.266-3.984-6.526-5.752l47.614-47.614V255.45z M380.31,64.11l-60.701,60.702   c-21.272-10.175-46.572-9.234-67.087,2.85l-40.37-40.37L284.434,15h95.876V64.11z"/>
                                            <path d="M79.482,313.706c-1.429,0.305-2.805,0.996-3.83,2.05c-2.925,2.843-2.862,7.75,0,10.6c2.862,2.851,7.749,2.933,10.6,0   c2.896-2.815,2.901-7.784,0-10.6C84.54,313.992,81.878,313.212,79.482,313.706C79.012,313.806,80.452,313.506,79.482,313.706z"/>
                                        </g>
                                    </svg>
                                    </div>
                                    <div class="holder_text">
                                        <span class="start_location_holder"><?php echo $data["start_location_name"]; ?></span> To <span class="end_location_holder"><?php echo $data["end_location_name"]; ?></span>
                                    </div>

                                    <div class="holder_arrow_nav">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="451.847px" height="451.847px" viewBox="0 0 451.847 451.847" style="enable-background:new 0 0 451.847 451.847;" xml:space="preserve">
                                            <g>
                                                <path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751   c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0   c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z"/>
                                            </g>
                                        </svg>
                                    </div>
                                </button>
                                
                                <div class="holder_select_list" id="locations_list" visibility="hidden" location_type="start">
                                    <div class="option">
                                        <button class="location_click" type="button">
                                            <label>
                                                Amman
                                            </label>
                                        </button>
                                    </div>
        
                                    <div class="option">
                                        <button class="location_click" type="button">
                                            <label>
                                                Zarqa
                                            </label>
                                        </button>
                                    </div>
        
                                    <div class="option">
                                        <button class="location_click" type="button">
                                            <label>
                                                Irbid
                                            </label>
                                        </button>
                                    </div>
        
                                    <div class="option">
                                        <button class="location_click" type="button">
                                            <label>
                                                Ajloun
                                            </label>
                                        </button>
                                    </div>
        
                                    <div class="option">
                                        <button class="location_click" type="button">
                                            <label>
                                                Jarash
                                            </label>
                                        </button>
                                    </div>
        
                                    <div class="option">
                                        <button class="location_click" type="button">
                                            <label>
                                                Al Balqa
                                            </label>
                                        </button>
                                    </div>

                                    <div class="option">
                                        <button class="location_click" type="button">
                                            <label>
                                                Al Mafraq
                                            </label>
                                        </button>
                                    </div>

                                    <div class="option">
                                        <button class="location_click" type="button">
                                            <label>
                                                Madaba
                                            </label>
                                        </button>
                                    </div>

                                    <div class="option">
                                        <button class="location_click" type="button">
                                            <label>
                                                Al Tafele
                                            </label>
                                        </button>
                                    </div>

                                    <div class="option">
                                        <button class="location_click" type="button">
                                            <label>
                                                Al Karak
                                            </label>
                                        </button>
                                    </div>

                                    <div class="option">
                                        <button class="location_click" type="button">
                                            <label>
                                                Ma'an
                                            </label>
                                        </button>
                                    </div>

                                    <div class="option">
                                        <button class="location_click" type="button">
                                            <label>
                                                Aqaba
                                            </label>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="input_wrapper" id="date_input_wrapper">
                                <button class="value_holder" id="trip_date_holder" type="button">
                                    <div class="holder_icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512"><g><path d="m391.017 251.454h35.714c8.074 0 14.643-6.569 14.643-14.643v-35.714c0-8.074-6.569-14.643-14.643-14.643h-35.714c-8.074 0-14.643 6.569-14.643 14.643v35.714c0 8.074 6.569 14.643 14.643 14.643zm.357-50h35v35h-35zm-.357 145h35.714c8.074 0 14.643-6.569 14.643-14.643v-35.714c0-8.074-6.569-14.643-14.643-14.643h-35.714c-8.074 0-14.643 6.569-14.643 14.643v35.714c0 8.074 6.569 14.643 14.643 14.643zm.357-50h35v35h-35zm-102.273-45h35.714c8.074 0 14.643-6.569 14.643-14.643v-35.714c0-8.074-6.569-14.643-14.643-14.643h-35.714c-8.074 0-14.643 6.569-14.643 14.643v35.714c0 8.074 6.569 14.643 14.643 14.643zm.357-50h35v35h-35zm-168.475 170.546h-35.714c-8.074 0-14.643 6.569-14.643 14.643v35.714c0 8.074 6.569 14.643 14.643 14.643h35.714c8.074 0 14.643-6.569 14.643-14.643v-35.714c0-8.074-6.569-14.643-14.643-14.643zm-.357 50h-35v-35h35zm.357-235.546h-35.714c-8.074 0-14.643 6.569-14.643 14.643v35.714c0 8.074 6.569 14.643 14.643 14.643h35.714c8.074 0 14.643-6.569 14.643-14.643v-35.714c0-8.075-6.569-14.643-14.643-14.643zm-.357 50h-35v-35h35zm168.475 107.773h35.714c8.074 0 14.643-6.569 14.643-14.643v-35.714c0-8.074-6.569-14.643-14.643-14.643h-35.714c-8.074 0-14.643 6.569-14.643 14.643v35.714c0 8.074 6.569 14.643 14.643 14.643zm.357-50h35v35h-35zm159.365-259.953h-32.066v-11.467c0-12.576-10.231-22.807-22.807-22.807h-3.444c-12.575 0-22.806 10.231-22.806 22.807v11.467h-223.4v-11.467c0-12.576-10.231-22.807-22.807-22.807h-3.444c-12.576 0-22.807 10.231-22.807 22.807v11.467h-32.065c-20.705 0-37.55 16.845-37.55 37.55v402.676c0 20.678 16.822 37.5 37.5 37.5h385.748c20.678 0 37.5-16.822 37.5-37.5v-402.676c-.001-20.705-16.846-37.55-37.552-37.55zm-66.123-11.467c0-4.305 3.502-7.807 7.807-7.807h3.444c4.305 0 7.807 3.502 7.807 7.807v11.467h-19.058zm-272.457 0c0-4.305 3.502-7.807 7.807-7.807h3.444c4.305 0 7.807 3.502 7.807 7.807v11.467h-19.057v-11.467zm361.131 451.693c0 12.407-10.093 22.5-22.5 22.5h-385.748c-12.407 0-22.5-10.093-22.5-22.5v-.047c6.284 4.735 14.095 7.547 22.551 7.547h304.083c10.03 0 19.46-3.906 26.552-10.999l77.562-77.562zm-85.215-17.059c.588-2.427.908-4.958.908-7.563v-50.064c0-9.44 7.681-17.121 17.122-17.121h50.063c2.605 0 5.136-.32 7.563-.908zm85.215-315.987h-319.574c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h319.574v194.118c0 9.441-7.681 17.122-17.122 17.122h-50.063c-17.712 0-32.122 14.41-32.122 32.121v50.064c0 9.441-7.681 17.122-17.121 17.122h-291.769c-12.434 0-22.55-10.116-22.55-22.551v-287.996h81.173c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-81.174v-69.63c0-12.434 10.116-22.55 22.55-22.55h32.066v22.052c0 12.576 10.231 22.807 22.807 22.807 4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5c-4.305 0-7.807-3.502-7.807-7.807v-22.052h257.458v22.052c0 12.576 10.231 22.807 22.807 22.807 4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5c-4.305 0-7.807-3.502-7.807-7.807v-22.052h66.124c12.434 0 22.55 10.116 22.55 22.55zm-350.391 137.773h-35.714c-8.074 0-14.643 6.569-14.643 14.643v35.714c0 8.074 6.569 14.643 14.643 14.643h35.714c8.074 0 14.643-6.569 14.643-14.643v-35.714c0-8.075-6.569-14.643-14.643-14.643zm-.357 50h-35v-35h35zm66.559-77.773h35.714c8.074 0 14.643-6.569 14.643-14.643v-35.714c0-8.074-6.569-14.643-14.643-14.643h-35.714c-8.074 0-14.643 6.569-14.643 14.643v35.714c0 8.074 6.569 14.643 14.643 14.643zm.357-50h35v35h-35zm101.907 220.546c-.186-3.977-3.469-7.143-7.492-7.143-4.142 0-7.5 3.358-7.5 7.5 0 8.074 6.569 14.643 14.643 14.643h35.714c8.074 0 14.643-6.569 14.643-14.643v-35.714c0-8.074-6.569-14.643-14.643-14.643h-35.714c-8.074 0-14.643 6.569-14.643 14.643v10.3c0 4.142 3.358 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-9.943h35v35zm-102.264-77.773h35.714c8.074 0 14.643-6.569 14.643-14.643v-35.714c0-8.074-6.569-14.643-14.643-14.643h-35.714c-8.074 0-14.643 6.569-14.643 14.643v35.714c0 8.074 6.569 14.643 14.643 14.643zm.357-50h35v35h-35zm-.357 142.773h35.714c8.074 0 14.643-6.569 14.643-14.643v-35.714c0-8.074-6.569-14.643-14.643-14.643h-35.714c-8.074 0-14.643 6.569-14.643 14.643v35.714c0 8.074 6.569 14.643 14.643 14.643zm.357-50h35v35h-35z"/></g>
                                        </svg>
                                    </div>
                                    <div class="holder_text">
                                        <span class="selected_start_date_holder"><?php echo $data["start_date"] != "----/--/--" ? $data["start_date"] : "----/--/--"?></span> To <span class="selected_end_date_holder"><?php echo $data["end_date"] != "----/--/--" ? $data["end_date"] : "----/--/--"?></span>
                                    </div>

                                    <div class="holder_arrow_nav">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="451.847px" height="451.847px" viewBox="0 0 451.847 451.847" style="enable-background:new 0 0 451.847 451.847;" xml:space="preserve">
                                            <g>
                                                <path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751   c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0   c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z"/>
                                            </g>
                                        </svg>
                                    </div>
                                </button>
                                
                                <div class="holder_select_list" id="trip_date_list" visibility="hidden" calender_type="start">
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
                        </div>

                        <input id="passenger_radio" type="radio" name="p" value="1" <?php echo $data["passengers"] == "1" ? "checked" : ""; ?>>
                        <input id="passenger_radio" type="radio" name="p" value="2" <?php echo $data["passengers"] == "2" ? "checked" : ""; ?>>
                        <input id="passenger_radio" type="radio" name="p" value="3" <?php echo $data["passengers"] == "3" ? "checked" : ""; ?>>
                        <input id="passenger_radio" type="radio" name="p" value="4" <?php echo $data["passengers"] == "4" ? "checked" : ""; ?>>
                        <input id="passenger_radio" type="radio" name="p" value="5" <?php echo $data["passengers"] == "5" ? "checked" : ""; ?>>
                        <input id="passenger_radio" type="radio" name="p" value="6" <?php echo $data["passengers"] == "6" ? "checked" : ""; ?>>

                        <input type="text" class="start_location_input" name="sl" value="<?php echo $data["start_location"] != "-" ? $data["start_location"] : ""?>">
                        <input type="text" class="end_location_input" name="el" value="<?php echo $data["end_location"] != "-" ? $data["end_location"] : ""?>">

                        <input type="date" class="start_date_input" name="sd" value="<?php echo $data["start_date"] != "----/--/--" ? $data["start_date"] : ""?>">
                        <input type="date" class="end_date_input" name="ed" value="<?php echo $data["end_date"] != "----/--/--" ? $data["end_date"] : ""?>">

                        <button type="submit" class="filter_form_submit_button">Apply filter</button>
                </div>

                <div class="sites_section_wrapper">
                    <div class="available_sites_wrapper">
                        <button class="site">
                            <div class="site_image_wrapper" style="background-image: url(../../Assets/Images/Index/hotels/hotel1.jpg);"></div>

                            <div class="site_information_wrapper">
                                <div class="site_name_price_wrapper">
                                    <div class="site_name">Grand Hotel De Pera</div>
                                    <div class="site_price">
                                        <span class="currency">USD</span>178
                                    </div>
                                </div>

                                <div class="site_description_wrapper">
                                    <div class="site_description">
                                        With a stay at Grand Hotel De Pera, you'll be centrally located in Istanbul, steps from Pera Museum and 11 minutes by foot from Galata Tower.  This 4-star hotel is 0.7 mi (1.1 km) from Taksim Square and 0.3 mi (0.4 km) from Istiklal Avenue
                                        Enjoy a range of recreational amenities, including an indoor pool, a sauna, and a fitness center. Additional features at this hotel include complimentary wireless Internet access, concierge services, and a banquet hall.
                                        Make yourself at home in one of the 84 air-conditioned rooms featuring minibars. Complimentary wireless Internet access keeps you connected, and satellite programming is available for your entertainment. Bathrooms feature showers, complimentary toiletries, and hair dryers. Conveniences include safes and desks, and housekeeping is provided daily. 
                                    </div>
                                </div>

                                <div class="site_moredetails_wrapper">
                                    <div class="moredetails">More details</div>
                                </div>
                            </div>
                        </button>

                        <button class="site">
                            <div class="site_image_wrapper" style="background-image: url(../../Assets/Images/Index/hotels/hotel2.jpg);"></div>

                            <div class="site_information_wrapper">
                                <div class="site_name_price_wrapper">
                                    <div class="site_name">Mercure Istanbul Altunizade</div>
                                    <div class="site_price">
                                        <span class="currency">USD</span>184
                                    </div>
                                </div>

                                <div class="site_description_wrapper">
                                    <div class="site_description">
                                        With a stay at Mercure Istanbul Altunizade in Istanbul (Uskudar), you'll be a 4-minute drive from Maiden's Tower and 6 minutes from Bagdat Avenue.  This 4-star hotel is 5.3 mi (8.5 km) from Dolmabahce Palace and 6.1 mi (9.9 km) from Bosphorus Bridge.
                                        Enjoy a range of recreational amenities, including a health club, an indoor pool, and a sauna. Additional amenities at this hotel include complimentary wireless Internet access, concierge services, and a television in a common area.
                                        Make yourself at home in one of the 140 air-conditioned rooms featuring fireplaces and plasma televisions. Complimentary wireless Internet access keeps you connected, and cable programming is available for your entertainment. Conveniences include phones, as well as safes and desks.
                                    </div>
                                </div>

                                <div class="site_moredetails_wrapper">
                                    <div class="moredetails">More details</div>
                                </div>
                            </div>
                        </button>

                        <button class="site">
                            <div class="site_image_wrapper" style="background-image: url(../../Assets/Images/Index/hotels/hotel3.jpg);"></div>

                            <div class="site_information_wrapper">
                                <div class="site_name_price_wrapper">
                                    <div class="site_name">Hotel Broken Column</div>
                                    <div class="site_price">
                                        <span class="currency">USD</span>142
                                    </div>
                                </div>

                                <div class="site_description_wrapper">
                                    <div class="site_description">
                                        With a stay at Hotel Broken Column, you'll be centrally located in Istanbul, within a 5-minute walk of Sultanahmet Square and Blue Mosque.  This 4-star hotel is 0.3 mi (0.5 km) from Hagia Sophia and 0.3 mi (0.5 km) from Basilica Cistern.
                                        Take in the views from a rooftop terrace and make use of amenities such as complimentary wireless Internet access and concierge services. Additional amenities at this hotel include gift shops/newsstands and a television in a common area. Guests can catch a ride to nearby destinations on the area shuttle (surcharge).
                                        Make yourself at home in one of the 15 air-conditioned rooms featuring refrigerators and minibars. Complimentary wireless Internet access keeps you connected, and satellite programming is available for your entertainment. Private bathrooms with showers feature complimentary toiletries and hair dryers. Conveniences include laptop-compatible safes and coffee/tea makers, and housekeeping is provided daily.
                                    </div>
                                </div>

                                <div class="site_moredetails_wrapper">
                                    <div class="moredetails">More details</div>
                                </div>
                            </div>
                        </button>
                    </div>
                    <button name="page" value="4">submit</button>
                </div>
            </div>
        </form>
    </div>
    
    <script src="<?php echo URLROOT."\public\JS\config.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\sites.js";?>"></script>
    <script src="<?php echo URLROOT."\public\JS\calender.js";?>"></script>
</body>
</html>

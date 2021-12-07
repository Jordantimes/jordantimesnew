<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME?></title>
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Base.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\home.css";?>">
</head>
<body>
    <div class="main_view">
        <?php if(!empty($data["trip"])){ ?>
            <div>
                <a href="<?php echo URLROOT."/Customer/Book?trip=".$data["trip"]."&passengers=".$data["passengers"]?>">Continue</a>
            </div>
        <?php } ?>

        <?php require_once APPROOT."\Views\INCLUDES\Header.php"; ?>

        <div class="video_container">
            <video src="<?php echo URLROOT."/public/Video/jordanfilm.mp4"; ?>" autoplay muted loop></video>

            <div class="video_square"></div>
            <div class="video_square_shadow"></div>

            <div class="site_welcome_info">
                <div class="site_logo">
                    <svg viewBox="0 0 139 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.4611 0.835998V19.88C13.4611 21.8 12.8731 23.348 11.6971 24.524C10.5211 25.676 8.94913 26.252 6.98113 26.252C4.94113 26.252 3.30913 25.64 2.08513 24.416C0.885125 23.168 0.285125 21.488 0.285125 19.376H2.84113C2.86513 20.744 3.20113 21.86 3.84913 22.724C4.52113 23.588 5.56513 24.02 6.98113 24.02C8.32513 24.02 9.32113 23.624 9.96913 22.832C10.6171 22.04 10.9411 21.056 10.9411 19.88V0.835998H13.4611ZM31.102 26.252C28.774 26.252 26.662 25.712 24.766 24.632C22.87 23.528 21.37 22.004 20.266 20.06C19.186 18.092 18.646 15.872 18.646 13.4C18.646 10.928 19.186 8.72 20.266 6.776C21.37 4.808 22.87 3.284 24.766 2.204C26.662 1.1 28.774 0.547999 31.102 0.547999C33.454 0.547999 35.578 1.1 37.474 2.204C39.37 3.284 40.858 4.808 41.938 6.776C43.018 8.72 43.558 10.928 43.558 13.4C43.558 15.872 43.018 18.092 41.938 20.06C40.858 22.004 39.37 23.528 37.474 24.632C35.578 25.712 33.454 26.252 31.102 26.252ZM31.102 24.056C32.974 24.056 34.654 23.624 36.142 22.76C37.63 21.896 38.806 20.66 39.67 19.052C40.534 17.42 40.966 15.536 40.966 13.4C40.966 11.264 40.534 9.392 39.67 7.784C38.806 6.176 37.63 4.94 36.142 4.076C34.654 3.212 32.974 2.78 31.102 2.78C29.23 2.78 27.55 3.212 26.062 4.076C24.574 4.94 23.398 6.176 22.534 7.784C21.67 9.392 21.238 11.264 21.238 13.4C21.238 15.536 21.67 17.42 22.534 19.052C23.398 20.66 24.574 21.896 26.062 22.76C27.55 23.624 29.23 24.056 31.102 24.056ZM61.5611 26L55.3331 15.488H50.6891V26H48.1691V0.835998H55.7291C58.5371 0.835998 60.6611 1.508 62.1011 2.852C63.5651 4.196 64.2971 5.96 64.2971 8.144C64.2971 9.968 63.7691 11.528 62.7131 12.824C61.6811 14.096 60.1451 14.924 58.1051 15.308L64.5851 26H61.5611ZM50.6891 13.436H55.7651C57.7331 13.436 59.2091 12.956 60.1931 11.996C61.2011 11.036 61.7051 9.752 61.7051 8.144C61.7051 6.488 61.2251 5.216 60.2651 4.328C59.3051 3.416 57.7931 2.96 55.7291 2.96H50.6891V13.436ZM76.75 0.835998C79.534 0.835998 81.922 1.34 83.914 2.348C85.906 3.356 87.43 4.808 88.486 6.704C89.542 8.6 90.07 10.856 90.07 13.472C90.07 16.064 89.542 18.308 88.486 20.204C87.43 22.076 85.906 23.516 83.914 24.524C81.922 25.508 79.534 26 76.75 26H69.298V0.835998H76.75ZM76.75 23.912C80.254 23.912 82.918 23 84.742 21.176C86.59 19.328 87.514 16.76 87.514 13.472C87.514 10.16 86.59 7.58 84.742 5.732C82.918 3.86 80.254 2.924 76.75 2.924H71.818V23.912H76.75ZM109.296 20.024H97.8479L95.6519 26H92.9879L102.168 1.16H105.012L114.156 26H111.492L109.296 20.024ZM108.54 17.936L103.572 4.328L98.6039 17.936H108.54ZM137.172 26H134.652L120.72 4.832V26H118.2V0.835998H120.72L134.652 21.968V0.835998H137.172V26ZM61.6626 20.836V22.924H54.6786V46H52.1586V22.924H45.1386V20.836H61.6626ZM68.1617 20.836V46H65.6417V20.836H68.1617ZM98.4563 21.16V46H95.9363V26.164L87.0803 46H85.2443L76.3883 26.236V46H73.8683V21.16H76.5323L86.1443 42.688L95.7563 21.16H98.4563ZM106.693 22.888V32.284H116.233V34.372H106.693V43.912H117.313V46H104.173V20.8H117.313V22.888H106.693ZM129.91 46.252C128.254 46.252 126.79 45.964 125.518 45.388C124.27 44.812 123.286 44.008 122.566 42.976C121.846 41.944 121.462 40.792 121.414 39.52H124.078C124.198 40.744 124.738 41.824 125.698 42.76C126.658 43.672 128.062 44.128 129.91 44.128C131.614 44.128 132.958 43.696 133.942 42.832C134.95 41.944 135.454 40.828 135.454 39.484C135.454 38.404 135.178 37.54 134.626 36.892C134.074 36.22 133.39 35.728 132.574 35.416C131.758 35.08 130.63 34.72 129.19 34.336C127.51 33.88 126.178 33.436 125.194 33.004C124.21 32.572 123.37 31.9 122.674 30.988C121.978 30.076 121.63 28.84 121.63 27.28C121.63 25.984 121.966 24.832 122.638 23.824C123.31 22.792 124.258 21.988 125.482 21.412C126.706 20.836 128.11 20.548 129.694 20.548C132.022 20.548 133.894 21.124 135.31 22.276C136.75 23.404 137.578 24.868 137.794 26.668H135.058C134.89 25.636 134.326 24.724 133.366 23.932C132.406 23.116 131.11 22.708 129.478 22.708C127.966 22.708 126.706 23.116 125.698 23.932C124.69 24.724 124.186 25.816 124.186 27.208C124.186 28.264 124.462 29.116 125.014 29.764C125.566 30.412 126.25 30.904 127.066 31.24C127.906 31.576 129.034 31.936 130.45 32.32C132.082 32.776 133.402 33.232 134.41 33.688C135.418 34.12 136.27 34.792 136.966 35.704C137.662 36.616 138.01 37.84 138.01 39.376C138.01 40.552 137.698 41.668 137.074 42.724C136.45 43.78 135.526 44.632 134.302 45.28C133.078 45.928 131.614 46.252 129.91 46.252Z" fill="black"></path>
                    </svg>
                </div>

                <p>A place that aims to ease the trip search proccess in jordan by making contracts with trip companys available in jordan to post their trips so you find it all in one page.</p>
            
                <p>Where would your next destination in jordan be?</p>
                <button>See destinations</button>
            </div>
        </div>

        <div class="destinations_container">
            <div class="destination" id="C1" style="background-image:url('<?php echo URLROOT."/public/Images/Citys/aqaba.jpg"?>')">
                <a href="<?php echo URLROOT."/sites?end_location=11";?>">
                    <span>Al Aqaba</span>
                </a>
            </div>
            
            <div class="destination" id="C2" style="background-image:url('<?php echo URLROOT."/public/Images/Citys/mafraq.jpg"?>')">
                <a href="<?php echo URLROOT."/sites?end_location=6";?>">
                    <span>Al Mafraq</span>
                </a>
            </div>

            <div class="destination" id="C3"style="background-image:url('<?php echo URLROOT."/public/Images/Citys/irbid.jpg"?>')">
                <a href="<?php echo URLROOT."/sites?end_location=2";?>">
                    <span>Irbid</span>
                </a>
            </div>

            <div class="destination" id="C4" style="background-image:url('<?php echo URLROOT."/public/Images/Citys/zarqa.jpg"?>')">
                <a href="<?php echo URLROOT."/sites?end_location=1";?>">
                    <span>Al Zarqa</span>
                </a>
            </div>

            <div class="destination" id="C5" style="background-image:url('<?php echo URLROOT."/public/Images/Citys/amman.jpg"?>')">
                <a href="<?php echo URLROOT."/sites?end_location=0";?>">
                    <span>Amman</span>
                </a>
            </div>

            <div class="destination" id="C6" style="background-image:url('<?php echo URLROOT."/public/Images/Citys/ajloun.jpg"?>')">
                <a href="<?php echo URLROOT."/sites?end_location=3";?>">
                    <span>Ajloun</span>
                </a>
            </div>

            <div class="destination" id="C7" style="background-image:url('<?php echo URLROOT."/public/Images/Citys/jarash.jpg"?>')">
                <a href="<?php echo URLROOT."/sites?end_location=4";?>">
                    <span>Jarash</span>
                </a>
            </div>
            
            <div class="destination" id="C8" style="background-image:url('<?php echo URLROOT."/public/Images/Citys/tafele.jpg"?>')">
                <a href="<?php echo URLROOT."/sites?end_location=8";?>">
                    <span>Al Tafele</span>
                </a>
            </div>

            <div class="destination" id="C9" style="background-image:url('<?php echo URLROOT."/public/Images/Citys/petra.png"?>')">
                <a href="<?php echo URLROOT."/sites?end_location=10";?>">
                    <span>Ma'an</span>
                </a>
            </div>

            <div class="destination" id="C10" style="background-image:url('<?php echo URLROOT."/public/Images/Citys/karak.jpg"?>')">
                <a href="<?php echo URLROOT."/sites?end_location=9";?>">
                    <span>Al Karak</span>
                </a>
            </div>

            <div class="destination" id="C11" style="background-image:url('<?php echo URLROOT."/public/Images/Citys/salt.jpg"?>')">
                <a href="<?php echo URLROOT."/sites?end_location=5";?>">
                    <span>Al Balqa'</span>
                </a>
            </div>

            <div class="destination" id="C12" style="background-image:url('<?php echo URLROOT."/public/Images/Citys/madaba.jpg"?>')">
                <a href="<?php echo URLROOT."/sites?end_location=7";?>">
                    <span>Madaba</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>

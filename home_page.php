<?php include 'server.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>JordanTimes</title>

    <!--Fontawesome CSS-->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!--Socialicons CSS-->
    <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-md  fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapsed" data-target="#Navbar">
                class="navbar-toggler-icon">
            </button>
            <a class="navbar-brand mr-auto" href="home_page.php">JordanTimes</a>
            <ul class="navbar-nav mr-md">
                <li class="nav-item active"> <a class="nav-link" href="./index.html">
                        <spsn>Home
                    </a></li>
                
                <!--Navbar MENU-->
                <li class="nav-item"> <a class="nav-link" href="./aboutus.html">
                        <spsn>About
                    </a></li>
                <li class="nav-item"> <a class="nav-link" href="#">
                        <spsn>Contact
                    </a></li>
                <li class="nav-item"> <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal">
                        <spsn>Login
                    </a></li>

                <select class="nav-item">
                    <option selected>English</option>
                    <option selected>العربية</option>
                </select>
                <select id="currency" class="nav-item">
                    <option value="USD" selected>USD Dollar</option>
                    <option value="JOD">JD</option>
                </select>
            </ul>
        </div>
    </nav>



    <div>
        <!--Muted auto-play loop video-->
        <video style="width:1262px;" id="video-background" preload muted autoplay loop>
            <source src="images/jordanfilm.mp4" type="video/mp4">

        </video>

    </div>


    <div class="container">
        <div class="row row-content">
            <div class="col-12 col-sm-4 order-sm-first col-md-3">
                <h4>Find your Destination </h4>
            </div>
            <!--Search bar-->
            <div class="form-group col-xs-24">

                <div class="inner-addon right-addon autocomplete">
                    <i class="fa fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search" />
                </div>
            </div>


        <!-- Registration Tab -->

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#loginTab" class="w-200 p-3 text-danger">Login</a></li>
                                <li><a data-toggle="tab" href="#compSignupTab" class="w-200 p-3 text-danger">Company.Signup</a></li>
                                <li><a data-toggle="tab" href="#userSignupTab" class="w-200 p-3 text-danger">User.Signup</a></li>

                            </ul>

                            <div class="tab-content">
                                <div id="loginTab" class="tab-pane fade in active">
                                <form method="POST">
                                        <div>
                                            <label>email</label>
                                            <input type="email" name="email" class="form-control" for="email" placeholder="Enter Email">
                                        </div>
                                        <div>
                                            <label>password</label>
                                            <input type="password" name="password" class="form-control" for="password" placeholder="Enter Password">
                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btnModal">Login</button>
                                    </form>



                                </div>
                                <div id="compSignupTab" class="tab-pane fade">
                                <form method="POST">
                                        <div>
                                            <label>Company No</label>
                                            <input type="text" name="No" class="form-control" for="companyNo">
                                        </div>

                                        <div>
                                            <label> Name</label>
                                            <input type="text" name="Name" class="form-control" for="companyName">
                                        </div>
                                        <div>
                                            <label>Email</label>
                                            <input type="email" name="Email" class="form-control" for="companyEmail">
                                        </div>
                                        <div>
                                            <label>Company Phone</label>
                                            <input type="text" name="Phone" class="form-control" for="companyPhone">
                                        </div>
                                        <div>
                                            <label>Company Password</label>
                                            <input type="password" name="Password" class="form-control" for="companyPassword">
                                        </div>
                                        <div>
                                            <label>Confirm Password</label>
                                            <input type="password" name="confirmPassword" class="form-control"  for="companyPassword">
                                        </div>

                                        <button type="submit" name="submit" class="btn btn-primary btnModal">Signup</button>
                                    </form>













                                   
                                </div>
                                <div id="userSignupTab" class="tab-pane fade">
                                    <h3>Menu 2</h3>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>

                </div>
            </div>


            <!--Scrolling Wrapper-->
            <div class="scrolling-wrapper ">
                <div class="item">
                    <div class="text-center">Amman</div>
                    <img class="img_item" src="images/amman.png">
                </div>
                <div class="item">
                    <div class="text-center">Ajloun</div>
                    <img class="img_item" src="images/ajloun.png">
                </div>
                <div class="item">
                    <div class="text-center">AL- Balqaa'</div>
                    <img class="img_item" src="images/balqa.png">
                </div>
                <div class="item">
                    <div class="text-center">Dead Sea</div>
                    <img class="img_item" src="images/dead sea.png">
                </div>
                <div class="item">
                    <div class="text-center">Irbid </div>
                    <img class="img_item" src="images/irbid.png">
                </div>
                <div class="item">
                    <div class="text-center">Jarash</div>
                    <img class="img_item" src="images/jarash.png">
                </div>
                <div class="item">
                    <div class="text-center">AL-Karak</div>
                    <img class="img_item" src="images/karak.png">
                </div>
                <div class="item">
                    <div class="text-center">Madaba</div>
                    <img class="img_item" src="images/madaba.png">
                </div>
                <div class="item">
                    <div class="text-center">AL-Tafila</div>
                    <img class="img_item" src="images/tafila.png">
                </div>
                <div class="item">
                    <div class="text-center">Wadi Rum</div>
                    <img class="img_item" src="images/rum.png">
                </div>
                <div class="item">
                    <div class="text-center">Petra</div>
                    <img class="img_item" src="images/petra.png">
                </div>
                <div class="item">
                    <div class="text-center">AL - Azraq</div>
                    <img class="img_item" src="images/azraq.png">
                </div>
                <div class="item">
                    <div class="text-center">Aqaba</div>
                    <img class="img_item" src="images/aqaba.png">
                </div>



            </div>
            <div>

                <!--Offers Cards-->
                <div id="offers">
                    <div>
                        <h2 style="text-align:center;">Offers</h2>
                    </div>
                    <table>
                        <tr>
                            <td>
                                <div class="card border-secondary mb-3" style="max-width: 20rem;">
                                    <div class="card-header">Amman(Stay), Jarash/Ajloun</div>
                                    <div id="ammanOffer">

                                    </div>
                                    <div class="card-header">
                                        <button disabled type="button" value="20" class="btn btn-secondary price" title="" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-bs-original-title="Popover Title" aria-describedby="popover576452">20 JD</button>
                                        <button type="button" class="btn btn-secondary" title="" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-bs-original-title="Popover Title" aria-describedby="popover576452">Details</button>

                                    </div>


                            </td>
                            <td>
                                <div class="card border-secondary mb-3" style="max-width: 20rem;">
                                    <div class="card-header">Om qais trip</div>
                                    <div id="omqaisOffer">

                                    </div>
                                    <div class="card-header">
                                        <button disabled type="button" value="15" class="btn btn-secondary price" title="" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-bs-original-title="Popover Title" aria-describedby="popover576452">15 JD</button>
                                        <button type="button" class="btn btn-secondary" title="" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-bs-original-title="Popover Title" aria-describedby="popover576452">Details</button>

                                    </div>
                                </div>

                            </td>
                            <td>
                                <div class="card border-secondary mb-3" style="max-width: 20rem;">
                                    <div class="card-header">Wadi Rum , Petra 3 Stars</div>
                                    <div id="rumOffer">

                                    </div>
                                    <div class="card-header">
                                        <button disabled type="button" value="35" class="btn btn-secondary price" title="" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-bs-original-title="Popover Title" aria-describedby="popover576452">35 JD</button>
                                        <button type="button" class="btn btn-secondary" title="" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-bs-original-title="Popover Title" aria-describedby="popover576452">Details</button>
                                    </div>
                                </div>

                            </td>


                        </tr>

                        <tr>
                            <td>
                                <div class="card border-secondary mb-3" style="max-width: 20rem;">
                                    <div class="card-header">La cueva</div>
                                    <div id="deadseaOffer">

                                    </div>
                                    <div class="card-header">
                                        <button disabled type="button" value="20" class="btn btn-secondary price" title="" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-bs-original-title="Popover Title" aria-describedby="popover576452">20 JD</button>
                                        <button type="button" class="btn btn-secondary" title="" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-bs-original-title="Popover Title" aria-describedby="popover576452">Details</button>
                                    </div>
                                </div>


                            </td>
                            <td>
                                <div disabled class="card border-secondary mb-3" style="max-width: 20rem;">
                                    <div class="card-header">Petra Stay 2 stars</div>
                                    <div id="petraOffer">

                                    </div>
                                    <div class="card-header">
                                        <button disabled type="button" value="20" class="btn btn-secondary price" title="" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-bs-original-title="Popover Title" aria-describedby="popover576452">20 JD</button>
                                        <button type="button" class="btn btn-secondary" title="" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-bs-original-title="Popover Title" aria-describedby="popover576452">Details</button>
                                    </div>
                                </div>

                            </td>
                            <td>
                                <div class="card border-secondary mb-3" style="max-width: 20rem;">
                                    <div class="card-header">Al-Salt Tour</div>
                                    <div id="alsaltOffer">

                                    </div>
                                    <div class="card-header">
                                        <button disabled type="button" value="10" class="btn btn-secondary price" title="" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-bs-original-title="Popover Title" aria-describedby="popover576452">10 JD</button>
                                        <button type="button" class="btn btn-secondary" title="" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-bs-original-title="Popover Title" aria-describedby="popover576452">Details</button>
                                    </div>
                                </div>

                            </td>


                        </tr>


                    </table>
                </div>
            </div>





            <!--Companies Block-->



            <div class="container">
                <div class="row row-content">
                    <h3>Approved Tourisim Companies</h3>
                </div>


                <div id="companies">
                    <img class="company_img" src="images/dalas.jpg">
                    <img class="company_img" src="images/mwakeb.jpg">
                    <img class="company_img" src="images/holiday.jpg">
                    <img class="company_img" src="images/aljazeera.jpg">
                    <img class="company_img" src="images/goldenhourse.png">

                </div>


                <p id="test"></p>

            </div>

            <!--Stackholders Block-->

            <div id="stakeholders">
                <h2>Our Stakeholders</h2>
                <div class="stakeholder">
                    <img src="images/user.png">
                    <p> users is our priority <br>
                        we provide them with easiest <br>
                        way to booking with an ability <br>
                        to give feedback about thier <br>
                        experience</p>

                </div>

                <div class="stakeholder">
                    <img src="images/admin.png">
                    <p> Our qualified employees enssure <br>
                        control over website content</p>

                </div>
                <div class="stakeholder">
                    <img src="images/company.png">
                    <p> Approved Tourisim companies can <br>
                        published their content <br>
                        on our platform </p>

                </div>
                <div class="stakeholder">
                    <img src="images/goverment.png">
                    <p> Approved Tourisim companies can <br>
                        published their content <br>
                        on our platform </p>

                </div>




            </div>

            <!--Footer-->
            <div class="footer-clean">
                <footer class="footer">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-sm-4 col-md-3 item">
                                <h3>Links</h3>
                                <ul>
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4 col-md-3 item">
                                <h3>Explore</h3>
                                <ul>
                                    <li><a href="#">Offers</a></li>
                                    <li><a href="#">Companies</a></li>
                                    <li><a href="#">Destinations</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4 col-md-3 item">
                                <h3>Top Destinations</h3>
                                <ul>
                                    <li><a href="#">Dead Sea</a></li>
                                    <li><a href="#">Petra </a></li>
                                    <li><a href="#">Wadi Rum</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                                <p class="copyright">JordanTimes © 2021</p>
                            </div>
                        </div>
                    </div>

            </div>

            </footer>
            <!-- jQuery first, then Popper.js, then Bootstrap JS. -->
            <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
            <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
            <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>
<!-- This should be transfered -->
<script>
    const scrollContainer = document.querySelector(".scrolling-wrapper");

    scrollContainer.addEventListener("wheel", (evt) => {
        evt.preventDefault(); // prevent scrolling by bars
        scrollContainer.scrollLeft += evt.deltaY; // adding  width to container
    });



    const currencyEl = document.getElementById('currency');

    const amounts = document.getElementsByClassName('price');



    // Fetch exchange rates and update the DOM
    function calculate() {
        const currency_value = currencyEl.value;


        fetch(`https://api.exchangerate.host/latest/${currency_value}`)
            .then(data => data.json())
            .then(data => {
                console.log(data);
                const rate = data.rates[currency_value];

                amounts.innerText = `1 ${currency_value} = ${rate} ${currency_value}`;

                amounts.innerText = (amounts.value * rate).toFixed(2);
            });
    }

    // Event listeners
    currencyEl.addEventListener('change', calculate);

    calculate();
</script>
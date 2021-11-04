<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME?> - Sign up</title>
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\Base.css";?>">
    <link rel="stylesheet" href="<?php echo URLROOT."\public\CSS\signup.css";?>">

</head>
<body>
    <div class="main_view">
        <?php require_once APPROOT."\Views\INCLUDES\Header.php"; ?>

        <div class="content">
            <div class="form_content">
                <div class="form_content_left">
                    <div>
                        <div class="form_header">
                            <h1>Sign up</h1>
                        </div>
                        <p class="form_info"></p>
                        <p class="form_info"></p>
                        <p class="form_info"></p>
                        <p >Already have an account? <a href="<?php echo URLROOT."/User/LogIn"?>">Log in</a></p>
                    </div>
                    <p>Having a question? do you need help? <a href="<?php echo URLROOT."/Home/Contact"?>">Contact us</a></p>
                </div>

                <div class="form_content_right">
                    <div class="form_selectors">
                        <button class="form_selector">Customer</button>
                        <button class="form_selector">Company</button>
                    </div>

                    <div class="form_container">
                        <div class="form_wrapper" selected-form="<?php echo $data["SignupType"] === "Customer" ? "true":"false" ?>">
                            <form action="<?php echo URLROOT; ?>/User/SignUp" method="POST">
                                <div class="form_left">
                                    <div>
                                        <label for="name">First and last name</label>
                                        <input type="text" name="name" id="name">
                                        <div class="error"><?php echo $data["Error"]["type"] === "Name" ? $data["Error"]["message"]."*" : ""; ?></div>
                                    </div>

                                    <div>
                                        <label for="email">E-mail</label>
                                        <input type="email" name="email" id="email">
                                        <div class="error"><?php echo $data["Error"]["type"] === "Email" ? $data["Error"]["message"]."*" : ""; ?></div>
                                    </div>

                                    <div id="phone_div">
                                        <label for="phone">Phone number</label>
                                        <input type="text" name="phone" id="phone" maxlength="9">
                                        <div class="phone_info">+962</div>
                                        <div class="error"><?php echo $data["Error"]["type"] === "Phone" ? $data["Error"]["message"]."*" : ""; ?></div>
                                    </div>

                                    <div>
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password">
                                        <div class="error"><?php echo $data["Error"]["type"] === "Password" ? $data["Error"]["message"]."*" : ""; ?></div>
                                    </div>

                                    <div>
                                        <label for="repeat_password">Repeat password</label>
                                        <input type="password" name="repeat_password" id="repeat_password">
                                    </div>

                                    <input type="hidden" name="Role" value="customer">
                                </div>

                                <div class="form_right">
                                    <button name="SignUp_Submit" class="submit">
                                        <div>
                                            <div>Sign</div>
                                            <div>me</div> 
                                            <div>up</div> 
                                        </div>

                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 330 330" style="enable-background:new 0 0 330 330;" xml:space="preserve">
                                            <path id="XMLID_29_" d="M100.606,100.606L150,51.212V315c0,8.284,6.716,15,15,15c8.284,0,15-6.716,15-15V51.212l49.394,49.394  C232.322,103.535,236.161,105,240,105c3.839,0,7.678-1.465,10.606-4.394c5.858-5.857,5.858-15.355,0-21.213l-75-75  c-5.857-5.858-15.355-5.858-21.213,0l-75,75c-5.858,5.857-5.858,15.355,0,21.213C85.251,106.463,94.749,106.463,100.606,100.606z"/>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="form_wrapper" selected-form="<?php echo $data["SignupType"] === "Company" ? "true":"false" ?>">
                            <form action="<?php echo URLROOT; ?>/User/SignUp" method="POST">
                                <div class="form_left">
                                    <div>
                                        <label for="number">Company number</label>
                                        <input type="text" name="company_number" id="number">
                                        <div class="error"><?php echo $data["Error"]["type"] === "C-Company_Number" ? $data["Error"]["message"]."*" : ""; ?></div>
                                    </div>

                                    <div>
                                        <label for="name">Company name</label>
                                        <input type="text" name="name" id="name">
                                        <div class="error"><?php echo $data["Error"]["type"] === "C-Name" ? $data["Error"]["message"]."*" : ""; ?></div>
                                    </div>

                                    <div>
                                        <label for="email">Company e-mail</label>
                                        <input type="email" name="email" id="email">
                                        <div class="error"><?php echo $data["Error"]["type"] === "C-Email" ? $data["Error"]["message"]."*" : ""; ?></div>
                                    </div>

                                    <div id="phone_div">
                                        <label for="phone">Company phone number</label>
                                        <input type="text" name="phone" id="phone" maxlength="9">
                                        <div class="phone_info">+962</div>
                                        <div class="error"><?php echo $data["Error"]["type"] === "C-Phone" ? $data["Error"]["message"]."*" : ""; ?></div>
                                    </div>

                                    <div>
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password">
                                        <div class="error"><?php echo $data["Error"]["type"] === "C-Password" ? $data["Error"]["message"]."*" : ""; ?></div>
                                    </div>

                                    <div>
                                        <label for="repeat_password">Repeat password</label>
                                        <input type="password" name="repeat_password" id="repeat_password">
                                    </div>

                                    <input type="hidden" name="Role" value="company">
                                </div>

                                <div class="form_right">
                                    <button name="SignUp_Submit" class="submit">
                                        <div>
                                            <div>Sign</div>
                                            <div>up</div> 
                                        </div>

                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 330 330" style="enable-background:new 0 0 330 330;" xml:space="preserve">
                                            <path id="XMLID_29_" d="M100.606,100.606L150,51.212V315c0,8.284,6.716,15,15,15c8.284,0,15-6.716,15-15V51.212l49.394,49.394  C232.322,103.535,236.161,105,240,105c3.839,0,7.678-1.465,10.606-4.394c5.858-5.857,5.858-15.355,0-21.213l-75-75  c-5.857-5.858-15.355-5.858-21.213,0l-75,75c-5.858,5.857-5.858,15.355,0,21.213C85.251,106.463,94.749,106.463,100.606,100.606z"/>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo URLROOT."\public\JS\config.js";?>"></script>
    <script>
        window.addEventListener("DOMContentLoaded" , function(){
            const selectors = document.querySelectorAll(".form_selector");
            const forms = document.querySelectorAll(".form_wrapper");
            const form_info = document.querySelectorAll(".form_info");

            if(forms[0].getAttribute("selected-form") === "true"){
                form_info[0].innerText= "Create your account, book your trips!";
                form_info[1].innerText= "It is more preferred to enter your real name and phone number when you sign up for a better booking process.";
                form_info[2].innerText= "Don’t worry you can always change your information at any time.";

                selectors[0].style.backgroundColor= MAIN_COLOR;
                selectors[0].style.color= "#ffffff";
                forms[0].style.display = "block";
            }

            else if(forms[1].getAttribute("selected-form") === "true"){
                form_info[0].innerText= "Create your company account, publish your trips!";
                form_info[1].innerText= "Please enter a valid information about your touring company, these information will be seen and studied by the government, be sure to wait for the government decision.";
                form_info[2].innerText= "";
                

                selectors[1].style.backgroundColor= MAIN_COLOR;
                selectors[1].style.color= "#ffffff";
                forms[1].style.display = "block";
            }

            else{
                form_info[0].innerText= "Create your account, book your trips!";
                form_info[1].innerText= "It is more preferred to enter your real name and phone number when you sign up for a better booking process.";
                form_info[2].innerText= "Don’t worry you can always change your information at any time.";

                selectors[0].style.backgroundColor= MAIN_COLOR;
                selectors[0].style.color= "#ffffff";
                forms[0].style.display = "block";
            }

            for (let i = 0; i < selectors.length; ++i) {
                selectors[i].addEventListener("click" , function(){
                    if(!i){
                        form_info[0].innerText= "Create your account, book your trips!";
                        form_info[1].innerText= "It is more preferred to enter your real name and phone number when you sign up for a better booking process.";
                        form_info[2].innerText= "Don’t worry you can always change your information at any time.";

                        selectors[1].style.backgroundColor= "transparent";
                        selectors[1].style.color= "#000000";
                        forms[1].style.display = "none";


                        selectors[0].style.backgroundColor= MAIN_COLOR;
                        selectors[0].style.color= "#ffffff";
                        forms[0].style.display = "block";
                    }

                    else{
                        form_info[0].innerText= "Create your company account, publish your trips!";
                        form_info[1].innerText= "Please enter a valid information about your touring company, these information will be seen and studied by the government, be sure to wait for the government decision.";
                        form_info[2].innerText= "";

                        selectors[0].style.backgroundColor= "transparent";
                        selectors[0].style.color= "#000000";
                        forms[0].style.display = "none";


                        selectors[1].style.backgroundColor= MAIN_COLOR;
                        selectors[1].style.color= "#ffffff";
                        forms[1].style.display = "block";
                    }
                } , false);
            }
        } , false);
    </script>
</body>
</html>

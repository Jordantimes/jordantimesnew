window.addEventListener("DOMContentLoaded" , function(){
    document.querySelector(".create_trip").addEventListener("click" , function(){
        document.querySelector(".create_trip_pop_up_container").style.display="block";
        document.querySelector(".create_trip_pop_up_container").scrollTop = 0;
    }, false);

    const count_per_time = 10;
    GetNotifications(count_per_time);

    document.querySelector("#refresh_notifications").addEventListener("click" , function(){
        GetNotifications(count_per_time);
    } , true);


    //edit profile button event listener
    const edit_profile_button = document.querySelector(".edit_profile_button");
        edit_profile_button.addEventListener("click" , function(){
            let data = [];
            let image;
            let bioHTML = "";
            let bioTEXT = "";
            let input_name;
            const data_div = document.querySelectorAll(".data_div");
            const data_wrappers = document.querySelectorAll(".data_wrapper");

            //save the src of the original image
            image = document.querySelector(".profileIMG").src;

            //add the file input in the div
            document.querySelector(".browse_image_container").innerHTML = "<input class='file_input' type='file' name='image' accept='.jpg, .jpeg, .png'>";
            document.querySelector(".browse_image_container").innerHTML += "<p class='image_input_info'>Image size must be 500x500 px or below</p>";

            //for each div input remove it and replace it with a form text input and make its default value as the value was inside the div
            for(let i = 0 ; i < data_div.length ; ++i){
                data.push(data_div[i].innerHTML);
                input_name = data_div[i].getAttribute("name");
                data_div[i].remove();

                data_wrappers[i].innerHTML += "<input type='text' value='"+data[i]+"' name='"+input_name+"' class='text_input'>";
            }

            //replace the bio div with a text area
            //getting both as HTML and as TEXT to save the BR elements (<br>) from being deleted to re print the bio once the user clicks on cancel 
            //otherwise the whole text will not contain any new lines
            bioHTML = document.querySelector(".data_div_textarea").innerHTML;
            bioTEXT = document.querySelector(".data_div_textarea").innerText;

            document.querySelector(".data_div_textarea").remove();
            document.querySelector(".data_wrapper_textarea").innerHTML+= "<textarea class='textarea_input' name='bio'  rows='12'>"+bioTEXT+"</textarea>";

            //hide the edit button and create the submit form button
            document.querySelector(".edit_profile_button_container").style.display= "none";
            document.querySelector(".submit_button_container").innerHTML = ""+
            "<button class='cancel_button' type='button'>Cancel</button>"+
            "<button class='submit_button' name='submit_edit' type='submit'>Save</button>"+
            "";

            const file_input = document.querySelector(".file_input");
                file_input.addEventListener("change" , function(){
                    var new_image = file_input.files[0];

                    //check file type and if correct chack its size
                    //otherwise clear the input file and set back the original image
                    if(new_image.type === "image/jpeg" || new_image.type === "image/png"){
                        if(new_image.size < 500000){
                            var reader = new FileReader();

                            //Read the contents of Image File.
                            reader.readAsDataURL(new_image);
                            reader.onload = function (e) {
                                //Initiate the JavaScript Image object.
                                var imageOBJ = new Image();

                                //Set the Base64 string return from FileReader as source.
                                imageOBJ.src = e.target.result;

                                //Validate the File Height and Width.
                                imageOBJ.onload = function () {    
                                    if(this.height <= 500 && this.width <= 500){
                                        //display the selected image by creating a temporary URL/SRC 
                                        let NewImageURL = URL.createObjectURL(new_image);
                                        document.querySelector(".profileIMG").src = NewImageURL;
                                    }

                                    else{
                                        file_input.value = "";
                                        document.querySelector(".profileIMG").src = image;
                                    }
                                };
                            };
                        }

                        else{
                            file_input.value = "";
                            document.querySelector(".profileIMG").src = image;
                        }
                    }

                    else{
                        file_input.value = "";
                        document.querySelector(".profileIMG").src = image;
                    }

                } , true);


            //cancel button event listener
            const cancel_button = document.querySelector(".cancel_button");
                cancel_button.addEventListener("click" , function(){
                    //set back the original image 
                    document.querySelector(".profileIMG").src = image;
                    
                    //remove the file input in the div
                    document.querySelector(".browse_image_container").innerHTML = "";

                    //do the opposite and for each text input remove it and replace it with a form div input and print the original text whcih is saved in the data variable
                    let text_input = document.querySelectorAll(".text_input");

                    for(let i = 0 ; i < text_input.length ; ++i){
                        input_name = text_input[i].getAttribute("name");
                        text_input[i].remove();

                        data_wrappers[i].innerHTML += "<div type='text' name='"+input_name+"' class='data_div'>"+data[i]+"</div>";
                    }

                    //do the opposite and  replace the bio text area with a div
                    document.querySelector(".textarea_input").remove();
                    document.querySelector(".data_wrapper_textarea").innerHTML+= "<div class='data_div_textarea' name='bio'>"+bioHTML+"</div>";
                    
                    //again do the opposite and hide the submit/cancel buttons and appear the edit profile button again
                    document.querySelector(".edit_profile_button_container").style.display= "block";
                    document.querySelector(".submit_button_container").innerHTML = "";
                } , true);
        } , true);
} , true);



const site_pop_up = document.querySelector(".pop_up_site_details_container");
        const site = document.querySelectorAll(".site");
            for(let i = 0 ; i < site.length ; ++i){
                site[i].addEventListener("click" , function(){
                    open_popUp(i);
                } , true);
            }
    
        const site_popup_close_button = document.querySelector("#pop_up_close");
            site_popup_close_button.addEventListener("click" , function(){
                close_popUp();
            } , true);
    
        site_pop_up.addEventListener("click" , function(event){
            if(event.target.className === "pop_up_site_details_container"){
                close_popUp();
            }
        } , true);


    const full_screen_container = document.querySelector(".pop_up_site_image_full_screen_view_container");
    const full_screen_image = document.querySelector(".full_screen_image");
    const preview_image_button = document.querySelectorAll(".preview_image_container");
    const preview_image = document.querySelectorAll(".preview_image");

        for(let i = 0 ; i < preview_image_button.length ; ++i){
            preview_image_button[i].addEventListener("click" , function(){
                let image_src = preview_image[i].getAttribute("src");
                open_image_full_preview(full_screen_container,full_screen_image,image_src);
            } , true);
        }

        const body = document.querySelector("body");
        body.addEventListener("click" , function(event){
            if(!event.target.closest(".full_screen_image")){
                close_image_full_preview();
            }
        } , true);

        function open_popUp(i){
            document.querySelector(".site_name_popedup").innerText = document.querySelectorAll(".site_name")[i].innerText;
            document.querySelector(".site_price_popedup").innerText = document.querySelectorAll(".site_price")[i].innerText;
            document.querySelector(".site_description_popedup").innerText = document.querySelectorAll(".site_description")[i].innerText;
            document.querySelector(".breakfast_price_popedup").innerText = document.querySelectorAll(".breakfast_price")[i].innerText ? "- Breakfast " + document.querySelectorAll(".breakfast_price")[i].innerText + "USD": "";
            document.querySelector(".lunch_price_popedup").innerText = document.querySelectorAll(".lunch_price")[i].innerText ? "- Lunch " + document.querySelectorAll(".lunch_price")[i].innerText + "USD": "";
            document.querySelector(".dinner_price_popedup").innerText = document.querySelectorAll(".dinner_price")[i].innerText ? "- Dinner " + document.querySelectorAll(".dinner_price")[i].innerText + "USD": "";
            document.querySelector(".site_base_price_popedup").innerText = "- Trip base price "+document.querySelectorAll(".site_base_price")[i].innerText +"USD";
            document.querySelector(".site_start_date_popedup").innerText = document.querySelectorAll(".site_start_date")[i].innerText;
            document.querySelector(".site_end_date_popedup").innerText = document.querySelectorAll(".site_end_date")[i].innerText;
            document.querySelector(".passengers_wrapper_popedup").innerHTML = document.querySelectorAll(".passengers_wrapper")[i].innerHTML;
            document.querySelector(".edit_trip").value = i;

            let images = document.querySelectorAll(".site_image_wrapper")[i].children;
            let images_container = document.querySelector(".controlled_slider");
            images_container.innerHTML = "";

            for(let j = 0 ; j < images.length ; ++j){
                images_container.innerHTML += "<div class='preview_image_container'><img class='preview_image' src='"+images[j].src+"' alt='site picture'></div>"
            }

            let preview_images = document.querySelectorAll(".preview_image");
            for(let j = 0 ; j < images.length ; ++j){
                preview_images[j].addEventListener("click" , function(){
                    open_image_full_preview(images[j].src);
                } , false);
            }

            create_nav_circles(images.length);

            const controlled_slider = document.querySelector(".controlled_slider");
            const navigators = document.querySelectorAll(".navigator");
                for (let i = 0; i < navigators.length; ++i) {
                    navigators[i].addEventListener("click" , function(){
                        let nav_number = parseInt(navigators[i].getAttribute("navigator_number"));
                        
                        if(nav_number === 0){
                            controlled_slider.style.transform="translateX(0px)";
                        }

                        else if (nav_number === navigators.length - 1){
                            let position = (images.length * 290) - 870;
                            controlled_slider.style.transform="translateX(-"+position+"px)";
                        }

                        else{
                            let position = ((3 * nav_number) * 290);
                            controlled_slider.style.transform="translateX(-"+position+"px)";
                        }

                        for(let y = 0 ; y < navigators.length ; ++y){
                            navigators[y].innerHTML = "";
                        }

                        navigators[nav_number].innerHTML = "<div class='inner_active_navigator'></div>";

                    } , true);
                }

            let site_pop_up_condition = site_pop_up.getAttribute("condition");

            if(site_pop_up_condition === "hidden"){
                site_pop_up.style.display= "block";
                site_pop_up.setAttribute("condition" , "visible");
                document.querySelector("body").style.overflow="hidden";
            }
                
        }
        function close_popUp(){
            let site_pop_up_condition = site_pop_up.getAttribute("condition");

            if(site_pop_up_condition === "visible"){
                site_pop_up.style.display= "none";
                site_pop_up.setAttribute("condition" , "hidden");
                document.querySelector("body").style.overflow="auto";
            }

            document.querySelector(".controlled_slider").style.transform="translateX(0px)";

        }

        function create_nav_circles(images_count){
            let circles_count = Math.ceil(images_count / 3);

            const slider_navigators = document.querySelector(".slider_navigators");
            slider_navigators.innerHTML="";

            let circle_selected = "<button class='navigator' navigator_number='0' type='button'><div class='inner_active_navigator'></div></button>";
            slider_navigators.innerHTML+= circle_selected;

            for (let i = 1; i < circles_count ; ++i) {
                let circle = "<button class='navigator' navigator_number="+i+" type='button'></button>";
                slider_navigators.innerHTML+= circle;
            }
        }

        function open_image_full_preview(image_src){
            let full_screen_container = document.querySelector(".pop_up_site_image_full_screen_view_container");
            let full_screen_image = document.querySelector(".full_screen_image");

            full_screen_container.style.display = "block";
            full_screen_container.setAttribute("condition" , "visible");
            full_screen_image.setAttribute("src" , image_src);
        }

        function close_image_full_preview(){
            const full_screen_container = document.querySelector(".pop_up_site_image_full_screen_view_container");
            
            full_screen_container.style.display = "none";
            full_screen_container.setAttribute("condition" , "hidden");
        }


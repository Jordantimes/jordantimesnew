window.addEventListener('DOMContentLoaded', function(){
    const destination = [   
        "Amman",
        "Zarqa",
        "Irbid",
        "Ajloun",
        "Jarash",
        "Al Balqa",
        "Al Mafraq",
        "Madaba",
        "Al Tafele",
        "Al Karak",
        "Ma'an",
        "Aqaba",
    ];
    let selected_passenger_button = 0;
    let selected_location = 0;
    const passenger_click = document.querySelectorAll(".passenger_click");
    const passenger_value_RADIO = document.querySelectorAll("#passenger_radio");
    const passenger_counter_span = document.querySelector(".passenger_counter");
    const locations_click = document.querySelectorAll(".location_click");
    const locations_list = document.querySelector("#locations_list");

    //set the date from the url
    const sd = new Date(document.querySelector(".start_date_input").getAttribute("value"));
    document.querySelector(".start_date_input").value = sd.getFullYear() +"-"+ ("0"+(sd.getMonth()+1)).slice(-2) +"-"+ ("0"+sd.getDate()).slice(-2);

    const ed = new Date(document.querySelector(".end_date_input").getAttribute("value"));
    document.querySelector(".end_date_input").value = ed.getFullYear() +"-"+ ("0"+(sd.getMonth()+1)).slice(-2) +"-"+ ("0"+ed.getDate()).slice(-2);

    //set the color of the selected option from the url if entered
    for (let i = 0; i < passenger_value_RADIO.length; ++i) {
        if(passenger_value_RADIO[i].checked){
            passenger_click[i].style.backgroundColor = "#f05d5e";
            passenger_click[i].style.color = "#ffffff";
            selected_passenger_button = i;
            break; 
        }
    }

    for(let i = 0 ; i < passenger_click.length ; i++){
        passenger_click[i].addEventListener("click" , function(){
            //change the style of the previous selected option to the orignal style
            passenger_click[selected_passenger_button].style.backgroundColor = "transparent";
            passenger_click[selected_passenger_button].style.color = "#000000";   

            //change the new selected option to the highlighted style
            passenger_click[i].style.backgroundColor = "#f05d5e";
            passenger_click[i].style.color = "#ffffff";

            //check the coresponding radio button with the selected option
            passenger_value_RADIO[i].checked = "true";
            passenger_counter_span.innerHTML = passenger_value_RADIO[i].value;

            //save the index of the selected option
            selected_passenger_button = i;
        } , true);
    }

    for(let i = 0 ; i < locations_click.length ; i++){
        locations_click[i].addEventListener("click" , function(){
            //change the style of the previous selected option to the orignal style
            locations_click[selected_location].style.backgroundColor = "transparent";
            locations_click[selected_location].style.color = "#000000";   

            //change the new selected option to the highlighted style
            locations_click[i].style.backgroundColor = "#f05d5e";
            locations_click[i].style.color = "#ffffff";

            //check the coresponding input with the selected option
            let list_condition = document.querySelector("#locations_list").getAttribute("location_type");

            if(list_condition === "start"){
                document.querySelector(".start_location_input").value = i;
                document.querySelector(".start_location_holder").innerHTML = destination[i];
                document.querySelector("#locations_list").setAttribute("location_type" , "end");
            }

            else if(list_condition === "end" && i !== selected_location){
                document.querySelector(".end_location_input").value = i;
                document.querySelector(".end_location_holder").innerHTML = destination[i];
                document.querySelector("#locations_list").setAttribute("location_type" , "start");

                locations_list.style.display="none";
                locations_list.setAttribute("visibility" , "hidden"); 
                }


            //save the index of the selected option
            selected_location = i;
        } , true);
    }


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
            let passsenger_count_list = document.querySelector("#passsenger_count_list");
            let passenger_list_condition = passsenger_count_list.getAttribute("visibility");

            let locations_list_condition = locations_list.getAttribute("visibility");
            let locations_list_type = locations_list.getAttribute("location_type");

            let trip_date_list = document.querySelector("#trip_date_list");
            let trip_date_list_condition = trip_date_list.getAttribute("visibility");
            let trip_date_list_type = trip_date_list.getAttribute("calender_type");
            

            //lists view statements////////////////////////////////////////////////////////////////////////////
            if(event.target.closest("#passenger_input_wrapper")){
                if(passenger_list_condition === "hidden"){
                    passsenger_count_list.style.display="block";
                    passsenger_count_list.setAttribute("visibility" , "visible");
                }
            }

            if(event.target.closest("#locations_input_wrapper")){
                if(locations_list_condition === "hidden"){
                    locations_list.style.display="block";
                    locations_list.setAttribute("visibility" , "visible");

                    if(locations_list_type === "start"){
                        document.querySelector(".start_location_input").value = "";
                        document.querySelector(".start_location_holder").innerHTML = "-";

                        document.querySelector(".end_location_input").value = "";
                        document.querySelector(".end_location_holder").innerHTML = "-";

                        locations_click[selected_location].style.backgroundColor = "transparent";
                        locations_click[selected_location].style.color = "#000000";   
                    }
                }
            }

            if(event.target.closest("#date_input_wrapper")){
                if(trip_date_list_condition === "hidden"){
                    if(trip_date_list_type === "start"){
                        document.querySelector(".start_date_input").value ="";
                        document.querySelector(".end_date_input").value ="";
                        document.querySelector(".selected_start_date_holder").innerHTML="----/--/--";
                        document.querySelector(".selected_end_date_holder").innerHTML="----/--/--";

                        date.setMonth(current_month);
                        date.setFullYear(current_year);
                        set_calender(date,current_month,current_year);
                    }

                    else{
                        date.setMonth(start_selected_month);
                        date.setFullYear(start_selected_year);
                        set_calender(date,start_selected_month,start_selected_year);
                    }
                    trip_date_list.style.display="block";
                    trip_date_list.setAttribute("visibility" , "visible");
                }
            }


            //lists hide statements////////////////////////////////////////////////////////////////////////////
            if(event.target.closest(".main_view")){
                if(passenger_list_condition === "visible"){
                    passsenger_count_list.style.display="none";
                    passsenger_count_list.setAttribute("visibility" , "hidden"); 
                }
            }

            if(!event.target.closest("#locations_list")){
                if(locations_list_condition === "visible"){
                    locations_list.style.display="none";
                    locations_list.setAttribute("visibility" , "hidden"); 
                }
            }

            if(!event.target.closest("#trip_date_list")){
                if(trip_date_list_condition === "visible"){
                    trip_date_list.style.display="none";
                    trip_date_list.setAttribute("visibility" , "hidden"); 
                }
            }

            if(!event.target.closest(".full_screen_image")){
                close_image_full_preview();
            }
        } , true);


        function open_popUp(i){
            document.querySelector(".site_name_popedup").innerText = document.querySelectorAll(".site_name")[i].innerText;
            document.querySelector(".site_price_popedup").innerText = document.querySelectorAll(".site_price")[i].innerText;
            document.querySelector(".company_picture_popedup").src = document.querySelectorAll(".company_picture")[i].src;
            document.querySelector(".company_name_popedup").innerText = document.querySelectorAll(".company_name")[i].innerText;
            document.querySelector(".site_created_at_popup").innerText = document.querySelectorAll(".site_created_at")[i].innerText;
            document.querySelector(".site_description_popedup").innerText = document.querySelectorAll(".site_description")[i].innerText;
            document.querySelector(".breakfast_price_popedup").innerText = document.querySelectorAll(".breakfast_price")[i].innerText ? "- Breakfast " + document.querySelectorAll(".breakfast_price")[i].innerText + "USD": "";
            document.querySelector(".lunch_price_popedup").innerText = document.querySelectorAll(".lunch_price")[i].innerText ? "- Lunch " + document.querySelectorAll(".lunch_price")[i].innerText + "USD": "";
            document.querySelector(".dinner_price_popedup").innerText = document.querySelectorAll(".dinner_price")[i].innerText ? "- Dinner " + document.querySelectorAll(".dinner_price")[i].innerText + "USD": "";
            document.querySelector(".site_base_price_popedup").innerText = "- Trip base price "+document.querySelectorAll(".site_base_price")[i].innerText +"USD";;
            document.querySelector(".site_start_date_popedup").innerText = document.querySelectorAll(".site_start_date")[i].innerText;
            document.querySelector(".site_end_date_popedup").innerText = document.querySelectorAll(".site_end_date")[i].innerText;
            document.querySelector(".check_in").value = document.querySelectorAll(".site")[i].value;

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
} , true);

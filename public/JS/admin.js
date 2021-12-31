var site_pop_up = document.querySelector(".pop_up_site_details_container");
var siteID;
var siteIndex;

window.addEventListener("DOMContentLoaded" , function(){
    GetUnverified();

    document.querySelector(".accept_trip").addEventListener("click" , function(){
        CreateAcceptTripPopup(siteID,siteIndex); 
    } , false);

    document.querySelector(".decline_trip").addEventListener("click" , function(){
        CreateDeclineTripPopup(siteID,siteIndex);
    } , false);
} , false);


function GetUnverified(){
    var Request = new XMLHttpRequest();
    var URL = URLROOT+"/Admin/GetUnverified";

    Request.open("GET" , URL , true);
    Request.send();

    Request.onreadystatechange = function() {
        if (this.status === 200) {
            if(this.readyState === 4){
                var Data = JSON.parse(Request.response);
                document.querySelector("#trips_counter").innerText = Data.length;

                if(Data.length === 0){
                    document.querySelector("#trips_counter").innerText = "";

                    document.querySelector('#trips_view_box').innerHTML = 
                    "<div class='empty_sites'>"+
                        "<div class='empty_sites_icon'>"+
                            "<svg version='1.1' id='Layer_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 330 330' style='enable-background:new 0 0 330 330;' xml:space='preserve'>"+
                                "<g>"+
                                    "<g>"+
                                        "<g>"+
                                            "<path d='M165,0.008C74.019,0.008,0,74.024,0,164.999c0,90.977,74.019,164.992,165,164.992s165-74.015,165-164.992     C330,74.024,255.981,0.008,165,0.008z M165,299.992c-74.439,0-135-60.557-135-134.992S90.561,30.008,165,30.008     s135,60.557,135,134.991C300,239.436,239.439,299.992,165,299.992z'/>"+
                                            "<path d='M165,130.008c-8.284,0-15,6.716-15,15v99.983c0,8.284,6.716,15,15,15s15-6.716,15-15v-99.983     C180,136.725,173.284,130.008,165,130.008z'/>"+
                                            "<path d='M165,70.011c-3.95,0-7.811,1.6-10.61,4.39c-2.79,2.79-4.39,6.66-4.39,10.61s1.6,7.81,4.39,10.61     c2.79,2.79,6.66,4.39,10.61,4.39s7.81-1.6,10.609-4.39c2.79-2.8,4.391-6.66,4.391-10.61s-1.601-7.82-4.391-10.61     C172.81,71.61,168.95,70.011,165,70.011z'/>"+
                                        "</g>"+
                                    "</g>"+
                                "</g>"+
                            "</svg>"+
                        "</div>"+
                        "<span>Nothing is here...</span>"+
                    "</div>";
                }

                else{

                    for (let i = 0; i < Data.length; i++) {
                        CreateSite(i,Data[i]);
                    }


                    const site_pop_up = document.querySelector(".pop_up_site_details_container");
                    const site = document.querySelectorAll(".site"); 
                        for(let i = 0 ; i < site.length ; ++i){
                            site[i].addEventListener("click" , function(){
                                siteID = document.querySelector("#site"+i).value;
                                siteIndex = i;
                                open_popUp(i);
                            } , true);
                        }

                
                    const site_popup_close_button = document.querySelector("#pop_up_close");
                        site_popup_close_button.addEventListener("click" , function(){
                            close_popUp();
                            siteID = null;
                        } , true);
                
                    site_pop_up.addEventListener("click" , function(event){
                        if(event.target.className === "pop_up_site_details_container"){
                            close_popUp();
                            siteID = null;
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
                }
            }
        }
    }
}

function CreateSite(i,site){
    var div = document.querySelector('#trips_view_box');

    let Site = "<button class='site' type='button' value='"+site["id"]+"' id='site"+i+"'>"+
                    "<div class='site_image_wrapper' id='site_image_wrapper"+i+"'>"+
                        // "<img src='"+URLROOT+"/public/images/users/trips/"+site["images"][0]+"' alt='site_picture'>"+
                    "</div>"+

                    "<div class='site_information_wrapper'>"+
                        "<div class='site_header'>"+
                            "<div class='site_header_left'>"+
                                "<div class='site_name' id='site_name"+i+"'>"+site["name"]+"</div>"+

                                "<div class='site_company_info'>"+
                                    "<div><img class='company_picture' id='company_picture"+i+"' src="+URLROOT+"/public/images/users/companys/"+site["image"]+" alt='company_picture'></div>"+
                                    "<div>"+
                                        "<span class='company_name' id='company_name"+i+"'>"+site["company_name"]+"</span>"+
                                        "<span>.</span>"+
                                        "<span class='site_created_at' id='site_created_at"+i+"'>"+site["created_at"]+"</span>"+
                                    "</div>"+
                                "</div>"+
                            "</div>"+

                            "<div class='site_price' id='site_price"+i+"'>"+
                                "USD"+(parseInt(site["price"]) + parseInt(site["breakfast_price"]) + parseInt(site["lunch_price"]) + parseInt(site["dinner_price"]))+
                            "</div>"+
                        "</div>"+

                        "<div class='site_description_wrapper'>"+
                            "<div class='site_description' id='site_description"+i+"'>"+site["description"]+"</div>"+
                        "</div>"+

                        "<div class='site_additional'>"+
                            "<span class='breakfast_price' id='breakfast_price"+i+"'>"+ site["breakfast_price"]+"</span>"+
                            "<span class='lunch_price' id='lunch_price"+i+"'>"+ site["lunch_price"]+"</span>"+
                            "<span class='dinner_price' id='dinner_price"+i+"'>"+ site["dinner_price"]+"</span>"+
                            "<span class='site_base_price' id='site_base_price"+i+"'>"+site["price"]+"</span>"+
                            "<span class='site_start_date' id='site_start_date"+i+"'>"+site["start_date"]+"</span>"+
                            "<span class='site_end_date' id='site_end_date"+i+"'>"+site["end_date"]+"</span>"+
                        "</div>"+

                        "<div class='site_moredetails_wrapper'>"+
                            "<div class='moredetails'>More details</div>"+
                        "</div>"+
                    "</div>"+
                "</button>";

    div.innerHTML+= Site;

    let images_div = document.querySelectorAll(".site_image_wrapper")[i];
    for (let j = 0; j < site["images"].length; ++j) {
        images_div.innerHTML += "<img src='"+URLROOT+"/public/images/users/trips/"+site["images"][j]+"' alt='site_picture'>";
    }
}


function open_popUp(i){
    document.querySelector(".company_picture_popedup").src = document.querySelector("#company_picture"+i).src;
    document.querySelector(".company_name_popedup").innerText = document.querySelector("#company_name"+i).innerText;
    document.querySelector(".site_created_at_popup").innerText = document.querySelector("#site_created_at"+i).innerText;
    document.querySelector(".site_name_popedup").innerText = document.querySelector("#site_name"+i).innerText;
    document.querySelector(".site_price_popedup").innerText = document.querySelector("#site_price"+i).innerText;
    document.querySelector(".site_description_popedup").innerText = document.querySelector("#site_description"+i).innerText;
    document.querySelector(".breakfast_price_popedup").innerText = document.querySelector("#breakfast_price"+i).innerText ? "- Breakfast " + document.querySelector("#breakfast_price"+i).innerText + "USD": "";
    document.querySelector(".lunch_price_popedup").innerText = document.querySelector("#lunch_price"+i).innerText ? "- Lunch " + document.querySelector("#lunch_price"+i).innerText + "USD": "";
    document.querySelector(".dinner_price_popedup").innerText = document.querySelector("#dinner_price"+i).innerText ? "- Dinner " + document.querySelector("#dinner_price"+i).innerText + "USD": "";
    document.querySelector(".site_base_price_popedup").innerText = "- Trip base price "+document.querySelector("#site_base_price"+i).innerText +"USD";
    document.querySelector(".site_start_date_popedup").innerText = document.querySelector("#site_start_date"+i).innerText;
    document.querySelector(".site_end_date_popedup").innerText = document.querySelector("#site_end_date"+i).innerText;

    let images = document.querySelector("#site_image_wrapper"+i).children;
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


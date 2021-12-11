window.addEventListener("DOMContentLoaded" , function(){
    //Call get Data functions
    var count_per_time = 10;
    GetRequests(count_per_time);
    GetNotifications(count_per_time);


    document.querySelector("#refresh_requests").addEventListener("click" , function(){
        GetRequests(count_per_time);
    } , true);

    document.querySelector("#refresh_notifications").addEventListener("click" , function(){
        GetNotifications(count_per_time);
    } , true);

    document.querySelector("#requests_search_button").addEventListener("click" , function(){
        GetRequestsSearch(count_per_time);
    } , true);
} , true);



function GetRequests(count_per_time){
    let Request = new XMLHttpRequest();
    let URL = URLROOT+"/Government/GetRequests";

    Request.open("GET" , URL , true);
    Request.send();

    Request.onreadystatechange = function() {
        if (this.status === 200) {
            if(this.readyState === 4){
                let JSON_DATA = JSON.parse(Request.response);
            
                if(JSON_DATA.length == 0){
                    document.querySelector("#requests_information").innerHTML = "No new requests";
                }

                else{
                    document.querySelector("#requests_counter").innerHTML = "";
                    document.querySelector("#requests_information").innerHTML = "";
                    document.querySelector("#requests_counter").innerHTML = JSON_DATA.length;
                    document.querySelector("#requests_table").setAttribute("all_count" , JSON_DATA.length);
                    document.querySelector("#requests_table").setAttribute("count" , JSON_DATA.length);
                    CreateRequestsTable(JSON_DATA,0,count_per_time);
                }
            }
        }

        else{
            document.querySelector("#requests_information").innerHTML = "An error occured";
            document.querySelector("#requests_table").innerHTML="";
            CreateErrorMessage();
        }
    };
}

function GetRequestsSearch(count_per_time){
    let value = document.querySelector("#requests_search_input").value;

    if(value !== ""){
        let Request = new XMLHttpRequest();
        let URL = URLROOT+"/Government/SearchRequests";

        let data = {
            "Value" : value
        };

        Request.open("POST" , URL , true);
        Request.send(JSON.stringify(data));

        Request.onreadystatechange = function() {
            if (this.status === 200) {
                if(this.readyState === 4){
                    let JSON_DATA = JSON.parse(Request.response);
                
                    if(JSON_DATA.length == 0){
                        document.querySelector("#requests_information").innerHTML = "Nothing found";
                        document.querySelector("#requests_table").innerHTML="";
                        document.querySelector("#requests_view_more").innerHTML= "";
                    }

                    else{
                        document.querySelector("#requests_information").innerHTML = "";
                        document.querySelector("#requests_table").setAttribute("count" , JSON_DATA.length);
                        CreateRequestsTable(JSON_DATA,0,count_per_time);
                    }
                }
            }

            else{
                document.querySelector("#requests_information").innerHTML = "An error occured";
                document.querySelector("#requests_table").innerHTML="";
                document.querySelector("#requests_view_more").innerHTML= "";
                CreateErrorMessage();
            }
        }
    }
}

function CreateRequestsTable(JSON_DATA,index,count_per_time){
    //create table headers
        let headers = "<tr>"+
        "<th>Company ID</th>"+
        "<th>Company Number</th>"+
        "<th>Company Name</th>"+
        "<th>Company Email</th>"+
        "<th>Phone Number</th>"+
        "<th>Requested At</th>"+
        "</tr>"    
        ;
        document.querySelector("#requests_table").innerHTML= headers;

    //get the beginning and the end of the loop to print the table rows
    let min = index;
    let max = index + count_per_time;

    // if min + count per time is higher than the array length it will cause an out of bounds problem
    if(max > JSON_DATA.length){
        max = JSON_DATA.length;
    }
    
    for(let i = min ; i < max ; ++i){
        CreateRequestTableRow(JSON_DATA,JSON_DATA[i],i);
    }

    //set the index of where the table has stopped printing
    document.querySelector("#requests_table").setAttribute("last",max);
    
    //if there is more rows that were not printed then create the VIEW MORE button and create it's event listener
    if(max < JSON_DATA.length){
        let requests_view_more_button = document.createElement("button");
        requests_view_more_button.className="view_more_button";
        requests_view_more_button.id= "requests_view_more_button";

        requests_view_more_button_text = document.createTextNode("View more");
        
        requests_view_more_button.appendChild(requests_view_more_button_text);

        document.querySelector("#requests_view_more").innerHTML="";
        document.querySelector("#requests_view_more").appendChild(requests_view_more_button);

        document.querySelector("#requests_view_more_button").addEventListener("click" , function(){
            //get the index of where the table has stopped printing
            let index = parseInt(document.querySelector("#requests_table").getAttribute("last"));
            let new_index = index + count_per_time;

            //if the new index of where the table should stop printing is higher from the JSON array then the breakpoint of the array is the array length it self
            if(new_index >= JSON_DATA.length){
                for(let i = index ; i < JSON_DATA.length ; ++i){
                    CreateRequestTableRow(JSON_DATA,JSON_DATA[i],i);
                }

                document.querySelector("#requests_table").setAttribute("last",JSON_DATA.length);
            }

            else{
                for(let i = index ; i < new_index ; ++i){
                    CreateRequestTableRow(JSON_DATA,JSON_DATA[i],i);
                    document.querySelector("#requests_table").setAttribute("last",new_index);
                }
            }

            //if all the data in JSON array is printed then remove the VIEW MORE button
            if(new_index >= JSON_DATA.length){
                document.querySelector("#requests_view_more").innerHTML= "";
            }
        } , true);
    }

    else{
        document.querySelector("#requests_view_more").innerHTML= "";
    }
}


function CreateRequestTableRow(JSON_DATA,Row,index){
    let tbody = document.createElement("tbody");
    tbody.className = "request_table_row";
    tbody.id = "request_table_row_"+index;
    tbody.setAttribute("index" , index);

    let tr = document.createElement("tr");

    let td1 = document.createElement("td");
    let td2 = document.createElement("td");
    let td3 = document.createElement("td");
    let td4 = document.createElement("td");
    let td5 = document.createElement("td");
    let td6 = document.createElement("td");

    let company_ID = document.createTextNode(Row["company_ID"]);
    let company_Number = document.createTextNode(Row["company_Number"]);
    let name = document.createTextNode(Row["name"]);
    let email = document.createTextNode(Row["email"]);
    let phone = document.createTextNode(Row["phone"]);
    let CreatedAt = document.createTextNode(Row["CreatedAt"]);

    let tdAccept = document.createElement("td");
    tdAccept.className= "accept_index";

    let tdDecline = document.createElement("td");
    tdDecline.className= "decline_index";

    let accept_request = document.createElement("button");
    accept_request.className="accept_request";
    accept_request.id= "accept_request_"+index;

    let accept = document.createTextNode("Accept");

    let decline_request = document.createElement("button");
    decline_request.className="decline_request";
    decline_request.id= "decline_request_"+index;

    let decline = document.createTextNode("Decline");



    accept_request.appendChild(accept);
    decline_request.appendChild(decline);

    tdAccept.appendChild(accept_request);
    tdDecline.appendChild(decline_request);


    td1.appendChild(company_ID);
    td2.appendChild(company_Number);
    td3.appendChild(name);
    td4.appendChild(email);
    td5.appendChild(phone);
    td6.appendChild(CreatedAt);

    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);
    tr.appendChild(td4);
    tr.appendChild(td5);
    tr.appendChild(td6);
    tr.appendChild(tdAccept);
    tr.appendChild(tdDecline);

    tbody.appendChild(tr);

    document.querySelector("#requests_table").appendChild(tbody);


    //clicking on accept or decline will open up a pop up and the values of the row that was choosen are sent to the pop up
    document.querySelector("#accept_request_"+index).addEventListener("click" , function(){
        CreateAcceptPopUp(JSON_DATA,index,Row["email"],Row["name"]);
    } , true);

    document.querySelector("#decline_request_"+index).addEventListener("click" , function(){
        CreateDeclinePopUp(JSON_DATA,index,Row["email"],Row["name"]);
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
            document.querySelector(".site_base_price_popedup").innerText = "- Trip base price "+document.querySelectorAll(".site_base_price")[i].innerText +"USD";
            document.querySelector(".site_start_date_popedup").innerText = document.querySelectorAll(".site_start_date")[i].innerText;
            document.querySelector(".site_end_date_popedup").innerText = document.querySelectorAll(".site_end_date")[i].innerText;
            document.querySelector(".passengers_wrapper_popedup").innerHTML = document.querySelectorAll(".passengers_wrapper")[i].innerHTML;

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


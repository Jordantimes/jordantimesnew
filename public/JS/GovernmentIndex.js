window.addEventListener("DOMContentLoaded" , function(){
    //sticky navigation section control
    nav_buttons = document.querySelectorAll(".navigation_button");
    var view_box = 0;
    nav_buttons[view_box].style.backgroundColor ="#eeeeee";
    document.querySelectorAll(".content_view_box")[view_box].style.display="block";

    for (let i = 0; i < nav_buttons.length; ++i) {
        nav_buttons[i].addEventListener("click" , function(){
            document.querySelectorAll(".content_view_box")[view_box].style.display = "none";
            nav_buttons[view_box].style.backgroundColor = "transparent";
            document.querySelectorAll(".content_view_box")[i].style.display="block";
            nav_buttons[i].style.backgroundColor = "#eeeeee";

            view_box = i;
        } , true);
    }


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





    //pop_up_division control
    document.querySelector(".pop_ups_container").addEventListener("click" , function(event){
        if(event.target.className === "pop_ups_container" || event.target.className === "cancel_pop_up"){
            document.querySelector(".pop_ups_container").style.display= "none";

            document.querySelector(".pop_up_information").innerHTML = "";
            document.querySelector(".pop_up_actions").innerHTML = "";
        }
    } , true);
} , true);

function GetRequests(count_per_time){
    let Request = new XMLHttpRequest();
    let URL = URLROOT+"/Government/Requests";

    Request.open("GET" , URL , true);
    Request.send();

    Request.onreadystatechange = function() {
        if (this.status === 200) {
            if(this.readyState === 4){
                let JSON_DATA = JSON.parse(Request.response);
            
                if(JSON_DATA.length == 0){
                    document.querySelector("#requests_information").innerHTML = "No new requests";
                    document.querySelector("#requests_count_overview_information").innerHTML = "No new requests";
                }

                else{
                    document.querySelector("#requests_count_overview_information").innerHTML = "";
                    document.querySelector("#requests_information").innerHTML = "";
                    document.querySelector("#requests_count_overview").innerHTML = JSON_DATA.length;
                    document.querySelector("#requests_table").setAttribute("all_count" , JSON_DATA.length);
                    document.querySelector("#requests_table").setAttribute("count" , JSON_DATA.length);
                    CreateRequestsTable(JSON_DATA,0,count_per_time);
                }
            }
        }

        else{
            document.querySelector("#requests_information").innerHTML = "An error occured";
            document.querySelector("#requests_count_overview_information").innerHTML = "An error occured";
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
        "<th>Email</th>"+
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

function GetNotifications(count_per_time){
    let Request = new XMLHttpRequest();
    let URL = URLROOT+"/User/Notifications";
    let ID = document.querySelector(".USER").getAttribute("id");

    let data = {
        "ID" : ID
    };

    Request.open("POST" , URL , true);
    Request.send(JSON.stringify(data));

    Request.onreadystatechange = function() {
        if (this.status === 200) {
            if(this.readyState === 4){
                let JSON_DATA = JSON.parse(Request.response);
            
                if(JSON_DATA.length == 0){
                    document.querySelector("#notifications_information").innerHTML = "No new notifications";
                    document.querySelector("#notifications_count_overview_information").innerHTML = "No new notifications";
                }

                else{
                    document.querySelector("#notifications_count_overview_information").innerHTML = "";
                    document.querySelector("#notifications_information").innerHTML = "";
                    document.querySelector("#notifications_table").setAttribute("all_count" , JSON_DATA.length);
                    document.querySelector("#notifications_table").setAttribute("count" , JSON_DATA.length);
                    document.querySelector("#notifications_table").setAttribute("unread",0);
                    let unread_count = 0;
                    for(let i = 0 ; i < JSON_DATA.length ; ++i){
                        if(JSON_DATA[i]["seen"] == 0){
                            unread_count++;
                            document.querySelector("#notifications_table").setAttribute("unread",unread_count);
                        }
                    }

                    if(unread_count === 0){
                        document.querySelector("#notifications_count_overview_information").innerHTML = "No new notifications";
                    }

                    else{
                        document.querySelector("#notifications_count_overview").innerHTML = unread_count;
                    }
                    
                    CreateNotificationsTable(JSON_DATA,0,count_per_time);
                }
            }    
        }

        else{
            document.querySelector("#notifications_information").innerHTML = "An error occured";
            document.querySelector("#notifications_count_overview_information").innerHTML = "An error occured";
            document.querySelector("#notifications_table").innerHTML="";
            CreateErrorMessage();
        }
    };
}

function CreateNotificationsTable(JSON_DATA,index,count_per_time){
    //create select all checkbox and the div to contain the notificaions controls
    let select_all_checkbox = document.createElement("input");
    select_all_checkbox.setAttribute("type","checkbox");
    select_all_checkbox.className= "select_all_checkbox";

    let select_all_checkbox_custom_container = document.createElement("div");
    select_all_checkbox_custom_container.className = "select_all_checkbox_custom_container";

    let select_all_checkbox_custom = document.createElement("button");
    select_all_checkbox_custom.className ="select_all_checkbox_custom";

    select_all_checkbox_custom_container.appendChild(select_all_checkbox_custom);

    let selected_notifications_controls = document.createElement("div");
    selected_notifications_controls.className = "selected_notifications_controls";

    document.querySelector(".notifications_controls").innerHTML = "";
    document.querySelector(".notifications_controls").appendChild(select_all_checkbox);
    document.querySelector(".notifications_controls").appendChild(select_all_checkbox_custom_container);
    document.querySelector(".notifications_controls").appendChild(selected_notifications_controls);
    document.querySelector(".notifications_controls").setAttribute("checked_count" , 0);

    //select all notifiactions event handler
    document.querySelector(".select_all_checkbox_custom").addEventListener("click" , function(){
        let select_all_checkbox = document.querySelector(".select_all_checkbox");
        let state = document.querySelector(".select_all_checkbox").checked;
        var checked_counter = 0;

        if(!state){
            select_all_checkbox.checked = true;
            document.querySelector(".select_all_checkbox_custom").style.backgroundColor = MAIN_COLOR;
            document.querySelector(".select_all_checkbox_custom").style.border = "none";
            document.querySelector(".select_all_checkbox_custom").innerHTML = ""+
            "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 512 512' style='enable-background:new 0 0 512 512;' xml:space='preserve'>"+
                "<g>"+
                    "<g>"+
                        "<path d='M504.502,75.496c-9.997-9.998-26.205-9.998-36.204,0L161.594,382.203L43.702,264.311c-9.997-9.998-26.205-9.997-36.204,0    c-9.998,9.997-9.998,26.205,0,36.203l135.994,135.992c9.994,9.997,26.214,9.99,36.204,0L504.502,111.7    C514.5,101.703,514.499,85.494,504.502,75.496z'/>"+
                    "</g>"+
                "</g>"+
            "</svg>"+
            "";
            

            let checkbox = document.querySelectorAll(".notifications_checkbox");
            for(let i = 0 ; i < checkbox.length ; ++i){
                document.querySelectorAll(".notifications_checkbox")[i].checked = true;
                document.querySelectorAll(".checkbox_custom")[i].style.backgroundColor = MAIN_COLOR;
                document.querySelectorAll(".checkbox_custom")[i].style.border = "none";
                document.querySelectorAll(".checkbox_custom")[i].innerHTML = ""+
                "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 512 512' style='enable-background:new 0 0 512 512;' xml:space='preserve'>"+
                    "<g>"+
                        "<g>"+
                            "<path d='M504.502,75.496c-9.997-9.998-26.205-9.998-36.204,0L161.594,382.203L43.702,264.311c-9.997-9.998-26.205-9.997-36.204,0    c-9.998,9.997-9.998,26.205,0,36.203l135.994,135.992c9.994,9.997,26.214,9.99,36.204,0L504.502,111.7    C514.5,101.703,514.499,85.494,504.502,75.496z'/>"+
                        "</g>"+
                    "</g>"+
                "</svg>"+
                "";

                checked_counter++;
            }

            document.querySelector(".notifications_controls").setAttribute("checked_count" , checked_counter);

            CreateNotificationsControls(JSON_DATA);
        }

        else{
            select_all_checkbox.checked = false;
            document.querySelector(".select_all_checkbox_custom").style.backgroundColor = "transparent";
            document.querySelector(".select_all_checkbox_custom").style.border = "1px #000000 solid";
            document.querySelector(".select_all_checkbox_custom").innerHTML = "";

            let checkbox = document.querySelectorAll(".notifications_checkbox");
            for(let i = 0 ; i < checkbox.length ; ++i){
                document.querySelectorAll(".notifications_checkbox")[i].checked = false;
                document.querySelectorAll(".checkbox_custom")[i].style.backgroundColor = "transparent";
                document.querySelectorAll(".checkbox_custom")[i].style.border = "1px #000000 solid";
                document.querySelectorAll(".checkbox_custom")[i].innerHTML = "";
            }

            document.querySelector(".notifications_controls").setAttribute("checked_count" , 0);
            document.querySelector(".selected_notifications_controls").innerHTML= "";
        }
    } , true);


    document.querySelector("#notifications_table").innerHTML = "";

    //get the beginning and the end of the loop to print the table rows
    let min = index;
    let max = index + count_per_time;

    // if min + count per time is higher than the array length it will cause an out of bounds problem
    if(max > JSON_DATA.length){
        max = JSON_DATA.length;
    }

    for(let i = min ; i < max ; ++i){
        CreateNotificationRow(JSON_DATA,JSON_DATA[i],i);
    }

    //set the index of where the table has stopped printing
    document.querySelector("#notifications_table").setAttribute("last",max);

    if(max < JSON_DATA.length){
        let notifications_view_more_button = document.createElement("button");
        notifications_view_more_button.className="view_more_button";
        notifications_view_more_button.id= "notifications_view_more_button";

        notifications_view_more_button_text = document.createTextNode("View more");
        
        notifications_view_more_button.appendChild(notifications_view_more_button_text);

        document.querySelector("#notifications_view_more").innerHTML="";
        document.querySelector("#notifications_view_more").appendChild(notifications_view_more_button);

        document.querySelector("#notifications_view_more_button").addEventListener("click" , function(){
            //get the index of where the table has stopped printing
            let index = parseInt(document.querySelector("#notifications_table").getAttribute("last"));
            let new_index = index + count_per_time;

            //if the new index of where the table should stop printing is higher from the JSON array then the breakpoint of the array is the array length it self
            if(new_index >= JSON_DATA.length){
                for(let i = index ; i < JSON_DATA.length ; ++i){
                    CreateNotificationRow(JSON_DATA,JSON_DATA[i],i);
                }

                document.querySelector("#notifications_table").setAttribute("last",JSON_DATA.length);
            }

            else{
                for(let i = index ; i < new_index ; ++i){
                    CreateNotificationRow(JSON_DATA,JSON_DATA[i],i);
                    document.querySelector("#notifications_table").setAttribute("last",new_index);
                }
            }

            //if all the data in JSON array is printed then remove the VIEW MORE button
            if(new_index >= JSON_DATA.length){
                document.querySelector("#notifications_view_more").innerHTML= "";
            }

            //remove the selected all checked condition since new rows were introduced and the are not checked yet
            document.querySelector(".select_all_checkbox").checked = false;
            document.querySelector(".select_all_checkbox_custom").style.backgroundColor = "transparent";
            document.querySelector(".select_all_checkbox_custom").style.border = "1px #000000 solid";
            document.querySelector(".select_all_checkbox_custom").innerHTML = "";
        } , true);
    }

    else{
        document.querySelector("#notifications_view_more").innerHTML= "";
    }
}

function CreateNotificationRow(JSON_DATA,Row,index){
    let notifications_item = document.createElement("div");
    notifications_item.className ="notifications_item";
    notifications_item.id = "notifications_item_"+index;
    notifications_item.setAttribute("index" , index);

    let checkbox = document.createElement("input");
    checkbox.setAttribute("type" , "checkbox");
    checkbox.setAttribute("name" , "notifications");
    checkbox.id="checkbox_"+index;
    checkbox.className = "notifications_checkbox";
    checkbox.value = Row["id"];

    let notifications_item_upper = document.createElement("div");
    notifications_item_upper.className="notifications_item_upper";

    let checkbox_custom = document.createElement("button");
    checkbox_custom.className= "checkbox_custom";
    checkbox_custom.id = "checkbox_custom_"+index;

    let head = document.createElement("div");
    head.id = "notification_head_"+index;
    let headtext = document.createTextNode(Row["head"]);

    let date = document.createElement("div");
    let datetext = document.createTextNode(Row["CreatedAt"]);

    let notifications_item_lower = document.createElement("div");
    notifications_item_lower.className= "notifications_item_lower";

    let body = document.createElement("div");
    body.id = "notification_body_"+index;
    let bodytext = document.createTextNode(Row["body"]);

    let unread_count = parseInt(document.querySelector("#notifications_table").getAttribute("unread"));

    head.appendChild(headtext);
    date.appendChild(datetext);
    body.appendChild(bodytext);

    notifications_item_upper.appendChild(checkbox_custom);
    notifications_item_upper.appendChild(head);
    notifications_item_upper.appendChild(date);

    notifications_item_lower.appendChild(body);

    notifications_item.appendChild(checkbox);
    notifications_item.appendChild(notifications_item_upper);
    notifications_item.appendChild(notifications_item_lower);

    document.querySelector("#notifications_table").appendChild(notifications_item);

    if(Row["seen"] == 0){
        head.style.fontWeight = "700";
        body.style.fontWeight = "700";
        document.querySelector("#notifications_item_"+index).setAttribute("state","unread");
    }

    else{
        document.querySelector("#notifications_item_"+index).setAttribute("state","read");
    }


    document.querySelector("#checkbox_custom_"+index).addEventListener("click" , function(){
        let state = document.querySelector("#checkbox_"+index).checked;
        let checked_count =parseInt(document.querySelector(".notifications_controls").getAttribute("checked_count"));
        checkbox_count = parseInt(document.querySelector("#notifications_table").getAttribute("count"));

        if(state == false){
            document.querySelector("#checkbox_"+index).checked = true;
            document.querySelector("#checkbox_custom_"+index).style.backgroundColor = MAIN_COLOR;
            document.querySelector("#checkbox_custom_"+index).style.border = "none";
            document.querySelector("#checkbox_custom_"+index).innerHTML = ""+
            "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 512 512' style='enable-background:new 0 0 512 512;' xml:space='preserve'>"+
                "<g>"+
                    "<g>"+
                        "<path d='M504.502,75.496c-9.997-9.998-26.205-9.998-36.204,0L161.594,382.203L43.702,264.311c-9.997-9.998-26.205-9.997-36.204,0    c-9.998,9.997-9.998,26.205,0,36.203l135.994,135.992c9.994,9.997,26.214,9.99,36.204,0L504.502,111.7    C514.5,101.703,514.499,85.494,504.502,75.496z'/>"+
                    "</g>"+
                "</g>"+
            "</svg>"+
            "";

            checked_count++;
            document.querySelector(".notifications_controls").setAttribute("checked_count" , checked_count);

            if(checkbox_count === checked_count){
                document.querySelector(".select_all_checkbox").checked = true;
                document.querySelector(".select_all_checkbox_custom").style.backgroundColor = MAIN_COLOR;
                document.querySelector(".select_all_checkbox_custom").style.border = "none";
                document.querySelector(".select_all_checkbox_custom").innerHTML = ""+
                "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 512 512' style='enable-background:new 0 0 512 512;' xml:space='preserve'>"+
                    "<g>"+
                        "<g>"+
                            "<path d='M504.502,75.496c-9.997-9.998-26.205-9.998-36.204,0L161.594,382.203L43.702,264.311c-9.997-9.998-26.205-9.997-36.204,0    c-9.998,9.997-9.998,26.205,0,36.203l135.994,135.992c9.994,9.997,26.214,9.99,36.204,0L504.502,111.7    C514.5,101.703,514.499,85.494,504.502,75.496z'/>"+
                        "</g>"+
                    "</g>"+
                "</svg>"+
                "";
            }

            if(checked_count === 1){
                CreateNotificationsControls(JSON_DATA);
            }
        }

        else{
            document.querySelector("#checkbox_"+index).checked = false;
            document.querySelector("#checkbox_custom_"+index).style.backgroundColor = "transparent";
            document.querySelector("#checkbox_custom_"+index).style.border = "1px #000000 solid";
            document.querySelector("#checkbox_custom_"+index).innerHTML = "";

            checked_count--;
            document.querySelector(".notifications_controls").setAttribute("checked_count" , checked_count);

            if(checked_count === checkbox_count - 1){
                document.querySelector(".select_all_checkbox").checked = false;
                document.querySelector(".select_all_checkbox_custom").style.backgroundColor = "transparent";
                document.querySelector(".select_all_checkbox_custom").style.border = "1px #000000 solid";
                document.querySelector(".select_all_checkbox_custom").innerHTML = "";
    
            }

            if(checked_count === 0){
                document.querySelector(".selected_notifications_controls").innerHTML= "";
            }
        }
    } , true);
}

function CreateNotificationsControls(JSON_DATA){
    document.querySelector(".selected_notifications_controls").innerHTML="";

    let delete_button = document.createElement("button");
    delete_button.className="notifications_control_button";
    delete_button.id="delete_notifications";
    document.querySelector(".selected_notifications_controls").appendChild(delete_button);

    document.querySelector("#delete_notifications").innerHTML+=""+
    "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Capa_1' x='0px' y='0px' viewBox='0 0 489.7 489.7' style='enable-background:new 0 0 489.7 489.7;' xml:space='preserve'>"+
    "<g>"+
        "<g>"+
            "<g>"+
                "<path d='M411.8,131.7c-9.5,0-17.2,7.7-17.2,17.2v288.2c0,10.1-8.2,18.4-18.4,18.4H113.3c-10.1,0-18.4-8.2-18.4-18.4V148.8     c0-9.5-7.7-17.2-17.1-17.2c-9.5,0-17.2,7.7-17.2,17.2V437c0,29,23.6,52.7,52.7,52.7h262.9c29,0,52.7-23.6,52.7-52.7V148.8     C428.9,139.3,421.2,131.7,411.8,131.7z'/>"+
                "<path d='M457.3,75.9H353V56.1C353,25.2,327.8,0,296.9,0H192.7c-31,0-56.1,25.2-56.1,56.1v19.8H32.3c-9.5,0-17.1,7.7-17.1,17.2     s7.7,17.1,17.1,17.1h425c9.5,0,17.2-7.7,17.2-17.1C474.4,83.5,466.8,75.9,457.3,75.9z M170.9,56.1c0-12,9.8-21.8,21.8-21.8h104.2     c12,0,21.8,9.8,21.8,21.8v19.8H170.9V56.1z'/>"+
                "<path d='M262,396.6V180.9c0-9.5-7.7-17.1-17.1-17.1s-17.1,7.7-17.1,17.1v215.7c0,9.5,7.7,17.1,17.1,17.1     C254.3,413.7,262,406.1,262,396.6z'/>"+
                "<path d='M186.1,396.6V180.9c0-9.5-7.7-17.1-17.2-17.1s-17.1,7.7-17.1,17.1v215.7c0,9.5,7.7,17.1,17.1,17.1     C178.4,413.7,186.1,406.1,186.1,396.6z'/>"+
                "<path d='M337.8,396.6V180.9c0-9.5-7.7-17.1-17.1-17.1s-17.1,7.7-17.1,17.1v215.7c0,9.5,7.7,17.1,17.1,17.1     S337.8,406.1,337.8,396.6z'/>"+
            "</g>"+
        "</g>"+
    "</g>"+
    "</svg>"+
    "";

    let mark_read_button = document.createElement("button");
    mark_read_button.className="notifications_control_button";
    mark_read_button.id="mark_read_notifications";
    document.querySelector(".selected_notifications_controls").appendChild(mark_read_button);

    document.querySelector("#mark_read_notifications").innerHTML+=""+
    "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 512 512' style='enable-background:new 0 0 512 512;' xml:space='preserve'>"+
        "<g>"+
            "<g>"+
                "<path d='M256,0C115.03,0,0,115.05,0,256c0,140.97,115.05,256,256,256c140.97,0,256-115.05,256-256C512,115.03,396.95,0,256,0z     M256,482C131.383,482,30,380.617,30,256S131.383,30,256,30s226,101.383,226,226S380.617,482,256,482z'/>"+
            "</g>"+
        "</g>"+
    "</svg>"+
    "";

    let mark_unread_button = document.createElement("button");
    mark_unread_button.className="notifications_control_button";
    mark_unread_button.id="mark_unread_notifications";
    document.querySelector(".selected_notifications_controls").appendChild(mark_unread_button);

    document.querySelector("#mark_unread_notifications").innerHTML+=""+
    "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 512 512' style='enable-background:new 0 0 512 512;' xml:space='preserve'>"+
        "<g>"+
            "<g>"+
                "<path d='M256,0C115.39,0,0,115.39,0,256s115.39,256,256,256s256-115.39,256-256S396.61,0,256,0z'/>"+
            "</g>"+
        "</g>"+
    "</svg>"+
    "";

    document.querySelector("#delete_notifications").addEventListener("click" , function(){
        let checkbox = document.querySelectorAll(".notifications_checkbox");
        let Values = [];
        let indexes = [];

        for(let i = 0 ; i < checkbox.length ; ++i){
            if(checkbox[i].checked){
                Values.push(checkbox[i].value);
                indexes.push(parseInt(document.querySelectorAll(".notifications_item")[i].getAttribute("index")));
            }
        }

        let ID = document.querySelector(".USER").getAttribute("ID");

        CreateDeleteNotificationsPopUp(JSON_DATA,indexes,ID,Values);
    } , true);


    document.querySelector("#mark_read_notifications").addEventListener("click" , function(){
        let checkbox = document.querySelectorAll(".notifications_checkbox");
        let Values = [];
        let indexes = [];

        for(let i = 0 ; i < checkbox.length ; ++i){
            if(checkbox[i].checked){
                Values.push(checkbox[i].value);
                indexes.push(parseInt(document.querySelectorAll(".notifications_item")[i].getAttribute("index")));
            }
        }

        let ID = document.querySelector(".USER").getAttribute("ID");

        let Request = new XMLHttpRequest();
        let URL = URLROOT+"/User/NotificationMarkread";

        let data = {
            "ID" : ID,
            "Values" : Values
        };

        Request.open("POST" , URL , true);
        Request.send(JSON.stringify(data));

        Request.onreadystatechange = function(){
            if (this.status === 200) {
                if(this.readyState === 4){
                    let response = JSON.parse(Request.responseText);
                    let response_condition = response["message"];
                    if(response_condition === "Updated"){
                        for(let i = 0 ; i < Values.length ; ++i){
                            let notification_state = document.querySelector("#notifications_item_"+indexes[i]).getAttribute("state");

                            if(notification_state === "unread"){
                                document.querySelector("#notification_head_"+indexes[i]).style.fontWeight = "500";
                                document.querySelector("#notification_body_"+indexes[i]).style.fontWeight = "500";
                                document.querySelector("#notifications_item_"+indexes[i]).setAttribute("state" , "read");
                
                                let unread_count_new = parseInt(document.querySelector("#notifications_table").getAttribute("unread")) - 1;
                                document.querySelector("#notifications_table").setAttribute("unread" , unread_count_new);

                                if(unread_count_new !== 0){
                                    document.querySelector("#notifications_count_overview").innerHTML = unread_count_new;
                                    document.querySelector("#notifications_count_overview_information").innerHTML = "";
                                }

                                else{
                                    document.querySelector("#notifications_count_overview").innerHTML = "";
                                    document.querySelector("#notifications_count_overview_information").innerHTML = "No new notifications";
                                }
                            }
                        }

                        document.querySelector(".select_all_checkbox").checked = false;
                        document.querySelector(".select_all_checkbox_custom").style.backgroundColor = "transparent";
                        document.querySelector(".select_all_checkbox_custom").style.border = "1px #000000 solid";
                        document.querySelector(".select_all_checkbox_custom").innerHTML = "";
            
                        for(let i = 0 ; i < indexes.length ; ++i){
                            document.querySelector("#checkbox_"+indexes[i]).checked = false;
                            document.querySelector("#checkbox_custom_"+indexes[i]).style.backgroundColor = "transparent";
                            document.querySelector("#checkbox_custom_"+indexes[i]).style.border = "1px #000000 solid";
                            document.querySelector("#checkbox_custom_"+indexes[i]).innerHTML = "";
                        }
            
                        document.querySelector(".notifications_controls").setAttribute("checked_count" , 0);
                        document.querySelector(".selected_notifications_controls").innerHTML= "";

                        CreateUnMarkedMessage();
                    }

                    else{
                        CreateErrorMessage();
                    }
                }
            }

            else{
                CreateErrorMessage();
            }
        }
    } , true);



    document.querySelector("#mark_unread_notifications").addEventListener("click" , function(){
        let checkbox = document.querySelectorAll(".notifications_checkbox");
        let Values = [];
        let indexes = [];

        for(let i = 0 ; i < checkbox.length ; ++i){
            if(checkbox[i].checked){
                Values.push(checkbox[i].value);
                indexes.push(parseInt(document.querySelectorAll(".notifications_item")[i].getAttribute("index")));
            }
        }

        let ID = document.querySelector(".USER").getAttribute("ID");

        let Request = new XMLHttpRequest();
        let URL = URLROOT+"/User/NotificationMarkUnread";

        let data = {
            "ID" : ID,
            "Values" : Values
        };

        Request.open("POST" , URL , true);
        Request.send(JSON.stringify(data));

        Request.onreadystatechange = function(){
            if (this.status === 200) {
                if(this.readyState === 4){
                    let response = JSON.parse(Request.responseText);
                    let response_condition = response["message"];
                    if(response_condition === "Updated"){
                        for(let i = 0 ; i < Values.length ; ++i){
                            let notification_state = document.querySelector("#notifications_item_"+indexes[i]).getAttribute("state");

                            if(notification_state === "read"){
                                document.querySelector("#notification_head_"+indexes[i]).style.fontWeight = "700";
                                document.querySelector("#notification_body_"+indexes[i]).style.fontWeight = "700";
                                document.querySelector("#notifications_item_"+indexes[i]).setAttribute("state" , "unread");
                
                                let unread_count_new = parseInt(document.querySelector("#notifications_table").getAttribute("unread")) + 1;
                                document.querySelector("#notifications_table").setAttribute("unread" , unread_count_new);
                                document.querySelector("#notifications_count_overview").innerHTML = unread_count_new;
                                document.querySelector("#notifications_count_overview_information").innerHTML = "";
                            }
                        }

                        document.querySelector(".select_all_checkbox").checked = false;
                        document.querySelector(".select_all_checkbox_custom").style.backgroundColor = "transparent";
                        document.querySelector(".select_all_checkbox_custom").style.border = "1px #000000 solid";
                        document.querySelector(".select_all_checkbox_custom").innerHTML = "";
            
                        for(let i = 0 ; i < indexes.length ; ++i){
                            document.querySelector("#checkbox_"+indexes[i]).checked = false;
                            document.querySelector("#checkbox_custom_"+indexes[i]).style.backgroundColor = "transparent";
                            document.querySelector("#checkbox_custom_"+indexes[i]).style.border = "1px #000000 solid";
                            document.querySelector("#checkbox_custom_"+indexes[i]).innerHTML = "";
                        }
            
                        document.querySelector(".notifications_controls").setAttribute("checked_count" , 0);
                        document.querySelector(".selected_notifications_controls").innerHTML= "";

                        CreateMarkedMessage();
                    }

                    else{
                        CreateErrorMessage();
                    }
                }
            }

            else{
                CreateErrorMessage();
            }
        }
    } , true);
}






//pop ups
function CreateAcceptPopUp(JSON_DATA,index,value,name){
    let pop_up_actions_div = document.querySelector(".pop_up_actions");

    document.querySelector(".pop_up_information").innerHTML = "Confirm accept "+name+"?";

    let confirm_button =document.createElement("button");
    confirm_button.className = "confirm_pop_up";
    confirm_button.value = value;

    let confirm = document.createTextNode("Confirm");

    let cancel_button =document.createElement("button");
    cancel_button.className="cancel_pop_up";
    let cancel = document.createTextNode("Cancel");


    confirm_button.appendChild(confirm);
    cancel_button.appendChild(cancel);
    
    pop_up_actions_div.appendChild(confirm_button);
    pop_up_actions_div.appendChild(cancel_button);

    document.querySelector(".pop_ups_container").style.display= "block";


    //Accept request code
    document.querySelector(".confirm_pop_up").addEventListener("click" , function(){
        let Request = new XMLHttpRequest();
        let URL = URLROOT+"/Government/Accept";

        let data = {
            "Email" : value
        };

        Request.open("POST" , URL , true);
        Request.send(JSON.stringify(data));

        Request.onreadystatechange = function() {
            if (Request.status === 200) {
                if(Request.readyState === 4){
                    let response = JSON.parse(Request.responseText);
                    let response_condition = response["message"];
                    if(response_condition === "Accepted"){
                        //remove row if its accepted
                        document.querySelector("#request_table_row_"+index).remove();
                        //show the notification message for the user
                        CreateAcceptMessage();

                        //chnage where the table should stop on index and change the overall data count
                        let new_index = parseInt(document.querySelector("#requests_table").getAttribute("last"));
                        let new_count = parseInt(document.querySelector("#requests_table").getAttribute("count")) - 1;

                        //if there is more hidden rows then add it the table to fill the table to the desired rows per time
                        if(new_index < JSON_DATA.length){
                            CreateRequestTableRow(JSON_DATA,JSON_DATA[new_index],new_index);
                            document.querySelector("#requests_table").setAttribute("last",new_index+1);
                        }

                        //set the new count values to the HTML elements
                        document.querySelector("#requests_table").setAttribute("count",new_count);
                        let all_count_new =parseInt(document.querySelector("#requests_table").getAttribute("all_count")) - 1;
                        document.querySelector("#requests_table").setAttribute("all_count" , all_count_new);

                        //print the overall count in the overview sections
                        if(all_count_new !== 0){
                            document.querySelector("#requests_count_overview").innerHTML = all_count_new;
                        }

                        else{
                            document.querySelector("#requests_count_overview_information").innerHTML = "No new requests";
                        }
                        
                        //if the index reached 0 then there is nothing else to show
                        if(new_count === 0){
                            document.querySelector("#requests_table").innerHTML = "";
                            document.querySelector("#requests_information").innerHTML = "No new requests";  
                        }

                        //once the new row is entered if there nothing else after it then all the elements are printed so there is no need for the VIEW MORE button
                        if(new_index+1 >= JSON_DATA.length){
                            document.querySelector("#requests_view_more").innerHTML= "";
                        }

                        //close the pop when done
                        document.querySelector(".pop_ups_container").style.display= "none";
                        document.querySelector(".pop_up_information").innerHTML = "";
                        document.querySelector(".pop_up_actions").innerHTML = "";
                    }

                    else{
                        CreateErrorMessage();

                        document.querySelector(".pop_ups_container").style.display= "none";
                        document.querySelector(".pop_up_information").innerHTML = "";
                        document.querySelector(".pop_up_actions").innerHTML = "";
                    }
                }
            }

            else{
                CreateErrorMessage();

                document.querySelector(".pop_ups_container").style.display= "none";
                document.querySelector(".pop_up_information").innerHTML = "";
                document.querySelector(".pop_up_actions").innerHTML = "";
            }
        }
    } , true);
}

function CreateDeclinePopUp(JSON_DATA,index,value,name){
    let pop_up_actions_div = document.querySelector(".pop_up_actions");

    document.querySelector(".pop_up_information").innerHTML = "Confirm decline "+name+"?";

    let confirm_button =document.createElement("button");
    confirm_button.className = "confirm_pop_up";
    confirm_button.value = value;

    let confirm = document.createTextNode("Confirm");

    let cancel_button =document.createElement("button");
    cancel_button.className="cancel_pop_up";
    let cancel = document.createTextNode("Cancel");


    confirm_button.appendChild(confirm);
    cancel_button.appendChild(cancel);
    
    pop_up_actions_div.appendChild(confirm_button);
    pop_up_actions_div.appendChild(cancel_button);

    document.querySelector(".pop_ups_container").style.display= "block";



    document.querySelector(".confirm_pop_up").addEventListener("click" , function(){
        let Request = new XMLHttpRequest();
        let URL = URLROOT+"/Government/Decline";

        let data = {
            "Email" : value
        };

        Request.open("POST" , URL , true);
        Request.send(JSON.stringify(data));

        Request.onreadystatechange = function() {
            if (Request.status === 200) {
                if(Request.readyState === 4){
                    let response = JSON.parse(Request.responseText);
                    let response_condition = response["message"];
                    if(response_condition === "Declined"){
                        document.querySelector("#request_table_row_"+index).remove();
                        CreateDeclineMessage();


                        let new_index = parseInt(document.querySelector("#requests_table").getAttribute("last"));
                        let new_count = parseInt(document.querySelector("#requests_table").getAttribute("count")) - 1;

                        if(new_index < JSON_DATA.length){
                            CreateRequestTableRow(JSON_DATA,JSON_DATA[new_index],new_index);
                            document.querySelector("#requests_table").setAttribute("last",new_index+1);
                        }

                        document.querySelector("#requests_table").setAttribute("count",new_count);
                        let all_count_new =parseInt(document.querySelector("#requests_table").getAttribute("all_count")) - 1;
                        document.querySelector("#requests_table").setAttribute("all_count" , all_count_new);

                        if(all_count_new !== 0){
                            document.querySelector("#requests_count_overview").innerHTML = all_count_new;
                        }

                        else{
                            document.querySelector("#requests_count_overview_information").innerHTML = "No new requests";
                        }
                        
                        if(new_count === 0){
                            document.querySelector("#requests_table").innerHTML = "";
                            document.querySelector("#requests_information").innerHTML = "No new requests";
                        }

                        if(new_index+1 >= JSON_DATA.length){
                            document.querySelector("#requests_view_more").innerHTML= "";
                        }

                        document.querySelector(".pop_ups_container").style.display= "none";

                        document.querySelector(".pop_up_information").innerHTML = "";
                        document.querySelector(".pop_up_actions").innerHTML = "";
                    }

                    else{
                        CreateErrorMessage();

                        document.querySelector(".pop_ups_container").style.display= "none";
                        document.querySelector(".pop_up_information").innerHTML = "";
                        document.querySelector(".pop_up_actions").innerHTML = "";
                    }
                }
            }

            else{
                CreateErrorMessage();

                document.querySelector(".pop_ups_container").style.display= "none";
                document.querySelector(".pop_up_information").innerHTML = "";
                document.querySelector(".pop_up_actions").innerHTML = "";
            }
        }
    } , true);
}


function CreateDeleteNotificationsPopUp(JSON_DATA,indexes,ID,Values){
    let pop_up_actions_div = document.querySelector(".pop_up_actions");

    document.querySelector(".pop_up_information").innerHTML = "Confirm Delete "+Values.length+" Notifications?";

    let delete_button =document.createElement("button");
    delete_button.className = "delete_pop_up";

    let delete_text = document.createTextNode("Delete");

    let cancel_button =document.createElement("button");
    cancel_button.className="cancel_pop_up";
    let cancel = document.createTextNode("Cancel");


    delete_button.appendChild(delete_text);
    cancel_button.appendChild(cancel);
    
    pop_up_actions_div.appendChild(delete_button);
    pop_up_actions_div.appendChild(cancel_button);

    document.querySelector(".pop_ups_container").style.display= "block";



    document.querySelector(".delete_pop_up").addEventListener("click" , function(){
        let Request = new XMLHttpRequest();
        let URL = URLROOT+"/User/NotificationDelete";

        let data = {
            "ID" : ID,
            "Values" : Values
        };

        Request.open("POST" , URL , true);
        Request.send(JSON.stringify(data));

        Request.onreadystatechange = function(){
            if (this.status === 200) {
                if(this.readyState === 4){
                    let response = JSON.parse(Request.responseText);
                    let response_condition = response["message"];
                    if(response_condition === "Deleted"){
                        for(let i = 0 ; i < Values.length ; ++i){
                            let notification_state = document.querySelector("#notifications_item_"+indexes[i]).getAttribute("state");

                            if(notification_state === "unread"){
                                let unread_count_new = parseInt(document.querySelector("#notifications_table").getAttribute("unread")) - 1;
                                document.querySelector("#notifications_table").setAttribute("unread" , unread_count_new);

                                if(unread_count_new !== 0){
                                    document.querySelector("#notifications_count_overview").innerHTML = unread_count_new;
                                    document.querySelector("#notifications_count_overview_information").innerHTML = "";
                                }

                                else{
                                    document.querySelector("#notifications_count_overview").innerHTML = "";
                                    document.querySelector("#notifications_count_overview_information").innerHTML = "No new notifications";
                                }
                            }

                            document.querySelector("#notifications_item_"+indexes[i]).remove();
                            CreateNotificationDeleteMessage();

                            let new_index = parseInt(document.querySelector("#notifications_table").getAttribute("last"));
                            let new_count = parseInt(document.querySelector("#notifications_table").getAttribute("count")) - 1;
                            document.querySelector("#notifications_table").setAttribute("count",new_count);
                            let all_count_new =parseInt(document.querySelector("#notifications_table").getAttribute("all_count")) - 1;
                            document.querySelector("#notifications_table").setAttribute("all_count" , all_count_new);

                            if(new_index < JSON_DATA.length){
                                CreateNotificationRow(JSON_DATA,JSON_DATA[new_index],new_index);
                                document.querySelector("#notifications_table").setAttribute("last",new_index+1);
                            }
                            
                            if(new_count === 0){
                                document.querySelector("#notifications_table").innerHTML = "";
                                document.querySelector("#notifications_information").innerHTML = "No new requests";
                                document.querySelector(".notifications_controls").innerHTML = "";
                            }

                            else{
                                document.querySelector(".select_all_checkbox").checked = false;
                                document.querySelector(".select_all_checkbox_custom").style.backgroundColor = "transparent";
                                document.querySelector(".select_all_checkbox_custom").style.border = "1px #000000 solid";
                                document.querySelector(".select_all_checkbox_custom").innerHTML = "";
                    
                                document.querySelector(".notifications_controls").setAttribute("checked_count" , 0);
                                document.querySelector(".selected_notifications_controls").innerHTML= "";
                            }
    
                            if(new_index+1 >= JSON_DATA.length){
                                document.querySelector("#notifications_view_more").innerHTML= "";
                            }
    
                            document.querySelector(".pop_ups_container").style.display= "none";
    
                            document.querySelector(".pop_up_information").innerHTML = "";
                            document.querySelector(".pop_up_actions").innerHTML = "";
                        }
                    }

                    else{
                        CreateErrorMessage();
                    }
                }
            }

            else{
                CreateErrorMessage();
            }
        }
    } , true);
}




//notifications
function CreateErrorMessage(){
    let Message="<div class='alert' style='opcaity:0;'>"+
                    "<div class='error_alert_info_container'>"+
                        "<div class='alert_title'>Something went wrong...</div>"+

                        "<div class='error_alert_icon_container'>"+
                            "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 492 492' style='enable-background:new 0 0 492 492;' xml:space='preserve'>"+
                                "<g>"+
                                    "<g>"+
                                        "<path d='M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872    c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872    c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052    L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116    c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952    c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116    c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z'/>"+
                                    "</g>"+
                                "</g>"+
                            "</svg>"+
                        "</div>"+
                    "</div>"+
                "</div>";

    document.querySelector(".alert_container").innerHTML= Message;

    let alerts = document.querySelectorAll(".alert");

    setTimeout(function(){
        alerts[alerts.length - 1].style.opacity = "1";
    } , 50);

    setTimeout(function(){
        alerts[alerts.length - 1].style.opacity = "0";
    } , 3000);

    setTimeout(function(){
        alerts[alerts.length - 1].remove();
    } , 3200);
}

function CreateAcceptMessage(){
    let Message="<div class='alert' style='opcaity:0;'>"+
                    "<div class='alert_info_container'>"+
                        "<div class='alert_title'>Company accepted</div>"+

                        "<div class='alert_icon_container'>"+
                            "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 512 512' style='enable-background:new 0 0 512 512;' xml:space='preserve'>"+
                                "<g>"+
                                    "<g>"+
                                        "<path d='M504.502,75.496c-9.997-9.998-26.205-9.998-36.204,0L161.594,382.203L43.702,264.311c-9.997-9.998-26.205-9.997-36.204,0    c-9.998,9.997-9.998,26.205,0,36.203l135.994,135.992c9.994,9.997,26.214,9.99,36.204,0L504.502,111.7    C514.5,101.703,514.499,85.494,504.502,75.496z'/>"+
                                    "</g>"+
                                "</g>"+
                            "</svg>"+
                        "</div>"+
                    "</div>"+
                "</div>";

    document.querySelector(".alert_container").innerHTML= Message;

    let alerts = document.querySelectorAll(".alert");

    setTimeout(function(){
        alerts[alerts.length - 1].style.opacity = "1";
    } , 50);

    setTimeout(function(){
        alerts[alerts.length - 1].style.opacity = "0";
    } , 3000);

    setTimeout(function(){
        alerts[alerts.length - 1].remove();
    } , 3200);
}


function CreateDeclineMessage(){
    let Message="<div class='alert' style='opcaity:0;'>"+
                    "<div class='alert_info_container'>"+
                        "<div class='alert_title'>Company declined</div>"+

                        "<div class='alert_icon_container'>"+
                            "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 492 492' style='enable-background:new 0 0 492 492;' xml:space='preserve'>"+
                                "<g>"+
                                    "<g>"+
                                        "<path d='M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872    c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872    c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052    L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116    c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952    c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116    c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z'/>"+
                                    "</g>"+
                                "</g>"+
                            "</svg>"+
                        "</div>"+
                    "</div>"+
                "</div>";

    document.querySelector(".alert_container").innerHTML= Message;

    let alerts = document.querySelectorAll(".alert");

    setTimeout(function(){
        alerts[alerts.length - 1].style.opacity = "1";
    } , 50);

    setTimeout(function(){
        alerts[alerts.length - 1].style.opacity = "0";
    } , 3000);

    setTimeout(function(){
        alerts[alerts.length - 1].remove();
    } , 3200);
}


function CreateMarkedMessage(){
    let Message="<div class='alert' style='opcaity:0;'>"+
                    "<div class='alert_info_container'>"+
                        "<div class='alert_title'>Notifications marked</div>"+

                        "<div class='alert_icon_container'>"+
                            "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 512 512' style='enable-background:new 0 0 512 512;' xml:space='preserve'>"+
                                "<g>"+
                                    "<g>"+
                                        "<path d='M256,0C115.39,0,0,115.39,0,256s115.39,256,256,256s256-115.39,256-256S396.61,0,256,0z'/>"+
                                    "</g>"+
                                "</g>"+
                            "</svg>"+
                        "</div>"+
                    "</div>"+
                "</div>";

    document.querySelector(".alert_container").innerHTML= Message;

    let alerts = document.querySelectorAll(".alert");

    setTimeout(function(){
        alerts[alerts.length - 1].style.opacity = "1";
    } , 50);

    setTimeout(function(){
        alerts[alerts.length - 1].style.opacity = "0";
    } , 3000);

    setTimeout(function(){
        alerts[alerts.length - 1].remove();
    } , 3200);
}

function CreateUnMarkedMessage(){
    let Message="<div class='alert' style='opcaity:0;'>"+
                    "<div class='alert_info_container'>"+
                        "<div class='alert_title'>Notifications marked</div>"+

                        "<div class='alert_icon_container'>"+
                            "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 512 512' style='enable-background:new 0 0 512 512;' xml:space='preserve'>"+
                                "<g>"+
                                    "<g>"+
                                        "<path d='M256,0C115.03,0,0,115.05,0,256c0,140.97,115.05,256,256,256c140.97,0,256-115.05,256-256C512,115.03,396.95,0,256,0z     M256,482C131.383,482,30,380.617,30,256S131.383,30,256,30s226,101.383,226,226S380.617,482,256,482z'/>"+
                                    "</g>"+
                                "</g>"+
                            "</svg>"+
                        "</div>"+
                    "</div>"+
                "</div>";

    document.querySelector(".alert_container").innerHTML= Message;

    let alerts = document.querySelectorAll(".alert");

    setTimeout(function(){
        alerts[alerts.length - 1].style.opacity = "1";
    } , 50);

    setTimeout(function(){
        alerts[alerts.length - 1].style.opacity = "0";
    } , 3000);

    setTimeout(function(){
        alerts[alerts.length - 1].remove();
    } , 3200);
}

function CreateNotificationDeleteMessage(){
    let Message="<div class='alert' style='opcaity:0;'>"+
                    "<div class='alert_info_container'>"+
                        "<div class='alert_title'>Notifications marked</div>"+

                        "<div class='alert_icon_container'>"+
                            "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Capa_1' x='0px' y='0px' viewBox='0 0 489.7 489.7' style='enable-background:new 0 0 489.7 489.7;' xml:space='preserve'>"+
                                "<g>"+
                                    "<g>"+
                                        "<g>"+
                                            "<path d='M411.8,131.7c-9.5,0-17.2,7.7-17.2,17.2v288.2c0,10.1-8.2,18.4-18.4,18.4H113.3c-10.1,0-18.4-8.2-18.4-18.4V148.8     c0-9.5-7.7-17.2-17.1-17.2c-9.5,0-17.2,7.7-17.2,17.2V437c0,29,23.6,52.7,52.7,52.7h262.9c29,0,52.7-23.6,52.7-52.7V148.8     C428.9,139.3,421.2,131.7,411.8,131.7z'/>"+
                                            "<path d='M457.3,75.9H353V56.1C353,25.2,327.8,0,296.9,0H192.7c-31,0-56.1,25.2-56.1,56.1v19.8H32.3c-9.5,0-17.1,7.7-17.1,17.2     s7.7,17.1,17.1,17.1h425c9.5,0,17.2-7.7,17.2-17.1C474.4,83.5,466.8,75.9,457.3,75.9z M170.9,56.1c0-12,9.8-21.8,21.8-21.8h104.2     c12,0,21.8,9.8,21.8,21.8v19.8H170.9V56.1z'/>"+
                                            "<path d='M262,396.6V180.9c0-9.5-7.7-17.1-17.1-17.1s-17.1,7.7-17.1,17.1v215.7c0,9.5,7.7,17.1,17.1,17.1     C254.3,413.7,262,406.1,262,396.6z'/>"+
                                            "<path d='M186.1,396.6V180.9c0-9.5-7.7-17.1-17.2-17.1s-17.1,7.7-17.1,17.1v215.7c0,9.5,7.7,17.1,17.1,17.1     C178.4,413.7,186.1,406.1,186.1,396.6z'/>"+
                                            "<path d='M337.8,396.6V180.9c0-9.5-7.7-17.1-17.1-17.1s-17.1,7.7-17.1,17.1v215.7c0,9.5,7.7,17.1,17.1,17.1     S337.8,406.1,337.8,396.6z'/>"+
                                        "</g>"+
                                    "</g>"+
                                "</g>"+
                            "</svg>"+
                        "</div>"+
                    "</div>"+
                "</div>";

    document.querySelector(".alert_container").innerHTML= Message;

    let alerts = document.querySelectorAll(".alert");

    setTimeout(function(){
        alerts[alerts.length - 1].style.opacity = "1";
    } , 50);

    setTimeout(function(){
        alerts[alerts.length - 1].style.opacity = "0";
    } , 3000);

    setTimeout(function(){
        alerts[alerts.length - 1].remove();
    } , 3200);
}

window.addEventListener("DOMContentLoaded" , function(){
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



    var count_per_time = 10;


    GetRequests(count_per_time);
    document.querySelector("#refresh_requests").addEventListener("click" , function(){
        GetRequests(count_per_time);
    } , true);

    document.querySelector("#requests_search_button").addEventListener("click" , function(){
        GetRequestsSearch(count_per_time);
    } , true);




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
                AllRequests = JSON_DATA;
            
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

    //get the beginning and the end of the loop
    let min = index;
    let max = index + count_per_time;

    if(max > JSON_DATA.length){
        max = JSON_DATA.length;
    }
    
    for(let i = min ; i < max ; ++i){
        CreateRequestTableRow(JSON_DATA,JSON_DATA[i],i);
    }

    document.querySelector("#requests_table").setAttribute("last",max);
    
    //create view more button
    if(max < JSON_DATA.length){
        let requests_view_more_button = document.createElement("button");
        requests_view_more_button.className="view_more_button";
        requests_view_more_button.id= "requests_view_more_button";

        requests_view_more_button_text = document.createTextNode("View more");
        
        requests_view_more_button.appendChild(requests_view_more_button_text);

        document.querySelector("#requests_view_more").innerHTML="";
        document.querySelector("#requests_view_more").appendChild(requests_view_more_button);

        document.querySelector("#requests_view_more_button").addEventListener("click" , function(){
            let index = parseInt(document.querySelector("#requests_table").getAttribute("last"));
            let new_index = index + count_per_time;

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


    document.querySelector("#accept_request_"+index).addEventListener("click" , function(){
        CreateAcceptPopUp(JSON_DATA,index,Row["email"],Row["name"]);
    } , true);

    document.querySelector("#decline_request_"+index).addEventListener("click" , function(){
        CreateDeclinePopUp(JSON_DATA,index,Row["email"],Row["name"]);
    } , true);
}






//pop ups
function CreateAcceptPopUp(JSON_DATA,index,value,name){
    let pop_up_actions_div = document.querySelector(".pop_up_actions");

    document.querySelector(".pop_up_information").innerHTML = "Confirm accept "+name;

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
        let URL = URLROOT+"/Government/Accept";

        let data = {
            "Email" : value
        };

        Request.open("POST" , URL , true);
        Request.send(JSON.stringify(data));

        Request.onreadystatechange = function() {
            if (Request.status === 200) {
                if(Request.readyState === 4){
                    document.querySelector("#request_table_row_"+index).remove();
                    CreateAcceptMessage();


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

    document.querySelector(".pop_up_information").innerHTML = "Confirm decline "+name;

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

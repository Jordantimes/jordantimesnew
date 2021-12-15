//pop_up_division control
document.querySelector(".pop_ups_container").addEventListener("click" , function(event){
    if(event.target.className === "pop_ups_container" || event.target.className === "cancel_pop_up"){
        document.querySelector(".pop_ups_container").style.display= "none";
        document.querySelector("body").style.overflow= "auto";

        document.querySelector(".pop_up_information").innerHTML = "";
        document.querySelector(".pop_up_actions").innerHTML = "";
    }
} , true);



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
    document.querySelector("body").style.overflow= "hidden";


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
                            document.querySelector("#requests_counter").innerHTML = all_count_new;
                        }

                        else{
                            document.querySelector("#requests_counter").innerHTML = "";
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
                        document.querySelector("body").style.overflow= "auto";
                    }

                    else{
                        CreateErrorMessage();

                        document.querySelector(".pop_ups_container").style.display= "none";
                        document.querySelector(".pop_up_information").innerHTML = "";
                        document.querySelector(".pop_up_actions").innerHTML = "";
                        document.querySelector("body").style.overflow= "auto";
                    }
                }
            }

            else{
                CreateErrorMessage();

                document.querySelector(".pop_ups_container").style.display= "none";
                document.querySelector(".pop_up_information").innerHTML = "";
                document.querySelector(".pop_up_actions").innerHTML = "";
                document.querySelector("body").style.overflow= "auto";
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
    document.querySelector("body").style.overflow= "hidden";



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
                            document.querySelector("#requests_counter").innerHTML = all_count_new;
                        }

                        else{
                            document.querySelector("#requests_counter").innerHTML = "";
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
                        document.querySelector("body").style.overflow= "auto";
                    }

                    else{
                        CreateErrorMessage();

                        document.querySelector(".pop_ups_container").style.display= "none";
                        document.querySelector(".pop_up_information").innerHTML = "";
                        document.querySelector(".pop_up_actions").innerHTML = "";
                        document.querySelector("body").style.overflow= "auto";
                    }
                }
            }

            else{
                CreateErrorMessage();

                document.querySelector(".pop_ups_container").style.display= "none";
                document.querySelector(".pop_up_information").innerHTML = "";
                document.querySelector(".pop_up_actions").innerHTML = "";
                document.querySelector("body").style.overflow= "auto";
            }
        }
    } , true);
}


function CreateDeleteNotificationsPopUp(JSON_DATA,indexes,Values){
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
    document.querySelector("body").style.overflow= "hidden";


    document.querySelector(".delete_pop_up").addEventListener("click" , function(){
        let Request = new XMLHttpRequest();
        let URL = URLROOT+"/User/NotificationDelete";

        let data = {
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
                                    document.querySelector("#notifications_counter").innerHTML = unread_count_new;
                                }

                                else{
                                    document.querySelector("#notifications_counter").innerHTML = "";
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
                            document.querySelector("body").style.overflow= "auto";
                        }
                    }

                    else{
                        CreateErrorMessage();
                        document.querySelector(".pop_ups_container").style.display= "none";
                        document.querySelector(".pop_up_information").innerHTML = "";
                        document.querySelector(".pop_up_actions").innerHTML = "";
                        document.querySelector("body").style.overflow= "auto";
                    }
                }
            }

            else{
                CreateErrorMessage();
                document.querySelector(".pop_ups_container").style.display= "none";
                document.querySelector(".pop_up_information").innerHTML = "";
                document.querySelector(".pop_up_actions").innerHTML = "";
                document.querySelector("body").style.overflow= "auto";
            }
        }
    } , true);
}

function CreateAcceptTripPopup(siteID,siteIndex){
    let pop_up_actions_div = document.querySelector(".pop_up_actions");

    document.querySelector(".pop_up_information").innerHTML = "Confirm accept trip?";

    let confirm_button =document.createElement("button");
    confirm_button.className = "confirm_pop_up";

    let confirm = document.createTextNode("Confirm");

    let cancel_button =document.createElement("button");
    cancel_button.className="cancel_pop_up";
    let cancel = document.createTextNode("Cancel");


    confirm_button.appendChild(confirm);
    cancel_button.appendChild(cancel);
    
    pop_up_actions_div.appendChild(confirm_button);
    pop_up_actions_div.appendChild(cancel_button);

    document.querySelector(".pop_ups_container").style.display= "block";
    document.querySelector("body").style.overflow= "hidden";


    document.querySelector(".confirm_pop_up").addEventListener("click" , function(){
        var Request = new XMLHttpRequest();
        var URL = URLROOT+"/Admin/AcceptTrip";
        var data = {
            "ID" : siteID
        }

        Request.open("POST" , URL , true);
        Request.send(JSON.stringify(data));

        Request.onreadystatechange = function(){
            if (this.status === 200) {
                if(this.readyState === 4){
                    let res = JSON.parse(Request.response);
                    
                    if(res["message"] === "Accepted"){
                        CreateTripAcceptMessage();
                        document.querySelector("#site"+siteIndex).remove();

                        document.querySelector("#trips_counter").innerText = parseInt(document.querySelector("#trips_counter").innerText) - 1;

                        if(document.querySelector("#trips_counter").innerText === "0"){
                            document.querySelector("#trips_counter").innerText = "";
                        }

                        document.querySelector(".pop_up_site_details_container").style.display= "none";
                        document.querySelector(".pop_up_site_details_container").setAttribute("condition" , "hidden");

                        document.querySelector(".pop_ups_container").style.display= "none";
                        document.querySelector(".pop_up_information").innerHTML = "";
                        document.querySelector(".pop_up_actions").innerHTML = "";
                        document.querySelector("body").style.overflow= "auto";
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

function CreateDeclineTripPopup(siteID,siteIndex){
    let pop_up_actions_div = document.querySelector(".pop_up_actions");

    document.querySelector(".pop_up_information").innerHTML = "Confirm decline trip?";

    let confirm_button =document.createElement("button");
    confirm_button.className = "confirm_pop_up";

    let confirm = document.createTextNode("Confirm");

    let cancel_button =document.createElement("button");
    cancel_button.className="cancel_pop_up";
    let cancel = document.createTextNode("Cancel");


    confirm_button.appendChild(confirm);
    cancel_button.appendChild(cancel);
    
    pop_up_actions_div.appendChild(confirm_button);
    pop_up_actions_div.appendChild(cancel_button);

    document.querySelector(".pop_ups_container").style.display= "block";
    document.querySelector("body").style.overflow= "hidden";


    document.querySelector(".confirm_pop_up").addEventListener("click" , function(){
        var Request = new XMLHttpRequest();
        var URL = URLROOT+"/Admin/DeclineTrip";
        var data = {
            "ID" : siteID
        }

        Request.open("POST" , URL , true);
        Request.send(JSON.stringify(data));

        Request.onreadystatechange = function(){
            if (this.status === 200) {
                if(this.readyState === 4){
                    let res = JSON.parse(Request.response);
                    
                    if(res["message"] === "Declined"){
                        CreateTripDeclineMessage();
                        document.querySelector("#site"+siteIndex).remove();

                        document.querySelector("#trips_counter").innerText = parseInt(document.querySelector("#trips_counter").innerText) - 1;

                        if(document.querySelector("#trips_counter").innerText === "0"){
                            document.querySelector("#trips_counter").innerText = "";
                        }

                        document.querySelector(".pop_up_site_details_container").style.display= "none";
                        document.querySelector(".pop_up_site_details_container").setAttribute("condition" , "hidden");

                        document.querySelector(".pop_ups_container").style.display= "none";
                        document.querySelector(".pop_up_information").innerHTML = "";
                        document.querySelector(".pop_up_actions").innerHTML = "";
                        document.querySelector("body").style.overflow= "auto";
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

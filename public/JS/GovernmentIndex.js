window.addEventListener("DOMContentLoaded" , function(){
    nav_buttons = document.querySelectorAll(".navigation_button");
    nav_buttons[0].style.backgroundColor ="#eeeeee";
    var view_box = 0;

    GetRequests(10);

    for (let i = 0; i < nav_buttons.length; ++i) {
        nav_buttons[i].addEventListener("click" , function(){
            document.querySelectorAll(".content_view_box")[view_box].style.display = "none";
            nav_buttons[view_box].style.backgroundColor = "transparent";
            document.querySelectorAll(".content_view_box")[i].style.display="block";
            nav_buttons[i].style.backgroundColor = "#eeeeee";

            view_box = i;
        } , true);
    }
} , true);

function GetRequests(count_per_view){
    let Request = new XMLHttpRequest();
    let URL = URLROOT+"/Government/Requests";

    Request.open("GET" , URL , true);
    Request.send();

    Request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            let JSON_DATA = JSON.parse(Request.response);
            
            if(JSON_DATA.length == 0){
                document.querySelector("#requests_information").innerHTML = "No new requests";
                document.querySelector("#requests_count_overview_information").innerHTML = "No new requests";
            }

            else{
                index = 1;
                document.querySelector("#requests_count_overview").innerHTML = JSON_DATA.length;
                CreateViewRequests(JSON_DATA,index,count_per_view,0);
            }
        }
    };
}

function CreateViewRequests(JSON_DATA ,index , count_per_view,button_index){
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

    let max = index * count_per_view;
    let min = max - count_per_view;

    if(max > JSON_DATA.length){
        max = JSON_DATA.length;
    }

    for(let k = min ; k < max ; k++){
        document.querySelector("#requests_table").innerHTML+= CreateRequestTableRow(JSON_DATA[k]);

        CreateViewIndexes(JSON_DATA.length,count_per_view,index,button_index);

        var indexes = document.querySelectorAll("#index_button_request");
        for(let j = 0 ; j< indexes.length ; ++j){
            indexes[j].addEventListener("click", function(){
                for (let k = 0; k < indexes.length; k++) {
                    indexes[k].className="index_button";
                }
                indexes[j].className="index_button_selected";
                index = indexes[j].value;

                CreateViewRequests(JSON_DATA,index,count_per_view,j);
            } , true);
        }

        var accept_request_button = document.querySelectorAll(".accept_request");
            for(let i = 0 ; i < accept_request_button.length ; ++i){
                accept_request_button[i].addEventListener("click" , function(){
                    let data = {
                        "Email" : accept_request_button[i].value
                    };

                    let Request_Accept = new XMLHttpRequest();
                    let URL = URLROOT+"/Government/Accept";

                    Request_Accept.open("POST" , URL , true);
                    Request_Accept.send(JSON.stringify(data));
                    Request_Accept.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            let JSON_Message = JSON.parse(Request_Accept.response);

                            if(JSON_Message["message"] === "accepted"){
                                JSON_DATA.splice(i,1);

                                if(min == JSON_DATA.length){
                                    index--;
                                }

                                CreateViewRequests(JSON_DATA , index , count_per_view,button_index);
                            }
                        }
                    }
                } , true);
            }

            var accept_request_button = document.querySelectorAll(".decline_request");
            for(let i = 0 ; i < accept_request_button.length ; ++i){
                accept_request_button[i].addEventListener("click" , function(){
                    let data = {
                        "Email" : accept_request_button[i].value
                    };

                    let Request_Decline = new XMLHttpRequest();
                    let URL = URLROOT+"/Government/Decline";

                    Request_Decline.open("POST" , URL , true);
                    Request_Decline.send(JSON.stringify(data));
                    Request_Decline.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            let JSON_Message = JSON.parse(Request_Decline.response);

                            if(JSON_Message["message"] === "Declined"){
                                JSON_DATA.splice(i,1);

                                if(min == JSON_DATA.length){
                                    index--;
                                }

                                console.log(min);

                                CreateViewRequests(JSON_DATA , index , count_per_view,button_index);
                            }
                        }
                    }
                } , true);
            }
    }
}

function CreateRequestTableRow(JSON_DATA){
    var Row = "<tr id='request_table_row'>"+
            "<td>"+JSON_DATA["company_ID"]+"</td>"+
            "<td>"+JSON_DATA["company_Number"]+"</td>"+
            "<td>"+JSON_DATA["name"]+"</td>"+
            "<td>"+JSON_DATA["email"]+"</td>"+
            "<td>"+JSON_DATA["phone"]+"</td>"+
            "<td>"+JSON_DATA["CreatedAt"]+"</td>"+
            "<td class='accept_index'><button class='accept_request' value='"+JSON_DATA["email"]+"'>Accept</button></td>"+
            "<td class='decline_index'><button class='decline_request' value='"+JSON_DATA["email"]+"'>Decline</button></td>"+
            "</tr>"    
    ;

    return Row;
}

function CreateViewIndexes(length,count_per_view,selected,button_index){
    document.querySelector("#request_first_index").innerHTML="";
    document.querySelector("#request_mid_index").innerHTML="";
    document.querySelector("#request_last_index").innerHTML="";
    document.querySelector("#request_space_index_1").innerHTML ="";
    document.querySelector("#request_space_index_2").innerHTML ="";

    selected = parseInt(selected);

    let top = Math.ceil(length / count_per_view);

    if(top <= 7){
        if(top === 1){
            document.querySelector("#request_first_index").innerHTML= "<button class='index_button' id='index_button_request' value='1'>1</button>";
        }

        else{
            document.querySelector("#request_first_index").innerHTML= "<button class='index_button' id='index_button_request' value='1'>1</button>";
            document.querySelector("#request_last_index").innerHTML= "<button class='index_button' id='index_button_request' value='"+top+"'>"+top+"</button>";
        }
        
        document.querySelector("#request_mid_index").innerHTML="";
        for (let i = 2; i <= top - 1 ; ++i) {
            document.querySelector("#request_mid_index").innerHTML+="<button class='index_button' id='index_button_request' value='"+i+"'>"+i+"</button>";
        }

        document.querySelectorAll("#index_button_request")[selected - 1].className="index_button_selected";
    }

    else{
            if(selected < 4){
                document.querySelector("#request_first_index").innerHTML= "<button class='index_button' id='index_button_request' value='1'>1</button>";
                document.querySelector("#request_last_index").innerHTML= "<button class='index_button' id='index_button_request' value='"+top+"'>"+top+"</button>";

                document.querySelector("#request_mid_index").innerHTML="";
                for(let i = 2; i < 5 ; ++i) {
                    document.querySelector("#request_mid_index").innerHTML+="<button class='index_button' id='index_button_request' value='"+i+"'>"+i+"</button>";
                }

                document.querySelector("#request_space_index_1").innerHTML ="";
                document.querySelector("#request_space_index_2").innerHTML ="...";

                let buttons = document.querySelectorAll("#index_button_request");
                for(let i = 0 ; i< buttons.length ; ++i){
                    if(buttons[i].value == selected){
                        document.querySelectorAll("#index_button_request")[i].className="index_button_selected";
                    }
                }
            }

            else if(selected > length - 3){
                document.querySelector("#request_first_index").innerHTML= "<button class='index_button' id='index_button_request' value='1'>1</button>";
                document.querySelector("#request_last_index").innerHTML= "<button class='index_button' id='index_button_request' value='"+top+"'>"+top+"</button>";


                document.querySelector("#request_space_index_1").innerHTML ="...";
                document.querySelector("#request_space_index_2").innerHTML ="";

                document.querySelector("#request_mid_index").innerHTML="";
                for(let i = length - 3; i < length ; ++i) {
                    document.querySelector("#request_mid_index").innerHTML+="<button class='index_button' id='index_button_request' value='"+i+"'>"+i+"</button>";
                }

                let buttons = document.querySelectorAll("#index_button_request");
                for(let i = 0 ; i< buttons.length ; ++i){
                    if(buttons[i].value == selected){
                        document.querySelectorAll("#index_button_request")[i].className="index_button_selected";
                    }
                }
            }

            else{
                document.querySelector("#request_first_index").innerHTML= "<button class='index_button' id='index_button_request' value='1'>1</button>";
                document.querySelector("#request_last_index").innerHTML= "<button class='index_button' id='index_button_request' value='"+top+"'>"+top+"</button>";


                document.querySelector("#request_space_index_1").innerHTML ="...";
                document.querySelector("#request_space_index_2").innerHTML ="...";

                document.querySelector("#request_mid_index").innerHTML="";
                for(let i = selected-1; i < selected+2 ; ++i) { 
                    document.querySelector("#request_mid_index").innerHTML+="<button class='index_button' id='index_button_request' value='"+i+"'>"+i+"</button>";
                }

                document.querySelectorAll("#index_button_request")[2].className="index_button_selected";

            }
    }
}

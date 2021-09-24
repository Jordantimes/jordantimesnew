window.addEventListener("DOMContentLoaded" , function(){
    nav_buttons = document.querySelectorAll(".navigation_button");
    nav_buttons[0].style.backgroundColor ="#eeeeee";
    var view_box = 0;

    GetRequests();

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

function GetRequests(){
    let Request = new XMLHttpRequest();
    let URL = URLROOT+"/Government/Requests";

    Request.open("GET" , URL , true);
    Request.send();

    Request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            let JSON_DATA = JSON.parse(Request.response);

            document.querySelector("#requests_count").innerHTML = JSON_DATA.length;
            
            if(JSON_DATA.length == 0){
                document.querySelector("#requests_information").innerHTML = "No new requests";
            }

            else{
                var headers = "<tr>"+
                    "<th>Company ID</th>"+
                    "<th>Company Number</th>"+
                    "<th>Company Name</th>"+
                    "<th>Email</th>"+
                    "<th>Phone Number</th>"+
                    "<th>Requested At</th>"+
                    "</tr>"    
                    ;
                document.querySelector("#requests_table").innerHTML= headers;

                count_per_view = 10;
                index = 0;

                CreateView(JSON_DATA,"#requests_table",(index+1),count_per_view);

                CreateViewIndexes(JSON_DATA.length,count_per_view,"#requests_indexes");

                var indexes = document.querySelectorAll("#index_button_request");
                for(let j = 0 ; j< indexes.length ; ++j){
                    indexes[j].addEventListener("click", function(){
                        document.querySelector("#requests_table").innerHTML= "";
                        document.querySelector("#requests_table").innerHTML= headers;

                        indexes[index].className="index_button";
                        indexes[j].className="index_button_selected";
                        index = j;

                        CreateView(JSON_DATA,"#requests_table",indexes[j].value,count_per_view);
                    } , true);
                }
            }
        }
    };
}

function CreateView(JSON_DATA , View  ,index , count_per_view){
    let max = index * count_per_view;
    let min = max - count_per_view;

    if(max > JSON_DATA.length){
        max = JSON_DATA.length;
    }

    for(min ; min < max ; min++){
        document.querySelector(View).innerHTML+= CreateRequestTableRow(JSON_DATA[min]);

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
                                GetRequests();
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
                                GetRequests();
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

function CreateViewIndexes(length,count_per_view,Viewindex){
    document.querySelector(Viewindex).innerHTML="";

    for (let i = 0; i < Math.ceil(length / count_per_view) ; ++i) {
        if(i == 0){
            document.querySelector(Viewindex).innerHTML+="<button class='index_button_selected' id='index_button_request' value='"+(i+1)+"'>"+(i+1)+"</button>";
        }

        else{
            document.querySelector(Viewindex).innerHTML+="<button class='index_button' id='index_button_request' value='"+(i+1)+"'>"+(i+1)+"</button>";
        }
    }
}
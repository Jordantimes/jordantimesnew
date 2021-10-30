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

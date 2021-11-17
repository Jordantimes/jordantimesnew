var index = 0;
var edit_checkbox = document.querySelectorAll(".edit_dest_checkbox");
var edit_dest_name = document.querySelectorAll(".edit_destination_name");
var edit_dest_inputs = document.querySelectorAll(".edit_destination_input");
var edit_dest_buttons = document.querySelectorAll(".edit_destination_button");
var edit_dest_lists = document.querySelectorAll(".edit_destination_list");
var edit_dest_selections = document.querySelectorAll(".edit_dest_selection");
var edit_edit_checkbox = document.querySelectorAll(".edit_dest_checkbox");
var edit_dest_names = document.querySelectorAll(".edit_destination_name");
var edit_remove_dest = document.querySelectorAll(".remove_destination_button");

var edit_opened_list = 0;


document.querySelector(".edit_trip").addEventListener("click" , function(){
    document.querySelector(".edit_trip_pop_up_container").style.display="block";
    document.querySelector(".edit_trip_pop_up_container").scrollTop = 0;
    index = document.querySelector(".edit_trip").value;

    document.querySelector("#edit_destination_list").innerHTML = "";
    SetPopupData(CollectData(index));
}, false);

document.querySelector("#cancel_edit").addEventListener("click" , function(){
    document.querySelector(".edit_trip_pop_up_container").style.display = "none";
} , false);

document.querySelector(".edit_add_destination").addEventListener("click" , function(){
    Edit_CreateDestinationInput();
} , false);



function CollectData(index){
    let destinations = document.querySelectorAll(".site_name")[index].innerText;
    let price = document.querySelectorAll(".site_base_price")[index].innerText;
    let description = document.querySelectorAll(".site_description")[index].innerText;
    let start_date = document.querySelectorAll(".site_start_date")[index].innerText;
    let end_date = document.querySelectorAll(".site_end_date")[index].innerText;
    let days = document.querySelectorAll(".site_days")[index].innerText;
    let nights = document.querySelectorAll(".site_nights")[index].innerText;
    let breakfast_price = document.querySelectorAll(".breakfast_price")[index].innerText;
    let lunch_price = document.querySelectorAll(".lunch_price")[index].innerText;
    let dinner_price = document.querySelectorAll(".dinner_price")[index].innerText;

    destinations = destinations.replaceAll(" - ", "-");
    destinations = destinations.split("-");

    let Data = {
        "destinations" : destinations,
        "price" : price,
        "description" : description,
        "start_date" : start_date,
        "end_date" : end_date,
        "days" : days,
        "nights" : nights,
        "breakfast_price" : breakfast_price,
        "lunch_price" : lunch_price,
        "dinner_price" : dinner_price,
    };

    return Data;
}

function SetPopupData(Data){
    for (let i = 0; i < Data.destinations.length; ++i) {
        Edit_CreateDestinationInput();
        document.querySelectorAll("#edit_dest_checkbox")[i].checked=true;
        document.querySelectorAll("#edit_dest_checkbox")[i].value = destination.indexOf(Data.destinations[i]);
        document.querySelectorAll(".edit_destination_name")[i].innerHTML = Data.destinations[i];



    }
}


function Edit_CreateDestinationInput(){
    let index = document.querySelectorAll(".edit_destination_input").length;
    let select_index = document.querySelectorAll(".edit_dest_selection").length;

    let div = document.createElement("div");
    div.className= "edit_destination_input";

    let checkbox = document.createElement("input");
    checkbox.setAttribute("type" , "checkbox");
    checkbox.setAttribute("name" , "destination[]");
    checkbox.className="edit_dest_checkbox";
    checkbox.id = "edit_dest_checkbox";

    let button = document.createElement("button");
    button.className= "edit_destination_button";
    button.setAttribute("type" , "button");

    let span = document.createElement("span");
    span.className = "edit_destination_name";
    span.innerText = "Select"

    button.append(span);

    button.innerHTML+= "<svg version='1.1'  xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px'  viewBox='0 0 451.847 451.847' style='enable-background:new 0 0 451.847 451.847;' xml:space='preserve'>"+
                            "<g>"+
                                "<path d='M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z'></path>"+
                            "<g>"+
                        "<svg>";

    let list = document.createElement("div");
    list.className="edit_destination_list";
    list.setAttribute("visibile" , "false");
    list.setAttribute("style" , "display:none");

    for(let i = 0 ; i < 13 ; ++i){
        let select = document.createElement("button");
        select.className="edit_dest_selection";
        select.setAttribute("type" , "button");
        select.setAttribute("value" , i);
        select.setAttribute("for" , index);
        select.innerText = destination[i];

        list.append(select);

        select.addEventListener("click" , function(){
            edit_set_selection(select_index + i);
        } , false);
    }

    let remove = document.createElement("button");
    remove.className = "edit_remove_destination_button";
    remove.setAttribute("type" , "button");
    remove.innerHTML = "<svg version='1.1' id='Layer_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 492 492' style='enable-background:new 0 0 492 492;' xml:space='preserve'>"+
                        "<g>"+
                            "<g>"+
                                "<path d='M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872"+
                                    "c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872"+
                                    "c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052"+
                                    "L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116"+
                                    "c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952"+
                                    "c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116"+
                                    "c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z'></path>"+
                            "</g>"+
                        "</g>"+
                    "</svg>";

    div.append(checkbox);
    div.append(button);
    div.append(list);
    div.append(remove);

    document.querySelector("#edit_destination_list").appendChild(div);
    dest_inputs_count++;

    edit_checkbox = document.querySelectorAll(".edit_dest_checkbox");
    edit_dest_name = document.querySelectorAll(".edit_destination_name");
    edit_dest_inputs = document.querySelectorAll(".edit_destination_input");
    edit_dest_buttons = document.querySelectorAll(".edit_destination_button");
    edit_dest_lists = document.querySelectorAll(".edit_destination_list");
    edit_dest_selections = document.querySelectorAll(".edit_dest_selection");
    edit_edit_checkbox = document.querySelectorAll(".edit_dest_checkbox");
    edit_dest_names = document.querySelectorAll(".editdestination_name");
    edit_remove_dest = document.querySelectorAll(".remove_destination_button");

    edit_dest_buttons[index].addEventListener("click" , function(){
        if(index !== edit_opened_list){
            edit_dest_lists[edit_opened_list].style.display="none";
            edit_dest_lists[edit_opened_list].setAttribute("visibile" , "false");
        }

        if(edit_dest_lists[index].getAttribute("visibile") === "false"){
            edit_dest_lists[index].style.display="block";
            edit_dest_lists[index ].setAttribute("visibile" , "true");
            edit_opened_list = index ;
        }
    
        else{
            edit_dest_lists[index].style.display="none";
            edit_dest_lists[index].setAttribute("visibile" , "false");
        }
    } , false);  

    remove.addEventListener("click" , function(){
        edit_remove_destination(index);
    } , false);
}

function edit_set_selection(i){
    let edit_dest_selections = document.querySelectorAll(".edit_dest_selection");

    let index = parseInt(edit_dest_selections[i].getAttribute("for"));

    if(edit_dest_selections[i].value === "0"){
        document.querySelectorAll(".edit_dest_checkbox")[index].checked = false;
        document.querySelectorAll(".edit_dest_checkbox")[index].value = 0;
        document.querySelectorAll(".edit_destination_name")[index].innerHTML = "Select";
    }

    else{
        document.querySelectorAll(".edit_dest_checkbox")[index].checked = true;
        document.querySelectorAll(".edit_dest_checkbox")[index].value = edit_dest_selections[i].value;
        document.querySelectorAll(".edit_destination_name")[index].innerHTML = edit_dest_selections[i].innerHTML;
    }

    edit_dest_lists[edit_opened_list].style.display = "none";
    edit_dest_lists[edit_opened_list].setAttribute("visible" , "false");
}

function edit_remove_destination(i){
    if(dest_inputs_count > 2){
        edit_dest_inputs[i].style.display = "none";
        dest_inputs_count--;
        edit_checkbox[i].checked = false;
        edit_checkbox[i].value = 0;
        edit_dest_names[i].innerHTML = "Select";
    }
}
const destination = [
    "Select",
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

var opened_list = 0;
var dest_inputs_count = 2;
const create_trip_pop_up = document.querySelector(".create_trip_pop_up_container");
var dest_inputs = document.querySelectorAll(".destination_input");
var dest_buttons = document.querySelectorAll(".destination_button");
var dest_lists = document.querySelectorAll(".destination_list");
var dest_selections = document.querySelectorAll(".dest_selection");
var dest_checkboxs = document.querySelectorAll(".dest_checkbox");
var dest_names = document.querySelectorAll(".destination_name");
var remove_dest = document.querySelectorAll(".remove_destination_button");
const add_dest = document.querySelector("#create_add_destination");

for (let i = 0; i < dest_buttons    .length; ++i){
    dest_buttons[i].addEventListener("click" , function(){
        if(i !== opened_list){
            dest_lists[opened_list].style.display="none";
            dest_lists[opened_list].setAttribute("visibile" , "false");
        }

        if(dest_lists[i].getAttribute("visibile") === "false"){
            dest_lists[i].style.display="block";
            dest_lists[i].setAttribute("visibile" , "true");
            opened_list = i;
        }
    
        else{
            dest_lists[i].style.display="none";
            dest_lists[i].setAttribute("visibile" , "false");
        }
    } , false);   
}

for(let i = 0 ; i < dest_selections.length ; ++i){
    dest_selections[i].addEventListener("click" , function(){
        set_selection(i);
    } , false);
}

add_dest.addEventListener("click" , function(){
    CreateDestinationInput();
} , false);

for(let i = 0 ; i < remove_dest.length ; ++i){
    remove_dest[i].addEventListener("click" , function(){
        remove_destination(i);
    } , false);
}


var images_files = [];
const create_file_input = document.querySelector(".create_file_input");
    create_file_input.addEventListener("change" , function(){
        image_preview();
    } , false);


document.querySelector(".create_trip_pop_up_container").addEventListener("click" , function(event){
    if(!event.target.closest(".destination_button")){
        dest_lists[opened_list].style.display= "none";
        dest_lists[opened_list].setAttribute("visibile" , "false");
    }

    if(event.target.closest(".date_button")){
        let date_type= document.querySelector(".date_list").getAttribute("calender_type");
        if(event.target.closest(".date_button").nextElementSibling.getAttribute("visibility") === "hidden"){
            if(date_type === "start"){
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

            event.target.closest(".date_button").nextElementSibling.style.display="block";
            event.target.closest(".date_button").nextElementSibling.setAttribute("visibility" , "visibile");
        }

        else{
            event.target.closest(".date_button").nextElementSibling.style.display="none";
            event.target.closest(".date_button").nextElementSibling.setAttribute("visibility" , "hidden");
        }
    }

    else if(!event.target.closest(".calender_container") && !event.target.closest(".day")){
        document.querySelector(".date_list").style.display="none";
        document.querySelector(".date_list").setAttribute("visibility" , "hidden");
    }

    if(event.target.closest(".nights_button")){
        if(document.querySelector(".nights_list").innerHTML !== ""){
            if(document.querySelector(".nights_list").getAttribute("visibile") === "false"){
                document.querySelector(".nights_list").style.display="block";
                document.querySelector(".nights_list").setAttribute("visibile" , "true");
            }
    
            else{
                document.querySelector(".nights_list").style.display="none";
                document.querySelector(".nights_list").setAttribute("visibile" , "false");
            }
        }
    }

    else if(!event.target.closest(".nights_button")){
        document.querySelector(".nights_list").style.display="none";
        document.querySelector(".nights_list").setAttribute("visibile" , "false");
    }

    if(event.target.closest("#cancel_create")){
        create_trip_pop_up.style.display="none";
    }
} , false);


const additional_checkboxes = document.querySelectorAll(".additional_checkbox");
const additional_input = document.querySelectorAll(".aditional_input");
    for (let i = 0; i < additional_checkboxes.length; ++i) {
        additional_checkboxes[i].addEventListener("click" , function(){
            if(additional_checkboxes[i].checked){
                additional_input[i].disabled = false;
            }

            else{
                additional_input[i].disabled = true;
            }
        } , false);
    }



//functions
function CreateDestinationInput(){
    let index = document.querySelectorAll(".destination_input").length;
    let select_index = document.querySelectorAll(".dest_selection").length;

    let div = document.createElement("div");
    div.className= "destination_input";

    let checkbox = document.createElement("input");
    checkbox.setAttribute("type" , "checkbox");
    checkbox.setAttribute("name" , "destination[]");
    checkbox.className="dest_checkbox";

    let button = document.createElement("button");
    button.className= "destination_button";
    button.setAttribute("type" , "button");

    let span = document.createElement("span");
    span.className = "destination_name";
    span.innerText = "Select"

    button.append(span);

    button.innerHTML+= "<svg version='1.1'  xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px'  viewBox='0 0 451.847 451.847' style='enable-background:new 0 0 451.847 451.847;' xml:space='preserve'>"+
                            "<g>"+
                                "<path d='M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z'></path>"+
                            "<g>"+
                        "<svg>";

    let list = document.createElement("div");
    list.className="destination_list";
    list.setAttribute("visibile" , "false");
    list.setAttribute("style" , "display:none");

    for(let i = 0 ; i < 13 ; ++i){
        let select = document.createElement("button");
        select.className="dest_selection";
        select.setAttribute("type" , "button");
        select.setAttribute("value" , i);
        select.setAttribute("for" , index);
        select.innerText = destination[i];

        list.append(select);

        select.addEventListener("click" , function(){
            set_selection(select_index + i);
        } , false);
    }

    let remove = document.createElement("button");
    remove.className = "remove_destination_button";
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

    document.querySelectorAll(".create_form_input")[0].insertBefore(div,add_dest);
    dest_inputs_count++;

    dest_inputs = document.querySelectorAll(".destination_input");
    dest_buttons = document.querySelectorAll(".destination_button");
    dest_lists = document.querySelectorAll(".destination_list");
    dest_selections = document.querySelectorAll(".dest_selection");
    dest_checkboxs = document.querySelectorAll(".dest_checkbox");
    dest_names = document.querySelectorAll(".destination_name");
    remove_dest = document.querySelectorAll(".remove_destination_button");

    dest_buttons[index].addEventListener("click" , function(){
        if(index !== opened_list){
            dest_lists[opened_list].style.display="none";
            dest_lists[opened_list].setAttribute("visibile" , "false");
        }

        if(dest_lists[index].getAttribute("visibile") === "false"){
            dest_lists[index].style.display="block";
            dest_lists[index ].setAttribute("visibile" , "true");
            opened_list = index ;
        }
    
        else{
            dest_lists[index].style.display="none";
            dest_lists[index].setAttribute("visibile" , "false");
        }
    } , false);   

    remove.addEventListener("click" , function(){
        remove_destination(index);
    } , false);
}

function set_selection(i){
    let index = parseInt(dest_selections[i].getAttribute("for"));

    if(dest_selections[i].value === "0"){
        dest_checkboxs[index].checked = false;
        dest_checkboxs[index].value = 0;
        dest_names[index].innerHTML = "Select";
    }

    else{
        dest_checkboxs[index].checked = true;
        dest_checkboxs[index].value = dest_selections[i].value;
        dest_names[index].innerHTML = dest_selections[i].innerHTML;
    }

    dest_lists[opened_list].style.display = "none";
    dest_lists[opened_list].setAttribute("visible" , "false");
}

function remove_destination(i){
    if(dest_inputs_count > 2){
        dest_inputs[i].style.display = "none";
        dest_inputs_count--;
        dest_checkboxs[i].checked = false;
        dest_checkboxs[i].value = 0;
        dest_names[i].innerHTML = "Select";
    }
}


function image_preview(){
    var new_image = create_file_input.files;
    let imageURLs = new Array();

    document.querySelector(".images_wrapper").innerHTML = "";

    //check file type and if correct chack its size
    //otherwise clear the input file and set back the original image
    for (let i = 0; i < new_image.length; ++i) {
        if(new_image[i].type === "image/jpeg" || new_image[i].type === "image/png"){
            if(new_image[i].size < 5000000){
                let reader = new FileReader();

                //Read the contents of Image File.
                reader.readAsDataURL(new_image[i]);

                reader.onload = function (e) {
                    //Initiate the JavaScript Image object.
                    var imageOBJ = new Image();
    
                    //Set the Base64 string return from FileReader as source.
                    imageOBJ.src = e.target.result;
    
                    //Validate the File Height and Width.
                    imageOBJ.onload = function () {    
                        if(this.height <= 3000 && this.width <= 3000){
                            //display the selected image by creating a temporary URL/SRC 
                            let NewImageURL = window.URL.createObjectURL(new_image[i]);
                            imageURLs.push(NewImageURL);
                            
                            setTimeout(() => {
                                if(i === (new_image.length - 1)){
                                    for(let i = 0; i < imageURLs.length; ++i){
                                        document.querySelector(".images_wrapper").innerHTML+= "<a target='_blank' href="+imageURLs[i]+"><img src='"+imageURLs[i]+"' alt='trip image' class='trip_image_create'></a>";
                                    }
                                    console.log(imageURLs.length);
                                }
                            }, 1000);
                        }
    
                        else{
                            create_file_input.value = "";
                        }
                    };
                };
            }

            else{
                create_file_input.value = "";
            }
        }
    
        else{
            create_file_input.value = "";
        }
    }
}

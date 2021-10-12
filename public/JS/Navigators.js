const nav_buttons = document.querySelectorAll(".navigation_button");
const nav_buttons_counter = document.querySelectorAll(".navigation_button_counter");
const view_boxex = document.querySelectorAll(".content_view_box");
const nav_buttons_text = document.querySelectorAll(".navigation_button_text");
var view_box;

//get the URL to get the controller name
var PageURL = window.location.href;
let PageURL_ARR = PageURL.split("/");

//loop through the navigation buttons and check which one is selected by the URL value to display
for(let i = 0 ; i < nav_buttons.length ; ++i){
    if(nav_buttons[i].getAttribute("DisplayByURL") === "true"){
        view_box = i;
    }
}

//if none of the buttons where selected by URL then select the default button/viewbox and display the first one
if(view_box == null){
    view_box = 0;
    history.pushState({},"",URLROOT+"/"+PageURL_ARR[4]+"/"+nav_buttons_text[0].innerText);
}

nav_buttons[view_box].style.backgroundColor = MAIN_COLOR;
nav_buttons[view_box].style.color = "#ffffff";
nav_buttons[view_box].style.border = "1px "+MAIN_COLOR+" solid";
view_boxex[view_box].style.display="block";
nav_buttons_counter[view_box].style.color = "#ffffff";


//once the user clicks on any of the navigators return the previously selected button to its original style
//change the new selected one to the selected style
//hide the previously viewed view box and render the new selected one
for (let i = 0; i < nav_buttons.length; ++i) {
    nav_buttons[i].addEventListener("click" , function(){
        //hide the previously selected view box
        view_boxex[view_box].style.display = "none";
        nav_buttons[view_box].style.backgroundColor = "transparent";
        nav_buttons[view_box].style.color = "#cccccc";
        nav_buttons[view_box].style.border = "1px #cccccc solid";
        nav_buttons_counter[view_box].style.color = MAIN_COLOR;

        //display the selected view box
        view_boxex[i].style.display="block";
        nav_buttons[i].style.backgroundColor = MAIN_COLOR;
        nav_buttons[i].style.color = "#ffffff";
        nav_buttons[i].style.border = "1px "+MAIN_COLOR+" solid";
        nav_buttons_counter[i].style.color = "#ffffff";

        //set the new URL
        history.pushState({},"",URLROOT+"/"+PageURL_ARR[4]+"/"+nav_buttons_text[i].innerText);

        //save the index of the selected button so it can be used in the next time as the "Previously selected button"
        view_box = i;
    } , true);
}


//URL Change event listener
//used for Page Back
window.addEventListener('popstate', function(){
    //get the URL to get the controller name
    var NewURL = window.location.href;
    let NewURL_ARR = NewURL.split("/");

    for(let i = 0 ; i < nav_buttons_text.length ; ++i){
        if(NewURL_ARR[5].toLowerCase() === nav_buttons_text[i].innerText.toLowerCase()){
            //hide the previously selected view box
            view_boxex[view_box].style.display = "none";
            nav_buttons[view_box].style.backgroundColor = "transparent";
            nav_buttons[view_box].style.color = "#cccccc";
            nav_buttons[view_box].style.border = "1px #cccccc solid";
            nav_buttons_counter[view_box].style.color = MAIN_COLOR;

            //display the selected view box
            view_boxex[i].style.display="block";
            nav_buttons[i].style.backgroundColor = MAIN_COLOR;
            nav_buttons[i].style.color = "#ffffff";
            nav_buttons[i].style.border = "1px "+MAIN_COLOR+" solid";
            nav_buttons_counter[i].style.color = "#ffffff";

            //save the index of the selected button so it can be used in the next time as the "Previously selected button"
            view_box = i;
        }
    }
}, true);

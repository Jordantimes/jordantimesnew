const nav_buttons = document.querySelectorAll(".navigation_button");
const nav_buttons_counter = document.querySelectorAll(".navigation_button_counter");
const view_boxex = document.querySelectorAll(".content_view_box");

//set the first as the selected one and preview its own view box content
var view_box = 0;
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
        view_boxex[view_box].style.display = "none";
        nav_buttons[view_box].style.backgroundColor = "transparent";
        nav_buttons[view_box].style.color = "#cccccc";
        nav_buttons[view_box].style.border = "1px #cccccc solid";
        nav_buttons_counter[view_box].style.color = MAIN_COLOR;

        view_boxex[i].style.display="block";
        nav_buttons[i].style.backgroundColor = MAIN_COLOR;
        nav_buttons[i].style.color = "#ffffff";
        nav_buttons[i].style.border = "1px "+MAIN_COLOR+" solid";
        nav_buttons_counter[i].style.color = "#ffffff";

        //save the index of the selected button so it can be used in the next time as the "Previously selected button"
        view_box = i;
    } , true);
}
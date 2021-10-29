const date = new Date(); 
const current_day = date.getDate();
const current_month = date.getMonth();
const current_year = date.getFullYear();
var start_selected_day;
var start_selected_month;
var start_selected_year;
var start_date;
var end_date;
//fill the month field by the actuall month
const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
];

set_calender(date,current_month,current_year);

const calender_month_nav_left = document.querySelector(".month_nav_left_wrapper");
    calender_month_nav_left.addEventListener("click" , function(){
        let calender_type = document.querySelector("#trip_date_list").getAttribute("calender_type");
        date.setMonth(date.getMonth() - 1);
            
        if(date.getMonth() < 0 ){
            date.setMonth(11);
            date.setFullYear(date.getFullYear() - 1);
        }

            if(calender_type === "start"){
                set_calender(date,current_month,current_year);
            }

            else if(calender_type === "end"){
                set_calender(date,start_selected_month,start_selected_year);
            }
    } , true);

const calender_month_nav_right = document.querySelector(".month_nav_right_wrapper");
calender_month_nav_right.addEventListener("click" , function(){
    let calender_type = document.querySelector("#trip_date_list").getAttribute("calender_type");
    date.setMonth(date.getMonth() + 1);
        
    if(date.getMonth() > 11 ){
        date.setMonth(0);
        date.setFullYear(date.getFullYear() + 1);
    }

        if(calender_type === "start"){
            set_calender(date,current_month,current_year);
        }

        else if(calender_type === "end"){
            set_calender(date,start_selected_month,start_selected_year);
        }
} , true);

//End of calender Creation /////////////////////////////////////////////////////////////////////////////


function set_calender(date,month,year){
    //get type of calender
    let calender_type = document.querySelector("#trip_date_list").getAttribute("calender_type");

    //set the month and year at the top of the calender
    document.querySelector("#start_date_month_year").innerHTML= months[date.getMonth()] + "," + date.getFullYear();

    //fill the days list by the actuall days of the month
    let days= "";
    let listed_days_count= 0;

    //fill previous month days
    const last_day_of_last_month= new Date(date.getFullYear(),date.getMonth(), 0).getDate();
    const first_day_of_current_month = new Date(date.getFullYear(),date.getMonth(), 1).getDay();

    for (let i = first_day_of_current_month; i > 0 ; --i) {
        //days+= "<div class='dimmed_day' id='day'>"+(last_day_of_last_month - i + 1)+"</div>";
        days+= "<div class='dimmed_day' id='day'></div>";
        listed_days_count++;
    }

    //fill current month days
    const last_day_of_month= new Date(date.getFullYear(),date.getMonth() + 1, 0).getDate();

    let returned_days = FillSelectedMonth(days , listed_days_count , last_day_of_month , date, month , year , calender_type);

    days = returned_days.days;
    listed_days_count = returned_days.listed_days_count;

    //fill next month days by subtracting 42 spaces of days by the printed days so far from the previous month and the selected
    const calender_days_count = 42;
    let_next_month_days_count = calender_days_count - listed_days_count;

    for (let i = 1 ; i <= let_next_month_days_count; ++i) {
        //days+= "<div class='dimmed_day' id='day'>"+i+"</div>";
        days+= "<div class='dimmed_day' id='day'></div>";
    }

    document.querySelector("#start_date_days_wrapper").innerHTML= days;

        //add an event listener to days button to select a desired date
        const days_buttons = document.querySelectorAll(".day");
        if(calender_type === "end" && date.getMonth() === start_selected_month){
            days_buttons[0].style.backgroundColor ="#f05d5e";
            days_buttons[0].style.color ="#ffffff";
        }

        for(let i = 0 ; i < days_buttons.length ; ++i){
            days_buttons[i].addEventListener("click" , function(){
                //save selected date
                let selected_day = ("0" + parseInt(days_buttons[i].innerHTML)).slice(-2);
                let selected_month = ("0" + (date.getMonth() + 1)).slice(-2);
                let selected_date = date.getFullYear()+"-"+selected_month+"-"+selected_day;

                setInputDate(selected_day ,selected_month , date.getFullYear() ,selected_date,calender_type);
            } , true);
        }
}
function FillSelectedMonth(days , listed_days_count , last_day_of_month , date, month , year , calender_type){

    //if it is the a previews years months dim all
    if(date.getFullYear() < year){
        for (let i = 1; i <= last_day_of_month; ++i) {
        days+= "<div class='dimmed_day' id='day'>"+i+"</div>";
        listed_days_count++;
        }
    }

        //same year previus month dim all
        else if(date.getMonth() < month && date.getFullYear() == year){
            for (let i = 1; i <= last_day_of_month; ++i) {
            days+= "<div class='dimmed_day' id='day'>"+i+"</div>"
            listed_days_count++;
            }
        }

            //current month dim prevoius days keep the other
            else if(date.getMonth() == month && date.getFullYear() == year){
                if(calender_type === "start"){
                    for (let i = 1; i <= last_day_of_month; ++i) {
                        if(i < date.getDate(year,month,0)){
                            days+= "<div class='dimmed_day' id='day'>"+i+"</div>"
                            listed_days_count++;
                        }
                        else{
                            days+= "<button class='day' id='day' type='button'>"+i+"</button>"
                            listed_days_count++;
                        }
                    }
                }

                else if(calender_type === "end"){
                    for (let i = 1; i <= last_day_of_month; ++i) {
                        if(i < start_selected_day){
                            days+= "<div class='dimmed_day' id='day'>"+i+"</div>"
                            listed_days_count++;
                        }
                        else{
                            days+= "<button class='day' id='day' type='button'>"+i+"</button>"
                            listed_days_count++;
                        }
                    }
                }
            }

                //any other date in the future
                else{
                    for (let i = 1; i <= last_day_of_month; ++i) {
                        days+= "<button class='day' id='day' type='button'>"+i+"</button>"
                        listed_days_count++;
                    }
                }

    let returned_days = {
        days : days,
        listed_days_count : listed_days_count
    };

    return returned_days;
}


function setInputDate(selected_day,selected_month,selected_year,selected_date,calender_type){
    if(calender_type === "start"){
        //set selected date
        document.querySelector(".selected_start_date_holder").innerHTML = selected_date;
        document.querySelector(".start_date_input").value = selected_date;

        //hide start date and view end date calender
        document.querySelector(".calender_name").innerHTML="End date";
        document.querySelector("#trip_date_list").setAttribute("calender_type","end");

        start_selected_day = parseInt(selected_day);
        start_selected_month = selected_month - 1;
        start_selected_year = selected_year;

        start_date = selected_date;

        set_calender(date,start_selected_month,start_selected_year);
    }

    else if(calender_type === "end"){
        //set selected date
        document.querySelector(".selected_end_date_holder").innerHTML = selected_date;
        document.querySelector(".end_date_input").value = selected_date;

        //hide start date and view end date calender
        document.querySelector(".calender_name").innerHTML="Start date";
        document.querySelector("#trip_date_list").setAttribute("calender_type","start");
        document.querySelector("#trip_date_list").style.display="none";
        document.querySelector("#trip_date_list").setAttribute("visibility" , "hidden"); 

        end_date = selected_date;

        //get the defference between the selected dates and set it in the nights field
        const date1 = new Date(end_date);
        const date2 = new Date(start_date);
        const diffTime = Math.abs(date2 - date1);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

        document.querySelector(".nights_checkbox").value=diffDays;
        document.querySelector(".nights_holder").innerText = diffDays + " days, " + diffDays + " nights";

        CreateNightsList(diffDays);
    }
}

function CreateNightsList(diffDays){
    const nights_list = document.querySelector(".nights_list");
    
    if(diffDays){
        nights_list.innerHTML = "<button class='nights_selection' type='button'>"+diffDays+" days, "+ diffDays +" nights</button>"+
                            "<button class='nights_selection' type='button'>"+diffDays+" days, "+ (diffDays-1) +" nights</button>";
    }

    else{
        nights_list.innerHTML = "<button class='nights_selection' type='button'>"+0+" days, "+ 0 +" nights</button>";
    }

    const nights_selections = document.querySelectorAll(".nights_selection");
    for (let i = 0; i < nights_selections.length; ++i) {
        nights_selections[i].addEventListener("click" , function(){
            setNightSelection(i,diffDays);
        } , false);
    }
}

function setNightSelection(i,diffDays){
    if(i === 0){
        document.querySelector(".nights_checkbox").value=diffDays;
        document.querySelector(".nights_holder").innerText = diffDays + " days, " + diffDays + " nights";
    }

    else if(i === 1){
        document.querySelector(".nights_checkbox").value = (diffDays-1);
        document.querySelector(".nights_holder").innerText = diffDays + " days, " + (diffDays-1) + " nights";
    }
}
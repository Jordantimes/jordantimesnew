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


function CreateMarkedMessage(){
    let Message="<div class='alert' style='opcaity:0;'>"+
                    "<div class='alert_info_container'>"+
                        "<div class='alert_title'>Notifications marked</div>"+

                        "<div class='alert_icon_container'>"+
                            "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 512 512' style='enable-background:new 0 0 512 512;' xml:space='preserve'>"+
                                "<g>"+
                                    "<g>"+
                                        "<path d='M256,0C115.39,0,0,115.39,0,256s115.39,256,256,256s256-115.39,256-256S396.61,0,256,0z'/>"+
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

function CreateUnMarkedMessage(){
    let Message="<div class='alert' style='opcaity:0;'>"+
                    "<div class='alert_info_container'>"+
                        "<div class='alert_title'>Notifications marked</div>"+

                        "<div class='alert_icon_container'>"+
                            "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 512 512' style='enable-background:new 0 0 512 512;' xml:space='preserve'>"+
                                "<g>"+
                                    "<g>"+
                                        "<path d='M256,0C115.03,0,0,115.05,0,256c0,140.97,115.05,256,256,256c140.97,0,256-115.05,256-256C512,115.03,396.95,0,256,0z     M256,482C131.383,482,30,380.617,30,256S131.383,30,256,30s226,101.383,226,226S380.617,482,256,482z'/>"+
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

function CreateNotificationDeleteMessage(){
    let Message="<div class='alert' style='opcaity:0;'>"+
                    "<div class='alert_info_container'>"+
                        "<div class='alert_title'>Notifications Deleted</div>"+

                        "<div class='alert_icon_container'>"+
                            "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Capa_1' x='0px' y='0px' viewBox='0 0 489.7 489.7' style='enable-background:new 0 0 489.7 489.7;' xml:space='preserve'>"+
                                "<g>"+
                                    "<g>"+
                                        "<g>"+
                                            "<path d='M411.8,131.7c-9.5,0-17.2,7.7-17.2,17.2v288.2c0,10.1-8.2,18.4-18.4,18.4H113.3c-10.1,0-18.4-8.2-18.4-18.4V148.8     c0-9.5-7.7-17.2-17.1-17.2c-9.5,0-17.2,7.7-17.2,17.2V437c0,29,23.6,52.7,52.7,52.7h262.9c29,0,52.7-23.6,52.7-52.7V148.8     C428.9,139.3,421.2,131.7,411.8,131.7z'/>"+
                                            "<path d='M457.3,75.9H353V56.1C353,25.2,327.8,0,296.9,0H192.7c-31,0-56.1,25.2-56.1,56.1v19.8H32.3c-9.5,0-17.1,7.7-17.1,17.2     s7.7,17.1,17.1,17.1h425c9.5,0,17.2-7.7,17.2-17.1C474.4,83.5,466.8,75.9,457.3,75.9z M170.9,56.1c0-12,9.8-21.8,21.8-21.8h104.2     c12,0,21.8,9.8,21.8,21.8v19.8H170.9V56.1z'/>"+
                                            "<path d='M262,396.6V180.9c0-9.5-7.7-17.1-17.1-17.1s-17.1,7.7-17.1,17.1v215.7c0,9.5,7.7,17.1,17.1,17.1     C254.3,413.7,262,406.1,262,396.6z'/>"+
                                            "<path d='M186.1,396.6V180.9c0-9.5-7.7-17.1-17.2-17.1s-17.1,7.7-17.1,17.1v215.7c0,9.5,7.7,17.1,17.1,17.1     C178.4,413.7,186.1,406.1,186.1,396.6z'/>"+
                                            "<path d='M337.8,396.6V180.9c0-9.5-7.7-17.1-17.1-17.1s-17.1,7.7-17.1,17.1v215.7c0,9.5,7.7,17.1,17.1,17.1     S337.8,406.1,337.8,396.6z'/>"+
                                        "</g>"+
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


function CreateTripAcceptMessage(){
    let Message="<div class='alert' style='opcaity:0;'>"+
                    "<div class='alert_info_container'>"+
                        "<div class='alert_title'>Trip accepted</div>"+

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

function CreateTripDeclineMessage(){
    let Message="<div class='alert' style='opcaity:0;'>"+
                    "<div class='alert_info_container'>"+
                        "<div class='alert_title'>Trip declined</div>"+

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

function CreateTripUpdateMessage(){
    let Message="<div class='alert' style='opcaity:0;'>"+
                    "<div class='alert_info_container'>"+
                        "<div class='alert_title'>Trip updated</div>"+

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

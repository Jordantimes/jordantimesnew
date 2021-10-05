window.addEventListener("DOMContentLoaded" , function(){

    const count_per_time = 10;
    GetNotifications(count_per_time);

    document.querySelector("#refresh_notifications").addEventListener("click" , function(){
        GetNotifications(count_per_time);
    } , true);
} , true);
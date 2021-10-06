window.addEventListener("DOMContentLoaded" , function(){

    const count_per_time = 10;
    GetNotifications(count_per_time);

    document.querySelector("#refresh_notifications").addEventListener("click" , function(){
        GetNotifications(count_per_time);
    } , true);


    //edit profile button event listener
    const edit_profile_button = document.querySelector(".edit_profile_button");
        edit_profile_button.addEventListener("click" , function(){
            let data = [];
            let bio = "";
            let input_name;
            let data_div = document.querySelectorAll(".data_div");
            let data_wrappers = document.querySelectorAll(".data_wrapper");

            //add the file input in the div
            document.querySelector(".browse_image_container").innerHTML = "<input type='file' name='image' accept='.jpg, .jpeg, .png'>";

            //for each div input remove it and replace it with a form text input and make its default value as the value was inside the di
            for(let i = 0 ; i < data_div.length ; ++i){
                data.push(data_div[i].innerHTML);
                input_name = data_div[i].getAttribute("name");
                data_div[i].remove();

                data_wrappers[i].innerHTML += "<input type='text' value='"+data[i]+"' name='"+input_name+"' class='text_input'>";
            }

            //replace the bio div with a text area
            bio = document.querySelector(".data_div_textarea").innerText;
            document.querySelector(".data_div_textarea").remove();
            document.querySelector(".data_wrapper_textarea").innerHTML+= "<textarea class='textarea_input' name='bio'  rows='12'>"+bio+"</textarea>";

            //remove the edit button and create the submit form button
            document.querySelector(".edit_profile_button_container").innerHTML = "";
            document.querySelector(".submit_button_container").innerHTML = "<button class='submit_button' name='submit_edit' type='submit'>Save</button>";
        } , true);
} , true);
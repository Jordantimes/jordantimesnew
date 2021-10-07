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
            let bioHTML = "";
            let bioTEXT = "";
            let input_name;
            let data_div = document.querySelectorAll(".data_div");
            let data_wrappers = document.querySelectorAll(".data_wrapper");

            //add the file input in the div
            document.querySelector(".browse_image_container").innerHTML = "<input type='file' name='image' accept='.jpg, .jpeg, .png'>";

            //for each div input remove it and replace it with a form text input and make its default value as the value was inside the div
            for(let i = 0 ; i < data_div.length ; ++i){
                data.push(data_div[i].innerHTML);
                input_name = data_div[i].getAttribute("name");
                data_div[i].remove();

                data_wrappers[i].innerHTML += "<input type='text' value='"+data[i]+"' name='"+input_name+"' class='text_input'>";
            }

            //replace the bio div with a text area
            //getting both as HTML and as TEXT to save the BR elements (<br>) from being deleted to re print the bio once the user clicks on cancel 
            //otherwise the whole text will not contain any new lines
            bioHTML = document.querySelector(".data_div_textarea").innerHTML;
            bioTEXT = document.querySelector(".data_div_textarea").innerText;

            document.querySelector(".data_div_textarea").remove();
            document.querySelector(".data_wrapper_textarea").innerHTML+= "<textarea class='textarea_input' name='bio'  rows='12'>"+bioTEXT+"</textarea>";

            //hide the edit button and create the submit form button
            document.querySelector(".edit_profile_button_container").style.display= "none";
            document.querySelector(".submit_button_container").innerHTML = ""+
            "<button class='cancel_button' type='button'>Cancel</button>"+
            "<button class='submit_button' name='submit_edit' type='submit'>Save</button>"+
            "";


            //cancel button event listener
            const cancel_button = document.querySelector(".cancel_button");
                cancel_button.addEventListener("click" , function(){
                    //remove the file input in the div
                    document.querySelector(".browse_image_container").innerHTML = "";


                    //do the opposite and for each text input remove it and replace it with a form div input and print the original text whcih is saved in the data variable
                    let text_input = document.querySelectorAll(".text_input");

                    for(let i = 0 ; i < text_input.length ; ++i){
                        input_name = text_input[i].getAttribute("name");
                        text_input[i].remove();

                        data_wrappers[i].innerHTML += "<div type='text' name='"+input_name+"' class='data_div'>"+data[i]+"</div>";
                    }

                    //do the opposite and  replace the bio text area with a div
                    document.querySelector(".textarea_input").remove();
                    document.querySelector(".data_wrapper_textarea").innerHTML+= "<div class='data_div_textarea' name='bio'>"+bioHTML+"</div>";
                    
                    //again do the opposite and hide the submit/cancel buttons and appear the edit profile button again
                    document.querySelector(".edit_profile_button_container").style.display= "block";
                    document.querySelector(".submit_button_container").innerHTML = "";
                } , true);
        } , true);
} , true);

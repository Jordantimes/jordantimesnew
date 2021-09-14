<?php
include 'database.php';

if (isset($_POST['submit'])){
    session_start();
    $no = $_POST['No'];
    $name = $_POST['Name'];
    $email = $_POST ['Email'];
    $phone = $_POST['Phone'];
    $password = $_POST['Password'];
    $con_password = $_POST['confirmPassword'];
    $number = preg_match('@[0-9]@', $password);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    
    
   // Check If Password and Confirm Paassword is equal 
   
   if ($password===$con_password){
   
   // Insert User in database
   
    $sql = "INSERT INTO `users` ( comp_id, names, email, phone, passwords, roles) VALUES
    ( '$no', '$name', '$email', '$phone', PASSWORD('$password'), 'company')";
   
    // Password Validation 
   
    if(strlen($password) > 8 && $number && $uppercase && $lowercase && $specialChars) {
    if (mysqli_query($conn, $sql)){
        echo "new record has been added successfully";
        $_SESSION['Username'] = $name;
        $_SESSION ['ID']= $no ;
    
        
   
       }
    else{
       echo "Error: " . $sql . "<br>" . mysqli_error($conn);
       }
     
       echo "Your password is strong.";
       }
   
   else{
       echo "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
   
       }
           }
   
       }
   
   
   










if (isset($_POST["login"])){
    $email = $_POST["email"];
    $psssword = $_POST["password"];
    $hashed_password= password_hash($password,PASSWORD_DEFAULT);
    $_SESSION['Name'] = $name;

  

$sql_company="select * from users where email like '{$email}' and passwords like '{$hashed_password}' and roles like 'company' ";
$sql_user ="select * from users where email like '{$email}' and passwords like '{$hashed_password}' and roles like 'user'";
$sql_admin ="select * from users where email like '{$email}' and passwords like '{$hashed_password}' and roles like 'admin'";
$sql_gov ="select * from users where email like '{$email}' and passwords like '{$hashed_password}' and roles like 'gov'";
if (mysqli_query($conn, $sql_company)){
    echo"<p>Login successfully</p>";
    header("Location:company_page.php");
    
    

}
elseif(mysqli_query($conn, $sql_user)){
    echo"<p>Login successfully</p>";
    header("Location:user_page.php");
   

}
elseif(mysqli_query($conn, $sql_admin)){
    echo"<p>Login successfully</p>";
    header("Location:admin_page.php");
   

}
elseif (mysqli_query($conn, $sql_gov)){
    echo"<p>Login successfully</p>";
    header("Location:gov_page.php");

}
else{

    echo "<p>Invalid username/password combination</p>";
}

}


?>
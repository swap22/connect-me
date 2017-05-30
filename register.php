<?php
    $con = mysqli_connect("localhost","root","","social");// checking connection with database by creating variable
    if(mysqli_connect_errno()){
        echo "Failed to connect to database".mysqli_connect_errno();
    }

    //Declaring variables to prevent errors
        $fname = ""; //First name
        $lname = ""; //Last name
        $em = ""; //email
        $em2 = ""; //email 2
        $password = ""; //password
        $password2 = ""; //password 2
        $date = ""; //Sign up date 
        $error_array = ""; //Holds error messages

        //checking the submit button is pressed or not
        if(isset($_POST['register_button'])){
            //Registration form values

            //First name
            $fname = strip_tags($_POST['reg_fname']); //Remove html tags if user add it
            $fname = str_replace(' ', '', $fname); //remove spaces placed before and after variable
            $fname = ucfirst(strtolower($fname)); //Uppercase first letter and lower case the other


            //Last name
            $lname = strip_tags($_POST['reg_lname']);
            $lname = str_replace(' ', '', $lname);
            $lname = ucfirst(strtolower($lname)); 

            //email address
            $em = strip_tags($_POST['reg_email']);
            $em = str_replace(' ', '', $em);
            $em = ucfirst(strtolower($em)); 


            //Confirm email
            $em2 = strip_tags($_POST['reg_email2']); 
            $em2 = str_replace(' ', '', $em2);
            $em2 = ucfirst(strtolower($em2)); 


            //Password
            $password = strip_tags($_POST['reg_password']); 
            $password2 = strip_tags($_POST['reg_password2']); 

            $date = date("Y-m-d"); //Current date


         }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>welcome to connect Me</title>
</head>
<body>
    <form action="register.php" method="POST">
        <input type="text" name="reg_fname" placeholder="First Name" require>
        <br>
        <input type="text" name="reg_lname" placeholder="Last Name" require>
        <br>
        <input type="email" name="reg_email" placeholder="Email" require>
        <br>
        <input type="email" name="reg_email2" placeholder="Confirm Email" require>
        <br>
        <input type="password" name="reg_password" placeholder="Password" require>
        <br>
        <input type="password" name="reg_password2" placeholder="Confirm Password" require>
        <br>
        <input type="submit" name="register_button" value="submit" require>

    </form>
</body>
</html>
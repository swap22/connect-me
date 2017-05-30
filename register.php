<?php
    $con = mysqli_connect("localhost","root","","social");// checking connection with database by creating variable
    if(mysqli_connect_errno()){
        echo "Failed to connect to database".mysqli_connect_errno();
    }

    //Declaring variables to prevent errors so that initial it is null
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
			
			if($em == $em2){  // checking if two email are same or not
				     
					 
                //Check if email is in valid format 
                if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
                     $em = filter_var($em, FILTER_VALIDATE_EMAIL); // email is validated formated email 

                     //Check if email already exists 
                    $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

                    //Count the number of rows returned
                    $num_rows = mysqli_num_rows($e_check);

                        if($num_rows > 0) {
                        array_push($error_array, "Email already in use<br>");
                        }
                }else{
                 	array_push($error_array, "Invalid email format<br>");
                }

            }else{
            array_push($error_array, "Emails don't match<br>");
            }

            // checking first name is greater than 3 and lesser than 25
            if(strlen($fname) > 25 || strlen($fname) < 3) {
		     	array_push($error_array, "Your first name must be between 3 and 25 characters<br>");
            }
            // checking last name is greater than 3 and lesser than 25
            if(strlen($lname) > 25 || strlen($lname) < 3) {
		        array_push($error_array,  "Your last name must be between 3 and 25 characters<br>");
            }

            // comparing the two password are same
            if($password != $password2) {
		       array_push($error_array,  "Your passwords do not match<br>");
	        }else {
	        	if(preg_match('/[^A-Za-z0-9]/', $password)) {  //checking whether password is simple or not
			    array_push($error_array, "Your password can only contain english characters or numbers<br>");
                }
            }
            if(strlen($password > 30 || strlen($password) < 7)) {
	    	    array_push($error_array, "Your password must be betwen 7 and 30 characters<br>");
	        }



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
        <input type="text" name="reg_fname" placeholder="First Name" value="<?php 
			if(isset($_SESSION['reg_fname'])) {
				echo $_SESSION['reg_fname'];
			} ?>" required>
			<br>
			<?php if(in_array("Your first name must be between 3 and 25 characters<br>", $error_array)) echo "Your first name must be between 3 and 25 characters<br>"; ?>
					
        <input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
			if(isset($_SESSION['reg_lname'])) {
				echo $_SESSION['reg_lname'];
			} ?>" required>
			<br>
			<?php if(in_array("Your last name must be between 3 and 25 characters<br>", $error_array)) echo "Your last name must be between 3 and 25 characters<br>"; ?>

		<input type="email" name="reg_email" placeholder="Email" value="<?php 
			if(isset($_SESSION['reg_email'])) {
				echo $_SESSION['reg_email'];
			} ?>" required>
			<br>
        <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
			if(isset($_SESSION['reg_email2'])) {
                echo $_SESSION['reg_email2'];
            } ?>" required>
            <br>
			<?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>"; 
					else if(in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
					else if(in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>"; ?>
        <input type="password" name="reg_password" placeholder="Password" require>
            <br>
        <input type="password" name="reg_password2" placeholder="Confirm Password" require>
            <br>
            <?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>"; 
					else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>";
		    		else if(in_array("Your password must be betwen 7 and 30 characters<br>", $error_array)) echo "Your password must be betwen 7 and 30 characters<br>"; ?>
        <input type="submit" name="register_button" value="submit" require>

    </form>
</body>
</html>
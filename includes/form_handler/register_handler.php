<?php
//Declaring variables to prevent errors
        $fname = ""; //First name
        $lname = ""; //Last name
        $em = ""; //email
        $em2 = ""; //email 2
        $password = ""; //password
        $password2 = ""; //password 2
        $date = ""; //Sign up date 
        $error_array = array(); //Holds error messages

        //checking the submit button is pressed or not
        if(isset($_POST['register_button'])){
            //Registration form values

            //First name
            $fname = strip_tags($_POST['reg_fname']); //Remove html tags if user add it
            $fname = str_replace(' ', '', $fname); //remove spaces placed before and after variable
            $fname = ucfirst(strtolower($fname)); //Uppercase first letter and lower case the other
            $_SESSION['reg_fname'] = $fname; //Stores first name into session variable


            //Last name
            $lname = strip_tags($_POST['reg_lname']);
            $lname = str_replace(' ', '', $lname);
            $lname = ucfirst(strtolower($lname)); 
            $_SESSION['reg_lname'] = $lname; 

            //email address
            $em = strip_tags($_POST['reg_email']);
            $em = str_replace(' ', '', $em);
            $em = ucfirst(strtolower($em)); 
            $_SESSION['reg_email'] = $em;


            //Confirm email
            $em2 = strip_tags($_POST['reg_email2']); 
            $em2 = str_replace(' ', '', $em2);
            $em2 = ucfirst(strtolower($em2)); 
            $_SESSION['reg_email2'] = $em2;


            //Password
            $password = strip_tags($_POST['reg_password']); 
            $password2 = strip_tags($_POST['reg_password2']); 

            $date = date("Y-m-d"); //Current date

            if($em == $em2){

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
            if(empty($error_array)){
                //generate the encrypted password to store in database
                $password=md5($password); // can use md5(md5(id)$password) for extra security

                //generate username 
                $username = strtolower($fname . "_" . $lname); 
                //check whether username are present or not
        		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
                
                //if user name is present then we will add number to the user name
                $i=0; //initializing the number to add into user name 
                while(mysqli_num_rows($check_username_query) != 0) {
        			$i++; //increment the i
                    $username = $username . "_" . $i;
                    //to check again this user name present or not
		        	$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
                }
                
                //Profile picture assignment
                $rand = rand(1, 2); //Random number between 1 and 2

                if($rand == 1)
                    $profile_pic = "assets/images/profile_pics/defaults/head_green_sea.png";
                else if($rand == 2)
                    $profile_pic = "assets/images/profile_pics/defaults/head_red.png";
                
                $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
                array_push($error_array, "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>");

                //Clear session so initilize with zero
                $_SESSION['reg_fname'] = "";
                $_SESSION['reg_lname'] = "";
                $_SESSION['reg_email'] = "";
                $_SESSION['reg_email2'] = "";
            }
        }
?>
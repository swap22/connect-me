<?php  

if(isset($_POST['login_button'])) {

	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //sanitize email

	$_SESSION['log_email'] = $email; //Store email into session variable 
	$password = md5($_POST['log_password']); //Get password
        // check the email and password in the table
	$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
	$check_login_query = mysqli_num_rows($check_database_query);

	if($check_login_query == 1) {
		$row = mysqli_fetch_array($check_database_query);
		$username = $row['username']; //so from return row we will load its user name 

        // checking the whether the user is deactivated account or not
		$user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed='yes'");
		if(mysqli_num_rows($user_closed_query) == 1) {
            // if the account is deactivate the activate it again
			$reopen_account = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'");
		}

		$_SESSION['username'] = $username; // to keep login the user into server 
		header("Location: index.php");
		exit();
	}
	else {
		array_push($error_array, "Email or password was incorrect<br>");
	}


}

?>
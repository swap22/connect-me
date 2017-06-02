<?php
    require 'config/config.php';


if (isset($_SESSION['username'])) { // checking whether user log in or not
	$userLoggedIn = $_SESSION['username'];  // setting the variable 
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);// array is created so it can display information  

}
else {
	header("Location: register.php"); // if not log in then set in to log in form
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connect Me</title>

    <!-- CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/headerstyle.css">
	
</head>
</head>
<body>
    <div class="top_bar"> 

		<div class="logo">
			<a href="index.php">Connect ME!</a>
		</div>
        	<nav>
                    


                    <a href="#">
                        <?php echo $user['first_name']; ?>
                    </a>
                    <a href="index.php">
                        <i class="fa fa-home fa-lg"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-envelope fa-lg"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-bell fa-lg"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-users fa-lg"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-cog fa-lg"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-sign-out fa-lg"></i>
                    </a>

		</nav>

		
			
	</div>
   <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
	
	
	
	
    
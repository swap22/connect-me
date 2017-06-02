<?php
    require 'config/config.php';


if (isset($_SESSION['username'])) { // checking whether user log in or not
	$userLoggedIn = $_SESSION['username'];  // setting the variable 
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
</head>
<body>
    hi swapnil!!!!!!!!!
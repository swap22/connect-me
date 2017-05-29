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
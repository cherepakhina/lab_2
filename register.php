<?php

    if(isset($_POST['submit']))
    {
        if(strlen(trim($_POST['password'])) < 6){
            echo "Password must have at least 6 characters. ";
        }
        if(($_POST['password'] != $_POST['confirm_password'])){
            echo "Passwords did not match. ";
        } else{
            header("Location: http://localhost/signup.php");
            exit();
        }
    }
?>

<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">-->
   <link rel="stylesheet" href="assets\css\style.css">
   <link rel="stylesheet" href="assets\css\fonts.css">
   <style>
       .container {
           width: 400px;
       }
   </style>
</head>
<body>
<div class="container">
<h2>Sign up</h2>
	<form method="post"> 
        <input type="email" name="email" required="" placeholder="Email"><br>
        <br>
        <input type="text" name="fname" required="" placeholder="First Name"><br>
        <br>
        <input type="text" name="lname" required="" placeholder="Last Name"><br>
        <br>
        <select name="role" required="">
            <option value="" disabled="" selected="" hidden="">Select Role</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br>
        <br>
		<input type="password" name="password" required="" placeholder="Password"><br>
        <br>
        <input type="password" name="confirm_password" required="" placeholder="Confirm Password"><br>
        <br>
		<input type="submit" value="Sign Up" name="submit" class="btn">
	</form>
</div>
 </body>

</html>
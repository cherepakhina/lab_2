<?php

    if(isset($_POST['submit']))
    {
        if(strlen(trim($_POST['password'])) < 6){
            echo "Password must have at least 6 characters. ";
        }
        if(($_POST['password'] != $_POST['confirm_password'])){
            echo "Passwords did not match. ";
        }
    }
?>

<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="assets/css/login.css">
   <link rel="stylesheet" href="assets\css\layout.css">
   <link rel="stylesheet" href="assets\css\style.css">
   <link rel="stylesheet" href="assets\css\fonts.css">
</head>
<body>
<header class="header">
    <div class="container">
    <a href='home.php'><img src="assets/img/logo.png" alt="logo" height="10%" href='home.php' class='logo'></a>
        <div class="nav">
        <?php 
        session_start();
        include_once 'connection.php';

        if(!isset($_SESSION['role']))
        {
            echo"<p><button id='myBtn' class='button'>Sign in</button> | <a href='register.php'>Sign up</a></p>
            <div id='myModal' class='modal'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <span class='close'>&times;</span>
                        <h2>Sign in</h2>
                    </div>
                    <div class='modal-body'>
                    <form method='post' action='auth.php'>
                        Enter your email: <input type='text' name='email' required=''><br>
                        Enter your password:  <input type='password' name='password' required=''><br>
                        <input type='submit' value='Submit' name='submit' class='btn'>
                    </form>
                    </div>
                </div>
            </div>";
        }
        else
        {
            $id = $_SESSION['id'];
            switch($_SESSION['role'])
            {
                case 'user': echo"<p><a href='user_edit.php?id=".$id."''>".$_SESSION['f_name']."</a>
                | <a href='signout.php'>Sign out</a></p>";
        
                break;
            
                case 'admin':
                    echo"<p><a href='user_edit.php?id=".$id."'>".$_SESSION['f_name']."</a>
                    | <a href='signout.php'>Sign out</a></p>";
                break;
            }
        }   
        ?>
        </div>
    </div>
</header>

<div class="container">
    <?php if(isset($_GET['id']))
    {
        echo"<h1>New user</h1>";
    }
    else echo"<h1>Sign up</h1>";
    ?>

	<form method="post" action="signup.php"> 
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
        <?php if(isset($_GET['id']))
        {
            echo"<input type='submit' value='Add User' name='submit' class='btn'>";
        }
            else echo"<input type='submit' value='Sign Up' name='submit' class='btn'>";
        ?>
		
	</form>
</div>
 </body>
 <script src="assets\js\modal.js"></script>
</html>
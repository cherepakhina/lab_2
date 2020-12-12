<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="assets/css/login.css">
   <link rel="stylesheet" href="assets/css/layout.css"> 
   <link rel="stylesheet" href="assets/css/fonts.css">
   <link rel="stylesheet" href="assets/css/style.css">
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
    <main class="center">
        <div class="pfp">
        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $query = "SELECT *, roles.title FROM users INNER JOIN roles ON users.role_id = roles.id WHERE users.id = '$id'";
                if($result = $conn->query($query))
                {
                    while($row = $result->fetch_assoc())
                    {
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $email = $row['email'];
                    $password = $row['password'];
                    $image = $row['photo'];
                    $role = $row['title'];
                        if($image == NULL)
                        {
                            echo"<img src='https://thispersondoesnotexist.com/image' style='height:50%'/>";
                        }
                        else
                        {
                            echo"<img src='".$image."' style='height:75%;'/>";
                        }
                    }
                }
            }
        ?>
        </div>
        <div class="details">
            <?php
            echo"<input type='text' name='fname' value='".$first_name."' readonly><br>
                <br>
                <input type='text' name='lname' value='".$last_name."' readonly><br>
                <br>
                <input type='text' name='role' value='".$role."' readonly><br>
                <br>";

            if($_SESSION['role'] == 'admin')
            {
                echo"<input type='text' name='password' value='".$password."' readonly><br>";
                echo"<br><a href='user_edit.php?id=".$id."' target='_blank' class='button' style='margin-left: 0px;'>Edit</a>";
            }
            ?>
        </div>
    </main>
</div>
</body>
<script src="assets\js\modal.js"></script>
</html>

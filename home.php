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
   <style>
        .table a {
        display:block;
        text-decoration:none;
       }
   </style>
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
            echo"<p><button id='myBtn'>Sign in</button> | <a href='register.php'>Sign up</a></p>
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
    <h1>Users</h1>
        <table>
        <tr>
          <th> <font face="Arial">id</font> </th> 
          <th> <font face="Arial">First Name</font> </th> 
          <th> <font face="Arial">Last Name</font> </th> 
          <th> <font face="Arial">Email</font> </th> 
          <th> <font face="Arial">Role</font> </th> 
        </tr>
            <?php
            $query = "SELECT *, roles.title FROM users INNER JOIN roles ON users.role_id = roles.id";
            if($result = $conn->query($query))
            {
                while($row = $result->fetch_assoc())
                {
                    $id = $row['id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $email = $row['email'];
                    $role = $row['title'];
                    echo"<tr>
                        <td><a href='http://localhost/user.php?id=".$id."'>".$id."</a></td>
                        <td>".$first_name."</td>
                        <td>".$last_name."</td>
                        <td>".$email."</td>
                        <td>".$role."</td>
                    </tr>";
                }
                $result->free();
            }
            ?>
        </table>
        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') echo"<br><a href='register.php?id=add' target='_blank' class='button' style='margin-left: 0px;'>Add User</a>"; ?>
</div>
 </body>
 <script src="assets\js\modal.js"></script>
</html>
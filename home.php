<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <link rel="stylesheet" href="assets\css\login.css">
</head>
<body>
<header class="header"><p>
    <div class="container">
        <?php 
        session_start();
        require_once 'connection.php';
        if($_SESSION['auth'] == true)
        {
            echo"<p><a href='profile.php'>".$_SESSION['f_name']."</a>
            | <a href='signout.php'>Sign out</a></p>";
        }
        else
        {
            echo"<p><button id='myBtn' class='btn'>Sign in</button> | <a href='register.php'>Sign up</a></p>
            <div id='myModal' class='modal'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <span class='close'>&times;</span>
                        <h3>Sign in</h3>
                    </div>
                    <div class='modal-body'>
                    <form method='post' action='auth.php'>
                        Enter your email: <input type='text' name='email' required=''><br>
                        Enter your password:  <input type='password' name='password' required=''><br>
                        <input type='submit' value='Submit' name='submit' class='btn'>
                    </form>
                    </div>
                    <div class='modal-footer'>
                    <h3>Footer</h3>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>
</p></header>
<div class="container">
    <h3>Users</h3>
        <table>
        <tr>
          <th> <font face="Arial">#</font> </th> 
          <th> <font face="Arial">First Name</font> </th> 
          <th> <font face="Arial">Last Name</font> </th> 
          <th> <font face="Arial">Email</font> </th> 
          <th> <font face="Arial">Role</font> </th> 
        </tr>
            <?php
            $query = "SELECT * FROM `users`";
            if($result = $conn->query($query))
            {
                while($row = $result->fetch_assoc())
                {
                    $id = $row['id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $email = $row['email'];
                    $query = "SELECT roles.title FROM users INNER JOIN roles ON users.role_id = roles.id";
                    if($result = $conn->query($query))
                    {
                        while($row = $result->fetch_assoc())
                        {
                            $role = $row['title'];
                            echo"<tr>
                            <td>".$id."</td>
                            <td>".$first_name."</td>
                            <td>".$last_name."</td>
                            <td>".$email."</td>
                            <td>".$role."</td>
                        </tr>";
                        }
                    }
                }
                $result->free();
            }
            ?>
        </table>
</div>
 </body>
 <script src="assets\js\modal.js"></script>
</html>
<?php
session_start();
require_once 'connection.php';

$email = $_POST['email'];

$password = $_POST['password'];  

if (count($_POST) > 0) {
    $res = mysqli_query ($conn, "select * from `users` where email='$email' and password='$password';");
    $row = mysqli_fetch_array($res);
    if (is_array($row)){
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['auth'] = true;

        $query = "SELECT * FROM `users`";
        if($result = $conn->query($query))
        {
            while($row = $result->fetch_assoc())
            {
                $_SESSION['f_name'] = $row['first_name'];
                $_SESSION['l_name'] = $row['last_name'];
                $_SESSION['pic'] = $row['photo'];
                header("Location: http://localhost/home.php");
                exit();
            }
        }
} else
{
    echo 'Invalid password';
    $_SESSION['auth'] = false;
}
}


?>

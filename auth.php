<?php
session_start();
require_once 'connection.php';

$email = $_POST['email'];

$password = $_POST['password'];  

if (count($_POST) > 0) {

    $query = "SELECT *, roles.title FROM users INNER JOIN roles ON users.role_id = roles.id
    WHERE email = '$email' AND password = '$password'";
        if($result = $conn->query($query))
        {
            while($row = $result->fetch_assoc())
            {
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['f_name'] = $row['first_name'];
                $_SESSION['l_name'] = $row['last_name'];
                $_SESSION['pic'] = $row['photo'];
                $_SESSION['role'] = $row['title'];
                header("Location: http://localhost/home.php");
                exit();
            }
        }
}
 else
{
    echo 'Invalid password';
    $_SESSION['role'] = NULL;
}


?>

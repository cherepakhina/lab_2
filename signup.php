<?php

require_once 'connection.php';

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $password = $_POST['password'];
    $title = $_POST['role'];
    $sql = "INSERT INTO users (first_name, last_name, password, email) VALUES ('$first_name', '$last_name', '$password', '$email');";
    $sql.= "INSERT INTO roles (title) VALUES ('$title');";
    $sql.= "UPDATE users INNER JOIN roles ON users.id = roles.id SET users.role_id = roles.id;";

	 if (mysqli_multi_query($conn, $sql)) {
        header("Location: http://localhost/auth.php");
        exit();
    } else {
        echo "Error: " . $sql . "
        " . mysqli_error($conn);
	 }
     mysqli_close($conn);
}
?>
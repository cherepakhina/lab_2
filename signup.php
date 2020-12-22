<?php

require_once 'connection.php';

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $password = $_POST['password'];
    $title = $_POST['role'];
    
    $query = "INSERT INTO users (first_name, last_name, password, email) VALUES ('$first_name', '$last_name', '$password', '$email')";

    if ($result = $conn->query($query)) {
        $query ="INSERT INTO roles (title) VALUES ('$title')";
        if($result = $conn->query($query))
        {
            $query ="UPDATE users INNER JOIN roles ON users.id = roles.id SET users.role_id = roles.id";
            if($result = $conn->query($query)){
                $query = "SELECT * FROM `users`";
                if($result = $conn->query($query))
                {
                    while($row = $result->fetch_assoc())
                    {
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['password'] = $row['password'];
                        $_SESSION['f_name'] = $row['first_name'];
                    }
                }
                header("Location: http://localhost/home.php");
                exit();
            }
        }
    } else {
        echo "Error: " . $sql . "
        " . mysqli_error($conn);
	 }
     mysqli_close($conn);
}
?>
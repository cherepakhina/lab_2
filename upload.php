<?php
session_start();

require_once 'connection.php';
$target_dir = "public/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
    	$uploadOk = 1;
	} else {
        echo "File is not an image.";
    	$uploadOk = 0;
	}
}

if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
	$uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
	$uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		//$login = $_POST['login'];
		$sql = "UPDATE users SET photo = '$target_file'";
		if(mysqli_query($conn, $sql)){
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $query = "SELECT * FROM users";
        if($result = $conn->query($query))
        {
            while($row = $result->fetch_assoc())
            {
                $_SESSION['pic'] = $row['photo'];
            }
        }
		} else {
			echo "Error: " . $sql . "
			" . mysqli_error($conn);
		}
		 mysqli_close($conn);
		 header("Location: http://localhost/profile.php");
         exit();
	} else {
        echo "Sorry, there was an error uploading your file.";
	}
}
?>
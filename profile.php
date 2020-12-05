<!--<html>
<body>
    <div class="pfp">
    
        <form action="upload.php" method="post" enctype="multipart/form-data">
	    Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
        <img src="https://thispersondoesnotexist.com/image" style="width:200px;height:200px;"/>
    </div>
</form>
</body>
</html>-->

<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <style>
       .pfp_container {
           float: left;
           width: 400px;
       }
       .container {
           width: 400px;
           float: middle;
       }
   </style>
</head>
<body>
<div class="pfp_container">
<a href='home.php'>Home</a>
    <div class="pfp">
        <?php
            session_start();
            $image = $_SESSION['pic'];
            if($image == NULL)
            {
                echo"<img src='https://thispersondoesnotexist.com/image' style='height:50%'/>";
            }
            else
            {
                echo"<img src='".$image."' style='height:75%;'/>";
            }
        ?>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Submit" name="submit" class = btn>
        </form>
    </div>
</div>
<div class="container">
    <?php
    echo"<input type='text' name='fname' value='".$_SESSION['f_name']."'><br>
        <br>
        <input type='text' name='lname' value='".$_SESSION['l_name']."'><br>
        <br>
        <input type='password' name='password' placeholder='Password'><br>
        <br>
        <input type='password' name='confirm_password' required='' placeholder='Confirm Password'><br>
        <br>";
    ?>
</div>
</body>
</html>

<?php session_start();
 
 $_SESSION = array();
  
 session_destroy();

 session_start();
 
 $_SESSION['auth'] = false;

 header("location: http://localhost/home.php");
 exit;
 ?>
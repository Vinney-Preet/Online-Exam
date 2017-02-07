<?php
 session_start();
?>
<!DOCTYPE>
<html>
<head>
  <title>Signout</title>
  <style>
  body {background-color: powderblue;}
  h1   {color: blue;}
  p    {color: red;}
  
  </style>
</head>
 <?php
 //remove all session;
 	session_unset();
 	//destroy session
 	session_destroy();
 	header("Location: index.php");
 ?>


<body>
</body>
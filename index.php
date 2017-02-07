
<?php
session_start();
?>

<!DOCTYPE>
<html>
<head>
  <title>Welcome to Online Exam System</title>
  <style>
  body {background-color: powderblue;}
  h1   {color: blue;}
  p    {color: red;}
  
  </style>
</head>

<body>

<?php
  include "database.php";
  
  extract($_POST);
  
  if(isset($Login))
  {
    $sql = "select * from mst_user where login='$loginid' and pass='$pass'";
   $rs=mysql_query($sql);
   if( mysql_num_rows($rs) < 1)
   {
     $found="N";
   }
   else
   {
     $_SESSION[login]=$loginid;
   }
  }

  if(isset($_SESSION[login]))
  {
    echo "<div align='right'><a  href='index.php'>Home</a> <a  href='signout.php'>Logout </a> </div>";
    echo "<h1 align = 'center'>Welcome to Online Exam System</h1>";

    echo "<p align = 'center'><a href= 'subjectlist.php'>Subject List </a> </p>";
    echo "<p align = 'center'><a href= 'result.php'>Result </a> </p>";
    exit;
  }
  
?>
<div align = "center" >
<h1>Welcome to Online Exam System</h1>
<img src="images/paathshala.jpg"/>
<br>
<?php
if(isset($found))
    {
      echo "<p>Invalid loginid and password\n</p>";
    }
?>    
<form action="" method="post">
<p>LoginId: <input type="text" name="loginid" required><br>
Password: <input type = "password" name = "pass" required><br></p>
<input type= "submit" name= "Login" value="Login">
</form>

<br>
<a href="signup.php">New User ? Register</a>
<br>
<p>WelCome to Online Exam System. This Site will provide the quiz for various subject of interest. You need to login for the take the online exam.</p>

</div>


</body>

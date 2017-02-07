<?php
 session_start();
?>
<!DOCTYPE>
<html>
<head>
  <title>Subject List</title>
  <style>
  body {background-color: powderblue;}
  h1   {color: blue;}
  p    {color: red;}
  
  </style>
</head>
<?php
	include "database.php";
	echo "<div align='right'><a  href='index.php'>Home</a> <a  href='signout.php'>Logout </a>  <a href='index.php'>Back</a> </div>";
	$sql = "select * from mst_subject";
	$rs = mysql_query($sql);
	echo "<h1 align= 'center'>Sunject List</h1>\n";
	while($row = mysql_fetch_row($rs))
	{
		echo "<p align='center'><a href=showtest.php?subid=$row[0] > $row[1] </a></p>\n";
	}
?>
<body>
</body>
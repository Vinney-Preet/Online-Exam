<?php
 session_start();
 extract($_GET);
 unset($_SESSION[qn]);
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
	include ("database.php");
	$rs1 = mysql_query("select * from mst_subject where sub_id=$subid");//
	$row1 = mysql_fetch_row($rs1);
	echo "<div align='right'><a  href='index.php'>Home</a> <a  href='signout.php'>Logout </a> <a href='subjectlist.php'>Back</a> </div>";
	echo "<h1 align= 'center'>Onine Exam System</h1>";
	
	//echo " ";

	$sql = "select * from mst_test where sub_id=$subid";//
	$rs = mysql_query($sql);
	if(mysql_num_rows($rs) < 1)
	{
		echo "<h1 align= 'center'>No test found</h1>\n";
		echo "<p align= 'center'><a href='subjectlist.php'>Back</a></p>";
		exit;
	}
	//echo "<p align= 'center'>Select Quiz Name</p>\n";
	echo "<p align= 'center'>Select Test on $row1[1]</p>";

	while($row = mysql_fetch_row($rs))
	{
		echo "<p align='center'><a href='quiz.php?testid=$row[0]&subid=$row1[0]'>$row[2]</a></p>\n";
	}
?>
<body>
</body>
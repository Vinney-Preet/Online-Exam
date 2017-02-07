<?php
 session_start();
 include "database.php";
 extract($_POST);
 extract($_GET);
 
 if(isset($subid) && isset($testid))
 {
 	$_SESSION[sid]=$subid;
 	$_SESSION[tid]=$testid;
 }
 else if(!isset($_SESSION[sid]) || !isset($_SESSION[tid]) )
 {
 	header("location: index.php");
 }
 extract($_SESSION);
?>
<!DOCTYPE>
<html>
<head>
  <title>quiz</title>
  <style>
  body {background-color: powderblue;}
  h1   {color: blue;}
  p    {color: red;}
  
  </style>
</head>

<body>
<?php
//echo "tid-> $tid ";
	$q1= "select * from mst_question where test_id = $tid";//$tid
	$rs = mysql_query($q1);
	$r = mysql_num_rows($rs);//echo "no. of ques-> $r";
	if($r == 0)
	{
		$t = $_SESSION[sid];
		echo "<h1 align= 'center'>No test found</h1>\n";
		echo "<p align= 'center'><a href='showtest.php?subid=$t'>Back</a></p>";
		exit;
	}
	if(!isset($qn))
	{// echo "set qn";
		$_SESSION[qn] = 0;
		$q2 = "delete from where sess_id='" . session_id() . "'";
		mysql_query($q2);
		$_SESSION[trueans] = 0;
	}
	else
	{
		if($submit=='Next Question' && isset($ans))
		{
			mysql_data_seek($rs, $_SESSION[qn]);
			$row = mysql_fetch_row($rs);
			//update data to mst_useranswer db
			$q3 = "insert into mst_useranswer value('". session_id() ."',$tid,'$row[2]','$row[3]','$row[4]','$row[5]','$row[6]',$row[7],$ans";
			mysql_query($q3);
			if($ans == $row[7])
			{
				$_SESSION[trueans] += 1;
			}
			$_SESSION[qn] += 1;
		}
		else if(($submit=='Get Result' || $submit=='Submit') && isset($ans))
		{
			mysql_data_seek($rs, $_SESSION[qn]);
			$row = mysql_fetch_row($rs);
			//update data to mst_useranswer db
			$q3 = "insert into mst_useranswer value('". session_id() ."',$tid,'$row[2]','$row[3]','$row[4]','$row[5]','$row[6]',$row[7],$ans";
			mysql_query($q3);
			if($ans == $row[7])
			{
				$_SESSION[trueans] += 1;
			}
			$_SESSION[qn] += 1;

			//and more
			$score = $_SESSION[trueans];
			echo "<Table align=center><tr class=tot><td>Total Question<td> $r";
				echo "<tr class=tans><td>True Answer<td>".$score;
				$w=$r-$_SESSION[trueans];
				echo "<tr class=fans><td>Wrong Answer<td> ". $w;
				echo "</table>";
				mysql_query("insert into mst_result(login,test_id,test_date,score) values('$login',$tid,'".date("d/m/Y")."',$trueans)") or die(mysql_error());
				echo "<h1 align=center><a href=index.php> Thanks You </a> </h1>";
			unset($_SESSION[tid]);
			unset($_SESSION[sid]);
			unset($_SESSION[qn]);
			unset($_SESSION[trueans]);
			exit;
		}
		else if($submit=='Submit')
		{
			$score = $_SESSION[trueans];
			echo "<Table align=center><tr class=tot><td>Total Question<td> $r";
				echo "<tr class=tans><td>True Answer<td>".$score;
				$w=$r-$_SESSION[trueans];
				echo "<tr class=fans><td>Wrong Answer<td> ". $w;
				echo "</table>";
				mysql_query("insert into mst_result(login,test_id,test_date,score) values('$login',$tid,'".date("d/m/Y")."',$trueans)") or die(mysql_error());
				echo "<h1 align=center><a href=index.php> Thanks You </a> </h1>";
			unset($_SESSION[tid]);
			unset($_SESSION[sid]);
			unset($_SESSION[qn]);
			unset($_SESSION[trueans]);
			exit;
		}
	}

$crs = mysql_query("select * from mst_question where test_id = $tid");

$q = ($_SESSION[qn] + 1);
mysql_data_seek($crs, $_SESSION[qn]);
$row = mysql_fetch_row($crs);

echo "<div align='right'><a  href='index.php'>Home</a> <a  href='signout.php'>Logout </a> </div>";
echo "<h1 align= 'center'>Test</h1>";
echo "<p align = 'right'>$r/$_SESSION[qn]</p>";
echo "<div align= 'left'><form action=quiz.php method=post>";
echo "<p> $q. $row[2] </p>";
echo "<input type='radio' name='ans' value='1'> $row[3] </input><br>";
echo "<input type='radio' name='ans' value='2'> $row[4] </input><br>";
echo "<input type='radio' name='ans' value='3'> $row[5] </input><br>";
echo "<input type='radio' name='ans' value='4'> $row[6] </input><br>";

if($_SESSION[qn] + 1 == $r)
{
	echo "<input type='submit' name='submit' value='Get Result'></input>";
}
else
{
	echo "<input type='submit' name='submit' value='Next Question'></input>";	
}
echo "<input type='submit' name='submit' value='Submit'></input><br>";
echo "</form></div>";
?>

</body>
</html>
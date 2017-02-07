<!Doctype>
<html>
	<head>
		<title>Signup</title>
		<style type="text/css">
			body {background-color: powderblue;}
			p {color: red;}
			h1 {color: blue;}
      .error {color: red;}
		</style>
		<script type="text/javascript">
			
		</script>
	</head>	
	</head>
	<body>
     <div align= "center">
     <h1> New User </h1>
     <img src="images/connected_multiple.jpg"/><br><br>
     <form name="form1" method="post" action="signupuser.php" onSubmit="return check();">
       
           Login Id: 
           <input type="text" name="loginid"><br><br>
           Password:
           <input type="password" name="pass"><br><br>
         Confirm Password:
           <input name="cpass" type="password" id="cpass"><br><br>

           Name:
           <input name="name" type="text" id="name"><br>
<br>
           Address: <textarea name="address" id="address"></textarea><br>
    <br>     
         City: <input name="city" type="text" id="city"><br><br>

           Phone: <input name="phone" type="text" id="phone"><br><br>
         
           E-mail:
           <input name="email" type="text" id="email"><br><br>
         
           <input type="submit" name="Submit" value="Signup"><br><br>
           
     </form></div>
	</body>
</html>
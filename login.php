<!DOCTYPE html>
<html>
<body>


<?php
	$username = $_POST['username']; 
	$password = $_POST['password'];

	#Connect to DB
	$con = mysql_connect("localhost", "root", "77884747");
	mysql_select_db("youwrite", $con);
	/*
	#Fetch the inquiry, username
	$result=mysql_query("SELECT * FROM users");
	echo "<br />";

	while($row = mysql_fetch_array($result))
  	{
  		echo $row['username'] . " " . $row['password'];
  		echo "<br />";
  	}
  	*/
	#Do the Validation

	$result2 = mysql_query("SELECT * FROM users WHERE username = '$username' AND password = '$password' ");

	$numrows = mysql_num_rows($result2);
	
	# echo 'numrows:'.$numrows;

	if($numrows > 1)
	{ echo "hacked"; }
	else if ($numrows == 0)
	{ echo "Wrong username or password."; }
	else 
	{
		/*echo "Login successful!<br /> Welcome $username!";*/
		session_start();
		$_SESSION["admin"] = true;
		$_SESSION["username"] = $username; 
		echo 
		"<br />
		<body bgcolor = '#93CDDD'>
        
        	<p>
    			<div style='position: relative; top:10px; left:40%; width:200px; height:25px'>
    				<font face = 'Helvetica' size= '50'><b>Welcome $username!</b></font>
    			</div>
    		</p>

    		<p>
    			<div style='position: relative; top:200px; left:10%'>
    				<font face = 'Helvetica' size= '50'><b><u><font color = '#424242'> You</u></font> Will <u><font color = '#351DE3'>Write</u></font> Something Amazing</b></font>
    			</div>
    		</p>	

    		<div style = 'position: relative; top: 70px; left: 45%; width: 200px; height: 200px'>
    			<form method='get' action='http://andyxu.me:5000/load'>
    				<button type='submit'>Profile Page</button> 
    			</form>
    		</div>

    	</body>
		";
	}
  
	mysql_close($con);

?>

</body>
</html>
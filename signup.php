<!DOCTYPE html>
<html>
<body>

<h1>Signup Complete</h1>

<?php

$name= $_POST["name"];
$username= $_POST["username"];
$pw= $_POST["password"];
$email= $_POST["email"];

echo "Welcome ".$name."!";


// Create connection
$con = mysql_connect("localhost", "root", "77884747");
mysql_select_db("youwrite", $con);

// Add inquiry
mysql_query("INSERT INTO users (name, username,password,email) 
VALUES ('$name', '$username', '$pw','$email')");

echo "<br /><a href='user.html'>Go back.</a>";

mysql_close($con);


?>

</body>
</html>

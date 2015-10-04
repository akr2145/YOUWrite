<!DOCTYPE html>
<html>
<body>

<h1>Signup Page</h1>

<?php

// Create connection
$con = mysql_connect("localhost", "root", "77884747");
echo "connectcomplete";

mysql_select_db("youwrite", $con);
echo "selectedcomplete";

// Check connection
mysql_query("INSERT INTO users (name, username,password,email) 
VALUES ('Peter', 'peterpan', '3588888','ss@ss.com')");

echo "done";

mysql_close($con);


?>

</body>
</html>
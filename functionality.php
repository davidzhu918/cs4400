<?php
	session_start();
	import 'dbinfo.php';
	$usn = $_SESSION['username'];
	$identity = $_SESSION['identity'];
?>

<html>
<head>
	<title>Hi</title>
</head>
<body>
<center>
<br><br><br>
<b><p>Choose functionality</p></b>
<b><p>Hi <?php echo $usn ?></p></b>
<?php
mysql_connect($host,$username,$password) or die( "Unable to connect");;
mysql_select_db($database) or die( "Unable to select database");

if ($identity == "customer") {

	echo "<form action=\"index.php\" method=\"post\">";
	echo "Employee Query";
	echo "<input type=\"submit\" value=\"submit\" name=\"submit\">";
	echo "</form>";
}

?>
</center>
</body>
</html>
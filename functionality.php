<?php
        session_start();
        include 'dbinfo.php';
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
        echo "Make a new reservation";
        echo "<input type=\"submit\" value=\"submit\" name=\"submit\">";
        echo "<form action=\"index.php\" method=\"post\">";
        echo "Update your reservation";
        echo "<input type=\"submit\" value=\"submit\" name=\"submit\">";
        echo "Cancel Reservation";
        echo "<input type=\"submit\" value=\"submit\" name=\"submit\">";
        echo "<input type=\"submit\" value=\"submit\" name=\"submit\">";
        echo "Provide feedback";
        echo "<input type=\"submit\" value=\"submit\" name=\"submit\">";
        echo "<input type=\"submit\" value=\"submit\" name=\"submit\">";
        echo "View feedback";
        echo "<input type=\"submit\" value=\"submit\" name=\"submit\">";

        echo "</form>";

}

?>
</center>
</body>
</html>

<?php
session_start();
include 'dbinfo.php';
$usn = $_SESSION['usn'];

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: index.php');
    exit();
}

if (isset($_POST['go_back'])) {
    redirect('functionality_manager.php');
}

mysql_connect($host,$db_username,$db_password) or die( "Unable to connect");
mysql_select_db($database) or die( "Unable to select database");

?>

<html>
<head>
        <title>Revenue Report</title>
</head>

Hi <?php echo $usn; ?>
<form action="" method="POST" />
<input type="submit" name="logout" value="Logout" />
</form>

<body>
<center>
<br><br><br>
<form action="" method="POST">
<b><p>Revenue Report</p></b>

<input type="submit" name="go_back" value="Go Back" />
</form>

<?php
$location = $_POST['location'];
$sql_query = "SELECT    M, Location, SUM(TotalCost) AS Revenue
                FROM    (
                     SELECT month(StartDate) AS M, Location, TotalCost
                     FROM (RESERVATION NATURAL JOIN HAS_ROOM)
                ) AS K
                WHERE M = 8 OR M = 9
                GROUP BY M, Location";

$result = mysql_query ($sql_query)  or die(mysql_error());

echo "<table border=\"1\"><tr>
    <td>Month</td>
    <td>Location</td>
    <td>Total Revenue</td></tr>";
while ($row = mysql_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$row['M']."</td>";
    echo "<td>".$row['Location']."</td>";
    echo "<td>".$row['Revenue']."</td>";
    echo "</tr>";
}
echo "</table><br>";
?>

</center>
</body>
</html>
<?php
session_start();
include 'dbinfo.php';
$usn = $_SESSION['username'];
$identity = $_SESSION['identity'];

if (isset($_POST['logout'])) {
        session_unset();
        error_reporting(E_ALL);
        ini_set('display_errors',1);
        header('Location: index.php');
        exit();
}
?>

<html>
<head>
        <title>Hi</title>
</head>

Hi <?php echo $usn ?>
<form action="" method="POST">
<input type="submit" name="logout" value="Logout"/>
</form>

<body>
<center>
<br><br><br>
<b><p>Give Review</p></b>
<?php
mysql_connect($host,$username,$password) or die( "Unable to connect");;
mysql_select_db($database) or die( "Unable to select database");

?>

<form action="available_rooms.php" method="post">
Location 
<select name = "location">
        <option value="Atlanta">Atlanta</option>
        <option value="Charlotte">Charlotte</option>
        <option value="Savannah">Savannah</option>
        <option value="Orlando">Orlando</option>
        <option value="Miami">Miami</option>
</select>
<br>

Start Date:
<input type="start_date" />
End Date:
<input type="end_date" />

<input type="submit" />
</form>

</center>
</body>
</html>
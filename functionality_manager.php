<?php
session_start();
$usn = $_SESSION['usn'];

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
        <title>Chooose Functionality</title>
</head>

Hi <?php echo $usn ?>
<form action="" method="POST">
<input type="submit" name="logout" value="Logout"/>
</form>

<body>
<center>
<br><br><br>
<b><p>Choose Functionality</p></b>

<a href=\"reservation_rpt.php\">  <p>View reservation report</p></a>

<a href=\"popular_room_rpt.php\">  <p>View popular room category report</p></a>

<a href=\"revenue_rpt.php\">  <p>View revenue report</p></a>

</center>
</body>
</html>
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
        <title>Choose Functionality</title>
</head>

Hi <?php echo $usn ?>
<form action="" method="POST">
<input type="submit" name="logout" value="Logout"/>
</form>

<body>
<center>
<br><br><br>
<b><p>Choose Functionality</p></b>

<a href="room_search.php"> <p>Make a new reservation</p></a>

<a href="rsv_update.php"> <p>Update your reservation</p></a>

<a href="rsv_cancel.php"> <p>Cancel Reservation</p></a>

<a href="giva_feedback.php"> <p>Provide feedback</p></a>

<a href="view_feedback.php"> <p>View feedbck</p></a>

</center>
</body>
</html>
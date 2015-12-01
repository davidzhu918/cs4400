<?php
session_start();
$usn = $_SESSION['usn'];

if (isset($_POST['logout'])) {
    session_unset();
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

<a href="view_reservation.php"> <p>View Reservation Report</p></a>

<a href="view_popular_room.php"> <p>View Popular Room Category Report</p></a>

<a href="view_revenue.php"> <p>View Revenue Report</p></a>

</center>
</body>
</html>
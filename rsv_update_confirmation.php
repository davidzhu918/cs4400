<?php
session_start();
include 'dbinfo.php';

$usn = $_SESSION['usn'];
$start = $_SESSION['start'];
$end = $_SESSION['end'];
$total_cost = $_SESSION['total_cost'];
$rsv = $_SESSION['rsv'];
$rsv_id = $rsv['ReservationID'];

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: index.php');
    exit();
}

if (isset($_POST['go_back'])) {
    session_unset();
    $_SESSION['usn'] = $usn;
    $_SESSION['identity'] = "customer";
    redirect('functionality_customer.php');
}

mysql_connect($host,$db_username,$db_password) or die( "Unable to connect");
mysql_select_db($database) or die( "Unable to select database");

$sql_query = "UPDATE    RESERVATION
                SET     StartDate = '".$start."', EndDate = '".$end."', TotalCost = ".$total_cost."
                WHERE   ReservationID = ".$rsv['ReservationID'];
$result = mysql_query($sql_query) or die(mysql_error());
?>

<html>
<head>
        <title>Update Confirmation</title>
</head>

Hi <?php echo $usn; ?>
<form action="" method="POST" />
<input type="submit" name="logout" value="Logout" />
</form>

<body>
<center>
<br><br><br>
<b><p>Congratulations! Your reservation is updated!</p></b>
Your Reservation ID: <?php echo $rsv_id; ?>
<br>
Please save this reservation ID for all further communication.
<br><br>
<form action="" method="POST">
<input type="submit" name="go_back" value="Main Page" />
</form>

</center>
</body>
</html>
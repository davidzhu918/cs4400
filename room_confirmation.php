<?php
session_start();
include 'dbinfo.php';

$usn = $_SESSION['usn'];
$room_arr = $_SESSION['room_arr'];
$start = $_SESSION['start'];
$end = $_SESSION['end'];
$location = $_SESSION['location'];
$extra_bed = $_SESSION['extra_bed'];
$total_cost = $_SESSION['total_cost'];
$card = $_SESSION['card'];

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

$sql_query = "SELECT    MAX(ReservationID) + 1 AS id
                FROM    RESERVATION";
$result = mysql_query($sql_query) or die(mysql_error());

$id = mysql_fetch_array($result);
$id = $id['id'];

$sql_query = "INSERT INTO   RESERVATION
                VALUES (".$id.", '".$start."', '".$end."', 0, '".$card."', '".$usn."', ".$total_cost.")";
$result = mysql_query($sql_query) or die(mysql_error());

for ($i = 0; $i < count($room_arr); $i++) {
    $row = $room_arr[$i];
    $is_extra = $extra_bed['room'.$i] == "on" ? 1 : 0;
    $sql_query = "INSERT INTO   HAS_ROOM
                    VALUES (".$row['RoomID'].", '".$location."', ".$id.", ".$is_extra.")";
    $result = mysql_query($sql_query) or die(mysql_error());
}
?>

<html>
<head>
        <title>Confirmation</title>
</head>

Hi <?php echo $usn; ?>
<form action="" method="POST" />
<input type="submit" name="logout" value="Logout" />
</form>

<body>
<center>
<br><br><br>
<b><p>Congratulations! Your rooms are reserved!</p></b>
<br>
Your Reservation ID: <?php echo $id; ?>
<br>
Please save this reservation ID for all further communication.
<form action="" method="POST">
<input type="submit" name="go_back" value="Main Page" />
</form>

</center>
</body>
</html>
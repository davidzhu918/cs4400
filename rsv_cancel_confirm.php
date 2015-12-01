<?php
session_start();
include 'dbinfo.php';
$usn = $_SESSION['usn'];
$rsv = $_SESSION['rsv'];

$start = $_SESSION['start'];
$end = $_SESSION['end'];
$total = $_SESSION['total'];
$room_arr = $_SESSION['room_arr'];

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: index.php');
    exit();
}

if (isset($_POST['go_back'])) {
    unset($_SESSION['start']);
    unset($_SESSION['end']);
    unset($_SESSION['total']);
    unset($_SESSION['room_arr']);
    unset($_SESSION['new_total']);
    redirect('rsv_cancel.php');
}

if (isset($_POST['cancel'])) {
    redirect('rsv_cancel_success.php');
}
?>

<html>
<head>
        <title>Cancel Reservation</title>
</head>

Hi <?php echo $usn; ?>
<form action="" method="POST" />
<input type="submit" name="logout" value="Logout" />
</form>

<body>
<center>
<br><br><br>
<b><p>Confirm Cancellation</p></b>
Start Date: <?php echo $start; ?>
&nbsp;&nbsp;
End Date: <?php echo $end; ?>

<table border="1"><tr>
    <td>Room Number</td>
    <td>Room Category</td>
    <td>#People allowed</td>
    <td>Cost/Day</td>
    <td>Cost of Extra Bed/Day</td>
    <td>Extra Bed</td></tr>
    <?php
    for ($i = 0; $i < count($room_arr); $i++) {
        $row = $room_arr[$i];
        echo "<tr>";
        echo "<td>".$row['RoomID']."</td>";
        echo "<td>".$row['Category']."</td>";
        echo "<td>".$row['NumPeople']."</td>";
        echo "<td>$ ".$row['CostPerDay']."</td>";
        echo "<td>$ ".$row['CostBedPerDay']."</td>";
        $checked = $row['IncludeExtraBed'] == 1 ? "checked=\"checked\"" : "";
        echo "<td><input type=\"checkbox\" ".$checked." disabled=\"disabled\"/></td>";
        echo "</tr>";
    }
    ?>
</table>
Total Cost of Reservation: <?php echo "$ ".$total; ?>
<br>
Date of Cancellation: <?php echo $today; ?>
<br>
Amount to be refunded: <?php
$days = (strtotime($start) - strtotime($today))/86400;
if ($days > 3) {
    $refund = $total;
} else if ($days > 1) {
    $refund = $total * 0.8;
} else {
    $refund = 0;
}
$_SESSION['new_total'] = $total - $refund;
echo "$ ".$refund.".00";
?>
<form action="" method="POST">
<input type="submit" name="cancel" value="Comfirm" />
<input type="submit" name="go_back" value="Go Back" />
</form>

</center>
</body>
</html>
<?php
session_start();
include 'dbinfo.php';
$usn = $_SESSION['usn'];
$rsv = $_SESSION['rsv'];
$start = $_SESSION['start'];
$end = $_SESSION['end'];

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: index.php');
    exit();
}

if (isset($_POST['submit'])) {
    redirect('rsv_update_confirmation.php');
}

if (isset($_POST['go_back'])) {
    unset($_SESSION['start']);
    unset($_SESSION['end']);
    redirect('rsv_update_date.php');
}

mysql_connect($host,$db_username,$db_password) or die( "Unable to connect");;
mysql_select_db($database) or die( "Unable to select database");

// Search availability
// $sql_query = "";
// $result = mysql_query($sql_query) or die(mysql_error());

// $err;
// if (mysql_num_rows($result) == 0) { //not available
//     $err = "Room not available";
// }


// Current rooms info
$sql_query = "SELECT    RM.*, IncludeExtraBed
                FROM    ROOM AS RM NATURAL JOIN HAS_ROOM
                        NATURAL JOIN RESERVATION
                WHERE   ReservationID = '".$rsv['ReservationID']."'";
$result = mysql_query($sql_query) or die(mysql_error());
?>

<html>
<head>
        <title>Update Reservation</title>
</head>

Hi <?php echo $usn; ?>
<form action="" method="POST" />
<input type="submit" name="logout" value="Logout" />
</form>

<body>
<center>
<br><br><br>

<b><p>Confirm Details</p></b>
Rooms are available. Please confirm details below before submitting.
<br><br>
<table border="1">
    <tr>
        <td>Room Number</td>
        <td>Room Category</td>
        <td>#People allowed</td>
        <td>Cost/Day</td>
        <td>Cost of Extra Bed/Day</td>
        <td>Extra Bed</td>
    </tr>
    <?php
    while ($row = mysql_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$row['RoomID']."</td>";
        echo "<td>".$row['Category']."</td>";
        echo "<td>".$row['NumPeople']."</td>";
        echo "<td>$ ".$row['CostPerDay']."</td>";
        echo "<td>$ ".$row['CostBedPerDay']."</td>";
        $checked = $row['IncludeExtraBed'] == 1 ? "checked=\"checked\"" : "checked=\"unchecked\"";
        echo "<td><input type=\"checkbox\" ".$checked." disabled=\"disabled\" /></td>";
        echo "</tr>";
    }
    ?>
</table>
<br>
Total Cost: <?php
$total = $rsv['TotalCost'];
$cur_start = $rsv['StartDate'];
$cur_end = $rsv['EndDate'];
$total = $total / (strtotime($cur_end) - strtotime($cur_start)) * (strtotime($end) - strtotime($start));
$_SESSION['total_cost'] = $total;
echo "$ ".$total.".00";
?>

<form action="" method="POST">
<input type="submit" name="submit" value="Confirm" />
<input type="submit" name="go_back" value="Go Back" />
</form>

</center>
</body>
</html>
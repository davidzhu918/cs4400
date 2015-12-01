<?php
session_start();
include 'dbinfo.php';
$usn = $_SESSION['usn'];
$room_arr = $_SESSION['room_arr'];
$start = $_SESSION['start'];
$end = $_SESSION['end'];

mysql_connect($host,$db_username,$db_password) or die( "Unable to connect");
mysql_select_db($database) or die( "Unable to select database");

$sql_query = "SELECT            CardID AS card_id
                FROM            PAYMENT_INFO 
                WHERE BINARY    Username = '".$usn."' AND
                                ExpDate > ".$today;  
$result = mysql_query($sql_query)  or die(mysql_error());

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: index.php');
    exit();
}


if (isset($_POST['go_back'])) {
    unset($_SESSION['room_arr']);
    unset($_SESSION['extra_bed']);
    unset($_SESSION['total_cost']);
    redirect('rooms_available.php');
}

if (isset($_POST['submit'])) {
    if (isset($_POST['card'])) {
        $_SESSION['card'] = $_POST['card'];
        redirect('room_confirmation.php');
    }
    $err = "Please add a card";
}

if (isset($_POST['update'])) {
    $extra = 0;
    $j = 0;
    while ($j < count($room_arr)) {
        if ($_POST['room'.$j] == "on") {
            $extra_bed['room'.$j] = "on";
            $extra += $room_arr[$j]['CostBedPerDay'];
        }
        $j++;
    }
    $_SESSION['extra_bed'] = $extra_bed;
} else if (isset($_POST['clear'])) {
    unset($extra_bed);
    $extra = 0;

}
?>

<html>
<head>
        <title>Book Rooms</title>
</head>

Hi <?php echo $usn; ?>
<form action="" method="POST" />
<input type="submit" name="logout" value="Logout" />
</form>

<body>
<center>
<br><br><br>
<b><p>Make Reservation</p></b>

Start Date: <?php echo $start;?> &nbsp; End Date: <?php echo $end;?>
<br><br>

<form action="" method="POST" />
<table border="1"><tr>
    <td>Room Number</td>
    <td>Room Category</td>
    <td>#People allowed</td>
    <td>Cost/Day</td>
    <td>Cost of Extra Bed/Day</td>
    <td>Extra Bed</td></tr>

<?php
$cost = 0;
for ($i = 0; $i < count($room_arr); $i++) {
    $row = $room_arr[$i];
    $cost += $row['CostPerDay'];
    echo "<tr>";
    echo "<td>".$row['RoomID']."</td>";
    echo "<td>".$row['Category']."</td>";
    echo "<td>".$row['NumPeople']."</td>";
    echo "<td>$ ".$row['CostPerDay']."</td>";
    echo "<td>$ ".$row['CostBedPerDay']."</td>";
    $check = "";
    if ($extra_bed['room'.$i] == "on") {
        $check = "checked=\"checked\"";
    }
    echo "<td><input type=\"checkbox\" name=\"room".$i."\" ".$check." /></td>";
    echo "</tr>";
}
?>

</table><br>
<input type="submit" name="update" value="Update" />
<input type="submit" name="clear" value="Clear" />
</form>

Total Cost: 
<?php
$total_duration = (strtotime($end) - strtotime($start))/86400;
$total_duration = round($total_duration); 
$total_cost = $cost + $extra;
$total_cost *= $total_duration;
$_SESSION['total_cost'] = $total_cost;
echo "$ ".$total_cost.".00";
?>
<br>
<a href="add_card.php"><p>Add card</p></a>
<form action="" method="POST">

Select Card:
<?php
    if (mysql_num_rows($result) != 0) {
        echo "<select name=\"card\">";
        $i = 0;
        while ($row = mysql_fetch_array($result)) {
            echo "<option value=\"".$row['card_id']."\">".substr($row['card_id'], -4)."</option>";
        }
        echo "</select>";
    }
?>

<input type="submit" name="submit" value="Submit" />
<input type="submit" name="go_back" value="Go Back" />
</form>
<?php
echo $err;
?>

</center>
</body>
</html>
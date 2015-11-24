<?php
session_start();
include 'dbinfo.php';
$usn = $_SESSION['usn'];

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: index.php');
    exit();
}

if (isset($_POST['select_room'])) {
    redirect('room_book.php');
}

if (isset($_POST['go_back'])) {
    redirect('search_room.php');
}

mysql_connect($host,$db_username,$db_password) or die( "Unable to connect");;
mysql_select_db($database) or die( "Unable to select database");
?>

<html>
<head>
        <title>Available Rooms</title>
</head>

Hi <?php echo $usn ?>
<form action="" method="POST" />
<input type="submit" name="logout" value="Logout" />
</form>

<?php
$start = $_SESSION['start'];
$end = $_SESSION['end'];
$location = $_SESSION['location'];

$sql_query = "SELECT    *
                FROM    ROOM AS RM
                WHERE   Location = '".$location."' AND NOT EXISTS (
                            SELECT  RM.*
                            FROM    ROOM AS RM NATURAL JOIN HAS_ROOM 
                                        NATURAL JOIN RESERVATION AS R
                            WHERE   (Cancelled = 0) AND ('".$start."' BETWEEN R.StartDate AND R.EndDate
                                    OR '".$end."' BETWEEN R.StartDate AND R.EndDate))";
$result = mysql_query($sql_query) or die(mysql_error());

if (mysql_num_rows($result) == 0) {
    echo "No rooms available";
    echo "<form action=\"\" method=\"POST\" />
            <input type=\"submit\" name=\"go_back\" value=\"Go Back\" /></form>";
} else {
    echo "<form action=\"\" method=\"POST\" />";
    echo "<table border=\"1\"><tr>
        <td>Room Number</td>
        <td>Room Category</td>
        <td>#People allowed</td>
        <td>Cost/Day</td>
        <td>Cost of Extra Bed/Day</td>
        <td>Select Room</td></tr>";
    while ($row = mysql_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$row['RoomID']."</td>";
        echo "<td>".$row['Category']."</td>";
        echo "<td>".$row['NumPeople']."</td>";
        echo "<td>".$row['CostPerDay']."</td>";
        echo "<td>".$row['CostBedPerDay']."</td>";
        echo "<td><input type=\"checkbox\" name=\"".$row['RoomID']."\" /></td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<input type=\"submit\" name=\"select_room\" value=\"Next\" /></form>";
}
?>
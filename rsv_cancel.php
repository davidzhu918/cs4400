<?php
session_start();
include 'dbinfo.php';
$usn = $_SESSION['usn'];

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: index.php');
    exit();
}

if (isset($_POST['go_back'])) {
    redirect('functionality_customer.php');
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    mysql_connect($host,$db_username,$db_password) or die( "Unable to connect");;
    mysql_select_db($database) or die( "Unable to select database");

    $sql_query = "SELECT    *
                    FROM    ROOM AS RM
                            NATURAL JOIN RESERVATION AS R
                            NATURAL JOIN HAS_ROOM
                    WHERE   Username = '".$usn."' AND ReservationID = ".$id." AND Cancelled
                            = 0 AND StartDate >= ".$today;
    $result = mysql_query($sql_query);

    if (mysql_num_rows($result) > 0) {
        $row = mysql_fetch_array($result);
        $_SESSION['start'] = $row['StartDate'];
        $_SESSION['end'] = $row['EndDate'];
        $_SESSION['total'] = $row['TotalCost'];
        $_SESSION['id'] = $id;

        $room_arr[0] = $row;
        $i = 1;
        while ($row = mysql_fetch_array($result)) {
            $room_arr[$i] = $row;
            $i++;
        }
        $_SESSION['room_arr'] = $room_arr;
        redirect('rsv_cancel_confirm.php');
    }

    $err = "Invalid reservation ID";
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
<b><p>Update Reservation</p></b>
Reservation ID:
<form action="" method="POST">
<input name="id" />
<input type="submit" name="submit" value="Submit" />
<input type="submit" name="go_back" value="Go Back" />
</form>

<?php
echo $err;
?>

</center>
</body>
</html>
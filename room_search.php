<?php
session_start();
include 'dbinfo.php';
$usn = $_SESSION['usn'];

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: index.php');
    exit();
}

mysql_connect($host,$db_username,$db_password) or die( "Unable to connect");
mysql_select_db($database) or die( "Unable to select database");

if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $location = $_POST['location'];

    if (strcmp($start_date, '2015-08-01') < 0) {
        $err = 'Start date must be on or after 1st August 2015';
    } else if (strcmp($end_date, '2016-01-31') > 0) {
        $err = 'End date must be on or before 31st January 2016';
    } else if (strcmp($start_date, $end_date) >= 0) {
        $err = 'End date should be after start date';
    } else {
        $_SESSION['start'] = $start_date;
        $_SESSION['end'] = $end_date;
        $_SESSION['location'] = $location;
        redirect('rooms_available.php');
    }
    echo "$err";
}
?>
<html>
<head>
        <title>Find Rooms</title>
</head>

Hi <?php echo $usn ?>
<form action="" method="POST">
<input type="submit" name="logout" value="Logout"/>
</form>

<body>
<center>
<br><br><br>
<b><p>Find Rooms</p></b>

<form action="" method="post">
Location:
<select name="location">
    <option value="Atlanta">Atlanta</option>
    <option value="Charlotte">Charlotte</option>
    <option value="Savannah">Savannah</option>
    <option value="Orlando">Orlando</option>
    <option value="Miami">Miami</option>
</select>
<br>

Start Date:
<input name="start_date" />
End Date:
<input name="end_date" />

<input type="submit" />
</form>
</center>
</body>
</html>
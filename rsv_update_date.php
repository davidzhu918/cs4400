<?php
session_start();
include 'dbinfo.php';
$usn = $_SESSION['usn'];
$rsv = $_SESSION['rsv'];

$cur_start = $rsv['StartDate'];
$cur_end = $rsv['EndDate'];
$location = $rsv['Location'];

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: index.php');
    exit();
}

if (isset($_POST['go_back'])) {
    unset($_SESSION['rsv']);
    redirect('rsv_update.php');
}

if (isset($_POST['start']) && isset($_POST['end'])) {
    $start_date = $_POST['start'];
    $end_date = $_POST['end'];

    if (strcmp($start_date, '2015-08-01') < 0) {
        $err = 'Start date must be on or after 1st August 2015';
    } else if (strcmp($end_date, '2016-01-31') > 0) {
        $err = 'End date must be on or before 31st January 2016';
    } else if (strcmp($start_date, $end_date) >= 0) {
        $err = 'End date should be after start date';
    } else {
        $_SESSION['start'] = $start_date;
        $_SESSION['end'] = $end_date;
        redirect('rsv_update_book.php');
    }
}
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
<b><p>Select New Dates</p></b>
Current Start Date: <?php echo $cur_start; ?>
&nbsp;&nbsp;
Current End Date: <?php echo $cur_end; ?>
<form action="" method="POST">
New Start Date:
<input name="start" />
New End Date:
<input name="end" />
<input type="submit" name="search" value="Search Availability" />
<input type="submit" name="go_back" value="Go Back" />
</form>

<?php
echo $err;
?>

</center>
</body>
</html>
<?php
session_start();
include 'dbinfo.php';
$usn = $_SESSION['usn'];
$err = '';
if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $location = $_POST['location'];

    if (strcmp($start_date, '2015-08-01') < 0) {
        $err = 'Start date must be on or after 1st August 2015';
    } else if (strcmp($start_date, $today) < 0) {
        $err = 'Start date must be today or a future date';
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
}

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: index.php');
    exit();
}

if (isset($_POST['go_back'])) {
    redirect('functionality_customer.php');
}
?>

<html>
<head>
        <title>Find Rooms</title>
</head>

Hi <?php echo $usn; ?>
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
<input type="date" name="start_date" />
End Date:
<input type="date" name="end_date" />

<input type="submit" />

<input type="submit" name="go_back" value="Go Back">
<br>


<?php
echo "$err";
?>
</form>
</center>
</body>
</html>
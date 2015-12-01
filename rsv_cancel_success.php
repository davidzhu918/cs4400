<?php
session_start();
include 'dbinfo.php';
$usn = $_SESSION['usn'];
$id = $_SESSION['id'];

$new_total = $_SESSION['new_total'];

mysql_connect($host,$db_username,$db_password) or die( "Unable to connect");
mysql_select_db($database) or die( "Unable to select database");

$sql_query = "UPDATE    RESERVATION
                SET     TotalCost = ".$new_total.", Cancelled = 1
                WHERE   ReservationID = ".$id;
$result = mysql_query($sql_query) or die(mysql_error());

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
?>

<html>
<head>
        <title>Cancellation Success</title>
</head>

Hi <?php echo $usn; ?>
<form action="" method="POST" />
<input type="submit" name="logout" value="Logout" />
</form>

<body>
<center>
<br><br><br>
<b><p>You have successfully cancelled your reservation!</p></b>
<form action="" method="POST">
<input type="submit" name="go_back" value="Main Page" />
</form>

</center>
</body>
</html>
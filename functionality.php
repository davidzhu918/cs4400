<?php
        session_start();
        include 'dbinfo.php';
        $usn = $_SESSION['username'];
        $identity = $_SESSION['identity'];
?>

<html>
<head>
        <title>Hi</title>
</head>
<body>
<center>
<br><br><br>
<b><p>Choose functionality</p></b>
<b><p>Hi <?php echo $usn ?></p></b>
<?php
mysql_connect($host,$username,$password) or die( "Unable to connect");;
mysql_select_db($database) or die( "Unable to select database");

if ($identity == "customer") {
                
        echo "<a href=\"make_rsv.php\"> <p>Make a new reservation</p></a>";

        echo "<a href=\"update_rsv.php\"> <p>Update your reservation</p></a>";

        echo "<a href=\"cancel_rsv.php\"> <p>Cancel Reservation</p></a>";

        echo "<a href=\"giva_feedback.php\"> <p>Provide feedback</p></a>";

        echo "<a href=\"view_feedback.php\"> <p>View feedbck</p></a>";
        
}

?>
</center>
</body>
</html>
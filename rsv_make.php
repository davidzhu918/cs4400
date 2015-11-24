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
<b><p>Make a reservation</p></b>
<b><p>Hi <?php echo $usn ?></p></b>
<?php
mysql_connect($host,$username,$password) or die( "Unable to connect");;
mysql_select_db($database) or die( "Unable to select database");


?>
</center>
</body>
</html>
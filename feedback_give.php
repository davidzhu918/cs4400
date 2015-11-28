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

mysql_connect($host,$db_username,$db_password) or die( "Unable to connect");
mysql_select_db($database) or die( "Unable to select database");

if (isset($_POST['submit'])) {
        $rating = $_POST['rating'];
        $location = $_POST['location'];
        $comment = $_POST['comment'];
        $sql_query = "SELECT    COUNT(*) + 1 AS id
                        FROM    HOTEL_REVIEW";
        $result = mysql_query($sql_query) or die(mysql_error());

        $id = mysql_fetch_array($result);
        $id = $id['id'];

        $sql_query = "INSERT INTO       HOTEL_REVIEW
                        VALUES (".$id.", '".$location."', ".$rating.", '".$comment."', '".$usn."')";
        $result = mysql_query($sql_query) or die(mysql_error());
        $success = "Thank you for your feedback!";
}
?>

<html>
<head>
        <title>Give Feedback</title>
</head>

Hi <?php echo $usn; ?>
<form action="" method="POST" />
<input type="submit" name="logout" value="Logout" />
</form>

<body>
<center>
<br><br><br>
<b><p>Give Feedback</p></b>
<form action="" method="post">
Hotel Location:
<select name="location">
    <option value="Atlanta">Atlanta</option>
    <option value="Charlotte">Charlotte</option>
    <option value="Savannah">Savannah</option>
    <option value="Orlando">Orlando</option>
    <option value="Miami">Miami</option>
</select>
<br>
Rating:
<select name="rating">
    <option value="5">Excellent</option>
    <option value="4">Good</option>
    <option value="2">Bad</option>
    <option value="1">Very Bad</option>
    <option value="3">Neutral</option>
</select>
<br>
Comment:
<input name="comment" />
<br>
<input type="submit" name="submit" value="Submit"/>

<input type="submit" name="go_back" value="Go Back">
</form>

<?php
echo $success;
?>

</center>
</body>
</html>
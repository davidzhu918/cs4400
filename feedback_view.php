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

mysql_connect($host,$db_username,$db_password) or die( "Unable to connect");;
mysql_select_db($database) or die( "Unable to select database");

?>

<html>
<head>
        <title>View Feedback</title>
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
<input type="submit" name="submit" value="Check Reviews"/>

<input type="submit" name="go_back" value="Go Back">
</form>

<?php
if (isset($_POST['submit'])) {
    $location = $_POST['location'];

    $sql_query = "SELECT    Rating, CustComment
                    FROM    HOTEL_REVIEW
                    WHERE   Location == '".$location."'";
    $result = mysql_query ($sql_query)  or die(mysql_error());

    echo "<table border=\"1\"><tr>
        <td>Rating</td>
        <td>Comment</td></tr>";
    while ($row = mysql_fetch_array($result)) {
        echo "<tr>";
        $rating = $row['Rating'];
        switch ($rating) {
            case 1:
                $rating = "Very Bad";
                break;
            case 2:
                $rating = "Bad";
                break;
            case 3:
                $rating = "Neutral";
                break;
            case 4:
                $rating = "Good";
                break;
            case 5:
                $rating = "Excellent";
                break;
        }
        echo "<td>".$rating."</td>";
        echo "<td>".$row['CustComment']."</td>";
        echo "</tr>";
    }
    echo "</table><br>";
}
?>

</center>
</body>
</html>
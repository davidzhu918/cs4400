<?php
session_start();
include 'dbinfo.php';
$usn = $_SESSION['usn'];


mysql_connect($host,$db_username,$db_password) or die( "Unable to connect");
mysql_select_db($database) or die( "Unable to select database");
$sql_query = "SELECT            CardID AS card_id
                FROM            PAYMENT_INFO 
                WHERE BINARY    Username = '".$usn."' AND
                                ExpDate > ".$today; 

$result = mysql_query($sql_query)  or die(mysql_error());

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: index.php');
    exit();
}
?>



<html>
<head>
	<title>Payment Info</title>
</head>

Hi <?php echo $usn; ?>
<form action="" method="POST" />
<input type="submit" name="logout" value="Logout" />
</form>

<body>
<center>
<br><b>Payment Information</p></b>
<table>
	<tr>
		<td>
			<p><b>Add Card</b></p>
			<form action="" method="POST" />
			<p>Name On Card:
			<input name="nameOnCard" />
			</p>
			<p>Card Number:
			<input name="cardNumber" />
			</p>
			<p>Expiration Date:
			<input name="expDate" />
			</p>
			<p>CVV:
			<input name="cvv" value="CVV" />
			</p>
			<input type="submit" name="saveCard" value="Save" />
			</form>
		</td>
	</tr>
	<tr>
		<td>
			<p><b>Delete Card</b></p>
			<form action="" method="POST" />
				<p>Card Number:
					<?php
    					if (mysql_num_rows($result) != 0) {
        					echo "<select name=\"card\">";
        					$i = 0;
        					while ($row = mysql_fetch_array($result)) {
            					echo "<option value=\"".$row['card_id']."\">".substr($row['card_id'], -4)."</option>";
        					}
        					echo "</select>";
    					}
					?>
				</p>
				<input type="submit" name="submit" value="Submit" />
			</form>
		</td>
	</tr>
</table>
</center>
</body>
</html>
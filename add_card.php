<?php
session_start();
include 'dbinfo.php';
$usn = $_SESSION['usn'];



mysql_connect($host,$db_username,$db_password) or die( "Unable to connect");
mysql_select_db($database) or die( "Unable to select database");

$sql_query = "SELECT            CardID AS card_id
                FROM            PAYMENT_INFO 
                WHERE BINARY    Username == '".$usn."' AND
                                ExpDate > ".$today; 

$result = mysql_query($sql_query)  or die(mysql_error());
	
if (isset($_POST['logout'])) {
    session_unset();
    header('Location: index.php');
    exit();
}

if (isset($_POST['nameOnCard']) && isset($_POST['cardNumber']) 
	&& isset($_POST['expDate']) && isset($_POST['cvv'])) {
	$name_on_card = $_POST['nameOnCard'];
	$card_number = $_POST['cardNumber'];
	$exp_date = $_POST['expDate'] . '-01';
	$cvv = $_POST['cvv'];
	$err = '';


	if (preg_match('/[^A-Za-z]/', $name_on_card)) {
		$err = 'Name should only contain english letters';
	} else if (preg_match('/[^0-9]/', $card_number)) {
		$err = 'Card Number should be numerical';
	} else if (strlen($card_number) != 16) {
		$err = 'Card number should be a 16 digits serial number';
	} else if ($exp_date < $today) {
		$err = 'Card already expired';
	} else if (preg_match('/[^0-9]/', $cvv)) {
		$err = 'cvv should be numerical';
	} else {
		$sql_query = "INSERT INTO PAYMENT_INFO
				VALUES 	('".$card_number."', '".$cvv."', '".$exp_date."', '".$name_on_card."', '".$usn."')";
		$result = mysql_query($sql_query) or die(mysql_error());
		redirect('add_card.php');
	}
	
	

}

if (isset($_POST['delete'])) {
	if (isset($_POST['card'])) {
        $card_id = $_POST['card'];
        $sql_query = "DELETE FROM PAYMENT_INFO
        				WHERE 	CardID == '".$card_id."' AND Username == '".$usn."'";
        $result = mysql_query($sql_query) or die(mysql_error());
        redirect('add_card.php');
    }
}

if (isset($_POST['done'])) {
	redirect('room_book.php');
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
			<input type="text" name="nameOnCard" maxlength="30" />
			</p>
			<p>Card Number:
			<input type="text" name="cardNumber" />
			</p>
			<p>Expiration:
			<input type="month" name="expDate"/>
			</p>
			<p>CVV:
			<input type="text" name="cvv" maxlength="3" />
			</p>
			<input type="submit" name="save_card" value="Save" />
			</form>
		</td>
	</tr>
	<?php
		echo "$err";
	?>
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
				<input type="submit" name="delete" value="Delete" />
			</form>
		</td>
	</tr>
</table>
<p>
	<input type="submit" name="done" value="Finish" />
</p>
</center>
</body>
</html>
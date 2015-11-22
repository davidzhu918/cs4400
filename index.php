<?php
include 'dbinfo.php';
?> 



<html>
<head>
	<title>Login</title>
</head>
<body>
<center>
<br><br><br>
<b><p>Fancy Hotel Login Page</p></b>
<?php
session_start(); 

if(isset($_POST['username']) && isset($_POST['password']))  { 
$usn = $_POST['username']; //ssn of the text field for employee ssn 
$pwd = $_POST['password'];
// store session data
$_SESSION['user']=$usn;
$_SESSION['pwd'] = $pwd;
//connect to the db 
mysql_connect($host,$username,$password) or die( "Unable to connecthaha");;
mysql_select_db($database) or die( "Unable to select database");
//Our SQL Query
$sql_query = "Select Username From CUSTOMER 
           Where Username = $usn AND Password = $pwd";  
//Run our sql query
 $result = mysql_query ($sql_query)  or die(mysql_error());  

//this is where the actual verification happens 
if(mysql_num_rows($result) == 1){ 

	// header('Location: customer.php');
	echo "<p>Login successfully as Customer";
	echo "</p>";
       
}else{ 
    $sql_query = "Select Username From MANAGEMENT 
    	Where Username = $usn AND Password = $pwd";

    $result = mysql_query($sql_query) or die(mysql_error());
    if (mysql_num_rows($result) == 1) {
    	// header('Location: manager.php');
    	echo "<p>Login successfully as Manager";
		echo "</p>";
    } else {
    	$err = 'Incorrect Username/Password'; 
    }
}
    //then just above your login form or where ever you want the error to be displayed you just put in 
echo "$err";
} 

echo "<html>"; 
echo "<head>"; 
echo "</head>"; 
echo "<body>"; 
echo "<form action=\"\" method=\"POST\">"; 
echo "<p>Username:";  
echo "<input name=\"username\" maxlength=\"15\"/>"; 
echo "</p>"; 
echo "<p>Password:";
echo "<input name=\"password\" maxlength=\"15\"/>";
echo "</p>";
echo "<input type=\"submit\" name=\"login\" value=\"Login\" />";
echo "</form>"; 
echo "</body>"; 
echo "</html>"; 
?>
</center>
</body>
</html>
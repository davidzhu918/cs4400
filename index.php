<?php
session_start();
include 'dbinfo.php';

if (isset($_POST['login'])) {
if (isset($_POST['username']) && isset($_POST['password']))  { 
    $usn = $_POST['username']; //ssn of the text field for employee ssn 
    $pwd = $_POST['password'];
    
    //connect to the db 
    mysql_connect($host,$db_username,$db_password) or die( "Unable to connect");;
    mysql_select_db($database) or die( "Unable to select database");
    //Our SQL Query
    $sql_query = "SELECT Username FROM CUSTOMER 
                WHERE BINARY (Username = '".$usn."' AND Password = '".$pwd."')";  
    //Run our sql query
    $result = mysql_query ($sql_query)  or die(mysql_error());  

    //this is where the actual verification happens 
    if(mysql_num_rows($result) == 1){ 

        // store session data
        $_SESSION['usn']= $usn;
        $_SESSION['identity'] = "customer";

        redirect('functionality_customer.php');
        exit();
    }
    $sql_query = "SELECT Username FROM MANAGEMENT 
            WHERE BINARY (Username = '".$usn."' AND Password = '".$pwd."')";  

    $result = mysql_query($sql_query) or die(mysql_error());
    if (mysql_num_rows($result) == 1) {
        // store session data
        $_SESSION['usn']= $usn;
        $_SESSION['identity'] = "manager";

        redirect('functionality_manager.php');
        exit();
    }

    //then just above your login form or where ever you want the error to be displayed you just put in 
    echo "Incorrect Username/Password";
}

if (isset($_SESSION['usn'])) {
    redirect("functionality_".$_SESSION['identity'].".php");
}    
}
if (isset($_POST['signup'])) { 
    redirect('user_registration.php');
}
?>



<html>
<head>
	<title>Login</title>
</head>
<body>
<center>
<br><br><br>
<b><p>Fancy Hotel Login</p></b>

<html>
<head>
</head>
<body>
<form action="" method="POST">
<p>Username:
<input name="username" maxlength="15"/>
</p>
<p>Password:
<input name="password" maxlength="15"/>
</p>
<input type="submit" name="login" value="Login" />
<input type="submit" name="signup" value="Sign Up" />
</form>
</body>
</html>
</center>
</body>
</html>
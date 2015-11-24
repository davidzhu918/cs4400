<?php
session_start();
include 'dbinfo.php';

if (isset($_SESSION['usn']) && isset($_SESSION['pwd'])) {
    redirect("functionality_".$_SESSION['identity'].".php");
}

if(isset($_POST['username']) && isset($_POST['password']))  { 
    $usn = $_POST['username']; //ssn of the text field for employee ssn 
    $pwd = $_POST['password'];
        // $usn = 'User01';
        // $pwd = 'User01';
    //connect to the db 
    mysql_connect($host,$db_username,$db_password) or die( "Unable to connecthaha");;
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
        $_SESSION['pwd'] = $pwd;
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
        $_SESSION['pwd'] = $pwd;
        $_SESSION['identity'] = "manager";

        redirect('functionality_manager.php');
        exit();
    } else {
        $err = 'Incorrect Username/Password'; 
    }
    //then just above your login form or where ever you want the error to be displayed you just put in 
    echo "$err";
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
</form>
</body>
</html>
</center>
</body>
</html>
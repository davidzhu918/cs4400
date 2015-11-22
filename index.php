<?php
include 'dbinfo.php';
$link = mysql_connect($host, $username, $password);
if (!$link) {
die('Could not connect: ' . mysql_error());
}
mysql_select_db(‘cs4400_Group_18’);
echo 'Connected successfullyhaha';
mysql_close($link);
?> 

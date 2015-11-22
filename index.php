<?php
$link = mysql_connect('academic-mysql.cc.gatech.edu', 'cs4400_Group_18', '2WXUh8Hn');
if (!$link) {
die('Could not connect: ' . mysql_error());
}
mysql_select_db(‘cs4400_Group_18’);
echo 'Connected successfully';
mysql_close($link);
?> 

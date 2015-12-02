<?php

$db_username = 'cs4400_Group_18';
$db_password = '2WXUh8Hn';
$host = 'academic-mysql.cc.gatech.edu';   
$database = 'cs4400_Group_18';
//$today = date("Y-m-d");
$today = '2015-10-01';

function redirect($url)
{
    if (strlen(session_id()) > 0) // if using sessions
        {
            session_regenerate_id(true); // avoids session fixation attacks
            session_write_close(); // avoids having sessions lock other requests
        }

    header('Location: ' . $url);

    exit();
}
// error_reporting(E_ALL);
// ini_set('display_errors','On');
?>
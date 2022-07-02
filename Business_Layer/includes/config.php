<?php

date_default_timezone_set('Asia/Karachi');

session_start();
error_reporting(0);
$hostname='localhost'; // MySQL host
$username='root'; // MySQL username
$password=''; // MySQL password
$database='dp'; // MySQL database
$conId=mysql_connect($hostname,$username,$password);
mysql_select_db($database,$conId);
mysql_query("SET NAMES 'utf8'");

//define('OWNER_EMAIL','babukhan@hotmail.com');
//define('SITE_TITLE','US AID');
//define('FOLDER','');
//define('TEMP','temp/');
//define('IMAGES','images/');
//define('USER_IMAGES','http://projects.crazenatorstechnologies.com/cvsp/uploads/user_images/');

?>

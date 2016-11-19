<?php
// File koneksi
$db = "";
$db['host'] 	= "HOST_DISINI";
$db['user'] 	= "USER_DISINI";
$db['pass'] 	= "PASS_DISINI";
$db['name'] 	= "DB_DISINI";
$db['previx'] 	= "sy_";
mysql_connect($db['host'],$db['user'],$db['pass']);
mysql_select_db($db['name']);

?>
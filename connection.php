<?php
	$dbhost = "localhost"; 
	$dbuser = "root"; 
	$dbpass = ""; 
	$db = "coffeeshop"; 
	
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	mysql_select_db($db);
?>
<?php


$dbhost = "localhost"; // this will ususally be 'localhost', but can sometimes differ
$dbname = "zs"; // the name of the database that you are going to use for this project
//$dbuser = ""; // the username that you created, or were given, to access your database
//$dbpass = ""; // the password that you created, or were given, to access your database

mysql_connect($dbhost, "root","anish") or die("MySQL Error: " . mysql_error());
mysql_select_db($dbname) or die("MySQL Error: " . mysql_error());

?>
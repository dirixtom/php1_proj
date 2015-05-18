<?php
########## MySql details (Replace with yours) #############
$username = "root"; //mysql username
$password = "root"; //mysql password
$hostname = "localhost"; //hostname
$databasename = 'phpproject'; //databasename

//connect to database
$mysqli = new mysqli($hostname, $username, $password, $databasename);
?>
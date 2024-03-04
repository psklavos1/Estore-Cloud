<?php
$dbhost = 'mysql-db';
$dbuser = 'root';
$dbpass = 'secret';
$dbname = 'estore';

// Establish connection To Mysql Server 
if (!($con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))) {
    die('Failed To Connect to DB!');
}
?>

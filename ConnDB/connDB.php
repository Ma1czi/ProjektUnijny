<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'projekt';

$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

//check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }
?>


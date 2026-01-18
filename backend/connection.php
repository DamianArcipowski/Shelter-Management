<?php

$dbhost = 'localhost';
$dbuser = 'admin';
$dbpassword = 'zaq1@WSX';
$dbname = 'shelter';

$conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
$conn->set_charset('utf8mb4');

if ($conn->connect_error) {
    die('Connection failed ' . $conn->connect_error);
}

?>
<?php

$dbhost = getenv('DB_HOST');
$dbuser = getenv('DB_USER');
$dbpassword = getenv('DB_PASSWORD');
$dbname = getenv('DB_DATABASE');

$conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
$conn->set_charset('utf8mb4');

if ($conn->connect_error) {
    die('Connection failed ' . $conn->connect_error);
}

?>
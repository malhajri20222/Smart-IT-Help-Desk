<?php

$host = "localhost";
$user = "root";
$password = "root";
$dbname = "it=helpdesk";

$conn = new mysqli("localhost","root","root","it-helpdesk");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<?php
include 'database/database.php';

$id = $_GET['id'];

$sql = "DELETE FROM tickets WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: admin.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
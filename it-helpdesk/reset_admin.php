<?php
include 'database/database.php';

$newPassword = password_hash("admin123", PASSWORD_DEFAULT);

$sql = "UPDATE users
        SET password='$newPassword'
        WHERE username='admin'";

if ($conn->query($sql)) {

    echo "<h2>Password reset successfully.</h2>";
    echo "<p>Username: <strong>admin</strong></p>";
    echo "<p>Password: <strong>admin123</strong></p>";

} else {

    echo "Error: " . $conn->error;

}
?>
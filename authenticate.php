<?php
session_start();

include 'database/database.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username'";

$result = $conn->query($sql);

if ($result->num_rows == 1) {

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];

        if (strtolower($user['role']) == "admin") {
            header("Location: admin.php");
        } else {
            header("Location: dashboard.php");
        }

        exit();

    } else {

        echo "Wrong Password";

    }

} else {

    echo "Username Not Found";

}

$conn->close();
?>
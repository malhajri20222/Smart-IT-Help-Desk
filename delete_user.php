<?php
session_start();
include 'database/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {

    $id = (int)$_GET['id'];

    // منع حذف المستخدم الحالي (الأدمن الذي سجل الدخول)
    if ($id != $_SESSION['user_id']) {

        $sql = "DELETE FROM users WHERE id=$id";

        if ($conn->query($sql)) {
            header("Location: users.php?deleted=1");
            exit();
        } else {
            die("Delete Error: " . $conn->error);
        }

    } else {
        die("You cannot delete your own account.");
    }

}

header("Location: users.php");
exit();
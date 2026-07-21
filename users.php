<?php
session_start();
include 'database/database.php';

if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role']) != "admin") {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<title>Manage Users</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

<div class="header">

<h1>Manage Users</h1>

<p class="subtitle">
Create and manage employee accounts
</p>

</div>

<div class="dashboard-buttons">

<a href="create_employee.php" class="btn">
Create Employee
</a>

<a href="admin.php" class="btn">
Back
</a>

</div>

<table>

<thead>

<tr>

<th>ID</th>
<th>Full Name</th>
<th>Username</th>
<th>Role</th>

</tr>

</thead>

<tbody>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo htmlspecialchars($row['full_name']); ?></td>

<td><?php echo htmlspecialchars($row['username']); ?></td>

<td><?php echo ucfirst($row['role']); ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>
</html>
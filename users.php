<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'database/database.php';

$result = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Users</title>

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<div class="container">

<div class="header">

<img src="images/logo.png" class="logo">

<h1>Manage Users</h1>

<p class="subtitle">
Create and manage employee accounts
</p>

</div>

<div class="dashboard-buttons">

<a href="create_employee.php" class="btn">
<i class="bi bi-person-plus-fill"></i>
Create Employee
</a>

<a href="admin.php" class="btn">
<i class="bi bi-arrow-left-circle"></i>
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
<th>Action</th>

</tr>

</thead>

<tbody>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo htmlspecialchars($row['full_name']); ?></td>

<td><?php echo htmlspecialchars($row['username']); ?></td>

<td>

<?php
if($row['role']=="admin"){
echo "<span class='badge badge-progress'>Admin</span>";
}else{
echo "<span class='badge badge-open'>Support</span>";
}
?>

</td>

<td>

<div class="action-buttons">

<a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn" style="background:#0d6efd;">
<i class="bi bi-pencil-square"></i>
</a>

<a href="delete_user.php?id=<?php echo $row['id']; ?>"
class="btn logout-btn"
onclick="return confirm('Delete this user?');">

<i class="bi bi-trash"></i>

</a>

</div>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>
</html>
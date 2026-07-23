<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'database/database.php';

$id = (int)$_GET['id'];

$user = $conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();

$message="";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $full_name=$conn->real_escape_string($_POST['full_name']);
    $username=$conn->real_escape_string($_POST['username']);
    $role=$conn->real_escape_string($_POST['role']);

    $conn->query("UPDATE users
                  SET full_name='$full_name',
                      username='$username',
                      role='$role'
                  WHERE id=$id");

    $message="<div class='success'>
    User updated successfully.
    </div>";

    $user = $conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Edit User</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

<div class="header">

<h1>Edit User</h1>

</div>

<?php echo $message; ?>

<form method="POST">

<label>Full Name</label>

<input
type="text"
name="full_name"
value="<?php echo htmlspecialchars($user['full_name']); ?>"
required>

<label>Username</label>

<input
type="text"
name="username"
value="<?php echo htmlspecialchars($user['username']); ?>"
required>

<label>Role</label>

<select name="role">

<option value="admin"
<?php if($user['role']=="admin") echo "selected"; ?>>
Admin
</option>

<option value="support"
<?php if($user['role']=="support") echo "selected"; ?>>
Support
</option>

</select>

<br><br>

<button class="btn">

Save Changes

</button>

<a href="users.php" class="btn logout-btn">

Back

</a>

</form>

</div>

</body>

</html>
<?php
include 'database/database.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = $conn->real_escape_string($_POST['full_name']);
    $username  = $conn->real_escape_string($_POST['username']);
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // التحقق من تكرار اسم المستخدم
    $check = $conn->query("SELECT id FROM users WHERE username='$username'");

    if ($check->num_rows > 0) {

        $message = "<div class='error'>
        Username already exists.
        </div>";

    } else {

        $sql = "INSERT INTO users (full_name, username, password, role)
                VALUES ('$full_name', '$username', '$password', 'support')";

        if ($conn->query($sql)) {

            $message = "<div class='success'>
            Employee account created successfully.
            </div>";

        } else {

            $message = "<div class='error'>
            ".$conn->error."
            </div>";

        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Create Employee</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

<div class="header">

<img src="images/logo.png" class="logo" alt="Logo">

<h1>Create Employee</h1>

<p class="subtitle">
Create a new employee account
</p>

</div>

<?php echo $message; ?>

<form method="POST">

<label>Full Name</label>
<input
type="text"
name="full_name"
placeholder="Enter full name"
required>

<label>Username</label>
<input
type="text"
name="username"
placeholder="Enter username"
required>

<label>Password</label>
<input
type="password"
name="password"
placeholder="Enter password"
required>

<br><br>

<button class="btn" type="submit">
Create Employee
</button>

<a href="admin.php" class="btn logout-btn">
Back
</a>

</form>

</div>

</body>
</html>
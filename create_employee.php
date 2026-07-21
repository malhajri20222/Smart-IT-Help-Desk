<?php
include 'database/database.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = $_POST['full_name'];
    $username  = $_POST['username'];
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (full_name, username, password, role)
            VALUES ('$full_name', '$username', '$password', 'employee')";

    if ($conn->query($sql)) {

        $message = "<div class='success'>
        Employee account created successfully.
        </div>";

    } else {

        $message = "<div class='error'>
        " . $conn->error . "
        </div>";

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Create Employee</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

<h1>Create Employee</h1>

<?php echo $message; ?>

<form method="POST">

<label>Full Name</label>
<input type="text" name="full_name" required>

<label>Username</label>
<input type="text" name="username" required>

<label>Password</label>
<input type="password" name="password" required>

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
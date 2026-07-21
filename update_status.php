<?php
include 'database/database.php';

$id = $_GET['id'];

$sql = "SELECT * FROM tickets WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $status = $_POST['status'];

    $sql = "UPDATE tickets
            SET status='$status'
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {

    echo "<h2 style='color:green; text-align:center;'>
     ✅ Ticket status updated successfully.<br>
    You will be redirected to the Admin Dashboard in 5 seconds...
    </h2>";

    echo "<script>
        setTimeout(function(){
            window.location.href='admin.php';
        }, 5000);
    </script>";

    exit();

} else {

    echo "Error: " . $conn->error;

}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Ticket Status</title>
</head>
<body>

<h2>Update Ticket Status</h2>

<form method="POST">

<label>Status</label>

<select name="status">

    <option value="Open" <?php if($row['status']=="Open") echo "selected"; ?>>Open</option>

    <option value="In Progress" <?php if($row['status']=="In Progress") echo "selected"; ?>>In Progress</option>

    <option value="Closed" <?php if($row['status']=="Closed") echo "selected"; ?>>Closed</option>

</select>
<br><br>

<button type="submit">Save</button>

</form>

</body>
</html>

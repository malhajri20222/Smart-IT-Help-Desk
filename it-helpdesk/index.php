<?php
include 'database/database.php';

$success = isset($_GET['success']);
$ticket_id = $_GET['id'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart IT Help Desk</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container">

    <div class="header" style="text-align:center; margin-bottom:35px;">

        <img src="images/logo.png"
             alt="Logo"
             style="width:120px; height:auto; display:block; margin:0 auto 20px;">

        <h1 style="color:#4F6EF7; margin-bottom:10px;">
            Smart IT Help Desk
        </h1>

        <p style="color:#777; font-size:17px;">
            Efficient IT Support & Ticket Management System
        </p>

    </div>

    <?php if ($success && $ticket_id != ''): ?>

        <div class="alert alert-success" style="margin-bottom:40px;">

            <strong>✅ Your support ticket has been submitted successfully.</strong>

            <br><br>

            <strong>Ticket No:</strong>

            <span style="color:#0d6efd;font-size:22px;font-weight:bold;">
                <?php echo "IT-" . str_pad($ticket_id, 6, "0", STR_PAD_LEFT); ?>
            </span>

            <br><br>

            <small>Please save this ticket number for future reference.</small>

        </div>

        <script>
            setTimeout(function () {
                window.location.href = "index.php";
            }, 6000);
        </script>

    <?php endif; ?>

    <form action="add.php" method="POST">

        <label>Employee ID</label>
        <input type="text" name="employee_id" required>

        <label>Department</label>

        <select name="department" required>
            <option value="">-- Choose Department --</option>

            <?php
            $sql = "SELECT * FROM departments";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<option value='".$row['department_name']."'>".$row['department_name']."</option>";
            }
            ?>
        </select>

        <label>Issue Type</label>

        <select name="issue_type" required>
            <option value="">-- Choose Issue Type --</option>

            <?php
            $sql = "SELECT * FROM issue_types";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<option value='".$row['issue_name']."'>".$row['issue_name']."</option>";
            }
            ?>
        </select>

        <label>Priority</label>

        <select name="priority" required>
            <option value="">Choose Priority</option>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
            <option value="Critical">Critical</option>
        </select>

        <label>Issue Description</label>

        <textarea name="description" rows="5" required></textarea>

        <button type="submit">Submit Ticket</button>

    </form>

</div>

<div class="footer">
    Developed by <strong>Monerah Khalid</strong> © 2026
</div>

</body>
</html>
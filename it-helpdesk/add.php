<?php
include 'database/database.php';

$success = isset($_GET['success']);
$ticket_id = $_GET['id'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $employee_id = $_POST['employee_id'];
    $department  = $_POST['department'];
    $issue_type  = $_POST['issue_type'];
    $priority    = $_POST['priority'];
    $description = $_POST['description'];

    $sql = "INSERT INTO tickets
    (employee_id, department, issue_type, description, priority)
    VALUES
    ('$employee_id','$department','$issue_type','$description','$priority')";

    if ($conn->query($sql)) {

        $ticket_id = $conn->insert_id;

        header("Location: add.php?success=1&id=" . $ticket_id);
        exit();

    } else {

        $error = "Error: " . $conn->error;

    }

}   
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Create Ticket | Smart IT Help Desk</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

<div class="header">

<img src="images/logo.png" class="logo">

<h1>Create New Ticket</h1>

<p class="subtitle">
Fill in the information below to create a new IT support ticket.
</p>

</div>

<?php
if($success){
    echo "
    <div class='success' id='success-message'>
        ✅ Ticket created successfully!<br><br>
        Ticket Number:
        <strong>IT-" . str_pad($ticket_id,6,"0",STR_PAD_LEFT) . "</strong>
    </div>";
}
?>


<form method="POST">

<label>Employee ID</label>

<input
type="text"
name="employee_id"
required>

<label>Department</label>

<select name="department" required>

<option value="">Select Department</option>

<option>IT</option>
<option>HR</option>
<option>Finance</option>
<option>Marketing</option>
<option>Operations</option>

</select>

<label>Issue Type</label>

<select name="issue_type" required>

<option value="">Select Issue</option>

<option>Hardware</option>
<option>Software</option>
<option>Network</option>
<option>Email</option>
<option>Printer</option>
<option>Other</option>

</select>

<label>Priority</label>

<select name="priority" required>

<option value="">Select Priority</option>

<option>Low</option>
<option>Medium</option>
<option>High</option>

</select>

<label>Description</label>

<textarea
name="description"
rows="5"
required></textarea>

<br><br>

<div class="dashboard-buttons">

<button type="submit" class="btn">
Create Ticket
</button>

<a href="dashboard.php" class="btn logout-btn">
Cancel
</a>

</div>

</form>

</div>
<script>
setTimeout(function () {
    const message = document.getElementById("success-message");
    if (message) {
        message.style.transition = "opacity 0.5s";
        message.style.opacity = "0";

        setTimeout(function () {
            message.remove();
        }, 500);
    }
}, 5000); // تختفي بعد 5 ثوانٍ
</script>
</body>
</html>
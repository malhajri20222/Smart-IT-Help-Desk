<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'database/database.php';

if (!isset($_GET['id'])) {
    die("Invalid Ticket ID");
}

$id = (int)$_GET['id'];

$sql = "SELECT * FROM tickets WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Ticket not found.");
}

$row = $result->fetch_assoc();

$status = strtolower(trim($row['status']));

$statusClass = "badge-open";

if($status=="in progress"){
    $statusClass="badge-progress";
}
elseif($status=="closed"){
    $statusClass="badge-closed";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Ticket Details</title>

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
    background:#f5f7fb;
    font-family:Arial,sans-serif;
}

.ticket-card{

    max-width:850px;
    margin:40px auto;
    background:#fff;
    border-radius:18px;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
    overflow:hidden;

}

.ticket-header{

    background:#4F6EF7;
    color:#fff;
    padding:25px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;

}

.ticket-header h2{

    margin:0;
    font-size:28px;

}

.ticket-body{

    padding:30px;

}

.info-grid{

    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;

}

.info{

    background:#f8f9fc;
    padding:15px;
    border-radius:10px;

}

.info label{

    display:block;
    color:#888;
    font-size:13px;
    margin-bottom:6px;

}

.info span{

    font-size:16px;
    font-weight:bold;

}

.description{

    margin-top:30px;
    background:#f8f9fc;
    border-radius:10px;
    padding:20px;

}

.description h3{

    margin-top:0;
    color:#4F6EF7;

}

.badge{

    padding:8px 18px;
    border-radius:30px;
    color:#fff;
    font-size:13px;
    font-weight:bold;

}

.badge-open{

    background:#28c76f;

}

.badge-progress{

    background:#ffb400;

}

.badge-closed{

    background:#ea5455;

}

.actions{

    margin-top:35px;
    display:flex;
    gap:15px;

}

.btn{

    text-decoration:none;
    padding:12px 20px;
    border-radius:10px;
    color:#fff;
    font-weight:bold;

}

.back{

    background:#6c757d;

}

.update{

    background:#4F6EF7;

}

.btn:hover{

    opacity:.9;

}

</style>

</head>

<body>

<div class="ticket-card">

<div class="ticket-header">

<div>

<h2>

<i class="bi bi-ticket-detailed-fill"></i>

Ticket

IT-<?php echo str_pad($row['id'],6,"0",STR_PAD_LEFT); ?>

</h2>

</div>

<div>

<span class="badge <?php echo $statusClass; ?>">

<?php echo htmlspecialchars($row['status']); ?>

</span>

</div>

</div>

<div class="ticket-body">

<div class="info-grid">

<div class="info">

<label>Employee ID</label>

<span><?php echo htmlspecialchars($row['employee_id']); ?></span>

</div>

<div class="info">

<label>Department</label>

<span><?php echo htmlspecialchars($row['department']); ?></span>

</div>

<div class="info">

<label>Issue Type</label>

<span><?php echo htmlspecialchars($row['issue_type']); ?></span>

</div>

<div class="info">

<label>Priority</label>

<span><?php echo htmlspecialchars($row['priority']); ?></span>

</div>

<div class="info">

<label>Created Date</label>

<span><?php echo date("d M Y",strtotime($row['created_at'])); ?></span>

</div>

<div class="info">

<label>Created Time</label>

<span><?php echo date("H:i",strtotime($row['created_at'])); ?></span>

</div>

</div>

<div class="description">

<h3>

<i class="bi bi-chat-left-text-fill"></i>

Issue Description

</h3>

<p>

<?php echo nl2br(htmlspecialchars($row['description'])); ?>

</p>

</div>

<div class="actions">

<a href="admin.php" class="btn back">

<i class="bi bi-arrow-left"></i>

Back

</a>

<a href="update_status.php?id=<?php echo $row['id']; ?>" class="btn update">

<i class="bi bi-pencil-square"></i>

Update Status

</a>

</div>

</div>

</div>

</body>

</html>
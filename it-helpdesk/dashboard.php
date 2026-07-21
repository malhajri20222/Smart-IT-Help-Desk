<?php
session_start();
include 'database/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ticket Statistics
$totalTickets = $conn->query("SELECT COUNT(*) AS total FROM tickets")->fetch_assoc()['total'];

$openTickets = $conn->query("SELECT COUNT(*) AS total FROM tickets WHERE status='Open'")->fetch_assoc()['total'];

$progressTickets = $conn->query("SELECT COUNT(*) AS total FROM tickets WHERE status='In Progress'")->fetch_assoc()['total'];

$closedTickets = $conn->query("SELECT COUNT(*) AS total FROM tickets WHERE status='Closed'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Smart IT Help Desk</title>

<link rel="stylesheet" href="css/style.css?v=2"></head>

<body>

<div class="container">

    <div class="header">

        <img src="images/logo.png" alt="Smart IT Help Desk Logo" class="logo">

        <h1>Smart IT Help Desk</h1>

        <p class="subtitle">
            Welcome back,
            <strong><?php echo htmlspecialchars($_SESSION['full_name']); ?></strong> 👋
            <br>
            <small>Manage and track IT support tickets efficiently.</small>
        </p>

    </div>

    <div class="dashboard-cards">

        <div class="card total-card">
            <h2><?php echo $totalTickets; ?></h2>
            <p>Total Tickets</p>
        </div>

        <div class="card open-card">
            <h2><?php echo $openTickets; ?></h2>
            <p>Open Tickets</p>
        </div>

        <div class="card progress-card">
            <h2><?php echo $progressTickets; ?></h2>
            <p>In Progress Tickets</p>
        </div>

        <div class="card closed-card">
            <h2><?php echo $closedTickets; ?></h2>
            <p>Closed Tickets</p>
        </div>

    </div>

    <div class="dashboard-buttons">

        <a href="add.php" class="btn">
            Create New Ticket
        </a>

       <a href="admin.php" class="btn">
    Manage Tickets
       </a>

        <a href="logout.php" class="btn logout-btn">
            Logout
        </a>

    </div>

</div>

</body>
</html>
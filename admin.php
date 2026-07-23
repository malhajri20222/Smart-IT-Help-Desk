<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (strtolower($_SESSION['role']) != "admin") {
    header("Location: dashboard.php");
    exit();
}
include 'database/database.php';

// Statistics
$total = $conn->query("SELECT COUNT(*) AS total FROM tickets")->fetch_assoc()['total'];

$open = $conn->query("SELECT COUNT(*) AS total FROM tickets WHERE LOWER(status)='open'")->fetch_assoc()['total'];

$progress = $conn->query("SELECT COUNT(*) AS total FROM tickets WHERE LOWER(status)='in progress'")->fetch_assoc()['total'];

$closed = $conn->query("SELECT COUNT(*) AS total FROM tickets WHERE LOWER(status)='closed'")->fetch_assoc()['total'];

// Search
$search = "";

if (isset($_GET['search']) && $_GET['search'] != "") {

    $search = $conn->real_escape_string($_GET['search']);

    $sql = "SELECT * FROM tickets
            WHERE employee_id LIKE '%$search%'
            OR department LIKE '%$search%'
            OR issue_type LIKE '%$search%'
            ORDER BY id DESC";

} else {

    $sql = "SELECT * FROM tickets ORDER BY id DESC";

}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard | Smart IT Help Desk</title>

<link rel="stylesheet" href="css/style.css?v=2">
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container">

<div class="header">

<img src="images/logo.png" class="logo" alt="Logo">

<h1>Smart IT Help Desk</h1>

<p class="subtitle">
Administrator Dashboard
</p>

</div>

<div class="top-dashboard">

    <div class="dashboard-cards">

        <div class="card total-card">
            <h2><?php echo $total; ?></h2>
            <p>Total Tickets</p>
        </div>

        <div class="card open-card">
            <h2><?php echo $open; ?></h2>
            <p>Open Tickets</p>
        </div>

        <div class="card progress-card">
            <h2><?php echo $progress; ?></h2>
            <p>In Progress</p>
        </div>

        <div class="card closed-card">
            <h2><?php echo $closed; ?></h2>
            <p>Closed Tickets</p>
        </div>

    </div>

    <div class="chart-card">

    <h3>Ticket Statistics</h3>

    <div class="chart-container">
        <canvas id="ticketChart"></canvas>
    </div>

</div>

</div>
<form method="GET" class="search-box">

    <input
        type="text"
        name="search"
        placeholder="Search by Employee ID, Department or Issue..."
        value="<?php echo htmlspecialchars($search); ?>">

    <button type="submit" class="search-btn">
        <i class="bi bi-search"></i> Search
    </button>

</form>
<table>

<thead>

<tr>

<th>Ticket No</th>
<th>Department</th>
<th>Issue Type</th>
<th>Priority</th>
<th>Status</th>
<th>Created At</th>
<th>Action</th>

</tr>

</thead>

<tbody>
    <?php while ($row = $result->fetch_assoc()) { ?>

<tr>

<td>
<strong>
IT-<?php echo str_pad($row['id'], 6, "0", STR_PAD_LEFT); ?>
</strong>
</td>

<td><?php echo htmlspecialchars($row['department']); ?></td>

<td><?php echo htmlspecialchars($row['issue_type']); ?></td>

<td><?php echo htmlspecialchars($row['priority']); ?></td>

<td>

<?php

$status = strtolower(trim($row['status']));

if ($status == "open") {

    echo "<span class='badge badge-open'>Open</span>";

} elseif ($status == "in progress") {

    echo "<span class='badge badge-progress'>In Progress</span>";

} elseif ($status == "closed") {

    echo "<span class='badge badge-closed'>Closed</span>";

} else {

    echo htmlspecialchars($row['status']);

}

?>

</td>

<td>

<?php echo date("d M Y", strtotime($row['created_at'])); ?>

<br>

<small style="color:#888;">
<?php echo date("H:i", strtotime($row['created_at'])); ?>
</small>

</td>

<td>

<div class="action-buttons">

<a href="view_ticket.php?id=<?php echo $row['id']; ?>" class="btn" style="padding:8px 12px;background:#0d6efd;">
    <i class="bi bi-eye"></i>
</a>

<a href="delete.php?id=<?php echo $row['id']; ?>"
class="btn logout-btn"
style="padding:8px 12px;"
onclick="return confirm('Are you sure you want to delete this ticket?')">

<i class="bi bi-trash3"></i>

</a>

</div>
</td>

</tr>

<?php } ?>

</tbody>

</table>

<br>

<div class="dashboard-buttons">

    <a href="dashboard.php" class="btn">
        <i class="bi bi-house-door"></i>
        User Dashboard
    </a>

    <a href="add.php" class="btn">
        <i class="bi bi-plus-circle"></i>
        New Ticket
    </a>

    <a href="users.php" class="btn">
        <i class="bi bi-people-fill"></i>
        Manage Users
    </a>

    <a href="create_employee.php" class="btn">
        <i class="bi bi-person-plus-fill"></i>
        Create Employee
    </a>

    <a href="logout.php" class="btn logout-btn">
        <i class="bi bi-box-arrow-right"></i>
        Logout
    </a>

</div>

</div>


<script>
const ctx = document.getElementById('ticketChart');
if(ctx){
new Chart(ctx,{
type:'doughnut',
data:{labels:['Open','In Progress','Closed'],datasets:[{data:[<?php echo (int)$open; ?>,<?php echo (int)$progress; ?>,<?php echo (int)$closed; ?>],backgroundColor:['#28c76f','#ffb400','#ea5455'],borderColor:'#fff',borderWidth:2}]},
options: {
    responsive: true,
    maintainAspectRatio: false,
    cutout: '65%',
    plugins: {
        legend: {
            position: 'bottom',
            labels: {
                usePointStyle: true,
                pointStyle: 'circle',
                boxWidth: 10,
                boxHeight: 10,
                padding: 10
            }
        }
    }
}
});
}
</script>

</body>
</html>
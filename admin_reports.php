<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/db_connect.php';
include 'includes/header.php';
include 'includes/navbar.php';

$totalStudents = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM students"))['total'];

$totalDepartments = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM departments"))['total'];

$totalCourses = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM courses"))['total'];

$totalExams = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM exam"))['total'];

$totalRegistrations = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM exam_registration"))['total'];

$totalPayments = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM payments"))['total'];

$verifiedPayments = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM payments WHERE payment_status='verified'"))['total'];

$pendingPayments = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM payments WHERE payment_status='pending'"))['total'];

$rejectedPayments = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM payments WHERE payment_status='rejected'"))['total'];
?>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h2>System Reports</h2>

</div>

<div class="card-body">

<table class="table table-bordered table-striped">

<tr>
<th>Report</th>
<th>Total</th>
</tr>

<tr>
<td>Total Students</td>
<td><?php echo $totalStudents; ?></td>
</tr>

<tr>
<td>Total Departments</td>
<td><?php echo $totalDepartments; ?></td>
</tr>

<tr>
<td>Total Courses</td>
<td><?php echo $totalCourses; ?></td>
</tr>

<tr>
<td>Total Exams</td>
<td><?php echo $totalExams; ?></td>
</tr>

<tr>
<td>Total Exam Registrations</td>
<td><?php echo $totalRegistrations; ?></td>
</tr>

<tr>
<td>Total Payments</td>
<td><?php echo $totalPayments; ?></td>
</tr>

<tr>
<td>Verified Payments</td>
<td><?php echo $verifiedPayments; ?></td>
</tr>

<tr>
<td>Pending Payments</td>
<td><?php echo $pendingPayments; ?></td>
</tr>

<tr>
<td>Rejected Payments</td>
<td><?php echo $rejectedPayments; ?></td>
</tr>

</table>

<div class="text-center mt-4">

<button onclick="window.print()" class="btn btn-success">
Print Report
</button>

<a href="admin_dashboard.php" class="btn btn-secondary">
Back to Dashboard
</a>

</div>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>
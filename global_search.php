<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/db_connect.php';
include 'includes/header.php';
include 'includes/navbar.php';

$search = "";

if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn,$_GET['search']);
}

$sql = "SELECT *
        FROM students
        WHERE reg_no LIKE '%$search%'
        OR first_name LIKE '%$search%'
        OR last_name LIKE '%$search%'
        OR email LIKE '%$search%'";

$result = mysqli_query($conn,$sql);
?>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h3>Global Search Results</h3>

</div>

<div class="card-body">

<?php

if(mysqli_num_rows($result)==0){

echo "<div class='alert alert-danger'>
No student found.
</div>";

}else{

while($student=mysqli_fetch_assoc($result)){

$reg_no=$student['reg_no'];

?>

<div class="card mb-4">

<div class="card-header bg-primary text-white">

<h4><?php echo $student['first_name']." ".$student['last_name']; ?></h4>

</div>

<div class="card-body">

<h5>Student Details</h5>

<table class="table table-bordered">

<tr>
<th>Registration Number</th>
<td><?php echo $student['reg_no']; ?></td>
</tr>

<tr>
<th>Email</th>
<td><?php echo $student['email']; ?></td>
</tr>

<tr>
<th>Phone</th>
<td><?php echo $student['phone']; ?></td>
</tr>

<tr>
<th>Year</th>
<td><?php echo $student['year_of_study']; ?></td>
</tr>

</table>

<?php

$payment=mysqli_query($conn,"
SELECT *
FROM payments
WHERE reg_no='$reg_no'
ORDER BY payment_id DESC
LIMIT 1
");

if(mysqli_num_rows($payment)>0){

$p=mysqli_fetch_assoc($payment);

?>

<h5>Latest Payment</h5>

<table class="table table-bordered">

<tr>
<th>Amount</th>
<td>KES <?php echo number_format($p['amount'],2); ?></td>
</tr>

<tr>
<th>Status</th>
<td><?php echo strtoupper($p['payment_status']); ?></td>
</tr>

<tr>
<th>Date</th>
<td><?php echo $p['payment_date']; ?></td>
</tr>

</table>

<?php } ?>

<?php

$exam=mysqli_query($conn,"
SELECT e.exam_name,
e.exam_date,
e.exam_time,
er.registration_status
FROM exam_registration er
JOIN exam e
ON er.exam_id=e.exam_id
WHERE er.reg_no='$reg_no'
");

?>

<h5>Registered Exams</h5>

<table class="table table-bordered">

<tr>

<th>Exam</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>

</tr>

<?php

if(mysqli_num_rows($exam)>0){

while($e=mysqli_fetch_assoc($exam)){

?>

<tr>

<td><?php echo $e['exam_name']; ?></td>

<td><?php echo $e['exam_date']; ?></td>

<td><?php echo $e['exam_time']; ?></td>

<td><?php echo $e['registration_status']; ?></td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="4" class="text-center">

No registered exams.

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<?php

}

}

?>

<a href="admin_dashboard.php" class="btn btn-secondary">

Back to Dashboard

</a>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>
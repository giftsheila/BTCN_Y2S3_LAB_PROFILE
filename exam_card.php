<?php
session_start();

if (!isset($_SESSION['reg_no'])) {
    header("Location: login.php");
    exit();
}

include 'config/db_connect.php';

$reg_no = $_SESSION['reg_no'];

$sql = "SELECT
            s.reg_no,
            s.first_name,
            s.last_name,
            c.course_name,
            d.department_name,
            e.exam_name,
            e.exam_date,
            e.exam_time,
            e.venue,
            er.registration_status,
            p.payment_status
        FROM students s
        INNER JOIN exam_registration er ON s.reg_no = er.reg_no
        INNER JOIN exam e ON er.exam_id = e.exam_id
        LEFT JOIN courses c ON s.course_id = c.course_id
        LEFT JOIN departments d ON s.department_id = d.department_id
        LEFT JOIN payments p ON s.reg_no = p.reg_no
        WHERE s.reg_no='$reg_no'
        AND p.payment_status='verified'
        LIMIT 1";

$result = mysqli_query($conn, $sql);

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">

<?php

if(mysqli_num_rows($result)==0){

?>

<div class="alert alert-danger">

<h4>Exam Card Cannot Be Generated</h4>

<p>

You must:

<ul>
<li>Complete your payment.</li>
<li>Have your payment verified.</li>
<li>Register for an examination.</li>
</ul>

</p>

<a href="student_dashboard.php" class="btn btn-primary">
Back to Dashboard
</a>

</div>

<?php

}else{

$card=mysqli_fetch_assoc($result);

?>

<div class="card shadow-lg">

<div class="card-header bg-primary text-white text-center">

<h2>ONLINE EXAM REGISTRATION SYSTEM</h2>

<h4>EXAMINATION CARD</h4>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>
<th width="35%">Registration Number</th>
<td><?php echo $card['reg_no']; ?></td>
</tr>

<tr>
<th>Student Name</th>
<td><?php echo $card['first_name']." ".$card['last_name']; ?></td>
</tr>

<tr>
<th>Course</th>
<td><?php echo $card['course_name']; ?></td>
</tr>

<tr>
<th>Department</th>
<td><?php echo $card['department_name']; ?></td>
</tr>

<tr>
<th>Exam</th>
<td><?php echo $card['exam_name']; ?></td>
</tr>

<tr>
<th>Exam Date</th>
<td><?php echo $card['exam_date']; ?></td>
</tr>

<tr>
<th>Exam Time</th>
<td><?php echo $card['exam_time']; ?></td>
</tr>

<tr>
<th>Venue</th>
<td><?php echo $card['venue']; ?></td>
</tr>

<tr>
<th>Payment Status</th>
<td>
<span class="badge bg-success">
<?php echo strtoupper($card['payment_status']); ?>
</span>
</td>
</tr>

<tr>
<th>Registration Status</th>
<td>
<span class="badge bg-primary">
<?php echo strtoupper($card['registration_status']); ?>
</span>
</td>
</tr>

</table>

<div class="text-center mt-4">

<button onclick="window.print()" class="btn btn-success">

Print Exam Card

</button>

<a href="student_dashboard.php" class="btn btn-secondary">

Back

</a>

</div>

</div>

<div class="card-footer text-center">

<strong>
Carry this examination card together with your Student ID during every examination.
</strong>

</div>

</div>

<?php } ?>

</div>

<?php include 'includes/footer.php'; ?>
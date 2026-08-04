<?php
session_start();

if (!isset($_SESSION['reg_no'])) {
    header("Location: login.php");
    exit();
}

include 'config/db_connect.php';

$reg_no = $_SESSION['reg_no'];

if (!isset($_GET['id'])) {
    header("Location: available_exams.php");
    exit();
}

$exam_id = $_GET['id'];

// Check if the student has already registered
$check = mysqli_query($conn,
    "SELECT * FROM exam_registration
     WHERE reg_no='$reg_no'
     AND exam_id='$exam_id'");

if (mysqli_num_rows($check) > 0) {

    echo "<script>
            alert('You have already registered for this exam.');
            window.location='available_exams.php';
          </script>";

    exit();
}

// Register the student
$sql = "INSERT INTO exam_registration
        (reg_no, exam_id, registration_status)
        VALUES
        ('$reg_no', '$exam_id', 'Pending')";

if (mysqli_query($conn, $sql)) {

    echo "<script>
            alert('Exam registration successful!');
            window.location='my_registrations.php';
          </script>";

} else {

    echo "Error: " . mysqli_error($conn);

}
?>
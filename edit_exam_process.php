<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $exam_id = $_POST['exam_id'];
    $exam_name = trim($_POST['exam_name']);
    $course_id = $_POST['course_id'];
    $exam_date = $_POST['exam_date'];
    $exam_time = $_POST['exam_time'];
    $venue = trim($_POST['venue']);

    $sql = "UPDATE exams
            SET exam_name='$exam_name',
                course_id='$course_id',
                exam_date='$exam_date',
                exam_time='$exam_time',
                venue='$venue'
            WHERE exam_id='$exam_id'";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Exam updated successfully!');
                window.location='view_exams.php';
              </script>";

    } else {

        echo "Error: " . mysqli_error($conn);

    }

} else {

    header("Location: view_exams.php");
    exit();

}
?>
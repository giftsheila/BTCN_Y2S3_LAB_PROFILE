<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $exam_name = trim($_POST['exam_name']);
    $course_id = $_POST['course_id'];
    $exam_date = $_POST['exam_date'];
    $exam_time = $_POST['exam_time'];
    $venue = trim($_POST['venue']);

    // Check for duplicate exam
    $check = mysqli_query($conn,
        "SELECT * FROM exams
         WHERE exam_name='$exam_name'
         AND course_id='$course_id'
         AND exam_date='$exam_date'
         AND exam_time='$exam_time'"
    );

    if (mysqli_num_rows($check) > 0) {

        echo "<script>
                alert('This exam already exists.');
                window.location='create_exam.php';
              </script>";

        exit();
    }

    // Insert exam
    $sql = "INSERT INTO exams
            (exam_name, course_id, exam_date, exam_time, venue)
            VALUES
            ('$exam_name','$course_id','$exam_date','$exam_time','$venue')";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Exam created successfully!');
                window.location='create_exam.php';
              </script>";

    } else {

        echo "Error: " . mysqli_error($conn);

    }

} else {

    header("Location: create_exam.php");
    exit();

}
?>
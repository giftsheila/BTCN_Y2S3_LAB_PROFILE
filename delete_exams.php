<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/db_connect.php';

if (isset($_GET['id'])) {

    $exam_id = $_GET['id'];

    $sql = "DELETE FROM exams WHERE exam_id='$exam_id'";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Exam deleted successfully.');
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
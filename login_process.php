<?php
session_start();
include 'config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $reg_no = trim($_POST['reg_no']);
    $password = $_POST['password'];

    // Check if the student exists
    $sql = "SELECT * FROM students WHERE reg_no = '$reg_no'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $student = mysqli_fetch_assoc($result);

        // Verify the hashed password
        if (password_verify($password, $student['password'])) {

            $_SESSION['reg_no'] = $student['reg_no'];
            $_SESSION['first_name'] = $student['first_name'];

            header("Location: student_dashboard.php");
            exit();

        } else {

            echo "<script>
                    alert('Incorrect password.');
                    window.location='login.php';
                  </script>";

        }

    } else {

        echo "<script>
                alert('Registration number not found.');
                window.location='login.php';
              </script>";

    }

} else {

    header("Location: login.php");
    exit();

}
?>
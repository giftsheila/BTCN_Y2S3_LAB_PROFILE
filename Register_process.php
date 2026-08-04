<?php
include 'config/db_connect.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $reg_no = trim($_POST['reg_no']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $gender = $_POST['gender'];
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $department_id = $_POST['department_id'];
    $course_id = $_POST['course_id'];
    $year_of_study = $_POST['year_of_study'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password != $confirm_password) {
        die("Passwords do not match.");
    }

    // Check if registration number already exists
    $check = mysqli_query($conn, "SELECT * FROM students WHERE reg_no='$reg_no'");

    if (mysqli_num_rows($check) > 0) {
        die("Registration number already exists.");
    }

    // Encrypt password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert student
    $sql = "INSERT INTO students
            (reg_no, first_name, last_name, gender, email, phone, password,
             course_id, department_id, year_of_study)
            VALUES
            ('$reg_no','$first_name','$last_name','$gender','$email',
             '$phone','$hashed_password','$course_id','$department_id','$year_of_study')";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Registration Successful!');
                window.location='login.php';
              </script>";

    } else {

        echo "Error: " . mysqli_error($conn);

    }

} else {

    header("Location: register.php");
    exit();

}
?>
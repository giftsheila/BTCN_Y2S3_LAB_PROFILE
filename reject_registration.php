<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/db_connect.php';

if (isset($_GET['id'])) {

    $registration_id = $_GET['id'];

    $sql = "UPDATE exam_registration
            SET registration_status='Rejected'
            WHERE registration_id='$registration_id'";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Registration rejected.');
                window.location='view_registrations.php';
              </script>";

    } else {

        echo "Error: " . mysqli_error($conn);

    }

} else {

    header("Location: view_registrations.php");
    exit();

}
?>
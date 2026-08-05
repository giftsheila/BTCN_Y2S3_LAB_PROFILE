<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/db_connect.php';

if (isset($_GET['id'])) {

    $payment_id = intval($_GET['id']);

    $sql = "UPDATE payments
            SET payment_status='verified'
            WHERE payment_id='$payment_id'";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Payment verified successfully.');
                window.location='admin_payments.php';
              </script>";

    } else {

        echo "Error: " . mysqli_error($conn);

    }

} else {

    header("Location: admin_payments.php");
    exit();

}
?>
<?php
session_start();

if (!isset($_SESSION['reg_no'])) {
    header("Location: login.php");
    exit();
}

include 'config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $reg_no = $_POST['reg_no'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $transaction_reference = trim($_POST['transaction_reference']);
    $payment_date = $_POST['payment_date'];

    // Check if transaction reference already exists
    $check = mysqli_query($conn, "SELECT * FROM payments WHERE transaction_reference='$transaction_reference'");

    if (mysqli_num_rows($check) > 0) {

        echo "<script>
                alert('Transaction reference already exists.');
                window.location='make_payment.php';
              </script>";
        exit();

    }

    // Save payment
    $sql = "INSERT INTO payments
            (reg_no, amount, payment_method, transaction_reference, payment_date, payment_status)
            VALUES
            ('$reg_no', '$amount', '$payment_method', '$transaction_reference', '$payment_date', 'pending')";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Payment submitted successfully. Waiting for administrator verification.');
                window.location='payment_history.php';
              </script>";

    } else {

        echo "Error: " . mysqli_error($conn);

    }

} else {

    header("Location: make_payment.php");
    exit();

}
?>
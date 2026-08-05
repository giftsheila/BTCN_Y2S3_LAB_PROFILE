<?php
session_start();

include '../config/db_connect.php';
include '../config/mpesa_config.php';

// Ensure student is logged in
if (!isset($_SESSION['reg_no'])) {
    die("Please log in first.");
}

$reg_no = $_SESSION['reg_no'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $phone = trim($_POST['phone']);
    $amount = trim($_POST['amount']);

    // Format phone number
    if (substr($phone, 0, 1) == "0") {
        $phone = "254" . substr($phone, 1);
    }

    // ==========================
    // GET ACCESS TOKEN
    // ==========================
    $credentials = base64_encode(CONSUMER_KEY . ":" . CONSUMER_SECRET);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Basic $credentials"
        ),
        CURLOPT_RETURNTRANSFER => true
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($response);

    if (!isset($result->access_token)) {
        die("Failed to generate access token.");
    }

    $access_token = $result->access_token;

    // ==========================
    // GENERATE PASSWORD
    // ==========================

    $timestamp = date("YmdHis");

    $password = base64_encode(
        BUSINESS_SHORTCODE .
        PASSKEY .
        $timestamp
    );

    // ==========================
    // STK PUSH REQUEST
    // ==========================

    $stkData = array(
        "BusinessShortCode" => BUSINESS_SHORTCODE,
        "Password" => $password,
        "Timestamp" => $timestamp,
        "TransactionType" => "CustomerPayBillOnline",
        "Amount" => $amount,
        "PartyA" => $phone,
        "PartyB" => BUSINESS_SHORTCODE,
        "PhoneNumber" => $phone,
        "CallBackURL" => CALLBACK_URL,
        "AccountReference" => $reg_no,
        "TransactionDesc" => "Exam Registration Payment"
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $access_token",
            "Content-Type: application/json"
        ),
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($stkData),
        CURLOPT_RETURNTRANSFER => true
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($response);

    if (isset($result->CheckoutRequestID)) {

        $checkout = $result->CheckoutRequestID;
        $merchant = $result->MerchantRequestID;

        mysqli_query($conn,"
            INSERT INTO payments
            (
                reg_no,
                amount,
                payment_method,
                checkout_request_id,
                merchant_request_id,
                payment_status,
                payment_date
            )
            VALUES
            (
                '$reg_no',
                '$amount',
                'mpesa',
                '$checkout',
                '$merchant',
                'pending',
                CURDATE()
            )
        ");

        echo "<h3>STK Push Sent Successfully.</h3>";
        echo "<p>Check your phone and enter your M-Pesa PIN.</p>";

    } else {

        echo "<pre>";
        print_r($result);
        echo "</pre>";

    }

}
?>
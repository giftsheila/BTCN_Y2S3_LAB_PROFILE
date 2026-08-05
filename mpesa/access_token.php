<?php

include '../config/mpesa_config.php';

$credentials = base64_encode(CONSUMER_KEY . ":" . CONSUMER_SECRET);

$url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "Authorization: Basic " . $credentials
));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);

if (curl_errno($curl)) {
    die("cURL Error: " . curl_error($curl));
}

curl_close($curl);

$result = json_decode($response);

if (isset($result->access_token)) {
    echo $result->access_token;
} else {
    echo "<pre>";
    print_r($result);
    echo "</pre>";
}
?>
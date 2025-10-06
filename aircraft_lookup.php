<?php
header('Content-Type: application/json');

if (!isset($_GET['reg']) || empty(trim($_GET['reg']))) {
    echo json_encode(['error' => 'No registration provided']);
    exit;
}

$reg = strtoupper(trim($_GET['reg']));

$apiKey = '859233adf6mshd151702173d4d05p178410jsn670d942c0fcc'; // replace with your RapidAPI key
$apiHost = 'aerodatabox.p.rapidapi.com';
$url = "https://aerodatabox.p.rapidapi.com/aircrafts/reg/$reg";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "X-RapidAPI-Key: $apiKey",
    "X-RapidAPI-Host: $apiHost"
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($response === false || $httpCode !== 200) {
    echo json_encode(['error' => "Aircraft not found or API error (HTTP $httpCode)"]);
    exit;
}

echo $response;

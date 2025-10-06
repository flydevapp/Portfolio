<?php
// Allow requests from any domain (CORS)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Check if registration parameter exists
if (!isset($_GET['reg']) || empty(trim($_GET['reg']))) {
    echo json_encode(['error' => 'No registration provided']);
    exit;
}

$reg = strtoupper(trim($_GET['reg']));

// RapidAPI credentials
$apiKey = '859233adf6mshd151702173d4d05p178410jsn670d942c0fcc'; // keep your key here
$apiHost = 'aerodatabox.p.rapidapi.com';
$url = "https://aerodatabox.p.rapidapi.com/aircrafts/reg/$reg";

// Initialize cURL
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

// Handle errors
if ($response === false || $httpCode !== 200) {
    echo json_encode(['error' => "Aircraft not found or API error (HTTP $httpCode)"]);
    exit;
}

// Return the API response
echo $response;

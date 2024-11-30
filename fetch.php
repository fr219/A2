<?php

header("Content-Type: application/json");

// API URL
$apiURL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Initialize cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

// Execute cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo json_encode(["error" => "cURL Error: " . curl_error($ch)]);
    exit;
}

curl_close($ch);

// Check if the response is empty
if (empty($response)) {
    echo json_encode(["error" => "No data received from the API."]);
    exit;
}

// Decode JSON response
$data = json_decode($response, true);

// Check for JSON errors
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(["error" => "Invalid JSON returned from API: " . json_last_error_msg()]);
    exit;
}

// Check if 'records' key exists and is not empty
$records = $data['records'] ?? [];
if (empty($records)) {
    echo json_encode(["error" => "No records available from the API."]);
    exit;
}

// Prepare data for the frontend
$result = [];
foreach ($records as $record) {
    $fields = $record['record'] ?? [];
    $result[] = [
        $fields['year'] ?? 'N/A',
        $fields['semester'] ?? 'N/A',
        $fields['the_programs'] ?? 'N/A',
        $fields['nationality'] ?? 'N/A',
        $fields['colleges'] ?? 'N/A',
        $fields['number_of_students'] ?? 'N/A',
    ];
}

// Return the formatted data as JSON
echo json_encode($result);
?>
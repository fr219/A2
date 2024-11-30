<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

// API URL
$apiURL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $apiURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification (use true in production)

$response = curl_exec($ch);

// Check for errors in cURL execution
if ($response === false) {
    echo json_encode(["error" => "Failed to fetch data from API. cURL error: " . curl_error($ch)]);
    exit;
}

// Close the cURL session
curl_close($ch);

// Decode the JSON response
$data = json_decode($response, true);

// Check for JSON errors
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(["error" => "Invalid JSON returned from API: " . json_last_error_msg()]);
    exit;
}

// Check if 'results' key exists and has data
$results = $data['results'] ?? [];
if (empty($results)) {
    echo json_encode(["error" => "No results available from the API."]);
    exit;
}

// Prepare data for the frontend
$result = [];
foreach ($results as $record) {
    $result[] = [
        $record['year'] ?? 'N/A',
        $record['semester'] ?? 'N/A',
        $record['the_programs'] ?? 'N/A',
        $record['nationality'] ?? 'N/A',
        $record['colleges'] ?? 'N/A',
        $record['number_of_students'] ?? 'N/A',
    ];
}

// Return the formatted data as JSON
echo json_encode($result);
?>

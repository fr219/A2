<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Allow cross-origin requests if needed

// API URL
$apiURL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch data using file_get_contents
$response = @file_get_contents($apiURL);

// Check for errors in the response
if ($response === FALSE) {
    echo json_encode(["error" => "Failed to fetch data from API."]);
    exit;
}

// Decode JSON response
$data = json_decode($response, true);

// Debugging: Log raw response
file_put_contents('debug_response.json', $response);

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
    // Safely handle missing or null values
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


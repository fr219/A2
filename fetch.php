<?php
header("Content-Type: application/json");

// API URL
$apiURL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch data from API
$response = file_get_contents($apiURL);

// Debugging: Check the raw response
if ($response === false) {
    echo json_encode(["error" => "Unable to fetch data from the API."]);
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

// Parse and format the data
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

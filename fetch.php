<?php
// API Endpoint URL
$apiURL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch data from the API
$response = file_get_contents($apiURL);

if ($response === false) {
    echo json_encode(["error" => "Unable to fetch data from API"]);
    exit;
}

// Decode JSON response
$data = json_decode($response, true);

// Extract records
$records = $data['records'] ?? [];

// Prepare data for the table
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

// Return as JSON
echo json_encode($result);

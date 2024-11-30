<?php
// API URL
$apiURL = "https://data.gov.bh/explore/embed/dataset/01-statistics-of-students-nationalities_updated/table/?disjunctive.year&disjunctive.semester&disjunctive.the_programs&sort=number_of_students&static=false&datasetcard=false";

// Fetch data from the API
$html = file_get_contents($apiURL);

if ($html === false) {
    echo json_encode(["error" => "Unable to fetch data"]);
    exit;
}

// Parse HTML and extract table rows
$dom = new DOMDocument();
@$dom->loadHTML($html);
$xpath = new DOMXPath($dom);
$rows = $xpath->query("//table/tbody/tr");

// Prepare the data as an array
$data = [];
foreach ($rows as $row) {
    $cols = $xpath->query("td", $row);
    $rowData = [];
    foreach ($cols as $col) {
        $rowData[] = trim($col->nodeValue);
    }
    $data[] = $rowData;
}

// Return the data as JSON
echo json_encode($data);
?>

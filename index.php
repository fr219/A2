<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Student Nationalities</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <h1>UOB Student Enrollment by Nationality</h1>
        <table role="table">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Program</th>
                    <th>Nationality</th>
                    <th>College</th>
                    <th>Number of Students</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // API URL
                $apiURL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

                // Fetch data from the API
                $response = file_get_contents($apiURL);

                // Check if the response is empty
                if ($response === FALSE) {
                    echo "<tr><td colspan='6'>Failed to fetch data from API.</td></tr>";
                } else {
                    // Decode the JSON response
                    $data = json_decode($response, true);

                    // Check for JSON errors
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        echo "<tr><td colspan='6'>Failed to decode JSON data.</td></tr>";
                    } else {
                        // Check if 'results' exists and is an array
                        if (isset($data['results']) && is_array($data['results'])) {
                            foreach ($data['results'] as $record) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($record['year'] ?? 'N/A') . "</td>";
                                echo "<td>" . htmlspecialchars($record['semester'] ?? 'N/A') . "</td>";
                                echo "<td>" . htmlspecialchars($record['the_programs'] ?? 'N/A') . "</td>";
                                echo "<td>" . htmlspecialchars($record['nationality'] ?? 'N/A') . "</td>";
                                echo "<td>" . htmlspecialchars($record['colleges'] ?? 'N/A') . "</td>";
                                echo "<td>" . htmlspecialchars($record['number_of_students'] ?? 'N/A') . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No data available from the API.</td></tr>";
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>

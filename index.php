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

                // Initialize cURL session
                $ch = curl_init();

                // Set cURL options
                curl_setopt($ch, CURLOPT_URL, $apiURL);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification (use true in production)

                // Execute cURL and get the response
                $response = curl_exec($ch);

                // Check for cURL errors
                if ($response === false) {
                    echo "<tr><td colspan='6'>Failed to fetch data from API. cURL error: " . curl_error($ch) . "</td></tr>";
                } else {
                    // Close cURL session
                    curl_close($ch);

                    // Decode the JSON response
                    $data = json_decode($response, true);

                    // Check for JSON errors
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        echo "<tr><td colspan='6'>Failed to decode JSON data. Error: " . json_last_error_msg() . "</td></tr>";
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

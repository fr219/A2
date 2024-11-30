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
                // Include the fetch.php code to fetch and process the data
                include 'fetch.php';

                // Check if there was any error in fetch.php (via $result array)
                if (isset($result) && !empty($result)) {
                    // Loop through the results and output table rows
                    foreach ($result as $record) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($record[0] ?? 'N/A') . "</td>"; // Year
                        echo "<td>" . htmlspecialchars($record[1] ?? 'N/A') . "</td>"; // Semester
                        echo "<td>" . htmlspecialchars($record[2] ?? 'N/A') . "</td>"; // Program
                        echo "<td>" . htmlspecialchars($record[3] ?? 'N/A') . "</td>"; // Nationality
                        echo "<td>" . htmlspecialchars($record[4] ?? 'N/A') . "</td>"; // College
                        echo "<td>" . htmlspecialchars($record[5] ?? 'N/A') . "</td>"; // Number of Students
                        echo "</tr>";
                    }
                } else {
                    // If no data is available
                    echo "<tr><td colspan='6'>No data available from the API.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>

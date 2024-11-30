<?php
ob_start(); // Start output buffering to prevent premature output
?>
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
                // Fetch data from fetch.php
                $apiData = file_get_contents('fetch.php');
                $data = json_decode($apiData, true);

                if (isset($data['error'])) {
                    echo "<tr><td colspan='6'>" . htmlspecialchars($data['error']) . "</td></tr>";
                } else {
                    foreach ($data as $record) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($record[0] ?? 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars($record[1] ?? 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars($record[2] ?? 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars($record[3] ?? 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars($record[4] ?? 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars($record[5] ?? 'N/A') . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
<?php
ob_end_flush(); // End output buffering
?>

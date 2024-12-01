<?php
$response = file_get_contents("https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100");

try {

    $data = json_decode($response,
        flags: JSON_THROW_ON_ERROR | JSON_OBJECT_AS_ARRAY);

} catch (JsonException $e) {
    exit($e->getMessage());
}

/*
if (json_last_error() !== JSON_ERROR_NONE) {

    echo json_last_error_msg();
}*/

?>

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
                <table>
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>The Programs</th>
                            <th>Nationality</th>
                            <th>College</th>
                            <th>Number of sudents</th>
                        </tr>
                    </thead>
                    <tbody id="data-body">
                    <?php foreach ($data['results'] as $result) : ?>
                    <tr>
                        <td><?= $result['year']?></td>
                        <td><?= $result['semester']?></td>
                        <td><?= $result['the_programs']?></td>
                        <td><?= $result['nationality'] ?></td>
                        <td><?= $result['colleges'] ?></td>
                        <td><?= $result['number_of_students'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            
    </main>
</body>
</html>
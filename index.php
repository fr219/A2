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
            <tbody id="data-body">
                <!-- Data will be populated dynamically -->
            </tbody>
        </table>
    </main>
    <script>
        // Fetch data from the API using JavaScript's fetch
        fetch("https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100")
            .then(response => {
                if (!response.ok) {
                    throw new Error(HTTP error! Status: ${response.status});
                }
                return response.json();
            })
            .then(data => {
                const tbody = document.getElementById("data-body");

                if (data.error) {
                    tbody.innerHTML = <tr><td colspan="6">${data.error}</td></tr>;
                } else {
                    data.results.forEach(record => {
                        const tr = document.createElement("tr");
                        tr.innerHTML = 
                            <td>${record.year}</td>
                            <td>${record.semester}</td>
                            <td>${record.the_programs}</td>
                            <td>${record.nationality}</td>
                            <td>${record.colleges}</td>
                            <td>${record.number_of_students}</td>
                        ;
                        tbody.appendChild(tr);
                    });
                }
            })
            .catch(error => {
                console.error("Error fetching data:", error);
                const tbody = document.getElementById("data-body");
                tbody.innerHTML = <tr><td colspan="6">An error occurred while fetching data.</td></tr>;
            });
    </script>
</body>
</html>
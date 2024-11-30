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
        <table>
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
                <!-- Data will be dynamically inserted here -->
            </tbody>
        </table>
    </main>
    <script>
        // Fetch data from the PHP backend
        fetch("fetch.php")
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById("data-body");

                if (data.error) {
                    tbody.innerHTML = `<tr><td colspan="6">${data.error}</td></tr>`;
                } else if (data.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="6">No data available</td></tr>`;
                } else {
                    data.forEach(row => {
                        const tr = document.createElement("tr");
                        row.forEach(cell => {
                            const td = document.createElement("td");
                            td.textContent = cell;
                            tr.appendChild(td);
                        });
                        tbody.appendChild(tr);
                    });
                }
            })
            .catch(error => {
                console.error("Error fetching data:", error);
                const tbody = document.getElementById("data-body");
                tbody.innerHTML = `<tr><td colspan="6">An error occurred while fetching data.</td></tr>`;
            });
    </script>
</body>
</html>

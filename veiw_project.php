<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'project_repository'; // Replace 'your_database_name' with your actual database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from multiple tables using a JOIN operation
$sql = "
SELECT p.project_title, p.file_path, p.upload_date, p.student_name, s.supervisor_name
FROM projects p
LEFT JOIN assigned_projects s ON p.student_name = s.student_name";
$result = $conn->query($sql);

// Check if query was successful
if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
    <style>
        /* Your CSS styles for table display */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 10px;
            padding: 5px;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
k8
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Project Details</h2>
    <table>
        <tr>
            <th>Project Title</th>
            <th>File Path</th>
            <th>Upload Date</th>
            <th>Student Name</th>
            <th>Supervisor Name</th>
            <th>Download</th><!-- New column for download links -->
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["project_title"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["file_path"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["upload_date"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["student_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["supervisor_name"]) . "</td>";
                // Download link column
                echo "<td><a href='" . htmlspecialchars($row["file_path"]) . "' download>Download</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No projects found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

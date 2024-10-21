<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_repository";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch project data from database
$sql = "SELECT * FROM projects ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $title = $row["title"];
        $supervisor = $row["supervisor"];
        $student = $row["student"];
        $file_path = $row["file_path"];
        // Add additional fields as needed
    }
} else {
    echo "No projects found.";
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printable Display of Submitted Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
        }
        .project-details {
            margin-top: 20px;
        }
        .project-details p {
            margin: 10px 0;
        }
        .btn-print {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Printable Display of Submitted Data</h2>
        <div class="project-details">
            <p><strong>Project Title:</strong> <?php echo $title; ?></p>
            <p><strong>Supervisor:</strong> <?php echo $supervisor; ?></p>
            <p><strong>Student Matric Number:</strong> <?php echo $student; ?></p>
            <p><strong>File Path:</strong> <?php echo $file_path; ?></p>
            <!-- Add additional fields as needed -->
        </div>
        <div class="btn-print">
            <button onclick="window.print()">Print</button>
        </div>
    </div>
</body>
</html>
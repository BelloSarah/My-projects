<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_repository";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT students.name AS student_name, students.matric_number, supervisors.name AS coordinator_name
        FROM assignments
        INNER JOIN students ON assignments.student_id = students.id
        INNER JOIN supervisors ON assignments.supervisor_id = supervisors.id";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students and Coordinators</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 3px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h1>View Students and Coordinators</h1>
    
    <table>
        <tr>
            <th>Student Name</th>
            <th>Matric Number</th>
            <th>Coordinator Name</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['student_name'] ?></td>
                <td><?= $row['matric_number'] ?></td>
                <td><?= $row['coordinator_name'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>

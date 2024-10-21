<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_repository";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch assigned projects data
$sql = "SELECT * FROM assigned_projects";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Projects</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Assigned Projects</h2>
    <table>
        <tr>
            <th>Student Name</th>
            <th>Student Matric Number</th>
            <th>Supervisor Name</th>
            <th>Supervisor Email</th>
            <th>Allocation Date</th>
        </tr>
        <?php
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["student_name"] . "</td>";
                echo "<td>" . $row["student_matric_number"] . "</td>";
                echo "<td>" . $row["supervisor_name"] . "</td>";
                echo "<td>" . $row["supervisor_email"] . "</td>";
                echo "<td>" . $row["allocation_date"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No assigned projects found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

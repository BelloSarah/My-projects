<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'undergraduate_project';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve projects from database
$sql = "SELECT * FROM projects";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Title: " . $row["title"]. " - File: <a href='uploads/" . $row["file_name"] . "'>" . $row["file_name"] . "</a><br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'project_repository';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have sanitized the input to prevent SQL injection
$matric = $_POST['matric'];
$password = $_POST['password'];

// Query to check if the provided matric and password match a user in the database
$sql = "SELECT * FROM users WHERE matric = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $matric, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    // Authentication successful, redirect to upload.php
    header("Location: upload_project.php");
    exit();
} else {
    // Authentication failed, redirect back to login page or display an error message
    echo "Login failed. Please check your matric number and password.";
}

$stmt->close();
$conn->close();
?>
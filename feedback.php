<?php
// Database connection parameters
$host = 'localhost'; // Change this if your database is hosted elsewhere
$username = 'root'; // Replace 'your_username' with your MySQL username
$password = ''; // Replace 'your_password' with your MySQL password
$database = 'undergraduate_project'; // Replace 'undergraduate_project' with the name of your MySQL database

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Prepare SQL statement
$sql = "INSERT INTO feedback (name, email, subject, message) VALUES (?, ?, ?, ?)";

// Prepare and bind parameters to prevent SQL injection
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $subject, $message);

// Execute the query
if ($stmt->execute() === TRUE) {
    // Redirect to thank you page
    header("Location: feedback_thank_you.php");
    exit(); // Ensure that script execution stops after redirection
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close prepared statement and database connection
$stmt->close();
$conn->close();
?>

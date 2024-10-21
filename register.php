<?php
// Database connection details
$servername = "localhost"; // Change this to your MySQL server hostname
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "project_repository"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullname = $_POST['fullname'];
    $matric = $_POST['matric'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Insert data into the database
    $sql = "INSERT INTO users (fullname, matric, email, phone, password) VALUES ('$fullname', '$matric', '$email', '$phone', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Data inserted successfully
        header("Location: login2.php");
        exit();
    } else {
        // Error inserting data
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

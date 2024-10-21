<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_repository";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are set
    if (isset($_POST['student_name'], $_POST['student_matric_number'], $_POST['supervisor'])) {
        $student_name = $_POST['student_name'];
        $student_matric_number = $_POST['student_matric_number'];
        $supervisor_id = $_POST['supervisor'];
        $allocation_date = date("Y-m-d");

        // Fetch supervisor details
        $supervisor_query = $conn->query("SELECT * FROM supervisors WHERE id = $supervisor_id");
        $supervisor_data = $supervisor_query->fetch_assoc();
        $supervisor_name = $supervisor_data['name'];
        $supervisor_email = $supervisor_data['email'];

        // Insert into assigned_projects table
        $sql = "INSERT INTO assigned_projects (student_name, student_matric_number, supervisor_name, supervisor_email, allocation_date) 
                VALUES ('$student_name', '$student_matric_number', '$supervisor_name', '$supervisor_email', '$allocation_date')";
        if ($conn->query($sql) === TRUE) {
            echo '<div class="success">Student allocated successfully.</div>';
        } else {
            echo '<div class="error">Error: ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="error">All fields are required.</div>';
    }
}

// Fetch students
$students = $conn->query("SELECT * FROM students");

// Fetch supervisors
$supervisors = $conn->query("SELECT * FROM supervisors");

$conn->close();
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_repository";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add Student Form Processing
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_student'])) {
    $name = $_POST['student_name'];
    $matric_number = $_POST['matric_number'];

    $sql = "INSERT INTO students (name, matric_number) VALUES ('$name', '$matric_number')";
    if ($conn->query($sql) === TRUE) {
        echo '<div style="color: green;">New student added successfully.</div>';
    } else {
        echo '<div style="color: red;">Error adding student: ' . $conn->error . '</div>';
    }
}

// Add Supervisor Form Processing
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_supervisor'])) {
    $name = $_POST['supervisor_name'];

    $sql = "INSERT INTO supervisors (name) VALUES ('$name')";
    if ($conn->query($sql) === TRUE) {
        echo '<div style="color: green;">New supervisor added successfully.</div>';
    } else {
        echo '<div style="color: red;">Error adding supervisor: ' . $conn->error . '</div>';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student and Supervisor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50; /* Green background color */
            color: white; /* White text color */
            text-decoration: none; /* Remove underline */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s; /* Smooth transition */
        }

        /* Change the background color on hover */
        a:hover {
            background-color: #45a049; /* Darker green */
        }
    </style>
</head>
<body>
    <h2>Add Student</h2>
    <form method="post">
        <label for="student_name">Student Name:</label>
        <input type="text" name="student_name" required>
        <label for="matric_number">Matric Number:</label>
        <input type="text" name="matric_number" required>
        <input type="submit" name="add_student" value="Add Student">
    </form>

    <h2>Add Supervisor</h2>
    <form method="post">
        <label for="supervisor_name">Supervisor Name:</label>
        <input type="text" name="supervisor_name" required>
        <input type="submit" name="add_supervisor" value="Add Supervisor">
    </form>
    <a href="allocate_coordinator.php">Allocate Student To Their Various Supervisors</a>

</body>
</html>

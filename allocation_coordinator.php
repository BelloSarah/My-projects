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
    $student_id = $_POST['student'];
    $supervisor_id = $_POST['supervisor'];

    // Check supervisor workload
    $check_workload = $conn->query("SELECT COUNT(*) as count FROM assignments WHERE supervisor_id = $supervisor_id");
    $row = $check_workload->fetch_assoc();
    if ($row['count'] < 10) {
        $sql = "INSERT INTO assignments (student_id, supervisor_id) VALUES ($student_id, $supervisor_id)";
        if ($conn->query($sql) === TRUE) {
            echo '<div class="success">Student allocated successfully.</div>';
        } else {
            echo '<div class="error">Error: ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="error">Supervisor has reached the maximum number of students.</div>';
    }
}

// Fetch students and supervisors
$students = $conn->query("SELECT * FROM students WHERE id NOT IN (SELECT student_id FROM assignments)");
$supervisors = $conn->query("SELECT * FROM supervisors");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Allocate Students to Supervisors</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        select, input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .message {
            padding: 10px;
            border-radius: 3px;
            margin-bottom: 10px;
        }
        .success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Allocate Students to Supervisors</h2>
        <form method="post">
            <label for="student">Select Student:</label>
            <select name="student" required>
                <?php while($row = $students->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?> (<?= $row['matric_number'] ?>)</option>
                <?php endwhile; ?>
            </select>
            <label for="supervisor">Select Supervisor:</label>
            <select name="supervisor" required>
                <?php while($row = $supervisors->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>
            <input type="submit" value="Allocate">
        </form>
    </div>
</body>
</html>

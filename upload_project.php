<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Project</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Navigation Bar -->
        <nav>
            <a href="home.html">Home</a>
        </nav>

        <h2>Upload Undergraduate Project</h2>
        <form action="upload_process.php" method="post" enctype="multipart/form-data">
            <input type="text" name="student_name" placeholder="Student Name" required><br><br>
            <input type="text" name="student_matric_number" placeholder="Enter Student Matric Number" required><br><br>
            <input type="text" name="project_title" placeholder="Project Title" required><br><br>
            <label for="supervisor_name">Select Supervisor:</label>
            <select name="supervisor_name" required>
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

                // Fetch supervisors
                $supervisors = $conn->query("SELECT id, name, email FROM supervisors");

                // Display supervisors as options
                if ($supervisors->num_rows > 0) {
                    while ($row = $supervisors->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . " (" . $row['email'] . ")</option>";
                    }
                } else {
                    echo "<option value=''>No supervisors available</option>";
                }

                $conn->close();
                ?>
            </select>
            <br><br>
            <input type="file" name="file" required><br><br>
            <input type="submit" name="submit" value="Upload Project">
        </form>
    </div>
</body>
</html>

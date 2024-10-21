<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printable Display of Submitted Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 100px;
        }
        h2 {
            text-align: center;
        }
        .project-details {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
        .project-details p {
            margin: 10px 0;
        }
        .btn-print {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="fuk-logo.jpg" alt="FUK Logo">
        </div>
        <h2>Department of Computer Science</h2>
        <h2>Undergraduate Project Clearance Form</h2>
        <div class="project-details">
            <p><strong>Student Name:</strong> <?php echo $_POST['student_name']; ?></p>
            <p><strong>Student Matric Number:</strong> <?php echo $_POST['student_matric_number']; ?></p>
            <p><strong>Project Title:</strong> <?php echo $_POST['project_title']; ?></p>
            <?php 
            if(isset($_POST['supervisor_name'])) {
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

                // Fetch supervisor's name based on ID
                $supervisor_id = $_POST['supervisor_name'];
                $sql = "SELECT supervisor_name FROM assigned_projects WHERE id = $supervisor_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<p><strong>Supervisor's Name:</strong> " . $row['supervisor_name'] . "</p>";
                } else {
                    echo "<p><strong>Supervisor's Name:</strong> Unknown</p>";
                }

                $conn->close();
            } else {
                echo "<p><strong>Supervisor's Name:</strong> Not specified</p>";
            }
            ?>
            <p><strong>File Name:</strong> <?php echo $_FILES['file']['name']; ?></p>
            <!-- Add additional fields as needed -->
        </div>
        <div class="container">
           <p>Student Signature/Date:_____________</p><br><br>
           <p>Supervisor's Signature/Date:_____________</p><br><br>
           <p>Departmental Supervisor's Signature/Date:_____________</p><br><br>
           
        </div>
        <div class="btn-print">
            <button onclick="window.print()">Print</button>
        </div>
    </div>
</body>
</html>

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
        input[type="text"] {
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
       <?php include 'allocation_project.php'; ?>
</head>
<body>
    <div class="container">
        <h2>Allocate Students to Supervisors</h2>
        <form method="post">
            <label for="student_name">Student Name:</label>
            <input type="text" name="student_name" required>
            <label for="student_matric_number">Matric Number:</label>
            <input type="text" name="student_matric_number" required>
            <br><br>
            <label for="supervisor">Select Supervisor:</label>
            <select name="supervisor" required>
                <?php
                // Reset the pointer of the supervisors' result set
                $supervisors->data_seek(0);
                while($row = $supervisors->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?> (<?= $row['email'] ?>)</option>
                <?php endwhile; ?>
            </select>
            <input type="submit" value="Allocate">
        </form>
    </div>

 
</body>
</html>

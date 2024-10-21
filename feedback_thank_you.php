<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thank You for Your Feedback</h2>
        <?php if (isset($_POST['name'])) : ?>
            <p>Dear <?php echo $_POST['name']; ?>,</p>
        <?php endif; ?>
        <p>We greatly appreciate your feedback. Your input is valuable to us and will help us improve our system to serve you better.</p>
        <p>Thank you once again for taking the time to provide your feedback!</p>
    </div>
</body>
</html>

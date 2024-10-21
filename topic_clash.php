<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_repository";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function resolveTopicConflict($conn, $studentID, $proposedTopic) {
    // Query to get all students' topics in the department
    $sql = "SELECT student_id, project_topic, supervisor_email FROM students";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $currentStudentID = $row['student_id'];
            $currentTopic = $row['project_topic'];
            $supervisorEmail = $row['supervisor_email'];

            if ($currentStudentID != $studentID && $currentTopic == $proposedTopic) {
                // Notify student and supervisor of topic clash
                notifyTopicClash($currentStudentID, $supervisorEmail, $proposedTopic);
                
                // Assign a new topic to the student (simplified, real implementation would involve more logic)
                $newTopic = generateNewTopic();
                assignNewTopic($conn, $currentStudentID, $newTopic);
            }
        }
    } else {
        echo "No students found in the department.";
    }
}

function notifyTopicClash($studentID, $supervisorEmail, $topic) {
    // Function to notify the student and supervisor about the topic clash
    $studentEmail = getStudentEmail($studentID);
    $subject = "Project Topic Conflict Notification";
    $message = "Dear student, \n\nYour proposed project topic '$topic' conflicts with another student's topic. Please contact your supervisor for further assistance.";
    
    // Send email to student
    mail($studentEmail, $subject, $message);

    // Send email to supervisor
    mail($supervisorEmail, $subject, $message);

    echo "Notification sent to student (ID: $studentID) and supervisor (Email: $supervisorEmail).\n";
}

function getStudentEmail($studentID) {
    // Function to retrieve student's email address (simplified)
    // In real implementation, retrieve email from database
    return "student" . $studentID . "@university.edu";
}

function generateNewTopic() {
    // Function to generate a new project topic (simplified)
    // In real implementation, more complex logic would be used
    return "New Project Topic " . rand(100, 999);
}

function assignNewTopic($conn, $studentID, $newTopic) {
    // Function to update the student's project topic in the database
    $sql = "UPDATE students SET project_topic = ? WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newTopic, $studentID);

    if ($stmt->execute()) {
        echo "New topic assigned to student (ID: $studentID): $newTopic\n";
    } else {
        echo "Error assigning new topic: " . $conn->error;
    }

    $stmt->close();
}

// Example usage
$studentID = 1;
$proposedTopic = "Machine Learning in Healthcare";

resolveTopicConflict($conn, $studentID, $proposedTopic);

$conn->close();
?>

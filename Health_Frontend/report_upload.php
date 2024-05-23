<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "123";
$database = "health_report_analyzer";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Error connecting to MySQL database: " . $conn->connect_error);
}

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["health_report"])) {
    $patient_id = $_POST['patient_id'];
    $report_type = $_POST['report_type'];
    $report_content = file_get_contents($_FILES["health_report"]["tmp_name"]);

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO health_reports (patient_id, report_type, report_content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $patient_id, $report_type, $report_content);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Health report uploaded successfully.";
    } else {
        echo "Error uploading health report: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>


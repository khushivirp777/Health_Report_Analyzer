
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = intval($_POST['age']);  // Convert age to int
    $gender = $_POST['gender'];
    $contact_info = $_POST['contact_info'];

    // Prepare SQL statement
    $sql_query = "INSERT INTO patients (name, age, gender, contact_info) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_query);

    // Check if statement preparation succeeded
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("siss", $name, $age, $gender, $contact_info);

    // Execute statement
    if ($stmt->execute()) {
        echo "Patient information added successfully.";
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate form inputs (You can add more validations as needed)
    if (empty($username) || empty($password)) {
        echo "Both username and password are required.";
    } else {
        // Connect to MySQL database (Replace 'localhost', 'username', 'password', and 'database' with your actual credentials)
        $conn = mysqli_connect("localhost", "root", "123", "health_report_analyzer");

        // Check if the connection was successful
        if ($conn) {
            // Sanitize the inputs to prevent SQL injection
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);

            // Query to check if the user exists in the database
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = mysqli_query($conn, $query);

            // Check if the query returned any rows
            if (mysqli_num_rows($result) == 1) {
                // User found, redirect to the dashboard or another page
                header("Location: patient_record.html");
                exit();
            } else {
                // User not found or incorrect credentials
                echo "Invalid username or password.";
            }

            // Close the database connection
            mysqli_close($conn);
        } else {
            // Connection error
            echo "Error: Unable to connect to the database.";
        }
    }
}
?>

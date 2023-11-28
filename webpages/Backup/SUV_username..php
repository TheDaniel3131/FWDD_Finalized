<?php
header('Content-Type: application/json');
$servername = "localhost";
$dbusername = "root"; // replace with your MySQL username
$dbpassword = ""; // replace with your MySQL password
$dbname = "MathKids"; // replace with your database name

$response = ['exists' => false];

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    $response['error'] = "Database connection error";
    echo json_encode($response);
    exit;
}

// Get the username from POST data
$username = isset($_POST['username']) ? $_POST['username'] : '';

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT Username FROM users WHERE Username = ?");
$stmt->bind_param("s", $username);

// Execute the statement
if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $response['exists'] = true; // Username exists
    }
} else {
    $response['error'] = "Error checking username";
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>

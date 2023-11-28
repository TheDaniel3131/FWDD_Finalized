<?php

header('Content-Type: application/json');

// Connection variables
$servername = "localhost";
$username = "root"; // replace with your MySQL username
$password = ""; // replace with your MySQL password
$dbname = "MathKids"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['exists' => false, 'error' => "Connection failed: " . $conn->connect_error]));
}

$email = isset($_POST['email']) ? $_POST['email'] : '';

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT * FROM users WHERE Email = ?");
$stmt->bind_param("s", $username);

// Execute the statement
$stmt->execute();

// Check if we have a result
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo json_encode(['exists' => true]);
} else {
    echo json_encode(['exists' => false]);
}

$stmt->close();
$conn->close();
?>

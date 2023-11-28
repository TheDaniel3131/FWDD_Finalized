<?php
$servername = "localhost";
$dbusername = "root"; // Replace with your MySQL username
$dbpassword = ""; // Replace with your MySQL password
$dbname = "MathKids"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: Database error");
}

// Sanitize and validate input
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$age = htmlspecialchars($_POST['age']);
$email = htmlspecialchars($_POST['email']);
$phonenumber = htmlspecialchars($_POST['phonenumber']);
$roles = htmlspecialchars($_POST['roles']);

// Check if username, email, or phone number already exists
$checkUser = $conn->prepare("SELECT Username FROM users WHERE Username = ?");
$checkUser->bind_param("s", $username);
$checkUser->execute();
if($checkUser->get_result()->num_rows > 0) {
    echo "Username already exists";
    $checkUser->close();
    $conn->close();
    exit;
}

$checkEmail = $conn->prepare("SELECT Email FROM users WHERE Email = ?");
$checkEmail->bind_param("s", $email);
$checkEmail->execute();
if($checkEmail->get_result()->num_rows > 0) {
    echo "Email already exists";
    $checkEmail->close();
    $conn->close();
    exit;
}

$checkPhone = $conn->prepare("SELECT PhoneNumber FROM users WHERE PhoneNumber = ?");
$checkPhone->bind_param("s", $phonenumber);
$checkPhone->execute();
if($checkPhone->get_result()->num_rows > 0) {
    echo "Phone number already exists";
    $checkPhone->close();
    $conn->close();
    exit;
}

// Additional validations can be added here

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the new user
$insertUser = $conn->prepare("INSERT INTO users (Username, Password, Age, Email, PhoneNumber, Roles) VALUES (?, ?, ?, ?, ?, ?)");
$insertUser->bind_param("ssisss", $username, $hashed_password, $age, $email, $phonenumber, $roles);

if ($insertUser->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $insertUser->error;
}

$insertUser->close();
$conn->close();
?>

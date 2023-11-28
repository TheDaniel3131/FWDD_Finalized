<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MathKids";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the attempt counter
if (!isset($_SESSION['attempt'])) {
    $_SESSION['attempt'] = 0;
}

// Function to check if a field is set and not empty
function isFieldValid($field) {
    return isset($field) && trim($field) !== '';
}

// Collect POST data and validate
$lesson_id = $_POST["lesson"] ?? '';
$question_text = $_POST["question_text"] ?? '';
$option_a = $_POST["option_a"] ?? '';
$option_b = $_POST["option_b"] ?? '';
$option_c = $_POST["option_c"] ?? '';
$option_d = $_POST["option_d"] ?? '';
$question_mark = $_POST["question_mark"] ?? '';
$correct_answer = $_POST["correct_answer"] ?? '';
$category = $_POST["category"] ?? '';

$allFields = [$lesson_id, $question_text, $option_a, $option_b, $option_c, $option_d, $question_mark, $correct_answer, $category];

// Check if all fields are valid
foreach ($allFields as $field) {
    if (!isFieldValid($field)) {
        $_SESSION['attempt']++;

        if ($_SESSION['attempt'] < 5) {
            echo "<script>alert('All fields are required. Attempt: ".$_SESSION['attempt']."'); window.location.href='addquestion.php';</script>";
        } else {
            $_SESSION['attempt'] = 0;
            echo "<script>alert('Maximum attempts reached. Redirecting to home.'); window.location.href='home.html';</script>";
        }
        exit();
    }
}

// Reset attempt counter on successful validation
$_SESSION['attempt'] = 0;

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO exercises (LessonID, question_text, option_a, option_b, option_c, option_d, correct_answer, question_mark, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind and execute
$stmt->bind_param("issssssis", $lesson_id, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_answer, $question_mark, $category);

try {
    $stmt->execute();
    echo "<script>alert('Question added successfully.');window.location.href='addquestion.php';</script>";
} catch (mysqli_sql_exception $exception) {
    error_log($exception->getMessage());
    echo "An error occurred while inserting the data.";
    exit;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

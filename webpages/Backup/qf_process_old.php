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

// Trim and store POST data
$lesson_id = trim($_POST["lesson"] ?? '');
$question_text = trim($_POST["question_text"] ?? '');
$option_a = trim($_POST["option_a"] ?? '');
$option_b = trim($_POST["option_b"] ?? '');
$option_c = trim($_POST["option_c"] ?? '');
$option_d = trim($_POST["option_d"] ?? '');
$question_mark = trim($_POST["question_mark"] ?? '');
$correct_answer = trim($_POST["correct_answer"] ?? '');
$category = trim($_POST["category"] ?? '');

// Validate the question and options
if (!isset($question_text) || $question_text === '' || 
    !isset($option_a) || $option_a === '' || 
    !isset($option_b) || $option_b === '' || 
    !isset($option_c) || $option_c === '' || 
    !isset($option_d) || $option_d === '' || 
    !isset($correct_answer) || $correct_answer === '' || 
    !isset($lesson_id) || $lesson_id === '' || 
    !isset($question_mark) || $question_mark === '' || 
    !isset($category) || $category === '') {
    $_SESSION['attempt']++;

}

if (empty($question_text) || empty($option_a) || empty($option_b) || empty($option_c) || empty($option_d) || empty($correct_answer) || empty($lesson_id) || empty($question_mark) || empty($category)) {
    $_SESSION['attempt']++;

    if ($_SESSION['attempt'] < 5) {
        // Show a popup message and stay on the same page
        echo "<script>alert('All fields are required. Attempt: ".$_SESSION['attempt']."'); window.location.href='addquestion.php';</script>";
    } else {
        // Reset attempt counter and redirect after 5 failed attempts
        $_SESSION['attempt'] = 0;
        echo "<script>alert('Maximum attempts reached. Redirecting to home.'); window.location.href='home.html';</script>";
    }
    exit();
}

// Prepare the SQL statement (adjust your column names as necessary)
$stmt = $conn->prepare("INSERT INTO exercises (LessonID, question_text, option_a, option_b, option_c, option_d, correct_answer, question_mark, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind the parameters to the statement (ensure the types of parameters are correct, e.g., 'i' for integer, 's' for string)
$stmt->bind_param("issssssis", $lesson_id, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_answer, $question_mark, $category);


// Execute
try {
    $stmt->execute();
} catch (mysqli_sql_exception $exception) {
    error_log($exception->getMessage());
    echo "An error occurred while inserting the data: " . $exception->getMessage();
    // Optionally output the bound parameters for debugging
    var_dump($lesson_id, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_answer, $question_mark, $category);
    exit;
}


// Close the statement and connection
$stmt->close();
$conn->close();

// Reset attempts on successful submission
$_SESSION['attempt'] = 0;

// Redirect to the addquestion page with a successful popup message
echo "<script>alert('Question added successfully.');window.location.href='addquestion.php';</script>";
exit();
?>

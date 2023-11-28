<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exercisedb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT question_text, option_a, option_b, option_c, option_d, correct_answer 
        FROM exercises 
        WHERE lessonID = '1' 
        ORDER BY RAND() 
        LIMIT 10";
$result = $conn->query($sql);
$questions = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();

echo json_encode($questions);
?>

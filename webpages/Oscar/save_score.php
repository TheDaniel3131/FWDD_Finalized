<?php
// save_score.php

// Your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exercisedb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the percentage score from the POST request
$data = json_decode(file_get_contents("php://input"), true);
$percentageScore = $data['percentageScore'];
$lessonID = $data['lessonID'];
$userID = $data['userID'];


// Prepare and execute the SQL statement to insert the percentage score
$sql = "INSERT INTO leaderboard (UserID, Score, LessonID) VALUES ('$userID','$percentageScore', '$lessonID')";


if (mysqli_query($conn, $sql)) {
    echo "Percentage score inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

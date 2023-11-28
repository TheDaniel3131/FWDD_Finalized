<?php
// Database connection code
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

$comment_id = $_GET['comment_id'] ?? null;

if ($comment_id) {
    // Delete the comment from the database
    $sql = "DELETE FROM comments WHERE CommentID = $comment_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: discussion.php"); // Redirect back to the discussion page
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No comment ID provided";
}

$conn->close();
?>

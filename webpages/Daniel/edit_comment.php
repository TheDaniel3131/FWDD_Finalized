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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update the comment in the database
    $comment = $_POST['comment'];

    $sql = "UPDATE comments SET User_comment = '$comment' WHERE CommentID = $comment_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: discussion.php"); // Redirect back to the discussion page
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Fetch the comment to edit
    $sql = "SELECT User_comment FROM comments WHERE CommentID = $comment_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $comment = $row['User_comment'];
    } else {
        echo "No such comment found";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Comment</title>
</head>
<body>
    <form method="post">
        <textarea name="comment"><?php echo htmlspecialchars($comment); ?></textarea>
        <button type="submit">Update Comment</button>
    </form>
</body>
</html>

<?php
// Database connection code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MathKids";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}       

$comments = [];

$sql = "SELECT c.CommentID, c.User_comment, c.DiscussionID, u.Username 
        FROM comments c 
        JOIN users u ON c.UserID = u.UserID";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $comment = [
            'id' => $row['CommentID'],
            'user' => [
                'name' => $row['Username'], // Fetching the username
            ],
            'comment' => $row['User_comment'],
        ];
        array_push($comments, $comment);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username from the form submission
    $username = $_POST['username'];

    // Fetch the UserID based on the Username
    $userid_query = $conn->prepare("SELECT UserID FROM users WHERE Username = ?");
    $userid_query->bind_param("s", $username);
    $userid_query->execute();
    $userid_result = $userid_query->get_result();

    if ($userid_result->num_rows > 0) {
        $row = $userid_result->fetch_assoc();
        $userid = $row['UserID'];

        $comment = $_POST['comment'];

        // Insert the comment into the database using UserID
        $insert_sql = $conn->prepare("INSERT INTO comments (UserID, User_comment) VALUES (?, ?)");
        $insert_sql->bind_param("is", $userid, $comment);
        
        if ($insert_sql->execute()) {
            // Since we're not using PHP sessions, we can't use $_SESSION to pass messages
            // You might want to handle this another way, perhaps with a query parameter on redirect
            // For now, we'll just skip setting a success message
        } else {
            // Handle error
            echo "Error: " . $conn->error;
        }
    } else {
        // Handle error: user not found
        echo "User not found";
    }

    // Redirect back to the discussion page
    header("Location: discussion.php"); // Comment this out if you want to see the error messages
}


// Close the connection after processing
$conn->close();
?>
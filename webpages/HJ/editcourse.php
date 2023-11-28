<?php
include ("nav_afterlogin.php")
?>
<?php
$conn = mysqli_connect("localhost", "root", "", "fwdd");

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseID = $_POST['course_id'];
    $newCourseTitle = $_POST['new_course_title'];
    $newDescription = $_POST['new_description'];
    

    $stmt = $conn->prepare("UPDATE course SET CourseTitle = ?, Description = ? WHERE CourseID = ?");
    $stmt->bind_param("ssi", $newCourseTitle, $newDescription, $courseID);

    if ($stmt->execute()) {
        echo "<script>alert('Course updated successfully!'); window.location = 'course2.php';</script>";
    } else {
        echo "<script>alert('Failed to update course. Please try again.');</script>";
    }

    $stmt->close();
}

if (isset($_GET['course_id'])) {
    $courseID = $_GET['course_id'];
    $query = "SELECT * FROM course WHERE CourseID = $courseID";
    $result = mysqli_query($conn, $query);
    $course = mysqli_fetch_assoc($result);
} else {
    // Redirect if course ID is not provided
    header("Location: course2.php");
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <link href="course.css" rel="stylesheet" type="text/css">
    <style>
        input[type="text"] {
            width: 30%;
            height: 3%;
            border: 1px;
            border-radius: 5px;
            padding: 8px 15px;
            margin: 10px 0 15px 0;
            box-shadow: 1px 1px 2px 1px grey;
        }

        input[type="file"] {
            width: 30%;
            border: 1px;
            border-radius: 5px;
            padding: 8px 15px;
            margin: 10px 0 15px 0;
            box-shadow: 1px 1px 2px 1px grey;
        }

        textarea {
            width: 30%;
            height: 100px;
            border: 1px;
            border-radius: 5px;
            padding: 8px 15px;
            margin: 10px 0 15px 0;
            box-shadow: 1px 1px 2px 1px grey;
        }

        input[type="submit"] {
            padding: 10px 15px;
            font-size: 18px;
            font-weight: bold;
            background-color: #39d0a8;
            color: white;
            border: none;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            width: auto;
        }

        input[type="submit"]:hover {
            background-color: #85E6C5;
            width: auto;
        }

        form {
            text-align: left;
            width: 50%;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 8px 15px;
            margin-bottom: 15px;
            box-shadow: 1px 1px 2px 1px grey;
            box-sizing: border-box; /* Include padding and border in the box's total width and height */
        }

        input[type="submit"]:hover {
            background-color: #85E6C5;
        }
    </style>
</head>
<body>
    <div id="secwrapper">
        <h1>Edit Course:</h1><br>
        <center>
            <form action="editcourse.php" method="post">
                <input type="hidden" name="course_id" value="<?php echo $course['CourseID']; ?>">
                <label for="new_course_title">New Course Title:</label>
                <input type="text" id="new_course_title" name="new_course_title" value="<?php echo $course['CourseTitle']; ?>" required/><br />
                <label for="new_description">New Description:</label>
                <textarea id="new_description" name="new_description" style="resize: vertical;" required><?php echo $course['Description']; ?></textarea><br />
                <input type="submit" value="Update Course" />
            </form>
        </center>
    </div>

    <script>
        function viewCourseDetails(url) {
        window.location.href = url;
        }
    </script>
</body>
</html>

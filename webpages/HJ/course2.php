<?php
include ("nav_afterlogin.php")
?>
<?php
$conn = mysqli_connect("localhost", "root", "", "MathKids
");

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_course'])) {
        $CourseID = $_POST['delete_course'];

        $stmt = $conn->prepare("DELETE FROM course WHERE CourseID = ?");
        $stmt->bind_param("i", $CourseID);

        if ($stmt->execute()) {
            // Redirect to the same page without the delete_course parameter
            header("Location: course2.php");
            exit(); // Ensure that no other code is executed after the redirect
        } else {
            echo "<script>alert('Failed to delete course. Please try again.');</script>";
        }
        $stmt->close();
    }
}

$query = "SELECT * FROM course";
$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses Page</title>
    <link href="course.css" rel="stylesheet" type="text/css">
</head>

<body>
    <aside class="sidebar" id="sidebar">
        <button class="course-toggle" onclick="toggleCourseDropdown()">Courses</button>
        <div class="course-dropdown" id="course-dropdown">
            <ul>
            <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <li><a href="#"><?php echo $row['CourseTitle']; ?></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
        <button class="add-course-btn" onclick="location.href='addcourse.php'">Add Course</button>
    </aside>
    <div id="secwrapper">
        <h1>Our Courses:</h1><br>
        <section>
        <?php
            // Reset result pointer to the beginning
            mysqli_data_seek($result, 0);

            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <article>
                    <a href="#"><img src="<?php echo $row['CourseImage']; ?>" alt="Course Image"></a>
                    <h1><?php echo $row['CourseTitle']; ?></h1>
                    <p><?php echo $row['Description']; ?></p>
                    <a href="#" class="readmore">Read more</a>
                    <button class="edit-btn" onclick="editCourse(<?php echo $row['CourseID']; ?>)">Edit</button>
                    <button class="delete-btn" onclick="deleteCourse(<?php echo $row['CourseID']; ?>)">Delete</button>
                </article>
            <?php
            }
            ?>
        </section>
    </div>
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            if (sidebar.style.left === "0px" || sidebar.style.left === "") {
                sidebar.style.left = "-250px";
            } else {
                sidebar.style.left = "0px";
            }
        }

        function toggleCourseDropdown() {
            const courseDropdown = document.getElementById("course-dropdown");
            if (courseDropdown.style.display === "block" || courseDropdown.style.display === "") {
                courseDropdown.style.display = "none";
            } else {
                courseDropdown.style.display = "block";
            }
        }

        function viewCourseDetails(url) {
            window.location.href = url;
        }

        function deleteCourse(CourseID) {
        if (confirm("Are you sure you want to delete this course?")) {
        // Create a form dynamically
        var form = document.createElement('form');
        form.method = 'post';
        form.action = 'course2.php'; // The same page

        // Create an input element to hold the CourseID
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'delete_course';
        input.value = CourseID;

        // Append the input to the form
        form.appendChild(input);

        // Append the form to the body and submit it
        document.body.appendChild(form);
        form.submit();
        }
    }
    function editCourse(courseID) {
        // Redirect to editcourse.php with the course ID
        location.href = 'editcourse.php?course_id=' + courseID;
    }

    </script>
</body>
</html>
<?php
mysqli_close($conn);
?>

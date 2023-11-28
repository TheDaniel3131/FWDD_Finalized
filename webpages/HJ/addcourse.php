<?php
include ("nav_afterlogin.php")
?>
<?php
$conn = mysqli_connect("localhost", "root", "", "fwdd");

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
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
            width: 10%;
            padding: 10px 15px;
            font-size: 18px;
            font-weight: bold;
            background-color: #39d0a8;
            color: white;
            border: none;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #85E6C5;
        }
    </style>
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
    </aside>
    <div id="secwrapper">
        <h1>Fill up the form to add a new course:</h1><br>
        <center>
            <form action="connect.php" method="post" enctype="multipart/form-data"> <!--Your Connection -->
                <input type="text" id="CourseTitle" name="CourseTitle" placeholder="Enter Course Title:" required/><br />
                <textarea id="Description" name="Description" placeholder="Enter Course Description:" style="resize: vertical;" required></textarea><br />
                <input type="file" id="CourseImage" name="CourseImage" accept=".jpg, .png, .jpeg" required/> <!-- Image upload button -->
                <br/>
                <br>
                <input type="submit" name="upload" value="Add Course" />
                <br><br>
            </form>
        </center>
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
    </script>
</body>
</html>

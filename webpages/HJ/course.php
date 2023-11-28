<?php
include ("nav_afterlogin.php")
?>
<?php
$conn = mysqli_connect("localhost", "root", "", "MathKids");

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
    </script>
</body>
</html>
<?php
mysqli_close($conn);
?>
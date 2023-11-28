<?php
include ("nav_afterlogin.php")
?>
<?php
$conn = mysqli_connect("localhost", "root", "", "fwdd");

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventName = $_POST['event_name'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $eventDesc = $_POST['event_desc'];

    // Handle file upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["event_image"]["name"]);
    move_uploaded_file($_FILES["event_image"]["tmp_name"], $targetFile);

    $query = "INSERT INTO events (EventName, StartDate, EndDate, EventDesc, Image) 
              VALUES ('$eventName', '$startDate', '$endDate', '$eventDesc', '$targetFile')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Event added successfully!'); window.location = 'addevent.php';</script>";
    } else {
        echo "<script>alert('Failed to add event. Please try again.');</script>";
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Events Page</title>
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
    </style>
</head>

<body>
    <div id="secwrapper">
        <h1>Fill up the form to create an event:</h1><br>
        <center>
            <form action="addevent.php" method="post" enctype="multipart/form-data"> <!--Your Connection -->
                <label for="event_name">Event Name:</label>
                <input type="text" id="event_name" name="event_name" placeholder="Enter Event Name:" required/><br />
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required><br>
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required><br>
                <label for="event_desc">Event Description:</label>
                <textarea id="event_desc" name="event_desc" placeholder="Enter Event Description:" style="resize: vertical;" required></textarea><br />
                <label for="event_image">Event Image:</label>
                <input type="file" id="event_image" name="event_image" accept=".jpg, .png, .jpeg" required/> <!-- Image upload button -->
                <br/>
                <br>
                <input type="submit" value="Create Event" />
                <br><br>
            </form>
        </center>
        </section>
    </div>

    <script>


        function viewCourseDetails(url) {
            window.location.href = url;
        }
    </script>
</body>
</html>

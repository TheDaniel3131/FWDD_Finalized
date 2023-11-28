<!DOCTYPE HTML>
<?php
include("nav_afterlogin.php");
?>
<html>
    <head>
        <title>Event Page</title>
        <link rel="stylesheet" href="event.css" />
        <style>
        /* Additional CSS styles for enhancing the layout */
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .event {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        img{
            display: block;
            max-width: 10px;
            width: 600px;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
            align-items: center;
            margin-left: auto; /* Center the image horizontally */
            margin-right: auto;
        }
        .event img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        p{
            text-align: center;
        }
        
        .event p {
            margin-bottom: 8px;
            margin-left: auto; /* Center the image horizontally */
            margin-right: auto;
            align-items: center;
        }
        .event .details {
            display: none; /* Hide event details by default */
            margin-left: auto; /* Center the image horizontally */
            margin-right: auto;
        }
        .event .show-details {
            cursor: pointer;
            color: blue;
        }

        .show-details-btn {
            padding: 8px 16px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 10px; /* Makes the button round */
            cursor: pointer;
            text-decoration: none;
            display: block;
            margin-left: auto; /* Center the image horizontally */
            margin-right: auto;
        }

    </style>
    </head>
    <body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = '';
        $dbname = "MathKids";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT EventID, EventName, StartDate, EndDate, EventDesc, Image FROM events";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<div class='event'>";
                echo "<h2>" . $row["EventName"] . "</h2>";
                $imagePath = "images/" . $row["Image"];
                echo "<img src='$imagePath' />";
                echo "<p><strong>Start Date:</strong> " . $row["StartDate"] . "</p>";
                echo "<p><strong>End Date:</strong> " . $row["EndDate"] . "</p>";
                echo "<button class='show-details-btn' onclick='redirectToDetailPage(" . $row["EventID"] . ")'>Show Details</button>";
                echo "</div>";
            }
        } else {
            echo "No events found";
        }
        $conn->close();
    ?>


    <script>
        // JavaScript for toggling event details visibility
        function redirectToDetailPage(eventID) {
        window.location.href = 'detailPage.php?eventID=' + eventID;
    }
    </script>
    </body>
</html>
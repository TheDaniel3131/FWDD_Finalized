<!DOCTYPE HTML>
<?php
include("nav_afterlogin.php");
?>
<html>
<head>
    <title>Event Details</title>
    <style>
        /* CSS styles to center content */
        
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 600px;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        h2{
            text-align: center;
        }

        p{
            text-align: center;
        }

        img {
            display: block;
            max-width: 100%;
            width: 1000px;
            height: 500px;
            border-radius: 5px;
            margin-bottom: 10px;
            margin-left: auto; /* Center the image horizontally */
            margin-right: auto;
        }

        .content img {
            display: block;
            max-width: 100%; /* Adjust the maximum width of the image */
            height: auto;
            width: 400px;
            border-radius: 5px;
            margin-bottom: 10px;
            margin-left: auto; /* Center the image horizontally */
            margin-right: auto;
        }

        .content p {
            margin-bottom: 8px;
        }

        .end-date {
            margin-bottom: 20px; /* Add more margin between "End Date" and "Description" */
        }

    </style>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mathkids";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['eventID'])) {
        $eventID = $_GET['eventID'];

        $sql = "SELECT EventName, StartDate, EndDate, EventDesc, Image FROM events WHERE EventID = $eventID";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<div class='event-details'>";
            echo "<br><h2>" . $row["EventName"] . "</h2><br>";
            echo "<img src='images/" . $row["Image"] . "' />";
            echo "<br><p><strong>Start Date:</strong> " . $row["StartDate"] . "</p>";
            echo "<p class='end-date'><strong>End Date :</strong> " . $row["EndDate"] . "</p>";
            echo "<p><strong>Description:</strong> " . $row["EventDesc"] . "</p><br>";
            $targetURL = 'https://docs.google.com/forms/d/e/1FAIpQLSeAfSima-Rk9ZLhClOaGjZVHd8XuxInApcVf07Q9U2nv2rdaA/viewform';
            $qrCodeURL = 'https://quickchart.io/qr?text=' . urlencode($targetURL);
            echo "<p><strong>Scan below to register:</strong> " . "</p>";
            echo "<img src='" . $qrCodeURL . "' alt='QR Code' class='QR' style='width: 200px; height: 200px;' />";
            echo "</div>";
        } else {
            echo "Event not found";
        }
    } else {
        echo "No event ID specified";
    }

    $conn->close();
    ?>
</body>
</html>

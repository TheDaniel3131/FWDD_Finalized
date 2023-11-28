<?php 
    // error_log("Session ID: " . session_id());
    // error_log("Session Username: " . (isset($_SESSION['username']) ? $_SESSION['username'] : 'Not set'));
    include 'nav_afterlogin.php';

    // Create connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "MathKids";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle delete request
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['question_id'])) {
        $delete_id = $_GET['question_id'];
        $delete_query = "DELETE FROM exercises WHERE question_id = $delete_id";
        if ($conn->query($delete_query) === TRUE) {
            echo "<script>alert('Question deleted successfully');</script>";
        } else {
            echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
        }
    }

    // Fetch lessons from the database
    $lessons = [];
    $lesson_query = "SELECT LessonID, LessonName, LessonDescription FROM lessons"; // Replace 'lessons' with your actual table name and columns
    $result = $conn->query($lesson_query);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $lessons[] = $row;
        }
    }
 ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Import CSS -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
        <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=Rubik&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Work+Sans:wght@600;900&display=swap");            
        *,
        *::before,
        *::after {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 16px;
            min-height: 100%;
        }


        body {
            background-color: #f0f0f0;
            background-image: url("images/bg_d.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            /* padding-top: 60px; */
            margin: 0;
            padding: 0;
        }

        header {
            font-weight: 900;
            background-color: #333;
            color: white;
            padding: 10px;
            display: flex;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            justify-content: space-between;
            align-items: center; 
            text-align: center;
            /* margin-top: 150px; */
        
        }

        .header h2 {
            font-weight: bold;
            font-size: 25px; /* Adjust the size as needed */
            letter-spacing: 3px;
            color: #fff;
            margin-right: 150px; /* Remove default margin to ensure proper centering */
            text-align: center;
            jsutify-content: space-between;
            align-items: center;
        }

        h2 {
            font-weight: 750;
            color: #fff;
            /* margin-bottom: 1rem; */
        }

        .form-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
            margin: 20px auto;
            position: relative;
            font-family: 'Poppins', sans-serif;
            font-weight: 750;
            margin: 60px auto 15px; /* Adjusted margin to avoid overlap with header */
            transition: box-shadow 0.3s ease-in-out;            
            margin-bottom: 100px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: stretch; /* Adjusted for better form alignment */
        }

        form:hover {
            /* transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);   */
        }

        label {
            margin-bottom: 0.5rem;
            color: #333;
            font-size: 1rem;
        }

        input[type="text"],
        select {
            width: calc(100% - -5px); /* Adjust width to account for padding */
            padding: 10px;
            margin-bottom: 1rem;
            border-radius: 15px;
            border: 1px solid #c2c2c2;
            font-size: 0.9rem;
        }

        input[type="number"], input[type="text"], select {
            width: calc(100% - 20px); /* Adjusted width */
            padding: 10px;
            margin-bottom: 1rem;
            border-radius: 15px;
            border: 1px solid #c2c2c2;
            font-size: 0.9rem;
            -webkit-appearance: none; /* Removes default styling from WebKit browsers */
            -moz-appearance: none;    /* Removes default styling from Firefox browsers */
            appearance: none;         /* Removes default styling from modern browsers */
        }

        input[type="submit"] {
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #007bff; /* Change to a more vibrant color */
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            font-family: 'Poppins', sans-serif;
            font-weight: 950;
            letter-spacing: 3px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3; /* Darker shade on hover */
            transform: translateY(-2px); /* Slight raise effect on hover */
        }

        .questions-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            font-family: 'Poppins', sans-serif;
        }

        .questions-container h2 {
            color: black; /* Set the color to black */
            font-weight: bold; /* Make the text bold */
            font-size: 1.5rem; /* Optional: Adjust the font size as needed */
            margin-bottom: 1rem; /* Optional: Add some margin for spacing */
        }

        .question {
            border-bottom: 1px solid #e0e0e0;
            padding: 10px 0;
        }

        .question:last-child {
            border-bottom: none;
        }

        .question p {
            margin: 5px 0;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            nav ul {
                padding: 0;
                margin: 0;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
            }

            nav li {
                padding: 5px;
                flex: 1 1 auto; /* Adjust basis to auto and allow flexibility */
            }

            nav li a {
                font-size: 0.8rem; /* Reduce font size */
            }

            .login-button {
                min-width: 80px; /* Set a minimum width */
                padding: 5px 10px; /* Reduce padding */
                font-size: 0.8rem; /* Optionally reduce font size */
            }
            
            .form-container {
                margin: 20px 20px; /* Reduced side margins */
                padding: 1rem;
                max-width: calc(100% - 40px); /* Full width minus margin */
            }

            .header h2 {
                font-size: 18px; /* Slightly smaller font size for header */
                margin: 0 auto; /* Center header title */
            }

             .header {
                padding-top: 75px;
                margin-top: 0px;
            }

            input[type="text"],
            select,
            input[type="submit"] {
                width: 100%; /* Full width inputs */
                padding: 10px; /* Consistent padding */
                margin-bottom: 1rem; /* Consistent margin-bottom */
                font-size: 0.9rem; /* Adjust font size if necessary */
            }

            .questions-container {
                max-width: calc(100% - 40px); /* Full width minus margin */
                margin: 20px 20px; /* Consistent margin */
                padding: 1rem; /* Consistent padding */
            }

            .questions-container h2 {
                font-size: 1.2rem; /* Smaller font size for questions header */
            }
            
            .menu-icon {
                display: block; /* Show menu icon */
                position: fixed; /* Fix position on the screen */
                top: 10px; /* Align with the top of the nav bar */
                right: 15px; /* Move the icon to the left */
                z-index: 1001; /* Ensure it's above the nav bar */
            
                
            }

            .nav_links {
                /* Initially hide the links by default */
                display: none;
                flex-direction: column;
                position: flex; /* Fix position so it doesn't push content down */
                top: 60px; /* Adjust this value to the height of your fixed header */
                left: 0;
                background-color: #33BBC5;
                width: 100%;
                align-items: center;
                z-index: 1000; /* Ensure it's below the menu icon */
                border-radius: 0px;
            }

            .nav_links.active {
                display: flex; /* Show the links when active */
            }

            .nav_links a {
                font-size: 18px;
                padding: 10px 0;
                display: block; /* Ensures links take full width */
            }

            .logo {
                padding: 0 20px; /* Adjust padding for smaller screens */
                font-size: 30px; /* Smaller font size for the logo */
                line-height: normal; /* Adjust line height for smaller logo */
            }

            .menu-icon {
                /* ... */
                position: fixed; /* Keeps the menu icon fixed */
                /* ... */
            }

            .Nav-bar {
                display: flex;
                background-color: #33BBC5;
                max-height: 100px;
                max-width: 100%;
                width: 100%;
                position: fixed;
                align-items: center;
                /* position: fixed; Added to fix the nav bar at the top */
                top: 0;
                left: 0;
                right: 0; /* Ensures the nav bar spans the entire width */
                z-index: 1; /* Keeps the nav bar above other content */    
            }
        }
        </style>
        <script>
            window.addEventListener('DOMContentLoaded', (event) => {
                const role = localStorage.getItem('role');
                if (role !== 'teacher') {
                    alert('Access denied. This page is only for teachers.');
                    window.location.href = '\\Testing\\Project-main\\webpages\\MathKids\\index.php'; // Redirect them to a different page
                }
            });
        </script>
        <title>Add Question | MathKids</title>
    </head>
    <body>
        <header class="header">
            <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Questions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
        </header>
        <div class="form-container">
        <form method="post" action="qf_process.php">
            <!-- Dropdown to select the lesson -->
            <label for="lesson">Lesson Number:</label>
            <select id="lesson" name="lesson">
                <?php foreach ($lessons as $lesson): ?>
                    <option value="<?php echo htmlspecialchars($lesson['LessonID']); ?>">
                        <?php echo htmlspecialchars($lesson['LessonName']); ?>
                    </option>
                <?php endforeach; ?>
            </select>            
            <label for="question_text">Exercise Question</label>
            
            <input type="text" id="question_text" name="question_text" value="<?php echo isset($question_text) ? $question_text : ''; ?>" />

            <label for="option_a">Option A</label>
            <input type="text" id="option_a" name="option_a" />

            <label for="option_b">Option B</label>
            <input type="text" id="option_b" name="option_b" />

            <label for="option_c">Option C</label>
            <input type="text" id="option_c" name="option_c" />

            <label for="option_d">Option D</label>
            <input type="text" id="option_d" name="option_d" />

            <label for="question_mark">Question Mark</label>
            <input type="number" id="question_mark" name="question_mark" />

            <label for="correct_answer">Correct Answer</label>
            <select id="correct_answer" name="correct_answer">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>

            <label for="category">Category</label>
            <input type="text" id="category" name="category" />

             <br>
             <input type="submit" value="Submit"/>
        </form>
        </div>

         <!-- Section for displaying questions -->
        <div class="questions-container">
            <h2>Submitted Questions</h2>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "MathKids";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM exercises"; // adjust the query as needed
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='question'>";
                    echo "<p>LessonID / Exercise ID: " . $row["LessonID"] . "</p>"; // Displaying the Exercise ID
                    echo "<p>Question ID: " . $row["question_id"] . "</p>";
                    echo "<p>Question: " . $row["question_text"]. "</p>";
                    echo "<p>Options: A) " . $row["option_a"] . " B) " . $row["option_b"];
                    echo " C) " . $row["option_c"] . " D) " . $row["option_d"] . "</p>";
                    echo "<p>Question Mark: " . $row["question_mark"]. "</p>";
                    echo "<p>Category: " . $row["category"]. "</p>";
                    echo "<p>Correct Answer: " . $row["correct_answer"] . "</p>";
                    echo "<a href='addquestion.php?action=delete&question_id=" . $row["question_id"] . "' onclick='return confirm(\"Are you sure you want to delete this question?\");'>Delete</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No questions found.</p>";
            }

            $conn->close();
            ?>
        </div>
    </body>
    </html>

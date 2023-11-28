<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="nav.css" rel="stylesheet" type="text/css">
</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=Rubik&display=swap");
    @import url('https://fonts.googleapis.com/css2?family=Work+Sans:wght@600;900&display=swap');

    * {
        padding: 0;
        margin: 0;
        text-decoration: none;
        list-style: none;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', 'Work Sans', sans-serif;
    }

    html, body {
        overflow-x: hidden;
    }

    .Nav-bar {
        display: flex;
        background-color: #33BBC5;
        max-height: 100px;
        max-width: 100%;
        width: 100%;
        align-items: center;
        /* position: fixed; Added to fix the nav bar at the top */
        top: 0;
        left: 0;
        right: 0; /* Ensures the nav bar spans the entire width */
        z-index: 1; /* Keeps the nav bar above other content */    
    }

    .nav_links {
        list-style: none;
        display: flex;
        padding: 0 20px;
        justify-content: flex-end;
        align-items: center;
        flex-grow: 1;
    }

    .nav_links a {
        font-size: 22px;
        font-weight: 800;
        padding: 10px 20px;
        letter-spacing: 1.5px;
        text-decoration: none;
        color: white;
        transition: font-size 0.3131s ease-in-out, transform 0.3131s ease-in-out;
    }

    .nav_links a:hover {
        font-size: 25px;
        font-weight: 1000;
        background-color: #85E6C5;
        border-radius: 5px;
        transform: scale(1.31);
    }

    .dropdown {
        position: relative;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #33BBC5;
        min-width: 160px;
        max-width: 191px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 9999;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown-content ul {
        list-style: none;
        padding: 0;
    }

    .dropdown-content li {
        padding: 10px;
        text-align: center;
    }

    .dropdown-content a {
        color: white;
        text-decoration: none;
    }

    .dropdown-content a:hover {
        background-color: #85E6C5;
        border-radius: 5px;
    }

    /* Styling for the menu icon */
    .menu-icon {
        display: none;
        font-size: 30px;
        cursor: pointer;
        color: white;
    }   

    .logo {
        color: white;
        font-family: 'Work Sans', sans-serif;
        font-size: 50px;
        font-weight: 750;
        background: -webkit-linear-gradient(-45deg, #f7f9ff, #d4e0f8);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 100px;
        padding: 0 50px;
        margin-right: auto;
    }

    .logo:hover {
        transition: background 2.5s ease-in-out;
        background: -webkit-linear-gradient(-45deg, #d7e8f2, #ffffff);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Style for the Login button */
    .login-button {
        background-color: #007bff; /* Blue background */
        color: white;             /* White text */
        width: 200px; 
        padding: 10px 30px;       /* Increased padding for longer button */
        text-align: center;       /* Center the text inside */
        text-decoration: none;    /* Remove underline from the text */
        display: inline-block;    /* Allow setting padding and margins */
        font-size: 16px;          /* Size of the font */
        margin: 4px 2px;          /* Margin around the button */
        transition-duration: 0.2s;/* Time for the hover effect transition */
        transition: all 0.2 ease;
        cursor: pointer;          /* Change cursor to pointer on hover */
        border: none;             /* Remove any default border */
        border-radius: 25px;       /* Rounded corners */
    }

    /* Move nav links to the left when the Login button is hovered */
    .login-button:hover + .nav_links {
        transform: translateX(-10px); /* Adjust the value as needed */
        transition: transform 0.2s ease;
    }

    /* Specific hover effect for the Login button */
    .nav_links .login-button:hover {
        background-color: #0056b3; /* Darker shade of blue on hover */
        border-radius: 35px;       /* Rounded corners */
        transform: scale(1.05);    /* Slightly zoom out */
    }
    /* Media query for screens with a maximum width of 1278 pixels */
    @media (max-width: 1278px) {
        .nav_links {
            position: fixed; /* Fix the position to the right */
            top: 20px; /* Position it higher on the page */
            right: 0; /* Align to the right side */
            display: flex;
            cursor: pointer;
            flex-direction: column;
            justify-content: center; /* Center links vertically */
            align-items: center; /* Center items horizontally */
            background-color: #114b92; /* Modern dark background color */
            padding: 10px; /* Adjust padding as needed */
            border-radius: 25px; /* Rounded corners on the left side */
            width: 250px; /* Set a fixed width */
            z-index: 1000; /* Ensure it's above other content */
        }

        .nav_links a, .nav_links .login-button {
            color: white; /* Light text color for contrast */
            padding: 8px 12px; /* Padding for each link */
            margin: 5px 0; /* Space between links */
            text-align: center; /* Centralize text */
            border-radius: 5px; /* Rounded corners for links */
            display: block; /* Ensure full-width for each link */
            transition: background-color 0.3s; /* Smooth transition for hover effect */
        }

        .nav_links a:hover, .nav_links .login-button:hover {
            background-color: #444; /* Slightly lighter background on hover */
        }

        /* Ensure the login button does not overflow the nav */
        .login-button {
            background-color: #007bff; /* Button color */
            border: none; /* Remove border */
            width: auto; /* Adjust width to fit content */
            border-radius: 25px; /* Match the border-radius of other links */
        }

        .menu-icon {
            display: block;
            position: fixed; /* Fix the position on the screen */
            top: 20px; /* Align with the top of the nav bar */
            right: 20px; /* Move the icon to the left */
            z-index: 1001; /* Ensure it's above the nav bar */
            cursor: pointer; /* Change cursor to pointer on hover */            
        }

        /* Additional styles for dropdown, if needed */
        .dropdown-content {
            left: -200px; /* Position the dropdown to the left of the side nav */
            border-radius: 5px; /* Rounded corners for dropdown */
            /* Other styles as needed */
        }
    }
    
    /* Media query for screens with a maximum width of 1063 pixels */
    @media (max-width: 1065px) {
        .nav_links a {
            font-size: 18px; /* Smaller font size for nav links */
        }
    }

</style>
<script>
     window.addEventListener('DOMContentLoaded', (event) => {
         const username = localStorage.getItem('username');
         if (username) {
             document.getElementById('userDisplay').innerHTML = username;
             document.getElementById('loginLink').style.display = 'none';
             document.getElementById('logoutLink').style.display = 'block';
         } else {
             document.getElementById('loginLink').style.display = 'block';
             document.getElementById('logoutLink').style.display = 'none';
         }
     });
     function logout() {
         localStorage.removeItem('username');
         window.location.href = 'C:\\xampp\\htdocs\\Testing\\Project-main\\webpages\\Daniel\\Login.php';
     }
</script>
<body>
    <header class="Nav-bar">
        <label class="logo">MathKids</label>
        <span class="menu-icon">☰</span> <!-- Menu icon added -->
        <!-- <img class="logo" src="../image/MathKids-Logo-Navbar.png" alt="MathKids-Logo"> -->
        <nav>
            <!-- Update With Fonts -->
            
            <ul class="nav_links">  
                <li><a href="../MathKids/index.php">Home</a></li>
                <li class="dropdown">
                    <a href="#">Learning</a>
                    <div class="dropdown-content">
                        <ul>
                            <li><a href="../Xiang/Learning.php">Lesson</a></li>
                            <li><a href="../MathKids/lesson.php">Video</a></li>
                            <li><a href="../HJ/course.php">Course</a></li>
                            <li><a href="../Daniel/addquestion.php">Add Questions</a></li>
                            <li><a href="../Daniel/discussion.php">Discussion</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="../Xiang/Leaderboard.php">Leaderboard</a></li>                
                <li><a href="../Oscar/aboutUs.php">About Us</a></li>
                <li><a href="../MathKids/faq.php">FAQ</a></li>
                <li><a href="../MathKids/contact.php">Contact Us</a></li>
                <!-- Login button -->
                <!-- Check if the user is logged in and display the username or Logout button in the dropdown -->
                <li id="loginLink" style="display: none;">
                        <a href="../Daniel/Login.php" class="login-button">Login</a>
                    </li>
                    <li id="logoutLink" class="dropdown" style="display: none;">
                        <a href="#" class="login-button" id="userDisplay"></a>
                        <div class="dropdown-content">
                            <ul>
                                <li><a href="#" onclick="logout()" id="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
        </header>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuIcon = document.querySelector('.menu-icon');
        const navLinks = document.querySelector('.nav_links');
        const logoutButton = document.querySelector('#logout-button');

        // Toggle navigation visibility
        menuIcon.addEventListener('click', function() {
            navLinks.style.display = (navLinks.style.display === 'none' || navLinks.style.display === '') ? 'flex' : 'none';
        });

        // Logout functionality
        logoutButton.addEventListener('click', function() {
            const confirmLogout = confirm("Are you sure you want to logout?");
            if (confirmLogout) {
                localStorage.removeItem('username');
                window.location.href = '..\\Daniel\\Login.php';
            }
        });

        // Function to adjust navLinks style on window resize
        function adjustNavLinks() {
            if (window.innerWidth <= 1278) {
                menuIcon.style.display = 'block';
                navLinks.style.display = navLinks.classList.contains('active') ? 'flex' : 'none';
            } else {
                navLinks.style.display = 'flex';
                menuIcon.style.display = 'none';
            }
        }

        // Attach event listener for window resize
        window.addEventListener('resize', adjustNavLinks);

        // Call the function initially to set the correct display state
        adjustNavLinks();

        });
    </script>
</body>
</html>

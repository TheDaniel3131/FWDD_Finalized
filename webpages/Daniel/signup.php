<!DOCTYPE html>
<html>
<head>
    <title>Signup User Form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=Rubik&display=swap");
    @import url('https://fonts.googleapis.com/css2?family=Work+Sans:wght@600;900&display=swap');
    /* General body styling */
    body {
        font-family: 'Work Sans', sans-serif;
        background-image: url('../../image/block4.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        max-width: 100%;
        max-height: 100%;
        color: #333;
    }

    /* Error message styling */
    .error-message {
        color: #d32f2f;
        background-color: #fbe9e7;
        border: 1px solid #d32f2f;
        border-radius: 4px;
        padding: 10px;
        margin-bottom: 20px;
        display: none;
    }

    /* Styling the Go Back button */
    #goBackButton {
        background: #f44336; /* Red color for the button */
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
        font-family: 'Work Sans', sans-serif;
        font-size: 16px;
        margin-top: 10px; /* Adjust the margin as needed */
        top: 20px; /* Adjust as needed to match the image */
        left: -120px; /* Adjust as needed to position the button to the left of the form */
        position: absolute;
    }

    #goBackButton:hover {
        background: #d32f2f; /* Darker shade for hover state */
        transform: translateY(-2px);
    }

    /* Container for the form */
    .signup-container {
        background: rgba(255, 255, 255, 1.0);
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        width: 300px;
        transition: transform 0.3s ease-in-out;
        position: relative;
    }

    .signup-container:hover {
        transform: scale(1.05);
    }

    /* Header style */
    h1 {
        font-weight: 750;
        text-align: center;
        color: #0056b3;
        margin-bottom: 20px;
    }

    /* Styling form inputs and select */
    form input[type="text"],
    form input[type="password"],
    form input[type="email"],
    form input[type="number"],
    form select {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
        font-family: 'Work Sans', sans-serif;
    }

    /* Styling the submit button */
    form input[type="submit"] {
        width: 100%;
        background: #0056b3;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
        font-family: 'Work Sans', sans-serif;
        font-size: 16px;
    }

    /* Hover effect for button */
    form input[type="submit"]:hover {
        background: #004494;
        transform: translateY(-2px);
    }

    /* Responsive design: form width adjusts on larger screens */
    @media (min-width: 768px) {
        .signup-container {
            width: 50%; /* Adjust the width for larger screens */
            max-width: 400px; /* Adjust maximum width as needed */
        }

        /* Adjust the Go Back button for larger screens */
        #goBackButton {
            left: -150px; /* Position the button further out for larger screens */
        }
    }

    /* Responsive design for very small devices */
    @media (max-width: 480px) {
        .signup-container {
            width: 100%; /* The form container takes the full width */
            max-width: none; /* No maximum width */
        }

        #goBackButton {
            position: relative; /* Make the button flow within the document */
            left: 0; /* Reset left positioning */
            display: block; /* Set to block to take the full width */
            width: 100%; /* Button takes full width */
            margin-bottom: 10px; /* Add some margin to the bottom */
        }
    }

    </style>
</head>
<body>
<div class="signup-container">
    <button id="goBackButton" type="button">Go Back</button>
    <h1>Sign Up Now!</h1>
    <div class="error-message" style="display:none;"></div> 
    <form id="signupForm">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        Age: <input type="number" name="age"><br>
        Email: <input type="email" name="email"><br>
        Phone Number: <input type="text" name="phonenumber"><br>
        Roles: 
        <select name="roles">
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select><br>
        <br>
        <input type="submit" value="Submit">
    </form>
</div>
<script>
    $(document).ready(function(){
        $("#signupForm").submit(function(event){
            event.preventDefault();

            // Clear previous error messages
            var errorContainer = $(".error-message");
            errorContainer.hide().empty();

            // Fetching form data
            var username = $("input[name='username']").val();
            var password = $("input[name='password']").val();
            var age = parseInt($("input[name='age']").val(), 10);
            var email = $("input[name='email']").val();
            var phoneNumber = $("input[name='phonenumber']").val();
            var roles = $("select[name='roles']").val();

            // Perform validation checks, add errors to errorContainer if any
            if(username === "") {
                errorContainer.append("<p>Username cannot be empty.</p>");
            }

            var passwordRegex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{10,}$/;
            if(password === "") {
                errorContainer.append("<p>Password cannot be empty.</p>");
            } else if(!passwordRegex.test(password)) {
                errorContainer.append("<p>Password must be at least 10 characters long and include at least one number, one uppercase and lowercase letter, and one special symbol.</p>");
            }

            if(age === 0) {
                errorContainer.append("<p>Age cannot be empty.</p>");
            } else if(roles === "student" && age > 18) {
                errorContainer.append("<p>Students must be under 18 years of age.</p>");
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if(email === "") {
                errorContainer.append("<p>Email cannot be empty.</p>");
            } else if(!emailRegex.test(email)) {
                errorContainer.append("<p>Email is not valid.</p>");
            }

            // If there are errors so far, show them and exit
            if(errorContainer.children().length > 0) {
                errorContainer.show();
                return;
            }

            // Go Back button click handler
            $("#goBackButton").click(function() {
                window.history.back(); // This will take the user to the previous page
            });

            // No errors, proceed with form submission
            $.ajax({
                url: 'signup_process.php',
                type: 'post',
                data: $("#signupForm").serialize(),
                success: function(data){
                    console.log(data); // Log the response to the browser's console
                    if (data.includes("New record created successfully")) {
                        alert("Signup Successful!");
                        window.location.href = "Login.php"; // Redirect to Login.php
                    } else {
                        alert("Signup failed: " + data);
                    }
                },
                error: function(){
                    alert("An error occurred while submitting the form.");
                }
            });
            });
        });
</script>
</body>
</html>


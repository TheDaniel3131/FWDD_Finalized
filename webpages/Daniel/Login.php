<!DOCTYPE html>
<head>
    <title>Login</title>
    <link href="Login.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.Login-button').click(function(e) {
            e.preventDefault();
            var username = $('#Name').val();
            var password = $('#Pass').val();
            if (username != "" && password != "") {
                $.ajax({
                    url: 'login_process.php',
                    type: 'post',
                    data: {
                        'login': 1,
                        'username': username,
                        'password': password,
                    },
                    success: function(response) {
                        try {
                            var data = JSON.parse(response);
                            if (data.status === "Found") {
                                localStorage.setItem("username", username);
                                localStorage.setItem("role", data.role);
                                window.location.href = '\\Testing\\Project-main\\webpages\\MathKids\\index.php';
                            } else if (data.status === "NotFound") {
                                alert("Username or Password incorrect.");
                            } else {
                                alert("Error in login process.");
                            }
                        } catch (e) {
                            alert('Error processing request.');
                            console.error(e);
                        }
                    },
                    error: function() {
                        alert("AJAX request failed.");
                    }
                });
            } else {
                alert("Please enter both username and password.");
            }
        });
    });
</script>

</head>
<body>
    <div class="blur">
        
    </div>
    <main>
        <div class="SignUp">
            <a href="webpages/Daniel/signup.php">Sign Up</a>
        </div>
        <div class="Login-box">
            <img src="images/MathKids-Logo.png" alt="MathKids-Logo">
            <form>
                <label for="Username">Username:</label>
                <input type="text" id="Name" name="username"><br><br> <!-- Changed name to 'username' -->
                <label for="Password">Password:</label>
                <input type="password" id="Pass" name="password"> <!-- Changed name to 'password' -->
                <div class="Forgot_Pass">
                    <a href="Forgot-Pass.html">Forgot Password?</a>
                </div>
                <br><br>
                <button type="submit" class="Login-button">Login</button>
            </form>
        </div>
    </main>
</body>
</html>
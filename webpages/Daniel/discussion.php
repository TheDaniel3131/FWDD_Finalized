<?php 
    // error_log("Session ID: " . session_id());
    // error_log("Session Username: " . (isset($_SESSION['username']) ? $_SESSION['username'] : 'Not set'));
    include 'nav_afterlogin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MathKids Discussion</title>
    <link rel="stylesheet" href="discussion.css">
    <style type="text/css">

        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=Rubik&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Work+Sans:wght@600;900&display=swap");


        *,
        *::before,
        *::after {
            font-family: Poppins, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 16px;
            min-height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f0f0f0; /* Set your preferred background color */
            background-image: url('images/bg_d.jpg'); /* Replace 'your-background-image.jpg' with the path to your background image */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            font-family: Poppins, sans-serif;
        }

        header {
            display: flex;
            font-weight: 900;
            background-color: #333;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            margin-bottom: 0px;
        }

        .header h2 {
            font-weight: bold;
            font-size: 25px; /* Adjust the size as needed */
            letter-spacing: 3px;
        }

        h2 {
            font-weight: 750;
        }

        .SectionTitle{
            font-weight: 550;
            font-size: 35px;
            font-family: "Work Sans", sans-serif;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            margin: 3rem auto;
            background-color: white; /* Set your preferred background color */
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .comment-form {
            background-color: #f9f9f9; /* Set your preferred background color */
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .label {
            font-weight: 500;
            display: block;
            margin-bottom: 5px;
        }

        .input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }

        .submit-button {
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #555;
        }

        .discussion-container {
            background-color: #f9f9f9; /* Set your preferred background color */
            border-radius: 10px;
            padding: 20px;
        }

        .comment {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .profile-picture {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .comment-details {
            flex: 1;
        }

        .comment-text {
        font-size: 16px;
        }
        
        .modern-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }

        .label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }

        .input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #f2f2f2;
            box-shadow: inset 0px -1px 0px rgba(0,0,0,0.1);
            transition: background-color 0.3s ease-in-out;
            max-width: 100%;
            font-size: 16px;
            outline: none;
            box-sizing: border-box;
            resize: none;
        }

        .input:hover,
        .input:focus {
            background-color: #e6e6e6;
        }

        .submit-button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .submit-button:hover {
            background-color: #555;
        }

        .edit-button, .delete-button {
            margin-left: 10px;
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            font-size: 14px;
        }

        .edit-button {
            background-color: #4CAF50;
        }

        .delete-button {
            background-color: #f44336;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000; /* Higher than other elements */
            left: 0;
            top: 0;
            width: 100vw; /* Use viewport width */
            height: 100vh; /* Use viewport height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black with opacity */
            display: flex;
            align-items: center;
            justify-content: center;
        }


        .modal-content {
            background-color: #fefefe;
            top: 0;
            margin-bottom: 200px;
            /* margin: auto; */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
        }

        .edit-form h3 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-size: 18px;
        }

        .form-textarea {
            width: 100%;
            padding: 12px;
            border-radius: 4px;
            border: 1px solid #ddd;
            resize: vertical;
            min-height: 100px;
            box-sizing: border-box;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .submit-edit {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: background-color 0.2s ease-in-out;
        }

        .submit-edit:hover {
            background-color: #45a049;
        }


        /* Media query for smaller screens */
        @media (max-width: 768px) {
            .comment-form {
                padding: 10px;
            }

            .input,
            .input::placeholder,
            textarea {
                font-size: 0.9rem;
            }

            textarea {
                rows: 4;
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
                top: 50px; /* Adjust this value to the height of your fixed header */
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
                top: 5px;
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

            .header h2 {
                font-size: 18px; /* Slightly smaller font size for header */
                margin: 0 auto; /* Center header title */
            }

             .header {
                padding-top: 65px;
                margin-top: 0px;
            }

        }
    </style>
    <!-- <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const role = localStorage.getItem('role');
            if (role !== 'teacher') {
                alert('Access denied. This page is only for teachers.');
                window.location.href = 'home.php'; // Redirect them to a different page
            }
        });
    </script> -->
</head>
<body>
    <header class="header">
        <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lesson Discussion Section&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
    </header>

    <div class="container">
        <div class="comment-form">
            <h2 class="SectionTitle">POST YOUR COMMENT HERE</h2><br><hr><br>
            <form class="modern-form" method="post" action="dc_process.php">
                <!-- <br>
                <div class="form-group">
                    <label class="label" for="userId">User ID:</label>
                    <input class="input" type="text" name="userId" required>
                </div> -->
                <br>
                <input type="hidden" name="username" id="hiddenUsername" value="">
                <div class="form-group">
                    <label class="label" for="comment">Enter Your Comment:</label>
                    <textarea class="input" name="comment" id="comment" required rows="5" cols="100"></textarea>
                </div>
                <br>
                <button class="submit-button" type="submit">Submit</button>
            </form>
        </div>
        <br><br><br>
        <div class="discussion-container">
            <h2 class="SectionTitle">LESSON DISCUSSION SECTION</h2><br><hr><br>
            <?php include 'dc_process.php'; ?>
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <?php if (!empty($comment['user']['profile_picture'])): ?>
                        <img class="profile-picture" src="<?php echo $comment['user']['profile_picture']; ?>" />
                    <?php else: ?>
                        <img class="profile-picture" src="images/defaultpp.png" alt="<?php echo $comment['user']['name']; ?> " />
                    <?php endif; ?>
                    <div class="comment-details">
                        <p class="comment-text">
                            <strong>&nbsp;<?php echo $comment['user']['name']; ?></strong>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $comment['comment']; ?>
                        </p>
                    </div>
                    <!-- Edit and Delete buttons -->
                    <div class="comment-actions">
                        <a href="javascript:void(0);" onclick="openEditModal(<?php echo $comment['id']; ?>, '<?php echo addslashes($comment['comment']); ?>')" class="edit-button">Edit</a>
                        <a href="delete_comment.php?comment_id=<?php echo $comment['id']; ?>" onclick="return confirmDelete()" class="delete-button">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- Place this outside your PHP loop, after the loop ends -->
            <div id="editModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h3>Edit Your Comment</h3>
                    <form id="editForm" method="post" class="edit-form">
                        <div class="form-group">
                            <label for="editCommentTextarea" class="form-label">Your Comment:</label>
                            <textarea id="editCommentTextarea" name="comment" class="form-textarea"></textarea>
                        </div>
                        <input type="hidden" name="comment_id" id="editCommentId">
                        <button type="button" onclick="submitEdit()" class="submit-edit">Update Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var currentUser = localStorage.getItem('username'); // Get the current username
            var textarea = document.getElementById("comment");
            var maxCharacters = 100; // Change this to your desired character limit

            // Set the hidden input value to the username from localStorage when the form is submitted
            var form = document.querySelector(".modern-form");
            form.onsubmit = function() {
                document.getElementById('hiddenUsername').value = localStorage.getItem('username');
            };

            textarea.addEventListener("input", function() {
                var text = this.value;

                if (text.length > maxCharacters) {
                    this.value = text.slice(0, maxCharacters); // Truncate the text
                }
            });
            
             // Now, loop through all the comments to hide or show the edit/delete buttons
            var comments = document.querySelectorAll('.comment');
            comments.forEach(function(comment) {
                var username = comment.querySelector('.comment-text strong').textContent.trim();
                var commentActions = comment.querySelector('.comment-actions');
                if (commentActions && username !== currentUser) {
                    commentActions.style.display = 'none'; // Hide edit/delete buttons for other users' comments
                }
            });
        });
    </script>
    <!-- Confirm Delete Script -->
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this comment?");
        }

        function openEditModal(commentId, commentText) {
            // Set the values in the modal based on the comment to edit
            document.getElementById('editCommentTextarea').value = commentText;
            document.getElementById('editCommentId').value = commentId;
            
            // Display the modal
            document.getElementById('editModal').style.display = 'block';
        }

        function submitEdit() {
            var commentId = document.getElementById('editCommentId').value;
            var commentText = document.getElementById('editCommentTextarea').value;

            // AJAX request to update the comment
            var formData = new FormData();
            formData.append('comment_id', commentId);
            formData.append('comment', commentText);

            fetch('edit_comment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                // Process the response
                console.log(data); // For debugging
                document.getElementById('editModal').style.display = 'none';
                location.reload(); // Reload the page to show the updated comment
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating comment');
            });
        }

        // Close the modal when the user clicks on <span> (x) or outside the modal
        var modal = document.getElementById('editModal');
        var span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
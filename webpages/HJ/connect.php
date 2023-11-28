<?php
    $CourseTitle = $_POST['CourseTitle'];
    $Description = $_POST['Description'];

    // File handling
    
    $CourseImage = $target_dir . basename($_FILES["CourseImage"]["name"]);

    $conn = mysqli_connect("localhost", "root", "", "fwdd");

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        // Move the uploaded file to the target directory
        move_uploaded_file($_FILES["CourseImage"]["tmp_name"], $CourseImage);

        $stmt = $conn->prepare("INSERT INTO course (CourseTitle, Description, CourseImage) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $CourseTitle, $Description, $CourseImage);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();

            // Show a success message and then redirect to the course page
            echo "<script>alert('Course added successfully!'); window.history.go(-2); location.reload();</script>";
            exit();
        } else {
            $stmt->close();
            $conn->close();

            // Show an alert for failure and stay on the same page
            echo "<script>alert('Failed to add course. Please try again.');</script>";
        }
    }
?>

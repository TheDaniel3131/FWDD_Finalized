<?php
    ini_set('display_errors', 1); // Enable error reporting for debugging
    error_reporting(E_ALL);

    $db = mysqli_connect('localhost', 'root', '', 'MathKids');
    if (!$db) {
        die('Connection error: ' . mysqli_connect_error());
    }

    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        $stmt = $db->prepare("SELECT Password, Roles FROM users WHERE Username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $row = $result->fetch_assoc();
            if ($row && $row['Password'] === $password) {
                echo json_encode(array("status" => "Found", "role" => $row['Roles']));
            } else {
                echo json_encode(array("status" => "NotFound"));
            }
        } else {
            error_log('Error executing query: ' . mysqli_error($db));
            echo json_encode(array("status" => "Error"));
        }
    }
?>
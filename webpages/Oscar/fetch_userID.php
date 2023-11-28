<?php
session_start();

$response = array();

if (isset($_SESSION['userID'])) {
    $response['userID'] = $_SESSION['userID'];
} else {
    $response['userID'] = null;
}

header('Content-Type: application/json');
echo json_encode($response);
?>

<?php
    session_start();
    session_destroy();
    header('Location: home.php'); // Redirect to your home page
    exit();
?>

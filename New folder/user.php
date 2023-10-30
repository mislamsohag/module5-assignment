<?php
session_start();

// Access control to ensure only regular users can access this page
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php");
    exit();
}

?>

<!-- User Page -->
<!-- Add your HTML for regular user actions here -->


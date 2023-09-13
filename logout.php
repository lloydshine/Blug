<?php
session_start(); // Start the session (if not already started)

// Logout the user by destroying the session
if (isset($_SESSION['username'])) {
    session_destroy();
}

// Redirect to the login page or any other desired page
header('Location: index.php'); // Replace 'login.php' with your login page URL
exit;
?>

<?php
require "database.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database for the user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['password'] == $password) {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $user["id"];
    } else {
        $error_message = "Invalid username or password";
        $_SESSION["log"] = ["error", $error_message];
    }
}

header('Location: index.php'); // Redirect to a protected page
exit;
?>

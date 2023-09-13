<?php

require "database.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $retypePassword = $_POST["retype-password"];

  if(strlen($username) == 0 || strlen($password) == 0 || strlen($retypePassword) == 0) {
    $_SESSION["log"] = ["error", "Missing Fields"];
  } else if ($password != $retypePassword) {
    $_SESSION["log"] = ["error", "Password not matched!"];
  } else if (isUsernameRegistered($pdo,$username)) {
    $_SESSION["log"] = ["error", "Username is already registered!"];
  } else {
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $data = [
      ':username' => $_POST["username"],
      ':password' => $_POST["password"]
    ];
    try {
      $stmt = $pdo->prepare($sql);
      $stmt->execute($data);
      $_SESSION["log"] = ["normal", "Successfully Registered!"];
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}

header('Location: index.php'); // Redirect to a protected page
exit;

?>
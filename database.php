<?php

try {
  $pdo = new PDO("mysql:host=localhost;dbname=blug", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Database connection failed: " . $e->getMessage());
}


function isUsernameRegistered($pdo,$username) {
  try {
      // Prepare a query to select the count of rows with the given username
      $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
      $stmt->execute([$username]);

      // Fetch the result
      $count = $stmt->fetchColumn();

      // If count is greater than 0, the username is already registered
      return $count > 0;
  } catch (PDOException $e) {
      // Handle database errors
      echo "Error: " . $e->getMessage();
      return false;
  }
}
?>
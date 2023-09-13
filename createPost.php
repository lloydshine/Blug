<?php

require "database.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $userid = $_SESSION['id'];

    if(strlen($title) == 0 || strlen($body) == 0 || $userid == null) {
      $_SESSION["log"] = ["error", "Missing Fields"];
    } else {
      $sql = "INSERT INTO posts (title, post, user_id) VALUES (:title, :body, :user_id)";
      $data = [
        ':title' => $title,
        ':body' => $body,
        ':user_id' => $userid
      ];
      try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        $_SESSION["log"] = ["normal", "Successfully Posted!"];
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }
}
header('Location: index.php'); // Redirect to a protected page
exit;


?>
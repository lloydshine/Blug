<?php

require "database.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $postid = $_POST['id'];

    if(strlen($title) == 0 || strlen($body) == 0 || $postid == null) {
      $_SESSION["log"] = ["error", "Missing Fields"];
    } else {
      $sql = "UPDATE posts SET title=:title, post=:body WHERE id=:postid";
      $data = [
        ':title' => $title,
        ':body' => $body,
        ':postid' => $postid
      ];
      try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        $_SESSION["log"] = ["normal", "Successfully Edited!"];
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }
}

header('Location: index.php'); // Redirect to a protected page
exit;

?>
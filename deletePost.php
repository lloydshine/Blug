<?php

require "database.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $postid = $_GET['id'];
    $userid = $_SESSION['id'];

    if($postid == null || $userid == null ) {
      $_SESSION["log"] = ["error", "Missing Fields"];
    } else {
      $sql = "DELETE FROM posts WHERE id=:postid";
      $data = [
        ':postid' => $postid,
      ];
      try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        $_SESSION["log"] = ["normal", "Successfully Deleted!"];
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }
}

header('Location: index.php'); // Redirect to a protected page
exit;

?>
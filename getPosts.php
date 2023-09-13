<?php
require "database.php";

$stmt = $pdo->prepare("SELECT users.username, posts.* FROM posts INNER JOIN users ON users.id = posts.user_id ORDER BY posts.id DESC;");
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

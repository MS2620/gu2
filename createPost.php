<?php

require 'dbaccess.php';

$username = $_POST['username'];
$content = $_POST['content'];
$userId = $_POST['userId'];
$pfp = $_POST['pfp'];

$stmt = $conn->prepare("INSERT INTO posts (p_user_id, username, content, image)
  VALUES (?, ?, ?, ?)");

$stmt->bind_param("isss", $userId, $username, $content, $pfp );

if ($stmt->execute()){
    header("Location: index.php");
} else {
    echo "Something went wrong.";
}

$conn->close();

?>
<?php

require 'dbaccess.php';

$userId = $_POST['userId'];
$postId = $_POST['post_id'];
$username = $_POST['username'];
$comments = $_POST['comment'];

$stmt = $conn->prepare("INSERT INTO comments (user_id, p_post_id, c_username, comments)
  VALUES (?, ?, ?, ?)");

$stmt->bind_param("iiss", $userId, $postId, $username, $comments );

if ($stmt->execute()){
    header("Location: index.php");
} else {
    echo "Something went wrong.";
}

$conn->close();

?>


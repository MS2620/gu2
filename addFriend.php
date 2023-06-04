<?php

session_start();
require 'dbaccess.php';

$sessionId = $_SESSION["userId"];
$otherUserId = $_POST['userId'];
$username = $_POST['username'];
$pfp = $_POST['pfp'];


$stmt = $conn->prepare("INSERT INTO friends (user_id, other_user_id, username, pfp)
  VALUES (?, ?, ?, ?)");

$stmt->bind_param("iiss", $sessionId, $otherUserId, $username, $pfp );

if ($stmt->execute()){
    header("Location: index.php");
} else {
    echo "Something went wrong.";
}

$conn->close();

?>
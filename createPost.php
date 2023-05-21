<?php

require "dbaccess.php";
$username = $_POST['username'];
$content = $_POST['content'];
$userId = $_POST['userId'];
$pfp = $_POST['pfp'];

  $stmt = $conn->prepare("INSERT INTO gu_posts (user_id, username, content, image)
  VALUES (?, ?, ?, ?)");

  $stmt->bind_param("ssss", $userId, $username, $content, $pfp);

  if ($stmt->execute() == true){
    echo
    "
    <script>
      document.location.href = 'index.php';
    </script>
    ";
    } else {
      echo "Something went wrong.";
    }

$conn->close();

?>
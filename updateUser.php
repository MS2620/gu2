<?php
require "header.php";
require "dbaccess.php";
$username = $_POST['username'];
$email = $_POST['email'];
$userId = $_SESSION['userId'];

$stmt = $conn->prepare("UPDATE gu_users SET email =?, username =? WHERE user_id = '$userId'");
$stmt->bind_param("ss", $email, $username);

if ($stmt->execute() == true){
    echo "
    <script>
        alert('Details Successfully updated.');
        document.location.href = 'index.php';
    </script>
    ";
} else {
    echo "<p>Sorry something went wrong when updating your details, please <a href='updateUser.php'>try again.</a></p>";
}

$conn->close();

require "footer.php";
?>

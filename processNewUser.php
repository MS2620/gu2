<?php

  require 'header.php';

?>

<?php

require "dbaccess.php";
$pfp = $_POST['pfp'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password1'];
$password1 = $_POST['password2'];
$hash = password_hash( $password, PASSWORD_DEFAULT);
$background = $_POST['background_img'];
$audio = $_POST['audio'];

$isValid = true;
//form validation to be added

if ($password != $password1){
  $isValid = false;
  echo "<p>Passwords do not match.</p>";
}

if (strlen($password) < 8 ){
  $isValid = false;
  echo "<p>Password must be 8 characters long. </p>";
}

$stmt = $conn->prepare("SELECT username FROM gu_users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0){
  echo "<p>Sorry but that username is already taken, please try a different username.</p>";
  $isValid = false;
}

$stmt = $conn->prepare("SELECT email FROM gu_users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0){
  echo "<p>Sorry but that email already exists, please try a different one.</p>";
  $isValid = false;
}


if ($isValid == true){

  $stmt = $conn->prepare("INSERT INTO gu_users (email, username, password, profilePic, background, audio)
  VALUES (?,?,?,?,?,?)");

  $stmt->bind_param("ssssss", $email, $username, $hash, $pfp, $background, $audio);

  if ($stmt->execute() == true){
      $lastId = $stmt->insert_id;
      echo "<p>A new record has been created for your account. Your customer ID is: $lastId </p>";
    } else {
      echo "Something went wrong.";
    }
  } else {
    echo "<p>Problem validating the form. To try again <a href='newUser.php'>press here.</a></p>";
  }

$conn->close();

?>

<?php

  require 'footer.php';

?>

<?php
require 'header.php';

// Get the email and password values from the POST request
$email = $_POST['email'];
$password = $_POST['password'];


// Prepare the SQL statement to select user information from the database
$stmt = $conn->prepare("SELECT user_id, username, password, email, profilePic, background, audio FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

// Get the result of the query
$result = $stmt->get_result();

// Check if there is exactly one row returned
if ($result->num_rows == 1) {
  // Fetch the row as an associative array
  $row = $result->fetch_assoc();

if (password_verify($password, $row['password'])) {
    // If the user is not suspended and the password matches, set session variables
    $_SESSION['loggedin'] = true;
    $_SESSION['userId'] = $row['user_id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['pfp'] = $row['profilePic'];
    $_SESSION['background'] = $row['background'];
    $_SESSION['audio'] = $row['audio'];
    echo "<script>alert('Logged in, redirecting to homepage.'); document.location.href = 'index.php';</script>";
  } else {
    // If the email or password is incorrect, display an alert and redirect to the index page
    echo "<script>alert('Email or password is incorrect, please try again.'); document.location.href = 'index.php';</script>";
  }
}

// Close the database connection
$conn->close();

require 'footer.php';
?>
<?php

  require 'header.php';

?>
<?php

  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT user_id, username, password FROM gu_users
          WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1){

    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password'])){
      $_SESSION['loggedin'] = true;
      $_SESSION['userId'] = $row['user_id'];
      $_SESSION['username'] = $row['username'];
      $_SESSION['email'] = $row['email'];
      echo "<script>document.location.href = 'index.php'</script>";
    }else {
      echo "<script>alert('Email or password is incorrect, please try again.');
                document.location.href = 'index.php';
            </script>";
    }
  }
  $conn->close();

?>


<?php

  require 'footer.php';

?>
<?php

  require 'header.php';

?>

<?php
  $userId = $_POST["userID"];
  $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE user_id = $userId"));

  $profilePic = $user["profilePic"];
  $background = $user["background"];
  $audio = $user["audio"];
?>
<body style="background-image: url('images/<?php echo $background; ?>');">
<main id="main">
  <form class="form w-full flex justify-center" id="form" action="" enctype="multipart/form-data" method="post">
    <div class="upload">
      <!---Profile Pic-->
      <div class="user-img">
        <img class="w-24 h-24 rounded-full md:w-32 md:h-32 lg:w-48 lg:h-48" src="images/<?php echo $profilePic; ?>" title="<?php echo $profilePic; ?>">
        <button type="submit" class="uploadBtn"></button>
      </div>
    </div>
    <iframe src="audio/silence.mp3" allow="autoplay" id="audio" style="display: none">
    </iframe>
    <audio id="player" autoplay>
      <source src="audio/<?php echo $audio;?>" type="audio/mp3">
    </audio>
  </form>

  <form action="addFriend.php" method="post" >
        <input type="hidden" name="userId" value="<?php echo $userId ?>">
        <input type="hidden" name="username" value="<?php echo $user['username'] ?>">
        <input type="hidden" name="pfp" value="<?php echo $profilePic ?>">
        <button type="submit" class="button h-12 bg-blue-300 w-11/12 rounded-md text-center -mt-12">Add Friend</button>
  </form>

  <!--  Posts-->
  <?php
  $stmt2 = $conn->prepare("SELECT * FROM posts p LEFT JOIN comments c ON p.post_id = c.p_post_id WHERE p.p_user_id = $userId ORDER BY p.post_id DESC");
  $stmt2->execute();
  $result2 = $stmt2->get_result();
  if ($result2->num_rows > 0){
    while ($posts = $result2->fetch_assoc()){
      echo "<div class=\"w-full justify-center items-center mt-8\">";
      echo "<div class=\"flex flex-col w-full items-center h-fit\">";
      echo "<div class=\"w-11/12 bg-slate-100 rounded-md drop-shadow-md\">";
      echo "<div>";
      ?>
      
        <p class="font-bold text-xl mt-4 ml-32" name="userID"> <?php echo $posts['username'] ?> </p>
      <?php
      echo "<img class=\"w-12 h-12 rounded-full md:w-32 md:h-32 lg:w-24 lg:h-24 ml-4 -mt-8\" src=\"images/". $posts['image'] . "\" title=\"Posts user image\">";
      echo "</div>";
      echo "<hr class=\"mt-2\"/>";
      echo "<div>";
      echo "<p class=\"w-11/12 ml-4 mt-2 mb-2 text-lg\">" . $posts['content'] . "</p>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    }
  } else {
    echo "Unable to retrieve customer info.";
  }

  ?>
</main>
</body>
<?php

  require 'footer.php';

?>

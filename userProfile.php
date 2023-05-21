<?php

  require 'header.php';

?>

<?php
  $sessionId = $_SESSION["userId"];
  $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM gu_users WHERE user_id = $sessionId"));
  $id = $user["user_id"];
  $email = $user["email"];
  $username = $user["username"];
  $profilePic = $user["profilePic"];
  $background = $user["background"];
  $audio = $user["audio"];
?>
<body style="background-image: url('images/<?php echo $background; ?>');">
<div class="form-popup" id="update">
  <form method="post" id="form" enctype="multipart/form-data" class="form-container login" >
    <h1><b>Change Images or Audio</b></h1>

    <div class="pt-2">
      <label>Profile Pic</label>
      <br/>
      <input type="hidden" value="<?php echo $id ?>">
      <input type="hidden" value="<?php echo $username ?>">
      <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
    </div>

    <div class="pt-2">
      <label>Background</label>
      <br/>
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="username" value="<?php echo $username; ?>">
      <input type="file" name="background" id="background" accept=".jpg, .jpeg, .png">
    </div>

    <div class="pt-2">
      <label>Audio</label>
      <br/>
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="username" value="<?php echo $username; ?>">
      <input type="file" name="audio" id="audio" accept=".mp3, .wav">
    </div>

    <button type="submit" class="btn">Submit</button>
  </form>
  <hr/>

  <button class="cancel" onclick="closeUpdate()">&times;</button>
</div>
<main id="main">
  <form class="form w-full flex justify-center">
    <div class="upload bg-slate-200 auto pt-4 rounded-md">
      <!---Profile Pic-->
      <div class="user-img ml-8">
        <div class="container">
          <img class="w-24 h-24 rounded-full md:w-32 md:h-32 lg:w-48 lg:h-48" src="images/<?php echo $profilePic; ?>" title="<?php echo $profilePic; ?>" alt="Users Profile Picture">
          <a class="open-button text-black" onclick="openUpdate()">Update Images or Audio</a>
        </div>
      </div>
    </div>
    <iframe src="audio/silence.mp3" allow="autoplay" id="audio" style="display: none">
    </iframe>
    <audio id="player" autoplay>
      <source src="audio/<?php echo $audio;?>" type="audio/mp3">
    </audio>
  </form>

<!--  Posts-->
  <?php
  $stmt2 = $conn->prepare("SELECT * FROM gu_posts p LEFT JOIN gu_comments c ON p.post_id = c.p_post_id WHERE p.p_user_id = $sessionId ORDER BY p.post_id DESC");
  $stmt2->execute();
  $result2 = $stmt2->get_result();
  if ($result2->num_rows > 0){
    while ($posts = $result2->fetch_assoc()){
      echo "<div class=\"w-full justify-center items-center mt-8\">";
      echo "<div class=\"flex flex-col w-full items-center h-fit\">";
      echo "<div class=\"w-11/12 bg-slate-100 rounded-md drop-shadow-md\">";
      echo "<div>";
      ?>
      <form action="profile.php" method="post" >
        <button class="font-bold text-xl mt-4 ml-32" name="userID" value="<?php echo $posts['user_id'] ?>" > <?php echo $posts['username'] ?> </button>
      </form>
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
    <?php
    //Profile Picture
    if(isset($_FILES["image"]["name"])){
      $id = $_POST["id"];
      $name = $_POST["username"];

      $imageName = $_FILES["image"]["name"];
      $imageSize = $_FILES["image"]["size"];
      $tmpName = $_FILES["image"]["tmp_name"];

      // Image validation
      $validImageExtension = ['jpg', 'jpeg', 'png'];
      $imageExtension = explode('.', $imageName);
      $imageExtension = strtolower(end($imageExtension));
      if (!in_array($imageExtension, $validImageExtension)){
        echo "";
      }
      elseif ($imageSize > 1200000){
        echo
        "
        <script>
          alert('Image Size Is Too Large');
          document.location.href = 'userProfile.php';
        </script>
        ";
      }
      else{
        $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
        $newImageName .= '.' . $imageExtension;
        $query = "UPDATE gu_users SET profilePic = '$newImageName' WHERE user_id = $id";
        mysqli_query($conn, $query);
        move_uploaded_file($tmpName, 'images/' . $newImageName);
        echo
        "
        <script>
        document.location.href = 'userProfile.php';
        </script>
        ";
      }
    }

    //Background
    if(isset($_FILES["background"]["name"])){
      $id = $_POST["id"];
      $name = $_POST["username"];

      $imageName = $_FILES["background"]["name"];
      $imageSize = $_FILES["background"]["size"];
      $tmpName2 = $_FILES["background"]["tmp_name"];

      // Image validation
      $validImageExtension = ['jpg', 'jpeg', 'png'];
      $imageExtension = explode('.', $imageName);
      $imageExtension = strtolower(end($imageExtension));
      if (!in_array($imageExtension, $validImageExtension)){
        echo "";
      }
      elseif ($imageSize > 1200000){
        echo
        "
        <script>
          alert('Image Size Is Too Large');
          document.location.href = 'userProfile.php';
        </script>
        ";
      }
      else{
        $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
        $newImageName .= '.' . $imageExtension;
        $query = "UPDATE gu_users SET background = '$newImageName' WHERE user_id = $id";
        mysqli_query($conn, $query);
        move_uploaded_file($tmpName2, 'images/' . $newImageName);
        echo
        "
        <script>
        document.location.href = 'userProfile.php';
        </script>
        ";
      }
    }
    //Audio
    if(isset($_FILES["audio"]["name"])){
      $id = $_POST["id"];
      $name = $_POST["username"];

      $audioName = $_FILES["audio"]["name"];
      $audioSize = $_FILES["audio"]["size"];
      $tmpName3 = $_FILES["audio"]["tmp_name"];

      // audio validation
      $validAudioExtension = ['mp3', 'wav'];
      $audioExtension = explode('.', $audioName);
      $audioExtension = strtolower(end($audioExtension));
      if (!in_array($audioExtension, $validAudioExtension)){
        echo "";
      }
      elseif ($audioSize > 15000000){
        echo
        "
        <script>
          alert('Audio Size Is Too Large');
          document.location.href = 'userProfile.php';
        </script>
        ";
      }
      else{
        $newAudioName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
        $newAudioName .= '.' . $audioExtension;
        $query = "UPDATE gu_users SET audio = '$newAudioName' WHERE user_id = $id";
        echo "console.log(\"Uploaded\")";
        mysqli_query($conn, $query);
        move_uploaded_file($tmpName3, 'audio/' . $newAudioName);
        echo
        "
        <script>
        alert ('Saved to folder');
        document.location.href = 'userProfile.php';
        </script>
        ";
      }
    }

    $conn->close();
    ?>

  <script>
    function openUpdate() {
      document.getElementById("update").style.display = "block";
    }

    function closeUpdate() {
      document.getElementById("update").style.display = "none";
    }
  </script>

</main>
</body>
<?php

  require 'footer.php';

?>

<?php

  require 'header.php';

?>

<main id="main">
<?php
  if (isset($_SESSION['loggedin']) == false){
    echo "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac ante ut nisl viverra tincidunt. Aliquam feugiat purus quis risus laoreet, ac sollicitudin ipsum pretium. Phasellus sapien dolor, hendrerit quis dapibus tristique, volutpat non nibh. Duis mollis porta odio, id pellentesque mi pharetra in. In at magna posuere sem bibendum faucibus in ut massa. Pellentesque ac mauris placerat, efficitur metus nec, mattis sem. Nullam tortor nisl, gravida quis erat sed, aliquet tempor nulla. In id tellus vitae est consectetur lacinia vitae in metus.</p>";

    echo "<p>Donec hendrerit neque vitae mi malesuada blandit. Nunc feugiat eros non nunc pellentesque placerat. Praesent gravida fermentum nisi nec imperdiet. Aliquam volutpat quam nec consectetur maximus. Cras semper nunc luctus, bibendum sapien sit amet, varius mi. Sed ut orci augue. Pellentesque mi lacus, viverra rhoncus ex vitae, tincidunt euismod libero. Nullam pellentesque turpis sed est cursus elementum. Nulla varius, magna sed efficitur pellentesque, sapien lorem pretium erat, sit amet imperdiet lorem ante non libero. Fusce pellentesque eu lacus ac fermentum. Maecenas dignissim libero eu viverra rhoncus.</p>";

    echo "<p>Nunc convallis purus vel mi rhoncus, sit amet viverra ante suscipit. Aliquam convallis eros quis dapibus ultricies. Nullam aliquam posuere orci ut blandit. Pellentesque pellentesque mauris accumsan velit porttitor, at convallis metus fringilla. Fusce suscipit, nisl eget vestibulum bibendum, massa lacus aliquet tellus, in bibendum ante leo eget orci. Nam rhoncus justo in ante porttitor, ut posuere dolor egestas. Duis porta nulla nisl, et volutpat sapien gravida nec. Phasellus felis lacus, faucibus porttitor est non, sollicitudin viverra arcu. Praesent tempor velit tortor, ac commodo nulla malesuada vitae. Sed ornare leo ac mattis venenatis. In tortor orci, congue nec cursus et, semper id metus. Nullam tincidunt, mauris vitae maximus elementum, mi sem dapibus nisi, non elementum eros velit in augue. In nec nulla justo.</p>";

    echo "<p>Vestibulum ornare risus purus, vitae convallis mauris posuere sit amet. Aliquam quis leo sed eros pellentesque tincidunt. Duis ut arcu rhoncus, faucibus diam sed, maximus odio. Mauris tristique placerat convallis. Vestibulum vitae bibendum ligula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque a pretium erat. Donec sodales augue at aliquam malesuada. Maecenas scelerisque, tortor nec luctus consectetur, urna nibh ornare ligula, vitae ornare tellus nulla at eros. In nulla enim, bibendum nec mauris eu, facilisis sodales mauris. Suspendisse mi orci, pellentesque pulvinar enim non, facilisis vehicula purus. Nulla bibendum sagittis odio. Aliquam rhoncus leo ligula, sit amet luctus orci elementum at. Cras justo magna, tempor suscipit orci vel, tristique condimentum lorem. Quisque ut sem in urna maximus aliquet.</p>";

    echo "<p>Mauris feugiat ac tellus dapibus sollicitudin. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed pulvinar ornare tincidunt. Fusce non dapibus velit, vitae facilisis massa. Etiam commodo mi nec tortor dapibus porta. Nam viverra sem et vestibulum facilisis. Aenean orci est, vulputate vel cursus et, ullamcorper nec est. Donec congue nisl urna, ac convallis ligula varius nec.</p>";

    echo "<p>Donec hendrerit neque vitae mi malesuada blandit. Nunc feugiat eros non nunc pellentesque placerat. Praesent gravida fermentum nisi nec imperdiet. Aliquam volutpat quam nec consectetur maximus. Cras semper nunc luctus, bibendum sapien sit amet, varius mi. Sed ut orci augue. Pellentesque mi lacus, viverra rhoncus ex vitae, tincidunt euismod libero. Nullam pellentesque turpis sed est cursus elementum. Nulla varius, magna sed efficitur pellentesque, sapien lorem pretium erat, sit amet imperdiet lorem ante non libero. Fusce pellentesque eu lacus ac fermentum. Maecenas dignissim libero eu viverra rhoncus.</p>";

  } else if (isset($_SESSION['loggedin']) == true){
    $user_id = $_SESSION['userId'];
    $stmt = $conn->prepare("SELECT * FROM gu_users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result == true){
      $row = $result->fetch_assoc();
    } else {
      echo "Unable to retrieve customer info.";
    }
    ?>
    <div class="w-full items-center justify-center">
      <form class="flex flex-col w-full items-center h-auto drop-shadow-md" action="createPost.php" method="post">
        <input type="hidden" name="username" value="<?php echo $row['username'] ?>">
        <input type="hidden" name="userId" value="<?php echo $user_id ?>">
        <input type="hidden" name="pfp" value="<?php echo $row['profilePic'] ?>">
        <textarea name="content" class="input rounded-md h-48 placeholder:italic w-11/12 focus:outline-none pl-2 pt-2"></textarea>
        <button type="submit" class="button h-12 bg-blue-300 w-11/12 rounded-md text-center -mt-12">Submit Post</button>
      </form>
    </div>
    <?php
    $stmt2 = $conn->prepare("SELECT * FROM gu_posts p LEFT JOIN gu_comments c ON p.post_id = c.p_post_id ORDER BY p.post_id DESC");
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    if ($result2->num_rows > 0){
      while ($posts = $result2->fetch_assoc()){
        echo "<div class=\"w-full justify-center items-center mt-8\" >";
          echo "<div class=\"flex flex-col w-full items-center h-fit\" >";
            echo "<div class=\"w-11/12 bg-slate-100 rounded-md drop-shadow-md\" >";
              echo "<div id='$posts[post_id]'>";
                ?>
                <form action="profile.php" method="post" >
                  <button class="font-bold text-xl mt-4 ml-32" name="userID" value="<?php echo $posts['p_user_id'] ?>" > <?php echo $posts['username'] ?> </button>
                </form>
                <?php
                echo "<img class=\"w-12 h-12 rounded-full md:w-32 md:h-32 lg:w-24 lg:h-24 ml-4 -mt-8\" src=\"images/". $posts['image'] . "\" title=\"Posts user image\">";
              echo "</div>";
              echo "<hr class=\"mt-2\"/>";
              echo "<div>";
                echo "<p class=\"w-11/12 ml-4 mt-2 mb-2 text-lg\">" . $posts['content'] . "</p>";
              echo "</div>";
              echo "<hr class=\"mt-2\"/>";
              echo "<div>";
                echo "<p class='ml-4 font-bold text-xl'>" . $posts['c_username'] . "</p>";
                echo "<p class=\"w-11/12 ml-4 mt-2 mb-2 text-lg\">" . $posts['comments'] . "</p>";
              echo "</div>";
              echo "<hr class=\"mt-2\"/>";
              echo "<button class=\"ml-4 mt-2 mb-2 text-sm cursor-pointer collapsible\">Add Comment</button>";
                echo "<div class=\"content\">";
                  echo "<form class='form-container collapsible' method='post' action='addComment.php'>";
                    echo "<input type=\"hidden\" name=\"post_id\" value='$posts[post_id]'>";
                    echo "<input type=\"hidden\" name=\"username\" value='$row[username]'>";
                    echo "<input type=\"hidden\" name=\"userId\" value='$user_id'>";
                    echo "<textarea name=\"comment\" class=\"input rounded-md h-48 placeholder:italic w-full focus:outline-none pl-2 pt-2\"></textarea>";
                    echo "<button type=\"submit\" class=\"button -mt-20 h-12 bg-blue-300 w-full rounded-md text-center\">Submit Comment</button>";
                  echo "</form>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
      echo "</div>";
      }
    } else {
      echo "Unable to retrieve customer info.";
    }
    $conn->close();
  }
?>

  <script>

    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
          content.style.display = "none";
        } else {
          content.style.display = "block";
        }
      });
    }
  </script>

</main>

<?php

  require 'footer.php';

?>

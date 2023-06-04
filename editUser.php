<?php

require 'header.php';

$sessionId = $_SESSION["userId"];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE user_id = $sessionId"));
$id = $user["user_id"];
$email = $user["email"];
$username = $user["username"];

?>
<main id="main">
<div class="allf">
    <form method="post" action="updateUser.php">
        <div>
            <label for ="email"><b>Email</b></label>
            <input type="email" name="email" value="<?php echo "$email" ?>">
            <br/>
        </div>

        <div>
            <label for ="username"><b>Username</b></label>
            <input type="text" name="username" value="<?php echo "$username" ?>">
        </div>

        <input type="submit" class="btn" value="Submit">
    </form>
</div>
</main>
<?php

require 'footer.php';

?>

<?php

  require 'header.php';

?>
<main id="main">
<form class="allf" method="post" action="processNewUser.php">
  <h2>New User</h2>

    <label for ="email">Email</label>
    <input type="email" name="email" placeholder="abe@bprd.com" required="true">
    <br>

    <label for ="username">Username</label>
    <input type="text" name="username" required="true" required="true">
    <br>

    <label for ="password1">Password</label>
    <input type="password" name="password1" required="true" required="true">
    <br>

    <label for ="password2">Confirm Password</label>
    <input type="password" name="password2" required="true" required="true">
    <br>

    <label class="containertc">Please confirm you agree to the T&C's
      <input type="checkbox" required="true">
      <span class="checkmark"></span>
    </label>
    <br>

    <input type="submit" value="Submit">
</form>
</main>
<?php

  require 'footer.php';

?>

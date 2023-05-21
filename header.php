<?php  session_start(); ?>
<?php require "dbaccess.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nostalgia</title>
  <link rel="stylesheet" href="css/style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" type="image/x-icon" href="./images/favicon.png">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
  <body>
    <div class="sidenav" id="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <?php
        if (isset($_SESSION['loggedin']) == false){
          echo "<img src=\"./images/logo.png\" alt=\"Company Logo\" class=\"logo\">";
          echo "<a href=\"index.php\">Home</a>";
          echo "<a class=\"open-button\" data-open-modal>Login/Register</a>";
        } else if (isset($_SESSION['loggedin']) == true){
          echo "<img src=\"./images/logo.png\" alt=\"Company Logo\" class=\"logo\">";
          echo "<p> Welcome " . $_SESSION['username'] . ".</p>";
          echo "<a href=\"index.php\">Home</a>";
          echo "<a href=\"userProfile.php\">Profile</a>";
          echo "<a href=\"editUser.php\">Update Details</a>";
          echo "<a href='logout.php'>Logout</a>";
        }

      ?>
    </div>
      <dialog data-modal class="rounded-md" id="form">
        <form action="authenticate.php" method="post" class="form-container login">
          <button class="cancel" formmethod="dialog" data-close-modal>&times;</button>

          <h1>Login</h1>

          <label for="email"><b>Email</b></label>
          <input type="text" placeholder="Enter Email" name="email" required>

          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" required>

          <button type="submit" class="btn">Login</button>
        </form>
        <hr/>
        <form class="form-container register" method="post" action="processNewUser.php">
          <h2>New User</h2>

            <label for ="email"><b>Email</b></label>
            <input type="email" name="email" placeholder="abe@bprd.com" required="true">
            <br>

            <label for ="username"><b>Username</b></label>
            <input type="text" name="username" required="true" required="true">
            <br>

            <label for ="password1"><b>Password</b></label>
            <input type="password" name="password1" required="true" required="true">
            <br>

            <label for ="password2"><b>Confirm Password</b></label>
            <input type="password" name="password2" required="true" required="true">
            <br>

            <input type="submit" class="btn" value="Submit">
        </form>
      </dialog>

      
    <script>

      const openButton = document.querySelector("[data-open-modal]")
      const closeButton = document.querySelector("[data-close-modal]")
      const modal = document.querySelector("[data-modal]")

      openButton.addEventListener("click", () => {
        var main = document.getElementById("main");
        var nav = document.getElementById("sidenav");
        var footer = document.getElementById("footer");
        main.classList.add("blur");
        nav.classList.add("blur");
        footer.classList.add("blur");

        modal.showModal()
      })

      closeButton.addEventListener("click", () => {
        var main = document.getElementById("main");
        var nav = document.getElementById("sidenav");
        var footer = document.getElementById("footer");
        main.classList.remove("blur");
        nav.classList.remove("blur");
        footer.classList.remove("blur");

        modal.close()
      })

      modal.addEventListener("click", e => {
        const dialogDimensions = modal.getBoundingClientRect()
        if (
            e.clientX < dialogDimensions.left ||
            e.clientX > dialogDimensions.right ||
            e.clientY < dialogDimensions.top ||
            e.clientY > dialogDimensions.bottom
        ) {
          var main = document.getElementById("main");
          var nav = document.getElementById("sidenav");
          var footer = document.getElementById("footer");
          main.classList.remove("blur");
          nav.classList.remove("blur");
          footer.classList.remove("blur");

          modal.close()
        }
      })

      function openNav() {
        document.getElementById("sidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "280px";
        document.getElementById("footer").style.marginLeft = "280px";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
      }

      function closeNav() {
        document.getElementById("sidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "2%";
        document.body.style.backgroundColor = "#EAEDED";
      }
    </script>
    <span style="font-size:30px;cursor:pointer;margin-left:2%;" onclick="openNav()">&#9776;</span> 
    </div>
    
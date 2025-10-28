<?php

include('config.php');
session_start();

$showSignUp = false;
$registrationSuccess = false;

if (isset($_POST['register'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmpass = $_POST['confirm_password'];
  $access_level = "User";

  if ($password == $confirmpass) {
    $insert_query = "INSERT INTO tbluser(Username, Password, AccessLevel) VALUES('$email', '$password', '$access_level')";
    $insert_query_run = mysqli_query($conn, $insert_query);

    if ($insert_query_run) {
      $registrationSuccess = true;
    } else {
      $error_signin = "Failed to register, please try again.";
      $showSignUp = true;
    }
  } else {
    $error_signin = "Passwords don't match, please try again.";
    $showSignUp = true;
  }
} elseif (isset($_POST['login'])) {
  $uname = $_POST['username'];
  $password = $_POST['password'];

  $sql = mysqli_query($conn, "SELECT * FROM tbluser WHERE Username='$uname' AND Password='$password'");
  $rows = mysqli_fetch_assoc($sql);
  $count = mysqli_num_rows($sql);

  if ($count == 1) {
    $_SESSION['username'] = $uname;
    $_SESSION['access'] = $rows['AccessLevel'];
    if ($_SESSION['access'] == 'User') {
      header("Location: home.php");
    } else if ($_SESSION['access'] == 'Admin') {
      header("Location: user_admin.php");
    }
  } else {
    $error = "Username or password is incorrect, please try again.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In | Knit Knot Nook</title>
  <link rel="stylesheet" type="text/css" href="login.css" />
  <link rel="icon" href="image/logo1.png">
  <link rel="stylesheet" href="Assets/bootstrap-5.3.3-dist/css/bootstrap.css">
  <script src="Assets/bootstrap-5.3.3-dist/js/bootstrap.js"></script>
  <script src="Assets/jquery-3.7.1.min.js"></script>
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <!-- login -->
        <form method="post" class="sign-in-form">
          <h2 class="title" style="font-weight: bold;">Log in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input name="username" type="text" placeholder="Username" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input minlength="8" name="password" type="password" placeholder="Password" required />
          </div>
          <?php
          if (isset($error)) {
          ?>
            <div class="alert alert-danger" role="alert">
              <?= $error; ?>
            </div>
          <?php } ?>
          <input type="submit" name="login" value="Login" class="btn-solid" />
        </form>


        <!-- signup -->
        <form method="post" class="sign-up-form">
          <h2 class="title" style="font-weight: bold;">Sign up</h2>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input name="email" required type="text" placeholder="Username" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input minlength="8" name="password" required type="password" placeholder="Password" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input minlength="8" name="confirm_password" required type="password" placeholder="Confirm Password" />
          </div>
          <?php
          if (isset($error_signin)) {
          ?>
            <div class="alert alert-danger" role="alert">
              <?= $error_signin; ?>
            </div>
          <?php } ?>
          <input type="hidden" id="show-signup" value="<?= $showSignUp ? 'true' : 'false' ?>">
          <input type="hidden" id="registration-success" value="<?= $registrationSuccess ? 'true' : 'false' ?>">
          <input type="submit" name="register" class="btn-sol" value="Sign up" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h1>Be one of us!</h1>
          <p>
          <h4>Stay Warm with Our Unique Crochet Creations - Join Our Community for Special Offers and Updates!</h4>
          </p>
          <button class="btn transparent" id="sign-up-btn" class="sign-up">
            Sign up
          </button>
        </div>
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h1>Already have an account?</h1>
          <p>
          <h4>Log In to Access Your Crochet Collection and Special Offers!</h4>
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Log in
          </button>
        </div>
      </div>
    </div>
  </div>
  <script>
    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container = document.querySelector(".container");

    sign_up_btn.addEventListener("click", () => {
      container.classList.add("sign-up-mode");
    });

    sign_in_btn.addEventListener("click", () => {
      container.classList.remove("sign-up-mode");
    });

    document.addEventListener('DOMContentLoaded', function() {
      const showSignUp = document.querySelector('#show-signup').value;
      const registrationSuccess = document.querySelector('#registration-success').value;

      if (showSignUp === 'true') {
        container.classList.add("sign-up-mode");
      }

      if (registrationSuccess === 'true') {
        setTimeout(() => {
          container.classList.remove("sign-up-mode");
        }, 300); // Delay for smooth animation
      }
    });
  </script>
</body>

</html>

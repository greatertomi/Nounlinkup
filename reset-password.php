<?php
session_start();
if (isset($_SESSION['matricno'])) {
  header("location:dashboard.php");
}

include("functions.php");
include("footer.php");

$conn = db_connect();
$sentAlert = false;
$sentFailedAlert = false;
$emailNotFoundAlert = false;
?>
<html>

<head>
  <title>Linkup</title>
  <link rel="icon" href="./bn/img/noun2.jpg" sizes="32x32">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="bn/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="bn/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="bn/css/linkup.css" rel="stylesheet">
  <link href="css/mystyle.css" rel="stylesheet">

  <style>
    #login {
      margin-top: 100px;
    }

    h3 {
      margin-bottom: 30px;
      font-weight: 600;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="loginNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index.php">NOUN Linkup</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="register.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="blog/index.php">News</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php
  if (isset($_POST['sendmail'])) {
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $url = "http://nounlinkup.dns7554.webfactional.com/change-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
    $expires = date("U") + 7000;

    $email = $_POST['email'];
    $sql = mysqli_query($conn, "SELECT * FROM users where email = '$email'");

    if (mysqli_num_rows($sql) > 0) {
      $query1 = "DELETE FROM pwdReset WHERE pwdResetEmail='$email'";
      $result1 = mysqli_query($conn, $query1);

      $hashedToken = password_hash($token, PASSWORD_DEFAULT);
      $query2 = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires)
          VALUES ('$email', '$selector', '$hashedToken', '$expires')";
      $result2 = mysqli_query($conn, $query2);

      $to = $email;
      $subject = "Reset your password for NounLinkup";
      $message = "<p>We recieved a password reset request. The link to reset your password is below.
            If you didn't make this request, you can just ignore this email</p>";
      $message .= "<p>Here is your password reset link: <br/>";
      $message .= "<a href='" . $url . "'>" . $url . "</a></p>";

      $headers = "MIME-Version:1.0\r\n";
      $headers .= "Content-Type:text/html; charset=iso-8859-1\r\n";
      $headers .= "from NounLinkup <oshalusijohn@gmail.com> \r\n";
      $headers .= "Reply-To: oshalusijohn@gmail.com\r\n";

      if (mail($to, $subject, $message, $headers)) {
        $sentAlert = true;
      } else {
        $sentFailedAlert = true;
      }
    } else {
      $emailNotFoundAlert = true;
    }
  }
  ?>

  <div class="container" id="login">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div>
          <h4>Enter your email to retrieve your password</h4>
        </div>
        <div>
          <?php
          if ($emailNotFoundAlert == true) {
            echo "
                <div class='alert alert-danger'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  This email does not exist</a>.
                </div>";
          }

          if ($sentAlert == true) {
            echo "
                <div class='alert alert-success'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  Check your email to change your password</a>.
                </div>";
          } else if ($sentFailedAlert == true) {
            echo "
                <div class='alert alert-danger'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  Could not sent email</a>.
                </div>";
          }
          ?>

          <form method="post" action="" data-parsley-validate id="login-form">
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="email" name="email" class="form-control" data-parsley-required-message="Your email address is required" required="" autofocus="autofocus" placeholder="Enter your email address">
              </div>
            </div>
            <input type="submit" id="btnlogin" name="sendmail" value="SEND EMAIL">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="js/jquery.js"></script>
  <script src="bn/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/parsley.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="bn/vendor/jquery-easing/jquery.easing.min.js"></script>

  <script>
    $(function() {
      $("#login-form").parsley();
    });
  </script>

  <div id="footerDiv">
    <?php echo footer(); ?>
  </div>
</body>

</html>
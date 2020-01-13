<?php
session_start();
if (isset($_SESSION['matricno'])) {
  header("location:dashboard.php");
}

include("functions.php");
include("footer.php");

$conn = db_connect();
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

  <div class="container" id="login">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div>
          <h4>Change Password</h4>
        </div>
        <?php
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];

        if (empty($selector) || empty($validator)) {
          echo "Could not validate your request";
        } else {
          if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
            ?>
            <div>
              <form method="post" action="change-password2.php" data-parsley-validate id="login-form">
                <input type="hidden" name="selector" value="<?php echo $selector ?>" />
                <input type="hidden" name="validator" value="<?php echo $validator ?>" />

                <div class="form-group">
                  <label for="matricNo">New password:</label>
                  <div class="form-label-group">
                    <input type="password" id="password1" name="password1" class="form-control" data-parsley-minlength="6" data-parsley-minlength-message="Password must be atleast 6 characters" required="" autofocus="autofocus">
                  </div>
                </div>

                <div class="form-group">
                  <label for="matricNo">Confirm new password:</label>
                  <div class="form-label-group">
                    <input type="password" id="password2" name="password2" class="form-control" data-parsley-equalto="#password1" data-parsley-equalto-message="Not the same as the new password field">
                  </div>
                </div>
                <input type="submit" id="btnlogin" name="savepassword" value="SAVE NEW PASSWORD">
              </form>
            </div>
        <?php
          }
        }
        ?>
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
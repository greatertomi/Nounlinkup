<?php
session_start();
if (isset($_SESSION['matricno'])) {
  header("location:dashboard.php");
}

include("functions.php");
include("footer.php");

$conn = db_connect();
date_default_timezone_set('Africa/Lagos');
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

    #Lforgot {
      color: #328130;
      font-weight: 700;
    }

    #LRegister {
      margin-left: 15px;
    }

    #highlight {
      margin-bottom: 25px;
    }
  </style>
</head>

<body>
  <?php
  if (isset($_POST["login"])) {
    $matricno = $_POST['matricno'];
    $password = $_POST['password'];

    $query = "select* from users where matricno = '$matricno' and password = '$password'";
    $result = mysqli_query($conn, $query) or die("Could not query database");
    $row = mysqli_fetch_array($result);
    $matricno = $row['matricno'];
    //echo $matricno;
    if (mysqli_num_rows($result) > 0) {
      $time = date("Y-m-d H:i:s");
      $query2 = "insert into login_details (matricno, last_activity) values ('$matricno', '$time')";
      $result2 = mysqli_query($conn, $query2) or die("Could not insert datas into login details table");
      $query3 = mysqli_query($conn, "select * from login_details where matricno = '$matricno' and last_activity = '$time'");
      $row2 = mysqli_fetch_array($query3);
      $_SESSION['matricno'] = $matricno;
      $_SESSION['login_id'] = $row2['login_id'];

      ?>
      <script>
        window.open("dashboard.php", "_self", false);
      </script>
  <?php
    } else
      $error = "<span id = 'error'>User record does not exist</span>";
  }
  ?>

  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="loginNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index.php">NOUN Linkup</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="#">Login</a>
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
          <h3>Log In to LinkUp</h3>
        </div>
        <div>
          <form method="post" action="" data-parsley-validate id="login-form">
            <div class="form-group">
              <label for="matricNo">Matric number:</label>
              <div class="form-label-group">
                <input type="text" id="matricno" name="matricno" class="form-control" data-parsley-required-message="Your matric number is required" required="" autofocus="autofocus">
              </div>
            </div>
            <div class="form-group">
              <label for="matricNo">Password:</label>
              <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" data-parsley-required-message="You need a password to login" required="">
              </div>
            </div>
            <div class="form-group">
              <?php
              if (isset($error)) {
                echo $error;
              }
              ?>
            </div>
            <div id="highlight"><a href="#" id="Lforgot">I forgot my password</a></div>
            <input type="submit" id="btnlogin" name="login" value="LOGIN">
          </form>
          <div id="highlight" class="text-center"><a href="register.php" id="Lregister">Not a member yet? Sign up here</a></div>
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

  <?php echo footer(); ?>
</body>

</html>
<?php
session_start();
include("footer.php");

if (isset($_SESSION['matricno'])) {
  header("Location:dashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="./bn/img/noun2.jpg" sizes="32x32">

  <title>LinkUp - Meet wonderful people </title>

  <link href="bn/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="bn/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="bn/css/linkup.css" rel="stylesheet">
  <link href="css/mystyle.css" rel="stylesheet">
  <script src="js/jquery.js"></script>

  <style>
    #contact {
      margin-bottom: 100px;
    }
  </style>

</head>

<body id="page-top">
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#">NOUN Linkup</a>
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

  <header class="masthead text-center text-white d-flex">
    <div class="container my-auto">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <h1 class="text-uppercase">
            <strong>Connect with other NOUN students</strong>
          </h1>
          <hr>
        </div>
        <div class="col-lg-8 mx-auto">
          <p class="text-faded mb-5"></p>
          <a class="btn btn-primary btn-xl js-scroll-trigger" href="register.php">Get Started!</a>
        </div>
      </div>
    </div>
  </header>

  <section class="bg-primary" id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto text-center">
          <h2 class="section-heading text-white">We've got what you need!</h2>
          <hr class="light my-4">
          <p class="text-faded mb-4">NOUN linkup has got what you need to interact with your mates from a different location. You can get involved in group discussion and even have a chat with your lecturer.</p>
          <a class="btn btn-light btn-xl js-scroll-trigger" href="login.php">Get Started!</a>
        </div>
      </div>
    </div>
  </section>

  <section id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading">At Your Service</h2>
          <hr class="my-4">
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 text-center">
          <div class="service-box mt-5 mx-auto">
            <i class="fas fa-4x fa-gem text-primary mb-3 sr-icon-1"></i>
            <h3 class="mb-3">Interactive Platform</h3>
            <p class="text-muted mb-0">This site uses modern tools to develop a platform you would love to use.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="service-box mt-5 mx-auto">
            <i class="fas fa-4x fa-paper-plane text-primary mb-3 sr-icon-2"></i>
            <h3 class="mb-3">Get Answers</h3>
            <p class="text-muted mb-0">You can get your questions answered here and improve yourself.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="service-box mt-5 mx-auto">
            <i class="fas fa-4x fa-code text-primary mb-3 sr-icon-3"></i>
            <h3 class="mb-3">Up to Date</h3>
            <p class="text-muted mb-0">We provide you with up-to-date news about the activities of the school.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="service-box mt-5 mx-auto">
            <i class="fas fa-4x fa-heart text-primary mb-3 sr-icon-4"></i>
            <h3 class="mb-3">Made with Love</h3>
            <p class="text-muted mb-0">We love and value you and that's why we built this for you.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto text-center">
          <h2 class="section-heading">Let's Get In Touch!</h2>
          <hr class="my-4">
          <p class="mb-5">Do you have any challenge? Give us a call or send us an email and we will get back to you as soon as possible!</p>
        </div>
      </div>
      <div class="row contacts">
        <div class="col-lg-4 ml-auto text-center">
          <i class="fas fa-phone fa-3x mb-3 sr-contact-1"></i>
          <p>07031512655</p>
        </div>
        <div class="col-lg-4 mr-auto text-center">
          <i class="fas fa-envelope fa-3x mb-3 sr-contact-2"></i>
          <p>
            <a href="#">oshalusijohn@gmail.com</a>
          </p>
        </div>
      </div>
    </div>
  </section>

  <?php echo footer(); ?>

  <script src="bn/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="bn/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="bn/vendor/scrollreveal/scrollreveal.min.js"></script>
  <script src="bn/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script src="bn/js/linkup.js"></script>

</body>

</html>
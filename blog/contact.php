<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
    <link rel="icon" href="../bn/img/noun2.jpg" sizes="32x32">
    
		<title>Contact us</title>
		<link href="tools/css/bootstrap.css" rel="stylesheet">
		<link href="tools/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="tools/css/clean-blog.css" rel="stylesheet">
    <style>
        .error {
            list-style-type: none;
        }
    </style>
	</head>
	
	<body>
		<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
		  <div class="container">
			<a class="navbar-brand" href="index.html">Linkup Blog</a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			  Menu
			  <i class="fa fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
			  <ul class="navbar-nav ml-auto">
				<li class="nav-item">
				  <a class="nav-link" href="../index.php">Home</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="index.php">Blog Home</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="about.php">About Us</a>
				</li>
			  </ul>
			</div>
		  </div>
		</nav>
		
		<header class="masthead" style="background-image: url('img/contact-bg.jpg')">
		  <div class="overlay"></div>
		  <div class="container">
			<div class="row">
			  <div class="col-lg-8 col-md-10 mx-auto">
				<div class="page-heading">
				  <h1>Contact Me</h1>
				  <span class="subheading">Have questions? I have answers.</span>
				</div>
			  </div>
			</div>
		  </div>
		</header>
		
		<div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
          <form name="sentMessage" id="contactForm" novalidate>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Email Address</label>
                <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Phone Number</label>
                <input type="tel" class="form-control" placeholder="Phone Number" id="phone" required data-validation-required-message="Please enter your phone number.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Message</label>
                <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <hr>
	
	<footer>
      <div class="container">
        <p class="copyright text-muted">Copyright &copy; Oluwalusi John 2018</p>
      </div>
    </footer>
	<script src="tools/js/jquery.js"></script>
    <script src="tools/js/bootstrap.bundle.js"></script>

    <script src="tools/js/jqBootstrapValidation.js"></script>
    <script src="tools/js/contact_me.js"></script>

    <script src="tools/js/clean-blog.js"></script>
	</body>
</html>
<?php
include("functions.php");
$conn = db_connect();
session_start();
?>
<html>

<head>
	<title> Page not found</title>
	<link rel="icon" href="./bn/img/noun2.jpg" sizes="32x32">
	<link href="bn/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bn/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="bn/css/linkup.css" rel="stylesheet">
	<link href="css/mystyle.css" rel="stylesheet">
	<script src="js/jquery.js"></script>

	<style>
		h1 {
			font-size: 60px;
			font-weight: bold
		}

		.col-md-7 {
			border-right: solid 1px #A6A6A6;
		}

		.astk {
			color: #B94A48;
		}

		footer {
			margin-top: 50px;
			height: 100px;
			background-color: #F0F0F0;
			padding-top: 30px;
		}

		footer p {
			font-size: 12px;
			margin-left: 50%;
		}

		.image {
			margin-left: 36%;
		}

		.btn-primary {
			margin: 10px 0 0 41%;
		}
	</style>



</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
		<div class="container">
			<a class="navbar-brand js-scroll-trigger" href="#page-top">NOUN Linkup</a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="login.php">login</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="blog/index.php">News</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class='jumbotron'>
		<div class='container'>
			<h1>NOUN LINKUP</h1>
		</div>
	</div>

	<div class="container">
		<div class="image">
			<img src="img/lost_page.jpg">
		</div>
		<a class="btn btn-primary" href="dashboard.php">Go to dashboard</a>

	</div>

	<footer>
		<p>&copy NOUN Linkup 2019</p>
	</footer>
	<script src="bn/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="bn/vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="bn/vendor/scrollreveal/scrollreveal.min.js"></script>
	<script src="bn/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
	<script src="bn/js/linkup.js"></script>

</body>

</html>
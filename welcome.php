<?php
session_start();
include("footer.php");

$name = $_SESSION['name'];
$matricno = $_SESSION['matricno'];
$picture = $_SESSION['picture'];
?>

<html>

<head>
	<title> Welcome</title>
	<link rel="icon" href="./bn/img/noun2.jpg" sizes="32x32">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="bn/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bn/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="bn/css/linkup.css" rel="stylesheet">

	<style>
		#address {
			margin-top: 90px;
		}

		.btn {
			margin-right: 30px;
		}

		.row {
			margin-bottom: 20px;
		}

		.data {
			text-align: center;
		}

		#address h2 {
			color: #328130;
			font-weight: 700;
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
						<a class="nav-link js-scroll-trigger" href="#">News</a>
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

	<div class="container" id="address">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-4 data">
				<img src="<?php echo $picture; ?>" height="300" width="300">
			</div>
			<div class="col-md-6">
				<h2>Welcome to NOUN Linkup</h2>
				<p>Welcome onboard <?php echo $name ?>. This a site specifically made to connect various NOUN Students accross
					the nation. To get the best from this site, we would advice you to read up our documentation <a href="#">here</a>.</p>

				<p>Happy connecting!</p>
				<div>
					<a class="btn btn-primary btn-xl js-scroll-trigger" href="welcome2.php">Start connecting</a>
					<a class="btn btn-primary btn-xl js-scroll-trigger" href="index.php">Later</a>
				</div>
			</div>
		</div>
	</div>

	<?php echo footer(); ?>
</body>

</html>
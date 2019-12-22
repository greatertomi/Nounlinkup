<?php
	include("functions.php");
	$conn = db_connect();
	$id = $_GET['id'];
?>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>News</title>
		<link rel="icon" href="../bn/img/noun2.jpg" sizes="32x32">
		<link href="tools/css/bootstrap.css" rel="stylesheet">
		<link href="tools/css/font-awesome.css" rel="stylesheet" type="text/css">
		<link href="tools/css/clean-blog.css" rel="stylesheet">
		
		<style>
			#linkup {
				color:green;
			}
			footer {
                margin: 20px 0 2px 45%;
                font-size:14px;
            }
		</style>
	</head>
	
	<body>
		<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
		  <div class="container">
			<a class="navbar-brand" href="index.php">Linkup Blog</a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			  Menu
			  <i class="fa fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
			  <ul class="navbar-nav ml-auto">
				<li class="nav-item">
				  <a class="nav-link" href="../index.php">Index</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="index.php">Blog Home</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="contact.php">Contact</a>
				</li>
			  </ul>
			</div>
		  </div>
		</nav>
		<?php
			$query = "select * from blog where id = '$id'";
			$result = mysqli_query($conn, $query) or die("Could not query database");
			
			$row = mysqli_fetch_array($result);
			$headline = $row['headline'];
			$subhead = $row['sub_heading'];
			$body = $row['body'];
			$author = getAuthor($row['author']);
			$date1 = strtotime($row['date_published']);
			$date2 = date("F j, Y",$date1);
			$headpix = $row['headline_pix'];
			$bodypix = $row['body_pix'];
			$pixcaption = $row['image_caption'];

			echo "
				<header class='masthead' style='background-image: url($headpix)'>
					<div class='overlay'></div>
					<div class='container'>
						<div class='row'>
							<div class='col-lg-8 col-md-10 mx-auto'>
								<div class='post-heading'>
									<h1>$headline</h1>
									<h2 class='subheading'>$subhead</h2>
									<span class='meta'>Posted by
									<a href='#'>$author</a>
									on $date2</span>
								</div>
							</div>
						</div>
					</div>
				</header>

				<article>
					<div class='container'>
						<div class='row'>
							<div class='col-lg-8 col-md-10 mx-auto'>
								$body
								<a href='#'>
									<img class='img-fluid' src='$bodypix' alt='' height = '400px' width = '730px'>
								</a>
								<span class='caption text-muted'>$pixcaption</span>
							</div>
						</div>
					</div>
				</article>
				
				<footer>
                    &copy LinkupBlog 2018
                </footer>";

		?>
		
		
	</body>
	
</html>
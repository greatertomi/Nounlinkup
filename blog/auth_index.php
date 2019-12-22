<?php
	include("functions.php");
	$conn = db_connect();
	session_start();
	if(!isset($_SESSION['user'])) {
		header("location:login2.php");
	}
	$email = $_SESSION['user'];
	$authid = "";
	
	$query = "select * from author where email = '$email'";
	$result = mysqli_query($conn, $query);
	
	while ($row = mysqli_fetch_array($result)) {
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$authid = $row['authid'];
		$_SESSION['authid'] = $authid;
	}
?>
<html>
	<head>
		<title><?php echo $lastname. " ".$firstname; ?></title>
		<link rel="icon" href="../bn/img/noun2.jpg" sizes="32x32">
		<link href = "../bn/vendor/bootstrap/css/bootstrap.min.css" rel = "stylesheet">
		<link href="../bn/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="../css/font-awesome.min.css" rel="stylesheet">

		<link href = "../bn/css/linkup.css" rel = "stylesheet">
		<script src="../js/jquery-1.10.2.min.js"></script>	
		
		<style>
			h1 {
				font-size: 60px;
				font-weight:bold
			}
			.col-md-7 {
				border-right:solid 1px #A6A6A6;
			}	
			
			#logout {
				text-transform:capitalize;
				color:white;
				text-align:right;
			}
			.jumbotron {
				background-color:#d25d41;
				color:white;
			}
			#fa {
				color:#666666;
				margin-left:6px;
			}
			#fa:hover {
				color:black;
			}
			th {
				background-color:#d25d41;
				color:white;
			}

		</style>

	</head>
	
	<body>
		<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
			<div class="container">
				<a class="navbar-brand js-scroll-trigger" href="" id = "nav">NOUN Linkup</a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger active" href="#" id = "nav">Your Stories</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="add_news.php" id = "nav">Add Story</a>
						</li>
						<li class="nav-item" id="logout">
							<a class="nav-link js-scroll-trigger" href="logout2.php" id = "nav">logout <?php echo $firstname; ?></a>
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

		<div class = "container">
			<div class="col-md-12">
				<h5 class="lg-title">Your stories</h5><br/>

				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>HeadLine</th>
								<th>Date witten</th>
								<th>Published</th>
							</tr>
						</thead>
						<tbody class='news_list'>
						<?php
							$query = "select * from blog where author = '$authid'";
							$result = mysqli_query($conn, $query) or die("Could not select from database");
							$counter = 1;

							while ($rows = mysqli_fetch_array($result)) {
								$headline = $rows["headline"];
								$date1 = strtotime($rows["date_written"]);
								$published = $rows["published"];
								$newsid = $rows["id"];
								$date2 = date("d/m/Y  g:i a",$date1);

								echo "<tr>
									<td>$counter</td>
									<td>$headline</td>
									<td>$date2</td>
									<td>$published</td>
									<td class='table-action'>
										<a href='edit_news.php?id=$newsid' data-toggle='tooltip' title='Edit' class='tooltips'><span id='fa'><i class='fa fa-pencil'></span></i></a>
										<a href='' data-toggle='tooltip' title='Delete' class='delete tooltips' id = '$newsid'><span id='fa'><i class='fa fa-trash-o'></span></i></a>
									</td>
								</tr>";
								++$counter;
							}
						?>
						</tbody>
					</table>
				</div>
						
			</div><!-- row -->
		</div>

		<script src="../bn/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="../bn/vendor/jquery-easing/jquery.easing.min.js"></script>
		<script src="../bn/vendor/scrollreveal/scrollreveal.min.js"></script>
		<script src="../bn/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="../bn/js/linkup.js"></script>

		<script>
			var authid = <?php echo json_encode($authid); ?>

			$(".delete").click(function(){
				var c = confirm("Continue delete?");
				
				if(c) {  
					var newsid = this.id;

					$.ajax({
						type: "POST",
						url: "Processor.php",
						data: {
							delete1:newsid,
							authid:authid
						},
						success: function(response) {
							$(".news_list").html(response);
						}
					});
				}
				else
					return false;
			});
			
		</script>
	</body>
</html>
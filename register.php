<?php
include("functions.php");
include("footer.php");

$conn = db_connect();
session_start();
if (isset($_SESSION['matricno'])) {
	header("Location:dashboard.php");
}
?>
<html>

<head>
	<title> Register an account</title>
	<link rel="icon" href="./bn/img/noun2.jpg" sizes="32x32">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

		#emailerror {
			margin-left: 17px;
			color: #B94A48;
			font-size: 14px;
		}

		.errorinput {
			border-color: #B94A48;
		}

		@media (max-width: 480px) {
			#regsubmit {
				width: 180%;
			}

			#regsubmitRow {
				float: none;
				margin: 0 auto;
				margin-left: 0;
			}

			#copyright.text-right {
				text-align: left !important;
			}
		}

		@media (min-width: 730px) {
			#regsubmit {
				width: 300px;
			}
		}

		#regsubmit:disabled {
			background-color: #b2cfb1;
			cursor: default;
		}
	</style>
</head>

<body>
	<?php
	if (isset($_POST['submit'])) {
		$matric = strtoupper($_POST['matric']);
		$name = ucwords($_POST['name']);
		$password = $_POST['password'];
		$faculty = $_POST['faculty'];
		$level = $_POST['level'];
		$year = "2019/2020";
		$dept = $_POST['dept'];
		$study_centre = $_POST['study_centre'];
		$picture = upload_pix($matric);
		$phone_no = $_POST['phone_no'];
		$gender = $_POST['gender'];
		$email = $_POST['email'];

		$query = "insert into users values ('','$matric','$name','$password','$faculty','$dept','$level','$year','$study_centre','$gender','$email','$phone_no','','$picture','')";
		//echo $picture;
		$enter = mysqli_query($conn, $query) or die("could not insert data into database. " . mysqli_error($conn));

		if ($enter) {
			$_SESSION['name'] = $name;
			$_SESSION['matricno'] = $matric;
			$_SESSION['picture'] = $picture;

			?>
			<script>
				window.open("welcome.php", "_self", false);
			</script>
	<?php
		}
	}
	?>

	<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
		<div class="container">
			<a class="navbar-brand js-scroll-trigger" href="index.php">NOUN Linkup</a>
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

		<div id="reg_form">
			<h2>
				<center><b>USER'S REGISTRATION</b></center>

			</h2><br />
			<form action="" method="post" class="form-horizontal" id="register" enctype="multipart/form-data" data-parsley-validate>
				<div class="row">
					<div class="col-md-7">
						<div class="form-group">
							<label for="matric" class="col-md-2 control-label">Matric No<span class="astk">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control" id="matric" name="matric" required>
							</div>
							<div class="matricErrorDiv"></div>
						</div>

						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Full Name<span class="astk">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control" id="name" name="name" required>
							</div>
						</div>

						<div class="form-group">
							<label for="name" class="col-md-2 control-label">Gender<span class="astk">*</span></label>
							<div class="col-md-9">
								<input type="radio" id="gender" name="gender" value="Male" required> Male &nbsp &nbsp &nbsp
								<input type="radio" id="gender" name="gender" value="Female"> Female
							</div>
						</div>

						<div class="form-group">
							<label for="name" class="col-md-2 control-label">Email<span class="astk">*</span></label>
							<div class="col-md-9">
								<input type="email" class="form-control" id="email" name="email" required="">
							</div>
							<div class="errordiv"></div>
						</div>

						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Phone Number<span class="astk">*</span></label>
							<div class="col-md-9">
								<input type="number" class="form-control" id="phone_no" name="phone_no" data-parsley-type="digits" required="">
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="col-md-2 control-label">Password<span class="astk">*</span></label>
							<div class="col-md-9">
								<input type="password" class="form-control" id="password" name="password" data-parsley-minlength="6" required="">
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="col-md-4 control-label">Confirm Password<span class="astk">*</span></label>
							<div class="col-md-9">
								<input type="password" class="form-control" id="con_password" name="con_password" required="" data-parsley-equalto="#password" data-parsley-equalto-message="Not the same as the password field">
							</div>
						</div>

						<div class="form-group">
							<label for="faculty" class="col-md-2 control-label">Faculty<span class="astk">*</span></label>
							<div class="col-md-9">
								<select class="form-control" id="faculty" name="faculty" required="">
									<option value="">--Select a Faculty--</option>
									<?php

									$sql = "SELECT DISTINCT facultyid, faculty FROM department";
									$result = mysqli_query($conn, $sql);

									while ($row = mysqli_fetch_array($result)) {
										$faculty = $row['faculty'];
										$facultyid = $row['facultyid'];
										echo "<option value = '$facultyid'> $faculty</option>";
									}
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="dept" class="col-md-2 control-label">Department<span class="astk">*</span></label>
							<div class="col-md-9">
								<select class="form-control" id="dept" name="dept">
									<option value="">--select your faculty first--</option>
								</select>
							</div>
						</div>


						<div class="form-group">
							<label for="Study_centre" class="col-md-3 control-label">Study Centre<span class="astk">*</span></label>
							<div class="col-md-9">
								<select class="form-control" id="study_centre" name="study_centre" required="">
									<option value="">--Select a Study Centre--</option>
									<?php

									$sql = "SELECT * FROM study_centre";
									$result = mysqli_query($conn, $sql);

									while ($row = mysqli_fetch_array($result)) {
										$sn = $row['sn'];
										$name = $row['name'];
										echo "<option value = '$sn'> $name</option>";
									}
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="level" class="col-md-2 control-label">Level<span class="astk">*</span></label>
							<div class="col-md-9">
								<select class="form-control" id="level" name="level">
									<option value="100L">100L</option>
									<option value="200L">200L</option>
									<option value="300L">300L</option>
									<option value="400L">400L</option>
									<option value="500L">500L</option>
								</select>
							</div>
						</div>

					</div>
					<div class="col-md-4">
						<div id="header">Picture<span class="astk">*</span></div>
						<div>
							<p><img id="output_image" width="150" height="150">
								<p>
									<input type="file" accept="image/*" onchange="preview_image(event)" class="form-control" name="picture" id="picture" required="">
						</div>
					</div>

					<div class="row" id="regsubmitRow">
						<div class=" col-md-offset-2 col-md-9">
							<input type="submit" name="submit" value="REGISTER" id="regsubmit">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<?php echo footer() ?>
	<script src="bn/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="bn/vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="bn/vendor/scrollreveal/scrollreveal.min.js"></script>
	<script src="bn/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
	<script src="js/parsley.js"></script>
	<script src="bn/js/linkup.js"></script>

	<script>
		$(document).ready(function() {
			$("#faculty").change(function() {
				var faculty = $(this).val();
				$.ajax({
					url: "fetch_dept.php",
					data: {
						faculty: faculty
					},
					type: "POST",
					async: false,
					success: function(dept) {
						$("#dept").html(dept);
					}
				});
			});
			$("#register").parsley();
		});

		$(document).on("keyup", "#email", function() {
			var email = $("#email").val();
			$.ajax({
				url: "EmailCheck.php",
				type: "post",
				data: {
					email: email
				},
				success: function(data) {
					if (data == "yes") {
						$(".errordiv").html("<span id = 'emailerror'>This email address is already taken</span>");
						$("#name").addClass("errorinput");
						$("#regsubmit").attr("disabled", "true");
					} else {
						$(".errordiv").html("");
						$("#name").removeClass("errorinput");
						$("#regsubmit").removeAttr("disabled");
					}
				}
			});
		});

		$(document).on("keyup", "#matric", function() {
			let matric = $("#matric").val();
			$.ajax({
				url: "EmailCheck.php",
				type: "post",
				data: {
					matric: matric
				},
				success: function(data) {
					if (data == "yes") {
						$(".matricErrorDiv").html("<span id = 'emailerror'>This matric number belongs to someone else</span>");
						$("#regsubmit").attr("disabled", "true");
					} else {
						$(".matricErrorDiv").html("");
						$("#regsubmit").removeAttr("disabled");
					}
				}
			});
		});

		function preview_image(event) {
			var reader = new FileReader();
			reader.onload = function() {
				var output = document.getElementById('output_image');
				output.src = reader.result;
			}
			reader.readAsDataURL(event.target.files[0]);
		}
	</script>
</body>

</html>
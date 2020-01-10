<?php
include("functions.php");
$conn = db_connect();
session_start();
if (!$_SESSION['matricno']) {
	header("location:index.php");
}
$matricno = $_SESSION['matricno'];
$editSuccessfulAlert = false;

$query = "select * from users where matricno = '$matricno'";
$result = mysqli_query($conn, $query) or die("could not query database");
while ($row = mysqli_fetch_array($result)) {
	$name = $row['fullname'];
	$faculty = $row['faculty'];
	$password = $row['password'];
	$dept1 = $row['department'];
	$dept2 = getdept($dept1);
	$level = $row['level'];
	$year = $row['year'];
	$study_centre = $row['study_centre'];
	$gender = ucfirst($row['gender']);
	$email = $row['email'];
	$phone_no = $row['phone_no'];
	$about1 = trim($row['about']);
	$picture = $row['picture'];
	$updated = strtotime($row['updated']);
	$updated2 = date("F j, Y g:ia", $updated);
}

if ($email == "") {
	$gemail = "<span style = 'color:#d13438'>No email</span>";
}
//echo $study_centre;
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Edit Profile</title>
	<link rel="icon" href="./bn/img/noun2.jpg" sizes="32x32">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Bootstrap core CSS -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/mystyle.css" rel="stylesheet">

	<!-- Font Awesome -->
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/gritter/jquery.gritter.css">

	<!-- Pace -->
	<link href="css/pace.css" rel="stylesheet">

	<!-- Perfect -->
	<link href="css/app.min.css" rel="stylesheet">
	<link href="css/app-skin.css" rel="stylesheet">

	<style>
		.nav-header {
			background-color: #1a1a1b;
			padding: 10px 18px;
			border-radius: 6px;
			color: white;
			font-size: 16px;
		}

		#myProfile li {
			margin-bottom: 10px;
		}

		.main-menu ul li a:hover {
			text-decoration: none;
		}

		#aboutme {
			margin-left: 0px;
			text-align: left;
		}

		.alert-success {
			position: absolute;
			margin-left: 25%;
			min-width: 70%;
		}

		@media (max-width: 767px) {
			.alert-success {
				position: absolute;
				margin-left: 40%;
			}
		}
	</style>

	<script>
		function preview_image(event) {
			var reader = new FileReader();
			reader.onload = function() {
				var output = document.getElementById('output_image');
				output.src = reader.result;
			}
			reader.readAsDataURL(event.target.files[0]);
		}

		function successful() {
			$.gritter.add({
				title: '<i class="fa fa-times-circle"></i> Edited Successfully!',
				text: 'Your information has been updated successfully!',
				sticky: false,
				time: '',
				class_name: 'gritter-success'
			});
		}
	</script>

</head>

<body class="overflow-hidden">
	<!-- Overlay Div -->
	<div id="overlay" class="transparent"></div>

	<a href="profile.html" id="theme-setting-icon"><i class="fa fa-cog fa-lg"></i></a>
	<div id="theme-setting">
		<div class="title">
			<strong class="no-margin">Skin Color</strong>
		</div>
		<div class="theme-box">
			<a class="theme-color" style="background:#323447" id="default"></a>
			<a class="theme-color" style="background:#efefef" id="skin-1"></a>
			<a class="theme-color" style="background:#a93922" id="skin-2"></a>
			<a class="theme-color" style="background:#3e6b96" id="skin-3"></a>
			<a class="theme-color" style="background:#635247" id="skin-4"></a>
			<a class="theme-color" style="background:#3a3a3a" id="skin-5"></a>
			<a class="theme-color" style="background:#495B6C" id="skin-6"></a>
			<a class="theme-color" style="background:#328130" id="skin-7"></a>
		</div>

	</div><!-- /theme-setting -->

	<div id="wrapper" class="preload">
		<div id="top-nav" class="skin-7 fixed">
			<div class="brand">
				<span>Perfect</span>
				<span class="text-toggle"> Admin</span>
			</div><!-- /brand -->
			<button type="button" class="navbar-toggle pull-left" id="sidebarToggle">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<button type="button" class="navbar-toggle pull-left hide-menu" id="menuToggle">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<ul class="nav-notification clearfix">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-bell fa-lg"></i>
						<span class="notf_count bounceIn animation-delay6"></span>
					</a>
					<ul class="dropdown-menu notification dropdown-3" style="width:275px; max-width:290px;">

					</ul>
				</li>

				<li class="profile dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<strong><?php echo $name; ?></strong>
						<span><i class="fa fa-chevron-down"></i></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a class="clearfix" href="profile.html#">
								<img src="<?php echo $picture; ?>" alt="User Avatar">
								<div class="detail">
									<strong><?php echo $name; ?></strong>
									<p class="grey"><?php echo $email; ?></p>
								</div>
							</a>
						</li>
						<li><a tabindex="-1" href="#" class="main-link"><i class="fa fa-edit fa-lg"></i> Edit profile</a></li>
						<li><a tabindex="-1" href="all_notifications.php" class="main-link"><i class="fa fa-bullhorn fa-lg"></i> Notifications</a></li>
						<li><a tabindex="-1" href="#" class="theme-setting"><i class="fa fa-cog fa-lg"></i> Setting</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" class="main-link logoutConfirm_open" href="chat.phplogoutConfirm"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /top-nav-->

		<aside class="fixed skin-7">
			<div class="sidebar-inner scrollable-sidebar">
				<div class="size-toggle">
					<a class="btn btn-sm" id="sizeToggle">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="btn btn-sm pull-right logoutConfirm_open" href="chat.phplogoutConfirm">
						<i class="fa fa-power-off"></i>
					</a>
				</div><!-- /size-toggle -->
				<div class="user-block clearfix">
					<img src="<?php echo $picture; ?>" alt="User Avatar">
					<div class="detail">
						<strong><?php echo $name; ?></strong>
						<ul class="list-inline">
							<li class="active"><a href="profile.php">Profile</a></li>
							<li><a href="#" class="no-margin">Manage</a></li>
						</ul>
					</div>
				</div><!-- /user-block -->
				<div class="main-menu">
					<ul>
						<li>
							<a href="dashboard.php">
								<span class="menu-icon">
									<i class="fa fa-desktop fa-lg"></i>
								</span>
								<span class="text">
									Dashboard
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>
						<li>
							<a href="add_friends.php">
								<span class="menu-icon">
									<i class="fa fa-user fa-lg"></i>
								</span>
								<span class="text">
									Add friends
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>
						<li>
							<a href="chat.php">
								<span class="menu-icon">
									<i class="fa fa-comments fa-lg"></i>
								</span>
								<span class="text">
									Chat <span id="unread"></span>
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>
						<li class="openable">
							<a href="#">
								<span class="menu-icon">
									<i class="fa fa-users fa-lg"></i>
								</span>
								<span class="text">
									Groups <span id="unread2"></span>
								</span>
								<span class="menu-hover"></span>
							</a>
							<ul class="submenu">
								<li><a href="CreateGroup.php"><span class="submenu-label">Create Group</span></a></li>
								<li><a href="GroupChat.php"><span class="submenu-label">Group Chat</span></a></li>
							</ul>
						</li>
						<li>
							<a href="blog/index.php">
								<span class="menu-icon">
									<i class="fa fa-envelope fa-lg"></i>
								</span>
								<span class="text">
									Blog
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>
					</ul>
				</div><!-- /main-menu -->
			</div>
		</aside>

		<?php
		if (isset($_POST['update'])) {
			$name = ucfirst($_POST['name']);
			$password = $_POST['password'];
			$faculty = $_POST['faculty'];
			$level = $_POST['level'];
			$year = $_POST['year'];
			$dept = $_POST['dept'];
			$study_centre = $_POST['study_centre'];
			$phone_no = $_POST['phone_no'];
			$gender = $_POST['gender'];
			$email = $_POST['email'];
			$about2 = trim($_POST['about']);

			if ($_FILES['picture']['name'] == '') {
				$query2 = "UPDATE users SET fullname = '$name', password = '$password', faculty = '$faculty', department = '$dept', 
							level = '$level', year = '$year', study_centre = '$study_centre', phone_no = '$phone_no', gender = '$gender', 
							email = '$email', about = '$about2', updated = now() WHERE matricno = '$matricno'";
			} else {
				$picture = upload_pix($matricno);
				$query2 = "UPDATE users SET fullname = '$name', password = '$password', faculty = '$faculty', department = '$dept', picture = '$picture', 
							level = '$level', year = '$year', study_centre = '$study_centre', phone_no = '$phone_no', gender = '$gender', 
							email = '$email', about = '$about2', updated = now() WHERE matricno = '$matricno'";
			}
			$result2 = mysqli_query($conn, $query2) or die("could not insert into database " . mysqli_error($query2));

			if ($result2) {
				$editSuccessfulAlert = true;
			}
		}
		?>

		<div id="main-container">
			<div id="breadcrumb">
				<ul class="breadcrumb">
					<li><i class="fa fa-home"></i><a href="dashboard.php"> Home</a></li>
					<li class="active">Profile</li>
				</ul>
			</div>

			<div class="col-md-8">
				<?php
				if ($editSuccessfulAlert == true) {
					echo "
							<div class='alert alert-success'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								Your profile has been successfully edited</a>.
							</div>	
						";
				}
				?>
				<form class="form-horizontal form-border" method="post" action="" enctype="multipart/form-data" data-parsley-validate>
					<div class="panel-heading">
						Basic Information
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="control-label col-md-2">Name</label>
							<div class="col-md-10">
								<input type="text" class="form-control input-sm" placeholder="Enter name" name="name" value="<?php echo $name; ?>">
							</div><!-- /.col -->
						</div><!-- /form-group -->
						<div class="form-group">
							<label class="control-label col-md-2">Password</label>
							<div class="col-md-10">
								<input type="password" class="form-control input-sm" value="<?php echo $password; ?>" id="password" data-parsley-minlength="6" name="password">
							</div><!-- /.col -->
						</div><!-- /form-group -->
						<div class="form-group">
							<label class="control-label col-md-2">Confirm Password</label>
							<div class="col-md-10">
								<input type="password" class="form-control input-sm" value="<?php echo $password; ?>" data-parsley-equalto="#password" data-parsley-equalto-message="Your passwords are not the same" name="password">
							</div><!-- /.col -->
						</div><!-- /form-group -->
						<div class="form-group">
							<label class="control-label col-md-2">Email</label>
							<div class="col-md-10">
								<input type="email" class="form-control input-sm" value="<?php echo $email ?>" name="email" data-parsley-type="email">
							</div><!-- /.col -->
						</div><!-- /form-group -->
						<div class="form-group">
							<label class="control-label col-md-2">Gender</label>
							<?php
							if ($gender == "Male") {
								echo "<div class='col-md-10'>
											<label class='label-radio inline'>
												<input type='radio' name = 'gender' value = 'Male' checked>
												<span class='custom-radio'></span>
												Male
											</label>
											<label class='label-radio inline'>
												<input type='radio' name = 'gender' value = 'Female'>
												<span class='custom-radio'></span>
												Female
											</label>
										</div>";
							} else if ($gender == "Female") {
								echo "<div class='col-md-10'>
											<label class='label-radio inline'>
												<input type='radio' name = 'gender' value = 'Male'>
												<span class='custom-radio'></span>
												Male
											</label>
											<label class='label-radio inline'>
												<input type='radio' name = 'gender' value = 'Female' checked>
												<span class='custom-radio'></span>
												Female
											</label>
										</div>";
							} else {
								echo "<div class='col-md-10'>
											<label class='label-radio inline'>
												<input type='radio' name = 'gender' value = 'Male'>
												<span class='custom-radio'></span>
												Male
											</label>
											<label class='label-radio inline'>
												<input type='radio' name = 'gender' value = 'Female'>
												<span class='custom-radio'></span>
												Female
											</label>
										</div>";
							}
							?>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Phone</label>
							<div class="col-md-10">
								<input type="number" class="form-control input-sm" value="<?php echo $phone_no ?>" name="phone_no" data-parsley-type="digits" required>
							</div><!-- /.col -->
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Faculty</label>
							<div class="col-md-10">
								<select class="form-control" value="<?php echo $faculty; ?>" id="faculty" name="faculty" required>
									<?php

									$sql = "SELECT DISTINCT facultyid, faculty FROM department";
									$result = mysqli_query($conn, $sql);

									while ($row = mysqli_fetch_array($result)) {
										$facultyname = $row['faculty'];
										$facultyid = $row['facultyid'];

										if ($facultyid == $faculty) {
											echo "<option value = '$facultyid' selected> $facultyname</option>";
										} else {
											echo "<option value = '$facultyid'> $facultyname</option>";
										}
									}
									?>
								</select>
							</div><!-- /.col -->
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Department</label>
							<div class="col-md-10">
								<select class="form-control" value="<?php echo $dept ?>" id="dept" name="dept" required>
									<option value="<?php echo $dept1 ?>"><?php echo $dept2; ?></option>
								</select>
							</div><!-- /.col -->
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Study Centre</label>
							<div class="col-md-10">
								<select class="form-control" value="<?php echo $study_centre ?>" name="study_centre" required>
									<?php

									$sql = "SELECT * FROM study_centre";
									$result = mysqli_query($conn, $sql);

									while ($row = mysqli_fetch_array($result)) {
										$sn = $row['sn'];
										$name = $row['name'];

										if ($sn == $study_centre)
											echo "<option value = '$sn' selected> $name</option>";
										else
											echo "<option value = '$sn'> $name</option>";
									}
									?>

								</select>
							</div><!-- /.col -->
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Level</label>
							<div class="col-md-10">
								<select class="form-control" value="<?php echo $level ?>" name="level" required>
									<?php
									for ($i = 1; $i <= 5; $i++) {
										$lev = $i . "00L";
										if ($lev == $level)
											echo "<option value='$lev' selected>$lev</option>";
										else
											echo "<option value='$lev'>$lev</option>";
									}
									?>
								</select>
							</div><!-- /.col -->
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Year</label>
							<div class="col-md-10">
								<select class="form-control" value="<?php echo $year; ?>" name="year" required>
									<?php
									for ($i = 2019; $i < 2030; $i++) {
										$p = $i + 1;
										$year2 = "$i/$p";
										if ($year == $year2)
											echo "<option value='$year2' selected>$year2</option>";
										else
											echo "<option value='$year2'>$year2</option>";
									}
									?>
								</select>
							</div><!-- /.col -->
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">About Me</label>
						<div class="col-md-10">
							<textarea class="form-control" id="aboutme" placeholder="Who are you?" rows="3" value="<?php echo $about1 ?>" name="about" required><?php if ($about1 != "") echo $about1; ?></textarea>
						</div><span> </span>
					</div>
					<div class="panel-footer">
						<div class="text-right">
							<button class="btn btn-md btn-success" type="submit" name="update">Update</button>
							<button class="btn btn-md btn-success" type="reset">Reset</button>
						</div>
					</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-info pull-right">
					<div class="panel-body">
						<?php
						if ($updated == "0000-00-00 00:00:00" || $updated == "") {
							echo "This record has never been edited";
						} else {
							echo "Last updated: " . $updated2;
						}
						?>
					</div>
				</div><!-- /panel -->
				<div><br /><br /><br /></div>
				<div>
					<p><img id="output_image" src="<?php echo $picture; ?>" width="150" height="150">
						<p>
							<input type="file" accept="image/*" onchange="preview_image(event)" class="form-control" name="picture" id="picture">
				</div>


			</div>
			</form>
		</div>

		<div class="custom-popup width-100" id="logoutConfirm">
			<div class="padding-md">
				<h4 class="m-top-none"> Do you want to logout?</h4>
			</div>

			<div class="text-center">
				<a class="btn btn-success m-right-sm" href="logout.php">Logout</a>
				<a class="btn btn-danger logoutConfirm_close">Cancel</a>
			</div>
		</div>

		<script src="js/jquery-1.10.2.min.js"></script>
		<!-- Bootstrap -->
		<script src="bootstrap/js/bootstrap.min.js"></script>

		<!-- holder -->
		<script src='js/uncompressed/holder.js'></script>

		<!-- Modernizr -->
		<script src='js/modernizr.min.js'></script>
		<script src='js/sweetalert.js'></script>
		<script src='js/jquery.gritter.min.js'></script>

		<!-- Pace -->
		<script src='js/pace.min.js'></script>
		<script src="js/parsley.js"></script>

		<!-- Popup Overlay -->
		<script src='js/jquery.popupoverlay.min.js'></script>

		<!-- Slimscroll -->
		<script src='js/jquery.slimscroll.min.js'></script>

		<!-- Cookie -->
		<script src='js/jquery.cookie.min.js'></script>

		<!-- Perfect -->
		<script src="js/app/app.js"></script>

		<script>
			$(document).ready(function() {
				$("#faculty").change(function() {
					var facultyid = $(this).val();
					$.ajax({
						url: "fetch_dept.php",
						data: {
							faculty: facultyid
						},
						type: "POST",
						async: false,
						success: function(dept) {
							$("#dept").html(dept);
							//alert(dept);
						}
					});
				});
			});

			var user = <?php echo json_encode($matricno) ?>;
			unreadMsg();
			unreadMsg2();
			$('.alert-success').delay(15000).fadeOut(2000);

			function unreadMsg() {
				$.ajax({
					url: "UnreadMsg.php",
					type: "post",
					dataType: "json",
					data: {
						unread1: 1,
						user: user
					},
					success: function(response) {
						$("#unread").html(response[1]);
					}
				});
			}

			function unreadMsg2() {
				$.ajax({
					url: "UnreadMsg.php",
					type: "post",
					dataType: "json",
					data: {
						unread2: 1,
						user: user
					},
					success: function(response) {
						$("#unread2").html(response[1]);
					}
				});
			}

			function update_last_activity() {
				$.ajax({
					url: "update_last_activity.php",
					success: function() {}
				});
			}

			handleNotification();

			//Notification Handlers
			function handleNotification() {
				$.ajax({
					url: "notifications.php",
					type: "POST",
					dataType: "json",
					data: {
						notify: 1,
					},
					success: function(data) {
						$(".notification").html(data[1]);
						let notf_count = "<span class='notification-label'>" + data[0] + "</label>"
						if (data[0] !== 0) {
							$(".notf_count").html(notf_count);
						}
					}
				})
			}

			$(document).on("click", ".fa-bell", function() {
				setTimeout(function() {
					clearNotification()
				}, 10000);

				setTimeout(function() {
					$('.notf_count').html("");
				}, 8000);
			});

			$(document).on("click", ".notification li a", function() {
				clearNotification();
			});

			function clearNotification() {
				$.ajax({
					url: "notifications.php",
					type: "POST",
					data: {
						clear: 1,
						user: user
					},
					success: function() {
						handleNotification();
					}
				})
			}

			setInterval(function() {
				update_last_activity();
				handleNotification();
			}, 5000);

			setInterval(function() {
				unreadMsg();
				unreadMsg2();
			}, 3000);
		</script>

</body>

</html>
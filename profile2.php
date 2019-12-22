<?php
include("functions.php");
$conn = db_connect();
session_start();
$tocheck = $_GET['tocheck'];
$matricno = $_SESSION['matricno'];

$q = "select * from users where matricno = '$matricno'";
$r = mysqli_query($conn, $q) or die("could not query database");
while ($row = mysqli_fetch_array($r)) {
	$username = $row['fullname'];
	$userpicture = $row['picture'];
	$useremail = $row['email'];
}

$query = "select * from users where matricno = '$tocheck'";
$result = mysqli_query($conn, $query) or die("could not query database");
while ($row = mysqli_fetch_array($result)) {
	$name = $row['fullname'];
	$faculty = getfaculty($row['faculty']);
	$dept = $row['department'];
	$dept = getdept($dept);
	$level = $row['level'];
	$year = $row['year'];
	$study_centre = $row['study_centre'];
	$study_centre = getcentre($study_centre);
	$gender = ucfirst($row['gender']);
	$email = $row['email'];
	$phone_no = $row['phone_no'];
	$about = $row['about'];
	$picture = $row['picture'];
}

if ($email == "") {
	$email = "<span style = 'color:#d13438'>No email</span>";
}

if ($phone_no == "") {
	$phone_no = "<span style = 'color:#d13438'>No phone number</span>";
}

if ($about == "") {
	$about = "<span style = 'color:#d13438'>You need to tell us about yourself</span>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Profile</title>
	<link rel="icon" href="./bn/img/noun2.jpg" sizes="32x32">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Bootstrap core CSS -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Font Awesome -->
	<link href="css/font-awesome.min.css" rel="stylesheet">

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

		#requestSentLbl {
			color: #d13438;
			font-style: italic;
		}

		#alreadyFriendLbl {
			color: #129f59;
			font-style: italic;
		}
	</style>

</head>

<body class="overflow-hidden">
	<!-- Overlay Div -->
	<div id="overlay" class="transparent"></div>

	<a href="#" id="theme-setting-icon"><i class="fa fa-cog fa-lg"></i></a>
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
				<span>NOUN</span>
				<span class="text-toggle">Linkup</span>
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
						<strong><?php echo $username; ?></strong>
						<span><i class="fa fa-chevron-down"></i></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a class="clearfix">
								<img src="<?php echo $userpicture; ?>" alt="User Avatar">
								<div class="detail">
									<strong><?php echo $username ?></strong>
									<p class="grey"><?php echo $useremail ?></p>
								</div>
							</a>
						</li>
						<li><a tabindex="-1" href="profile.php" class="main-link"><i class="fa fa-edit fa-lg"></i> Edit profile</a></li>
						<li><a tabindex="-1" href="all_notifications.php" class="main-link"><i class="fa fa-bullhorn fa-lg"></i> Notifications</a></li>
						<li><a tabindex="-1" href="#" class="theme-setting"><i class="fa fa-cog fa-lg"></i> Setting</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" class="main-link logoutConfirm_open" href="logout.php"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
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
					<a class="btn btn-sm pull-right logoutConfirm_open" href="logout.php">
						<i class="fa fa-power-off"></i>
					</a>
				</div><!-- /size-toggle -->
				<div class="user-block clearfix">
					<img src="<?php echo $userpicture; ?>" alt="User Avatar">
					<div class="detail">
						<strong><?php echo $username; ?></strong>
						<ul class="list-inline">
							<li class="active"><a href="profile.php">Profile</a></li>
							<li><a href="#" class="no-margin">Inbox</a></li>
						</ul>
					</div>
				</div>
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
									Chat
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

		<div id="main-container">
			<div id="breadcrumb">
				<ul class="breadcrumb">
					<li><i class="fa fa-home"></i><a href="dashboard.php"> Home</a></li>
					<li>Page</li>
					<li class="active">Profile</li>
				</ul>
			</div>
			<!--breadcrumb-->

			<div class="padding-md">
				<div class="row">
					<div class="col-md-3 col-sm-3">
						<div class="row">
							<div class="col-xs-6 col-sm-12 col-md-6 text-center">
								<a href="#">
									<img src="<?php echo $picture ?>" alt="User Avatar" class="img-thumbnail" height="200" width="200">
								</a>
								<div class="seperator"></div>
								<div class="seperator"></div>
							</div><!-- /.col -->
							<div class="col-xs-6 col-sm-12 col-md-6">
								<strong class="font-14"><?php echo $name; ?></strong>
								<small class="block text-muted">
									<?php echo $email ?>
								</small>
								<div class="seperator"></div>
								<div id="actionDiv">
									<?php
									$friendshipStatus = checkFriendStatus($matricno, $tocheck);
									if ($friendshipStatus == 0 || $friendshipStatus == 3) {
										echo "<button class='btn btn-primary btn-xs m-bottom-sm' id='sendRequest'>Send Request</button>";
									} else if ($friendshipStatus == 1) {
										echo "<span id='requestSentLbl'>Request Sent</span>";
									} elseif ($friendshipStatus == 2) {
										echo "<span id='alreadyFriendLbl'>Already your friend</span>";
									} else {
										echo "<span id='requestSentLbl'>An error occurred</span>";
									}
									?>

								</div>

								<div class="seperator"></div>
								<a href="#" class="social-connect tooltip-test facebook-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
								<a href="#" class="social-connect tooltip-test twitter-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
								<a href="#" class="social-connect tooltip-test google-plus-hover pull-left" data-toggle="tooltip" data-original-title="Google Plus"><i class="fa fa-google-plus"></i></a>
								<div class="seperator"></div>
								<div class="seperator"></div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						<div class="panel m-top-md">
							<div class="panel-body">
								<div class="row">
									<div class="col-xs-6 text-center">
										<span class="block font-14"><?php echo countFriends($tocheck) ?></span>
										<small class="text-muted">Friends</small>
									</div><!-- /.col -->
									<div class="col-xs-6 text-center">
										<span class="block font-14"><?php echo countGroups($tocheck) ?></span>
										<small class="text-muted">Groups</small>
									</div><!-- /.col -->

								</div><!-- /.row -->
							</div>
						</div><!-- /panel -->

						<div>
							<ul class="nav nav-list" id="myProfile">
								<li class="nav-header">My Profile </li>
								<li><a><?php echo $faculty ?></a></li>
								<li><a><?php echo $dept ?></a></li>
								<li><a><?php echo $level ?></a></li>
								<li><a><?php echo $email ?></a></li>
								<li><a><?php echo $phone_no ?></a></li>
								<li><a><?php echo $study_centre ?></a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-9 col-sm-9">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="overview">
								<div class="row">
									<div class="col-md-6">
										<div class="panel panel-default fadeInDown animation-delay2">
											<div class="panel-heading">
												About Me
											</div>
											<div class="panel-body">
												<p><?php echo $about; ?></p>
											</div>
										</div><!-- /panel -->

										<div class="panel panel-default fadeInDown animation-delay3">
											<div class="panel-heading">
												<i class="fa fa-twitter"></i> Thinking...
											</div>
											<ul class="list-group">
												<li class="list-group-item">
													<p>Welcome <a href="#" class="text-info">@me</a> Nothing to add yet</p>
													<small class="block text-muted">
														<i class="fa fa-clock-o"></i> 6 minutes ago
													</small>
												</li>
											</ul><!-- /list-group -->
										</div><!-- /panel -->

										<div class="panel panel-default fadeInDown animation-delay4">
											<div class="panel-heading">
												<i class="fa fa-sign-in"></i> Last Activity
											</div>
											<ul class="list-group">
												<li class="list-group-item" id="online">
													<!--<span style="color:#129f59">Currently Online</span>-->
												</li>
											</ul><!-- /list-group -->
										</div>
									</div><!-- /.col -->
									<div class="col-md-6">
										<div class="panel panel-default fadeInUp animation-delay4">
											<div class="panel-heading">
												Favorite Friends
											</div>
											<div class="list-group">
												<?php
												$sql = "SELECT * FROM users WHERE matricno IN (SELECT user1 FROM friends WHERE user2 = '$tocheck' AND STATUS = '2' UNION
														SELECT user2 FROM friends WHERE user1 = '$tocheck' AND STATUS = '2') LIMIT 3";
												$res = mysqli_query($conn, $sql);

												while ($row = mysqli_fetch_array($res)) {
													$name = $row['fullname'];
													$picture = $row['picture'];
													$mat2 = $row['matricno'];
													$url = "profile2.php?tocheck=" . $mat2;
													?>

													<a href="<?php echo $url ?>" class="list-group-item">
														<div class="list-group-item-text clearfix">
															<span class="">
																<img src="<?php echo $picture; ?>" width="60" height="50" class="img-circle">
															</span>
															<span class="m-left-md m-top-md">
																<strong><?php echo $name; ?></strong>
															</span>
														</div>
													</a>
												<?php
												}
												?>
											</div><!-- /list-group -->
										</div><!-- /panel -->
										<div class="panel panel-default fadeInUp animation-delay4">
											<div class="panel-heading">
												Favourite Group
											</div>
											<div class="list-group">
												<a href="#" class="list-group-item">
													<div class="list-group-item-text clearfix">
														<span class="img-demo">
															IMAGE
														</span>
														<div class="pull-left m-left-sm m-top-sm">
															<strong>GROUP 1</strong>

														</div>
													</div>
												</a>
												<a href="#" class="list-group-item">
													<div class="list-group-item-text clearfix">
														<span class="img-demo">
															IMAGE
														</span>
														<div class="pull-left m-left-sm m-top-sm">
															<strong>GROUP 2</strong>
														</div>
													</div>
												</a>
												<a href="#" class="list-group-item">
													<div class="list-group-item-text clearfix">
														<span class="img-demo">
															IMAGE
														</span>
														<div class="pull-left m-left-sm m-top-sm">
															<strong>GROUP 3</strong>
														</div>
													</div>
												</a>
											</div><!-- /list-group -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="js/jquery-1.10.2.min.js"></script>

		<!-- Bootstrap -->
		<script src="bootstrap/js/bootstrap.min.js"></script>

		<!-- holder -->
		<script src='js/uncompressed/holder.js'></script>

		<!-- Modernizr -->
		<script src='js/modernizr.min.js'></script>

		<!-- Pace -->
		<script src='js/pace.min.js'></script>

		<!-- Popup Overlay -->
		<script src='js/jquery.popupoverlay.min.js'></script>

		<!-- Slimscroll -->
		<script src='js/jquery.slimscroll.min.js'></script>

		<!-- Cookie -->
		<script src='js/jquery.cookie.min.js'></script>

		<!-- Perfect -->
		<script src="js/app/app.js"></script>
		<script>
			let currentFriend = <?php echo json_encode($tocheck) ?>;
			let user = <?php echo json_encode($matricno) ?>

			$(document).on("click", "#sendRequest", function() {
				$.ajax({
					url: "processFriends.php",
					type: "post",
					data: {
						user: user,
						currentFriend: currentFriend
					},
					success: function(data) {
						$("#actionDiv").html(data);
					}
				});
			});

			function login_checker() {
				$.ajax({
					url: "login_checker.php",
					type: "POST",
					data: {
						currentFriend: currentFriend
					},
					success: function(data) {
						$("#online").html(data);
					}
				});
			}

			function update_last_activity() {
				$.ajax({
					url: "update_last_activity.php",
					success: function() {}
				});
			}

			login_checker();

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
				login_checker();
			}, 5000);
		</script>
</body>

</html>
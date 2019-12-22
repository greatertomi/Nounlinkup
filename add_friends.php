<?php
session_start();
//$name = $_SESSION['name'];
$matricno = $_SESSION['matricno'];
//$picture = $_SESSION['picture'];
if (!$_SESSION['matricno']) {
	header("location:index.php");
}

include("functions.php");
$conn = db_connect();
$query1 = "select * from users where matricno = '$matricno'";
$result1 = mysqli_query($conn, $query1) or die("Could not connect to database");

while ($rows = mysqli_fetch_array($result1)) {
	$name = $rows['fullname'];
	$picture = $rows['picture'];
	$dept = $rows['department'];
	$level = $rows['level'];
	$study_centre = $rows['study_centre'];
	$email = $rows['email'];
}
if ($email == "") {
	$email = "<span style = 'color:#d13438'>No email</span>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Add Friends</title>
	<link rel="icon" href="./bn/img/noun2.jpg" sizes="32x32">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 ,maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Bootstrap core CSS -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<script src="js/jquery-1.10.2.min.js"></script>
	<!-- Font Awesome -->
	<link href="css/font-awesome.min.css" rel="stylesheet">

	<!-- Pace -->
	<link href="css/pace.css" rel="stylesheet">

	<!-- Perfect -->
	<link href="css/app.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/app-skin.css" rel="stylesheet">

	<style>
		.list-group a:hover {
			color: #000000;
		}
	</style>

</head>

<body>
	<!-- Overlay Div -->
	<div id="overlay" class="transparent"></div>

	<a href="chat.html" id="theme-setting-icon"><i class="fa fa-cog fa-lg"></i></a>
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
		</div>
	</div><!-- /theme-setting -->

	<div id="wrapper" class="preload">
		<div id="top-nav" class="fixed skin-7">
			<div class="brand">
				<span>NOUN</span>
				<span class="text-toggle"> Linkup</span>
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
							<a class="clearfix">
								<img src="<?php echo $picture; ?>" alt="User Avatar">
								<div class="detail">
									<strong><?php echo $name; ?></strong>
									<p class="grey"><?php echo $email; ?></p>
								</div>
							</a>
						</li>
						<li><a tabindex="-1" href="profile.php" class="main-link"><i class="fa fa-edit fa-lg"></i> Edit profile</a></li>
						<li><a tabindex="-1" href="all_notifications.php" class="main-link"><i class="fa fa-bullhorn fa-lg"></i> Notifications</a></li>
						<li><a tabindex="-1" href="#" class="theme-setting"><i class="fa fa-cog fa-lg"></i> Setting</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" class="main-link logoutConfirm_open" href="add_friends2.phplogoutConfirm"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
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
					<a class="btn btn-sm pull-right logoutConfirm_open" href="add_friends.phplogoutConfirm">
						<i class="fa fa-power-off"></i>
					</a>
				</div>
				<div class="user-block clearfix">
					<img src=<?php echo $picture; ?> alt="User Avatar">
					<div class="detail">
						<strong><?php echo $name; ?></strong>
						<ul class="list-inline">
							<li><a href="profile.php">Profile</a></li>
							<li><a href="#" class="no-margin">Manage</a></li>
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
						<li class="active">
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
			</div><!-- /sidebar-inner scrollable-sidebar -->
		</aside>

		<div id="main-container">
			<div id="breadcrumb">
				<ul class="breadcrumb">
					<li><i class="fa fa-home"></i><a href="dashboard.php"> Home</a></li>
					<li class="active">Add Friends</li>
				</ul>
			</div>

			<div class="row">
				<div class="col-md-1 col-sm-1"> </div>
				<div class="col-md-5 col-sm-6">
					<section class="panel panel1">
						<div class="panel-heading header">People you may want to know</div>

						<?php
						$search1 = "SELECT * FROM users WHERE (department = '$dept' OR study_centre = '$study_centre' OR LEVEL = '$level') 
								AND matricno != '$matricno' AND matricno NOT IN (SELECT user2 FROM friends WHERE user1 = '$matricno' UNION 
								SELECT user1 FROM friends WHERE user2 = '$matricno') limit 30";

						$search1_result = mysqli_query($conn, $search1);

						if (mysqli_num_rows($search1_result) == 0) {
							echo "<ul class = 'list-group'>
											<li class = 'list-group-item' id = 'empty'> LIST EMPTY</li>'
										</ul>";
						} else {
							echo "<ul class = 'list-group' id='prospectiveFriends'>";
							while ($rows1 = mysqli_fetch_array($search1_result)) {
								$picture1 = $rows1['picture'];
								$matricno1 = $rows1['matricno'];
								$name1 = $rows1['fullname'];
								$level1 = $rows1['level'];
								$scno1 = $rows1['study_centre'];
								$dept1 = $rows1['department'];
								$scname1 = getcentre($scno1);
								$deptname1 = getdept($dept1);
								$tocheck = "profile2.php?tocheck=$matricno1";

								echo "<li class = 'list-group-item' id = 'list1'>
												<a href='$tocheck'><span class='pull-left mg-t-lg mg-r-lg'> <img src='$picture1' class='avatar avatar-lg img-circle' alt=''></span>
												<div class='show no-margin pd-t-lg' id = 'name1'>$name1 </a>
												<small class='pull-right'><button class='btn btn-primary btn-sm addFriend' id='$matricno1'>Send Request</button></small></div>
												<a href='$tocheck'><small class='text-muted' id = 'sub1'>$scname1</small><br/>
												<small class='text-muted' id = 'sub1'>$deptname1 [$level1]</small></a>
											</li>";
							}
							echo "</ul>";
						}
						?>

					</section>
				</div>

				<div class="col-md-5 col-sm-6">
					<section class="panel panel1">
						<div class="panel-heading header">Friend Requests</div>
						<?php
						$search2 = "SELECT * FROM users WHERE matricno IN (SELECT user1 FROM friends WHERE user2 = '$matricno' AND status = '1') limit 30";
						$search2_result = mysqli_query($conn, $search2) or die("Could not query database");

						if (mysqli_num_rows($search2_result) == 0) {
							echo "<ul class = 'list-group'>
										<li class = 'list-group-item' id = 'empty'> LIST EMPTY</li>'
									</ul>";
						} else {
							echo "<ul class = 'list-group' id='friendRequests'>";
							while ($rows2 = mysqli_fetch_array($search2_result)) {
								$picture2 = $rows2['picture'];
								$matricno2 = $rows2['matricno'];
								$name2 = $rows2['fullname'];
								$level2 = $rows2['level'];
								$scno2 = $rows2['study_centre'];
								$dept2 = $rows2['department'];
								$scname2 = getcentre($scno2);
								$deptname2 = getdept($dept2);
								$tocheck = "profile2.php?tocheck=$matricno2";

								echo "<li class = 'list-group-item' id = 'list1'>
											<a href='$tocheck'><span class='pull-left mg-t-lg mg-r-lg'> <img src='$picture2' class='avatar avatar-lg img-circle' alt=''></span>
											<div class='show no-margin pd-t-lg' id = 'name1'>$name2 </a>
											<small class='pull-right'><a class='btn btn-primary btn-sm acceptFriend' id='$matricno2'>Accept</a></small></div>
											<a href='$tocheck'><small class='text-muted' id = 'sub1'>$scname2</small><br/>
											<small class='text-muted' id = 'sub1'>$deptname2 [$level2]</small></a>
										</li>";
							}
							echo "</ul>";
						}
						?>
					</section>
				</div>

			</div><!-- /main-container -->
			<a class="btn btn-primary btn-md addFriends pull-right" href="search_friends.php">Search For Friends</a>
		</div>

		<a href="chat.php" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>

		<!-- Logout confirmation -->
		<div class="custom-popup width-100" id="logoutConfirm">
			<div class="padding-md">
				<h4 class="m-top-none"> Do you want to logout?</h4>
			</div>

			<div class="text-center">
				<a class="btn btn-success m-right-sm" href="logout.php">Logout</a>
				<a class="btn btn-danger logoutConfirm_close">Cancel</a>
			</div>
		</div>



		<!-- Bootstrap -->
		<script src="./bootstrap/js/bootstrap.min.js"></script>

		<!-- Modernizr -->
		<script src='./js/modernizr.min.js'></script>

		<!-- Pace -->
		<script src='./js/pace.min.js'></script>

		<!-- Popup Overlay -->
		<script src='./js/jquery.popupoverlay.min.js'></script>

		<!-- Slimscroll -->
		<script src='./js/jquery.slimscroll.min.js'></script>

		<!-- Cookie -->
		<script src='./js/jquery.cookie.min.js'></script>

		<!-- Perfect -->
		<script src="./js/app/app.js"></script>
		<script src="./js/myscript.js"></script>

		<script>
			var user = <?php echo json_encode($matricno) ?>;
			unreadMsg();
			unreadMsg2();

			$(document).on("click", ".addFriend", function() {
				let friend = this.id;
				$.ajax({
					url: "processFriends.php",
					type: "post",
					data: {
						user: user,
						friend: friend
					},
					success: function(data) {
						$('ul#prospectiveFriends li').remove();
						$("#prospectiveFriends").html(data);
					}
				});
			});

			$(document).on("click", ".acceptFriend", function() {
				var friend = this.id;
				$.ajax({
					url: "acceptFriends.php",
					type: "post",
					data: {
						user: user,
						friend: friend
					},
					success: function(data) {
						$('ul#friendRequests li').remove();
						//alert(data);
						$("#friendRequests").html(data);
					}
				});
			});

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
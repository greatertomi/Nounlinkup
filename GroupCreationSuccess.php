<?php
session_start();
include("functions.php");
$matricno = $_SESSION['matricno'];

if (!$_SESSION['matricno']) {
	header("location:index.php");
}

if (!$_SESSION['groupname']) {
	header("location:CreateGroup.php");
}

$groupname = $_SESSION['groupname'];
unset($_SESSION['groupname']);

$conn = db_connect();
$query1 = "select * from users where matricno = '$matricno'";
$result1 = mysqli_query($conn, $query1) or die("Could not connect to database");

while ($rows = mysqli_fetch_array($result1)) {
	$name = $rows['fullname'];
	$picture = $rows['picture'];
	$email = $rows['email'];
	$dept = $rows['department'];
	$level = $rows['level'];
}

if ($email == "") {
	$email = "<span style = 'color:#d13438'>No email</span>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Group Creation</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0 ,maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Bootstrap core CSS -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="icon" href="./bn/img/noun2.jpg" sizes="32x32">

	<script src="js/jquery-1.10.2.min.js"></script>
	<!-- Font Awesome -->
	<link href="css/font-awesome.min.css" rel="stylesheet">

	<!-- Pace -->
	<link href="css/pace.css" rel="stylesheet">
	<link href="css/mystyle.css" rel="stylesheet">
	<!-- Perfect -->
	<link href="css/app.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/app-skin.css" rel="stylesheet">

	<style>
		html,
		body {
			overflow: auto;
			font-size: 14px;
		}

		.page-title {
			margin-top: 30px;
			color: black;
			font-size: 28px;
			font-weight: 700;
			color: #16a15c;
		}

		label {
			margin-bottom: 10px 0;
		}

		.info {
			margin-bottom: 25px;
		}

		.inputname {
			color: black;
		}

		.img-circle {
			border: 1px solid;
			margin-left: 25%;
		}

		.btn {
			background-color: #dddddd;
			color: black;
			margin-top: 50px;
			margin-left: 50px;
		}
	</style>

</head>

<body>

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
			<a class="theme-color" style="background:#328130" id="skin-7"></a>
		</div>
	</div>

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
					<a class="dropdown-toggle" data-toggle="dropdown" href="chat.php">
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
						<li><a tabindex="-1" class="main-link logoutConfirm_open" href="chat.phplogoutConfirm"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
					</ul>
				</li>
			</ul>
		</div>

		<div id="main-container">
			<div class="container">
				<div class="row">
					<div class="col-md-2"></div>
					<?php
					$query = mysqli_query($conn, "select * from groups where groupname = '$groupname'") or die("Could not query database");
					$row = mysqli_fetch_array($query);
					$groupname = strtoupper($groupname);
					$picture = $row['groupimage'];
					$groupid = $row['groupid'];
					$type = $row['visibility'];
					$url = 'SendInvitation.php?check=' . $groupid;

					$type2 = "";
					if ($type == "Public") {
						$type2 = "The Group with name <b>$groupname</b> has been created successfully. Since the group is public, people can now see the group and join.
							You can also choose to invite people personally.";
					} else {
						$type2 = "The Group with name <b>$groupname</b> has been created successfully. Since the group is private, people can only join this group if you invite them personally.";
					}
					echo "<div class = 'col-md-6 group-page'>
							<p class='page-title'>Group Created Successfully</p>
							<div class = 'info'>
								$type2
							</div>
							<div>
								<p><img src = '$picture' width='150' height='150' class = 'img-circle'><p>
							</div>
							<div class = 'col-md-12 form-inline'>
								<a class = 'btn btn-lg' href='GroupChat.php'>Group Chat</a>
								<a class = 'btn btn-lg' href='$url'>Invite People</a>
							</div>
						</div>";
					?>
				</div>
			</div>
		</div>


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

	<!-- Jquery -->


	<!-- Bootstrap -->
	<script src="bootstrap/js/bootstrap.min.js"></script>

	<!-- Modernizr -->
	<script src='js/modernizr.min.js'></script>


	<!-- Popup Overlay -->
	<script src='js/jquery.popupoverlay.min.js'></script>

	<!-- Slimscroll -->
	<script src='js/jquery.slimscroll.min.js'></script>

	<!-- Cookie -->
	<script src='js/jquery.cookie.min.js'></script>
	<script src="js/parsley.js"></script>
	<!-- Perfect -->
	<script src="js/app/app.js"></script>
	<script>
		var user = <?php echo json_encode($matricno) ?>;
		unreadMsg();
		unreadMsg2();

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
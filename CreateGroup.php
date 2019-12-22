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
	<title>Create Group</title>
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

		.switch {
			position: relative;
			display: inline-block;
			margin-left: 18px;
			width: 80px;
			height: 24px;
		}

		.switch input {
			opacity: 0;
			width: 0;
			height: 0;
		}

		.slider {
			position: absolute;
			cursor: pointer;
			padding-top: 4px;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: #B94A48;
			;
			-webkit-transition: .4s;
			transition: .4s;
		}

		.slider:before {
			position: absolute;
			content: "";
			height: 17px;
			width: 18px;
			left: 4px;
			bottom: 4px;
			background-color: white;
			-webkit-transition: .4s;
			transition: .4s;
		}

		input:checked+.slider.round {
			background-color: #15a05b;
			right: 4px;
		}

		input:focus+.slider {
			box-shadow: 0 0 1px #2196F3;
		}

		input:checked+.slider:before {
			-webkit-transform: translateX(50px);
			-ms-transform: translateX(50px);
		}

		.slider.round {
			border-radius: 34px;
		}

		.slider.round:before {
			border-radius: 50%;
		}

		#public {
			color: white;
			margin-left: 10px;
			font-size: 12px;
			margin-top: 40px;
		}

		#private {
			color: white;
			margin-left: 28px;
			font-size: 12px;
		}

		#text {
			color: black;
		}

		.form-inline {
			margin-left: 72%;
		}

		.btn {
			color: black;
		}

		#error {
			color: #B94A48;
			margin-left: 17px;
		}

		.errorinput {
			border-color: #B94A48;
		}
	</style>

</head>

<body>
	<?php
	if (isset($_POST["submit"])) {
		$name1 = $_POST['name'];
		$name = ucwords($name1);
		$type = "";

		if (isset($_POST['visibility']))
			$type = "Public";
		else
			$type = "Private";

		$purpose = $_POST['purpose'];
		$picture = upload_grouppix('picture', $name);

		$query = "insert into groups values ('','$name','$purpose','$type','$matricno',now(),'$picture')";
		$result = mysqli_query($conn, $query) or die("Could not create group");
		$getid = mysqli_query($conn, "select groupid from groups where groupname = '$name1'");
		$row = mysqli_fetch_array($getid);
		$groupid = $row['groupid'];

		$query2 = "insert into group_members (groupid, member, datejoined, statuss) values ('$groupid','$matricno',now(),'1')";
		$result2 = mysqli_query($conn, $query2) or die("could not insert into DB");

		if ($result) {
			$_SESSION['groupname'] = $name;
			header("Location:GroupCreationSuccess.php");
		}
	}
	?>

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
									<p class="grey"><?php echo $email ?></p>
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

		<aside class="fixed skin-7">
			<div class="sidebar-inner scrollable-sidebar">
				<div class="size-toggle">
					<a class="btn btn-sm" id="sizeToggle">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="btn btn-sm pull-right logoutConfirm_open" href="dashboard.phplogoutConfirm">
						<i class="fa fa-power-off"></i>
					</a>
				</div>
				<div class="user-block clearfix">
					<img src=<?php echo $picture; ?> alt="User Avatar">
					<div class="detail">
						<strong><?php echo $name; ?></strong>
						<ul class="list-inline">
							<li><a href="profile.php">Profile</a></li>
							<li><a href="email.php" class="no-margin">Manage</a></li>
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
									Chat <span id="unread"></span>
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>
						<li class="active openable open">
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
								<li class="active"><a href="#"><span class="submenu-label">Create Group</span></a></li>
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
				</div>
			</div>
		</aside>

		<div id="main-container">
			<div class="container">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-6 group-page">
						<p class="page-title">Create a Group</p>
						<div class="info">
							Groups are where members communicate. They are best organized around a topic or an interest - #StudyProblems or 100L Computer Science.
						</div>
						<form action="" method="post" class="form-horizontal" id="creategroup" enctype="multipart/form-data" data-parsley-validate>
							<div class="row">
								<div class=" col-md-3 form-group">
									<label class="switch">
										<input type="checkbox" class="switcher" name="visibility" checked>
										<span class="slider round"><span id="public">Public</span>
									</label>
								</div>
								<div class="col-md-8" id="text">Anyone can see and join this group.</div>

							</div>
							<div class="form-group">
								<label for="picture" class="col-md-3"><span class="inputname">Group Picture</span></label>
								<div class="col-md-12">
									<div>
										<p><img id="output_image" width="150" height="150" class="img-circle">
											<p>
												<input type="file" accept="image/*" onchange="preview_image(event)" class="form-control" name="picture" id="picture" required="" data-parsley-required-message="A group must have a picture">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="matric" class="col-md-2"><span class="inputname">Name</span></label>
								<div class="col-md-12">
									<input type="text" class="form-control" id="name" name="name" placeholder="Group name must not be longer than 12 words" required="" data-parsley-maxlength="12" data-parsley-required-message="A group must have a name">
								</div><br />
								<div class='errordiv'></div>
							</div>


							<div class="form-group">
								<label for="name" class="col-md-3"><span class="inputname">Purpose</span> (Optional)</label>
								<div class="col-md-12">
									<input type="text" class="form-control" id="purpose" name="purpose" placeholder="What is this group for?">
								</div>
							</div>
							<div class="col-md-12 form-inline">
								<input type="submit" name="submit" class="btn btn-lg submit" value="Create Group">
							</div>
						</form>

					</div>
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

	<!-- Bootstrap -->
	<script src="bootstrap/js/bootstrap.min.js"></script>

	<!-- Modernizr -->
	<script src='js/modernizr.min.js'></script>

	<!-- Popup Overlay -->
	<script src='js/jquery.popupoverlay.min.js'></script>

	<!-- Cookie -->
	<script src='js/jquery.cookie.min.js'></script>
	<script src="js/parsley.js"></script>
	<!-- Perfect -->
	<script src="js/app/app.js"></script>
	<script>
		$(function() {
			$(document).on("click", ".switcher", function() {
				if ($(".switcher").is(":checked")) {
					$("#text").html("Anyone can see and join your group.");
					$(".slider.round").html("<span id='public'>Public</span>");
				} else {
					$("#text").html("You have to send invitation for people to join this group");
					$(".slider.round").html("<span id='private'>Private</span>");
				}
			});

			$("#creategroup").parsley();

		});

		$(document).on("keyup", "#name", function() {
			var name = $("#name").val();
			$.ajax({
				url: "GroupNameCheck.php",
				type: "post",
				data: {
					name: name
				},
				success: function(data) {
					if (data == "yes") {
						$(".errordiv").html("<span id = 'error'>This groupname already exist</span>");
						$("#name").addClass("errorinput");
						$(".submit").attr("disabled", "true");
					} else {
						$(".errordiv").html("");
						$("#name").removeClass("errorinput");
						$(".submit").removeAttr("disabled");
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
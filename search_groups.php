<?php
include("functions.php");
$conn = db_connect();
session_start();
$matricno = $_SESSION['matricno'];
if (!isset($_SESSION['matricno'])) {
	header("Location:index.php");
}

$matricno = $_SESSION['matricno'];
$query1 = "select * from users where matricno = '$matricno'";
$result1 = mysqli_query($conn, $query1) or die("Could not connect to database");

while ($rows = mysqli_fetch_array($result1)) {
	$name = $rows['fullname'];
	$picture = $rows['picture'];
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
	<title>Search Groups</title>
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
		html,
		body {
			overflow: auto;
		}

		#lists {
			text-align: right;
		}

		#selectid {
			margin-left: 8px;
		}

		div.seperator {
			padding: 0;
		}

		#autocomplete {
			margin: 0;
			position: absolute;
			top: 35px;
			background-color: #f0f0f0;
			width: 97%;
		}

		.list-unstyled {
			padding-top: 7px;
		}

		#autocomplete li {
			margin: 5px 8px;
			margin-bottom: 10px;
		}

		#notfound {
			padding: 10px 8px;
			color: #d5483e;
		}

		#autocomplete li:hover {
			color: #000000;
			cursor: pointer;
		}
	</style>
	<script>
	</script>
</head>

<body style="overflow:hidden;">
	<!-- Overlay Div -->
	<div id="overlay" class="transparent"></div>

	<a href="chat.php" id="theme-setting-icon"><i class="fa fa-cog fa-lg"></i></a>
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
					<a class="dropdown-toggle" data-toggle="dropdown" href="chat.php">
						<strong><?php echo $name; ?></strong>
						<span><i class="fa fa-chevron-down"></i></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a class="clearfix" href="chat.php">
								<img src="<?php echo $picture; ?>" alt="User Avatar">
								<div class="detail">
									<strong><?php echo $name; ?></strong>
									<p class="grey"><?php echo $name; ?>@email.com</p>
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
				</div>
				<div class="user-block clearfix">
					<img src=<?php echo $picture; ?> alt="User Avatar">
					<div class="detail">
						<strong><?php echo $name; ?></strong>
						<ul class="list-inline">
							<li><a href="profile.php">Profile</a></li>
							<li><a href="#" class="no-margin">Friends</a></li>
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
							<a href="blog/">
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
			<div id="breadcrumb">
				<ul class="breadcrumb">
					<li><i class="fa fa-home"></i><a href="dashboard.php"> Home</a></li>
					<li class="active">Page</li>
					<li class="active">Search Result</li>
				</ul>
			</div>
			<div class="padding-md">
				<div style="margin-left:42%">
					<h4> Search for groups </h4>
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">

						<div class="input-group m-bottom-md">
							<input type="text" class="form-control name-input" placeholder="Search here...">
							<span class="input-group-btn">
								<button class="btn btn-primary" type="button" id="nameSearch">Search</button>
							</span>
						</div>

						<div id="autocomplete">

						</div>

						<span id="lists"></span>
						<div id="search-results">

						</div>
					</div>
					<div class="col-md-1">
					</div>
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

	<!-- Jquery -->


	<!-- Bootstrap -->
	<script src="bootstrap/js/bootstrap.min.js"></script>

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

		setInterval(function() {
			unreadMsg();
			unreadMsg2();
		}, 3000);

		$(document).on('click', '#nameSearch', function() {
			var value = $(".name-input").val();
			var user = <?php echo json_encode($matricno) ?>;
			$("#search-results").html("");
			search_result(user, value);
		});


		$(document).on('click', '.results', function() {
			$("#search-results").html("");
			var groupid = this.id;
			var person = <?php echo json_encode($matricno) ?>;
			var search = $(".name-input").val();
			send_request(person, groupid, search);
		});

		$(document).on("keyup", ".name-input", function() {
			let gnameinput = $(this).val()
			if (gnameinput != "") {
				$.ajax({
					url: "autocompleter.php",
					method: "POST",
					data: {
						user: user,
						gnameinput: gnameinput
					},
					success: function(data) {
						$("#autocomplete").fadeIn();
						$("#autocomplete").html(data);
						$('#paramSearch').hide();
					}

				})
			} else {
				$("#autocomplete").fadeOut();
				$('#paramSearch').show();
			}
		});

		$(document).on('focusout', '.name-input', function() {
			$("#autocomplete").fadeOut();
			$('#paramSearch').show();
		});

		$(document).on('click', '#autocomplete li', function() {
			$(".name-input").val($(this).text());
			$("#autocomplete").fadeOut();
			$('#paramSearch').show();
		});

		function search_result(user, value) {
			var res = value.split(" ");
			var num = 0;
			var storyid = [];
			for (j = 0; j < res.length; j++) {
				//alert(num);
				if (res[j].length >= 3) {

					$.ajax({
						url: "SearchResult.php",
						type: "POST",
						dataType: "json",
						async: false,
						data: {
							user: user,
							word: res[j]
						},
						success: function(data) {
							checker = true;

							if (num == 0) {
								$("#search-results").append(data[1]);
								storyid[num] = data[0];
								++num;
							} else {
								for (i = 0; i < storyid.length; i++) {
									//alert("inside the array");
									if (storyid[i] == data[0]) {
										checker = false;
									}
								}
								if (checker == true) {
									$("#search-results").append(data[1]);
									storyid[num] = data[0];
									++num;
								}
							}
						}
					});
				}
			}
			$("#lists").html(storyid.length + " result(s)")

		}

		function send_request(person, groupid, search) {
			$.ajax({
				url: "search_frq.php",
				type: "POST",
				data: {
					groupid: groupid,
					person: person
				},
				success: function(data) {
					search_result(person, search);
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
	</script>

</body>

</html>
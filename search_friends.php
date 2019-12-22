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
	<title>Search Friends</title>
	<link rel="icon" href="./bn/img/noun2.jpg" sizes="32x32">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 ,maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Bootstrap core CSS -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<script src="js/jquery-1.10.2.min.js"></script>
	<!-- Font Awesome -->
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/gritter/jquery.gritter.css">

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

		.gritter-danger {
			margin-top: 25px;
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
</head>

<body style="overflow:hidden;">
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

				</div><!-- /main-menu -->
			</div><!-- /sidebar-inner scrollable-sidebar -->
		</aside>

		<div id="main-container">
			<div id="breadcrumb">
				<ul class="breadcrumb">
					<li><i class="fa fa-home"></i><a href="index.html"> Home</a></li>
					<li class="active">Page</li>
					<li class="active">Search Result</li>
				</ul>
			</div>
			<div class="padding-md">
				<div style="margin-left:42%">
					<h4> Search for friends </h4>
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

						<div class="search-options clearfix">
							Search by
							<select class="form-control input-sm level" style="display:inline-block; width:9%;" id="selectid">
								<option selected="true" value=null>Level</option>
								<option>100L</option>
								<option>200L</option>
								<option>300L</option>
								<option>400L</option>
								<option>500L</option>
							</select>
							<select class="form-control input-sm dept" style="display:inline-block; width:26%;" id="selectid">
								<option selected="true" value=null>Department</option>
								<?php

								$sql = "SELECT sn,dept FROM department";
								$result = mysqli_query($conn, $sql);

								while ($row = mysqli_fetch_array($result)) {
									$dept = $row['dept'];
									$deptid = $row['sn'];
									echo "<option value = '$deptid'> $dept</option>";
								}
								?>
							</select>
							<select class="form-control input-sm faculty" style="display:inline-block; width:20%" id="selectid">
								<option selected="true" value=null>Faculty</option>
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
							<select class="form-control input-sm scentre" style="display:inline-block; width:26%;" id="selectid">
								<option selected="true" value=null>Study Centre</option>
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
							<span class="input-group-btn" style="display:inline-block; width:6%;">
								<button class="btn btn-primary" type="button" id="paramSearch">Search</button>
							</span>
						</div>

						<span id="lists"><strong></strong></span>
						<div id="search-results">

						</div>
					</div>
					<div class="col-md-1">
					</div>
				</div>
			</div>

		</div><!-- /chat-wrapper -->
	</div><!-- /main-container -->
	</div><!-- /wrapper -->

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
	<script src='js/jquery.gritter.min.js'></script>

	<!-- Slimscroll -->
	<script src='js/jquery.slimscroll.min.js'></script>

	<!-- Cookie -->
	<script src='js/jquery.cookie.min.js'></script>

	<!-- Perfect -->
	<script src="js/app/app.js"></script>

	<script>
		$(document).on('click', '#nameSearch', function() {
			var name = $(".name-input").val();
			var user = <?php echo json_encode($matricno) ?>;

			if ($(".name-input").val() == "") {
				$.gritter.add({
					title: '<i class="fa fa-times-circle"></i> Empty Message Error!',
					text: 'No statement was entered in the textbox',
					sticky: false,
					time: '',
					class_name: 'gritter-danger'
				});
			} else {
				search_result1(user, name);
				result1_count(user, name);
			}
		});

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

		$(document).on("keyup", ".name-input", function() {
			let nameinput = $(this).val()
			if (nameinput != "") {
				$.ajax({
					url: "autocompleter.php",
					method: "POST",
					data: {
						user: user,
						nameinput: nameinput
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

		$(document).on('click', '#paramSearch', function() {
			var level = $(".level").val();
			var dept = $(".dept").val();
			var faculty = $(".faculty").val();
			var scentre = $(".scentre").val();
			var user = <?php echo json_encode($matricno) ?>;


			if (level !== "null" && dept === "null" && faculty === "null" && scentre === "null") {
				//alert("level is present");
				search_result21(user, level);
				result21_count(user, level);
			} else if (level === "null" && dept !== "null" && faculty === "null" && scentre === "null") {
				//alert(dept);
				search_result22(user, dept);
				result22_count(user, dept);
			} else if (level === "null" && dept === "null" && faculty !== "null" && scentre === "null") {
				//alert("faculty is present");
				search_result23(user, faculty);
				result23_count(user, faculty);
			} else if (level === "null" && dept === "null" && faculty === "null" && scentre !== "null") {
				search_result24(user, scentre);
				result24_count(user, scentre);
			} else if (level !== "null" && dept !== "null" && faculty === "null" && scentre === "null") {
				//alert(user+ " "+level+ " "+dept);
				search_result25(user, level, dept);
				result25_count(user, level, dept);
			} else if (level !== "null" && dept === "null" && faculty !== "null" && scentre === "null") {
				search_result26(user, level, faculty);
				result26_count(user, level, faculty);
			} else if (level !== "null" && dept === "null" && faculty === "null" && scentre !== "null") {
				search_result27(user, level, scentre);
				result27_count(user, level, scentre);
			} else if (level === "null" && dept !== "null" && faculty !== "null" && scentre === "null") {
				search_result28(user, dept, faculty);
				result28_count(user, dept, faculty);
			} else if (level === "null" && dept !== "null" && faculty === "null" && scentre !== "null") {
				search_result29(user, dept, scentre);
				result29_count(user, dept, scentre);
			} else if (level === "null" && dept === "null" && faculty !== "null" && scentre !== "null") {
				search_result2A(user, faculty, scentre);
				result2A_count(user, faculty, scentre);
			} else if (level !== "null" && dept == "null" && faculty !== "null" && scentre !== "null") {
				//alert(user+ " "+level+ " "+dept+ " "+faculty);
				search_result2B(user, level, faculty, scentre);
				result2B_count(user, level, faculty, scentre);
			} else if (level !== "null" && dept !== "null" && faculty !== "null" && scentre === "null") {
				//alert(user+ " "+level+ " "+dept+ " "+faculty);
				search_result2C(user, level, dept, faculty);
				result2C_count(user, level, dept, faculty);
			} else if (level !== "null" && dept !== "null" && faculty === "null" && scentre !== "null") {
				search_result2D(user, level, dept, scentre);
				result2D_count(user, level, dept, scentre);
			} else if (level === "null" && dept !== "null" && faculty !== "null" && scentre !== "null") {
				search_result2E(user, dept, faculty, scentre);
				result2E_count(user, dept, faculty, scentre);
			} else if (level !== "null" && dept !== "null" && faculty !== "null" && scentre !== "null") {
				//alert(user+ " "+level+ " "+dept+ " "+faculty + ""+scentre);
				search_result2F(user, level, dept, faculty, scentre);
				result2F_count(user, level, dept, faculty, scentre);
			}
		});

		$(document).on('click', '.results', function() {
			var id = this.id;
			var user = <?php echo json_encode($matricno) ?>;
			var name = $(".name-input").val();
			send_request1(user, id, name);
		});

		$(document).on('click', '.results2', function() {
			var level = $(".level").val();
			var dept = $(".dept").val();
			var faculty = $(".faculty").val();
			var scentre = $(".scentre").val();
			var user = <?php echo json_encode($matricno) ?>;
			var id = this.id;

			if (level !== "null" && dept === "null" && faculty === "null" && scentre === "null") {
				send_request21(user, id, level);
			} else if (level === "null" && dept !== "null" && faculty === "null" && scentre === "null") {
				send_request22(user, id, dept);
			} else if (level === "null" && dept === "null" && faculty !== "null" && scentre === "null") {
				send_request23(user, id, faculty);
			} else if (level === "null" && dept === "null" && faculty === "null" && scentre !== "null") {
				send_request24(user, id, scentre);
			} else if (level !== "null" && dept !== "null" && faculty === "null" && scentre === "null") {
				send_request25(user, id, level, dept);
			} else if (level !== "null" && dept === "null" && faculty !== "null" && scentre === "null") {
				send_request26(user, id, level, faculty);
			} else if (level !== "null" && dept === "null" && faculty === "null" && scentre !== "null") {
				send_request27(user, id, level, scentre);
			} else if (level === "null" && dept !== "null" && faculty !== "null" && scentre === "null") {
				send_request28(user, id, dept, faculty);
			} else if (level === "null" && dept !== "null" && faculty === "null" && scentre !== "null") {
				send_request29(user, id, dept, scentre);
			} else if (level === "null" && dept === "null" && faculty !== "null" && scentre !== "null") {
				send_request2A(user, id, faculty, scentre);
			} else if (level !== "null" && dept === "null" && faculty !== "null" && scentre !== "null") {
				send_request2B(user, id, level, faculty, scentre);
			} else if (level !== "null" && dept !== "null" && faculty !== "null" && scentre === "null") {
				send_request2C(user, id, level, dept, faculty);
			} else if (level !== "null" && dept !== "null" && faculty === "null" && scentre !== "null") {
				send_request2D(user, id, level, dept, scentre);
			} else if (level === "null" && dept !== "null" && faculty !== "null" && scentre !== "null") {
				send_request2E(user, id, dept, faculty, scentre);
			} else if (level !== "null" && dept !== "null" && faculty !== "null" && scentre !== "null") {
				send_request2F(user, id, level, dept, faculty, scentre);
			}
		});

		function search_result1(user, name) {
			$.ajax({
				url: "SearchResult.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					name: name
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function send_request1(user, id, name) {
			$.ajax({
				url: "search_frq.php",
				type: "POST",
				data: {
					user: user,
					name: id,
				},
				success: function(data) {
					//alert(user + " "+ name);
					search_result1(user, name);
					result1_count(user, name);
				}
			});
		}

		function result1_count(user, name) {
			$.ajax({
				url: "result1_count.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					name: name
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function search_result21(user, level) {
			$.ajax({
				url: "SearchResult2.php",
				type: "POST",
				async: false,
				data: {
					level: level,
					user: user
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result21_count(user, level) {
			$.ajax({
				url: "result2_count.php",
				type: "POST",
				async: false,
				data: {
					level: level,
					user: user
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request21(user, id, level) {
			$.ajax({
				url: "search_frq2.php",
				type: "POST",
				data: {
					level: level,
					user: user,
					id: id
				},
				success: function(data) {
					search_result21(user, level);
					result21_count(user, level);
				}
			});
		}

		function search_result22(user, dept) {
			$.ajax({
				url: "SearchResult2.php",
				type: "POST",
				async: false,
				data: {
					dept: dept,
					user: user,
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result22_count(user, dept) {
			$.ajax({
				url: "result2_count.php",
				type: "POST",
				async: false,
				data: {
					dept: dept,
					user: user
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request22(user, id, dept) {
			$.ajax({
				url: "search_frq2.php",
				type: "POST",
				data: {
					dept: dept,
					user: user,
					id: id,
				},
				success: function(data) {
					//alert(user + " "+ name);
					search_result22(user, dept);
					result22_count(user, dept);
				}
			});
		}

		function search_result23(user, faculty) {
			$.ajax({
				url: "SearchResult2.php",
				type: "POST",
				async: false,
				data: {
					faculty: faculty,
					user: user
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result23_count(user, faculty) {
			$.ajax({
				url: "result2_count.php",
				type: "POST",
				async: false,
				data: {
					faculty: faculty,
					user: user
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request23(user, id, faculty) {
			$.ajax({
				url: "search_frq2.php",
				type: "POST",
				data: {
					faculty: faculty,
					user: user,
					id: id,
				},
				success: function(data) {
					//alert(user + " "+ name);
					search_result23(user, faculty);
					result23_count(user, faculty);
				}
			});
		}

		function search_result24(user, scentre) {
			$.ajax({
				url: "SearchResult2.php",
				type: "POST",
				async: false,
				data: {
					scentre: scentre,
					user: user
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result24_count(user, scentre) {
			$.ajax({
				url: "result2_count.php",
				type: "POST",
				async: false,
				data: {
					scentre: scentre,
					user: user
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request24(user, id, scentre) {
			$.ajax({
				url: "search_frq2.php",
				type: "POST",
				data: {
					scentre: scentre,
					user: user,
					id: id,
				},
				success: function(data) {
					//alert(user + " "+ name);
					search_result24(user, scentre);
					result24_count(user, scentre);
				}
			});
		}

		function search_result25(user, level, dept) {
			$.ajax({
				url: "SearchResult2.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					level: level,
					dept: dept
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result25_count(user, level, dept) {
			$.ajax({
				url: "result2_count.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					level: level,
					dept: dept
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request25(user, id, level, dept) {
			$.ajax({
				url: "search_frq2.php",
				type: "POST",
				data: {
					level: level,
					dept: dept,
					user: user,
					id: id
				},
				success: function(data) {
					search_result25(user, level, dept);
					result25_count(user, level, dept);
				}
			});
		}

		function search_result26(user, level, faculty) {
			$.ajax({
				url: "SearchResult2.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					level: level,
					faculty: faculty
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result26_count(user, level, faculty) {
			$.ajax({
				url: "result2_count.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					level: level,
					faculty: faculty
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request26(user, id, level, faculty) {
			$.ajax({
				url: "search_frq2.php",
				type: "POST",
				data: {
					level: level,
					faculty: faculty,
					user: user,
					id: id
				},
				success: function(data) {
					search_result26(user, level, faculty);
					result26_count(user, level, faculty);
				}
			});
		}

		function search_result27(user, level, scentre) {
			$.ajax({
				url: "SearchResult2.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					level: level,
					scentre: scentre
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result27_count(user, level, scentre) {
			$.ajax({
				url: "result2_count.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					level: level,
					scentre: scentre
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request27(user, id, level, scentre) {
			$.ajax({
				url: "search_frq2.php",
				type: "POST",
				data: {
					level: level,
					scentre: scentre,
					user: user,
					id: id
				},
				success: function(data) {
					search_result27(user, level, scentre);
					result27_count(user, level, scentre);
				}
			});
		}

		function search_result28(user, dept, faculty) {
			$.ajax({
				url: "SearchResult2.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					dept: dept,
					faculty: faculty
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result28_count(user, dept, faculty) {
			$.ajax({
				url: "result2_count.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					dept: dept,
					faculty: faculty
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request28(user, id, dept, faculty) {
			$.ajax({
				url: "search_frq2.php",
				type: "POST",
				data: {
					faculty: faculty,
					dept: dept,
					user: user,
					id: id
				},
				success: function(data) {
					search_result28(user, dept, faculty);
					result28_count(user, dept, faculty);
				}
			});
		}

		function search_result29(user, dept, scentre) {
			$.ajax({
				url: "SearchResult2.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					dept: dept,
					scentre: scentre
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result29_count(user, dept, scentre) {
			$.ajax({
				url: "result2_count.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					dept: dept,
					scentre: scentre
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request29(user, id, dept, scentre) {
			$.ajax({
				url: "search_frq2.php",
				type: "POST",
				data: {
					scentre: scentre,
					dept: dept,
					user: user,
					id: id
				},
				success: function(data) {
					search_result29(user, dept, scentre);
					result29_count(user, dept, scentre);
				}
			});
		}

		function search_result2A(user, faculty, scentre) {
			$.ajax({
				url: "SearchResult2.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					faculty: faculty,
					scentre: scentre
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result2A_count(user, faculty, scentre) {
			$.ajax({
				url: "result2_count.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					faculty: faculty,
					scentre: scentre
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request2A(user, id, faculty, scentre) {
			$.ajax({
				url: "search_frq2.php",
				type: "POST",
				data: {
					faculty: faculty,
					scentre: scentre,
					user: user,
					id: id
				},
				success: function(data) {
					search_result2A(user, faculty, scentre);
					result2A_count(user, faculty, scentre);
				}
			});
		}

		function search_result2B(user, level, faculty, scentre) {
			$.ajax({
				url: "SearchResult2.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					level: level,
					faculty: faculty,
					scentre: scentre
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result2B_count(user, level, faculty, scentre) {
			$.ajax({
				url: "result2_count.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					level: level,
					faculty: faculty,
					scentre: scentre
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request2B(user, id, level, faculty, scentre) {
			$.ajax({
				url: "search_frq2.php",
				type: "POST",
				data: {
					level: level,
					faculty: faculty,
					scentre: scentre,
					user: user,
					id: id
				},
				success: function(data) {
					search_result2B(user, level, faculty, scentre);
					result2B_count(user, level, faculty, scentre);
				}
			});
		}

		function search_result2C(user, level, dept, faculty) {
			$.ajax({
				url: "SearchResult2.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					level: level,
					dept: dept,
					faculty: faculty
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result2C_count(user, level, dept, faculty) {
			$.ajax({
				url: "result2_count.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					level: level,
					dept: dept,
					faculty: faculty
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request2C(user, id, level, dept, faculty) {
			$.ajax({
				url: "search_frq2.php",
				type: "POST",
				data: {
					level: level,
					faculty: faculty,
					dept: dept,
					user: user,
					id: id
				},
				success: function(data) {
					search_result2C(user, level, dept, faculty);
					result2C_count(user, level, dept, faculty);
				}
			});
		}

		function search_result2D(user, level, dept, scentre) {
			$.ajax({
				url: "SearchResult2.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					level: level,
					dept: dept,
					scentre: scentre
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result2D_count(user, level, dept, scentre) {
			$.ajax({
				url: "result2_count.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					level: level,
					dept: dept,
					scentre: scentre
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request2D(user, id, level, dept, scentre) {
			$.ajax({
				url: "search_frq2.php",
				type: "POST",
				data: {
					level: level,
					dept: dept,
					scentre: scentre,
					user: user,
					id: id
				},
				success: function(data) {
					search_result2D(user, level, dept, scentre);
					result2D_count(user, level, dept, scentre);
				}
			});
		}

		function search_result2E(user, dept, faculty, scentre) {
			$.ajax({
				url: "SearchResult2.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					dept: dept,
					faculty: faculty,
					scentre: scentre
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result2E_count(user, dept, faculty, scentre) {
			$.ajax({
				url: "result2_count.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					dept: dept,
					faculty: faculty,
					scentre: scentre
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request2E(user, id, dept, faculty, scentre) {
			$.ajax({
				url: "search_frq2.php",
				type: "POST",
				data: {
					dept: dept,
					faculty: faculty,
					scentre: scentre,
					user: user,
					id: id
				},
				success: function(data) {
					search_result2E(user, dept, faculty, scentre);
					result2E_count(user, dept, faculty, scentre);
				}
			});
		}

		function search_result2F(user, level, dept, faculty, scentre) {
			$.ajax({
				url: "SearchResult2.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					level: level,
					dept: dept,
					faculty: faculty,
					scentre: scentre
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result2F_count(user, level, dept, faculty, scentre) {
			$.ajax({
				url: "result2_count.php",
				type: "POST",
				async: false,
				data: {
					user: user,
					level: level,
					dept: dept,
					faculty: faculty,
					scentre: scentre
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request2F(user, id, level, dept, faculty, scentre) {
			$.ajax({
				url: "search_frq2.php",
				type: "POST",
				data: {
					level: level,
					dept: dept,
					faculty: faculty,
					scentre: scentre,
					user: user,
					id: id
				},
				success: function(data) {
					search_result2F(user, level, dept, faculty, scentre);
					result2F_count(user, level, dept, faculty, scentre);
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
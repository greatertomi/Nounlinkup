<?php
include("functions.php");
$conn = db_connect();
session_start();
$groupid = $_GET['check'];

$groupname = getGroupName($groupid);
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
	<title>Send out invitation</title>
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

		.selects {
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

		@media (max-width: 767px) {
			#searchCaption {
				display: none;
			}

			#searchLevel {
				display: none !important;
			}

			#searchFaculty {
				display: none !important;
			}

			#searchDepartment {
				width: 30% !important;
				margin-right: 8px !important;
			}

			#searchCentre {
				width: 40% !important;
				margin-right: 8px !important;
			}

			#paramSearch {
				display: block;
			}

			.search-options {
				padding-left: 0;
				margin-left: 0;
			}
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
			<div id="breadcrumb">
				<ul class="breadcrumb">
					<li><i class="fa fa-home"></i><a href="dashboard.php"> Home</a></li>
					<li class="active">Page</li>
					<li class="active">Search Result</li>
				</ul>
			</div>
			<div class="padding-md">
				<center>
					<h4> Send out invitations for <?php echo $groupname ?></h4>
				</center>
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

							<span id="searchCaption">Search by</span>
							<select class="form-control input-sm level selects" id="searchLevel" style="display:inline-block; width:9%;">
								<option selected="true" value=null>Level</option>
								<option>100L</option>
								<option>200L</option>
								<option>300L</option>
								<option>400L</option>
								<option>500L</option>
							</select>
							<select class="form-control input-sm dept selects" id="searchDepartment" style="display:inline-block; width:26%;" id="">
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
							<select class="form-control input-sm faculty selects" id="searchFaculty" style="display:inline-block; width:20%">
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
							<select class="form-control input-sm scentre selects" id="searchCentre" style="display:inline-block; width:26%;">
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
		var groupid = <?php echo json_encode($groupid) ?>;
		$(document).on('click', '#nameSearch', function() {
			var word = $(".name-input").val();

			if ($(".name-input").val() == "") {
				$.gritter.add({
					title: '<i class="fa fa-times-circle"></i> Empty Message Error!',
					text: 'No statement was entered in the textbox',
					sticky: false,
					time: '',
					class_name: 'gritter-danger'
				});
			} else {
				search_result1(groupid, word);
				result1_count(groupid, word);
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

		$(document).on("keyup", ".name-input", function() {
			let inviteinput = $(this).val()
			if (inviteinput != "") {
				$.ajax({
					url: "autocompleter.php",
					method: "POST",
					data: {
						groupid: groupid,
						inviteinput: inviteinput
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


		setInterval(function() {
			unreadMsg();
			unreadMsg2();
		}, 3000);

		$(document).on('click', '#paramSearch', function() {
			var level = $(".level").val();
			var dept = $(".dept").val();
			var faculty = $(".faculty").val();
			var scentre = $(".scentre").val();
			var groupid = <?php echo json_encode($groupid) ?>;

			if (level !== "null" && dept === "null" && faculty === "null" && scentre === "null") {
				search_result21(groupid, level);
				result21_count(groupid, level);
			} else if (level === "null" && dept !== "null" && faculty === "null" && scentre === "null") {
				//alert(dept);
				search_result22(groupid, dept);
				result22_count(groupid, dept);
			} else if (level === "null" && dept === "null" && faculty !== "null" && scentre === "null") {
				//alert("faculty is present");
				search_result23(groupid, faculty);
				result23_count(groupid, faculty);
			} else if (level === "null" && dept === "null" && faculty === "null" && scentre !== "null") {
				search_result24(groupid, scentre);
				result24_count(groupid, scentre);
			} else if (level !== "null" && dept !== "null" && faculty === "null" && scentre === "null") {
				//alert(user+ " "+level+ " "+dept);
				search_result25(groupid, level, dept);
				result25_count(groupid, level, dept);
			} else if (level !== "null" && dept === "null" && faculty !== "null" && scentre === "null") {
				search_result26(groupid, level, faculty);
				result26_count(groupid, level, faculty);
			} else if (level !== "null" && dept === "null" && faculty === "null" && scentre !== "null") {
				search_result27(groupid, level, scentre);
				result27_count(groupid, level, scentre);
			} else if (level === "null" && dept !== "null" && faculty !== "null" && scentre === "null") {
				search_result28(groupid, dept, faculty);
				result28_count(groupid, dept, faculty);
			} else if (level === "null" && dept !== "null" && faculty === "null" && scentre !== "null") {
				search_result29(groupid, dept, scentre);
				result29_count(groupid, dept, scentre);
			} else if (level === "null" && dept === "null" && faculty !== "null" && scentre !== "null") {
				search_result2A(groupid, faculty, scentre);
				result2A_count(groupid, faculty, scentre);
			} else if (level !== "null" && dept == "null" && faculty !== "null" && scentre !== "null") {
				//alert(user+ " "+level+ " "+dept+ " "+faculty);
				search_result2B(groupid, level, faculty, scentre);
				result2B_count(groupid, level, faculty, scentre);
			} else if (level !== "null" && dept !== "null" && faculty !== "null" && scentre === "null") {
				//alert(user+ " "+level+ " "+dept+ " "+faculty);
				search_result2C(groupid, level, dept, faculty);
				result2C_count(groupid, level, dept, faculty);
			} else if (level !== "null" && dept !== "null" && faculty === "null" && scentre !== "null") {
				search_result2D(groupid, level, dept, scentre);
				result2D_count(groupid, level, dept, scentre);
			} else if (level === "null" && dept !== "null" && faculty !== "null" && scentre !== "null") {
				search_result2E(groupid, dept, faculty, scentre);
				result2E_count(groupid, dept, faculty, scentre);
			} else if (level !== "null" && dept !== "null" && faculty !== "null" && scentre !== "null") {
				//alert(user+ " "+level+ " "+dept+ " "+faculty + ""+scentre);
				search_result2F(groupid, level, dept, faculty, scentre);
				result2F_count(groupid, level, dept, faculty, scentre);
			}
		});

		$(document).on('click', '.results', function() {
			var matricno = this.id;
			var word = $(".name-input").val();
			var groupid = <?php echo json_encode($groupid) ?>;
			send_request1(groupid, matricno, word);
		});

		$(document).on('click', '.results2', function() {
			var level = $(".level").val();
			var dept = $(".dept").val();
			var faculty = $(".faculty").val();
			var scentre = $(".scentre").val();
			var groupid = <?php echo json_encode($groupid) ?>;
			var matricno = this.id;

			if (level !== "null" && dept === "null" && faculty === "null" && scentre === "null") {
				send_request21(groupid, matricno, level);
			} else if (level === "null" && dept !== "null" && faculty === "null" && scentre === "null") {
				send_request22(groupid, matricno, dept);
			} else if (level === "null" && dept === "null" && faculty !== "null" && scentre === "null") {
				send_request23(groupid, matricno, faculty);
			} else if (level === "null" && dept === "null" && faculty === "null" && scentre !== "null") {
				send_request24(groupid, matricno, scentre);
			} else if (level !== "null" && dept !== "null" && faculty === "null" && scentre === "null") {
				send_request25(groupid, matricno, level, dept);
			} else if (level !== "null" && dept === "null" && faculty !== "null" && scentre === "null") {
				send_request26(groupid, matricno, level, faculty);
			} else if (level !== "null" && dept === "null" && faculty === "null" && scentre !== "null") {
				send_request27(groupid, matricno, level, scentre);
			} else if (level === "null" && dept !== "null" && faculty !== "null" && scentre === "null") {
				send_request28(groupid, matricno, dept, faculty);
			} else if (level === "null" && dept !== "null" && faculty === "null" && scentre !== "null") {
				send_request29(groupid, matricno, dept, scentre);
			} else if (level === "null" && dept === "null" && faculty !== "null" && scentre !== "null") {
				send_request2A(groupid, matricno, faculty, scentre);
			} else if (level !== "null" && dept === "null" && faculty !== "null" && scentre !== "null") {
				send_request2B(groupid, matricno, level, faculty, scentre);
			} else if (level !== "null" && dept !== "null" && faculty !== "null" && scentre === "null") {
				send_request2C(groupid, matricno, level, dept, faculty);
			} else if (level !== "null" && dept !== "null" && faculty === "null" && scentre !== "null") {
				send_request2D(groupid, matricno, level, dept, scentre);
			} else if (level === "null" && dept !== "null" && faculty !== "null" && scentre !== "null") {
				send_request2E(groupid, matricno, dept, faculty, scentre);
			} else if (level !== "null" && dept !== "null" && faculty !== "null" && scentre !== "null") {
				send_request2F(groupid, matricno, level, dept, faculty, scentre);
			}
		});

		function search_result1(groupid, word) {
			$.ajax({
				url: "SendInvitationSearch.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					word: word
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result1_count(groupid, word) {
			$.ajax({
				url: "SendInvitationsc.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					word: word
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request1(groupid, matricno, word) {
			$.ajax({
				url: "SendGrequest.php",
				type: "POST",
				data: {
					groupid: groupid,
					matricno: matricno
				},
				success: function(data) {
					search_result1(groupid, word);
					result1_count(groupid, word);
				}
			});
		}

		function search_result21(groupid, level) {
			$.ajax({
				url: "SendInvitationSearch2.php",
				type: "POST",
				async: false,
				data: {
					level: level,
					groupid: groupid
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result21_count(groupid, level) {
			$.ajax({
				url: "SendInvitationsc2.php",
				type: "POST",
				async: false,
				data: {
					level: level,
					groupid: groupid
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request21(groupid, matricno, level) {
			$.ajax({
				url: "SendGrequest2.php",
				type: "POST",
				data: {
					groupid: groupid,
					matricno: matricno,
					level: level
				},
				success: function(data) {
					search_result21(groupid, level);
					result21_count(groupid, level);
				}
			});
		}

		function search_result22(groupid, dept) {
			$.ajax({
				url: "SendInvitationSearch2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					dept: dept
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result22_count(groupid, dept) {
			$.ajax({
				url: "SendInvitationsc2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					dept: dept
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request22(groupid, matricno, dept) {
			$.ajax({
				url: "SendGrequest2.php",
				type: "POST",
				data: {
					groupid: groupid,
					matricno: matricno,
					dept: dept
				},
				success: function(data) {
					search_result22(groupid, dept);
					result22_count(groupid, dept);
				}
			});
		}

		function search_result23(groupid, faculty) {
			$.ajax({
				url: "SendInvitationSearch2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					faculty: faculty
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result23_count(groupid, faculty) {
			$.ajax({
				url: "SendInvitationsc2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					faculty: faculty
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request23(groupid, matricno, faculty) {
			$.ajax({
				url: "SendGrequest2.php",
				type: "POST",
				data: {
					groupid: groupid,
					matricno: matricno,
					faculty: faculty
				},
				success: function(data) {
					search_result23(groupid, faculty);
					result23_count(groupid, faculty);
				}
			});
		}

		function search_result24(groupid, scentre) {
			$.ajax({
				url: "SendInvitationSearch2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					scentre: scentre
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result24_count(groupid, scentre) {
			$.ajax({
				url: "SendInvitationsc2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					scentre: scentre
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request24(groupid, matricno, scentre) {
			$.ajax({
				url: "SendGrequest2.php",
				type: "POST",
				data: {
					groupid: groupid,
					matricno: matricno,
					scentre: scentre
				},
				success: function(data) {
					search_result24(groupid, scentre);
					result24_count(groupid, scentre);
				}
			});
		}

		function search_result25(groupid, level, dept) {
			$.ajax({
				url: "SendInvitationSearch2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					level: level,
					dept: dept
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result25_count(groupid, level, dept) {
			$.ajax({
				url: "SendInvitationsc2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					level: level,
					dept: dept
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request25(groupid, matricno, level, dept) {
			$.ajax({
				url: "SendGrequest2.php",
				type: "POST",
				data: {
					groupid: groupid,
					matricno: matricno,
					level: level,
					dept: dept
				},
				success: function(data) {
					search_result25(groupid, level, dept);
					result25_count(groupid, level, dept);
				}
			});
		}

		function search_result26(groupid, level, faculty) {
			$.ajax({
				url: "SendInvitationSearch2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					level: level,
					faculty: faculty
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result26_count(groupid, level, faculty) {
			$.ajax({
				url: "SendInvitationsc2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					level: level,
					faculty: faculty
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request26(groupid, matricno, level, faculty) {
			$.ajax({
				url: "SendGrequest2.php",
				type: "POST",
				data: {
					level: level,
					faculty: faculty,
					groupid: groupid,
					matricno: matricno
				},
				success: function(data) {
					search_result26(groupid, level, faculty);
					result26_count(groupid, level, faculty);
				}
			});
		}

		function search_result27(groupid, level, scentre) {
			$.ajax({
				url: "SendInvitationSearch2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					level: level,
					scentre: scentre
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result27_count(groupid, level, scentre) {
			$.ajax({
				url: "SendInvitationsc2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					level: level,
					scentre: scentre
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request27(groupid, matricno, level, scentre) {
			$.ajax({
				url: "SendGrequest2.php",
				type: "POST",
				data: {
					level: level,
					scentre: scentre,
					groupid: groupid,
					matricno: matricno
				},
				success: function(data) {
					search_result27(groupid, level, scentre);
					result27_count(groupid, level, scentre);
				}
			});
		}

		function search_result28(groupid, dept, faculty) {
			$.ajax({
				url: "SendInvitationSearch2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					dept: dept,
					faculty: faculty
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result28_count(groupid, dept, faculty) {
			$.ajax({
				url: "SendInvitationsc2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					dept: dept,
					faculty: faculty
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request28(groupid, matricno, dept, faculty) {
			$.ajax({
				url: "SendGrequest2.php",
				type: "POST",
				data: {
					faculty: faculty,
					dept: dept,
					user: user,
					id: id
				},
				success: function(data) {
					search_result28(groupid, dept, faculty);
					result28_count(groupid, dept, faculty);
				}
			});
		}

		function search_result29(groupid, dept, scentre) {
			$.ajax({
				url: "SendInvitationSearch2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					dept: dept,
					scentre: scentre
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result29_count(groupid, dept, scentre) {
			$.ajax({
				url: "SendInvitationsc2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					dept: dept,
					scentre: scentre
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request29(groupid, matricno, dept, scentre) {
			$.ajax({
				url: "SendGrequest2.php",
				type: "POST",
				data: {
					scentre: scentre,
					dept: dept,
					groupid: groupid,
					matricno: matricno
				},
				success: function(data) {
					search_result29(groupid, dept, scentre);
					result29_count(groupid, dept, scentre);
				}
			});
		}

		function search_result2A(groupid, faculty, scentre) {
			$.ajax({
				url: "SendInvitationSearch2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					faculty: faculty,
					scentre: scentre
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result2A_count(groupid, faculty, scentre) {
			$.ajax({
				url: "SendInvitationsc2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					faculty: faculty,
					scentre: scentre
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request2A(groupid, matricno, faculty, scentre) {
			$.ajax({
				url: "SendGrequest2.php",
				type: "POST",
				data: {
					faculty: faculty,
					scentre: scentre,
					groupid: groupid,
					matricno: matricno
				},
				success: function(data) {
					search_result2A(groupid, faculty, scentre);
					result2A_count(groupid, faculty, scentre);
				}
			});
		}

		function search_result2B(groupid, level, faculty, scentre) {
			$.ajax({
				url: "SendInvitationSearch2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					level: level,
					faculty: faculty,
					scentre: scentre
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result2B_count(groupid, level, faculty, scentre) {
			$.ajax({
				url: "SendInvitationsc2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					level: level,
					faculty: faculty,
					scentre: scentre
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request2B(groupid, matricno, level, faculty, scentre) {
			$.ajax({
				url: "SendGrequest2.php",
				type: "POST",
				data: {
					level: level,
					faculty: faculty,
					scentre: scentre,
					groupid: groupid,
					matricno: matricno
				},
				success: function(data) {
					search_result2B(groupid, level, faculty, scentre);
					result2B_count(groupid, level, faculty, scentre);
				}
			});
		}

		function search_result2C(groupid, level, dept, faculty) {
			$.ajax({
				url: "SendInvitationSearch2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					level: level,
					dept: dept,
					faculty: faculty
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result2C_count(groupid, level, dept, faculty) {
			$.ajax({
				url: "SendInvitationsc2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					level: level,
					dept: dept,
					faculty: faculty
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request2C(groupid, matricno, level, dept, faculty) {
			$.ajax({
				url: "SendGrequest2.php",
				type: "POST",
				data: {
					level: level,
					faculty: faculty,
					dept: dept,
					groupid: groupid,
					matricno: matricno
				},
				success: function(data) {
					search_result2C(groupid, level, dept, faculty);
					result2C_count(groupid, level, dept, faculty);
				}
			});
		}

		function search_result2D(groupid, level, dept, scentre) {
			$.ajax({
				url: "SendInvitationSearch2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					level: level,
					dept: dept,
					scentre: scentre
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result2D_count(groupid, level, dept, scentre) {
			$.ajax({
				url: "SendInvitationsc2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					level: level,
					dept: dept,
					scentre: scentre
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request2D(groupid, matricno, level, dept, scentre) {
			$.ajax({
				url: "SendGrequest2.php",
				type: "POST",
				data: {
					level: level,
					dept: dept,
					scentre: scentre,
					groupid: groupid,
					matricno: matricno
				},
				success: function(data) {
					search_result2D(groupid, level, dept, scentre);
					result2D_count(groupid, level, dept, scentre);
				}
			});
		}

		function search_result2E(groupid, dept, faculty, scentre) {
			$.ajax({
				url: "SendInvitationSearch2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					dept: dept,
					faculty: faculty,
					scentre: scentre
				},
				success: function(data) {
					$("#search-results").html(data);
				}
			});
		}

		function result2E_count(groupid, dept, faculty, scentre) {
			$.ajax({
				url: "SendInvitationsc2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
					dept: dept,
					faculty: faculty,
					scentre: scentre
				},
				success: function(data) {
					$("#lists").html(data);
				}
			});
		}

		function send_request2E(groupid, matricno, dept, faculty, scentre) {
			$.ajax({
				url: "SendGrequest2.php",
				type: "POST",
				data: {
					dept: dept,
					faculty: faculty,
					scentre: scentre,
					groupid: groupid,
					matricno: matricno
				},
				success: function(data) {
					search_result2E(groupid, dept, faculty, scentre);
					result2E_count(groupid, dept, faculty, scentre);
				}
			});
		}

		function search_result2F(groupid, level, dept, faculty, scentre) {
			$.ajax({
				url: "SendInvitationSearch2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
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

		function result2F_count(groupid, level, dept, faculty, scentre) {
			$.ajax({
				url: "SendInvitationsc2.php",
				type: "POST",
				async: false,
				data: {
					groupid: groupid,
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

		function send_request2F(groupid, matricno, level, dept, faculty, scentre) {
			$.ajax({
				url: "SendGrequest2.php",
				type: "POST",
				data: {
					level: level,
					dept: dept,
					faculty: faculty,
					scentre: scentre,
					groupid: groupid,
					matricno: matricno
				},
				success: function(data) {
					search_result2F(matricno, level, dept, faculty, scentre);
					result2F_count(matricno, level, dept, faculty, scentre);
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
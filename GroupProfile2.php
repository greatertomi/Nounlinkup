<?php
include("functions.php");
$conn = db_connect();
session_start();
if (!$_SESSION['matricno']) {
	header("location:index.php");
}
$matricno = $_SESSION['matricno'];
$groupid = $_GET['tocheck'];
$creat = getGroupCreator($groupid);
if ($matricno != $creat) {
	header("location:GroupProfile.php?tocheck=$groupid");
}

$query = "select * from users where matricno = '$matricno'";
$result = mysqli_query($conn, $query) or die("could not query database");
while ($row = mysqli_fetch_array($result)) {
	$name = $row['fullname'];
	$level = $row['level'];
	$email = $row['email'];
	$picture = $row['picture'];
}

if ($email == "") {
	$email = "<span style = 'color:#d13438'>No email</span>";
}

$query2 = mysqli_query($conn, "select * from groups where groupid = '$groupid'");
$row2 = mysqli_fetch_array($query2);
$groupname = strtoupper($row2['groupname']);
$purpose = $row2['purpose'];
$visibility = $row2['visibility'];
$creator = getname($row2['creator']);
$datecreated = strtotime($row2['datecreated']);
$timecreated = date("j M Y g:i a", $datecreated);
$groupimage = $row2['groupimage'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title><?php echo $groupname ?></title>
	<link rel="icon" href="./bn/img/noun2.jpg" sizes="32x32">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Bootstrap core CSS -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

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

		.img-thumbnail {
			height: "200px";
			width: "250px";
		}

		.list-group-item {
			padding-left: 0px;
		}

		.list-group {
			padding-top: 3px;
		}

		#infotitle {
			font-weight: 700;
		}

		.main-menu ul li a:hover {
			text-decoration: none;
		}

		.gritter-danger {
			margin-top: 25px;
		}

		.option {
			margin-left: 70%;
			margin-top: 15px;
			margin-bottom: 20px;
		}

		.panel-heading.header1 {
			background-color: #1a1a1b;
			font-size: 15px;
			color: white;
		}

		#name {
			color: #1a1a1b;
			padding: 10px;
		}

		#name:hover {
			background-color: #eeeeee;
			text-decoration: none;
		}

		.btnapprove {
			margin-top: 0;
		}

		.btnapprove:hover {
			background-color: black;
		}

		#gname {
			margin-top: 10px;
			margin-bottom: 30px;
			margin-left: 30px;
		}
	</style>

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
						<strong><?php echo $name; ?></strong>
						<span><i class="fa fa-chevron-down"></i></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a class="clearfix" href="#">
								<img src="<?php echo $picture; ?>" alt="User Avatar">
								<div class="detail">
									<strong><?php echo $name ?></strong>
									<p class="grey"><?php echo $email ?></p>
								</div>
							</a>
						</li>
						<li><a tabindex="-1" href="profile.php" class="main-link"><i class="fa fa-edit fa-lg"></i> Edit profile</a></li>
						<li><a tabindex="-1" href="all_notifications.php" class="main-link"><i class="fa fa-bullhorn fa-lg"></i> Notifications</a></li>
						<li><a tabindex="-1" href="#" class="theme-setting"><i class="fa fa-cog fa-lg"></i> Setting</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" class="main-link logoutConfirm_open" href="GroupProfile2.phplogoutConfirm"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
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
					<a class="btn btn-sm pull-right logoutConfirm_open" href="GroupProfile2.phplogoutConfirm">
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
			<div id="row">
				<div class="col-xs-6 col-sm-6 option">
					<a href='GroupChat.php' class='btn btn-xs btn-primary'>Back to group chat</a>
					<a href='SendInvitation.php?check=<?php echo $groupid; ?>' class='btn btn-xs btn-primary'>Send out invitation</a>
					<a href='#' class='btn btn-xs btn-primary'>Delete Group</a>
				</div>
			</div>

			<div class="padding-md">
				<div class="row">
					<div class="col-md-3 col-sm-3">
						<div class="row">
							<div class="col-xs-6 col-sm-6">
								<strong class="font-20"><?php echo $groupname; ?></strong>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<a href="#">
									<img src="<?php echo $groupimage ?>" alt="Group picture" height="200" width="250">
								</a>
								<div class="seperator"></div>
								<div class="seperator"></div>
							</div><!-- /.col -->
							<!-- /.col -->
						</div><!-- /.row -->
						<div class="panel m-top-md">
							<div class="panel-body">
								<div class="row">
									<div class="col-xs-6 text-center">
										<span class="block font-14 members_no"><?php echo countGroupMembers($groupid) ?></span>
										<small class="text-muted">Members</small>
									</div><!-- /.col -->
									<div class="col-xs-6 text-center">
										<span class="block font-14 messages_no"><?php echo countGroupMessages($groupid) ?></span>
										<small class="text-muted">Messages</small>
									</div><!-- /.col -->

								</div><!-- /.row -->
							</div>
						</div><!-- /panel -->

						<div>
							<ul class="nav">
								<li class="nav-header">Members</li>
								<?php
								$query3 = mysqli_query($conn, "SELECT fullname, member FROM group_members a LEFT JOIN users b ON a.member = b.matricno WHERE groupid = '$groupid' AND statuss = '1'");
								while ($row = mysqli_fetch_array($query3)) {
									$mname = $row['fullname'];
									$matric = $row['member'];
									echo "<li><a href='profile2.php?tocheck=$matric'>$mname</a>
														</li>";
								}
								?>

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
												<i class="fa fa-info-circle"></i> About Group
											</div>
											<div class="panel-body list-group">
												<li class="list-group-item"><span id='infotitle'>Created by: </span> <a href='#'><?php echo $creator ?> </a></li>
												<li class="list-group-item"><span id='infotitle'>Time Created: </span> <?php echo $timecreated ?> </li>
												<li class="list-group-item"><span id='infotitle'>Visibility: </span> <?php echo $visibility ?> </li>
											</div>
										</div>

										<div class="panel panel-default fadeInDown animation-delay3">
											<div class="panel-heading">
												<i class="fa fa-coffee"></i> Purpose...
											</div>
											<ul class="list-group">
												<li class="list-group-item edit-li" style="margin-left:15px;">
													<div>
														<p><?php echo $purpose ?><p>
													</div>
													<small class='block text-muted'>
														<a href='#' id='edit'>Edit</a>
													</small>
												</li>

											</ul>
										</div>
										<div class="panel fadeInDown animation-delay2">
											<div class="panel-heading header1">
												Request(s)
											</div>
											<div class="panel-body panel1 list-group">
												<ul class="request_list">
													<?php
													$query4 = "SELECT * FROM users WHERE matricno IN (SELECT member FROM group_members WHERE groupid = '$groupid' AND statuss = '2')";
													$result4 = mysqli_query($conn, $query4);
													while ($row = mysqli_fetch_array($result4)) {
														$sn = $row['sn'];
														$fullname = $row['fullname'];
														$matricno = $row['matricno'];
														echo "
																<li class = 'list-group-item'><a href='profile2.php?tocheck=$matricno' id = 'name'>$fullname</a>
																	<button class = 'btn btn-xs btn-primary pull-right btnapprove' id = '$matricno'>approve</button>
																</li>";
													}
													?>
												</ul>
											</div>
										</div>


									</div>


									<div class="col-md-6">

										<div class="panel panel-default fadeInUp animation-delay4">
											<div class="panel-heading">
												Top three contributors
											</div>
											<div class="list-group">
												<?php
												$sql = "SELECT DISTINCT poster, COUNT(DISTINCT content)AS occurence, fullname, picture FROM group_messages a
                                                        LEFT JOIN users b ON a.poster = b.matricno WHERE ingroup = '$groupid' GROUP BY poster ORDER BY occurence DESC LIMIT 3";
												$res = mysqli_query($conn, $sql);

												while ($row = mysqli_fetch_array($res)) {
													$poster = $row['poster'];
													$name = $row['fullname'];
													$picture = $row['picture'];
													?>

													<a href="profile2.php?tocheck=<?php echo $poster ?>" class="list-group-item" style="margin-left:15px;">
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
												Least three contributors
											</div>
											<div class="list-group">
												<?php
												$sql = "SELECT DISTINCT poster, COUNT(DISTINCT content)AS occurence, fullname, picture FROM group_messages a
																			LEFT JOIN users b ON a.poster = b.matricno WHERE ingroup = '$groupid' GROUP BY poster ORDER BY occurence ASC LIMIT 3";
												$res = mysqli_query($conn, $sql);

												while ($row = mysqli_fetch_array($res)) {
													$poster = $row['poster'];
													$name = $row['fullname'];
													$picture = $row['picture'];
													?>

													<a href="profile2.php?tocheck=<?php echo $poster ?>" class="list-group-item" style="margin-left:15px;">
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
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
		var purpose = <?php echo json_encode($purpose) ?>;
		//alert(groupid);

		$(document).on("click", "#edit", function() {
			$(".edit-li").html("<div><p><input type = 'text' id = 'text' class = 'form-control correct-profile'></p></div><small class='block text-muted'><a href = '#' id = 'cancel'>Cancel</a></small>");
		});
		$(document).on("click", "#cancel", function() {
			$(".edit-li").html("<div><p> " + purpose + " <p></div><small class='block text-muted'><a href = '#' id = 'edit'>Edit</a></small>");
		});


		$(document).on("keypress", ".correct-profile", function(event) {
			var keyCode = event.which || event.keyCode;
			if (keyCode == 13) {
				var word = $(".correct-profile").val();

				event.preventDefault();
				correctPurpose(groupid, word);
			}
		});

		$(document).on("click", ".btnapprove", function() {
			var gmember = this.id;
			$.ajax({
				url: "GroupAcceptApprove.php",
				type: "post",
				data: {
					gmember: gmember,
					groupid: groupid
				},
				success: function(response) {
					$('.request_list').html(response);
				}
			});
		});

		function correctPurpose(groupid, word) {
			if ($(".correct-profile").val() == "") {
				$.gritter.add({
					title: '<i class="fa fa-times-circle"></i> Empty Message Error!',
					text: 'No statement was entered in the textbox',
					sticky: false,
					time: '',
					class_name: 'gritter-danger'
				});
			} else {
				$.ajax({
					url: "correctGroupPurpose.php",
					type: "post",
					data: {
						groupid: groupid,
						word: word
					},
					success: function(response) {
						$(".edit-li").html(response);
						purpose = response;
					}
				});
			}
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

		function updater() {
			$.ajax({
				url: "AjaxUpdateMembers.php",
				type: "post",
				dataType: "json",
				data: {
					groupid: groupid
				},
				success: function(response) {
					$(".members_no").html(response[0]);
					$(".messages_no").html(response[1]);
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
			updater();
		}, 3000);
	</script>

</body>

</html>
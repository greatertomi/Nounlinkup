<?php
include("functions.php");
$conn = db_connect();
session_start();
if (!$_SESSION['matricno']) {
	header("location:index.php");
}
$matricno = $_SESSION['matricno'];

$q = "SELECT * FROM groups a LEFT JOIN group_members b ON a.groupid = b.groupid WHERE member = '$matricno' LIMIT 1";
$r = mysqli_query($conn, $q);
$row = mysqli_fetch_assoc($r);
$defaultgroup = $row['groupid'];


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
	<title>Group Chat</title>
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
	<link rel="stylesheet" href="css/emojionearea.min.css">

	<!-- Pace -->
	<link href="css/pace.css" rel="stylesheet">

	<!-- Perfect -->
	<link href="css/app.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/app-skin.css" rel="stylesheet">

	<style>
		#userdiv {
			background-color: #daf5bd;
		}

		#userheader,
		#usertime {
			background-color: #daf5bd;
			color: #b5b5b5;
			font-size: 12px;
			padding-top: 0px;
		}

		#userheader,
		#guestheader {
			padding-left: 0px;
		}

		#guesttime,
		#guestheader {
			font-size: 12px;
		}

		#guestheader {
			padding-top: 0px;
		}

		.gritter-danger {
			margin-top: 75px;
		}

		.mini-option {
			margin-right: 60px;
		}

		.emojionearea>.emojionearea-editor {
			min-height: 50px;
			max-height: 60px;
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
								<li><a href="CreateGroup.php"><span class="submenu-label">Create Group</span></a></li>
								<li class="active"><a href="#"><span class="submenu-label">Group Chat</span></a></li>
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
			<div class="chat-wrapper scrollable-div">
				<div class="chat-sidebar border-right bg-white">
					<div class="border-bottom padding-sm" style="height: 40px;">
						Groups
					</div>
					<ul class='friend-list'>
						<?php
						$result2 = GroupList($matricno);
						$count = 1;

						while ($row2 = mysqli_fetch_array($result2)) {
							$groupid = $row2['groupid'];
							$groupname = $row2['groupname'];
							$picture = $row2['groupimage'];
							$unreadmsg = countUnreadGroupMessages($groupid, $matricno);
							$lastmessage = lastGroupMessage($groupid, $matricno);
							$msg2;
							$time2;

							while ($row = mysqli_fetch_array($lastmessage)) {
								$msg = $row['content'];
								$time = $row['dateposted'];
								$time2 = timeCalculator($time);
								$poster = $row['poster'];

								if ($poster == $matricno) {
									$msg2 = "<i class='fa fa-check text-success'></i> $msg";
								} else {
									$msg2 = "<i class='fa fa-reply'></i> $msg";
								}
							}

							echo "
								<li id = '$groupid' class='friend group$count'>
									<a href='#' class='clearfix'>
									<img src=$picture alt='' class='img-circle'>
									<div class='friend-name'>	
										<strong>$groupname</strong>
									</div>
									<div class='last-message text-muted'>";

							if (isset($msg2)) {
								echo $msg2;
							};
							echo "</div><small class='time text-muted'>";
							if (isset($time2)) {
								echo $time2;
							};
							echo "</small>
									<span class='chat-alert'></span></a>
								</li>
							";
							$count++;
						}
						?>
					</ul>
				</div>

				<div class="chat-inner scrollable-div">
					<div class="chat-header bg-white">
						<button type="button" class="navbar-toggle" id="friendListToggle">
							<i class="fa fa-comment fa-lg"></i>
							<span class="notification-label bounceIn animation-delay4"></span>
						</button>
						<div class="pull-right mini-option">
							<a class="btn btn-xs btn-default" href="search_groups.php">Find more groups</a>
							<div class='btn-group'>
								<button class='btn btn-xs btn-default dropdown-toggle' data-toggle='dropdown'>Group info <span class='caret'></span></button>
								<ul class='dropdown-menu'>
									<?php
									$resp1 = GroupList($matricno);
									while ($row = mysqli_fetch_array($resp1)) {
										$groupname = $row['groupname'];
										$groupid = $row['groupid'];
										$creator = $row['creator'];

										if ($matricno == $creator) {
											echo "<li><a href='GroupProfile2.php?tocheck=$groupid'>$groupname</a></li>";
										} else {
											echo "<li><a href='GroupProfile.php?tocheck=$groupid'>$groupname</a></li>";
										}
									}
									?>
								</ul>
							</div>

						</div>
					</div>

					<div class='chat-message'>
						<ul class='chat' id='chat'>
							<?php
							$query3 = fetchGroupMessages($defaultgroup, $matricno);

							while ($row = mysqli_fetch_array($query3)) {
								$name = $row['fullname'];
								$time = $row['dateposted'];
								$time = timeCalculator($time);
								$content = $row['content'];
								$picture = $row['picture'];
								$poster = $row['poster'];

								if ($poster == $matricno) {
									echo "<li class='left clearfix'>
										<span class='chat-img pull-left'>
											<img src=$picture alt='User Avatar'>
										</span>
										<div class='chat-body clearfix' id='userdiv'>
											<div class='header' id = 'userheader'>
												<strong class='primary-font' id = 'username'>$name</strong>
												<small class='pull-right text-muted' id = 'usertime'><i class='fa fa-clock-o'></i> $time</small>
											</div>
											<p>
												$content
											</p>
										</div>
										</li>";
								} else {
									echo "<li class='right clearfix'>
										<span class='chat-img pull-right'>
											<img src=$picture alt='User Avatar'>
										</span>
										<div class='chat-body clearfix' id = 'guestdiv'>
											<div class='header' id = 'guestheader'>
												<strong class='primary-font' id = 'guestname'>$name</strong>
												<small class='pull-right text-muted' id = 'guesttime'><i class='fa fa-clock-o'></i> $time</small>
											</div>
											<p>
												$content 
											</p>
										</div>
										</li>";
								}
							}

							?>
						</ul>
					</div>
					<div class="chat-box bg-white">
						<div class="input-group">
							<textarea class="form-control border no-shadow no-rounded" row="2" id="message" style="display:none" placeholder="Type your message here"></textarea>
							<span class="input-group-btn">
								<button class="btn btn-success no-rounded" id="send" type="button">Send</button>
							</span>
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
	<script src="js/emojionearea.min.js"></script>
	<!-- Slimscroll -->
	<script src='js/jquery.slimscroll.min.js'></script>
	<script src='js/jquery.gritter.min.js'></script>

	<!-- Cookie -->
	<script src='js/jquery.cookie.min.js'></script>

	<!-- Perfect -->
	<script src="js/app/app.js"></script>

	<script>
		var user = <?php echo json_encode($matricno) ?>;
		var group = <?php echo json_encode($defaultgroup) ?>;
		$("#message").emojioneArea();

		$(".group1").addClass("active");
		chatStats(user);
		unreadMsg2();
		unreadMsg();

		$(document).on("click", ".friend", function() {
			group = this.id;
			viewedChats("yes", user, group);
			displayResult(user, group);
			unreadMsg();

			$(".friend").removeClass('active');
			$("#" + group).addClass('active');
		});

		function displayResult(user, group) {
			$.ajax({
				url: "throwMsg.php",
				type: "POST",
				async: false,
				data: {
					gres: 1,
					group: group,
					user: user
				},
				success: function(response) {
					$(".chat-message .chat").html(response);
				}
			});
		}

		$(document).on("click", "#send", function() {
			let message = $("#message").data("emojioneArea").getText();
			if (message == "") {
				$.gritter.add({
					title: '<i class="fa fa-times-circle"></i> Empty Message Error!',
					text: 'No message was entered in the message box.',
					sticky: false,
					time: '',
					class_name: 'gritter-danger'
				});
			} else if (group == null) {
				$.gritter.add({
					title: '<i class="fa fa-times-circle"></i> No Friend Selected Error!',
					text: 'You have not selected a group to chat in.',
					sticky: false,
					time: '',
					class_name: 'gritter-danger'
				});
			} else {
				var msg = $("#message").val();

				$.ajax({
					type: "POST",
					url: "throwMsg.php",
					data: {
						save2: 1,
						post: message,
						user: user,
						group: group,
					},
					success: function() {
						displayResult(user, group);
						displayLastMessage(user);
						$("#message").data("emojioneArea").setText("");
					}
				});
			}
		});

		function chatStats(user) {
			$.ajax({
				url: "getChatStats.php",
				type: "post",
				dataType: "json",
				data: {
					chat2: 1,
					user: user
				},
				success: function(response) {
					var count = response[0];
					for (var i = 1; i <= count; i++) {
						$('.group' + i + ' span.chat-alert').html(response[i]);
					}
				}
			});
		}

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
					$("div.chat-inner span.notification-label").html(response[0]);
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
					$("div.chat-inner span.notification-label").html(response[0]);
				}
			});
		}

		function viewedChats(view = '', user, group) {
			$.ajax({
				url: "viewedChats.php",
				type: "post",
				dataType: "json",
				data: {
					view2: view,
					user: user,
					group: group
				},
				success: function(response) {
					var count = response[0];
					for (var i = 1; i <= count; i++) {
						$('.group' + i + ' span.chat-alert').html(response[i]);
					}
				}
			});
		}

		function displayLastMessage(user) {
			$.ajax({
				url: "AjaxLastMessage.php",
				type: "post",
				dataType: "json",
				data: {
					lastMsg2: 1,
					user: user
				},
				success: function(response) {
					var count = response[0];
					var j = 1;
					for (var i = 1; i <= count; i += 2) {
						$(".group" + j + " div.last-message").html(response[i]);
						//alert(response[i]);
						$(".group" + j + " small.time").html(response[i + 1]);
						++j
					}

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
			chatStats(user);
			displayResult(user, group);
			displayLastMessage(user)
		}, 3000);
	</script>

</body>

</html>
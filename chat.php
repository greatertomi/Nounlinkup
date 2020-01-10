<?php
include("functions.php");
session_start();

$conn = db_connect();
if (!$_SESSION['matricno']) {
	header("location:index.php");
}
$matricno = $_SESSION['matricno'];

$q = "SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$matricno' AND STATUS = '2'  
			UNION SELECT user1 FROM friends WHERE user2 = '$matricno' AND STATUS = '2') LIMIT 1";
$r = mysqli_query($conn, $q);
$row = mysqli_fetch_assoc($r);
$friend = $row['matricno'];

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
	<title>Chat</title>
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

		#userheader {
			padding-left: 0px;
		}

		#guesttime,
		#guestheader {
			font-size: 12px;
		}

		#guestheader {
			padding-left: 0px;
		}

		.friend-list {
			font-size: 12px;
		}

		.gritter-danger {
			margin-top: 75px;
		}

		.mini-option {
			margin-right: 15px;
		}

		.fa-circle {
			font-size: 10px;
			color: #16a05c;
			margin-left: 3px;
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
	</div>

	<div id="wrapper" class="preload">
		<div id="top-nav" class="fixed skin-7">
			<div class="brand">
				<span>NOUN</span>
				<span class="text-toggle"> Linkup</span>
			</div>
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
						<strong><?php echo $name ?></strong>
						<span><i class="fa fa-chevron-down"></i></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a class="clearfix">
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
					<a class="btn btn-sm pull-right logoutConfirm_open" href="chat.phplogoutConfirm">
						<i class="fa fa-power-off"></i>
					</a>
				</div>
				<div class="user-block clearfix">
					<img src="<?php echo $picture; ?>" alt="User Avatar">
					<div class="detail">
						<strong><?php echo $name ?></strong>
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
						<li class="active">
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
			<div class="chat-wrapper scrollable-div">
				<div class="chat-sidebar border-right bg-white">
					<div class="border-bottom padding-sm" style="height: 40px;">
						Friends
					</div>
					<ul class='friend-list'>
						<?php
						$query2 = "SELECT * FROM users WHERE matricno IN (SELECT user2 FROM friends 
								WHERE user1 = '$matricno' AND status = '2'  UNION SELECT user1 FROM friends 
								WHERE user2 = '$matricno' AND status = '2')";
						$result2 = mysqli_query($conn, $query2) or die("Could not query database");
						$count = 1;
						$msgcount = 0;

						while ($row2 = mysqli_fetch_array($result2)) {
							$matric = $row2['matricno'];
							$name = $row2['fullname'];
							$picture = $row2['picture'];
							$unreadmsg = countUnreadMessages($matricno, $matric);
							$lastmessage = lastMessage($matricno, $matric);
							$msg2;
							$time2;

							while ($row = mysqli_fetch_array($lastmessage)) {
								$msg = $row['content'];
								$time = $row['date'];
								$time2 = timeCalculator($time);
								$sender = $row['sender'];

								if ($sender == $matricno) {
									$msg2 = "<i class='fa fa-check text-success'></i> $msg";
								} else {
									$msg2 = "<i class='fa fa-reply'></i> $msg";
								}
							}


							if ($count == 0) {
								$_SESSION['guest'] = $matric;
							}

							echo "
						
						<li id='$matric' class='friend friend$count'>
							<a href='#' class='clearfix'>
								<img src=$picture alt='' class='img-circle'>
								<div class='friend-name'>	
									<strong>$name</strong><span id='online'></span>
								</div>
								<div class='last-message text-muted'>";

							if (isset($msg2)) {
								echo $msg2;
							};
							echo "</div> <small class='time text-muted'>";
							if (isset($time2)) {
								echo $time2;
							};
							echo "</small>
								<span class='chat-alert'></span></a>
								</li>";
							$count++;
							$msgcount++;
						} ?>
						<?php $_SESSION['count'] = $count;
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
							<a class="btn btn-xs btn-default" href="search_friends.php">Add Friend</a>
							<!--<a class="btn btn-xs btn-default">Create Group</a>-->
						</div>
					</div>

					<div class='chat-message'>
						<ul class='chat' id='chat'>
							<?php
							$query3 = fetchMessages($matricno, $friend);

							while ($row = mysqli_fetch_array($query3)) {
								$name = $row['fullname'];
								$time = $row['date'];
								$time = timeCalculator($time);
								$content = $row['content'];
								$picture = $row['picture'];
								$matric = $row['matricno'];

								if ($matric == $matricno) {
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
						<!--<div><i class="fa fa-paperclip"></i></div>-->
					</div>

					<!--<span><i class="fa fa-paperclip"></span>-->
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
	<script src='js/jquery.gritter.min.js'></script>

	<!-- Popup Overlay -->
	<script src='js/jquery.popupoverlay.min.js'></script>

	<script src="js/emojionearea.min.js"></script>
	<!-- Slimscroll -->
	<script src='js/jquery.slimscroll.min.js'></script>

	<!-- Cookie -->
	<script src='js/jquery.cookie.min.js'></script>

	<!-- Perfect -->
	<script src="js/app/app.js"></script>

	<script>
		$(function() {
			$('#friendListToggle').click(function() {
				$('.chat-wrapper').toggleClass('sidebar-display');
			});
			$(".friend1").addClass("active");

			document.ontouchmove = function(e) {
				if (disableScroll) {
					e.preventDefault();
				}
			}
			var id = "";
			var user = <?php echo json_encode($matricno) ?>;
			var guest = <?php echo json_encode($friend) ?>;
			$("#message").emojioneArea();

			$(document).on("click", ".friend", function() {
				guest = this.id;
				viewedChats("yes", user, guest);
				displayResult(user, guest);
				unreadMsg();
				$(".friend").removeClass('active');
				$("#" + guest).addClass('active');
			});

			chatStats(user);
			unreadMsg();
			unreadMsg2();
			var count = <?php echo json_encode($_SESSION['count']) ?>;

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
				} else if (guest == null) {
					//alert("You need to pick a friend to chat with");
					$.gritter.add({
						title: '<i class="fa fa-times-circle"></i> No Friend Selected Error!',
						text: 'You have not selected a friend you want to chat with.',
						sticky: false,
						time: '',
						class_name: 'gritter-danger'
					});
				} else {
					$.ajax({
						type: "POST",
						url: "throwMsg.php",
						data: {
							save1: 1,
							post: message,
							user: user,
							guest: guest,
						},
						success: function() {
							displayResult(user, guest);
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
						chat1: 1,
						user: user
					},
					success: function(response) {
						var count = response[0];
						for (var i = 1; i <= count; i++) {
							$('.friend' + i + ' span.chat-alert').html(response[i]);
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
					}
				});
			}

			function viewedChats(view = '', user, guest) {
				$.ajax({
					url: "viewedChats.php",
					type: "post",
					dataType: "json",
					data: {
						view: view,
						user: user,
						guest: guest
					},
					success: function(response) {
						var count = response[0];
						for (var i = 1; i <= count; i++) {
							$('.friend' + i + ' span.chat-alert').html(response[i]);
						}
					}
				});
			}

			function displayResult(user, guest) {
				$.ajax({
					url: "throwMsg.php",
					type: "POST",
					async: false,
					data: {
						res: 1,
						user: user,
						guest: guest,
					},
					success: function(response) {
						$(".chat-message .chat").html(response);
					}
				});
			}

			function displayLastMessage(user) {
				$.ajax({
					url: "AjaxLastMessage.php",
					type: "post",
					dataType: "json",
					data: {
						lastMsg1: 1,
						user: user
					},
					success: function(response) {
						var count = response[0];
						var j = 1;
						for (var i = 1; i <= count; i += 2) {
							$(".friend" + j + " div.last-message").html(response[i]);
							//alert(response[i]);
							$(".friend" + j + " small.time").html(response[i + 1]);
							++j
						}

					}
				});
			}

			function update_last_activity() {
				$.ajax({
					url: "update_last_activity.php",
					success: function() {
						//console.log("cool");
					}
				})
			}


			function login_checker() {
				$.ajax({
					url: "login_checker.php",
					type: "POST",
					dataType: "json",
					data: {
						user: user
					},
					success: function(data) {
						let total = data[0];
						let j = 1;
						for (let i = 2; i <= total; i += 2) {
							$(".friend" + j + " span#online").html(data[i]);
							++j;
						}
					}
				})
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
				unreadMsg2();
				unreadMsg();
				chatStats(user);
				displayResult(user, guest);
				displayLastMessage(user)
			}, 3000);

			setInterval(function() {
				update_last_activity();
				login_checker();
				handleNotification();
			}, 5000);
		});
	</script>

</body>

</html>
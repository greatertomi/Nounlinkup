<?php
session_start();
//$name = $_SESSION['name'];
$matricno = $_SESSION['matricno'];
$login_id = $_SESSION['login_id'];
//$picture = $_SESSION['picture'];
if (!isset($_SESSION['matricno'])) {
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
	$stdept = $rows['department'];
	$stlevel = $rows['level'];
	$stscentre = $rows['study_centre'];
}
if ($email == "") {
	$email = "<span style = 'color:#d13438'>No email</span>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Dashboard</title>
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
		.panel {
			border-color: #e1e1e1;
			border-width: 1px;
		}

		html,
		body {
			overflow: auto;
		}

		.posterdiv {
			background-color: white;
			height: 150px;
		}

		.search-options {
			margin-bottom: 30px;
		}

		.search-options a {
			margin-left: 88%;
		}

		#userimg {
			float: left;
			margin-right: 15px;
		}

		#content {
			clear: both;
			margin-left: 5px;
			margin-top: 25px;
			font-size: 14px;
		}

		#foot {
			margin-top: 25px;
		}

		#posts {
			color: #1a1a1a;
			box-shadow: 6px 6px 3px #e1e5e5;
		}

		.fainteract {
			font-size: 20px;
			margin-right: 7px;
			margin-left: 17px;
			color: #8b9aa6;
			cursor: pointer;
			user-select: none;
		}

		.fainteract:hover {
			color: #323447;
		}

		#headername {
			font-size: 16px;
			font-weight: 600;
		}

		#headerdept,
		#headerscentre {
			font-size: 12px;
		}

		.comment {
			width: 97%;
		}

		#btnpost {
			margin-bottom: 5px;
			width: 100px;
			background-color: #328130;
			color: white;
		}

		#btnpost:hover {
			background-color: #294629;
		}

		hr {
			margin: 5px 0px 5px 0px;
		}

		#last {
			min-height: 900px;
			max-height: 1800px;
			margin-bottom: 40px;
		}

		.comment {
			margin-left: 7px;
			margin-right: 5px;
			border-radius: 7px;
			padding: 6px;
		}

		#comments {
			margin-left: 10px;
			padding: 10px;

		}

		.comment-text {
			margin-left: 5px;
			background-color: #f2f3f5;
			padding: 7px;
			border-radius: 15px;
		}

		#commenter-name {
			color: #4267b2;
			margin-right: 2px;
		}

		#time {
			font-family: monotype-corsiva;
		}

		.read_comments,
		.read_comments:hover,
		.read_comments:active {
			margin-left: 40%;
			color: #4267b2;
			text-decoration: none;
			cursor: pointer;
		}

		.read_comments:hover {
			color: #323447;
			text-decoration: underline;
		}

		#first {
			margin-left: 20px;
		}

		.panel-default {
			height: 800px;
			box-shadow: 6px 6px 3px #e1e5e5;
			border-radius: 10px;
			cursor: pointer;
		}

		.panel-heading {
			font-size: 14px;
			text-transform: uppercase;
		}

		#recommender {
			margin-right: 5px;
		}

		.panel-body.pb2 {
			padding: 0px;
		}

		.request {
			margin-top: 8px;
			background-color: #323447;
			color: white;
			border: 0;
		}

		.request:hover {
			background-color: #3a3a3a;
			color: white;
		}

		.panel2 {
			height: 800px;
			overflow: auto;
		}

		.attachment {
			font-size: 25px;
		}

		.attachment:hover {
			color: black;
			cursor: pointer;
		}

		.imgdiv {
			margin-top: 10px;
		}

		.gritter-danger,
		.gritter-success {
			margin-top: 35px;
		}

		.panel-body a {
			color: #3a3a3a;
		}

		.panel-body a:hover {
			color: #000000;
		}

		.panel-body .fa-chevron-down {
			font-size: 14px;
			color: #747373;
			cursor: pointer;
		}

		.panel-body .fa-chevron-down:hover {
			color: #1a1a1a;
		}

		.postMenuList {
			border: 1px solid #d2d2d2;
			width: 100px;
			height: 45px;
			padding: 8px;
			position: absolute;
			border-radius: 6px;
			margin-left: -84px;
			box-shadow: 5px 5px 5px #d2d2d2;
		}

		.postMenuList li a {
			font-size: 16px;
			color: #e0245e;
			padding: 0 4px;
			font-weight: 700;
		}

		.postMenuList li a:hover {
			cursor: pointer;
			color: #e0245e;
		}

		.postMenuList:hover {
			background-color: #f7e9ea;
		}

		#faTrash {
			margin-right: 5px;
			font-size: 22px;
		}

		#deleteModal .modal-body * {
			color: black;
		}

		#deleteModal .modal-content * {
			text-align: center;
		}

		.btnCancel,
		.btnDelete {
			width: 110px;
			height: 40px;
			border-radius: 20px;
			margin-bottom: 30px;
			border: 0;
			font-size: 16px;

		}

		.btnCancel {
			color: #000000;
			margin-right: 5px;
		}

		.btnDelete {
			color: #ffffff;
			background-color: #cc2055;
		}
	</style>

</head>

<body style="overflow:hidden;">

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
							<li><a href="" class="no-margin">Manage</a></li>
						</ul>
					</div>
				</div>
				<div class="main-menu">
					<ul>
						<li class="active">
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
			<div class="loader hidden">
				<img src="img/loading.gif" alt="loading...">
			</div>
			<div class="wrapper scrollable-div">
				<div id="breadcrumb">
					<ul class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="#"> Home</a></li>
						<li class="active">Dashboard</li>
					</ul>
				</div><!-- /breadcrumb-->
				<div class="main-header clearfix">
					<div class="page-title">
						<h3 class="no-margin">Dashboard</h3>
						<span>Welcome <?php echo $name; ?></span>
					</div><!-- /page-title -->
				</div>

				<div class="container">
					<div class="row">
						<div class="col-sm-8">
							<div class="search-options clearfix">
								<div class="input-group ">
									<textarea class="form-control status-input" name="status-input" id="status-input" placeholder="What would you like to share?" cols="150" rows="4"></textarea> <br />
								</div>
								<span>
									<button class="btn skin-7" type="button" id="btnpost">Post</button>
									<span><i class="fa fa-paperclip attachment" data-toggle="modal" data-target="#uploadModal" data-placement="bottom" title="upload a picture"></i></span>
									<span id="file_name"></span>
								</span>
								<div id="uploadModal" class="modal fade" role="dialog">
									<div class="modal-dialog">

										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Picture upload form</h4>
											</div>
											<div class="modal-body">
												<!-- Form -->
												<div id='preview'>
													<img src="" width='570' height='300' id="output_image">
												</div>
												<form method='post' action='' enctype="multipart/form-data">
													Select file : <input type='file' accept='image/*' onChange='preview_image(event)' name='file' id='file' class='form-control'><br>
													<input type='button' class='btn btn-info' value='Upload' id='upload'>

												</form>
											</div>

										</div>

									</div>
								</div>

							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-sm-7" id="statusviewer">
							<?php
							$query3 = "SELECT * FROM statuss a LEFT JOIN users b ON a.poster = b.matricno ORDER BY a.time DESC limit 15";
							$result3 = mysqli_query($conn, $query3);
							while ($rows = mysqli_fetch_array($result3)) {
								$name = $rows['fullname'];
								$dept = $rows['department'];
								$poster = $rows['poster'];
								$deptname = getdept($dept);
								$scentre = $rows['study_centre'];
								$scentre = getcentre($scentre);
								$content = $rows['text'];
								$time = $rows['time'];
								$time = timeCalculator($time);
								$picture = $rows['picture'];
								$sn = $rows['status_sn'];
								$count = countStatusComment($sn);
								$status_picture = $rows['status_picture'];
								$tocheck = "";
								if ($poster == $matricno) {
									$tocheck = "profile.php";
								} else {
									$tocheck = "profile2.php?tocheck=$poster";
								}


								$comments = "";
								if ($count == 0) {
									$comments = "<span id = 'comcount$sn'><span><i class = 'fa fa-comment-o fainteract' id = 'reply'></i>No comments yet</span></span>";
								} else if ($count == 1) {
									$comments = "<span id = 'comcount$sn'><span><i class = 'fa fa-comment fainteract' id = 'reply'></i> 1 comment</span></span>";
								} else {
									$comments = "<span id = 'comcount$sn'><span><i class = 'fa fa-comments fainteract' id = 'reply'></i>$count comments</span></span>";
								}

								echo "	<div class='panel panel-primary' id = 'posts'>
									<div class='panel-body'>";

								if ($poster == $matricno) {
									echo "
										<span class='pull-right'><i class='fa fa-chevron-down chevronSelect' id='chevronSelect$sn'></i></span>
										<div class='postMenu pull-right' id='postMenu$sn'>
											<ul class='list-unstyled postMenuList' id='postMenuList$sn'>
												<li><a data-toggle='modal' data-target='.delete-modal$sn' id='deleter'><i class='fa fa-trash-o'
															id='faTrash'></i>Delete</a></li>
											</ul></div>";
								}

								echo "<a href='$tocheck'><img src = '$picture' class = 'img-circle' height = '65px' width = '65px' id = 'userimg'>
								<span id = 'headername'>$name</span><br/>
								<span id = 'headerdept'>$deptname</span><br/>
								<span id = 'headerscentre'>$scentre</span><br/></a>";

								echo "<div id = 'content'>
										$content
									</div>";

								if ($status_picture != null || $status_picture != "") {
									echo "<div class='imgdiv'><img src='$status_picture' height='400' width='640'></div>";
								}


								echo "<div id = 'foot'>
										<span id='fttxt'><i class = 'fa fa-clock-o fainteract' style = 'margin-left:0px;'></i>$time</span>";
								$query4 = mysqli_query($conn, "select * from status_likes where storyid = '$sn' and liker = '$matricno'");
								$nolikes = countStatusLikes($sn);

								if (mysqli_num_rows($query4) == 1) {
									echo "<span id='fttxt$sn'><span><i class = 'fa fa-thumbs-up fainteract unlike' id = '$sn'></i>$nolikes</span></span>";
								} else {
									echo "<span id='fttxt$sn'><span><i class = 'fa fa-thumbs-o-up fainteract like' id = '$sn'></i>$nolikes</span></span>";
								}
								echo "<span id='fttxt'>$comments</span>
									</div>
								</div>
								<hr/>
								<div>
									<textarea cols = '100' rows = '1' class = 'comment' id = '$sn' placeholder = 'Enter your comment'></textarea>							
								</div>
								<hr/>
								<div id = 'commentdiv$sn'>";

								$query2 = "SELECT * FROM status_comments a LEFT JOIN users b ON a.commenter = b.matricno WHERE status = '$sn' ORDER BY a.time DESC LIMIT 4";
								$result2 = mysqli_query($conn, $query2);
								while ($row = mysqli_fetch_array($result2)) {
									$name = $row['fullname'];
									$picture = $row['picture'];
									$comment = $row['comment'];
									echo "
											<div id = 'comments'>
												<img src = '$picture' height = '35px' width = '35px' class = 'img-circle'><span class = 'comment-text'><span id = 'commenter-name'>$name </span> $comment</span>												
											</div>";
								}

								echo "</div>
								<span class='read_comments read_more$sn' id='$sn'>Read all comments</span>
								</div>

								<div class='modal delete-modal$sn' id='deleteModal' tabindex='-1' role='dialog'>
								<div class='modal-dialog modal-sm'>
									<div class='modal-content'>
										<div class='modal-body'>
											<h2>Delete Post?</h2>
											<h4>Do you want to delete this Post?</h4>
											<p>Note: This cannot be undone</p>
										</div>
										<div><button class='btnCancel' data-dismiss='modal'>Cancel</button>
											<button class='btnDelete' data-dismiss='modal' id='story$sn'>Delete</button></div>
									</div>
								</div>
							</div>";
							}
							?>
						</div>

						<div class="col-sm-6 col-md-4" id="recommender">
							<div class="panel panel-default panel2" id="last">
								<div class="panel-heading">
									Recommended Friends
								</div>
								<div class='panel-body pb2'>
									<ul class='list-group recommended_friends'>
										<?php
										$q2 = "SELECT * FROM users WHERE (department = '$stdept' AND LEVEL = '$stlevel') AND matricno != '$matricno' AND matricno NOT IN 
										(SELECT user2 FROM friends WHERE user1 = '$matricno' UNION SELECT user1 FROM friends WHERE user2 = '$matricno') 
										ORDER BY (study_centre = '$stscentre') DESC limit 30";
										$res2 = mysqli_query($conn, $q2) or die("query2 could not query database");

										if (mysqli_num_rows($res2) == 0) {
											echo "<ul class = 'list-group'>
										  <li class = 'list-group-item' id = 'empty'> No friends to recommend at this time.</li>'
										</ul>";
										} else {
											while ($rows2 = mysqli_fetch_array($res2)) {
												$picture2 = $rows2['picture'];
												$matricno2 = $rows2['matricno'];
												$name2 = $rows2['fullname'];
												$level2 = $rows2['level'];
												$scno2 = $rows2['study_centre'];
												$dept2 = $rows2['department'];
												$scname2 = getcentre($scno2);
												$deptname2 = getdept($dept2);

												echo "<li class = 'list-group-item' id = 'list1'>
										  <span class='pull-left mg-t-lg mg-r-lg'> <img src='$picture2' class='avatar avatar-md img-circle' alt=''></span>
										  <div class='show no-margin pd-t-lg' id = 'name1'>$name2 
										  <small class='pull-right'><button class='btn btn-default btn-sm request' id='$matricno2'>Send Request</button></small></div>
										  <small class='text-muted' id = 'sub1'>$scname2</small><br/>
										  <small class='text-muted' id = 'sub1'>$deptname2 [$level2]</small>
										</li>";
											}
										}
										?>
									</ul>
								</div>
							</div>
							<div class="panel panel-default panel2" id="last">
								<div class="panel-heading">
									Recommended Groups
								</div>
								<div class="panel-body pb2">
									<ul class="list-group">
										<li class='list-group-item' id='list1' style="color:#a93922; font-size:16px;"> Under Development...</li>
									</ul>
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
			<script src="js/ckeditor/ckeditor.js"></script>

			<!-- Popup Overlay -->
			<script src='js/jquery.popupoverlay.min.js'></script>
			<script src='js/jquery.gritter.min.js'></script>

			<!-- Cookie -->
			<script src='js/jquery.cookie.min.js'></script>

			<!-- Perfect -->
			<script src="js/app/app.js"></script>

			<script>
				var flag = 15;

				CKEDITOR.replace("status-input");
				CKEDITOR.config.width = "127%";
				var user = <?php echo json_encode($matricno) ?>;
				unreadMsg();
				unreadMsg2();

				$(document).on("keypress", ".comment", function(event) {
					var keyCode = event.which || event.keyCode;
					if (keyCode == 13) {
						var comment = $(this).val();
						var id = this.id;
						event.preventDefault();

						saveStatusComment(user, id, comment);
					}
				});

				window.addEventListener('load', function() {
					document.querySelector('.loader').remove();
				});

				$(".postMenu").hide();
				handleNotification();

				$(document).on("click", ".chevronSelect", function() {
					let chevId = this.id
					let sn = chevId.substr(chevId.length - 1);
					$("#postMenu" + sn).show();
					$("#chevronSelect" + sn).css("opacity", "0");
				});

				$(document).on('click', function(e) {
					if (e.target.id === '') {
						$(".postMenu").fadeOut();
						$(".chevronSelect").fadeTo(0, 1);
					}
				});

				$(document).on('click', '.btnDelete', function() {
					let storyid = this.id.substr(this.id.length - 1)
					$.ajax({
						url: "deleter.php",
						type: "POST",
						data: {
							storyid: storyid
						},
						success: function() {
							displayStatus();
							$.gritter.add({
								title: '<i class="fa fa-times-circle"></i> Success Message!',
								text: 'Your post has been deleted successfully.',
								sticky: false,
								time: '',
								class_name: 'gritter-success'
							});
						}
					});
				});

				//notification Handlers
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
					}, 30000);

					setTimeout(function() {
						$('.notf_count').html("");
					}, 5000);
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

				$(document).on("click", ".request", function() {
					var friend = this.id;
					$.ajax({
						url: "processFriends2.php",
						type: "POST",
						data: {
							user: user,
							friend: friend
						},
						success: function(data) {
							//alert(data);
							$(".recommended_friends").html(data);
						}
					});
				});

				$(document).ready(function() {
					$(document).on("click", "#upload", function() {
						var filename = $("#file").val();
						$("#uploadModal").modal("hide");
						$("#file_name").html(filename);
					});

				});

				$(document).on("click", ".read_comments", function() {
					var id = this.id;
					$.ajax({
						url: "sideAjaxRequest.php",
						type: "POST",
						data: {
							moreComments: id
						},
						success: function(data) {
							$("#commentdiv" + id).html(data);
							$(".read_more" + id).hide();
						}
					});
				});

				$(window).scroll(function() {
					if ($(window).scrollTop() >= $(document).height() - $(window).height()) {
						$.ajax({
							type: "GET",
							url: "load_status.php",
							data: {
								offset: flag,
								limit: 5
							},
							success: function(data) {
								$("#statusviewer").append(data);
								flag += 5;
							}
						});
						//alert("At bottom");
					}
				});

				$("#output_image").hide();

				function preview_image(event) {
					var reader = new FileReader();
					reader.onload = function() {
						var output = document.getElementById('output_image');
						output.src = reader.result;
					}
					reader.readAsDataURL(event.target.files[0]);
					$("#output_image").show();
				}

				$(document).on("click", "#btnpost", function() {
					var status = CKEDITOR.instances['status-input'].getData();
					if (status == "") {
						$.gritter.add({
							title: '<i class="fa fa-times-circle"></i> Empty Status Error!',
							text: 'You can not post a status without text.',
							sticky: false,
							time: '',
							class_name: 'gritter-danger'
						});
					} else {
						var fname = $("#file").val();
						if (fname == "") {
							saveStatus1(user, status);
						} else {
							setter = "yes";
							saveStatus2(user, status, fname);
						}
					}

				});

				function saveStatus1(user, status) {
					$.ajax({
						url: "processStatus.php",
						type: "post",
						data: {
							user: user,
							status: status
						},
						success: function() {
							CKEDITOR.instances['status-input'].setData("");
							displayStatus();
						}
					});
				}

				function saveStatus2(user, status, fname) {
					$.ajax({
						url: "processStatus.php",
						type: "post",
						data: {
							user: user,
							status: status,
							setter: setter
						},
						success: function() {
							saveStatusPix();
							CKEDITOR.instances['status-input'].setData("");
						}
					});
				}

				function saveStatusPix() {
					var fd = new FormData();
					var files = $('#file')[0].files[0];
					fd.append('file', files);
					fd.append('request', 1);

					$.ajax({
						url: "processStatusPix.php",
						type: "post",
						data: fd,
						contentType: false,
						processData: false,
						success: function(data) {
							$("#file").val("");
							$("#file_name").html("");
							$("#output_image").hide();
							displayStatus();
						}
					});
				}

				$(document).on("click", ".like", function() {
					var sn = $(this).attr('id');
					$.ajax({
						url: "like_unlike.php",
						type: "post",
						async: false,
						data: {
							liked: 1,
							statussn: sn,
							user: user
						},
						success: function(data) {
							$("#fttxt" + sn).html(data);
						}
					});
				});

				$(document).on("click", ".unlike", function() {
					var sn = $(this).attr('id');
					$.ajax({
						url: "like_unlike.php",
						type: "post",
						async: false,
						data: {
							unliked: 1,
							statussn: sn,
							user: user
						},
						success: function(data) {
							//alert(data);
							$("#fttxt" + sn).html(data);
						}
					});
				});

				function displayStatus() {
					$.ajax({
						url: "processStatus.php",
						type: "post",
						data: {
							call: 1,
							user: user
						},
						success: function(response) {
							$("#statusviewer").html(response);
							$(".postMenu").hide();
						}
					});
				}

				function saveStatusComment(user, id, comment) {
					$.ajax({
						url: "processStatusComment.php",
						type: "post",
						data: {
							user: user,
							id: id,
							comment: comment
						},
						success: function() {
							$(".comment").val("");
							displayStatusComment(id);
						}
					});
				}

				function displayStatusComment(id) {
					$.ajax({
						url: "processStatusComment.php",
						type: "post",
						dataType: "json",
						data: {
							id: id,
							call: 1
						},
						success: function(response) {
							$("#commentdiv" + id).html(response[1]);
							$("#comcount" + id).html(response[0]);
							$(".read_more" + id).show();
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
						success: function() {
							//console.log("cool");
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

				/*setInterval(function() {
					displayStatus();				
				}, 5000);*/
				//Updating problem
			</script>

</body>

</html>
<?php
	include("functions.php");
	$conn = db_connect();
	session_start();
?>
<html>
	<head>
		<title> Editor Login</title>
		<link rel="icon" href="../bn/img/noun2.jpg" sizes="32x32">
		<link href = "../bn/vendor/bootstrap/css/bootstrap.min.css" rel = "stylesheet">
		<link href="../bn/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href = "../bn/css/linkup.css" rel = "stylesheet">
		<script src="../js/jquery-1.10.2.min.js"></script>	
		
		<style>
			#formdiv {
				background-color: #f2f2f2;
				margin-top: 10%;
				box-shadow: 7px 13px 8px 10px #a9a9a9;
				border-radius:10px;
			}
			.login-form {
				margin:15px 25px;
			}
			body {
				background-color:#cccccc;
			}
			small, small a {
				color:#cbcbcb;
			}
			small a:hover {
				text-decoration:none;
				color:#cbcbcb;
			}
			label {
				font-weight:bold;
				font-size:12px;
			}
			#heading {
				font-family:monotype corsiva;
			}
			.forgot {
				color: black;
				font-family: monotype corsiva;	
			}
			.forgot:hover {
				text-decoration:none;
			}
			.btn-default {
				background-color:#3c3c3c;
				color: white;
				font-size:12px;
				text-transform:capitalize;
				height:40px;
				width:80px;
				border-radius:4px;
			}
			.required {
				color:#a3293c;
				font-size:15px;
			}
			input[type="checkbox"]{
				height:15px;
				width:15px;
				background-color:#f44;
				border-radius:10%;
			}
			#error {
                color:#ea4335;
				font-family:monotype corsiva;
            }
            span#error {
                margin-left:0px;
            }
			
		</style>
		
		

	</head>
	
	<body>
		<?php
			if(isset($_POST['submit'])) {
				$email = $_POST['email'];
				$password = $_POST['password'];
				
				if($email = "admin" && $password = "admin") {
					$_SESSION['editor'] = "admin";
					header("Location:editor_index.php");
				}
				else
					$error = "<span id = 'error'>This record does not exist</span>";
			}
		?>
		<div class="rotation">
			<div class="front-end">
			  <div class="form-content">
				<div class = "row">
					<div class = "col-md-4"></div>
					<div class = "col-md-4" id = "formdiv">
						<form class="form-box login-form" method = "post" action = "">
						  <h3 class="title">Sign In</h3>
						  <p id='heading'>If you have are an editor, please log in.</p>
						  
						  <div class="form-group">
							<label>Email Address <span class="required">*</span></label>
							<input class="form-control" type="text" name="email" required>
						  </div>
						  
						  <div class="form-group">
							<label>Password: <span class="required">*</span></label>
							<input class="form-control" type="password" name="password" required>
						  </div>
						  <?php
							if (isset($error)) {
								echo "<div class = 'form-group errorclass'>$error</div>";
							}
						  ?>
						  
						  <div class="form-group">
							<label class="checkbox">
							  <input type="checkbox" id = "checkbox"> Remember password
							</label>
						  </div>
						  
						  <div class="buttons-box clearfix">
							<input class="btn btn-default" type = "submit" name = "submit" value = "Login">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="switch-form forgot">Forgot Your Password?</a>
						  </div>
						</form>
					</div>
					<div class = "col-md-4"></div>
				</div>
			  </div>
			</div>
		</div>
	</body>
</html>
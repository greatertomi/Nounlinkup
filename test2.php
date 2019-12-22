<html>
	<head>
		<title>Good</title>
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
			.btn {
				margin-top:30%;
			}
		</style>
	</head>
	<body>
		<?php
			if(isset($_POST['submit'])) {
				$name = $_POST['gender'];
				echo $name;
			}
			
		?>
		<div class = "container">
			<button type = "button" class = "btn btn-primary" data-toggle = "modal" data-target = "#modal-1"> Activate the modal</button>
			<div class = "modal" id = "modal-1">
				<div class = "modal-dialog">
					<div class = "modal-content">
						<div class = "modal-header">
							<button class = "button" type = "close" data-dismiss = "modal">&times</button>
							<h3 class = "modal-title">This is a modal</h3>
						</div>
					</div>
				</div>	
			</div>
			<div>
				<form name="test" method="post">
					<input type="radio" name="genre" value="rock" checked="checked" /> Rock
					<input type="radio" name = "gender" value = "Male">Male<br/>
					<input type="radio" name = "gender" value = "Female">Female<br/>
					<input type="submit" name = "submit" value = "Submit">
				</form>
			</div>
		</div>
	</body>
</html>
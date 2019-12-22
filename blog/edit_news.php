<?php
	include("functions.php");
	$conn = db_connect();
	session_start();
	$authid = $_SESSION['authid'];
	$newsid = $_GET['id'];
		//echo "$headline  $subhead";

	$query1 = "select * from blog where id = '$newsid'";
	$result1 = mysqli_query($conn, $query1) or die ("Could not query database");

	while ($row = mysqli_fetch_array($result1)) {
		$headline = $row["headline"];
		$subhead = $row["sub_heading"];
		$body = $row["body"];
		$headpix = $row["headline_pix"];
		$bodypix = $row["body_pix"];
		$imgcaption = $row['image_caption'];
	}
?>
<html>
	<head>
		<title> Edit Story</title>
		<link rel="icon" href="../bn/img/noun2.jpg" sizes="32x32">
		<link href = "../bn/vendor/bootstrap/css/bootstrap.min.css" rel = "stylesheet">
		<link href="../bn/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="../css/font-awesome.min.css" rel="stylesheet">
		<link href = "../bn/css/linkup.css" rel = "stylesheet">
		<script src="../js/jquery-1.10.2.min.js"></script>	
		<script src = "../js/ckeditor/ckeditor.js"></script>
		<link href = "../css/mystyle.css" rel = "stylesheet">
		
		<style>
			h1 {
				font-size: 60px;
				font-weight:bold
			}
			.col-md-7 {
				border-right:solid 1px #A6A6A6;
			}	
			#submit {
				height:40px;
				font-size:20px;
				width:60%;
				background-color:#dd4c40;
				color:white;
				border:none;
				border-radius:5%;
				margin-left:20%;
				margin-top:5%;
				cursor:pointer;
			}
			.jumbotron {
				background-color:#d25d41;
				color:white;
			}
			.alert-success {
				position:absolute;
				width:38%;
				margin-top: 17%;
				right:0px;
			}
		</style>
	</head>
	
	<body>	
			<?php
				if(isset($_POST['submit'])) {
					$headline2 = $_POST['headline'];
					$subhead2 = $_POST['subhead'];
					$body2 = $_POST['content'];
					$imgcaption = $_POST['imgcaption'];
					if (($_FILES['headpix']['name'] == '') && ($_FILES['bodypix']['name'] == '')) {
						$query2 = "update blog set headline = '$headline2', sub_heading = '$subhead2', body = '$body2', date_edited = now(), image_caption = '$imgcaption' where id = '$newsid'";
					}
					else if ($_FILES['headpix']['name'] == '')	{
						$bodypix2 = upload_newspix('bodypix');
						$query2 = $query = "update blog set headline = '$headline2', sub_heading = '$subhead2', body = '$body2', date_edited = now(), image_caption = '$imgcaption', body_pix = '$bodypix2' where id = '$newsid'";
					}
					
					else if($_FILES['bodypix']['name'] == '') {
						$headpix2 = upload_newspix('headpix');
						$query2 = "update blog set headline = '$headline2', sub_heading = '$subhead2', body = '$body2', date_edited = now(), headline_pix = '$headpix2', image_caption = '$imgcaption' where id = '$newsid'";
					}
					else
					{
						$headpix2 = upload_newspix('headpix');
						$bodypix2 = upload_newspix('bodypix');
						$query2 = "update blog set headline = '$headline2', sub_heading = '$subhead2', body = '$body2', date_edited = now(), headline_pix = '$headpix2', body_pix = '$bodypix2', image_caption = '$imgcaption' where id = '$newsid'";
					}

					$result2 = mysqli_query($conn,$query2) or die("Could not update database ");

					if($result2) {
						echo "
							<div class='alert alert-success'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								News has been successfully edited. <a href='auth_index.php' class='alert-link'>Go to your dashboard</a>.
							</div>	
						";
					}

				}
			?>
			<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
			 <div class="container">
				<a class="navbar-brand js-scroll-trigger" href="#page-top">NOUN Linkup</a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
				  <ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="auth_index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="edit_news.php" id = "see">Add Story</a>
					</li>
					
				  </ul>
				</div>
			 </div>
		</nav>
		<div class='jumbotron'>
            <div class='container'> 
                <h1>NOUN LINKUP</h1>
             </div>
        </div>
  
		<div class="container">
			
			<div id = "reg_form">
				<h2><center><b>EDIT STORY</b><center></h2><br />
				<form action="" method="post" class="form-horizontal" id = "add_story" enctype="multipart/form-data" data-parsley-validate>
					<div class="row">
						<div class = "col-md-2"></div>
						<div class="col-md-9">
							<div class="form-group">
								<label for="headline" class="col-md-2 control-label">HeadLine</label>
								<div class="col-md-9">
									<input type="text" class="form-control" value = "<?php echo $headline ?>"  id="headline" name="headline" required>
								</div>
							</div>
							<div class="form-group">
								<label for="subhead" class="col-md-3 control-label">Sub-HeadLine</label>
								<div class="col-md-9">
									<input type="text" class="form-control" value = "<?php echo $subhead ?>"" id="subhead" name="subhead" required>
								</div>
							</div>
							<div class="form-group">
								<label for="body" class="col-md-2 control-label">Body</label>
								<div class="col-md-9">
									<textarea id="content" name="content" required><?php echo $body ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="body" class="col-md-2 control-label">Head Pix</label>
								<div class = "col-md-9">
									<img id="headpix" width="100%" height="300" src = "<?php echo $headpix ?>">
									<input type="file" accept="image/*" onchange="preview_image(event)" class="form-control" name="headpix" id="headpix" required>
								</div>
							</div>						
							<div class="form-group">
								<label for="body" class="col-md-2 control-label">Body Pix</label>
								<div class="col-md-9">
									<img id="bodypix" width="100%" height="300" src = "<?php echo $bodypix ?>">
									<input type="file" accept="image/*" onchange="preview_image2(event)" class="form-control" name="bodypix" id="bodypix" required>
								</div>
							</div>
							<div class="form-group">
								<label for="image_caption" class="col-md-2 control-label">Image Caption</label>
								<div class="col-md-9">
									<input type="text" class="form-control" value = "<?php echo $imgcaption ?>"  id="imgcaption" name="imgcaption" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-9">
									<input type = "submit" name = "submit" value = "SUBMIT" id = "submit">
								</div>
							</div>
							
							
						</div>	
						<div class = "col-md-1"></div>
					</div>
					
				</form>
			</div>
		</div>

		<script>
			CKEDITOR.replace("content");
			//CKEDITOR.config.width = "70%";
			//CKEDITOR.config.uiColor = "#078ad1";

			//$('.alert-success').delay(8000).fadeOut(2000);
			//$('.alert-danger').delay(8000).fadeOut(2000);
			
			function preview_image(event) 
			{
				var reader = new FileReader();
				reader.onload = function()
				{
					var output = document.getElementById('headpix');
					output.src = reader.result;
				}
				reader.readAsDataURL(event.target.files[0]);
			}
			
			function preview_image2(event) 
			{
				var reader = new FileReader();
				reader.onload = function()
				{
					var output = document.getElementById('bodypix');
					output.src = reader.result;
				}
				reader.readAsDataURL(event.target.files[0]);
			}
		</script>
		<script src="../bn/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="../bn/vendor/jquery-easing/jquery.easing.min.js"></script>
		<script src="../bn/vendor/scrollreveal/scrollreveal.min.js"></script>
		<script src="../bn/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="../bn/js/linkup.js"></script>
		<script src="../js/parsley.js"></script>
		
	</body>
</html>
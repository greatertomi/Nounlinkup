<?php
    include("functions.php");
    $conn = db_connect();
    session_start();
    $cstory = $_SESSION['cstory'];
	// file name
	$filename = $_FILES['file']['name'];
	
	// Location
	$location = 'uploads/statuss/'.$filename;

	// file extension
	$file_extension = pathinfo($location, PATHINFO_EXTENSION);
	$file_extension = strtolower($file_extension);

	// Valid image extensions
	$image_ext = array("jpg","png","jpeg","gif");

	$response = "";
	if(in_array($file_extension,$image_ext)){
		// Upload file
		if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
			$response = $location;
		}
	}
    
    $query = mysqli_query($conn,"update statuss set status_picture = '$response' where status_sn='$cstory'");
    unset($_SESSION['cstory']);
    
?>

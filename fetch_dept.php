<?php
	include ("functions.php");
	$conn = db_connect();
	
	if (isset($_POST['faculty'])) {
		$faculty = $_POST['faculty'];
		$query = mysqli_query($conn,"SELECT * FROM department WHERE facultyid = '$faculty'");
		while($row = mysqli_fetch_array($query)) {
			$deptid = $row['sn'];
			$dept = $row['dept'];
			echo "<option value='$deptid'>$dept</option>";
		}
	}
	else {
		echo "Something wrong";
	}

?>
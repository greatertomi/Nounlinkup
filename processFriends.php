<?php
include("functions.php");
$conn = db_connect();
session_start();

if (isset($_POST['friend'])) {
	$user = $_POST['user'];
	$friend = $_POST['friend'];

	$query = "insert into friends values ('','$user','$friend',now(),'1','','')";
	$result = mysqli_query($conn, $query) or die("could not insert in database");

	$query2 = "select * from users where matricno = '$user'";
	$result2 = mysqli_query($conn, $query2) or die("Could not connect to database");

	$row = mysqli_fetch_array($result2);
	$name = $row['fullname'];
	$picture = $row['picture'];
	$dept = $row['department'];
	$level = $row['level'];
	$study_centre = $row['study_centre'];
	$email = $row['email'];

	$query3 = "SELECT * FROM users WHERE (department = '$dept' OR study_centre = '$study_centre' OR LEVEL = '$level') 
		AND matricno != '$user' AND matricno NOT IN (SELECT user2 FROM friends WHERE user1 = '$user' UNION 
		SELECT user1 FROM friends WHERE user2 = '$user') limit 30";

	$result3 = mysqli_query($conn, $query3);

	// Notification Block
	if ($result3) {
		$message = "new friend request";
		$query4 = "insert into notifications values ('','1','$friend','$user','','$message',now(),'0')";
		$result2 = mysqli_query($conn, $query4);
	}

	if (mysqli_num_rows($result3) == 0) {
		echo "
				<li class = 'list-group-item' id = 'empty'> LIST EMPTY </li>";
	} else {
		while ($rows1 = mysqli_fetch_array($result3)) {
			$picture1 = $rows1['picture'];
			$matricno1 = $rows1['matricno'];
			$name1 = $rows1['fullname'];
			$level1 = $rows1['level'];
			$scno1 = $rows1['study_centre'];
			$dept1 = $rows1['department'];
			$scname1 = getcentre($scno1);
			$deptname1 = getdept($dept1);
			$tocheck = "profile2.php?tocheck=$matricno1";

			echo "<li class = 'list-group-item' id = 'list1'>
						<a href='$tocheck'><span class='pull-left mg-t-lg mg-r-lg'> <img src='$picture1' class='avatar avatar-lg img-circle' alt=''></span>
						<div class='show no-margin pd-t-lg' id = 'name1'>$name1 </a>
						<small class='pull-right'><button class='btn btn-primary btn-sm addFriend' id='$matricno1'>Send Request</button></small></div>
						<a href='$tocheck'><small class='text-muted' id = 'sub1'>$scname1</small><br/>
						<small class='text-muted' id = 'sub1'>$deptname1 [$level1]</small></a>
					</li>";
		}
	}
}

if (isset($_POST['currentFriend'])) {
	$user = $_POST['user'];
	$friend = $_POST['currentFriend'];

	$query = "insert into friends values ('','$user','$friend',now(),'1','','')";
	$result = mysqli_query($conn, $query) or die("could not insert in database");

	if ($result) {
		echo "<span id='requestSentLbl'>Request Sent</span>";
	}
}

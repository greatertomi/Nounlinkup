<?php
	include ("functions.php");
	$conn = db_connect();
	
	if(isset($_POST['friend'])) {
		$user = $_POST['user'];
		$friend = $_POST['friend'];
		$dept = ""; $level = "";
		$query = mysqli_query($conn,"insert into friends values ('','$user','$friend',now(),'1','','')") or die ("could not insert in database");
		
		//Notification Block
		if ($query) {
			$message = "new friend request";
			$query2 = "insert into notifications values ('','1','$friend','$user','','$message',now(),'0')";
			$result4 = mysqli_query($conn, $query2);
		}
		
		$q1 = mysqli_query($conn,"select * from users where matricno = '$user'");
		while($row = mysqli_fetch_array($q1)) {
			$stdept = $row['department'];
			$stlevel = $row['level'];
			$stscentre = $row['study_centre'];
		}

		$q2 = "SELECT * FROM users WHERE (department = '$stdept' AND LEVEL = '$stlevel') AND matricno != '$user' AND matricno NOT IN 
			(SELECT user2 FROM friends WHERE user1 = '$user' UNION SELECT user1 FROM friends WHERE user2 = '$user')
			ORDER BY (study_centre = '$stscentre') DESC limit 30";
		$res2 = mysqli_query($conn,$q2) or die("query2 could not query database");				
		
		if(mysqli_num_rows($res2) == 0 ) {
			echo "<ul class = 'list-group'>
				<li class = 'list-group-item' id = 'empty'> No friends to recommend at this time.</li>'
			</ul>";
		}
		else {
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
	}
	
?>
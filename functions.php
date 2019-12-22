<?php

function db_connect()
{
	$conn = mysqli_connect("localhost", "root", "", "linkup")
		or die("Could not connect to database" . mysqli_connect_error());

	return $conn;
}

function upload_pix($matricno)
{
	$tmp = $_FILES['picture']['tmp_name'];
	$name = $_FILES['picture']['name'];

	$fileExt = explode('.', $name);
	$fileActualExt = strtolower(end($fileExt));
	$editedMatricNo = preg_replace("/[^a-zA-Z0-9]/", "", $matricno);
	$newName = $editedMatricNo . '.' . $fileActualExt;
	$target = "uploads/profile/" . $newName;

	if (!move_uploaded_file($tmp, $target)) {
		echo "Could not put file in destination folder";
	} else
		return $target;
}

function upload_newspix($name)
{
	$tmp = $_FILES[$name]['tmp_name'];
	$name = $_FILES[$name]['name'];
	$target = "uploads/newsfile/" . $name;

	if (!move_uploaded_file($tmp, $target)) {
		echo "Could not put file in destination folder";
	} else
		return $target;
}

function upload_grouppix($name, $groupname)
{
	$tmp = $_FILES[$name]['tmp_name'];
	$filename = $_FILES[$name]['name'];
	$target = "uploads/grouppix/" . $name;

	$fileExt = explode('.', $filename);
	$fileActualExt = strtolower(end($fileExt));
	$newName = $groupname . '.' . $fileActualExt;
	$target = "uploads/grouppix/" . $newName;

	if (!move_uploaded_file($tmp, $target)) {
		echo "Could not put picture in destination folder";
	} else
		return $target;
}

function upload_statuspix($name)
{
	$filename = $_FILES[$name]['name'];

	// Location
	$location = 'uploads/statuss' . $filename;

	// file extension
	$file_extension = pathinfo($location, PATHINFO_EXTENSION);
	$file_extension = strtolower($file_extension);

	// Valid image extensions
	$image_ext = array("jpg", "png", "jpeg", "gif");

	$response = 0;
	if (in_array($file_extension, $image_ext)) {
		// Upload file
		if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
			$response = $location;
		} else {
			$response = "Could not upload picture";
		}
	}

	echo $response;
}

function getcentre($sn)
{
	$conn = db_connect();
	$query = "select * from study_centre where sn = '$sn'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$centre = $row['name'];
	return $centre;
}

function getdept($sn)
{
	$conn = db_connect();
	$query = "select * from department where sn = '$sn'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$dept = $row['dept'];
	return $dept;
}

function getfaculty($sn)
{
	$conn = db_connect();
	$query = "select distinct(faculty) from department where facultyid = '$sn'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$faculty = $row['faculty'];
	return $faculty;
}

function getname($matricno)
{
	$conn = db_connect();
	$query = mysqli_query($conn, "select fullname from users where matricno = '$matricno'") or die("Problems querying database");
	$row = mysqli_fetch_array($query);
	$name = $row['fullname'];

	return $name;
}

function getGroupName($groupid)
{
	$conn = db_connect();
	$query = mysqli_query($conn, "SELECT groupname FROM groups WHERE groupid = '$groupid' ") or die("Problems querying database");
	$row = mysqli_fetch_array($query);
	$name = $row['groupname'];

	return $name;
}

function countFriends($matricno)
{
	$conn = db_connect();
	$query = mysqli_query($conn, "SELECT * FROM friends WHERE (user1 = '$matricno' OR user2 = '$matricno') AND status = 2") or die("Problems querying database");
	$count = mysqli_num_rows($query);

	return $count;
}

function countGroups($matricno)
{
	$conn = db_connect();
	$query = mysqli_query($conn, "SELECT * FROM group_members WHERE member = '$matricno' AND statuss = '1'") or die("Problems querying database");
	$count = mysqli_num_rows($query);

	return $count;
}

function countGroupMembers($groupid)
{
	$conn = db_connect();
	$query = mysqli_query($conn, "SELECT * FROM group_members WHERE groupid = '$groupid' AND statuss = '1'") or die("Problems querying database");
	$count = mysqli_num_rows($query);

	return $count;
}

function GroupList($matricno)
{
	$conn = db_connect();
	$query2 = "SELECT * FROM groups a LEFT JOIN group_members b ON a.groupid = b.groupid WHERE member = '$matricno' AND statuss = '1'";
	$result2 = mysqli_query($conn, $query2) or die("Could not query database");

	return $result2;
}

function countGroupMessages($groupid)
{
	$conn = db_connect();
	$query = mysqli_query($conn, "SELECT DISTINCT content FROM group_messages WHERE ingroup = '$groupid'") or die("Problems querying database");
	$count = mysqli_num_rows($query);

	return $count;
}

function getGroupCreator($groupid)
{
	$conn = db_connect();
	$query = mysqli_query($conn, "select creator from groups where groupid = '$groupid'") or die("Could not query database");
	$row = mysqli_fetch_array($query);
	$creator = $row['creator'];

	return $creator;
}

function fetchMessages($sender, $recipient)
{
	$conn = db_connect();
	$query = "SELECT u.matricno,u.fullname,u.picture,m.content,m.date,m.sender,m.recipient FROM messages m 
				JOIN users u ON u.matricno = m.sender 
				WHERE (m.sender = '$sender' AND m.recipient = '$recipient')
				OR (m.sender = '$recipient' AND m.recipient = '$sender')
				ORDER BY m.date DESC";
	$result = mysqli_query($conn, $query);

	return $result;
}

function fetchGroupMessages($groupid, $recipient)
{
	$conn = db_connect();
	$query = "SELECT * FROM group_messages a LEFT JOIN users b ON a.poster = b.matricno WHERE ingroup = '$groupid' and recipient = '$recipient' ORDER BY dateposted DESC";
	$result = mysqli_query($conn, $query);

	return $result;
}

function totalUnreadMsg($matricno)
{
	$conn = db_connect();
	$query = "SELECT * FROM messages WHERE recipient = '$matricno' AND  mread = 0";
	$result = mysqli_query($conn, $query);

	$count = mysqli_num_rows($result);
	return $count;
}

function totalUnreadGroupMsg($user)
{
	$conn = db_connect();
	$query = "SELECT * FROM group_messages WHERE recipient = '$user' AND mread = '0'";
	$result = mysqli_query($conn, $query);

	$count = mysqli_num_rows($result);
	return $count;
}

function lastMessage($sender, $recipient)
{
	$conn = db_connect();
	$query = "SELECT m.content,m.date,m.mread,m.sender FROM messages m 
		JOIN users u ON u.matricno = m.sender 
		WHERE (m.sender = '$sender' AND m.recipient = '$recipient')
		OR (m.sender = '$recipient' AND m.recipient = '$sender')
		ORDER BY m.mread ASC, m.date DESC, FIELD (sender, '$sender') ASC LIMIT 1";
	$result = mysqli_query($conn, $query);

	return $result;
}

function lastGroupMessage($group, $recipient)
{
	$conn = db_connect();
	$query = "SELECT * FROM group_messages WHERE ingroup = '$group' AND recipient = '$recipient' ORDER BY dateposted DESC limit 1";
	$result = mysqli_query($conn, $query);

	return $result;
}

function countUnreadMessages($sender, $recipient)
{
	$conn = db_connect();
	$query = "SELECT * FROM messages m 
				JOIN users u ON u.matricno = m.sender 
				WHERE ((m.sender = '$sender' AND m.recipient = '$recipient')
				OR (m.sender = '$recipient' AND m.recipient = '$sender')) and m.mread = 0 and m.sender != '$sender'";
	$result = mysqli_query($conn, $query);
	$count = mysqli_num_rows($result);

	return $count;
}

function countUnreadGroupMessages($group, $recipient)
{
	$conn = db_connect();
	$query = "SELECT * FROM group_messages WHERE ingroup = '$group' AND recipient = '$recipient' AND mread = '0'";
	$result = mysqli_query($conn, $query);
	$count = mysqli_num_rows($result);

	return $count;
}

function countStatusComment($status)
{
	$conn = db_connect();
	$query = "SELECT * FROM status_comments a LEFT JOIN users b ON a.commenter = b.matricno WHERE STATUS = '$status' ORDER BY a.time DESC ";
	$result = mysqli_query($conn, $query);
	$count = mysqli_num_rows($result);


	return $count;
}

function countStatusLikes($status)
{
	$conn = db_connect();
	$query = mysqli_query($conn, "SELECT * FROM status_likes WHERE storyid = '$status'");
	$count = mysqli_num_rows($query);
	$result = "";

	if ($count == 0)
		$result = "No likes";
	else if ($count == 1)
		$result = "1 Like";
	else
		$result = $count . " likes";

	return $result;
}

function lastactivity($matricno)
{
	$conn = db_connect();
	$query = "SELECT * FROM login_details WHERE matricno = '$matricno' ORDER BY last_activity DESC LIMIT 1";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	$last_activity = $row['last_activity'];
	return $last_activity;
}

function isFriend($user1, $user2)
{
	$conn = db_connect();
	$query = "SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends 
						WHERE user1 = '$user1' AND STATUS = '2' UNION SELECT user1 FROM friends 
						WHERE user2 = '$user1' AND STATUS = '2')";
	$result = mysqli_query($conn, $query);
	$isFriend = false;
	while ($rows = mysqli_fetch_array($result)) {
		$matricno = $rows['matricno'];
		if ($user2 == $matricno) {
			$isFriend = true;
		}
	}
	return $isFriend;
}

function checkFriendStatus($user1, $user2)
{
	$conn = db_connect();
	$query = "SELECT * FROM friends WHERE (user1 = '$user1' AND user2 = '$user2')
					OR (user2 = '$user1' AND user1 = '$user2')";
	$result = mysqli_query($conn, $query);
	$status = "";
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
		$friendStatus = $row['status'];
		if ($friendStatus == 1) {
			$status = 1;
		} else if ($friendStatus == 2) {
			$status = 2;
		} else {
			$status = 3;
		}
	} else {
		$status = 0;
	}

	return $status;
}

function countNotification($matricno)
{
	$conn = db_connect();
	$query = "SELECT notf_type, COUNT(*) AS occurrence, message, MAX(date_log) AS date_log, case_point 
      FROM notifications WHERE notify = '$matricno' AND mread = 0 GROUP BY notf_type";
	$result = mysqli_query($conn, $query);
	$count = 0;

	while ($rows = mysqli_fetch_array($result)) {
		$notf_type = $rows['notf_type'];

		if ($notf_type == 4 || $notf_type == 6 || $notf_type == 7) {
			$ntype = $notf_type;

			$query2 = "SELECT notf_type, COUNT(*) AS occurrence, message, MAX(date_log),case_point
					FROM notifications WHERE notf_type='$ntype' AND notify='$matricno' and mread = 0 GROUP BY case_point";
			$result2 = mysqli_query($conn, $query2);
			$numrows = mysqli_num_rows($result2);
			$count += $numrows;
		} else {
			$count += 1;
		}
	}
	return $count;
}

function timeCalculator($time)
{
	date_default_timezone_set('Africa/Lagos');
	$date1 = strtotime($time);
	$date2 = strtotime(date('Y-m-d H:i:s'));
	$diff = $date2 - $date1;

	$time = round(abs($diff) / 60, 0);

	if ($time < 60) {
		if ($time <= 1)
			$final = "Just now";

		else
			$final = $time . " mins ago";

		return $final;
	} else if ($time >= 60 && $time < 1440) {
		$time = round(abs($time) / 60, 0);
		if ($time <= 1) {
			$final = $time . " hour ago";
		} else {
			$final = $time . " hours ago";
		}
		return $final;
	} else if ($time >= 1440 && $time < 44640) {
		$time = round(abs($time) / 1440, 0);
		if ($time <= 1) {
			$final = $time . " day ago";
		} else {
			$final = $time . " days ago";
		}
		return $final;
	} else if ($time >= 44640  && $time < 535680) {
		$time = round(abs($time) / 44640, 0);
		if ($time <= 1) {
			$final = $time . " month ago";
		} else {
			$final = $time . " months ago";
		}
		return $final;
	} else if ($time >= 535680) {
		$time = round(abs($time) / 535680, 0);
		if ($time <= 1) {
			$final = $time . " year ago";
		} else {
			$final = $time . " years ago";
		}
		return $final;
	} else {
		$final = "date too large";
		return $final;
	}
}

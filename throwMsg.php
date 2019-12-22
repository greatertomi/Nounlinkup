<?php
	include("functions.php");
	session_start();
	$matricno = $_SESSION['matricno'];

	$conn = db_connect();
	if(isset($_POST['save1'])) {
		$msg = addslashes($_POST['post']);
		$user = $_POST['user'];
		$guest = $_POST['guest'];
		date_default_timezone_set('Africa/Lagos');
		$time = date('Y-m-d H:i:s');
		mysqli_query($conn, "insert into messages values ('','$user', '$guest', '$msg','$time','0')");
	}

	if(isset($_POST['save2'])) {
		$msg = addslashes($_POST['post']);
		$user = $_POST['user'];
		$group = $_POST['group'];
		mysqli_query($conn, "insert into group_messages values ('','$user', '$user','$group', '$msg',now(),'1')");

		$query = mysqli_query($conn, "SELECT member FROM group_members WHERE groupid = '$group' AND member != '$user' and statuss = '1'");
		while($row = mysqli_fetch_array($query)) {
			$recp = $row['member'];
			mysqli_query($conn, "insert into group_messages values ('','$user', '$recp','$group', '$msg',now(),'0')");
		}
	}
	
	if(isset($_POST['res'])){
		$user = $_POST['user'];
		$guest = $_POST['guest'];
		$query = fetchMessages($user,$guest);
		
		while($row=mysqli_fetch_array($query)){
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
			}      

			else {
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
		
	}

	if(isset($_POST['gres'])){
		$group = $_POST['group'];
		$user = $_POST['user'];
		$query = fetchGroupMessages($group,$user);
		
		while($row = mysqli_fetch_array($query)){
			$name = $row['fullname'];
			$time = $row['dateposted'];
			$time = timeCalculator($time);
			$content = $row['content'];
			$picture = $row['picture'];
			$poster = $row['poster'];
      
			if ($poster == $user) {
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
			}      

			else {
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
		
	}

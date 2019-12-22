<?php
	include("functions.php");

	if(isset($_POST['res'])){
		$matricno = $_POST['user'];
		$guest = $_POST['guest'];
		$query = fetchMessages($matricno,$guest);
		
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
						<div class='chat-body clearfix'>
							<div class='header'>
								<strong class='primary-font'>$name</strong>
								<small class='pull-right text-muted'><i class='fa fa-clock-o'></i> $time</small>
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
						<div class='chat-body clearfix'>
							<div class='header'>
								<strong class='primary-font'>$name</strong>
								<small class='pull-right text-muted'><i class='fa fa-clock-o'></i> $time</small>
							</div>
							<p>
								$content 
							</p>
						</div>
					</li>";
			}
		}
	}
?>
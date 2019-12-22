<?php
	include("functions.php");
	//timeCalculator();
	
	if(isset($_POST['method']) === true && empty($_POST['method']) === false) {
		$method = trim($_POST['method']);
		$user = $_POST['user'];
		$guest = $_POST['guest'];
		
		if($method === 'fetch') {
			$messages = fetchMessages($user, $guest);
			
			while ($row = mysqli_fetch_array($messages)) {
				$matric = $row['matricno'];
				$name = $row['fullname'];
				$time = $row['date'];
				$time = timeCalculator($time);
				$content = $row['content'];
				$picture = $row['picture'];
			}
		}
		
	}
	
	
	/**/
?>
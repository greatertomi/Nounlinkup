<?php
    include("functions.php");
    $conn = db_connect();
    
    if(isset($_POST['chat1'])) {
		$user = $_POST['user'];
        $query1 = "SELECT * FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' AND status = '2'  UNION SELECT user1 FROM friends WHERE user2 = '$user' AND status = '2')";
        $result1 = mysqli_query($conn,$query1);
        $count = mysqli_num_rows($result1);
        $array = array();
        $array[0] = $count;
        $totalmsg = 0;

        $i = 1;
        while ($rows = mysqli_fetch_array($result1)) {
            $guest = $rows['matricno']; 
            $unreadmsg = countUnreadMessages($user, $guest);
            if($unreadmsg == 0) {
                $unreadmsg1 = "";
            }
            else {
                $unreadmsg1 = "<small class = 'badge badge-danger'>".$unreadmsg."</small>";
            }
            $array[$i] = $unreadmsg1;
            ++$i;
        }
			
		echo json_encode($array);
    }

    if(isset($_POST['chat2'])) {
		$user = $_POST['user'];
        $query = "SELECT * FROM groups a LEFT JOIN group_members b ON a.groupid = b.groupid WHERE member = '$user'";
        $result = mysqli_query($conn,$query);
        $count = mysqli_num_rows($result);
        $array = array();
        $array[0] = $count;
        $totalmsg = 0;

        $i = 1;
        while ($rows = mysqli_fetch_array($result)) {
            $groupid = $rows['groupid']; 
            $unreadmsg = countUnreadGroupMessages($groupid, $user);
            if($unreadmsg == 0) {
                $unreadmsg1 = "";
            }
            else {
                $unreadmsg1 = "<small class = 'badge badge-danger'>".$unreadmsg."</small>";
            }
            $array[$i] = $unreadmsg1;
            ++$i;
        }
			
		echo json_encode($array);
    }
?>
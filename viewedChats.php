<?php
    include("functions.php");
    $conn = db_connect();
	
    if(isset($_POST['view']) != '') {
		$user = $_POST['user'];
        $guest = $_POST['guest'];
        $query1 = "update messages set mread = 1 where recipient = '$user' and sender = '$guest' and mread = 0";
        $result1 = mysqli_query($conn,$query1);
        $count = mysqli_num_rows($result1);
        if($count != 0) {
            $array = array();
            $array[0] = $count;
            $i = 1;
            while ($rows = mysqli_fetch_array($result1)) {
                $guest = $rows['matricno']; 
                $unreadmsg = countUnreadMessages($user, $guest);
                $array[$i] = $unreadmsg;
                ++$i;
            }
                
            echo json_encode($array);
        }
    }

    if(isset($_POST['view2']) != '') {
		$user = $_POST['user'];
        $group = $_POST['group'];
        $query = "UPDATE group_messages SET mread = '1' WHERE recipient = '$user' AND ingroup = '$group' AND mread = '0'";
        $result = mysqli_query($conn,$query);
        $count = mysqli_num_rows($result);
        if($count != 0) {
            $array = array();
            $array[0] = $count;
            $i = 1;
            while ($rows = mysqli_fetch_array($result)) {
                $group = $rows['ingroup']; 
                $unreadmsg = countUnreadGroupMessages($group, $user);
                $array[$i] = $unreadmsg;
                ++$i;
            }
                
            echo json_encode($array);
        }
    }
?>
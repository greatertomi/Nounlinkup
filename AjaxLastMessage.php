<?php
include("functions.php");
$conn = db_connect();

if (isset($_POST['lastMsg1'])) {
    $user = $_POST['user'];
    $query = "SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' AND status = '2'  UNION SELECT user1 FROM friends WHERE user2 = '$user' AND status = '2')";
    $result = mysqli_query($conn, $query);
    $array = array();
    $msg2 = "";
    $time = "";
    $counter = mysqli_num_rows($result);
    $array[0] = $counter * 2;
    $count = 1;

    while ($row = mysqli_fetch_array($result)) {
        $guest = $row['matricno'];
        $lastmessage = lastMessage($user, $guest);
        while ($row = mysqli_fetch_array($lastmessage)) {
            $msg = $row['content'];
            $time = $row['date'];
            $time = timeCalculator($time);
            $sender = $row['sender'];
            $msg2 = "";

            if ($sender == $user) {
                $msg2 = "<i class='fa fa-check text-success'></i> $msg";
            } else {
                $msg2 = "<i class='fa fa-reply'></i> $msg";
            }
        }
        $array[$count] = $msg2;
        $array[$count + 1] = $time;
        $count += 2;
    }

    echo json_encode($array);
}

if (isset($_POST['lastMsg2'])) {
    $user = $_POST['user'];
    $query = "SELECT * FROM groups a LEFT JOIN group_members b ON a.groupid = b.groupid WHERE member = '$user'";
    $result = mysqli_query($conn, $query);
    $array = array();
    $msg2 = "";
    $time = "";
    $counter = mysqli_num_rows($result);
    $array[0] = $counter * 2;
    $count = 1;

    while ($row = mysqli_fetch_array($result)) {
        $group = $row['groupid'];
        $lastmessage = lastGroupMessage($group, $user);
        while ($row = mysqli_fetch_array($lastmessage)) {
            $msg = $row['content'];
            $time = $row['dateposted'];
            $time = timeCalculator($time);
            $poster = $row['poster'];
            $msg2 = "";

            if ($poster == $user) {
                $msg2 = "<i class='fa fa-check text-success'></i> $msg";
            } else {
                $msg2 = "<i class='fa fa-reply'></i> $msg";
            }
        }
        $array[$count] = $msg2;
        $array[$count + 1] = $time;
        $count += 2;
    }

    echo json_encode($array);
}

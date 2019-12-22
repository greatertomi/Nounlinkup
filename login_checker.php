<?php
include("functions.php");
$conn = db_connect();

date_default_timezone_set('Africa/Lagos');
$currenttime = date("Y-m-d H:i:s");
$currenttime = date("Y-m-d H:i:s", strtotime($currenttime) - 10);

if (isset($_POST['user'])) {
  $user = $_POST['user'];

  $query = "SELECT * FROM users WHERE matricno IN (SELECT user2 FROM friends 
        WHERE user1 = '$user' AND status = '2'  UNION SELECT user1 FROM friends 
        WHERE user2 = '$user' AND status = '2')";
  $result = mysqli_query($conn, $query) or die("Could not pull out the list of friends");
  $friend_status = array();
  $total = mysqli_num_rows($result);
  $friend_status[0] = $total * 2;
  $count = 1;

  while ($rows = mysqli_fetch_array($result)) {
    $matricno = $rows['matricno'];
    $lastactivity = lastactivity($matricno);
    $status = "";

    if ($lastactivity > $currenttime) {
      $status = "<i class = 'fa fa-circle'></i>";
    } else {
      $status = "";
    }
    $friend_status[$count] = $count;
    $friend_status[$count + 1] = $status;
    $count += 2;
  }
  echo json_encode($friend_status);
}

if (isset($_POST['currentFriend'])) {
  $currentFriend = $_POST['currentFriend'];
  $lastactivity = lastactivity($currentFriend);
  $status = "";

  if ($lastactivity > $currenttime) {
    $status = "<span style='color:#129f59'>Currently Online</span>";
  } else {
    $lastseen = timeCalculator($lastactivity);
    $status = "
      <p>Currently Offline</p>
      <small class='block text-muted'>
        Last seen: $lastseen
      </small>";
  }

  echo $status;
}

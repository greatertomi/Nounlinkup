<?php
include("functions.php");
$conn = db_connect();

if (isset($_POST['gmember'])) {
  $gmember = $_POST['gmember'];
  $groupid = $_POST['groupid'];

  $query = mysqli_query($conn, "update group_members set statuss = '1' where groupid='$groupid' and member= '$gmember'");
  //Notification Block
  if ($query) {
    $message = "request to join group approved";
    $query3 = "insert into notifications values ('','5','$gmember','$groupid','','$message',now(),'0')";
    $result3 = mysqli_query($conn, $query3);
  }

  $query2 = "SELECT * FROM users WHERE matricno IN (SELECT member FROM group_members WHERE groupid = '$groupid' AND statuss = '2')";
  $result2 = mysqli_query($conn, $query2);
  while ($row = mysqli_fetch_array($result2)) {
    $sn = $row['sn'];
    $fullname = $row['fullname'];
    $matricno = $row['matricno'];
    echo "
      <li class = 'list-group-item'><a href='profile2.php?tocheck=$matricno' id = 'name'>$fullname</a>
          <button class = 'btn btn-xs btn-primary pull-right btnapprove' id = '$matricno'>approve</button>
      </li>";
  }
}

if (isset($_POST['user'])) {
  $user = $_POST['user'];
  $groupid = $_POST['groupid'];
  $output = "";

  $query = mysqli_query($conn, "UPDATE group_members SET statuss = '1' WHERE member = '$user' AND groupid='$groupid'");
  $query4 = "SELECT * FROM groups WHERE groupid IN (SELECT groupid FROM group_members WHERE member = '$user' AND statuss = '3')";
  $result4 = mysqli_query($conn, $query4);
  while ($row = mysqli_fetch_array($result4)) {
    $groupid = $row['groupid'];
    $groupname = $row['groupname'];
    echo "
        <li class = 'list-group-item'><a href='GroupProfile2.php?tocheck=$groupid' id = 'name'>$groupname</a>
            <button class = 'btn btn-xs btn-primary pull-right btnaccept' id = '$groupid'>accept</button>
        </li>";
  }
}

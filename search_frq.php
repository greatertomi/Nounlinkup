<?php
include("functions.php");
$conn = db_connect();

if (isset($_POST['user'])) {
  $user1 = $_POST['user'];
  $user2 = $_POST['name'];
  $query = "insert into friends values ('','$user1','$user2',now(),'1','','')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  //Notification Block
  if ($result) {
    $message = "new friend request";
    $query2 = "insert into notifications values ('','1','$user2','$user1','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
} else if (isset($_POST['person'])) {
  $user = $_POST['person'];
  $groupid = $_POST['groupid'];
  $query = "insert into group_members values ('','$groupid','$user',now(),'2')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  //Notification Block
  if ($result) {
    $query2 = "select creator from groups where groupid = '$groupid'";
    $result2 = mysqli_query($conn, $query2);
    $row = mysqli_fetch_array($result2);
    $gcreator = $row['creator'];

    $message = "new request to join your group";
    $query3 = "insert into notifications values ('','4','$gcreator','$groupid','','$message',now(),'0')";
    $result3 = mysqli_query($conn, $query3);
  }
}

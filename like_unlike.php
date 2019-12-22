<?php
include("functions.php");
$conn = db_connect();

if (isset($_POST['liked'])) {
  $statussn = $_POST['statussn'];
  $user = $_POST['user'];
  $query = mysqli_query($conn, "insert into status_likes values ('','$statussn','$user')");
  $nolikes = countStatusLikes($statussn);
  echo "<span><i class = 'fa fa-thumbs-up fainteract unlike' id = '$statussn'></i>$nolikes</span>";

  //Notification Block
  if ($query) {
    $query2 = "select poster from statuss where status_sn='$statussn'";
    $result2 = mysqli_query($conn, $query2);
    $row = mysqli_fetch_array($result2);
    $poster = $row['poster'];

    if ($poster != $user) {
      $message = "new like on post";
      $query3 = "insert into notifications values ('','6','$poster','$statussn','$user','$message',now(),'0')";
      $result3 = mysqli_query($conn, $query3);
    }
  }
} else if (isset($_POST['unliked'])) {
  $statussn = $_POST['statussn'];
  $user = $_POST['user'];
  $query = mysqli_query($conn, "delete from status_likes where storyid = '$statussn' and liker = '$user'");
  $nolikes = countStatusLikes($statussn);
  echo "<span><i class = 'fa fa-thumbs-o-up fainteract like' id = '$statussn'></i>$nolikes</span>";

  if ($query) {
    $query2 = "select poster from statuss where status_sn='$statussn'";
    $result2 = mysqli_query($conn, $query2);
    $row = mysqli_fetch_array($result2);
    $poster = $row['poster'];

    if ($poster != $user) {
      $message = "new like on post";
      $query3 = "delete from notifications where notf_type = '6' and case_point = '$statussn' and person_point = '$user'";
      $result3 = mysqli_query($conn, $query3);
    }
  }
}

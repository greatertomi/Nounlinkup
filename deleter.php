<?php
include("functions.php");
$conn = db_connect();

if (isset($_POST['storyid'])) {
  $storyid = $_POST['storyid'];
  $query = mysqli_query($conn, "select * from statuss where status_sn = '$storyid'");
  $row = mysqli_fetch_array($query);
  $pix = $row['status_picture'];
  $query2 = mysqli_query($conn, "DELETE FROM statuss WHERE status_sn = '$storyid'");
  $query3 = mysqli_query($conn, "DELETE FROM status_comments WHERE status = '$storyid'");
  $query4 = mysqli_query($conn, "DELETE FROM status_likes WHERE storyid = '$storyid'");
  if ($pix != "") {
    unlink($pix);
  }
}

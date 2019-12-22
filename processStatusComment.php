<?php
include("functions.php");
$conn = db_connect();

if (isset($_POST['comment'])) {
  $user = $_POST['user'];
  $id = $_POST['id'];
  $comment = $_POST['comment'];

  $query = "insert into status_comments values ('','$id','$user','$comment',now())";
  $result = mysqli_query($conn, $query);

  //Notification Block
  if ($result) {
    $query2 = "select poster from statuss where status_sn='$id'";
    $result2 = mysqli_query($conn, $query2);
    $row = mysqli_fetch_array($result2);
    $poster = $row['poster'];

    if ($poster != $user) {
      $message = "new comment on post";
      $query3 = "insert into notifications values ('','7','$poster','$id','$user','$message',now(),'0')";
      $result3 = mysqli_query($conn, $query3);
    }
  }
} else if (isset($_POST['call'])) {
  $sn = $_POST['id'];
  $query2 = "SELECT * FROM status_comments a LEFT JOIN users b ON a.commenter = b.matricno WHERE status = '$sn' ORDER BY a.time DESC LIMIT 4";
  $result2 = mysqli_query($conn, $query2);
  $count = countStatusComment($sn);
  $array = array();

  $comments = "";

  if ($count == 0) {
    $comments = "<span><i class = 'fa fa-comment-o fainteract' id = 'reply'></i>No comments yet</span>";
  } else if ($count == 1) {
    $comments = "<span><i class = 'fa fa-comment fainteract' id = 'reply'></i>1 comment</span>";
  } else {
    $comments = "<span><i class = 'fa fa-comments fainteract' id = 'reply'></i>$count comments</span>";
  }

  $array[0] = $comments;
  $msg = "";
  while ($row = mysqli_fetch_array($result2)) {
    $name = $row['fullname'];
    $picture = $row['picture'];
    $comment = $row['comment'];
    $msg .= "
                <div id = 'comments'>
                    <img src = '$picture' height = '35px' width = '35px' class = 'img-circle'><span class = 'comment-text'><span id = 'commenter-name'>$name </span> $comment</span>												
                </div>";
  }
  $array[1] = $msg;
  echo json_encode($array);
}

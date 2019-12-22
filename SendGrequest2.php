<?php
include("functions.php");
$conn = db_connect();

if (isset($_POST['level']) || (isset($_POST['dept'])) || (isset($_POST['faculty'])) || (isset($_POST['scentre']))) {
  $groupid = $_POST['groupid'];
  $matricno = $_POST['matricno'];
  $query = "insert into group_members values ('','$groupid','$matricno',now(),'3')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  if ($result) {
    $message = "new group invitation";
    $query2 = "insert into notifications values ('','3','$matricno','$groupid','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
}

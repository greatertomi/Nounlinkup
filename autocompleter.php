<?php
include("functions.php");
$conn = db_connect();

if (isset($_POST["nameinput"])) {
  $output = "";
  $name = $_POST["nameinput"];
  $user = $_POST["user"];
  //$query = "SELECT * FROM users WHERE fullname LIKE '%$word%'";
  $query = "SELECT * FROM users WHERE fullname LIKE '%$name%' AND matricno NOT IN
        (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
        AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
        (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
        (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1') and matricno != '$user'";

  $result = mysqli_query($conn, $query) or die("Could not query DB");
  $output = "<ul class='list-unstyled'>";

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $output .= "<li>" . $row['fullname'] . "</li>";
    }
  } else {
    $output .= "<span id='notfound'>Name Not Found</span>";
  }
  $output .= '</ul>';
  echo $output;
}

if (isset($_POST["inviteinput"])) {
  $output = "";
  $word = $_POST['inviteinput'];
  $groupid = $_POST['groupid'];
  $query = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members 
          WHERE groupid = '$groupid')AND fullname LIKE '%$word%'";

  $result = mysqli_query($conn, $query) or die("Could not query DB");
  $output = "<ul class='list-unstyled'>";

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $output .= "<li>" . $row['fullname'] . "</li>";
    }
  } else {
    $output .= "<span id='notfound'>Name Not Found</span>";
  }
  $output .= '</ul>';
  echo $output;
}

if (isset($_POST["gnameinput"])) {
  $output = "";
  $gname = $_POST['gnameinput'];
  $user = $_POST['user'];
  $query = "SELECT * FROM groups WHERE (groupname LIKE '%$gname%' OR purpose LIKE '%$gname%') 
            AND visibility = 'Public' AND groupid NOT IN (SELECT a.groupid FROM group_members a 
            LEFT JOIN groups b ON a.groupid = b.groupid WHERE member = '$user')";

  $result = mysqli_query($conn, $query);
  $output = "<ul class='list-unstyled'>";

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $output .= "<li>" . $row['groupname'] . "</li>";
    }
  } else {
    $output .= "<span id='notfound'>Name Not Found</span>";
  }
  $output .= '</ul>';
  echo $output;
}

<?php
include("functions.php");
$conn = db_connect();
session_start();
$matricno = $_SESSION['matricno'];
$_POST['notify'] = 1;

if (isset($_POST['notify'])) {
  $output = "";
  $query = "SELECT notf_type, COUNT(*) AS occurrence, message, MAX(date_log) AS date_log, case_point 
      FROM notifications WHERE notify = '$matricno' AND mread = 0 GROUP BY notf_type limit 5";
  $result = mysqli_query($conn, $query);
  $count = countNotification($matricno);
  $array = array();

  if ($count == 0) {
    $output = "<li class = 'list-group-item' id = 'empty'> No new notification</li>'";
  } else {
    $output .= "<li><a>You have $count new notifications</a></li>";

    while ($rows = mysqli_fetch_array($result)) {
      $occurrence = $rows['occurrence'];
      $notf_type = $rows['notf_type'];
      $date_log = $rows['date_log'];
      $date = timeCalculator($date_log);
      $message = "";

      if ($notf_type == 1) {
        if ($occurrence == 1) {
          $output .= "<li>
            <a href='add_friends.php'>
              <span class='notification-icon bg-success'>
                <i class='fa fa-plus'></i>
              </span>
              <span class='m-left-xs'>$occurrence new friend request</span>
              <span class='time text-muted'>$date</span>
            </a>
          </li>";
        } else {
          $output .= "<li>
            <a href='add_friends.php'>
              <span class='notification-icon bg-success'>
                <i class='fa fa-plus'></i>
              </span>
              <span class='m-left-xs'>$occurrence new friend requests</span>
              <span class='time text-muted'>$date</span>
            </a>
          </li>";
        }
      } else if ($notf_type == 2) {
        if ($occurrence == 1) {
          $output .= "<li>
            <a href='chat.php'>
              <span class='notification-icon bg-success'>
                <i class='fa fa-user'></i>
              </span>
              <span class='m-left-xs'>$occurrence request accepted</span>
              <span class='time text-muted'>$date</span>
            </a>
          </li>";
        } else {
          $output .= "<li>
            <a href='chat.php'>
              <span class='notification-icon bg-success'>
                <i class='fa fa-user'></i>
              </span>
              <span class='m-left-xs'>$occurrence friend requests accepted</span>
              <span class='time text-muted'>$date</span>
            </a>
          </li>";
        }
      } else if ($notf_type == 3) {
        if ($occurrence == 1) {
          $output .= "<li>
            <a href='profile.php'>
              <span class='notification-icon bg-success'>
                <i class='fa fa-group'></i>
              </span>
              <span class='m-left-xs'>$occurrence new group invitation</span>
              <span class='time text-muted'>$date</span>
            </a>
          </li>";
        } else {
          $output .= "<li>
            <a href='profile.php'>
              <span class='notification-icon bg-success'>
                <i class='fa fa-group'></i>
              </span>
              <span class='m-left-xs'>$occurrence new group invitations</span>
              <span class='time text-muted'>$date</span>
            </a>
          </li>";
        }
      } else if ($notf_type == 4) {
        $query2 = "SELECT notf_type, COUNT(*) AS occurrence, message, MAX(date_log),case_point
            FROM notifications WHERE notf_type='4' AND notify='$matricno' GROUP BY case_point";
        $result2 = mysqli_query($conn, $query2);

        while ($rows = mysqli_fetch_array($result2)) {
          $case_point = $rows['case_point'];
          $groupname = getGroupName($case_point);
          $occurrence2 = $rows['occurrence'];

          if ($occurrence2 == 1) {
            $output .= "<li>
              <a href='GroupProfile2.php?tocheck=$case_point'>
                <span class='notification-icon bg-success'>
                  <i class='fa fa-briefcase'></i>
                </span>
                <span class='m-left-xs'>$occurrence2 new request in $groupname</span>
                <span class='time text-muted'>$date</span>
              </a>
            </li>";
          } else {
            $output .= "<li>
              <a href='GroupProfile2.php?tocheck=$case_point'>
                <span class='notification-icon bg-success'>
                  <i class='fa fa-briefcase'></i>
                </span>
                <span class='m-left-xs'>$occurrence2 new requests in $groupname</span>
                <span class='time text-muted'>$date</span>
              </a>
            </li>";
          }
        }
      } else if ($notf_type == 5) {
        if ($occurrence == 1) {
          $output .= "<li>
            <a href='GroupChat.php'>
              <span class='notification-icon bg-success'>
                <i class='fa fa-check-square'></i>
              </span>
              <span class='m-left-xs'>$occurrence request to join group approved</span>
              <span class='time text-muted'>$date</span>
            </a>
          </li>";
        } else {
          $output .= "<li>
            <a href='GroupChat.php'>
              <span class='notification-icon bg-success'>
                <i class='fa fa-check-square'></i>
              </span>
              <span class='m-left-xs'>$occurrence request to join groups approved</span>
              <span class='time text-muted'>$date</span>
            </a>
          </li>";
        }
      } else if ($notf_type == 6) {
        $query2 = "SELECT notf_type, COUNT(*) AS occurrence, message, MAX(date_log),case_point
            FROM notifications WHERE notf_type='6' AND notify='$matricno' GROUP BY case_point";
        $result2 = mysqli_query($conn, $query2);

        while ($rows = mysqli_fetch_array($result2)) {
          $case_point = $rows['case_point'];
          $occurrence2 = $rows['occurrence'];

          if ($occurrence2 == 1) {
            $output .= "<li>
              <a href='Dashboard.php#commentdiv$case_point'>
                <span class='notification-icon bg-success'>
                  <i class='fa fa-thumbs-up'></i>
                </span>
                <span class='m-left-xs'>$occurrence2 new like on your post</span>
                <span class='time text-muted'>$date</span>
              </a>
            </li>";
          } else {
            $output .= "<li>
              <a href='Dashboard.php#commentdiv$case_point'>
                <span class='notification-icon bg-success'>
                  <i class='fa fa-thumbs-up'></i>
                </span>
                <span class='m-left-xs'>$occurrence2 new likes on your post</span>
                <span class='time text-muted'>$date</span>
              </a>
            </li>";
          }
        }
      } else if ($notf_type == 7) {
        $query2 = "SELECT notf_type, COUNT(*) AS occurrence, message, MAX(date_log),case_point
            FROM notifications WHERE notf_type='7' AND notify='$matricno' GROUP BY case_point";
        $result2 = mysqli_query($conn, $query2);

        while ($rows = mysqli_fetch_array($result2)) {
          $case_point = $rows['case_point'];
          $occurrence2 = $rows['occurrence'];

          if ($occurrence2 == 1) {
            $output .= "<li>
              <a href='Dashboard.php#commentdiv$case_point'>
                <span class='notification-icon bg-success'>
                  <i class='fa fa-comment'></i>
                </span>
                <span class='m-left-xs'>$occurrence2 new comment on your post</span>
                <span class='time text-muted'>$date</span>
              </a>
            </li>";
          } else {
            $output .= "<li>
              <a href='Dashboard.php#commentdiv$case_point'>
                <span class='notification-icon bg-success'>
                  <i class='fa fa-comment'></i>
                </span>
                <span class='m-left-xs'>$occurrence2 new comments on your post</span>
                <span class='time text-muted'>$date</span>
              </a>
            </li>";
          }
        }
      }
    }
    $output .= "<li><a href='all_notifications.php'>View all notifications</a></li>";
  }
  $array[0] = $count;
  $array[1] = $output;

  echo json_encode($array);
}

if (isset($_POST['clear'])) {
  $user = $_POST['user'];
  $query = "update notifications set mread = 1 where notify = '$user' and mread = 0";
  $result = mysqli_query($conn, $query);
}

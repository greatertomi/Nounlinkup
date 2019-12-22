<?php
include("functions.php");
session_start();
if (!isset($_SESSION['matricno'])) {
  header("location:index.php");
}
$conn = db_connect();

date_default_timezone_set('Africa/Lagos');
$time = date('Y-m-d H:i:s');
$login_id = $_SESSION['login_id'];
$query = "update login_details set last_activity = '$time' where login_id = '$login_id'";
$result = mysqli_query($conn, $query) or die("Could not database with current time");

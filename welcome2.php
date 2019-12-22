<?php
session_start();
include("functions.php");
$conn = db_connect();
$matricno = $_SESSION['matricno'];

$time = date("Y-m-d H:i:s");
$query2 = "insert into login_details (matricno, last_activity) values ('$matricno', '$time')";
$result2 = mysqli_query($conn, $query2) or die("Could not insert datas into login details table");

$query3 = mysqli_query($conn, "select * from login_details where matricno = '$matricno' and last_activity = '$time'");
$row2 = mysqli_fetch_array($query3);
$_SESSION['login_id'] = $row2['login_id'];
header("Location:dashboard.php");

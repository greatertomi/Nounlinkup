<?php
include("functions.php");
$conn = db_connect();

if (isset($_POST['delete'])) {
  $id = $_POST['delete'];
  $query = mysqli_query($conn, "delete from blog where id = '$id'");
}

if (isset($_POST['publish'])) {
  $id = $_POST['publish'];
  $query = "update blog set published = 'yes' where id = '$id'";
  $result = mysqli_query($conn, $query);
}

<?php
include("functions.php");
$conn = db_connect();

if (isset($_POST['groupid'])) {
  $groupid = $_POST['groupid'];
  $word = $_POST['word'];

  mysqli_query($conn, "update groups set purpose = '$word' where groupid = '$groupid'");
  $query = mysqli_query($conn, "select purpose from groups where groupid = '$groupid'");
  $row = mysqli_fetch_array($query);
  $purpose = $row['purpose'];
  echo "
      <div class = 'purpose'><p>$purpose<p></div> 
      <small class='block text-muted'>
          <a href = '#' id = 'edit'>Edit</a>
      </small>
  ";
}

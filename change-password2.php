<?php
session_start();

if(isset($_POST['savepassword'])) {
  $selector = $_POST["selector"];
  $validator = $_POST["validator"];
  $password = $_POST["password1"];
  $passwordRepeat = $_POST["password2"];

  $currentDate = date("U");
  $query1 = "SELECT * FROM pwdReset WHERE pwdResetSelector=$selector AND pwdResetExpires >= $currentDate";
  $result1 = mysqli_query($conn, $query1);

  if(!$row = mysqli_fetch_array($result1)) {
    echo "You need to re-submit your reset request";
    exit();
  }
  else {
    $tokenBin = hex2bin($validator);
    $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

    if($tokenCheck === false) {
      echo "You need to re-submit your reset request";
      exit();
    }
    elseif ($tokenCheck === true) {
      $tokenEmail = $row['pwdResetEmail'];
      $query2 = "SELECT * FROM users WHERE email = '$tokenEmail'";
      $result2 = mysqli_query($conn, $query2);

      if(!$row = mysqli_fetch_array($result2)) {
        echo "There was an error";
        exit();
      }
      else {
        $query3 = "UPDATE users SET password = '$password' WHERE email='$tokenEmail'";
        $result3 = mysqli_query($conn, $query3);

        $query4 = "DELETE FROM pwdReset WHERE pwdResetEmail='$tokenEmail'";
        $result4 = mysqli_query($conn, $query4);

        header("Location:login.php?newpwd=passwordupdated");
      }
    }
  }
}
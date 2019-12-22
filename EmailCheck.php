<?php
include("functions.php");
$conn = db_connect();
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $query = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    $count = mysqli_num_rows($query);
    $check = "";
    if ($count >= 1) {
        $check = "yes";
    }

    echo $check;
}

if (isset($_POST['matric'])) {
    $matric = $_POST['matric'];
    $query = mysqli_query($conn, "SELECT matricno FROM users WHERE matricno = '$matric'");
    $count = mysqli_num_rows($query);
    $check = "";
    if ($count >= 1) {
        $check = "yes";
    }

    echo $check;
}

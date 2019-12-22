<?php
    include("functions.php");
    $conn = db_connect();
    if(isset($_POST['name'])) {
        $name = ucwords($_POST['name']);
        $query = mysqli_query($conn,"select groupname from groups where groupname = '$name'");
        $count = mysqli_num_rows($query);
        $check = "";
        if($count >= 1) {
            $check = "yes";
        }

        echo $check;
    }
?>
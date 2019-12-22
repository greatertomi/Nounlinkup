<?php
    include("functions.php");
    $conn = db_connect();
    

    if(isset($_POST['name'])) {
        $name = $_POST['name'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE fullname LIKE '%$name%' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1') and matricno != '$user'";
        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query). " result(s)";
        echo $count;
    }
?>
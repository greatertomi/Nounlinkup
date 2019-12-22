<?php
    include("functions.php");
    $conn = db_connect();
    
    if(isset($_POST['groupid'])) {
        $word = $_POST['word'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid')AND fullname LIKE '%$word%'";
        
        $query = mysqli_query($conn, $q);  
        $count = mysqli_num_rows($query). " result(s)";
        echo $count;
    }
?>
<?php
    include("functions.php");
    $conn = db_connect();

    if(isset($_POST['moreComments'])) {
        $sn = $_POST['moreComments'];
        $query2 = "SELECT * FROM status_comments a LEFT JOIN users b ON a.commenter = b.matricno WHERE status = '$sn' ORDER BY a.time DESC";	
        $result2 = mysqli_query($conn,$query2);		
        while($row = mysqli_fetch_array($result2)) {
            $name = $row['fullname'];
            $picture = $row['picture'];
            $comment = $row['comment'];
            echo "
                <div id = 'comments'>
                    <img src = '$picture' height = '35px' width = '35px' class = 'img-circle'><span class = 'comment-text'><span id = 'commenter-name'>$name </span> $comment</span>												
                </div>";
        }
    }

?>
<?php
    include("functions.php");
    $conn = db_connect();
    session_start();
    $matricno = $_SESSION['matricno'];

    if(isset($_GET['offset']) && isset($_GET['limit'])) {
        $limit = $_GET['limit'];
        $offset = $_GET['offset'];

        $data = mysqli_query($conn, "SELECT * FROM statuss a LEFT JOIN users b ON a.poster = b.matricno ORDER BY a.time DESC limit $limit offset $offset");
        while($rows = mysqli_fetch_array($data)) {
            $name = $rows['fullname'];
            $dept = $rows['department'];
            $dept = getdept($dept);
            $scentre = $rows['study_centre'];
            $scentre = getcentre($scentre);
            $content = $rows['text'];
            $time = $rows['time'];
            $time = timeCalculator($time);
            $picture = $rows['picture'];
            $sn = $rows['status_sn'];
            $count = countStatusComment($sn);
            $status_picture = $rows['status_picture'];
            
            $comments = "";
            if ($count == 0) {
                $comments = "<span id = 'comcount$sn'><span><i class = 'fa fa-comment-o fainteract' id = 'reply'></i>No comments yet</span></span>";
            }
            else if ($count == 1) {
                $comments = "<span id = 'comcount$sn'><span><i class = 'fa fa-comment fainteract' id = 'reply'></i>1 comment</span></span>";
            }
            else {
                $comments = "<span id = 'comcount$sn'><span><i class = 'fa fa-comments fainteract' id = 'reply'></i>$count comments</span></span>";
            }

            echo "	<div class='panel panel-primary' id = 'posts'>
                <div class='panel-body'>
                    <img src = '$picture' class = 'img-circle' height = '65px' width = '65px' id = 'userimg'>
                    <span id = 'headername'>$name</span><br/>
                    <span id = 'headerdept'>$dept</span><br/>
                    <span id = 'headerscentre'>$scentre</span><br/>
                    <div id = 'content'>
                        $content
                    </div>";
                    
                    if($status_picture != null || $status_picture != "") {
                        echo "<div class='imgdiv'><img src='$status_picture' height='400' width='640'></div>";
                    }

                    echo "<div id = 'foot'>
                        <span id='fttxt'><i class = 'fa fa-clock-o fainteract' style = 'margin-left:0px;'></i>$time</span>";
                        $query4 = mysqli_query($conn,"select * from status_likes where storyid = '$sn' and liker = '$matricno'");
                        $nolikes = countStatusLikes($sn);

                        if(mysqli_num_rows($query4) == 1) {
                            echo "<span id='fttxt$sn'><span><i class = 'fa fa-thumbs-up fainteract unlike' id = '$sn'></i>$nolikes</span></span>";
                        }
                        else {
                            echo "<span id='fttxt$sn'><span><i class = 'fa fa-thumbs-o-up fainteract like' id = '$sn'></i>$nolikes</span></span>";
                        }
                        echo "<span id='fttxt'>$comments</span>
                    </div>
                </div>
                <hr/>
                <div>
                    <textarea cols = '100' rows = '1' class = 'comment' id = '$sn' placeholder = 'Enter your comment'></textarea>							
                </div>
                <hr/>
                <div id = 'commentdiv$sn'>";								
                
                $query2 = "SELECT * FROM status_comments a LEFT JOIN users b ON a.commenter = b.matricno WHERE status = '$sn' ORDER BY a.time DESC LIMIT 4";	
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
                    
                echo "</div>
                <span class='read_comments read_more$sn' id='$sn'>Read all comments</span>
                </div>";
                
        }
    }
?>
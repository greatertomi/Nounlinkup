<?php
    include("functions.php");
    $conn = db_connect();
    $output = "";
    

    if(isset($_POST['name'])) {
        $name = $_POST['name'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE fullname LIKE '%$name%' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1') and matricno != '$user'";
            
        $query = mysqli_query($conn, $q); 
        while ($rows = mysqli_fetch_array($query)) {
            $matricno = $rows['matricno'];
            $fullname = $rows['fullname'];
            $level = $rows['level'];
            $dept = $rows['department'];
            $dept = getdept($dept);
            $scentre = $rows['study_centre'];
            $scentre = getcentre($scentre);
            $picture = $rows['picture'];
            $info = $rows['about'];
            $tocheck = "profile2.php?tocheck=$matricno";
            
            $output .= "<div class='search-container'>
                <div class='panel panel-default'>
                <div class='panel-body'>	
                    <div class='search-header'>
                        <span class='h4 inline-block'>$fullname</span>
                        <div class='text-muted'>$level $dept [$scentre]</div>
                    </div>
                    <div class='seperator'></div>
                    
                    <p class='m-top-sm'>
                        <span class='pull-left avatar m-right-sm'> 
                            <img src='$picture' alt='$fullname' height = '60px' width = '60px'> 
                        </span>
                        $info
                    </p>
                    
                    <div class='text-right'>
                        <a class='btn btn-sm btn-primary results' id = '$matricno'> Send Request</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
        echo $output;
    }


    if(isset($_POST['word'])) {
        $word = $_POST['word'];
        $user = $_POST['user'];
        $array = array();

        $query = "SELECT * FROM groups WHERE (groupname LIKE '%$word%' OR purpose LIKE '%$word%') 
            AND visibility = 'Public' AND groupid NOT IN (SELECT a.groupid FROM group_members a 
            LEFT JOIN groups b ON a.groupid = b.groupid WHERE member = '$user')";
            
        $result = mysqli_query($conn, $query); 
        while($row = mysqli_fetch_array($result)) {
            $gname = $row['groupname'];
            $purpose = $row['purpose'];
            $groupid = $row['groupid'];
            $number = countGroupMembers($groupid);
            $picture = $row['groupimage'];
            $tocheck = "groupprofile.php?tocheck=$groupid";
            
            $output .= "<div class='search-container'>
                <div class='panel panel-default'>
                    <div class='panel-body'>	
                        <div class='search-header'>
                            <span class='h4 inline-block'>$gname</span>
                            <div class='text-muted'>$number member(s)</div>
                        </div>
                        <div class='seperator'></div>
                        
                        <p class='m-top-sm'>
                            <span class='pull-left avatar m-right-sm'> 
                                <img src='$picture' alt='group image' height = '60px' width = '60px'> 
                            </span>
                            <span>$purpose</span>
                        </p>
                        
                        <div class='text-right'>
                            <a class='btn btn-sm btn-primary results' id = '$groupid'> Send Request</a>
                            <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                        </div>
                    </div>
                </div>
                </div>";
        }

        $array[0] = $groupid;
        $array[1] = $output;
        echo json_encode($array);
    }
?>
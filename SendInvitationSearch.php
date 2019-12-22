<?php
    include("functions.php");
    $conn = db_connect();
    $output = "";
    
    if(isset($_POST['groupid'])) {
        $word = $_POST['word'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid')AND fullname LIKE '%$word%'";
        
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
                        <a href='search_result.html#' class='h4 inline-block'>$fullname</a>
                        <div class='text-muted'>$level $dept [$scentre]</div>
                    </div>
                    <div class='seperator'></div>
                    
                    <p class='m-top-sm'>
                        <a href='search_result.html#' class='pull-left avatar m-right-sm'> 
                            <img src='$picture' alt='$fullname' height = '60px' width = '60px'> 
                        </a>
                        $info
                    </p>
                    
                    <div class='text-right'>
                        <a class='btn btn-sm btn-primary results' id = '$matricno'> Send Invitation</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
        echo $output;
    }
?>
<?php
    include("functions.php");
    $conn = db_connect();
    $output = "";

    if(isset($_POST['level'])&&(!isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE level = '$level' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Request</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }
    else if(!isset($_POST['level'])&&(isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $dept = $_POST['dept'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE department = '$dept' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Request</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }
    else if(!isset($_POST['level'])&&(!isset($_POST['dept']))&&(isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $faculty = $_POST['faculty'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE faculty = '$faculty' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Request</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }

    else if(!isset($_POST['level'])&&(!isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $scentre = $_POST['scentre'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE study_centre = '$scentre' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Request</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }

    else if(isset($_POST['level'])&&(isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $dept = $_POST['dept'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE level = '$level' and department = '$dept' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Request</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }
    else if(isset($_POST['level'])&&(!isset($_POST['dept']))&&(isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $faculty = $_POST['faculty'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE level = '$level' and faculty = '$faculty' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Request</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }

    else if(isset($_POST['level'])&&(!isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $scentre = $_POST['scentre'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE level = '$level' and study_centre = '$scentre' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Request</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }

    else if(!isset($_POST['level'])&&(isset($_POST['dept']))&&(isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $dept = $_POST['dept'];
        $faculty = $_POST['faculty'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE department = '$dept' and faculty = '$faculty' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Request</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }

    else if(!isset($_POST['level'])&&(isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $dept = $_POST['dept'];
        $scentre = $_POST['scentre'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE department = '$dept' and study_centre = '$scentre' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Request</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }

    else if(!isset($_POST['level'])&&(!isset($_POST['dept']))&&(isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $faculty = $_POST['faculty'];
        $scentre = $_POST['scentre'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE faculty = '$faculty' and study_centre = '$scentre' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Request</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }

    else if(isset($_POST['level'])&&(!isset($_POST['dept']))&&(isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $faculty = $_POST['faculty'];
        $scentre = $_POST['scentre'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE level = '$level' and faculty = '$faculty' and study_centre = '$scentre' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Request</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }

    else if(isset($_POST['level'])&&(isset($_POST['dept']))&&(isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $dept = $_POST['dept'];
        $faculty = $_POST['faculty'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE level = '$level' and faculty = '$faculty' and department = '$dept' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Request</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }

    else if(isset($_POST['level'])&&(isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $dept = $_POST['dept'];
        $scentre = $_POST['scentre'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE level = '$level' and department = '$dept' and study_centre = '$scentre' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Request</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }

    else if(!isset($_POST['level'])&&(isset($_POST['dept']))&&(isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $dept = $_POST['dept'];
        $faculty = $_POST['faculty'];
        $scentre = $_POST['scentre'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE department = '$dept' and faculty = '$faculty' and study_centre = '$scentre' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Request</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }
    else if(isset($_POST['level'])&&(isset($_POST['dept']))&&(isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $dept = $_POST['dept'];
        $faculty = $_POST['faculty'];
        $scentre = $_POST['scentre'];
        $user = $_POST['user'];
        $q = "SELECT * FROM users WHERE level = '$level' and department = '$dept' and faculty = '$faculty' and study_centre = '$scentre' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Request</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        }
    }

    echo $output;
?>
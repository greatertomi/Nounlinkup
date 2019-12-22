<?php
    include("functions.php");
    $conn = db_connect();
    $output = "";
    
    if(isset($_POST['level'])&&(!isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND level = '$level'";

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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Invitation</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }
    else if(!isset($_POST['level'])&&(isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $dept = $_POST['dept'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND department = '$dept'";

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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Invitation</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";       
        }
    }
    else if(!isset($_POST['level'])&&(!isset($_POST['dept']))&&(isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $faculty = $_POST['faculty'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND faculty = '$faculty'";

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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Invitation</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }

    else if(!isset($_POST['level'])&&(!isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $scentre = $_POST['scentre'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND study_centre = '$scentre'";

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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Invitation</a>
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
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND level = '$level' and department = '$dept'";

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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Invitation</a>
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
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND level = '$level' and faculty = '$faculty'";

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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Invitation</a>
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
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND level = '$level' and study_centre = '$scentre'";

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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Invitation</a>
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
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND department = '$dept' and faculty = '$faculty'";

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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Invitation</a>
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
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND department = '$dept' and study_centre = '$scentre'";

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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Invitation</a>
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
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND faculty = '$faculty' and study_centre = '$scentre'";

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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Invitation</a>
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
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND level = '$level' and faculty = '$faculty' and study_centre = '$scentre'";

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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Invitation</a>
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
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND level = '$level' and department = '$dept' and faculty = '$faculty'";

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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Invitation</a>
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
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND level = '$level' and department = '$dept' and study_centre = '$scentre'";

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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Invitation</a>
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
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND department = '$dept' and faculty = '$faculty' and study_centre = '$scentre'";

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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Invitation</a>
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
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND level = '$level' and department = '$dept' and faculty = '$faculty' and study_centre = '$scentre'";

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
                        <a class='btn btn-sm btn-primary results2' id = '$matricno'> Send Invitation</a>
                        <a class='btn btn-sm btn-success' href = '$tocheck'>View Profile</a>
                    </div>
                </div>
            </div>
            </div>";
        
        }
    }

    echo $output;
?>
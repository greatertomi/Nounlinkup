<?php
    include("functions.php");
    $conn = db_connect();
    $count = "";
    
    if(isset($_POST['level'])&&(!isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid')AND level = '$level'";

        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query);
    }
    else if(!isset($_POST['level'])&&(isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $dept = $_POST['dept'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND department = '$dept'";

        $query = mysqli_query($conn, $q);
        $count = mysqli_num_rows($query); 
        
    }
    else if(!isset($_POST['level'])&&(!isset($_POST['dept']))&&(isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $faculty = $_POST['faculty'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND faculty = '$faculty'";

        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query);
    }

    else if(!isset($_POST['level'])&&(!isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $scentre = $_POST['scentre'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND study_centre = '$scentre'";

        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query);
    }

    else if(isset($_POST['level'])&&(isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $dept = $_POST['dept'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND level = '$level' and department = '$dept'";

        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query);
    }
    else if(isset($_POST['level'])&&(!isset($_POST['dept']))&&(isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $faculty = $_POST['faculty'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND level = '$level' and faculty = '$faculty'";

        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query);
    }

    else if(isset($_POST['level'])&&(!isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $scentre = $_POST['scentre'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND level = '$level' and study_centre = '$scentre'";

        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query);
    }

    else if(!isset($_POST['level'])&&(isset($_POST['dept']))&&(isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $dept = $_POST['dept'];
        $faculty = $_POST['faculty'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND department = '$dept' and faculty = '$faculty'";

        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query);
    }

    else if(!isset($_POST['level'])&&(isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $dept = $_POST['dept'];
        $scentre = $_POST['scentre'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND department = '$dept' and study_centre = '$scentre'";

        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query);
    }

    else if(!isset($_POST['level'])&&(!isset($_POST['dept']))&&(isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $faculty = $_POST['faculty'];
        $scentre = $_POST['scentre'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND faculty = '$faculty' and study_centre = '$scentre'";

        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query);
    }

    else if(isset($_POST['level'])&&(!isset($_POST['dept']))&&(isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $faculty = $_POST['faculty'];
        $scentre = $_POST['scentre'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND level = '$level' and faculty = '$faculty' and study_centre = '$scentre'";

        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query);
    }

    else if(isset($_POST['level'])&&(isset($_POST['dept']))&&(isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $dept = $_POST['dept'];
        $faculty = $_POST['faculty'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND level = '$level' and department = '$dept' and faculty = '$faculty'";

        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query);
    }

    else if(isset($_POST['level'])&&(isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $dept = $_POST['dept'];
        $scentre = $_POST['scentre'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND level = '$level' and department = '$dept' and study_centre = '$scentre'";

        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query);
    }

    else if(!isset($_POST['level'])&&(isset($_POST['dept']))&&(isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $dept = $_POST['dept'];
        $faculty = $_POST['faculty'];
        $scentre = $_POST['scentre'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND department = '$dept' and faculty = '$faculty' and study_centre = '$scentre'";

        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query);
    }
    else if(isset($_POST['level'])&&(isset($_POST['dept']))&&(isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $dept = $_POST['dept'];
        $faculty = $_POST['faculty'];
        $scentre = $_POST['scentre'];
        $groupid = $_POST['groupid'];
        $q = "SELECT * FROM users WHERE matricno NOT IN (SELECT member FROM group_members WHERE groupid = '$groupid') AND level = '$level' and department = '$dept' and faculty = '$faculty' and study_centre = '$scentre'";

        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query);
    }
    echo $count." result(s)";
?>
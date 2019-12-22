<?php
    include("functions.php");
    $conn = db_connect();
    $count = "";

    if(isset($_POST['level'])&&(!isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $user = $_POST['user'];
        $q = $q = "SELECT * FROM users WHERE level = '$level' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query). " result(s)";
        
    }
    else if(!isset($_POST['level'])&&(isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $dept = $_POST['dept'];
        $user = $_POST['user'];
        $q = $q = "SELECT * FROM users WHERE department = '$dept' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query). " result(s)";
        
    }
    else if(!isset($_POST['level'])&&(!isset($_POST['dept']))&&(isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $faculty = $_POST['faculty'];
        $user = $_POST['user'];
        $q = $q = "SELECT * FROM users WHERE faculty = '$faculty' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query). " result(s)";
        
    }
    else if(!isset($_POST['level'])&&(!isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $scentre = $_POST['scentre'];
        $user = $_POST['user'];
        $q = $q = "SELECT * FROM users WHERE study_centre = '$scentre' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query). " result(s)";
        
    }
    else if(isset($_POST['level'])&&(isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $dept = $_POST['dept'];
        $user = $_POST['user'];
        $q = $q = "SELECT * FROM users WHERE level = '$level' and department = '$dept' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query). " result(s)";
        
    }
    else if(isset($_POST['level'])&&(!isset($_POST['dept']))&&(isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $faculty = $_POST['faculty'];
        $user = $_POST['user'];
        $q = $q = "SELECT * FROM users WHERE level = '$level' and faculty = '$faculty' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query). " result(s)";
        
    }
    else if(isset($_POST['level'])&&(!isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $scentre = $_POST['scentre'];
        $user = $_POST['user'];
        $q = $q = "SELECT * FROM users WHERE level = '$level' and study_centre = '$scentre' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query). " result(s)";
        
    }
    else if(!isset($_POST['level'])&&(isset($_POST['dept']))&&(isset($_POST['faculty']))&&(!isset($_POST['scentre']))) {
        $dept = $_POST['dept'];
        $faculty = $_POST['faculty'];
        $user = $_POST['user'];
        $q = $q = "SELECT * FROM users WHERE department = '$dept' and faculty = '$faculty' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query). " result(s)";       
    }
    else if(!isset($_POST['level'])&&(isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $dept = $_POST['dept'];
        $scentre = $_POST['scentre'];
        $user = $_POST['user'];
        $q = $q = "SELECT * FROM users WHERE study_centre = '$scentre' and department = '$dept' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query). " result(s)";
        
    }
    else if(!isset($_POST['level'])&&(!isset($_POST['dept']))&&(isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $faculty = $_POST['faculty'];
        $scentre = $_POST['scentre'];
        $user = $_POST['user'];
        $q = $q = "SELECT * FROM users WHERE study_centre = '$scentre' and faculty = '$faculty' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query). " result(s)";
    }
    else if(isset($_POST['level'])&&(!isset($_POST['dept']))&&(isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $faculty = $_POST['faculty'];
        $scentre = $_POST['scentre'];
        $user = $_POST['user'];
        $q = $q = "SELECT * FROM users WHERE level = '$level' and faculty = '$faculty' and study_centre = '$scentre' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query). " result(s)";
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
        $count = mysqli_num_rows($query). " result(s)";
    }

    else if(isset($_POST['level'])&&(isset($_POST['dept']))&&(!isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $dept = $_POST['dept'];
        $scentre = $_POST['scentre'];
        $user = $_POST['user'];
        $q = $q = "SELECT * FROM users WHERE level = '$level' and department = '$dept' and study_centre = '$scentre' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query). " result(s)";
    }
    else if(!isset($_POST['level'])&&(isset($_POST['dept']))&&(isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $dept = $_POST['dept'];
        $faculty = $_POST['faculty'];
        $scentre = $_POST['scentre'];
        $user = $_POST['user'];
        $q = $q = "SELECT * FROM users WHERE department = '$dept' and faculty = '$faculty' and study_centre = '$scentre' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query). " result(s)";
    }
    else if(isset($_POST['level'])&&(isset($_POST['dept']))&&(isset($_POST['faculty']))&&(isset($_POST['scentre']))) {
        $level = $_POST['level'];
        $dept = $_POST['dept'];
        $faculty = $_POST['faculty'];
        $scentre = $_POST['scentre'];
        $user = $_POST['user'];
        $q = $q = "SELECT * FROM users WHERE level = '$level' and department = '$dept' and faculty = '$faculty' and study_centre = '$scentre' AND matricno NOT IN
            (SELECT matricno FROM users WHERE matricno IN (SELECT user2 FROM friends WHERE user1 = '$user' 
            AND STATUS = '2'UNION SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '2')) AND matricno NOT IN
            (SELECT user2 FROM friends WHERE user1 = '$user' AND STATUS = '1') AND matricno NOT IN
            (SELECT user1 FROM friends WHERE user2 = '$user' AND STATUS = '1')";
        $query = mysqli_query($conn, $q); 
        $count = mysqli_num_rows($query). " result(s)";
    }
    echo $count;
?>
<?php
    include("functions.php");

    if(isset($_POST['groupid'])) {
        $groupid = $_POST['groupid'];
        $array = array();
        $array[0] = countGroupMembers($groupid);
        $array[1] = countGroupMessages($groupid);

        echo json_encode($array);
    }
?>
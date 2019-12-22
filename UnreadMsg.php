<?php
    include("functions.php");
    
    
    if(isset($_POST['unread1'])) {
        $matricno = $_POST['user'];
        $unread = totalUnreadMsg($matricno);
        $array = array();
        $array[0] = $unread;
        $putMsg = "";
        
        if($unread == 0) {
            $putMsg = "";
        } 
        else {
            $putMsg = "<small class='chat-alert badge badge-danger pull-right'>$unread</small>";
        }
        $array[1] = $putMsg;
        echo json_encode($array);
    }

    if(isset($_POST['unread2'])) {
        $matricno = $_POST['user'];
        $unread = totalUnreadGroupMsg($matricno);
        $array = array();
        $array[0] = $unread;
        $putMsg = "";
        
        if($unread == 0) {
            $putMsg = "";
        } 
        else {
            $putMsg = "<small class='chat-alert badge badge-danger pull-right'>$unread</small>";
        }
        $array[1] = $putMsg;
        echo json_encode($array);
    }
?>
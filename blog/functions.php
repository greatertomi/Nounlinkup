<?php
    function db_connect() {
        $conn = mysqli_connect("localhost","root","","linkup") or die("could not connect to DB");
        return $conn;
    }

    function getAuthor($id) {
        $conn = db_connect();
        $query = mysqli_query($conn, "SELECT * FROM author WHERE authid = '$id'") or die ("Could not query database");
        $row = mysqli_fetch_array($query);

        $fname = $row['firstname'];
        $lname = $row['lastname'];
        $name = $lname." ".$fname;

        return $name;
    }
	function upload_newspix($name) {
		$tmp = $_FILES[$name]['tmp_name'];
		$name = $_FILES[$name]['name'];
		$target = "uploads/newsfiles/".$name;
		
		if(!move_uploaded_file($tmp,$target)) {
			echo "Could not put file in destination folder";
		} else 
		return $target;
	}

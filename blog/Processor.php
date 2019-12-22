<?php
    include("functions.php");
    $conn = db_connect();

    if(isset($_POST['delete1'])) {
        $newsid = $_POST['delete1'];
        $authid = $_POST['authid'];
        $query = mysqli_query($conn,"delete from blog where id='$newsid'") or die("Could not query database");
        $query2 = mysqli_query($conn, "select * from blog where author = '$authid'");
        $counter = 1;

        while ($rows = mysqli_fetch_array($query2)) {
            $headline = $rows["headline"];
            $date1 = strtotime($rows["date_written"]);
            $published = $rows["published"];
            $newid = $rows["id"];
            $date2 = date("d/m/Y  g:i a",$date1);

            echo "<tr>
                <td>$counter</td>
                <td>$headline</td>
                <td>$date2</td>
                <td>$published</td>
                <td class='table-action'>
                    <a href='edit_news.php?id=$newid' data-toggle='tooltip' title='Edit' class='tooltips'><span id='fa'><i class='fa fa-pencil'></span></i></a>
                    <a href='' data-toggle='tooltip' title='Delete' class='delete tooltips' id = '$newid'><span id='fa'><i class='fa fa-trash-o'></span></i></a>
                </td>
            </tr>";
            ++$counter;
        }
    }
    
    if(isset($_POST['publish1'])) {
        $newsid = $_POST['publish1'];
        $query = mysqli_query($conn, "update blog set published = 'yes', date_published = now() where id='$newsid'");
        $query2 = "SELECT * FROM blog AS b INNER JOIN author a WHERE a.authid = b.author AND published = 'no'";
        $result = mysqli_query($conn, $query2) or die("Could not select from database");
        $counter = 1;

        while ($rows = mysqli_fetch_array($result)) {
            $headline = $rows["headline"];
            $newhead = explode(" ",$headline);
            if(sizeOf($newhead) > 4)
                $headline = "$newhead[0] $newhead[1] $newhead[2] $newhead[3]...";

            $date1 = strtotime($rows["date_written"]);
            $published = $rows["published"];
            $firstname = $rows['firstname'];
            $lastname = $rows['lastname'];
            $newsid = $rows["id"];
            $date2 = date("d/m/Y  g:i a",$date1);
            $url = "post2.php?id=".$newsid;

            echo "<tr>
                <td>$counter</td>
                <td>$headline</td>
                <td>$lastname $firstname</td>
                <td>$date2</td>
                <td>$published</td>
                <td class='table-action'>
                <button class = 'btn btn-danger publish' id = '$newsid'>publish</button>
                <a class = 'btn btn-default' href='$url'>preview</a>
                <a href='' data-toggle='tooltip' title='Delete' class='delete tooltips' id = '$newsid'><span id='fa'><i class='fa fa-trash-o'></span></i></a>
                </td>
            </tr>";
            ++$counter;
        }
    }

    if(isset($_POST['unpublish'])) {
        $newsid = $_POST['unpublish'];
        $query = mysqli_query($conn, "update blog set published = 'no' where id='$newsid'");
        $query = "SELECT * FROM blog AS b INNER JOIN author a WHERE a.authid = b.author AND published = 'yes'";
        $result = mysqli_query($conn, $query) or die("Could not select from database");
        $counter = 1;

        while ($rows = mysqli_fetch_array($result)) {
        $headline = $rows["headline"];
        $newhead = explode(" ",$headline);
        if(sizeOf($newhead) > 4)
        $headline = "$newhead[0] $newhead[1] $newhead[2] $newhead[3]...";

        $date1 = strtotime($rows["date_written"]);
        $published = $rows["published"];
        $firstname = $rows['firstname'];
        $lastname = $rows['lastname'];
        $newsid = $rows["id"];
        $date2 = date("d/m/Y  g:i a",$date1);

        echo "<tr>
            <td>$counter</td>
            <td>$headline</td>
            <td>$lastname $firstname</td>
            <td>$date2</td>
            <td>$published</td>
            <td class='table-action'>
            <button class = 'btn btn-default unpublish' id = '$newsid'>Unpublish</button>
            </td>
        </tr>";
        ++$counter;
        }
    }
?>
<?php
include("functions.php");
$conn = db_connect();

if (isset($_POST['level']) && (!isset($_POST['dept'])) && (!isset($_POST['faculty'])) && (!isset($_POST['scentre']))) {
  $user1 = $_POST['user'];
  $user2 = $_POST['id'];
  $query = "insert into friends values ('','$user1','$user2',now(),'1','','')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  if ($result) {
    $message = "new friend request";
    $query2 = "insert into notifications values ('','1','$user2','$user1','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
} else if (!isset($_POST['level']) && (isset($_POST['dept'])) && (!isset($_POST['faculty'])) && (!isset($_POST['scentre']))) {
  $user1 = $_POST['user'];
  $user2 = $_POST['id'];
  $query = "insert into friends values ('','$user1','$user2',now(),'1','','')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  if ($result) {
    $message = "new friend request";
    $query2 = "insert into notifications values ('','1','$user2','$user1','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
} else if (!isset($_POST['level']) && (!isset($_POST['dept'])) && (isset($_POST['faculty'])) && (!isset($_POST['scentre']))) {
  $user1 = $_POST['user'];
  $user2 = $_POST['id'];
  $query = "insert into friends values ('','$user1','$user2',now(),'1','','')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  if ($result) {
    $message = "new friend request";
    $query2 = "insert into notifications values ('','1','$user2','$user1','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
} else if (!isset($_POST['level']) && (!isset($_POST['dept'])) && (!isset($_POST['faculty'])) && (isset($_POST['scentre']))) {
  $user1 = $_POST['user'];
  $user2 = $_POST['id'];
  $query = "insert into friends values ('','$user1','$user2',now(),'1','','')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  if ($result) {
    $message = "new friend request";
    $query2 = "insert into notifications values ('','1','$user2','$user1','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
} else if (isset($_POST['level']) && (isset($_POST['dept'])) && (!isset($_POST['faculty'])) && (!isset($_POST['scentre']))) {
  $user1 = $_POST['user'];
  $user2 = $_POST['id'];
  $query = "insert into friends values ('','$user1','$user2',now(),'1','','')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  if ($result) {
    $message = "new friend request";
    $query2 = "insert into notifications values ('','1','$user2','$user1','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
} else if (isset($_POST['level']) && (!isset($_POST['dept'])) && (isset($_POST['faculty'])) && (!isset($_POST['scentre']))) {
  $user1 = $_POST['user'];
  $user2 = $_POST['id'];
  $query = "insert into friends values ('','$user1','$user2',now(),'1','','')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  if ($result) {
    $message = "new friend request";
    $query2 = "insert into notifications values ('','1','$user2','$user1','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
} else if (isset($_POST['level']) && (!isset($_POST['dept'])) && (!isset($_POST['faculty'])) && (isset($_POST['scentre']))) {
  $user1 = $_POST['user'];
  $user2 = $_POST['id'];
  $query = "insert into friends values ('','$user1','$user2',now(),'1','','')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  if ($result) {
    $message = "new friend request";
    $query2 = "insert into notifications values ('','1','$user2','$user1','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
} else if (!isset($_POST['level']) && (isset($_POST['dept'])) && (isset($_POST['faculty'])) && (!isset($_POST['scentre']))) {
  $user1 = $_POST['user'];
  $user2 = $_POST['id'];
  $query = "insert into friends values ('','$user1','$user2',now(),'1','','')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  if ($result) {
    $message = "new friend request";
    $query2 = "insert into notifications values ('','1','$user2','$user1','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
} else if (!isset($_POST['level']) && (isset($_POST['dept'])) && (!isset($_POST['faculty'])) && (isset($_POST['scentre']))) {
  $user1 = $_POST['user'];
  $user2 = $_POST['id'];
  $query = "insert into friends values ('','$user1','$user2',now(),'1','','')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  if ($result) {
    $message = "new friend request";
    $query2 = "insert into notifications values ('','1','$user2','$user1','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
} else if (!isset($_POST['level']) && (!isset($_POST['dept'])) && (isset($_POST['faculty'])) && (isset($_POST['scentre']))) {
  $user1 = $_POST['user'];
  $user2 = $_POST['id'];
  $query = "insert into friends values ('','$user1','$user2',now(),'1','','')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  if ($result) {
    $message = "new friend request";
    $query2 = "insert into notifications values ('','1','$user2','$user1','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
} else if (isset($_POST['level']) && (!isset($_POST['dept'])) && (isset($_POST['faculty'])) && (isset($_POST['scentre']))) {
  $user1 = $_POST['user'];
  $user2 = $_POST['id'];
  $query = "insert into friends values ('','$user1','$user2',now(),'1','','')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  if ($result) {
    $message = "new friend request";
    $query2 = "insert into notifications values ('','1','$user2','$user1','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
} else if (isset($_POST['level']) && (isset($_POST['dept'])) && (isset($_POST['faculty'])) && (!isset($_POST['scentre']))) {
  $user1 = $_POST['user'];
  $user2 = $_POST['id'];
  $query = "insert into friends values ('','$user1','$user2',now(),'1','','')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  if ($result) {
    $message = "new friend request";
    $query2 = "insert into notifications values ('','1','$user2','$user1','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
} else if (isset($_POST['level']) && (isset($_POST['dept'])) && (!isset($_POST['faculty'])) && (isset($_POST['scentre']))) {
  $user1 = $_POST['user'];
  $user2 = $_POST['id'];
  $query = "insert into friends values ('','$user1','$user2',now(),'1','','')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  if ($result) {
    $message = "new friend request";
    $query2 = "insert into notifications values ('','1','$user2','$user1','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
} else if (!isset($_POST['level']) && (isset($_POST['dept'])) && (isset($_POST['faculty'])) && (isset($_POST['scentre']))) {
  $user1 = $_POST['user'];
  $user2 = $_POST['id'];
  $query = "insert into friends values ('','$user1','$user2',now(),'1','','')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  if ($result) {
    $message = "new friend request";
    $query2 = "insert into notifications values ('','1','$user2','$user1','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
} else if (isset($_POST['level']) && (isset($_POST['dept'])) && (isset($_POST['faculty'])) && (isset($_POST['scentre']))) {
  $user1 = $_POST['user'];
  $user2 = $_POST['id'];
  $query = "insert into friends values ('','$user1','$user2',now(),'1','','')";
  $result = mysqli_query($conn, $query) or die("could not insert in database");

  if ($result) {
    $message = "new friend request";
    $query2 = "insert into notifications values ('','1','$user2','$user1','','$message',now(),'0')";
    $result2 = mysqli_query($conn, $query2);
  }
}

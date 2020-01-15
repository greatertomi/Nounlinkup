<?php
include("functions.php");
include("footer.php");
$conn = db_connect();
?>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../bn/img/noun2.jpg" sizes="32x32">

  <title>Linkup Blog</title>
  <link href="tools/css/bootstrap.css" rel="stylesheet">
  <link href="tools/css/font-awesome.css" rel="stylesheet" type="text/css">

  <link href="tools/css/clean-blog.css" rel="stylesheet">
  <style>
    #btnPagination {
      background-color: #328130;
      color: white;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="index.php">Linkup Blog</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Welcome to Linkup blog</h1>
            <span class="subheading">We help you stay updated about NOUN</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <?php
        $query1 = "SELECT * FROM blog WHERE published = 'yes' ORDER BY date_published";
        $result1 = mysqli_query($conn, $query1) or die("Could not query database");

        while ($row = mysqli_fetch_array($result1)) {
          $id = $row['id'];
          $headline = $row['headline'];
          $subhead = $row['sub_heading'];
          $author = getAuthor($row['author']);
          $date1 = strtotime($row['date_published']);
          $date2 = date("F j, Y", $date1);

          echo "<div class='post-preview'>
                <a href='post.php?id=$id'>
                <h2 class='post-title'>
                  $headline
                  </h2>
                  <h3 class='post-subtitle'>
                  $subhead
                  </h3>
                </a>
                <p class='post-meta'>Posted by
                  <a href='#'>$author</a>
                  on $date2</p>
                  
                </div>
                <hr>";
        }
        ?>
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn float-right" href="#" id="btnPagination">Older Posts &rarr;</a>
        </div>
      </div>
    </div>
  </div>

  <hr>

  <?php echo footer(); ?>

  <script src="tools/js/jquery.js"></script>
  <script src="tools/js/bootstrap.bundle.js"></script>

  <script src="tools/js/clean-blog.js"></script>
</body>

</html>
<?php
	include("functions.php");
	$conn = db_connect();
    session_start();
    if(!isset($_SESSION['editor'])) {
        header("Location:login3.php");
    }
?>
<html>
	<head>
		<title>Editor's page</title>
		<link href = "../bn/vendor/bootstrap/css/bootstrap.min.css" rel = "stylesheet">
		<link href="../bn/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="../css/font-awesome.min.css" rel="stylesheet">

    <link rel="icon" href="../bn/img/noun2.jpg" sizes="32x32">
		<link href = "../bn/css/linkup.css" rel = "stylesheet">
		<script src="../js/jquery-1.10.2.min.js"></script>	
		
		<style>
			h1 {
				font-size: 60px;
				font-weight:bold
			}
			#logout {
				text-transform:capitalize;
				color:white;
				text-align:right;
			}
			.jumbotron {
				background-color:#d25d41;
				color:white;
			}
			th {
				background-color:#d25d41;
				color:white;
			}
            .btn-default {
                font-size:12px;
                width:70%;
                height:30px;
                border-radius:4px;
                text-transform:capitalize;
                background-color:#af2031;
                color:white;
                text-align:center;
                
            }
            .btn-danger {
                font-size:12px;
                width:30%;
                height:30px;
                border-radius:4px;
                text-transform:capitalize;
                text-align:center;
                
            }
            .table-action {
              margin-left:40%;
            }

		</style>

	</head>
	
	<body>
		<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
			<div class="container">
				<a class="navbar-brand js-scroll-trigger" href="" id = "nav">NOUN Linkup</a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="editor_index.php" id = "nav">unpublished stories</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger active" href="#" id = "nav">published stories</a>
						</li>
						<li class="nav-item" id="logout">
							<a class="nav-link js-scroll-trigger" href="logout2.php" id = "nav">logout</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class='jumbotron'>
				<div class='container'> 
						<h1>NOUN LINKUP</h1>
				</div>
		</div>

		<div class = "container">
			<div class="col-md-12">
				<h5 class="lg-title">Your stories</h5><br/>

				<div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>HeadLine</th>
                <th>Author</th>
                <th>Date witten</th>
                <th>Published</th>
              </tr>
            </thead>
            <tbody class="news_list">
            <?php
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
            ?>
            </tbody>
          </table>
				</div>
						
			</div><!-- row -->
		</div>

		<script src="../bn/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="../bn/vendor/jquery-easing/jquery.easing.min.js"></script>
		<script src="../bn/vendor/scrollreveal/scrollreveal.min.js"></script>
		<script src="../bn/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="../bn/js/linkup.js"></script>

		<script>
            $(".unpublish").click(function(){
                var newsid = this.id;
                $.ajax({
                    type: "POST",
                    url: "Processor.php",
                    data: {
                        unpublish:newsid,
                    },
                    success: function(response) {
                        $(".news_list").html(response);
                    }
                });
            });
			
		</script>
	</body>
</html>
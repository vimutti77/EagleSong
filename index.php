<!DOCTYPE html>
	<head>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./styles/snackbar.css">
		<link rel="stylesheet" type="text/css" href="./styles/customer.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>EagleSong</title>
	</head>
  <body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<li class="image"><img src="img/logo.png" style="width:166px;height:52px;"></li>
				</div>
				<ul class="nav navbar-nav">
					<li><a class="active" href="./index.php">Home</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">

				  <?php
  					session_start();
            if(!isset($_SESSION['productID'])) {
              $_SESSION['productID'] = array();
            }
            if(!isset($_SESSION['id'])) {
              echo "<li><a href='userRegis.html'><span class='glyphicon glyphicon-copy'></span> Register</a></li>";
              echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
            } else {
              echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Account <span class="caret"></span></a>' .
                      "<ul class='dropdown-menu'>" .
                        '<li><a href="userInfo.php"><span class="glyphicon glyphicon-pencil"></span>   Account Informations</a></li>' .
                        '<li><a href="history.php"><span class="glyphicon glyphicon-random"></span>   Randomed Chord History</a></li>' .
                      "</ul>" .
                    "</li>";
              echo "<li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
            }
				  ?>
				</ul>
			</div>
		</nav>
    <section class="is-large">
    <div class="container">
			<?php
			$file = "http://127.0.0.1/chords/chorddb.csv";
			$lines = file($file);
			$x = $lines[0];
			#echo ($x);
			$x = $lines[rand(1,31)];
			list($index, $artist, $album, $title) = split("[,]", $x);
			#echo "index: $index; name: $name; Url: $url<br />\n";
			?>
			<center>
		  <input type="button" value="Change!" onClick="window.location.reload()">
		</center>
		<center>
		  <H1><?php echo ($artist);?> - <?php echo ($title);?></H>
		  <H2><?php echo ($album);?><H2>
		  <br>
		<img src="/chords/<?php echo ($index);?>.png">
      <!--
      ######################### Add randomed chord to here #########################
      //-->
    </div>
    </section>
  </body>
</HTML>

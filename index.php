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

	  					$file = "./chords/chorddb.csv";
						$lines = file($file);
						if(!isset($_GET['chordID']))
						$x = $lines[rand(1,31)];
						else
						$x = $lines[$_GET['chordID']];
						list($index, $artist, $album, $title) = explode(",", $x);
							
						#echo "index: $index; name: $name; Url: $url<br />\n";

			            if(!isset($_SESSION['id'])) {
							echo "<li><a href='userRegis.html'><span class='glyphicon glyphicon-copy'></span> Register</a></li>";
							echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
			            } else {
			            	$con = mysqli_connect("localhost","root","","eaglesong");
							if (mysqli_connect_errno()) {
								die("Failed to connect to MySQL: " . mysqli_connect_error());
							}
							$sql = "INSERT IGNORE INTO History VALUES ('" . $_SESSION['id'] . "','" . bcsub($index,1) . "', CURRENT_TIMESTAMP)";
							if (!mysqli_query($con, $sql)) {
								die('Error: ' . mysqli_error($con));
							}
							mysqli_close($con);

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
			<center>
		  <input type="button" value="Change!" onClick="window.location.reload()">
		</center>
		<center>
		  <H1><?php echo ($artist);?> - <?php echo ($title);?></H>
		  <H2><?php echo ($album);?><H2>
		  <br>
		<img src="./chords/<?php echo ($index);?>.png">
    </div>
    </section>
  </body>
</HTML>
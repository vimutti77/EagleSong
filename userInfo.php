<!DOCTYPE html>
	<head>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="./styles/snackbar.css">
		<link rel="stylesheet" type="text/css" href="./styles/customer.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<title>User Information</title>
	</head>
	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li class="image"><img src="./img/logo.png" style="width:166px;height:52px;"></li>
					<li><a class="active" href="./index.php">Home</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php
  						session_start();
			            if(!isset($_SESSION['id'])) {
			            	header("location: ./login.php");
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
		<div class="container">
			<h2><font size="6">Your Account Informations</font></h2><br>
			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading" data-toggle="collapse" href="#collapse1" style="background-color: seagreen; color: white; cursor: pointer">
						<h4 class="panel-title">Edit Informations</h4>
					</div>
					<div id="collapse1" class="panel-collapse collapse in">
						<div class="panel-body">
							<form id="editInfoForm">
								<div class="form-group">
									<div class="col-xs-6">
										<div class="input-group">
											<span class="input-group-addon">First Name</span>
											<input id="editFirstName" type="text" class="form-control" placeholder="Enter your first name." required>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="input-group">
											<span class="input-group-addon">Last Name</span>
											<input id="editLastName" type="text" class="form-control" placeholder="Enter your last name." required>
										</div>
									</div>
									<br><br><br>
									<div class="col-xs-6">
										<div class="input-group">
											<span class="input-group-addon">Phone Number</span>
											<input id="editPhone" type="number" class="form-control" placeholder="Enter your phone number" min=0 required>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="input-group">
											<span class="input-group-addon">Email Address</span>
											<input id="editEmail" type="text" class="form-control" disabled required>
										</div>
									</div>
									<br><br><br>
									<div class="col-xs-12">
										<div class="input-group">
											<span class="input-group-addon">Address</span>
											<textarea id="editAddress" class="form-control" rows="5" required></textarea>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="panel-footer" style="text-align: right;">
							<input type="button" class="btn btn-success" id="editInfoBtn" value="Save" style="position: relative;">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="snackbar"></div>
		<script>
			var x = document.getElementById("snackbar");
			var currentUserID = <?php echo $_SESSION['id']; ?>;

			getUserInfo();

			function getUserInfo() {
				var url = "getUserInfo.php";
				var dataObj = {
					"currentUserID": currentUserID
				};
				$.post(url, dataObj, function(data, status) {
					var result = JSON.parse(data);
					$('#editFirstName').val(result[0].firstName);
					$('#editLastName').val(result[0].lastName);
					$('#editPhone').val(result[0].phone);
					$('#editEmail').val(result[0].email);
					$('#editAddress').val(result[0].address);
				});
			}

			$('#editInfoBtn').click(function() {
				if($("#editInfoBtn")[0].checkValidity()) {
					var url="editUserInfo.php"; 
					var dataObj = {
						"currentUserID": currentUserID,
						"editFirstName": $('#editFirstName').val(),
						"editLastName": $('#editLastName').val(),
						"editPhone": $('#editPhone').val(),
						"editAddress": $('#editAddress').val()
					};
					$.post(url, dataObj, function(data, status) {
						if(data == "Updated") {
							getUserInfo();
							x.style.backgroundColor = "YellowGreen";
							x.innerHTML = "Saved Successfully!";
						} else {
							x.style.backgroundColor = "Tomato";
							x.innerHTML = data;
						}
					});
				} else {
					x.style.backgroundColor = "Tomato";
					x.innerHTML = "Failed to Submit!";
				}
				x.className = "show";
				setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
			});
		</script>
	</body>
</html>
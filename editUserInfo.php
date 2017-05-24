<?php
	$conn = new mysqli("127.0.0.1", "root", "", "eaglesong");
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " .
		mysqli_connect_error();
	}

	$sql = "UPDATE User SET firstName = '" . $_POST['editFirstName'] . "', lastName = '" . $_POST['editLastName'] . "', phone = '" . $_POST['editPhone'] . "', address = '" . $_POST['editAddress'] . "' WHERE id = ". $_POST['currentUserID'];

	if(mysqli_query($conn, $sql)){
		echo "Updated";
	} else {
		echo "Error: " . mysqli_error($conn);
	}
	mysqli_close($conn);
?>
<?php
	$conn = new mysqli("127.0.0.1", "root", "", "eaglesong");
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$currentUserID = $_POST['currentUserID'];
	
	$sql = "SELECT firstName, lastName, phone, email, address FROM User WHERE id = " . $currentUserID;

	if($result = mysqli_query($conn, $sql)){
		$outp = "[";
		while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
			if ($outp != "[") {
				$outp .= ",";
			}
			$outp .= '{"firstName":"' . $rs["firstName"] . '",';
			$outp .= '"lastName":"' . $rs["lastName"] . '",';
			$outp .= '"phone":"' . $rs["phone"] . '",';
			$outp .= '"email":"' . $rs["email"] . '",';
			$outp .= '"address":"' . $rs["address"] . '"}';
		}
		$outp .="]";
		echo($outp);
	} else {
		echo "Error: " . mysqli_error($conn);
	}

	$conn->close();
?>

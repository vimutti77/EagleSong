<?php
	$con=mysqli_connect("localhost","root","","eaglesong");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$firstName = mysqli_real_escape_string($con, $_POST['firstName']);
	$lastName = mysqli_real_escape_string($con, $_POST['lastName']);
	$phone = mysqli_real_escape_string($con, $_POST['phone']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$address = mysqli_real_escape_string($con, $_POST['address']);
	$password = $_POST['password'];
	$passConfirm = $_POST['passConfirm'];

	if($password!=$passConfirm)
		die('Password and password confirmation doesn\'t match!');
	$encryptPass = xorShift($password);

	$sql = "INSERT INTO User VALUES ('','$firstName', '$lastName', '$phone', '$email', '$address', '$password')";

	if (!mysqli_query($con,$sql)) {
		die('Error: ' . mysqli_error($con));
	}
	else
		echo "Registration Success!";
	mysqli_close($con);

	header("location: ./index.php");

	function xorShift($string) {
    $key = 'uvuvwevwevweonyetenyevweugwemubwenossas';
    $text = $string;
    $outText = '';
    for($i=0; $i<strlen($text);$i++ ){
        for($j=0; $j<strlen($key); $j++){
            $outText .= ($text[$i] ^ $key[$j]);
        }
    }
    return $outText;
}
?>

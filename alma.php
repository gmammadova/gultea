<?php
	$servername = "localhost";
	$username = "gultea_user";
	$password = "gultea_password";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	echo "Connected successfully";
?>

<?php
    // Connect to Database
	$conn = mysqli_connect('localhost', 'admin1', 'test1234', 'pizza_hub');

	// Check Connection
	if(!$conn){
		echo 'Connection Error: ' . mysqli_connect_error();
	}
?>
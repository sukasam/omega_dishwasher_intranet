<?php  

	// $conn = mysql_connect("localhost","root","") or die("connection to db fail");
	// mysql_select_db("omega_dishwasher");
	// @mysqli_query($conn,"SET NAMES UTF8");

	$conn = mysqli_connect("localhost","root","","omega_dishwasher");
	// Check connection
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	@mysqli_query($conn,"SET NAMES UTF8");
?>
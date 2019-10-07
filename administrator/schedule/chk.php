<?php
	include ("../../include/connect.php");

	$qu = mysqli_query($conn,"SELECT * FROM service_schedule");
	while($row = mysqli_fetch_array($qu)){
		set_time_limit(0);
		$year = substr($row['created'],0,4);
		@mysqli_query($conn,"UPDATE `service_schedule` SET `year` = '".$year."' WHERE `id` = ".$row['id'].";");
		//exit();
	}
?>
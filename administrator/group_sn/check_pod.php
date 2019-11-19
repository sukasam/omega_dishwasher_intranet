<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");

	$quPod = mysqli_query($conn,"SELECT * FROM `s_group_sn` ORDER BY `group_id` ASC");

	while($row = mysqli_fetch_array($quPod)){
		//echo "SELECT * FROM s_group_pod WHERE group_name ='".$row['group_pod']."'";
		$quPOD = mysqli_query($conn,"SELECT * FROM s_group_pod WHERE group_name like '%".$row['group_pod']."%'");
		$rowPOD = mysqli_fetch_array($quPOD);
		//echo $row['group_pod'].$rowPOD['group_id'];
		
		if($rowPOD['group_id'] != ""){
			mysqli_query($conn,"UPDATE `s_group_sn` SET `group_pod` = '".$rowPOD['group_id']."' WHERE `s_group_sn`.`group_id` = ".$row['group_id'].";");
		}
		
		//exit();
	}
?>
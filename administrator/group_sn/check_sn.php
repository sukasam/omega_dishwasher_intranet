<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	
	$qrFO = mysqli_query($conn,"SELECT * FROM s_first_order WHERE 1 AND (pro_sn1 != '' OR pro_sn2 != '' OR pro_sn3 != '' OR pro_sn4 != '' OR pro_sn5 != '' OR pro_sn6 != '' OR pro_sn7 != '') ORDER BY fo_id ASC;");

	while($row = mysqli_fetch_array($qrFO)){
		set_time_limit(0);
//		echo $row['cpro1'].$row['pro_pod1'].$row['pro_sn1'];
//		exit();
		if($row['pro_sn1'] != ''){
			$qu1 = mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_name = '".$row['pro_sn1']."'");
			if(@mysqli_num_rows($qu1) == 0){
				@mysqli_query($conn,"INSERT INTO `s_group_sn` (`group_id`, `group_product`, `group_pod`, `group_name`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$row['cpro1']."', '".$row['pro_pod1']."', '".$row['pro_sn1']."', 'admin', '".date("Y-m-d H:i:s")."', NULL, '0000-00-00 00:00:00.000000', NULL, '0000-00-00 00:00:00.000000');");
			}
		}
		if($row['pro_sn2'] != ''){
			$qu2 = mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_name = '".$row['pro_sn2']."'");
			if(@mysqli_num_rows($qu2) == 0){
				@mysqli_query($conn,"INSERT INTO `s_group_sn` (`group_id`, `group_product`, `group_pod`, `group_name`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$row['cpro2']."', '".$row['pro_pod2']."', '".$row['pro_sn2']."', 'admin', '".date("Y-m-d H:i:s")."', NULL, '0000-00-00 00:00:00.000000', NULL, '0000-00-00 00:00:00.000000');");
			}
		}
		if($row['pro_sn3'] != ''){
			$qu3 = mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_name = '".$row['pro_sn3']."'");
			if(@mysqli_num_rows($qu3) == 0){
				@mysqli_query($conn,"INSERT INTO `s_group_sn` (`group_id`, `group_product`, `group_pod`, `group_name`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$row['cpro3']."', '".$row['pro_pod3']."', '".$row['pro_sn3']."', 'admin', '".date("Y-m-d H:i:s")."', NULL, '0000-00-00 00:00:00.000000', NULL, '0000-00-00 00:00:00.000000');");
			}
		}
		if($row['pro_sn4'] != ''){
			$qu4 = mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_name = '".$row['pro_sn4']."'");
			if(@mysqli_num_rows($qu4) == 0){
				@mysqli_query($conn,"INSERT INTO `s_group_sn` (`group_id`, `group_product`, `group_pod`, `group_name`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$row['cpro4']."', '".$row['pro_pod4']."', '".$row['pro_sn4']."', 'admin', '".date("Y-m-d H:i:s")."', NULL, '0000-00-00 00:00:00.000000', NULL, '0000-00-00 00:00:00.000000');");
			}
		}
		if($row['pro_sn5'] != ''){
			$qu5 = mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_name = '".$row['pro_sn5']."'");
			if(@mysqli_num_rows($qu5) == 0){
				@mysqli_query($conn,"INSERT INTO `s_group_sn` (`group_id`, `group_product`, `group_pod`, `group_name`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$row['cpro5']."', '".$row['pro_pod5']."', '".$row['pro_sn5']."', 'admin', '".date("Y-m-d H:i:s")."', NULL, '0000-00-00 00:00:00.000000', NULL, '0000-00-00 00:00:00.000000');");
			}
		}
		if($row['pro_sn6'] != ''){
			$qu6 = mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_name = '".$row['pro_sn6']."'");
			if(@mysqli_num_rows($qu6) == 0){
				@mysqli_query($conn,"INSERT INTO `s_group_sn` (`group_id`, `group_product`, `group_pod`, `group_name`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$row['cpro6']."', '".$row['pro_pod6']."', '".$row['pro_sn6']."', 'admin', '".date("Y-m-d H:i:s")."', NULL, '0000-00-00 00:00:00.000000', NULL, '0000-00-00 00:00:00.000000');");
			}
		}
		if($row['pro_sn7'] != ''){
			$qu7 = mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_name = '".$row['pro_sn7']."'");
			if(@mysqli_num_rows($qu7) == 0){
				@mysqli_query($conn,"INSERT INTO `s_group_sn` (`group_id`, `group_product`, `group_pod`, `group_name`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$row['cpro7']."', '".$row['pro_pod7']."', '".$row['pro_sn7']."', 'admin', '".date("Y-m-d H:i:s")."', NULL, '0000-00-00 00:00:00.000000', NULL, '0000-00-00 00:00:00.000000');");
			}
		}
		//exit();
	}
?>
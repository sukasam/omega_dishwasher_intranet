<?php

include ("../../include/connect.php");
include ("../../include/function.php");

if($_GET['action'] == 'changeSN'){
	
	$group_pod = getpod_id($conn,$_REQUEST['pod']);
	
	$list = '<option value="">กรุณาเลือกรายการ</option>';

	$qusn1 = @mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_pod = '".$group_pod."' ORDER BY group_name ASC");
	while($row_qusn1 = @mysqli_fetch_array($qusn1)){
		$list .= '<option value="'.$row_qusn1['group_name'].'">'.$row_qusn1['group_name'].'</option>'; 
	  ?>
		
	  <?php 	
	}
	
	echo '|'.$list;
}
	
?>
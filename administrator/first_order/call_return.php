<?php

include ("../../include/connect.php");
include ("../../include/function.php");

if($_GET['action'] == 'changeSN'){
	
	$group_pod = getpod_id($conn,$_REQUEST['pod']);
	$id = $_REQUEST['id'];
	$fo_id = $_REQUEST['fo_id'];
	
	$list = '<option value="">กรุณาเลือกรายการ</option>';

	$qusn1 = @mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_pod = '".$group_pod."' ORDER BY group_id ASC");
	while($row_qusn1 = @mysqli_fetch_array($qusn1)){
		//echo chkSeries($conn,$row_qusn1['group_name'],$fo_id);
		if(chkSeries($conn,$row_qusn1['group_name'],$fo_id) == 0){
			$list .= '<option value="'.$row_qusn1['group_name'].'">'.$row_qusn1['group_name'].'</option>'; 
		}
	  ?>
		
	  <?php 	
	}
	
	$searthBT = "<a href=\"javascript:void(0);\" onClick=\"windowOpener('400', '500', '', 'search_sn.php?protype=pro_sn".$id."&pod=".$group_pod."&fo_id=".$fo_id."');\"><img src=\"../images/icon2/mark_f2.png\" width=\"25\" height=\"25\" border=\"0\" alt=\"\" style=\"vertical-align:middle;padding-left:5px;\"></a>";
	
	echo '|'.$list.'|'.$searthBT;
}
	
?>
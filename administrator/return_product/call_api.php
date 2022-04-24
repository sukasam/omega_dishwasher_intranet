<?php
	include_once("../../include/connect.php");
	include_once("../../include/function.php");

	if($_GET['action'] == 'changeProcess'){
		//echo $_GET['id'].'-'.$_GET['process'];
		 $sql = "UPDATE `s_return_product` SET `st_setting` = '".$_GET['process']."' WHERE `order_id` = ".$_GET['id'].";";
		mysqli_query($conn,$sql);
		echo getStatusSolutionColor($_GET['process']);
		
		addNotification($conn,10,"s_return_product",$_GET['id'],$_GET['process']);
	}
?>
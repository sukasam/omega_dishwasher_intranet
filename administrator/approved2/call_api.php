<?php
	include_once("../../include/connect.php");

	if($_GET['action'] == 'changeProcess'){
		//echo $_GET['id'].'-'.$_GET['process'];
		mysqli_query($conn,"UPDATE `s_quotation_jobcard` SET `process` = '".$_GET['process']."' WHERE `s_quotation_jobcard`.`qc_id` = ".$_GET['id'].";");
		echo 'success';
	}
?>
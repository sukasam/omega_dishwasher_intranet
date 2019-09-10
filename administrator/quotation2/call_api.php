<?php
	include_once("../../include/connect.php");

	if($_GET['action'] == 'changeProcess'){
		//echo $_GET['id'].'-'.$_GET['process'];
		mysqli_query($conn,"UPDATE `s_quotation2` SET `process` = '".$_GET['process']."' WHERE `s_quotation2`.`qu_id` = ".$_GET['id'].";");
		echo 'success';
	}
?>
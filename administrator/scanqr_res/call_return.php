<?php
	session_start();
	include_once ("../../include/connect.php");
	include_once ("../../include/function.php");

	if($_GET['action'] == 'checkKey'){
		$qrcode = explode('|',base64_decode($_GET['qrcode']));
		
		$_SESSION["QR_FIELD"] = $qrcode[0];
		$_SESSION["QR_DATABASE"] = $qrcode[1];
		$_SESSION["QR_TARGET"] = $qrcode[2];

		//echo json_encode(array('status' => 'yes','pk_field' => $qrcode[0],'database'=> $qrcode[1],'target'=> $qrcode[2]));
		
	}
?>
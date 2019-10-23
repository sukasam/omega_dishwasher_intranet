<?php
	session_start();
	include_once ("../../include/connect.php");
	include_once ("../../include/function.php");

	if($_GET['action'] == 'checkKey'){
		
		$qrcode = explode('|',base64_decode($_GET['qrcode']));
		
		$_SESSION["QR_FIELD"] = base64_decode($_GET['qrcode']);
		echo json_encode(array('status' => 'yes','pk_field' => $_GET['qrcode'],'database'=> '','target'=> ''));
		
//		$_SESSION["QR_FIELD"] = $qrcode[0];
//		$_SESSION["QR_DATABASE"] = $qrcode[1];
//		$_SESSION["QR_TARGET"] = $qrcode[2];
//
//		echo json_encode(array('status' => 'yes','pk_field' => $qrcode[0],'database'=> $qrcode[1],'target'=> $qrcode[2]));
		
	}

	if($_GET['action'] == 'geo_location'){
		if($_GET['latitude'] != ""){
			$_SESSION["LATITUDE"] = $_GET['latitude'];
			$_SESSION["LONGITUDE"] = $_GET['longitude'];
			echo json_encode(array('status' => 'yes','latitude' => $_GET['latitude'],'longitude'=> $_GET['longitude']));
		}else{
			echo json_encode(array('status' => 'no'));
		}
		
	}
?>
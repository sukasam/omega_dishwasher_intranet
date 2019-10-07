<?php
	include_once ("../../include/config.php");
	include_once ("../../include/connect.php");
	session_start();

    $img = $_POST['imgData'];
    $sr_id = $_POST['sr_id'];

	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);
	//saving
	$path = '../../upload/customer/signature/';
	$fileName = base64_encode($sr_id).'.png';
	file_put_contents($path.$fileName, $fileData);
	
	$sqlSugnature = "UPDATE `s_service_report` SET `signature` = '".$fileName."', `signature_date`= '".date("Y-m-d H:i:s")."' WHERE `sr_id` = ".$sr_id.";";
	@mysqli_query($conn,"$sqlSugnature");
	
    die;
?>
<?php
	include_once ("../../include/config.php");
	include_once ("../../include/connect.php");
	session_start();
	if($_SESSION['login_id'] == ""){
		header("Location:../profiles/");
	}
	
    $img = $_POST['imgData'];
	$fs_id = $_POST['fs_id'];
	$order_id = $_POST['order_id'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);
	//saving
	$path = '../../upload/customer/signature/';
	$fileName = base64_encode($fs_id).'.png';
	file_put_contents($path.$fileName, $fileData);
	
	echo $sqlSugnature = "UPDATE `s_return_product` SET `signature` = '".$fileName."', `signature_date`= '".date("Y-m-d H:i:s")."' WHERE `order_id` = ".$order_id.";";
	@mysqli_query($conn,$sqlSugnature);
	
    die;
?>
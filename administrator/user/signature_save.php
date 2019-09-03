<?php
	include_once ("../../include/config.php");
	include_once ("../../include/connect.php");
	session_start();
	if($_SESSION['login_id'] == ""){
		header("Location:../profiles/");
	}

    $img = $_POST['imgData'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);
	//saving
	$path = '../../upload/user/signature/';
	$fileName = base64_encode($_SESSION['login_id']).'.png';
	file_put_contents($path.$fileName, $fileData);
	
	$sqlSugnature = "UPDATE `s_user` SET `signature` = '".$fileName."' WHERE `s_user`.`user_id` = ".$_SESSION['login_id'].";";
	@mysqli_query($conn,"$sqlSugnature");
	
    die;
?>
<?php  
	@session_start();
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");

	$id = $_GET['id'];
	
	if($_GET['action'] == 'album_sorts'){
		if($_GET['id_sequence'] == "" || $_GET['id_sequence'] == 0){
			@mysqli_query($conn,"UPDATE `s_document` SET  `sorts` =  '9999'  WHERE  `id` =".$_GET['id']." LIMIT 1 ;");
		}else{
			@mysqli_query($conn,"UPDATE `s_document` SET  `sorts` =  '".$_GET['id_sequence']."'  WHERE  `id` =".$_GET['id']." LIMIT 1 ;");
		}
	}	
	
	if($_GET['action'] == 'galary_sorts'){
		if($_GET['id_sequence'] == "" || $_GET['id_sequence'] == 0){
			@mysqli_query($conn,"UPDATE `s_document_gallery` SET  `sorts` =  '9999'  WHERE  `img_id` =".$_GET['id']." LIMIT 1 ;");
		}else{
			@mysqli_query($conn,"UPDATE `s_document_gallery` SET  `sorts` =  '".$_GET['id_sequence']."'  WHERE  `img_id` =".$_GET['id']." LIMIT 1 ;");
		}
	}	
		
	?>
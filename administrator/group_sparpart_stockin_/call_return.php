<?php  
include_once("../../include/connect.php");

//header('Content-Type: text/html; charset=tis-620');

if($_GET['action'] === "chkSparID"){
	
	$rowSpar = @mysqli_fetch_assoc(@mysqli_query($conn,"SELECT * FROM s_group_sparpart WHERE group_id ='".$_GET['group_id']."'"));
	
	if($rowSpar['group_id']){
		echo json_encode(array('status' => 'yes','group_spar_id'=> $rowSpar['group_spar_id']));
	}else{
		echo json_encode(array('status' => 'no'));
	}

}
?>
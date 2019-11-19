<?php  
include_once("../../include/connect.php");

//header('Content-Type: text/html; charset=tis-620');

if($_GET['action'] === "chkProID"){
	
	$rowSpar = @mysqli_fetch_assoc(@mysqli_query($conn,"SELECT * FROM s_group_sparpart WHERE group_spar_id ='".$_GET['group_spar_id']."'"));
	
	if($rowSpar['group_id']){
		echo json_encode(array('status' => 'yes','group_id'=> $rowSpar['group_id'],'group_spar_id'=> $rowSpar['group_spar_id'],'group_name'=> $rowSpar['group_name'],'group_location'=> $rowSpar['group_location'],'group_namecall'=> $rowSpar['group_namecall'],'group_type'=> $rowSpar['group_type'],'group_unit_price'=> $rowSpar['group_unit_price'],'group_price'=> $rowSpar['group_price'],'typespar'=> $rowSpar['typespar']));
	}else{
		echo json_encode(array('status' => 'no'));
	}

}

if($_GET['action'] === "chkProName"){
	
	$rowSpar = @mysqli_fetch_assoc(@mysqli_query($conn,"SELECT * FROM s_group_sparpart WHERE group_name LIKE '%".$_GET['group_name']."%'"));
	
	if($rowSpar['group_id']){
		echo json_encode(array('status' => 'yes','group_id'=> $rowSpar['group_id'],'group_spar_id'=> $rowSpar['group_spar_id'],'group_name'=> $rowSpar['group_name'],'group_location'=> $rowSpar['group_location'],'group_namecall'=> $rowSpar['group_namecall'],'group_type'=> $rowSpar['group_type'],'group_unit_price'=> $rowSpar['group_unit_price'],'group_price'=> $rowSpar['group_price'],'typespar'=> $rowSpar['typespar']));
	}else{
		echo json_encode(array('status' => 'no'));
	}

}
?>
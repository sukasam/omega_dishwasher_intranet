<?php  
include_once("../../include/connect.php");
include_once("../../include/function.php");

//header('Content-Type: text/html; charset=tis-620');

if($_GET['action'] === "chkSparID"){
	
	$rowSpar = @mysqli_fetch_assoc(@mysqli_query($conn,"SELECT * FROM s_group_sparpart WHERE group_id ='".$_GET['group_id']."'"));
	
	if($rowSpar['group_id']){
		echo json_encode(array('status' => 'yes','group_spar_id'=> $rowSpar['group_spar_id']));
	}else{
		echo json_encode(array('status' => 'no'));
	}
}
if($_GET['action'] === 'chkSparScan'){
	$rowSpar = @mysqli_fetch_assoc(@mysqli_query($conn,"SELECT * FROM s_group_sparpart WHERE group_spar_barcode ='".$_GET['scan_part']."'"));
	if($rowSpar['group_id']){
		echo json_encode(array('status' => 'yes','group_id'=>$rowSpar['group_id'],'group_spar_barcode'=> $rowSpar['group_spar_barcode'],'group_name'=> $rowSpar['group_name']));
	}else{
		echo json_encode(array('status' => 'no'));
	}
}

if($_GET['action'] === 'getSparScan'){
	$quQry = mysqli_query($conn, "SELECT * FROM `s_group_sparpart_bill_pro` WHERE id_bill = '" . $_GET['scan_part'] . "' ORDER BY id ASC");
	$data = array();
	while ($rowPro = mysqli_fetch_array($quQry,MYSQLI_ASSOC)) {
		array_push($data, array('group_id' => $rowPro['sparpart_id'],'group_spar_barcode' => get_sparpart_barcode($conn,$rowPro['sparpart_id']),'group_name' => get_sparpart_name($conn,$rowPro['sparpart_id']),'group_qty' => intval($rowPro['sparpart_qty'])));
	}
	echo json_encode(array('status' => 'yes','items' => $data));
}
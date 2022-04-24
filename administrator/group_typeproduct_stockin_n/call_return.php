<?php  
include_once("../../include/connect.php");
include_once("../../include/function.php");

//header('Content-Type: text/html; charset=tis-620');

if($_GET['action'] === "chkSparID"){
	
	$rowSpar = @mysqli_fetch_assoc(@mysqli_query($conn,"SELECT * FROM s_group_typeproduct WHERE group_id ='".$_GET['group_id']."'"));
	
	if($rowSpar['group_id']){
		echo json_encode(array('status' => 'yes','group_spro_id'=> $rowSpar['group_spro_id']));
	}else{
		echo json_encode(array('status' => 'no'));
	}

}

if($_GET['action'] === 'chkProScan'){
	$rowSpar = @mysqli_fetch_assoc(@mysqli_query($conn,"SELECT * FROM s_group_typeproduct WHERE group_spar_barcode ='".$_GET['scan_part']."'"));
	if($rowSpar['group_id']){
		echo json_encode(array('status' => 'yes','group_id'=>$rowSpar['group_id'],'group_spar_barcode'=> $rowSpar['group_spar_barcode'],'group_name'=> $rowSpar['group_name'],'group_pro_pod'=> $rowSpar['group_pro_pod'],'group_pro_pod_name'=> getpod_name($conn,$rowSpar['group_pro_pod'])));
	}else{
		echo json_encode(array('status' => 'no'));
	}
}

if($_GET['action'] === 'getProScan'){
	$quQry = mysqli_query($conn, "SELECT * FROM `s_group_typeproduct_bill_pro` WHERE id_bill = '" . $_GET['scan_part'] . "' ORDER BY id ASC");
	$data = array();
	while ($rowPro = mysqli_fetch_array($quQry,MYSQLI_ASSOC)) {
		array_push($data, array('group_id' => $rowPro['sparpart_id'],'group_spar_barcode' => get_product_barcode($conn,$rowPro['sparpart_id']),'group_name' => get_product_name($conn,$rowPro['sparpart_id']),'group_pro_pod' => $rowPro['sparpart_pod'],'group_qty' => intval($rowPro['sparpart_qty'])));
	}
	echo json_encode(array('status' => 'yes','items' => $data));
}
?>
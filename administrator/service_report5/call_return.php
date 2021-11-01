<?php
include_once("../../include/connect.php");
include_once("../../include/function.php");

//header('Content-Type: text/html; charset=tis-620');

if ($_GET['action'] === "chkSparID") {

	$rowSpar = @mysqli_fetch_assoc(@mysqli_query($conn, "SELECT * FROM s_group_sparpart WHERE group_id ='" . $_GET['group_id'] . "'"));

	if ($rowSpar['group_id']) {
		echo json_encode(array('status' => 'yes', 'group_spar_id' => $rowSpar['group_spar_id']));
	} else {
		echo json_encode(array('status' => 'no'));
	}
}
if ($_GET['action'] === 'chkSparScan') {
	$rowSpar = @mysqli_fetch_assoc(@mysqli_query($conn, "SELECT * FROM s_group_sparpart WHERE group_spar_barcode ='" . $_GET['scan_part'] . "'"));
	if ($rowSpar['group_id']) {
		echo json_encode(array('status' => 'yes', 'group_id' => $rowSpar['group_id'], 'group_spar_barcode' => $rowSpar['group_spar_barcode'], 'group_name' => $rowSpar['group_name'], 'group_namecall' => $rowSpar['group_namecall'], 'group_stock' => $rowSpar['group_stock']));
	} else {
		echo json_encode(array('status' => 'no'));
	}
}

if ($_GET['action'] === 'getSparScan') {
	if (!empty($_GET['scan_part'])) {
		$quQry = mysqli_query($conn, "SELECT * FROM `s_service_report5sub` WHERE sr_id = '" . $_GET['scan_part'] . "' ORDER BY r_id ASC");
		$data = array();
		while ($rowPro = mysqli_fetch_array($quQry, MYSQLI_ASSOC)) {
			array_push($data, array('group_id' => $rowPro['lists'], 'group_spar_barcode' => get_sparpart_barcode($conn, $rowPro['lists']), 'group_name' => get_sparpart_name($conn, $rowPro['lists']), 'group_namecall' => $rowPro['units'], 'group_stock' => getStockSpar($conn, $rowPro['lists']), 'group_qty' => intval($rowPro['opens']), 'group_remain' => intval($rowPro['remains'])));
		}
		echo json_encode(array('status' => 'yes', 'items' => $data));
	}else{
		echo json_encode(array('status' => 'no'));
	}
}

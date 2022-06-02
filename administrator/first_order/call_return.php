<?php

include ("../../include/connect.php");
include ("../../include/function.php");

if($_GET['action'] === 'chkProScan'){
	$rowSpar = @mysqli_fetch_assoc(@mysqli_query($conn,"SELECT * FROM s_group_typeproduct WHERE group_spar_barcode ='".$_GET['scan_part']."'"));
	if($rowSpar['group_id']){
		echo json_encode(array('status' => 'yes','group_id'=>$rowSpar['group_id'],'group_spar_barcode'=> $rowSpar['group_spar_barcode'],'group_name'=> $rowSpar['group_name'],'group_pro_pod'=> $rowSpar['group_pro_pod'],'group_pro_pod_name'=> getpod_name($conn,$rowSpar['group_pro_pod'])));
	}else{
		echo json_encode(array('status' => 'no'));
	}
}

if($_GET['action'] === 'getProScan'){

	$quQry = mysqli_query($conn, "SELECT * FROM `s_first_order` WHERE fo_id = '" . $_GET['fo_id'] . "' LIMIT 1");
	$rowPro = mysqli_fetch_array($quQry,MYSQLI_ASSOC);
	$data = array();
	$cproTmp = array('cpro1', 'cpro2', 'cpro3', 'cpro4', 'cpro5', 'cpro6', 'cpro7');
	$cpodTmp = array('pro_pod1', 'pro_pod2', 'pro_pod3', 'pro_pod4', 'pro_pod5', 'pro_pod6', 'pro_pod7');
	$csnTmp = array('pro_sn1', 'pro_sn2', 'pro_sn3', 'pro_sn4', 'pro_sn5', 'pro_sn6', 'pro_sn7');
	$camountTmp = array('camount1', 'camount2', 'camount3', 'camount4', 'camount5', 'camount6', 'camount7');
	$cpriceTmp = array('cprice1', 'cprice2', 'cprice3', 'cprice4', 'cprice5', 'cprice6', 'cprice7');

	for($i=0;$i<count($cproTmp);$i++) {
		if(!empty($rowPro[$cproTmp[$i]])){
			array_push($data, array('group_id' => $rowPro[$cproTmp[$i]],'group_spar_barcode' => get_product_barcode($conn,$rowPro[$cproTmp[$i]]),'group_name' => get_product_name($conn,$rowPro[$cproTmp[$i]]),'group_pro_pod' => $rowPro[$cpodTmp[$i]],'group_pro_sn' => $rowPro[$csnTmp[$i]],'group_qty' => intval($rowPro[$camountTmp[$i]]),'group_price' => intval($rowPro[$cpriceTmp[$i]])));
		}
		
	}
	echo json_encode(array('status' => 'yes','items' => $data));
}

if($_GET['action']  === 'genTablePro'){

	$data = utf8_encode($_POST['data']); // Don't forget the encoding
    $data = json_decode($data,true);
	if(isset($_GET['fo_id'])){
		$foid = $_GET['fo_id'];
	}else{
		$foid = '';
	}
	

	$tablePro = '<tr>
					<td width="3%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
					<td width="40%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
					<td width="21%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น</strong></td>
					<td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>S/N</strong></td>
					<td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
					<td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา / ต่อหน่วย</strong></td>
				</tr>';

				// echo $tablePro;
	$numPro = count($data);

	for($i=1;$i<=$numPro;$i++){

		$bpro[] = $data[$i-1]['group_id'];
		$bpod[] = $data[$i-1]['group_pro_pod'];
		$bamount[] = $data[$i-1]['group_qty'];


		$tablePro .= '<tr>
		<td style="border:1px solid #000000;padding:5;text-align:center;">'.$i.'
		<input type="hidden" name="bpro[]" value="'.$bpro[$i-1].'">
		<input type="hidden" name="bpod[]" value="'.$bpod[$i-1].'">
		<input type="hidden" name="bamount[]" value="'.$bamount[$i-1].'">
		</td>
		<td style="border:1px solid #000000;text-align:left;padding:5;">
		<select name="cpro'.$i.'" id="cpro'.$i.'" class="inputselect" style="width:90%;">
			  <option value="">กรุณาเลือกรายการ</option>';

				$qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
				while($row_qupro1 = @mysqli_fetch_array($qupro1)){
					$cproCheck = '';
					if($data[$i-1]['group_id'] == $row_qupro1['group_id']){
						$cproCheck = 'selected';
						$cpodRelate = $row_qupro1['group_pro_pod'];
					}
				  $tablePro .= '<option value="'.$row_qupro1['group_id'].'" '.$cproCheck.'>'.$row_qupro1['group_name'].' '.$row_qupro1['group_detail'].'</option>';
				}

		$tablePro .= '</select>
		<a href="javascript:void(0);" onClick="windowOpener(\'400\', \'500\', \'\', \'search.php?protype=cpro'.$i.'\');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
		</td>
		<td style="border:1px solid #000000;padding:5;text-align:center;">
		<select name="pro_pod'.$i.'" id="pro_pod'.$i.'" class="inputselect" style="width:80%;" onchange="changePod(\'pro_pod'.$i.'\',\'pro_sn'.$i.'\',\''.$i.'\',\''.$foid.'\');">
			  <option value="">กรุณาเลือกรายการ</option>';
			
				$qupros1 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
				while($row_qupros1 = @mysqli_fetch_array($qupros1)){
					$cpodCheck = '';
					if(empty($cpodRelate)){
						if($data[$i-1]['group_pro_pod'] == $row_qupros1['group_id']){
							$cpodCheck = 'selected';
						}
					}else{
						if($cpodRelate == $row_qupros1['group_id']){
							$cpodCheck = 'selected';
						}
						
					}
					
					$tablePro .= '<option value="'.$row_qupros1['group_name'].'" '.$cpodCheck.'>'.$row_qupros1['group_name'].'</option>';
				}

		$tablePro .= '</select><a href="javascript:void(0);" onClick="windowOpener(\'400\', \'500\', \'\', \'search_pod.php?protype=pro_pod'.$i.'&protype2=pro_sn'.$i.'&protype3='.$i.'&fo_id='.$foid.'\');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
		</td>
		<td style="border:1px solid #000000;padding:5;text-align:center;white-space: nowrap;" >

	   <select name="pro_sn'.$i.'" id="pro_sn'.$i.'" class="inputselect" style="width:80%;">
			  <option value="">กรุณาเลือกรายการ</option>';
				
				$qusn1 = @mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_pod = '".$cpodRelate."' ORDER BY group_id ASC");
				while($row_qusn1 = @mysqli_fetch_array($qusn1)){
					if(chkSeries($conn,$row_qusn1['group_name'],$_GET['fo_id']) == 0){
						$tablePro .= '<option value="'.$row_qusn1['group_name'].'">'.$row_qusn1['group_name'].'</option>';
					} 
				}

		$tablePro .= '</select><span id="search_sn'.$i.'">
		<a href="javascript:void(0);" onClick="windowOpener(\'400\', \'500\', \'\', \'search_sn.php?protype=pro_sn'.$i.'&pod='.$cpodRelate.'&fo_id='.$foid.'\');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
		</span>

		</td>
		<td style="border:1px solid #000000;padding:5;text-align:center;">
		  <input type="text" name="camount'.$i.'" value="'.$data[$i-1]['group_qty'].'" id="camount'.$i.'" class="inpfoder" style="width:100%;text-align:center;">
		</td>
		<td style="border:1px solid #000000;padding:5;text-align:center;">
		  <input type="text" name="cprice'.$i.'" value="'.$data[$i-1]['group_price'].'" id="cprice'.$i.'" class="inpfoder" style="width:100%;text-align:center;">
		</td>
	  </tr>';
	}
	
	echo $tablePro;
	
}

if($_GET['action'] == 'changeSN'){
	
	$group_pod = getpod_id($conn,$_REQUEST['pod']);
	$id = $_REQUEST['id'];
	$fo_id = (!empty($_REQUEST['fo_id'])) ? $_REQUEST['fo_id'] : '0';
	
	$list = '<option value="">กรุณาเลือกรายการ</option>';

	$qusn1 = @mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_pod = '".$group_pod."' AND group_status = 0 ORDER BY group_id ASC");
	while($row_qusn1 = @mysqli_fetch_array($qusn1)){
		// echo chkSeries($conn,$row_qusn1['group_name'],$fo_id);
		if(chkSeries($conn,$row_qusn1['group_name'],$fo_id) == 0){
			$list .= '<option value="'.$row_qusn1['group_name'].'">'.$row_qusn1['group_name'].'</option>'; 
		}
	  ?>
		
	  <?php 	
	}
	
	$searthBT = "<a href=\"javascript:void(0);\" onClick=\"windowOpener('400', '500', '', 'search_sn.php?protype=pro_sn".$id."&pod=".$group_pod."&fo_id=".$fo_id."');\"><img src=\"../images/icon2/mark_f2.png\" width=\"25\" height=\"25\" border=\"0\" alt=\"\" style=\"vertical-align:middle;padding-left:5px;\"></a>";
	
	echo '|'.$list.'|'.$searthBT;
}
	
?>
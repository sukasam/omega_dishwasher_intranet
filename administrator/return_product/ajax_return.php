<?php 
	include_once("../../include/aplication_top.php");
	include_once ("../../include/function.php");
	header("Content-type: text/html; charset=windows-874");
	header("Cache-Control: no-cache, must-revalidate");
	@mysqli_query($conn,"SET NAMES tis620");
	
	
	if($_GET['action'] == 'getcusfirsh'){
		$fpid = $_GET['pid'];
		$rowcus  = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_first_order WHERE fo_id  = '".$fpid."'"));
		$ctyp = '';
		$qu_province = @mysqli_query($conn,"SELECT * FROM s_province ORDER BY province_name ASC");
			while($row_province = @mysqli_fetch_array($qu_province)){
					$ctyp .= "<option value=".$row_province['province_id']." ";
					if($row_province['province_id'] == $rowcus['cd_province']){$ctyp .= "selected=selected";}
					$ctyp .= ">".$row_province['province_name']."</option>";
					
			}
		
		$arrayProFO = array('cpro1','cpro2','cpro3','cpro4','cpro5','cpro6','cpro7');
		$arrayProFOAmount = array('camount1','camount2','camount3','camount4','camount5','camount6','camount7');
		
		$foProductList = '
		<table width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;">
			<tr>
				<td width="5%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>'.iconv( 'UTF-8', 'TIS-620', 'เลือก').'</strong></td>
				<td width="5%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>'.iconv( 'UTF-8', 'TIS-620', 'ลำดับ').'</strong></td>
				<td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>'.iconv( 'UTF-8', 'TIS-620', 'รหัสสินค้า').'</strong></td>
				<td width="40%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>'.iconv( 'UTF-8', 'TIS-620', 'รายละเอียด').'</strong></td>
				<td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>'.iconv( 'UTF-8', 'TIS-620', 'จำนวน').'</strong></td>
				<td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>'.iconv( 'UTF-8', 'TIS-620', 'หน่วย').'</strong></td>
				<td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;display:none;"><strong>'.iconv( 'UTF-8', 'TIS-620', 'ราคา/หน่วย').'</strong></td>
			</tr>';
			
			for($i=0;$i<count($arrayProFO);$i++){
				if(!empty($rowcus[$arrayProFO[$i]])){
					$foProductList .= '<tr>
						<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
							<input type="checkbox" name="chkOrder[]" id="chkOrder'.$i.'" value="'.$i.'">
							<input type="hidden" name="chkCode[]" value="'.$rowcus[$arrayProFO[$i]].'">
						</td>
						<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">'.($i+1).'</td>
						<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">'.get_probarcode($conn,$rowcus[$arrayProFO[$i]]).'
							<input type="hidden" name="chkSproid[]" value="'.get_probarcode($conn,$rowcus[$arrayProFO[$i]]).'">
						</td>
						<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:left;">'.get_proname($conn,$rowcus[$arrayProFO[$i]]).'</td>
						<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">'.$rowcus[$arrayProFOAmount[$i]].'
							<input type="hidden" name="chkAmount[]" id="chkAmount'.$i.'" value="'.$rowcus[$arrayProFOAmount[$i]].'">
						</td>
						<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">'.get_pronamecall($conn,$rowcus[$arrayProFO[$i]]).'</td>
						<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;display:none;"></td>
					</tr> ';
				}
				
			}
			

			$foProductList .= '</table>';

		$displ = "|".$rowcus['cd_address']."|".$ctyp."|".$rowcus['cd_tel']."|".$rowcus['cd_fax']."|".$rowcus['c_contact']."|".$rowcus['c_tel']."|".$rowcus['ctype']."|".custype_name($conn,$rowcus['ctype'])."|".$rowcus['loc_name2']."|".$rowcus['loc_address2']."|".getsalename($conn, $rowcus['cs_sell'])."|".$foProductList."|";
		echo $displ;
	}

	if($_GET['action'] == 'getpro'){
		$pid = $_GET['pid'];
		$rowpro  = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_typeproduct WHERE group_id = '".$pid."'"));
		echo $rowpro['group_pro_pod']."|".$rowpro['group_pro_sn']."|".number_format($rowpro['group_pro_price']);
	}
	
	if($_GET['action'] == 'getprice'){
		$pid = $_GET['pid'];
		$prid = $_GET['prid'];
		$rowpro  = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_typeproduct WHERE group_id = '".$pid."'"));
		$sumprice = $prid * $rowpro['group_pro_price'];
		echo number_format($sumprice);
	}

	if($_GET['action'] == 'getcus2'){
			$cd_name =  iconv( 'UTF-8', 'TIS-620', $_REQUEST['pval']);
			if($cd_name != ""){
				$consd = " AND (cd_name LIKE '%" . $cd_name . "%' OR loc_name LIKE '%" . $cd_name . "%')";
			}
			$conDealer = "";
			if (userGroup($conn, $_SESSION['login_id']) === "Dealer") {
				$conDealer = " AND `create_by` = '" . $_SESSION['login_id'] . "'";
			}
			//echo "SELECT fo_id,cd_name,loc_name FROM s_first_order WHERE 1 ".$conDealer.$consd." ORDER BY cd_name ASC";
			$qu_cus = mysqli_query($conn,"SELECT fo_id,cd_name,loc_name FROM s_first_order WHERE 1 ".$conDealer.$consd." ORDER BY cd_name ASC");
			while($row_cusx = @mysqli_fetch_array($qu_cus)){
				?>
				 <tr>
					<td><A href="javascript:void(0);" onclick="get_customer('<?php echo $row_cusx['fo_id'];?>','<?php echo $row_cusx['cd_name'];?>');"><?php echo $row_cusx['cd_name'];?> (<?php echo $row_cusx['loc_name']?>)</A></td>
				  </tr>
				<?php	
			}
			//echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
		}
	
	if($_GET['action'] == 'getcus'){
		$cd_name =  iconv( 'UTF-8', 'TIS-620', $_REQUEST['pval']);
		$keys = $_REQUEST['keys'];
		if($cd_name != ""){
			$consd = "WHERE group_name LIKE '%".$cd_name."%'";
		}
		//echo "SELECT group_name FROM s_group_typeproduct ".$consd." ORDER BY group_name ASC";
		$qu_cus = mysqli_query($conn,"SELECT * FROM s_group_typeproduct ".$consd." ORDER BY group_name ASC");
		while($row_cus = @mysqli_fetch_array($qu_cus)){
			?>
			 <tr>
				<td><A href="javascript:void(0);" onclick="get_product('<?php  echo $row_cus['group_id'];?>','<?php  echo $row_cus['group_name'];?>','<?php  echo $keys;?>');"><?php  echo $row_cus['group_name'];?></A></td>
			  </tr>
			<?php 	
		}
		//echo "SELECT cd_name FROM s_return_product ".$consd." ORDER BY cd_name ASC";
	}
	
	if($_GET['action'] == 'getpodkey'){
		$cd_name =  iconv( 'UTF-8', 'TIS-620', $_REQUEST['pval']);
		$keys = $_REQUEST['keys'];
		if($cd_name != ""){
			$consd = "WHERE group_name LIKE '%".$cd_name."%'";
		}
		//echo "SELECT group_name FROM s_group_typeproduct ".$consd." ORDER BY group_name ASC";
		$qu_cus = mysqli_query($conn,"SELECT * FROM s_group_pod ".$consd." ORDER BY group_name ASC");
		while($row_cus = @mysqli_fetch_array($qu_cus)){
			?>
			 <tr>
				<td><A href="javascript:void(0);" onclick="get_pod('<?php  echo $row_cus['group_id'];?>','<?php  echo $row_cus['group_name'];?>','<?php  echo $keys;?>');"><?php  echo $row_cus['group_name'];?></A></td>
			  </tr>
			<?php 	
		}
		//echo "SELECT cd_name FROM s_return_product ".$consd." ORDER BY cd_name ASC";
	}
	
	if($_GET['action'] == 'getprotype'){
		$group_id = $_REQUEST['group_id'];
		$group_name = $_REQUEST['group_name'];
		$protype = $_REQUEST['protype'];
		
		$qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
		while($row_qupro1 = @mysqli_fetch_array($qupro1)){
		  ?>
			<option value="<?php  echo $row_qupro1['group_id'];?>" <?php  if($group_id == $row_qupro1['group_id']){echo 'selected';}?>><?php  echo $row_qupro1['group_name'];?></option>
		  <?php 	
		}

		//echo "SELECT * FROM s_group_typeproduct ORDER BY group_name ASC";
	}
	
	if($_GET['action'] == 'getpod'){
		$group_id = $_REQUEST['group_id'];
		$group_name = $_REQUEST['group_name'];
		$protype = $_REQUEST['protype'];
		
		$qupros1 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
		while($row_qupros1 = @mysqli_fetch_array($qupros1)){
		  ?>
			<option value="<?php  echo $row_qupros1['group_name'];?>" <?php  if($group_id == $row_qupros1['group_id']){echo 'selected';}?>><?php  echo $row_qupros1['group_name'];?></option>
		  <?php 	
		}

		//echo "SELECT * FROM s_group_typeproduct ORDER BY group_name ASC";
	}

	

?>


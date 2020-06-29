<?php 
	include_once("../../include/aplication_top.php");
	header("Content-type: text/html; charset=windows-874");
	header("Cache-Control: no-cache, must-revalidate");
	@mysqli_query($conn,"SET NAMES tis620");
	
	if($_GET['action'] == 'getcusfirsh'){
		$fpid = $_GET['pid'];
		$rowcus  = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_first_order WHERE fo_id  = '".$fpid."'"));
		
//		$prolist = get_profirstorder($conn,$fpid);
//		//$lispp = explode(",",$prolist);
//		$plid = "<select name=\"bbfpro\" id=\"bbfpro\" onchange=\"get_podsn(this.value,'lpa1','lpa2','lpa3','".$fpid."')\">
//						<option value=\"\"><<== Select ==>></option>       
//					 ";
//		for($i=0;$i<count($prolist);$i++){
//			$plid .= "<option value=".$i.">".get_proname($conn,$prolist[$i])."</option>";
//		}	
//		$plid .=	 "</select>";
//		
		$ctyp = '';
		$qu_province = @mysqli_query($conn,"SELECT * FROM s_province ORDER BY province_name ASC");
			while($row_province = @mysqli_fetch_array($qu_province)){
					$ctyp .= "<option value=".$row_province['province_id']." ";
					if($row_province['province_id'] == $rowcus['cd_province']){$ctyp .= "selected=selected";}
					$ctyp .= ">".$row_province['province_name']."</option>";
					
			}

		$displ = "|".$rowcus['cd_address']."|".$ctyp."|".$rowcus['cd_tel']."|".$rowcus['cd_fax']."|".$rowcus['c_contact']."|".$rowcus['c_tel'];
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
		//echo "SELECT cd_name FROM s_quotation4 ".$consd." ORDER BY cd_name ASC";
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
		//echo "SELECT cd_name FROM s_quotation4 ".$consd." ORDER BY cd_name ASC";
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


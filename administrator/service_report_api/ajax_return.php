<?php
	include_once("../../include/aplication_top.php");
	header("Content-type: text/html; charset=utf8");
	header("Cache-Control: no-cache, must-revalidate");
	@mysqli_query($conn,"SET NAMES  UTF8");
	
	if($_GET['action'] == 'getprodetail'){
		
			$pid = $_GET['pid'];
			$fid = $_GET['fid'];
			
			$prolistname = get_profirstorder($conn,$fid);
			$prolistpod = get_podfirstorder($conn,$fid);
			$prolistsn = get_snfirstorder($conn,$fid);
			
			echo '<input type="text" name="loc_pro" value="'.get_proname($conn,$prolistname[$pid]).'" id="loc_pro" class="inpfoder" style="width:50%;">|<input type="text" name="loc_seal" value="'.$prolistpod[$pid].'" id="loc_seal" class="inpfoder" style="width:20%;">|<input type="text" name="loc_sn" value="'.$prolistsn[$pid].'" id="loc_sn" class="inpfoder" style="width:20%;">';
	}
	
		if($_GET['action'] == 'getcusfirsh'){
		$fpid = $_GET['pid'];
		$rowcus  = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_first_order WHERE fo_id  = '".$fpid."'"));
		
		$prolist = get_profirstorder($conn,$fpid);
		//$lispp = explode(",",$prolist);
		$plid = "<select name=\"bbfpro\" id=\"bbfpro\" onchange=\"get_podsn(this.value,'lpa1','lpa2','lpa3','".$fpid."')\">
						<option value=\"\"><<== Select ==>></option>       
					 ";
		for($i=0;$i<count($prolist);$i++){
			$plid .= "<option value=".$i.">".get_proname($conn,$prolist[$i])."</option>";
		}	
		$plid .=	 "</select>";
		
		$qu_cusftype2 = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
			while($row_cusftype2 = @mysqli_fetch_array($qu_cusftype2)){
					$ctyp .= "<option value=".$row_cusftype2['group_id']." ";
					if($row_cusftype2['group_id'] == $rowcus['ctype']){$ctyp .= "selected=selected";}
					$ctyp .= ">".$row_cusftype2['group_name']."</option>";
					
			}
			
		if($rowcus['feeder'] == 1){
			$feeder = "เครื่องป้อนเกาหลี (".$rowcus['feeder_type'].")";
		}else if($rowcus['feeder'] == 2){
			$feeder = "เครื่องป้อน DC906 (".$rowcus['feeder_type2'].")";
		}else{
			$feeder = "";
		}
		
		$displ = $rowcus['cd_address']."|".province_name($conn,$rowcus['cd_province'])."|".$rowcus['cd_tel']."|".$rowcus['cd_fax']."|".$rowcus['fs_id']."|".format_date($conn,$rowcus['date_quf'])."||".$rowcus['c_contact']."|".$rowcus['c_tel']."|".$rowcus['loc_name']."|".get_lastservice_s($conn,$fpid,"").'|'.$plid.'|'.$ctyp.'|'.$feeder;
		echo $displ;
	}
	
	if($_GET['action'] == 'getcus'){
		$cd_name = $_REQUEST['pval'];
		if($cd_name != ""){
			$consd = "WHERE cd_name LIKE '%".$cd_name."%'";
		}
		$qu_cus = mysqli_query($conn,"SELECT fo_id,cd_name,loc_name FROM s_first_order ".$consd." ORDER BY cd_name ASC");
		while($row_cusx = @mysqli_fetch_array($qu_cus)){
			?>
			 <tr>
				<td><A href="javascript:void(0);" onclick="get_customer('<?php echo $row_cusx['fo_id'];?>','<?php echo $row_cusx['cd_name'];?>');"><?php echo $row_cusx['cd_name'];?> (<?php echo $row_cusx['loc_name']?>)</A></td>
			  </tr>
			<?php	
		}
		//echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
	}

?>


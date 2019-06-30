<?php
	include_once ("../../include/config.php");
	include_once ("../../include/connect.php");
	include_once ("../../include/function.php");
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
		
		$displ = $rowcus['cd_address']."|".province_name($conn,$rowcus['cd_province'])."|".$rowcus['cd_tel']."|".$rowcus['cd_fax']."|".$rowcus['fs_id']."|".format_date($conn,$rowcus['date_quf'])."||".$rowcus['c_contact']."|".$rowcus['c_tel']."|".$rowcus['loc_name']."|".get_lastservice_s($conn,$fpid,"").'|'.$plid.'|'.$ctyp;
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
	
	if($_GET['action'] == 'getsparpart'){
		$cd_name = $_REQUEST['pval'];
		if($cd_name != ""){
			$consd = "WHERE (group_spar_id LIKE '%".$cd_name."%' OR group_name LIKE '%".$cd_name."%')";
		}
		$qu_cus = mysqli_query($conn,"SELECT * FROM s_group_sparpart ".$consd." ORDER BY group_spar_id ASC");
		while($row_cusx = @mysqli_fetch_array($qu_cus)){
			?>
			 <tr>
				<td><A href="javascript:void(0);" onclick="get_sparactive('<?php echo $row_cusx['group_id'];?>','codes<?php echo $_REQUEST['resdata']?>','listss<?php echo $_REQUEST['resdata']?>','units<?php echo $_REQUEST['resdata']?>','prices<?php echo $_REQUEST['resdata']?>','amounts<?php echo $_REQUEST['resdata']?>','<?php echo $_REQUEST['resdata']?>');"><?php echo $row_cusx['group_spar_id'].'&nbsp;&nbsp;'.$row_cusx['group_name'];?></A></td>
			  </tr>
			<?php	
		}
		//echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
	}
	
	if($_GET['action'] == 'getsparactive'){
		$sparval = $_REQUEST['spid'];
		$ressdata = $_REQUEST['resdata'];
		$qu_spare = @mysqli_query($conn,"SELECT * FROM s_group_sparpart  WHERE  group_id = '".$sparval."'");
		$row_spare = @mysqli_fetch_array($qu_spare);
		
		$selclist = "<select name=\"lists[]\" id=\"lists".$ressdata."\" class=\"inputselect\" style=\"width:92%\" onchange=\"showspare(this.value,'codes".$ressdata."','units".$ressdata."','prices".$ressdata."','amounts".$ressdata."')\">";
                	$qucgspare = @mysqli_query($conn,"SELECT * FROM s_group_sparpart ORDER BY group_name ASC");
					while($row_spares = @mysqli_fetch_array($qucgspare)){
						$selclist .= "<option value=\"".$row_spares['group_id']."\"";
						if($sparval == $row_spares['group_id']){$selclist .= "selected=selected";}
						$selclist .= ">".$row_spares['group_name']."</option>";
					}
           $selclist .= "</select>";
		   
		//   $selclist = 'mkung';
		   
		$res_spares = "".'|'.$row_spare['group_spar_id'].'|'.$selclist.'|'.$row_spare['group_namecall'].'|'.$row_spare['group_price'].'|'.$row_spare['group_stock'];
		echo $res_spares;
	}
	
	if($_GET['action'] == 'getspare'){
		$sparval = $_REQUEST['sval'];
		$qu_spare = @mysqli_query($conn,"SELECT * FROM s_group_sparpart  WHERE  group_id = '".$sparval."'");
		$row_spare = @mysqli_fetch_array($qu_spare);
		$res_spare = " ".'|'.$row_spare['group_spar_id'].'|'.$row_spare['group_namecall'].'|'.$row_spare['group_price'].'|'.$row_spare['group_stock'];
		echo $res_spare;
	}

?>


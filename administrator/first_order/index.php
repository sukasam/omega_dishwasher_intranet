<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");

	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	if($_GET['action'] == "delete"){
		$code = Check_Permission($conn,$check_module,$_SESSION["login_id"],"delete");		
		if ($code == "1") {
			
		   $rowFO = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM s_first_order WHERE $PK_field = '".$_GET[$PK_field]."'"));
			
			for($i=1;$i<=7;$i++){

				if($rowFO['cpro'.$i] != ""){
					if($rowFO['camount'.$i] == ""){
						$rowFO['camount'.$i] = 0;
					}
					@mysqli_query($conn,"UPDATE `s_group_typeproduct` SET `group_stock` = `group_stock` + '".$rowFO['camount'.$i]."' WHERE `group_id` = '".$rowFO['cpro'.$i]."';");
				}
			}	
			
			$sql = "delete from $tbl_name  where $PK_field = '".$_GET[$PK_field]."'";
			@mysqli_query($conn,$sql);		
			
			setLogSystem($conn,$_SESSION["login_id"],$tbl_name,'delete',addslashes($sql));

			header ("location:index.php");
		} 
	}
	
	//-------------------------------------------------------------------------------------
	 if ($_GET['b'] != "" && $_GET['s'] != "") { 
		if ($_GET['s'] == 0) $status = 1;
		if ($_GET['s'] == 1) $status = 0;
		Check_Permission($conn,$check_module,$_SESSION['login_id'],"update");
		$sql_status = "update $tbl_name set st_setting = ".$status." where $PK_field = ".$_GET['b']."";
		@mysqli_query($conn,$sql_status);
		if($_GET['page'] != ""){$conpage = "page=".$_GET['page'];}
		header ("location:?".$conpage); 
	}
	
	//-------------------------------------------------------------------------------------
	 if ($_GET['bb'] != "" && $_GET['ss'] != "") { 
		if ($_GET['ss'] == 0) $status = 1;
		if ($_GET['ss'] == 1) $status = 0;
		Check_Permission($conn,$check_module,$_SESSION['login_id'],"update");
		$sql_status = "update $tbl_name set status = ".$status." where $PK_field = '".$_GET['bb']."'";
		@mysqli_query($conn,$sql_status);
		$sql_svstatus = "update s_service_report set st_setting = ".$status." where cus_id = '".$_GET['foid']."'";
		@mysqli_query($conn,$sql_svstatus);
		if($_GET['page'] != ""){$conpage = "page=".$_GET['page'];}
		header ("location:?".$conpage); 
	}
	
	//-------------------------------------------------------------------------------------
	 if ($_GET['ff'] != "" && $_GET['gg'] != "") { 
	
		if ($_GET['gg'] == 0) $status_use = 0;
		if ($_GET['gg'] == 1) $status_use = 1;
		
		if ($_GET['gg'] == 2) {
			$status_use = 2;
			$sql_status = "update $tbl_name set status_use = '".$status_use."',technic_service='0',type_service='0',status_use_date='".date("Y-m-d H:i:s")."' where $PK_field = '".$_GET['ff']."'";
		}else{
			$sql_status = "update $tbl_name set status_use = '".$status_use."',status_use_date='".date("Y-m-d H:i:s")."' where $PK_field = '".$_GET['ff']."'";
		}

		$code = Check_Permission($conn,"First Order Star",$_SESSION['login_id'],"update");

		if ($code == "1") {
			@mysqli_query($conn,$sql_status);
			if($_GET['page'] != ""){$conpage = "page=".$_GET['page'];}
			header ("location:?".$conpage); 
		}
		
	}

	//-------------------------------------------------------------------------------------
	if ($_GET['cc'] != "" and $_GET['tt'] != "") {
		if ($_GET['tt'] == 0) {
			$status = 1;
		}

		if ($_GET['tt'] == 1) {
			$status = 0;
		}

		Check_Permission($conn, $check_module, $_SESSION['login_id'], "update");
		$sql_status = "update $tbl_name set cuspay = " . $status . " where $PK_field = " . $_GET['cc'];
		@mysqli_query($conn, $sql_status);
		/*$sql_fostatus = "update s_first_order set status = ".$status." where fo_id = '$_GET[cus_id]'";
		@mysqli_query($conn,$sql_fostatus);*/
		$conpage = '';
		if ($_GET['page'] != "") {
			$conpage .= "page=" . $_GET['page'];
		}
		
		header("location:?" . $conpage);
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php  echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel="stylesheet" type=text/css href="../css/reset.css" media=screen>
<LINK rel="stylesheet" type=text/css href="../css/style.css" media=screen>
<LINK rel="stylesheet" type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.9.1.min.js"></SCRIPT>
<!--<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
-->
<!--<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>-->
<SCRIPT type=text/javascript src="ajax.js"></SCRIPT>

<META name=GENERATOR content="MSHTML 8.00.7600.16535">
<script>
function confirmDelete(delUrl,text) {
  if (confirm("Are you sure you want to delete\n"+text)) {
    document.location = delUrl;
  }
}
//----------------------------------------------------------
function check_select(frm){
		if (frm.choose_action.value==""){
			alert ('Choose an action');
			frm.choose_action.focus(); return false;
		}
}	
	
function selectProcess(evt){
	var process_val = document.getElementById('process_'+evt).value;
	
	if(process_val == 1){
		document.getElementById('process_'+evt).style.backgroundColor ='#FFEB3B';
	}else{
		document.getElementById('process_'+evt).style.backgroundColor ='#FFFFFF';
	}
	
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'call_api.php?action=changeProcess&id='+evt+'&process='+process_val;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 != xmlHttp.readyState=="complete"){   
			var ds = xmlHttp.responseText;
			//console.log(ds);
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}
	
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</HEAD>
<?php  include ("../../include/function_script.php"); ?>
<BODY>
<DIV id=body-wrapper>
<?php  include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php  include('../top.php');?>
<P id=page-intro><?php  echo $page_name; ?></P>

<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="update.php?mode=add<?php  if ($param != "") echo "&".$param; ?>"><SPAN><IMG  alt=icon src="../images/pencil_48.png"><BR>
    เพิ่ม</SPAN></A></LI>
  <LI><A class=shortcut-button href="../first_order2/index.php"><SPAN><IMG  alt=icon src="../images/icons/icon-48-section.png"><BR>
    Service Order</SPAN></A></LI>
    <?php  
	if ($FR_module != "") { 
	$param2 = get_return_param();
	?>
  <LI><A class=shortcut-button href="../<?php  echo $FR_module; ?>/?<?php  if($param2 != "") echo $param2;?>"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
  <?php  }?>

</UL>
 <DIV class=clear></DIV><!-- End .clear -->
  <div><strong><img src="../icons/favorites_use.png" width="15" height="15"> ใช้งาน / <img src="../icons/favorites_stranby.png" width="15" height="15"> Standby / <img src="../icons/favorites_close.png" width="15" height="15"> ยกเลิก</strong></div><br><br>
  <!-- End .shortcut-buttons-set -->
<DIV class=clear></DIV><!-- End .clear -->

<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right" style="padding-right:15px;">

<H3 align="left"><?php  echo $check_module; ?></H3>
<br>
  <div style="float:right;">
   <form name="form1" method="get" action="index.php">
    <input name="keyword" type="text" id="keyword" value="<?php  echo $keyword;?>">
    <input name="Action" type="submit" id="Action" value="ค้นหา">
    <?php 
			$a_not_exists = array('keyword');
			$param2 = get_param($a_param,$a_not_exists);
			  ?>
    <a href="index.php?<?php  echo $param2;?>">แสดงทั้งหมด</a>
    <?php  
			/*$a_not_exists = array();
			post_param($a_param,$a_not_exists);*/
			?>
  </form>
  </div>
  <div style="float:right;margin-right:20px;">  
	<label><strong>สถานะการอนุมัติ : </strong></label>
    <select name="catalog_master" id="catalog_master" style="height:24px;" onChange="MM_jumpMenu('parent',this,0)">
         <option value="index.php" <?php  if(!isset($_GET['process'])){echo "selected";}?>>กรุณาเลือก</option>
		 <option value="index.php?process=0" <?php  if($_GET['process'] == '0'){echo "selected";}?>>รอการแก้ไข</option>
		 <option value="index.php?process=1" <?php  if($_GET['process'] == '1'){echo "selected";}?>>รอผู้อนุมัติฝ่ายขาย</option>
         <option value="index.php?process=2" <?php  if($_GET['process'] == '2'){echo "selected";}?>>รอผู้อนุมัติฝ่ายการเงิน</option>
         <option value="index.php?process=3" <?php  if($_GET['process'] == '3'){echo "selected";}?>>รอผู้มีอำนาจลงนาม</option>
         <option value="index.php?process=4" <?php  if($_GET['process'] == '4'){echo "selected";}?>>รอผู้อนุมัติฝ่ายช่าง</option>
         <option value="index.php?process=5" <?php  if($_GET['process'] == '5'){echo "selected";}?>>ผ่านการอนุมัติ</option>
  	</select>
    </div>
<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
  <form name="form2" method="post" action="confirm.php" onSubmit="return check_select(this)">
    <TABLE>
      <THEAD>
        <TR>
<!--          <TH width="5%"><INPUT class=check-all type=checkbox name="ca" value="true" onClick="chkAll(this.form, 'del[]', this.checked)"></TH>-->
<!--
          <TH width="5%" <?php  Show_Sort_bg ("user_id", $orderby) ?>> <?php 
		$a_not_exists = array('orderby','sortby');
		$param2 = get_param($a_param,$a_not_exists);
	?>
            <?php   Show_Sort_new ("user_id", "ลำดับ.", $orderby, $sortby,$page,$param2);?>
            &nbsp;</TH>
-->
          <TH width="12%"><center>การอนุมัติ</center></TH>
<!--          <TH width="12%"><center>QR Code</center></TH>-->
          <TH width="12%"><center>FO ID</center></TH>
          <TH width="35%">ชื่อลูกค้า</TH>
          <!-- <TH width="18%"><strong>สถานที่ติดตั้ง</strong></TH> -->
          <TH width="5%" nowrap ><div align="center"><a>แจ้งงาน</a></div></TH>
          <TH width="5%" nowrap ><div align="center"><a>Memo</a></div></TH>
          <TH width="5%" nowrap ><div align="center"><a>เอกสาร</a></div></TH>
          <TH width="10%" nowrap ><div align="center">สถานะ</TH>
		  <TH width="8%" nowrap> <div align="center"><a>การจ่ายเงิน</a></div></TH>
<!--          <TH width="5%" nowrap ><div align="center"><a> Open / </a><a> Close</a></div></TH>-->
<!--          <TH width="5%" nowrap ><div align="center"><a>Setting</a></div></TH>-->
<!--          <TH width="5%"><div align="center"><a>Download</a></div></TH>-->
          <TH width="5%"><a>Map</a></TH>
          <!-- <TH width="5%"><a></a></TH> -->
          <TH width="10%" style="white-space: nowrap;"><center><a>แก้ไข | ลบ</a></center></TH>
        </TR>
      </THEAD>
      <TFOOT>
        </TFOOT>
      <TBODY>
        <?php  
					if($orderby=="") $orderby = $tbl_name.".".$PK_field;
					if ($sortby =="") $sortby ="DESC";

					$conDealer = "";
					if(userGroup($conn,$_SESSION['login_id']) === "Dealer"){
						$conDealer = " AND `create_by` = '".$_SESSION['login_id']."'";
					}
					
				   	$sql = " select *,$tbl_name.create_date as c_date from $tbl_name  where 1 ".$conDealer." AND separate = 0 ";
					if ($_GET[$PK_field] != "") $sql .= " and ($PK_field  = '" . $_GET[$PK_field] . " ' ) ";					
					if ($_GET[$FR_field] != "") $sql .= " and ($FR_field  = '" . $_GET[$FR_field] . " ' ) ";					
 					if ($_GET['keyword'] != "") { 
						$sql .= "and ( " .  $PK_field  . " like '%".$_GET['keyword']."%' ";
						if (count ($search_key) > 0) { 
							$search_text = " and ( " ;
							foreach ($search_key as $key=>$value) { 
									$subtext .= "or " . $value  . " like '%" . $_GET['keyword'] . "%'";
							}	
						}
						$sql .=  $subtext . " ) ";
					} 
		  
		  			if ($_GET['process'] != "") { 
						$sql .= " and ( process = '".$_GET['process']."' ";
						$sql .=  $subtext . " ) ";
					}
		  
					if ($orderby != "") $sql .= " order by " . $orderby;
					if ($sortby != "") $sql .= " " . $sortby;
					include ("../include/page_init.php");
					//echo $sql;
					$query = @mysqli_query($conn,$sql);
					if($_GET['page'] == "") $_GET['page'] = 1;
					$counter = ($_GET['page']-1)*$pagesize;
					
					while ($rec = @mysqli_fetch_array($query)) { 
					$counter++;
				   ?>
        <TR>
<!--          <TD><INPUT type=checkbox name="del[]" value="<?php  echo $rec[$PK_field]; ?>" ></TD>-->
          <TD><center>
			  <?php
			  if($rec['process'] == '5'){
				  ?>
				  <select name="process_applove" style="background:#4CAF50;color:#000;">
				  	<option value="5" selected>ผ่านการอนุมัติ</option>
				  </select>
				  <?php
			  }else if($rec['process'] == '4'){
				  ?>
				  <select name="process_applove" style="background:#e7487e;color:#000;">
				  	<option value="4" selected>รอผู้อนุมัติฝ่ายช่าง</option>
				  </select>
				  <?php
			  }else if($rec['process'] == '3'){
				  ?>
				  <select name="process_applove" style="background:#03A9F4;color:#000;">
				  	<option value="3" selected>รอผู้มีอำนาจลงนาม</option>
				  </select>
				  <?php
			  }else if($rec['process'] == '2'){
				  ?>
				  <select name="process_applove" style="background:#FF9800;color:#000;">
				  	<option value="2" selected>รอผู้อนุมัติฝ่ายบัญชี</option>
				  </select>
				  <?php
			  }else if($rec['process'] == '1'){
				  ?>
				  <select name="process_applove" style="background:#FFEB3B;color:#000;">
				  	<option value="1" selected>รอผู้อนุมัติฝ่ายขาย</option>
				  </select>
				  <?php
			  }else{
				  ?>
				  <select name="process_applove" style="background:#FFFFFF;color:#000;" onchange="selectProcess('<?php echo $rec['fo_id'];?>')" id="process_<?php echo $rec['fo_id'];?>">
					  <option value="0" <?php if($rec['process'] == '0'){echo 'selected';}?>>รอแก้ไข FO</option>
					  <?php 
					  $chkSale = checkSaleMustApprove($conn,$rec['cs_sell']);
						  if($chkSale == 2){
					  		?>
							  <option value="2">รอผู้อนุมัติฝ่ายบัญชี</option>
							  <?php
						  }else if($chkSale == 3){
					  		?>
							  <option value="3">รอผู้มีอำนาจลงนาม</option>
							  <?php
						  }else if($chkSale == 4){
					  		?>
							  <option value="4">รอผู้อนุมัติฝ่ายช่าง</option>
							  <?php
						  }else{
							  if(checkFOInputFix($conn,$rec['fo_id']) == 0){
								  ?>
								  <option value="1">รอผู้อนุมัติฝ่ายขาย</option>
								  <?php
							  }
							  
						  }
					  ?>
					  
				  </select>
				  <?php
			  }
			  ?>
		  </center>
          </TD>
<!--          <TD><center><img src="../../qrcode_gen/qrcode.php?val=<?php echo $rec["fo_id"];?>|s_first_order|FO" width="80"></center></TD>-->
          <TD><center><?php  
          $chaf = str_replace("/","-",$rec["fs_id"]); ?>
          <span class="text"><a href="../../upload/first_order/<?php  echo $chaf;?>.pdf" target="_blank"><?php  echo $rec["fs_id"] ; ?></a></span></center></TD>
          <TD><span class="text"><?php  echo $rec["cd_name"] ; ?></span><br>
		  <strong>สถานที่ติดตั้ง : <span class="text"><?php  echo $rec["loc_name"] ; ?></span></strong>
		</TD>
          <!-- <TD></TD> -->
          <td style="vertical-align: middle;">
			  <center><a href="../quotation_jobcard/?tab=3&id=<?php  echo $rec[$PK_field]; ?>"><img src="../images/hammer_screwdriver.png" width="20" height="20"></a></center>
			  </td>
         	<td style="vertical-align: middle;">
			  <center><a href="../memo/?cus_id=<?php  echo $rec[$PK_field];?>"><img src="../images/meno.png" height="30"></a></center>
			  </td>
          <td style="vertical-align: middle;">
			  <center><a href="../document/?fo_id=<?php  echo $rec[$PK_field];?>&target=FO"><img src="../images/document.png" height="30"></a></center>
			  </td>
           <TD nowrap style="vertical-align:middle"><div align="center">
            <?php  if($rec["status_use"]==0) {?>
            <img src="../icons/favorites_use.png" width="30" height="30">
            <?php  } elseif($rec["status_use"]==2) {?>
            <img src="../icons/favorites_close.png" width="30" height="30">
            <?php  } else{?>
            <img src="../icons/favorites_stranby.png" width="30" height="30">
            <?php  }?>
            <div align="center" style="padding-top:5px;">
            <a href="../first_order/?ff=<?php  echo $rec[$PK_field]; ?>&gg=0&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/favorites_use.png" width="15" height="15"> | </a>
            <a href="../first_order/?ff=<?php  echo $rec[$PK_field]; ?>&gg=1&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/favorites_stranby.png" width="15" height="15"> | </a>
            <a href="../first_order/?ff=<?php  echo $rec[$PK_field]; ?>&gg=2&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/favorites_close.png" width="15" height="15"></a>
            </div>
          </div></TD>
		  <TD style="vertical-align:middle">
			<div align="center">
				<?php if ($rec["cuspay"] == 0) {?>
				<a href="../first_order/?cc=<?php echo $rec[$PK_field]; ?>&tt=<?php echo $rec["cuspay"]; ?>&page=<?php echo $_GET['page']; ?>&<?php echo $FK_field; ?>=<?php echo $_REQUEST["$FK_field"]; ?>&cus_id=<?php echo $rec["cus_id"]; ?>"><img src="../images/icons/check0.gif" width="15" height="15"></a>
				<?php } else {?>
				<a href="../first_order/?cc=<?php echo $rec[$PK_field]; ?>&tt=<?php echo $rec["cuspay"]; ?>&page=<?php echo $_GET['page']; ?>&<?php echo $FK_field; ?>=<?php echo $_REQUEST["$FK_field"]; ?>&cus_id=<?php echo $rec["cus_id"]; ?>"><img src="../images/icons/check1.gif" width="15" height="15"></a>
				<?php }?>
			</div>
			</TD>
<!--
          <TD nowrap style="vertical-align:middle">
          <div align="center"><A href="service_close.php?fo_id=<?php  echo $rec["fo_id"];?>"><IMG  alt=icon src="../images/icons/icon-48-install.png"></A></div>
          </TD>
-->
<!--
          <TD nowrap style="vertical-align:middle"><div align="center">
            <?php  if($rec["st_setting"]==0) {?>
            <a href="../first_order/?b=<?php  echo $rec[$PK_field]; ?>&s=<?php  echo $rec["st_setting"]; ?>&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/status_on.gif" width="10" height="10"></a>
            <?php  } else{?>
            <a href="../first_order/?b=<?php  echo $rec[$PK_field]; ?>&s=<?php  echo $rec["st_setting"]; ?>&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/status_off.gif" width="10" height="10"></a>
            <?php  }?>
          </div></TD>
-->
<!--          <TD><div align="center"><a href="../../upload/first_order/<?php  echo $chaf;?>.pdf" target="_blank"><img src="../images/icon2/download_f2.png" width="20" height="20" border="0" alt=""></a></div></TD>-->
            <TD style="vertical-align: middle;">
          <div align="center">
            <?php if($rec["google_map"] != ""){
					  ?>
					  <a href="<?php echo $rec["google_map"];?>" target="_blank"><img src="../images/google_map.png" width="25"></a>
					  <?php 
				   }else{
					   echo "-";
				   }?>
          	
          </div></TD>
          <!-- <TD>
            </TD> -->
          <TD ><center><A title=Edit href="update.php?mode=update&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field]; if($param != "") {?>&<?php  echo $param; }?>"><IMG alt=Edit src="../images/pencil.png"></A> <A title=Delete  href="#"></A> | <A title=Delete  href="#"><IMG alt=Delete src="../images/cross.png" onClick="confirmDelete('?action=delete&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field];?>','Group  <?php  echo $rec[$PK_field];?> : <?php  echo $rec["group_name"];?>')"></A></center></TD>
        </TR>  
		<?php  }?>
      </TBODY>
    </TABLE>
    <br><br>
    <DIV class="bulk-actions align-left">
<!--
            <SELECT name="choose_action" id="choose_action">
              <OPTION selected value="">กรุณาเลือก...</OPTION>
              <OPTION value="del">ลบ</OPTION>
            </SELECT>            
-->
            <?php 
				$a_not_exists = array();
				post_param($a_param,$a_not_exists); 
			?>
<!--            <input class=button name="Action2" type="submit" id="Action2" value="ตกลง">-->
          </DIV> <DIV class=pagination> <?php  include("../include/page_show.php");?> </DIV>
  </form>  
</DIV><!-- End #tab1 -->


</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php  include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
</BODY>
</HTML>

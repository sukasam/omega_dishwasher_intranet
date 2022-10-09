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
			$sql = "delete from $tbl_name  where $PK_field = '$_GET[$PK_field]'";
			@mysqli_query($conn,$sql);	
			
			$sql2 = "UPDATE `s_quotation2` SET `quotation` = '' WHERE `quotation` = ".$_GET[$PK_field].";";
			@mysqli_query($conn,$sql2);	
			//exit();
			
			header ("location:index.php");
		} 
	}

	if($_GET['action'] == "createQA"){
		$sql = "SELECT * FROM s_quotation where qu_id = '".$_GET['id']."'";
		$query = mysqli_query($conn,$sql);
		$recQa = mysqli_fetch_array($query);

		$fs_idQA = check_quotation2($conn);
		
		@mysqli_query($conn,"INSERT INTO 
									`s_quotation2` (`cd_name`,`cd_address`,`cd_province`,`cd_tel`,`cd_fax`,`fs_id`,`date_forder`,`pro_type`,
									`pro_pod1`,`pro_pod2`,`pro_pod3`,`pro_pod4`,`pro_pod5`,`pro_pod6`,`pro_pod7`,
									`pro_sn1`,`pro_sn2`,`pro_sn3`,`pro_sn4`,`pro_sn5`,`pro_sn6`,`pro_sn7`,
									`c_contact`,`c_tel`,`cpro1`,`cpro2`,`cpro3`,`cpro4`,`cpro5`,`cpro6`,`cpro7`,
									`camount1`,`camount2`,`camount3`,`camount4`,`camount5`,`camount6`,`camount7`,
									`cprice1`,`cprice2`,`cprice3`,`cprice4`,`cprice5`,`cprice6`,`cprice7`,
									`cs_pro1`,`cs_pro2`,`cs_pro3`,`cs_pro4`,`cs_pro5`,
									`cs_amount1`,`cs_amount2`,`cs_amount3`,`cs_amount4`,`cs_amount5`,
									`cs_sell`,`cs_hsell`,`cs_account`,`spro1`,`remark`,`st_setting`,`type_service`,
									`payc`,`paym`,`pay_apv`,`pays`,`paysa`,`paysad`,`type_electric`,`giveprice`,
									`guaran2`,`date_sell`,`create_by`) 
									VALUES 
									('".$recQa['cd_name']."','".$recQa['cd_address']."','".$recQa['cd_province']."','".$recQa['cd_tel']."','".$recQa['cd_fax']."','".$fs_idQA."','".$recQa['date_forder']."','".$recQa['pro_type']."',
									'".$recQa['pro_pod1']."','".$recQa['pro_pod2']."','".$recQa['pro_pod3']."','".$recQa['pro_pod4']."','".$recQa['pro_pod5']."','".$recQa['pro_pod6']."','".$recQa['pro_pod7']."',
									'".$recQa['pro_sn1']."','".$recQa['pro_sn2']."','".$recQa['pro_sn3']."','".$recQa['pro_sn4']."','".$recQa['pro_sn5']."','".$recQa['pro_sn6']."','".$recQa['pro_sn7']."',
									'".$recQa['c_contact']."','".$recQa['c_tel']."','".$recQa['cpro1']."','".$recQa['cpro2']."','".$recQa['cpro3']."','".$recQa['cpro4']."','".$recQa['cpro5']."','".$recQa['cpro6']."','".$recQa['cpro7']."',
									'".$recQa['camount1']."','".$recQa['camount2']."','".$recQa['camount3']."','".$recQa['camount4']."','".$recQa['camount5']."','".$recQa['camount6']."','".$recQa['camount7']."',
									'".$recQa['cprice1']."','".$recQa['cprice2']."','".$recQa['cprice3']."','".$recQa['cprice4']."','".$recQa['cprice5']."','".$recQa['cprice6']."','".$recQa['cprice7']."',
									'".$recQa['cs_pro1']."','".$recQa['cs_pro2']."','".$recQa['cs_pro3']."','".$recQa['cs_pro4']."','".$recQa['cs_pro5']."',
									'".$recQa['cs_amount1']."','".$recQa['cs_amount2']."','".$recQa['cs_amount3']."','".$recQa['cs_amount4']."','".$recQa['cs_amount5']."',
									'".$recQa['cs_sell']."','".$recQa['cs_hsell']."','".$recQa['cs_account']."','ค่าบริการขนส่ง/ติดตั้ง','".$recQa['remark']."','".$recQa['st_setting']."','".$recQa['type_service']."',
									'".$recQa['payc']."','".$recQa['paym']."','".$recQa['pay_apv']."','".$recQa['pays']."','".$recQa['paysa']."','".$recQa['paysad']."','".$recQa['type_electric']."','".$recQa['giveprice']."',
									'".$recQa['guaran2']."','".$recQa['date_sell']."','".$_SESSION['login_id']."'
									);");
		
		$idQa = mysqli_insert_id($conn);
		
		mysqli_query($conn,"UPDATE `s_quotation2` SET `quotation` = '".$_GET['id']."' WHERE `qu_id` = ".$idQa.";");
		mysqli_query($conn,"UPDATE `s_quotation` SET `quotation` = '".$idQa."' WHERE `qu_id` = ".$_GET['id'].";");
		
		header ("location:index.php");
		//exit();
	}
	
	//-------------------------------------------------------------------------------------
	 if ($_GET['b'] <> "" and $_GET['s'] <> "") { 
		if ($_GET['s'] == 0) $status = 1;
		if ($_GET['s'] == 1) $status = 0;
		Check_Permission($conn,$check_module,$_SESSION['login_id'],"update");
		$sql_status = "update $tbl_name set st_setting = ".$status." where $PK_field = ".$_GET['b']."";
		@mysqli_query($conn,$sql_status);
		 
		if($_GET['page'] != ""){$conpage = "page=".$_GET['page'];}
		 
		 $sql = "select * from $tbl_name where $PK_field = ".$_GET['b']."";
			$query = @mysqli_query($conn,$sql);
			while ($rec = @mysqli_fetch_array($query)) {
				$$PK_field = $rec[$PK_field];
				foreach ($fieldlist as $key => $value) {
					$$value = $rec[$value];
				}
			}
		
		if($status == 1){
			$foid = check_firstorder($conn);
			
			@mysqli_query($conn,"INSERT INTO `s_first_order` (`fo_id`, `cd_name`, `cd_address`, `cd_province`, `cd_tel`, `cd_fax`, `fs_id`, `date_forder`, `cg_type`, `ctype`, `pro_type`, `po_id`, `pro_sn1`, `pro_sn2`, `pro_sn3`, `pro_sn4`, `pro_sn5`, `pro_sn6`, `pro_sn7`, `c_contact`, `c_tel`, `cpro1`, `cpro2`, `cpro3`, `cpro4`, `cpro5`, `cpro6`, `cpro7`, `camount1`, `camount2`, `camount3`, `camount4`, `camount5`, `camount6`, `camount7`, `cprice1`, `cprice2`, `cprice3`, `cprice4`, `cprice5`, `cprice6`, `cprice7`, `cs_pro1`, `cs_pro2`, `cs_pro3`, `cs_pro4`, `cs_pro5`, `cs_amount1`, `cs_amount2`, `cs_amount3`, `cs_amount4`, `cs_amount5`, `type_service`, `cs_sell`, `cs_ship`, `cs_setting`, `date_quf`, `date_qut`) VALUES (NULL, '".$cd_name."', '".$cd_address."', '".$cd_province."', '".$cd_tel."', '".$cd_fax."', '".$foid."','".$date_forder."','17','16', '".$pro_type."', '".$fs_id."', '".$pro_sn1."', '".$pro_sn2."', '".$pro_sn3."', '".$pro_sn4."', '".$pro_sn5."', '".$pro_sn6."', '".$pro_sn7."', '".$c_contact."', '".$c_tel."', '".$cpro1."', '".$cpro2."', '".$cpro3."', '".$cpro4."', '".$cpro5."', '".$cpro6."', '".$cpro7."', '".$camount1."', '".$camount2."', '".$camount3."', '".$camount4."', '".$camount5."', '".$camount6."', '".$camount7."', '".$cprice1."', '".$cprice2."', '".$cprice3."', '".$cprice4."', '".$cprice5."', '".$cprice6."', '".$cprice7."', '".$cs_pro1."', '".$cs_pro2."', '".$cs_pro3."', '".$cs_pro4."', '".$cs_pro5."', '".$cs_amount1."', '".$cs_amount2."', '".$cs_amount3."', '".$cs_amount4."', '".$cs_amount5."', '".$type_service."', '".$cs_sell."','".$date_forder."','".$date_forder."','".$date_forder."','".$date_forder."');");

		}else{
			echo "DELETE FROM `s_first_order` WHERE `po_id` = '".$fs_id."'";
			@mysqli_query($conn,"DELETE FROM `s_first_order` WHERE `po_id` = '".$fs_id."'");
		}

		header ("location:?".$conpage); 
	}
	
	
	//-------------------------------------------------------------------------------------
	 if ($_GET[ff] <> "" and $_GET[gg] <> "") { 
		if ($_GET[gg] == 0) $status_use = 0;
		if ($_GET[gg] == 1) $status_use = 1;
		if ($_GET[gg] == 2) $status_use = 2;
		Check_Permission($conn,$check_module,$_SESSION['login_id'],"update");
		$sql_status = "update $tbl_name set status_use = '$status_use' where $PK_field = '$_GET[ff]'";
		@mysqli_query($conn,$sql_status);
		
		if($_GET['page'] != ""){$conpage = "page=".$_GET['page'];}
		header ("location:?".$conpage); 
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
<!--
<!--<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>-->
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
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
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
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
  <LI><A class=shortcut-button href="update.php?mode=add<?php  if ($param <> "") echo "&".$param; ?>"><SPAN><IMG  alt=icon src="../images/pencil_48.png"><BR>
    เพิ่ม</SPAN><br></A></LI>
    <LI><A class=shortcut-button href="../quotation/"><SPAN><IMG  alt=icon src="../images/paper_content_pencil_48.png"><BR>
    ใบเสนอราคา<br>ซื้อ</SPAN></A></LI>
    <LI><A class=shortcut-button href="../quotation2/"><SPAN><IMG  alt=icon src="../images/paper_content_pencil_48.png"><BR>
    ใบเสนอราคา<br>เช่า</SPAN></A></LI>
    <LI><A class=shortcut-button href="../quotation3/"><SPAN><IMG  alt=icon src="../images/paper_content_pencil_48.png"><BR>
    ใบเสนอราคา<br>ซ่อม</SPAN></A></LI>
    <LI><A class=shortcut-button href="../quotation4/"><SPAN><IMG  alt=icon src="../images/paper_content_pencil_48.png"><BR>
    ใบเสนอราคาสัญญาบริการ</SPAN></A></LI>
    <?php  
	if ($FR_module <> "") { 
	$param2 = get_return_param();
	?>
  <LI><A class=shortcut-button href="../<?php  echo $FR_module; ?>/?<?php  if($param2 <> "") echo $param2;?>"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
  <?php  }?>

</UL>
  
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
	<label><strong>แยกตามชื่อพนักงานขาย : </strong></label>
    <select name="catalog_sale" id="catalog_sale" style="height:24px;" onChange="MM_jumpMenu('parent',this,0)">
    <option value="index.php" <?php  if(!isset($_GET['sale_id'])){echo "selected";}?>>กรุณาเลือก</option>
	<?php
		$qusaletype = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");
		while($row_saletype = @mysqli_fetch_array($qusaletype)){
		  ?>
			<option value="index.php?sale_id=<?php  echo $row_saletype['group_id'];?>" <?php  if($_GET['sale_id'] == $row_saletype['group_id']){echo 'selected';}?>><?php  echo $row_saletype['group_name'];?></option>
		  <?php
		}
	?>
  	</select>
    </div>
    <div style="float:right;margin-right:20px;">  
	<label><strong>สถานะการอนุมัติ : </strong></label>
    <select name="catalog_master" id="catalog_master" style="height:24px;" onChange="MM_jumpMenu('parent',this,0)">
		 <option value="index.php" <?php  if(!isset($_GET['process'])){echo "selected";}?>>กรุณาเลือก</option>
		 <option value="index.php?process=0" <?php  if($_GET['process'] == '0'){echo "selected";}?>>รอการแก้ไข</option>
		 <option value="index.php?process=1" <?php  if($_GET['process'] == '1'){echo "selected";}?>>รอผู้อนุมัติฝ่ายขาย</option>
<!--
         <option value="index.php?process=2" <?php  if($_GET['process'] == '2'){echo "selected";}?>>รอผู้อนุมัติฝ่ายการเงิน</option>
         <option value="index.php?process=3" <?php  if($_GET['process'] == '3'){echo "selected";}?>>รอผู้มีอำนาจลงนาม</option>
-->
<!--         <option value="index.php?process=4" <?php  if($_GET['process'] == '4'){echo "selected";}?>>รอผู้อนุมัติฝ่ายช่าง</option>-->
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
          <TH width="5%"><center>การอนุมัติ</center></TH>
          <TH width="12%"><center>QA ID</center></TH>
          <TH width="35%">ชื่อลูกค้า</TH>
<!--          <TH width="18%"><strong>สถานที่ติดตั้ง</strong></TH>-->
<!--          <TH width="5%" nowrap ><div align="center"><img src="../icons/favorites_use.png" width="15" height="15"> ใช้งาน / <img src="../icons/favorites_stranby.png" width="15" height="15"> Standby / <img src="../icons/favorites_close.png" width="15" height="15"> ยกเลิก</div></TH>-->
		  <TH width="5%" nowrap ><div align="center"><a>ใบแจ้งงาน</a></div></TH>
          <TH width="5%" nowrap ><div align="center"><a>เปิด QA เช่า</a></div></TH> 
          <TH width="5%" nowrap ><div align="center"><a>สร้าง FO</a></div></TH>
          <TH width="5%" style="white-space: nowrap;"><div align="center"><a>ดาวโหลด</a></div></TH>
          <TH width="5%"><a>แก้ไข</a></TH>
          <TH width="5%"><a>ลบ</a></TH>
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
					
				   	$sql = " select *,$tbl_name.create_date as c_date from $tbl_name  where 1 ".$conDealer;
					if ($_GET[$PK_field] <> "") $sql .= " and ($PK_field  = '" . $_GET[$PK_field] . " ' ) ";					
					if ($_GET[$FR_field] <> "") $sql .= " and ($FR_field  = '" . $_GET[$FR_field] . " ' ) ";					
 					if ($_GET['keyword'] <> "") { 
						$sql .= "and ( " .  $PK_field  . " like '%".$_GET['keyword']."%' ";
						if (count ($search_key) > 0) { 
							$search_text = " and ( " ;
							foreach ($search_key as $key=>$value) { 
									$subtext .= " or " . $value  . " like '%" . $_GET['keyword'] . "%'";
							}	
						}
						$sql .=  $subtext . " ) ";
					} 
		  
		  			if ($_GET['process'] <> "") { 
						$sql .= " and ( process = '".$_GET['process']."' ";
						$sql .=  $subtext . " ) ";
					}
		  
		  			if ($_GET['sale_id'] <> "") { 
						$sql .= " and ( cs_sell = '".$_GET['sale_id']."' ";
						$sql .=  $subtext . " ) ";
					}
		  
					if ($orderby <> "") $sql .= " order by " . $orderby;
					if ($sortby <> "") $sql .= " " . $sortby;
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
          <TD>
          <center>
			  <?php
			  if($rec['process'] == '5'){
				  ?>
				  <select name="process_applove" style="background:#4CAF50;color:#000;">
				  	<option value="5" selected>ผ่านการอนุมัติ</option>
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
				  <select name="process_applove" style="background:#FFFFFF;color:#000;" onchange="selectProcess('<?php echo $rec['qu_id'];?>')" id="process_<?php echo $rec['qu_id'];?>">
					  <option value="0" <?php if($rec['process'] == '0'){echo 'selected';}?>>รอแก้ไข QA</option>
					  <option value="1">รอผู้อนุมัติฝ่ายขาย</option>
				  </select>
				  <?php
			  }
			  ?>
		  </center>
          </TD>
          <TD><center><?php  $chaf = str_replace("/","-",$rec["fs_id"]); ?><span class="text"><a href="../../upload/quotation/<?php  echo $chaf;?>.pdf" target="_blank"><?php  echo $rec["fs_id"] ; ?></a></span></center></TD>
          <TD>          <span class="text"><?php  echo $rec["cd_name"] ; ?></span></TD>
			  <td>
			  	<center><a href="../quotation_jobcard/?tab=1&id=<?php  echo $rec[$PK_field]; ?>"><img src="../images/hammer_screwdriver.png" width="20" height="20"></a></center>
			  </td>
					<TD style="text-align: center;"><?php
						if($rec["quotation"] != "" && $rec["quotation"] != "0"){
							$chafQA = str_replace("/","-",getQaHNumber($conn,$rec["quotation"]));
							?>
							<a href="../quotation2/update.php?mode=update&qu_id=<?php echo $rec["quotation"];?>"><?php echo getQaHNumber($conn,$rec["quotation"]);?></a> 
							<?php 
							$file_pointer = '../../upload/quotation/'.$chafQA.'.pdf';
							if (file_exists($file_pointer)) {
									?>
									| <a href="../../upload/quotation/<?php  echo $chafQA;?>.pdf" target="_blank"><img src="../images/icon2/download_f2.png" width="20" height="20"></a>
									<?php
							}
							?>
							<?php
						}else{
							?>
							<a href="../quotation/?action=createQA&id=<?php  echo $rec[$PK_field]; ?>"><img src="../images/paper_content_pencil_48.png" width="20" height="20"></a>
							<?php
						}
					?></TD>
					<TD nowrap style="vertical-align:middle;display: none;"><div align="center">
            <?php  if($rec["status_use"]==0) {?>
            <img src="../icons/favorites_use.png" width="15" height="15">
            <?php  } elseif($rec["status_use"]==2) {?>
            <img src="../icons/favorites_close.png" width="15" height="15">
            <?php  } else{?>
            <img src="../icons/favorites_stranby.png" width="15" height="15">
            <?php  }?>
            <div align="center" style="padding-top:5px;">
            <a href="../quotation/?ff=<?php  echo $rec[$PK_field]; ?>&gg=0&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/favorites_use.png" width="15" height="15"> | </a>
            <a href="../quotation/?ff=<?php  echo $rec[$PK_field]; ?>&gg=1&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/favorites_stranby.png" width="15" height="15"> | </a>
            <a href="../quotation/?ff=<?php  echo $rec[$PK_field]; ?>&gg=2&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/favorites_close.png" width="15" height="15"></a>
            </div>
          </div></TD>
          <TD nowrap style="vertical-align:middle;display: none;"><!--<div align="center">
            <?php  if($rec["status"]==0) {?>
            <a href="../quotation/?bb=<?php  echo $rec[$PK_field]; ?>&ss=<?php  echo $rec["status"]; ?>&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>&foid=<?php  echo $rec["qu_id"]; ?>"><img src="../icons/status_on.gif" width="10" height="10"></a>
            <?php  } else{?>
            <a href="../quotation/?bb=<?php  echo $rec[$PK_field]; ?>&ss=<?php  echo $rec["status"]; ?>&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>&foid=<?php  echo $rec["qu_id"]; ?>"><img src="../icons/status_off.gif" width="10" height="10"></a>
            <div align="center"><a href="../../upload/service_report_close/<?php  echo get_srreport($conn,$rec["fs_id"]);?>.pdf" target="_blank"><p style="background:#999;color:#FFFFFF;padding:2px;"><?php  echo get_srreport($conn,$rec["qu_id"]);?></p></a></div>
            <?php  }?>
          </div>-->
          <div align="center"><A href="service_close.php?qu_id=<?php  echo $rec["qu_id"];?>"><IMG  alt=icon src="../images/icons/icon-48-install.png"></A></div>
          </TD>
          <TD nowrap style="vertical-align:middle"><div align="center">
            <?php  if($rec["st_setting"]==0) {?>
            <a href="../quotation/?b=<?php  echo $rec[$PK_field]; ?>&s=<?php  echo $rec["st_setting"]; ?>&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/status_off.gif" width="10" height="10"></a>
            <?php  } else{?>
            <a href="../quotation/?b=<?php  echo $rec[$PK_field]; ?>&s=<?php  echo $rec["st_setting"]; ?>&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/status_on.gif" width="10" height="10"></a>
            <?php  }?>
          </div></TD>
          <TD><div align="center"><a href="../../upload/quotation/<?php  echo $chaf;?>.pdf" target="_blank"><img src="../images/icon2/download_f2.png" width="20" height="20" border="0" alt=""></a></div></TD>
          <TD><!-- Icons -->
            <A title=Edit href="update.php?mode=update&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field]; if($param <> "") {?>&<?php  echo $param; }?>"><IMG alt=Edit src="../images/pencil.png"></A> <A title=Delete  href="#"></A></TD>
          <TD><A title=Delete  href="#"><IMG alt=Delete src="../images/cross.png" onClick="confirmDelete('?action=delete&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field];?>','Group  <?php  echo $rec[$PK_field];?> : <?php  echo $rec["group_name"];?>')"></A></TD>
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
            <?php 
				$a_not_exists = array();
				post_param($a_param,$a_not_exists); 
			?>
            <input class=button name="Action2" type="submit" id="Action2" value="ตกลง">
-->
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

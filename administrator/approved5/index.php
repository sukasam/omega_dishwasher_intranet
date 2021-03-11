<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);

	if($_GET['action'] == "update"){
		$code = Check_Permission($conn,$check_module,$_SESSION["login_id"],"update");		
		if ($code == "1") {
			header ("location:update.php?mode=update&qu_id=".$_GET['qu_id']);
		} 
	}

	if($_GET['action'] == "reject"){
		$code = Check_Permission($conn,$check_module,$_SESSION["login_id"],"update");		
		if ($code == "1") {
			header ("location:reject.php?mode=update&qu_id=".$_GET['qu_id']);
		} 
	}

	$UserProcess = checkUserApproved($conn,$_SESSION['login_id']);
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
-->
<SCRIPT type=text/javascript src="ajax.js"></SCRIPT>
<META name=GENERATOR content="MSHTML 8.00.7600.16535">
<script>
function confirmDelete(delUrl,text) {
  if (confirm("Are you sure you want to delete\n"+text)) {
    document.location = delUrl;
  }
}
	
function confirmApprove(delUrl,text) {
  if (confirm("Are you sure you want to approved.\n"+text)) {
    document.location = delUrl;
  }
}	

function confirmReject(delUrl,text) {
  if (confirm("Are you sure you want to rejected.\n"+text)) {
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
<!--
  <LI><A class=shortcut-button href="update.php?mode=add<?php  if ($param <> "") echo "&".$param; ?>"><SPAN><IMG  alt=icon src="../images/pencil_48.png"><BR>
    เพิ่ม</SPAN></A></LI>
    <LI><A class=shortcut-button href="../quotation/"><SPAN><IMG  alt=icon src="../images/paper_content_pencil_48.png"><BR>
    ใบเสนอราคาซื้อ</SPAN></A></LI>
    <LI><A class=shortcut-button href="../quotation2/"><SPAN><IMG  alt=icon src="../images/paper_content_pencil_48.png"><BR>
    ใบเสนอราคาเช่า</SPAN></A></LI>
    <LI><A class=shortcut-button href="../quotation3/"><SPAN><IMG  alt=icon src="../images/paper_content_pencil_48.png"><BR>
    ใบเสนอราคาซ่อม</SPAN></A></LI>
-->
   
   <?php
	if($UserProcess == '1' || $UserProcess == '2' || $UserProcess == '3' || $UserProcess == '4'){
		?>
		<LI style="position: relative;">
  		<?php $numApp1 = getNumApproveFO($conn,$UserProcess);?>
   		<?php if($numApp1 != 0){?><div class="appAlr"><?php echo $numApp1;?></div><?php }?>
   		<A class=shortcut-button href="../approved1/"><SPAN><IMG  alt=icon src="../images/icons/icon-48-static.png"><BR>
    อนุมัติเอกสาร<br>(First Order)</SPAN></A></LI>
		<?php
	}
	?>
   <?php
	if($UserProcess == '1' || $UserProcess == '3' || $UserProcess == '4'){
		?>
		<LI style="position: relative;">
 			<?php $numApp2 = getNumApproveSVJ($conn,$UserProcess);?>
  			<?php if($numApp2 != 0){?><div class="appAlr"><?php echo $numApp2;?></div><?php }?>
   			<A class=shortcut-button href="../approved2/"><SPAN><IMG  alt=icon src="../images/icons/icon-48-static.png"><BR>
    อนุมัติเอกสาร<br>(ใบแจ้งงาน)</SPAN></A></LI>
		<?php
	}
	?>
    <?php
	if($UserProcess == '1' ||  $UserProcess == '2' || $UserProcess == '3'){
		?>
		<LI style="position: relative;">
 			<?php $numApp3 = getNumApproveMEMO($conn,$UserProcess);?>
  			<?php if($numApp3 != 0){?><div class="appAlr"><?php echo $numApp3;?></div><?php }?>
   			<A class=shortcut-button href="../approved3/"><SPAN><IMG  alt=icon src="../images/icons/icon-48-static.png"><BR>
    อนุมัติเอกสาร<br>(Memo)</SPAN></A></LI>
		<?php
	}
	?>
   
   <?php
	if($UserProcess == '1'){
		?>
		<LI style="position: relative;">
 			<?php $numApp4 = getNumApproveQAB($conn,$UserProcess);?>
  			<?php if($numApp4 != 0){?><div class="appAlr"><?php echo $numApp4;?></div><?php }?>
   			<A class=shortcut-button href="../approved4/"><SPAN><IMG  alt=icon src="../images/icons/icon-48-static.png"><BR>
    อนุมัติเอกสาร<br>(ใบเสนอราคาซื้อ)</SPAN></A></LI>
		
		<?php
	}
	?>
    <?php
	if($UserProcess == '1'){
		?>
		<LI style="position: relative;">
 			<?php $numApp5 = getNumApproveQAH($conn,$UserProcess);?>
  			<?php if($numApp5 != 0){?><div class="appAlr"><?php echo $numApp5;?></div><?php }?>
   			<A class=shortcut-button href="../approved5/"><SPAN><IMG  alt=icon src="../images/icons/icon-48-static.png"><BR>
    อนุมัติเอกสาร<br>(ใบเสนอราคาเช่า)</SPAN></A></LI>
		<?php
	}
	?>
  
  <?php
	if($UserProcess == '4'){
		?>
		<LI style="position: relative;">
 			<?php $numApp6 = getNumApproveSV($conn,$UserProcess);?>
  			<?php if($numApp6 != 0){?><div class="appAlr"><?php echo $numApp6;?></div><?php }?>
   			<A class=shortcut-button href="../approved6/"><SPAN><IMG  alt=icon src="../images/icons/icon-48-static.png"><BR>
    อนุมัติเอกสาร<br>(ใบงานบริการ)</SPAN></A></LI>
		<?php
	}
	?>
   
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
<!--
    <div style="float:right;margin-right:20px;">  
	<label><strong>สถานะการอนุมัติ : </strong></label>
    <select name="catalog_master" id="catalog_master" style="height:24px;" onChange="MM_jumpMenu('parent',this,0)">
		 <option value="index.php" <?php  if(!isset($_GET['process'])){echo "selected";}?>>กรุณาเลือก</option>
		 <option value="index.php?process=0" <?php  if($_GET['process'] == '0'){echo "selected";}?>>รอการแก้ไข</option>
		 <option value="index.php?process=1" <?php  if($_GET['process'] == '1'){echo "selected";}?>>รอผู้อนุมัติฝ่ายขาย</option>

         <option value="index.php?process=2" <?php  if($_GET['process'] == '2'){echo "selected";}?>>รอผู้อนุมัติฝ่ายการเงิน</option>
         <option value="index.php?process=3" <?php  if($_GET['process'] == '3'){echo "selected";}?>>รอผู้มีอำนาจลงนาม</option>

         <option value="index.php?process=4" <?php  if($_GET['process'] == '4'){echo "selected";}?>>รอผู้อนุมัติฝ่ายช่าง</option>-
         <option value="index.php?process=5" <?php  if($_GET['process'] == '5'){echo "selected";}?>>ผ่านการอนุมัติ</option>
  	</select>
    </div>
-->
<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
  <form name="form2" method="post" action="confirm.php" onSubmit="return check_select(this)">
    <TABLE>
      <THEAD>
        <TR>
<!--          <TH width="5%"><INPUT class=check-all type=checkbox name="ca" value="true" onClick="chkAll(this.form, 'del[]', this.checked)"></TH>-->
          <TH width="5%"><center>สถานะการอนุมัติ</center></TH>
          <TH width="12%"><center>QA ID</center></TH>
          <TH width="35%">ชื่อลูกค้า</TH>
<!--          <TH width="18%"><strong>สถานที่ติดตั้ง</strong></TH>-->
<!--          <TH width="5%" nowrap ><div align="center"><img src="../icons/favorites_use.png" width="15" height="15"> ใช้งาน / <img src="../icons/favorites_stranby.png" width="15" height="15"> Standby / <img src="../icons/favorites_close.png" width="15" height="15"> ยกเลิก</div></TH>-->
<!--
		  <TH width="5%" nowrap ><div align="center"><a>ใบแจ้งงาน</a></div></TH>
          <TH width="5%" nowrap ><div align="center"><a>เปิด QA เช่า</a></div></TH> 
          <TH width="5%" nowrap ><div align="center"><a>สร้าง FO</a></div></TH>
          <TH width="5%" style="white-space: nowrap;"><div align="center"><a>ดาวโหลด</a></div></TH>
          <TH width="5%"><a>แก้ไข</a></TH>
          <TH width="5%"><a>ลบ</a></TH>
-->
          <TH width="5%"><center><a>Approve</a></center></TH>
          <TH width="5%"><center><a>Reject</a></center></TH>
      </THEAD>
      <TFOOT>
        </TFOOT>
      <TBODY>
        <?php  
					if($orderby=="") $orderby = $tbl_name.".".$PK_field;
					if ($sortby =="") $sortby ="DESC";
					
				   	$sql = " select *,$tbl_name.create_date as c_date from $tbl_name  where 1 ";
					if ($_GET[$PK_field] <> "") $sql .= " and ($PK_field  = '" . $_GET[$PK_field] . " ' ) ";					
					if ($_GET[$FR_field] <> "") $sql .= " and ($FR_field  = '" . $_GET[$FR_field] . " ' ) ";					
 					if ($_GET['keyword'] <> "") { 
						$sql .= "and ( " .  $PK_field  . " like '%".$_GET['keyword']."%' ";
						if (count ($search_key) > 0) { 
							$search_text = " and ( " ;
							foreach ($search_key as $key=>$value) { 
									$subtext .= "or " . $value  . " like '%" . $_GET['keyword'] . "%'";
							}	
						}
						$sql .=  $subtext . " ) ";
					} 
		  
		  			$sql .= " and ( process = '".$UserProcess."' ";
					$sql .=  $subtext . " ) ";
		  
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
          <TD><span class="text"><?php  echo $rec["cd_name"] ; ?></span></TD>
<!--
          <td>
			  	<center><a href="../quotation_jobcard/?tab=2&id=<?php  echo $rec[$PK_field]; ?>"><img src="../images/hammer_screwdriver.png" width="20" height="20"></a></center>
			  </td>
-->
<!--
					<TD style="text-align: center;"><?php
						if($rec["quotation"] != ""){
							$chafQA = preg_replace("/","-",getQaBNumber($conn,$rec["quotation"]))
							?>
							<a href="../quotation/update.php?mode=update&qu_id=<?php echo $rec["quotation"];?>"><?php echo getQaBNumber($conn,$rec["quotation"]);?></a>
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
							<a href="../quotation2/?action=createQA&id=<?php  echo $rec[$PK_field]; ?>"><img src="../images/paper_content_pencil_48.png" width="20" height="20"></a>
							<?php
						}
					?></TD>
-->
          <TD nowrap style="vertical-align:middle;display: none;"><div align="center">
            <?php  if($rec["status_use"]==0) {?>
            <img src="../icons/favorites_use.png" width="15" height="15">
            <?php  } elseif($rec["status_use"]==2) {?>
            <img src="../icons/favorites_close.png" width="15" height="15">
            <?php  } else{?>
            <img src="../icons/favorites_stranby.png" width="15" height="15">
            <?php  }?>
            <div align="center" style="padding-top:5px;">
            <a href="../quotation2/?ff=<?php  echo $rec[$PK_field]; ?>&gg=0&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/favorites_use.png" width="15" height="15"> | </a>
            <a href="../quotation2/?ff=<?php  echo $rec[$PK_field]; ?>&gg=1&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/favorites_stranby.png" width="15" height="15"> | </a>
            <a href="../quotation2/?ff=<?php  echo $rec[$PK_field]; ?>&gg=2&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/favorites_close.png" width="15" height="15"></a>
            </div>
          </div></TD>
<!--
          <TD nowrap style="vertical-align:middle;display: none;"><div align="center">
            <?php  if($rec["status"]==0) {?>
            <a href="../quotation2/?bb=<?php  echo $rec[$PK_field]; ?>&ss=<?php  echo $rec["status"]; ?>&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>&foid=<?php  echo $rec["qu_id"]; ?>"><img src="../icons/status_on.gif" width="10" height="10"></a>
            <?php  } else{?>
            <a href="../quotation2/?bb=<?php  echo $rec[$PK_field]; ?>&ss=<?php  echo $rec["status"]; ?>&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>&foid=<?php  echo $rec["qu_id"]; ?>"><img src="../icons/status_off.gif" width="10" height="10"></a>
            <div align="center"><a href="../../upload/service_report_close/<?php  echo get_srreport($conn,$rec["fs_id"]);?>.pdf" target="_blank"><p style="background:#999;color:#FFFFFF;padding:2px;"><?php  echo get_srreport($conn,$rec["qu_id"]);?></p></a></div>
            <?php  }?>
          </div>
          <div align="center"><A href="service_close.php?qu_id=<?php  echo $rec["qu_id"];?>"><IMG  alt=icon src="../images/icons/icon-48-install.png"></A></div>
          </TD>
-->
<!--
          <TD nowrap style="vertical-align:middle"><div align="center">
            <?php  if($rec["st_setting"]==0) {?>
            <a href="../quotation2/?b=<?php  echo $rec[$PK_field]; ?>&s=<?php  echo $rec["st_setting"]; ?>&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/status_off.gif" width="10" height="10"></a>
            <?php  } else{?>
            <a href="../quotation2/?b=<?php  echo $rec[$PK_field]; ?>&s=<?php  echo $rec["st_setting"]; ?>&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/status_on.gif" width="10" height="10"></a>
            <?php  }?>
          </div></TD>
          <TD><div align="center"><a href="../../upload/quotation/<?php  echo $chaf;?>.pdf" target="_blank"><img src="../images/icon2/download_f2.png" width="20" height="20" border="0" alt=""></a></div></TD>
-->
<!--
          <TD>
            <A title=Edit href="update.php?mode=update&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field]; if($param <> "") {?>&<?php  echo $param; }?>"><IMG alt=Edit src="../images/pencil.png"></A> <A title=Delete  href="#"></A></TD>
          <TD><A title=Delete  href="#"><IMG alt=Delete src="../images/cross.png" onClick="confirmDelete('?action=delete&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field];?>','Group  <?php  echo $rec[$PK_field];?> : <?php  echo $rec["group_name"];?>')"></A></TD>
-->
       <td>
         	<center><A title="Approved" href="#" onClick="confirmApprove('?action=update&mode=update&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field]; if($param <> "") {?>&<?php  echo $param; }?>','<?php  echo $rec["fs_id"];?>')"><IMG alt="Approved" src="../images/approved.png" width="30"></A></center>
         </td>
         <td>
         	<center><A title="Rejected" href="#" onClick="confirmReject('?action=reject&mode=update&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field]; if($param <> "") {?>&<?php  echo $param; }?>','<?php  echo $rec["fs_id"];?>')"><IMG alt="Rejected" src="../images/cross.png" width="30"></A></center>
         </td>
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

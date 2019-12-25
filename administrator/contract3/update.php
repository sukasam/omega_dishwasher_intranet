<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	$vowels = array(",","");

	if ($_POST['mode'] <> "") { 
		$param = "";
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);
		
		if($_POST['con_stime'] == ""){
			$_POST['con_stime'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['con_stime']);
			$_POST['con_stime']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		
		if($_POST['con_qatime'] == ""){
			$_POST['con_qatime'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['con_qatime']);
			$_POST['con_qatime']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		
		if($_POST['con_ortime'] == ""){
			$_POST['con_ortime'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['con_ortime']);
			$_POST['con_ortime']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		
		
		$_POST['con_fines'] = str_replace($vowels, '', $_POST['con_fines']);
		$_POST['con_remainprice'] = str_replace($vowels, '', $_POST['con_remainprice']);
		$_POST['con_checkamount'] = str_replace($vowels, '', $_POST['con_checkamount']);
		
		$checklist = '';
		
		foreach ($_POST['chkPro'] as $value) {
			$checklist .= $value.',';
		}
		
		$_POST['con_chkpro'] = substr($checklist,0,-1);
		

		if ($_POST['mode'] == "add" || $_POST['mode'] == "cadd") { 
			
			if($_POST['con_id'] == ""){
				 $_POST['con_id'] = check_contract3_number($conn);
			}
			
			include "../include/m_add.php";
			
			$id = mysqli_insert_id($conn);
			

			include_once("../mpdf54/mpdf.php");
			
			include_once("form_contract.php");
			$mpdf=new mPDF('UTF-8','A4','','','15','15','50','30'); 
			$mpdf->SetAutoFont();
			$mpdf->SetHTMLHeader('<div><img src="../images/contract_header.jpg"/></div>');
			$mpdf->SetHTMLFooter('<div><img src="../images/contract_footer.jpg"/></div>');
			$mpdf->WriteHTML($form);
			$chaf = str_replace("/","-",$_POST['con_id']); 
			$mpdf->Output('../../upload/contract3/'.$chaf.'.pdf','F');
			
			include_once("form_contract2.php");
			$mpdf=new mPDF('UTF-8','A4','','','15','15','50','30'); 
			$mpdf->SetAutoFont();
			$mpdf->SetHTMLHeader('<div><img src="../images/contract_header.jpg"/></div>');
			$mpdf->SetHTMLFooter('<div><img src="../images/contract_footer.jpg"/></div>');
			$mpdf->WriteHTML($form);
			$chaf = str_replace("/","-",$_POST['con_id']); 
			$mpdf->Output('../../upload/contract3/'.$chaf.'-2.pdf','F');
			
			if($_POST['mode'] == "cadd"){
				header ("location:update.php?mode=update&ct_id=".$id); 
			}else{
				header ("location:index.php?" . $param); 
			} 
		}
		if ($_POST['mode'] == "update" || $_POST['mode'] == "cupdate" ) {
			 
			include ("../include/m_update.php");
			
			$id = $_POST[$PK_field];	

			include_once("../mpdf54/mpdf.php");
			
			include_once("form_contract.php");
			$mpdf=new mPDF('UTF-8','A4','','','15','15','50','30'); 
			$mpdf->SetAutoFont();
			$mpdf->SetHTMLHeader('<div><img src="../images/contract_header.jpg"/></div>');
			$mpdf->SetHTMLFooter('<div><img src="../images/contract_footer.jpg"/></div>');
			$mpdf->WriteHTML($form);
			$chaf = str_replace("/","-",$_POST['con_id']); 
			$mpdf->Output('../../upload/contract3/'.$chaf.'.pdf','F');
			
			include_once("form_contract2.php");
			$mpdf=new mPDF('UTF-8','A4','','','15','15','50','30'); 
			$mpdf->SetAutoFont();
			$mpdf->SetHTMLHeader('<div><img src="../images/contract_header.jpg"/></div>');
			$mpdf->SetHTMLFooter('<div><img src="../images/contract_footer.jpg"/></div>');
			$mpdf->WriteHTML($form);
			$chaf = str_replace("/","-",$_POST['con_id']); 
			$mpdf->Output('../../upload/contract3/'.$chaf.'-2.pdf','F');
			
			if($_POST['mode'] == "cupdate"){
				header ("location:update.php?mode=update&ct_id=".$id); 
			}else{
				header ("location:index.php?" . $param); 
			}
			
		}
		
	}
	if ($_GET['mode'] == "add") { 
		 Check_Permission($conn,$check_module,$_SESSION['login_id'],"add");
	}
	if ($_GET['mode'] == "update") { 
		 Check_Permission($conn,$check_module,$_SESSION['login_id'],"update");
		$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";
		$query = @mysqli_query($conn,$sql);
		while ($rec = @mysqli_fetch_array($query)) { 
			$$PK_field = $rec[$PK_field];
			foreach ($fieldlist as $key => $value) { 
				$$value = $rec[$value];
			}
		}
		
		$a_sdate=explode("-",$con_stime);
		$con_stime=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$con_qatime);
		$con_qatime=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$con_ortime);
		$con_ortime=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$finfo = get_firstorder($conn,$cus_id);
		
		$con_chkpro = explode(',',$con_chkpro);
		
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
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>-->
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
<SCRIPT type=text/javascript src="ajax.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/popup.js"></SCRIPT>
<META name=GENERATOR content="MSHTML 8.00.7600.16535">

<script language="JavaScript" src="../Carlender/calendar_us.js"></script>
<link rel="stylesheet" href="../Carlender/calendar.css">

<script>
function confirmDelete(delUrl,text) {
  if (confirm("Are you sure you want to delete\n"+text)) {
    document.location = delUrl;
  }
}
//----------------------------------------------------------
function check(frm){
		if (frm.group_name.value.length==0){
			alert ('Please enter group name !!');
			frm.group_name.focus(); return false;
		}		
}	

	function CountChecks(whichlist,maxchecked,latestcheck,numsa) {
	
	var listone = new Array();
 	
	for (var t=1;t<=numsa;t++){
		listone[t-1] = 'checkbox'+t;
	}
	
	// End of customization.
	var iterationlist;
	eval("iterationlist="+whichlist);
	var count = 0;
	for( var i=0; i<iterationlist.length; i++ ) {
	   if( document.getElementById(iterationlist[i]).checked == true) { count++; }
	   if( count > maxchecked ) { latestcheck.checked = false; }
	   }
	if( count > maxchecked ) {
	  // alert('Sorry, only ' + maxchecked + ' may be checked.');
	   }
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
<P id=page-intro><?php  if ($mode == "add") { ?>Enter new information<?php  } else { ?>แก้ไข	[<?php  echo $page_name; ?>]<?php  } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php  echo $check_module; ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
      <legend><?php  echo $page_name; ?> </legend>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tr>
            <td><style>
	.bgheader{
		font-size:12px;
		position:absolute;
		margin-top:98px;
		padding-left:586px;
	}
	table tr td{
		vertical-align:top;
		padding:5px;
	}	
	.tb1{
		margin-top:5px;
	}
	.tb1 tr td{
		border:1px solid #000000;
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;	
	}
	.tb2,.tb3{
		border:1px solid #000000;	
		margin-top:5px;
	}
	.tb2 tr td{
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;		
	}
	
	.tb3 tr td{
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;		
	}
	.tb3 img{
		vertical-align:bottom;
	}
	
	.ccontact{
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
	}
	.ccontact tr td{
		
	}
	
	.cdetail{
		border: 1px solid #000000;
		padding:5px;
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		margin-top:5px;
  	}	
	.cdetail ul li{
		list-style:none;
		
	}
	.cdetail2 ul li{
		list-style:none;
		float:left;
	}
	.clear{
		margin:0;
		padding:0;
		clear:both;	
	}
	
	.tblf5{
		border: 1px solid #000000;
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		margin-top:5px;
	}
	
	</style>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td><strong>ชื่อลูกค้า :</strong>
                <input name="cd_names" type="text" id="cd_names"  value="<?php echo get_customername($conn,$cus_id);?>" style="width:50%;" readonly>
                <span id="rsnameid"><input type="hidden" name="cus_id" value="<?php  echo $cus_id;?>"></span><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
            </td>
            <td>
            	<strong>เลขที่สัญญา : <input type="text" name="con_id" value="<?php  if($con_id == ""){echo check_contract3_number($conn);}else{echo $con_id;};?>" id="con_id" class="inpfoder" style="border:0;">&nbsp;&nbsp;เลขที่ FO  :</strong> <span id="contactid"><?php  echo $finfo['fs_id'];?></span>
            </td>
          </tr>
          <tr>
            <td><strong>ที่อยู่ :</strong> <span id="cusadd"><?php  echo $finfo['cd_address'];?></span></td>
            <td>
            	<strong>วันทำสัญญา  :</strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="con_stime" readonly value="<?php  if($con_stime==""){echo date("d/m/Y");}else{ echo $con_stime;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'con_stime'});</script></span>
            </td>
          </tr>
          <tr>
            <td><strong>จังหวัด :</strong> <span id="cusprovince"><?php  echo province_name($conn,$finfo['cd_province']);?></span></td>
            <td>
            	 1.1 แบบฟอร์มใบเสนอราคาของผู้ขาย ลงวันที่ <span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="con_qatime" readonly value="<?php  if($con_qatime==""){echo date("d/m/Y");}else{ echo $con_qatime;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'con_qatime'});</script></span>&nbsp;&nbsp;&nbsp;จำนวน <span id="con_qap"><input type="text" name="con_qap" value="<?php  echo $con_qap;?>" id="con_qap" class="inpfoder" style="width:10%;text-align: center;"></span> ฉบับ
            </td>
          </tr>
          <tr>
            <td><strong>โทรศัพท์ :</strong> <span id="custel"><?php  echo $finfo['cd_tel'];?></span><strong>&nbsp;&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> <span id="cusfax"><?php  echo $finfo['cd_fax'];?></span></td>
            <td>
            	1.2 แบบฟอร์มใบสั่งซื้อของผู้ซื้อ ลงวันที่ <span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="con_ortime" readonly value="<?php  if($con_ortime==""){echo date("d/m/Y");}else{ echo $con_ortime;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'con_ortime'});</script></span>&nbsp;&nbsp;&nbsp;จำนวน <span id="con_orp"><input type="text" name="con_orp" value="<?php  echo $con_orp;?>" id="con_orp" class="inpfoder" style="width:10%;text-align: center;"></span> ฉบับ
            </td>
          </tr>
          <tr>
            <td><strong>ชื่อผู้ติดต่อ :</strong> <span id="cscont"><?php  echo $finfo['c_contact'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;<strong>เบอร์โทร :</strong> <span id="cstel"><?php  echo $finfo['c_tel'];?></span></td>
            <td>
            	3.1 เบี้ยปรับกรณีที่ผู้ซื้อผิดนัด เป็นเงิน <span id="con_fines"><input type="text" name="con_fines" value="<?php  echo number_format($con_fines);?>" id="con_fines" class="inpfoder" style="width:12%;text-align: center;"></span> บาท 
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
            	3.2 ผู้ซื้อจะชำระส่วนที่เหลือ เป็นเงิน <span id="con_remainprice"><input type="text" name="con_remainprice" value="<?php  echo number_format($con_remainprice);?>" id="con_remainprice" class="inpfoder" style="width:12%;text-align: center;"></span> บาท ต่อเดือน โดยจะมีเช็คค้ำประกัน<br>
            	1. เช็คเลขที่ <span id="con_checknum"><input type="text" name="con_checknum" value="<?php  echo $con_checknum;?>" id="con_checknum" class="inpfoder" style="width:13%;text-align: center;"></span> 
            	ประจำเดือน <input type="text" name="con_checkmonth" value="<?php  echo $con_checkmonth;?>" id="con_checkmonth" class="inpfoder" style="width:12%;text-align: center;"> 
            	ธนาคาร <span id="con_checkbank"><input type="text" name="con_checkbank" value="<?php  echo $con_checkbank;?>" id="con_checkbank" class="inpfoder" style="width:12%;text-align: center;"></span> 
            	จำนวนเงิน <span id="con_checkamount"><input type="text" name="con_checkamount" value="<?php  echo number_format($con_checkamount);?>" id="con_checkamount" class="inpfoder" style="width:12%;text-align: center;"></span> บาท
            </td>
          </tr>
	</table><br><br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;" id="productConlist">
    <tr>
      <td width="3%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>เลือก</strong></td>
      <td width="43%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="21%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น</strong></td>
      <td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>S/N</strong></td>
      <td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา</strong></td>


    </tr>
    <?php 
		if($finfo['cpro1']){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="checkbox" name="chkPro[]" value="1" <?php if(@in_array( '1' , $con_chkpro )){echo 'checked="checked"';}?>><br>
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_proname($conn,$finfo['cpro1']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_pod1'];?>
			 </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_sn1'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $finfo['camount1'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo number_format($finfo['cprice1']);?>
			  </td>
			</tr>
			<?php
		}
	?>
   <?php 
		if($finfo['cpro2']){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="checkbox" name="chkPro[]" value="2" <?php if(@in_array( '2' , $con_chkpro )){echo 'checked="checked"';}?>><br>
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_proname($conn,$finfo['cpro2']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_pod2'];?>
			 </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_sn2'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $finfo['camount2'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo number_format($finfo['cprice2']);?>
			  </td>
			</tr>
			<?php
		}
	?>
   <?php 
		if($finfo['cpro3']){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="checkbox" name="chkPro[]" value="3" <?php if(@in_array('3' , $con_chkpro )){echo 'checked="checked"';}?>><br>
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_proname($conn,$finfo['cpro3']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_pod3'];?>
			 </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_sn3'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $finfo['camount3'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo number_format($finfo['cprice3']);?>
			  </td>
			</tr>
			<?php
		}
	?>
   <?php 
		if($finfo['cpro4']){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="checkbox" name="chkPro[]" value="4" <?php if(@in_array( '4' , $con_chkpro )){echo 'checked="checked"';}?>><br>
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_proname($conn,$finfo['cpro4']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_pod4'];?>
			 </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_sn4'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $finfo['camount4'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo number_format($finfo['cprice4']);?>
			  </td>
			</tr>
			<?php
		}
	?>
   <?php 
		if($finfo['cpro5']){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="checkbox" name="chkPro[]" value="5" <?php if(@in_array( '5' , $con_chkpro )){echo 'checked="checked"';}?>><br>
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_proname($conn,$finfo['cpro5']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_pod5'];?>
			 </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_sn5'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $finfo['camount5'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo number_format($finfo['cprice5']);?>
			  </td>
			</tr>
			<?php
		}
	?>
   <?php 
		if($finfo['cpro6']){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="checkbox" name="chkPro[]" value="6" <?php if(@in_array( '6' , $con_chkpro )){echo 'checked="checked"';}?>><br>
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_proname($conn,$finfo['cpro6']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_pod6'];?>
			 </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_sn6'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $finfo['camount6'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo number_format($finfo['cprice6']);?>
			  </td>
			</tr>
			<?php
		}
	?>
   <?php 
		if($finfo['cpro7']){
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="checkbox" name="chkPro[]" value="7" <?php if(@in_array( '7' , $con_chkpro )){echo 'checked="checked"';}?>><br>
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_proname($conn,$finfo['cpro7']);?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_pod7'];?>
			 </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_sn7'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $finfo['camount7'];?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo number_format($finfo['cprice7']);?>
			  </td>
			</tr>
			<?php
		}
	?>
    </table>
    
	</td>
          </tr>
        </table>
        </fieldset>
    </div><br>
    <div class="formArea">
      <input type="submit" name="Submit" id="Submit" value="Submit" class="button">
      <input type="reset" name="Submit" value="Reset" class="button">
      <?php  
			$a_not_exists = array();
			post_param($a_param,$a_not_exists); 
			?>
     
      <input name="mode" type="hidden" id="mode" value="<?php echo $_GET['mode'];?>">
      <input name="<?php echo $PK_field;?>" type="hidden" id="<?php  echo $PK_field;?>" value="<?php  echo $_GET[$PK_field];?>">
    </div>
  </form>
</DIV>
</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php  include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
<?php  if($msg_user==1){?>
<script language=JavaScript>alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');</script>
<?php  }?>
</BODY>
</HTML>

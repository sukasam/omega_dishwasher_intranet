<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	if ($_POST['mode'] <> "") { 
		$param = "";
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);
		
		
		if($_POST['job_open'] == ""){
			$_POST['job_open'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['job_open']);
			$_POST['job_open']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		
		if($_POST['date_sell'] == ""){
			$_POST['date_sell'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['date_sell']);
			$_POST['date_sell']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		
		if($_POST['date_hsell'] == ""){
			$_POST['date_hsell'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['date_hsell']);
			$_POST['date_hsell']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		
		if($_POST['date_providers'] == ""){
			$_POST['date_providers'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['date_providers']);
			$_POST['date_providers']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		
		if($_POST['date_appoint1'] == ""){
			$_POST['date_appoint1'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['date_appoint1']);
			$_POST['date_appoint1']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		
		if($_POST['date_appoint2'] == ""){
			$_POST['date_appoint2'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['date_appoint2']);
			$_POST['date_appoint2']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		
		if($_POST['date_appoint3'] == ""){
			$_POST['date_appoint3'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['date_appoint3']);
			$_POST['date_appoint3']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		
		if($_POST['date_appoint4'] == ""){
			$_POST['date_appoint4'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['date_appoint4']);
			$_POST['date_appoint4']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		
		if($_POST['date_appoint5'] == ""){
			$_POST['date_appoint5'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['date_appoint5']);
			$_POST['date_appoint5']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		
		if($_POST['date_appoint6'] == ""){
			$_POST['date_appoint6'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['date_appoint6']);
			$_POST['date_appoint6']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		
		if($_POST['date_appoint7'] == ""){
			$_POST['date_appoint7'] = date("Y-m-d");
		}else{
			$a_sdate=explode("/",$_POST['date_appoint7']);
			$_POST['date_appoint7']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		}
		

		if ($_POST['mode'] == "update" ) {
			
			$_POST['detail_recom'] = nl2br($_POST['detail_recom']);
			
			$numApp = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM s_approve WHERE tag_db = '".$tbl_name."' AND t_id = '".$_REQUEST[$PK_field]."'"));
			
			if($numApp >= 1){
				if($_POST['process'] == '2'){
					@mysqli_query($conn,"UPDATE `s_approve` SET `process_2` = '1' WHERE tag_db = '".$tbl_name."' AND t_id = '".$_REQUEST[$PK_field]."';");
				}
				if($_POST['process'] == '3'){
					@mysqli_query($conn,"UPDATE `s_approve` SET `process_3` = '1' WHERE tag_db = '".$tbl_name."' AND t_id = '".$_REQUEST[$PK_field]."';");
				}
				if($_POST['process'] == '4'){
					@mysqli_query($conn,"UPDATE `s_approve` SET `process_4` = '1' WHERE tag_db = '".$tbl_name."' AND t_id = '".$_REQUEST[$PK_field]."';");
				}
			}else{
				@mysqli_query($conn,"INSERT INTO `s_approve` (`id`, `tag_db`, `t_id`, `process_1`, `process_2`, `process_3`, `process_4`) VALUES (NULL, '".$tbl_name."', '".$_REQUEST[$PK_field]."', '1', '0', '0', '0');");
			}
			
			if($_POST['process'] == '3'){
				$_POST['process'] = '4';
			}else if($_POST['process'] == '4'){
				$_POST['process'] = '5';
			}else{
				$_POST['process'] = '3';
			}

			include ("../include/m_update.php");
			
			$id = $_REQUEST[$PK_field];			
			
//			mysqli_query($conn,"UPDATE `s_quotation_jobcard` SET `process` = '0' WHERE `s_quotation_jobcard`.`qc_id` = ".$id.";");
				
			include_once("../mpdf54/mpdf.php");
			include_once("form_servicecard.php");
			$mpdf=new mPDF('UTF-8'); 
			$mpdf->SetAutoFont();
//			if($_POST['process'] != '5'){
//				$mpdf->showWatermarkText = true;
//				$mpdf->WriteHTML('<watermarktext content="NOT YET APPROVED" alpha="0.4" />');
//			}
			$mpdf->WriteHTML($form);
			$chaf = str_replace("/","-",$_POST['sv_id']); 
			$mpdf->Output('../../upload/quotation_jobcard/'.$chaf.'.pdf','F');
			
			header ("location:index.php"); 
		}
		
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
		
		$a_sdate=explode("-",$job_open);
		$job_open=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		$a_sdate=explode("-",$date_sell);
		$date_sell=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		$a_sdate=explode("-",$date_hsell);
		$date_hsell=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		$a_sdate=explode("-",$date_providers);
		$date_providers=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		$a_sdate=explode("-",$date_appoint1);
		$date_appoint1=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		$a_sdate=explode("-",$date_appoint2);
		$date_appoint2=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		$a_sdate=explode("-",$date_appoint3);
		$date_appoint3=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		$a_sdate=explode("-",$date_appoint4);
		$date_appoint4=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		$a_sdate=explode("-",$date_appoint5);
		$date_appoint5=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		$a_sdate=explode("-",$date_appoint6);
		$date_appoint6=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		$a_sdate=explode("-",$date_appoint7);
		$date_appoint7=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
	}

	$quinfo =get_quotation($conn,$qu_id,$qu_table);
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php  echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel="stylesheet" type=text/css href="../css/reset.css" media=screen>
<LINK rel="stylesheet" type=text/css href="../css/style.css" media=screen>
<LINK rel="stylesheet" type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.3.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
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
<BODY onload="document.form1.submit()">
<!--<BODY>-->
<DIV id=body-wrapper>
<?php  include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php  include('../top.php');?>
<P id=page-intro><?php  if ($mode == "add") { ?>Enter new information<?php  } else { ?><?php  echo $page_name; ?><?php  } ?>	</P>
<!--
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>
-->
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php  echo $check_module; ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<div><center><img src="../images/waiting.gif" width="450"></center></div>
<DIV class=content-box-content style="display: none;">
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

<!--
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="text-align:right;font-size:12px;">
			<div style="position:relative;text-align:center;">
            	<img src="../images/form/header_service_report.png" width="100%" border="0" style="max-width:1182px;"/>
            </div>
		</td>
	  </tr>
	</table>
-->
	
	<table width="100%" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> <?php  echo $quinfo['cd_name'];?></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>ประเภทสินค้า :</strong>
            	<?php echo protype_name($conn,$quinfo['pro_type']);?>
            </td>

          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong> <?php  echo $quinfo['cd_address'];?></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong>เลขที่ใบเสนอราคา<?php if($_GET['tab'] == 1){echo 'ซื้อ';}else{echo 'เช่า';}?>:</strong> 
            <?php  echo $quinfo['fs_id'];?>&nbsp;&nbsp;<strong>เลขที่ใบแจ้งงานบริการ : <input type="text" name="sv_id" value="<?php  if($sv_id == ""){echo check_servicecard($conn);}else{echo $sv_id;};?>" id="sv_id" class="inpfoder" style="border:0;">
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>จังหวัด :</strong>
            <?php  echo province_name($conn,$quinfo['cd_province']);?>
           	</td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong> วันที่ :</strong> <input type="text" name="job_open" readonly value="<?php  if($job_open==""){echo date("d/m/Y");}else{ echo $job_open;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'job_open'});</script>
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>โทรศัพท์ :</strong> <?php  echo $quinfo['cd_tel'];?>
             &nbsp;&nbsp;<strong>อีเมล์ :</strong> <?php  echo $quinfo['cd_fax'];?>
         	</td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>ชื่อผู้ติดต่อ :</strong>
            	<?php  echo $quinfo['c_contact'];?>
              &nbsp;&nbsp;<strong>เบอร์โทร :</strong>
              <?php  echo $quinfo['c_tel'];?>
            </td>
          </tr>
</table>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb3">
	  <tr>
	    <td width="50%"><strong>รายละเอียดงาน</strong><br />
        <table>
        	<tr>
        		<td><input type="radio" name="type_service" value="1" <?php if($type_service == 1 || $type_service === ""){echo 'checked';}?>>&nbsp;&nbsp;&nbsp;ติดตั้งเครื่องล้างจาน</td>
				<td><input type="text" name="ser_pro1" value="<?php echo $ser_pro1;?>" style="width: 100%;"></td>
				<td>&nbsp;&nbsp;&nbsp;รุ่น&nbsp;&nbsp;&nbsp;</td>
				<td><input type="text" name="ser_sn1" value="<?php echo $ser_sn1;?>" style="width: 100%;"></td>
				<td><strong>วันที่นัด </strong> <input type="text" name="date_appoint1" readonly value="<?php  if($date_appoint1==""){echo date("d/m/Y");}else{ echo $date_appoint1;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_appoint1'});</script></td>
        	</tr>
        	<tr>
        		<td><input type="radio" name="type_service" value="7" <?php if($type_service == 7 || $type_service === ""){echo 'checked';}?>>&nbsp;&nbsp;&nbsp;ติดตั้งเครื่องล้างแก้ว</td>
				<td><input type="text" name="ser_pro7" value="<?php echo $ser_pro7;?>" style="width: 100%;"></td>
				<td>&nbsp;&nbsp;&nbsp;รุ่น&nbsp;&nbsp;&nbsp;</td>
				<td><input type="text" name="ser_sn5" value="<?php echo $ser_sn5;?>" style="width: 100%;"></td>
				<td><strong>วันที่นัด </strong> <input type="text" name="date_appoint7" readonly value="<?php  if($date_appoint7==""){echo date("d/m/Y");}else{ echo $date_appoint7;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_appoint7'});</script></td>
        	</tr>
        	<tr>
        		<td><input type="radio" name="type_service" value="6" <?php if($type_service == 6){echo 'checked';}?>>&nbsp;&nbsp;&nbsp;ติดตั้งเครื่องผลิตน้ำแข็ง</td>
				<td><input type="text" name="ser_pro6" value="<?php echo $ser_pro6;?>" style="width: 100%;"></td>
				<td>&nbsp;&nbsp;&nbsp;รุ่น&nbsp;&nbsp;&nbsp;</td>
				<td><input type="text" name="ser_sn4" value="<?php echo $ser_sn4;?>" style="width: 100%;"></td>
				<td><strong>วันที่นัด </strong> <input type="text" name="date_appoint6" readonly value="<?php  if($date_appoint6 ==""){echo date("d/m/Y");}else{ echo $date_appoint6;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_appoint6'});</script></td>
        	</tr>
        	<tr>
        		<td><input type="radio" name="type_service" value="2" <?php if($type_service == 2){echo 'checked';}?></inpu>&nbsp;&nbsp;&nbsp;ติดตั้งเครื่องจ่ายน้ำยา</td>
				<td><input type="text" name="ser_pro2" value="<?php echo $ser_pro2;?>" style="width: 100%;"></td>
				<td>&nbsp;&nbsp;&nbsp;รุ่น&nbsp;&nbsp;&nbsp;</td>
				<td><input type="text" name="ser_sn2" value="<?php echo $ser_sn2;?>" style="width: 100%;"></td>
				<td><strong>วันที่นัด </strong> <input type="text" name="date_appoint2" readonly value="<?php  if($date_appoint2==""){echo date("d/m/Y");}else{ echo $date_appoint2;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_appoint2'});</script></td>
        	</tr>
        	<tr>
        		<td><input type="radio" name="type_service" value="3" <?php if($type_service == 3){echo 'checked';}?>>&nbsp;&nbsp;&nbsp;ตรวจเช็คเพื่อซ่อม</td>
				<td><input type="text" name="ser_pro3" value="<?php echo $ser_pro3;?>" style="width: 100%;"></td>
				<td>&nbsp;&nbsp;&nbsp;รุ่น&nbsp;&nbsp;&nbsp;</td>
				<td><input type="text" name="ser_sn3" value="<?php echo $ser_sn3;?>" style="width: 100%;"></td>
				<td><strong>วันที่นัด </strong> <input type="text" name="date_appoint3" readonly value="<?php  if($date_appoint3==""){echo date("d/m/Y");}else{ echo $date_appoint3;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_appoint3'});</script></td>
        	</tr>

        	<tr>
        		<td><input type="radio" name="type_service" value="4" <?php if($type_service == 4){echo 'checked';}?>>&nbsp;&nbsp;&nbsp;ดูพื้นที่</td>
				<td colspan="3"><input type="text" name="ser_pro4" value="<?php echo $ser_pro4;?>" style="width: 100%;"></td>
				<td><strong>วันที่นัด </strong> <input type="text" name="date_appoint4" readonly value="<?php  if($date_appoint4==""){echo date("d/m/Y");}else{ echo $date_appoint4;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_appoint4'});</script></td>
        	</tr>
        	<tr>
        		<td><input type="radio" name="type_service" value="5" <?php if($type_service == 5){echo 'checked';}?>>&nbsp;&nbsp;&nbsp;อื่นๆ</td>
				<td colspan="3"><input type="text" name="ser_pro5" value="<?php echo $ser_pro5;?>" style="width: 100%;"></td>
				<td><strong>วันที่นัด </strong> <input type="text" name="date_appoint5" readonly value="<?php  if($date_appoint5==""){echo date("d/m/Y");}else{ echo $date_appoint5;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_appoint5'});</script></td>
        	</tr>
        </table>
        </td>
      </tr>
    </table>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb3">
	  <tr>
	    <td width="50%"><strong>รายละเอียดงาน</strong><br />
        <br />
        <span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
        <textarea name="detail_recom" class="inpfoder" id="detail_recom" style="width:50%;height:250px;"><?php  echo strip_tags($detail_recom);?></textarea>
        </span><br /></td>
      </tr>
    </table>
	
	<table width="100%" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong><!--<input type="text" name="cs_sell" value="<?php  echo $cs_sell;?>" id="cs_sell" class="inpfoder" style="width:50%;text-align:center;">-->
                <select name="cs_sell" id="cs_sell" class="inputselect" style="width:50%;">
                <?php
                	$qusaletype = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");
					while($row_saletype = @mysqli_fetch_array($qusaletype)){
					  ?>
					  	<option value="<?php  echo $row_saletype['group_id'];?>" <?php  if($cs_sell == $row_saletype['group_id']){echo 'selected';}?>><?php  echo $row_saletype['group_name'];?></option>
					  <?php
					}
				?>
            </select></strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้แจ้งงาน</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
<!--
                <strong>เบอร์โทร <input type="text" name="tel_sell" value="<?php echo $tel_sell;?>" style="text-align: center;width: 150px;"></strong>
                <br><br>
-->
                <strong>วันที่ <input type="text" name="date_sell" style="text-align: center;" readonly value="<?php  if($date_sell==""){echo date("d/m/Y");}else{ echo $date_sell;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_sell'});</script></strong></td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >
                <?php
					$hsale = '';
					if($cs_hsell != ""){
						$hsale = $cs_hsell;
					}else{
						$hsale = getNameSaleApprove($conn);
					}
				?>
                <input type="text" name="cs_hsell" value="<?php  echo $hsale;?>" id="cs_hsell" class="inpfoder" style="width:50%;text-align:center;border: none;"></strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>หัวหน้าฝ่ายขาย</strong></td>
              </tr>
              <tr>
              <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
<!--
              <strong>เบอร์โทร <input type="text" name="tel_hsell" value="<?php echo $tel_hsell;?>" style="text-align: center;width: 150px;"></strong>
                <br><br>
-->
              <strong>วันที่ <input type="text" name="date_hsell" style="text-align: center;" readonly value="<?php  if($date_hsell==""){echo date("d/m/Y");}else{ echo $date_hsell;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_hsell'});</script></strong></td>
              </tr>
            </table>

        </td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
<!--                <strong><input type="text" name="cs_providers" value="<?php  echo $cs_providers;?>" id="cs_providers" class="inpfoder" style="width:50%;text-align:center;"></strong>-->
               
               <select name="cs_providers" id="cs_providers" class="inputselect" style="width:50%;">
                <?php
                	$qutectype = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
					while($row_tectype = @mysqli_fetch_array($qutectype)){
					  ?>
					  	<option value="<?php  echo $row_tectype['group_id'];?>" <?php  if($cs_providers == $row_tectype['group_id']){echo 'selected';}?>><?php  echo $row_tectype['group_name'];?></option>
					  <?php
					}
				?>
            	</select>
               
                </td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้ให้บริการ</strong></td>
              </tr>
              <tr>
              <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
<!--
              <strong>เบอร์โทร <input type="text" name="tel_providers" value="<?php echo $tel_providers;?>" style="text-align: center;width: 150px;"></strong>
                <br><br>
-->
              <strong>วันที่ <input type="text" name="date_providers" style="text-align: center;" readonly value="<?php  if($date_providers==""){echo date("d/m/Y");}else{ echo $date_providers;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_providers'});</script></strong></td>
              </tr>
            </table>
        </td>
      </tr>
    </table></td>
          </tr>
        </table>
        </fieldset>
    </div><br>
    <div class="formArea">
      <div style="text-align: center;">
      	<input type="submit" name="Submit" value=" บันทึก " class="button bt_save">
      	<input type="button" name="Cancel" value=" ยกเลิก " class="button bt_cancel" onClick="history.back();">
      </div>
      <?php  
			$a_not_exists = array();
			post_param($a_param,$a_not_exists); 
			?>
      <input name="mode" type="hidden" id="mode" value="<?php  echo $_GET['mode'];?>">
      <input name="qu_id" type="hidden" id="qu_id" value="<?php  echo $qu_id;?>"> 
      <input name="qu_table" type="hidden" id="qu_table" value="<?php  echo $qu_table;?>"> 
      <input name="process" type="hidden" id="process" value="<?php  echo $process;?>">
      <input name="st_setting" type="hidden" id="st_setting" value="<?php  echo $st_setting;?>"> 
      <input name="<?php  echo $PK_field;?>" type="hidden" id="<?php  echo $PK_field;?>" value="<?php  echo $_GET[$PK_field];?>">
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

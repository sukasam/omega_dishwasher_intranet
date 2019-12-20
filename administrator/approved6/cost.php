<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	$vowels = array(",","-");

	if ($_POST['mode'] <> "") { 
		$param = "";
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);
		
		$a_sdate=explode("/",$_POST['sr_stime']);
		$_POST['sr_stime']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['job_open']);
		$_POST['job_open']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['job_close']);
		$_POST['job_close']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];


		if ($_POST['mode'] == "update" ) {
			
			$a_sdate=explode("/",$_POST['detail3']);
			$_POST['detail3']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
			
			$jobID = $_POST['sr_id'];
			$setup = $_POST['setup'];
			$ot = $_POST['ot'];
			$ot_1 = str_replace($vowels, '', $_POST['ot_1']);
			$pd = $_POST['pd'];
			$ot_person = $_POST['ot_person'];
			$ot_day = $_POST['ot_day'];
			$travel = $_POST['travel'];
			$distance = $_POST['distance'];
			$detail1 = $_POST['detail1_'];
			$detail2 = $_POST['detail2_'];
			$detail3 = $_POST['detail3'];
			$detail3_1 = $_POST['detail3_1'];
			$detail4 = $_POST['detail4'];
			$detail5 = $_POST['detail5'];

			$detail6 = str_replace($vowels, '', $_POST['detail6']);
			
			$technician1 = $_POST['technician1'];
			$technician2 = $_POST['technician2'];
			$technician3 = $_POST['technician3'];
			$technician4 = $_POST['technician4'];
			$technician5 = $_POST['technician5'];
			$technician6 = $_POST['technician6'];
			$technician7 = $_POST['technician7'];
			$technician8 = $_POST['technician8'];

			$cost_other1 = str_replace($vowels, '', $_POST['cost_other1']);
			$cost_other2 = str_replace($vowels, '', $_POST['cost_other2']);
			$cost_other3 = str_replace($vowels, '', $_POST['cost_other3']);
			$cost_other4 = str_replace($vowels, '', $_POST['cost_other4']);
			$cost_other5 = str_replace($vowels, '', $_POST['cost_other5']);
			$cost_other6 = str_replace($vowels, '', $_POST['cost_other6']);
			$cost_other7 = str_replace($vowels, '', $_POST['cost_other7']);
			$cost_other8 = str_replace($vowels, '', $_POST['cost_other8']);
			$cost_other9 = $_POST['cost_other9'];
			$cost_other10 = str_replace($vowels, '', $_POST['cost_other10']);
			$cost_other11 = $_POST['cost_other11'];
			$cost_other12 = str_replace($vowels, '', $_POST['cost_other12']);
			$cost_other13 = str_replace($vowels, '', $_POST['cost_other13']);
			$cost_other14 = $_POST['cost_other14'];
			
			$sumDetail7 = $cost_other1+$cost_other2+$cost_other3+$cost_other4+$cost_other5+$cost_other6+$cost_other7+$cost_other8+$cost_other10+$cost_other12+$cost_other13;
			
			$detail7 = $sumDetail7;
			
			$sumDetail8 = $detail7 - $detail6;
			
			if($sumDetail8 <= 0){
				$detail8 = str_replace($vowels,'',$sumDetail8);
				$detail9 = "0.00";
			}else{
				$detail9 = str_replace($vowels,'',$sumDetail8);
				$detail8 = "0.00";
			}
			
			//echo $sumDetail8."-".$detail8." MKUNG";
			
			$numCost = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM s_service_cost WHERE job_id = '".$jobID."'"));
			
			if($numCost == 0){
				$quCost = mysqli_query($conn,"INSERT INTO `s_service_cost` (`id`, `job_id`, `setup`, `ot`, `ot_1`, `pd`, `ot_person`, `ot_day`, `travel`, `distance`, `detail1`, `detail2`, `detail3`, `detail3_1`, `detail4`, `detail5`, `detail6`, `detail7`, `detail8`, `detail9`, `technician1`, `technician2`, `technician3`, `technician4`, `technician5`, `technician6`, `technician7`, `technician8`, `cost_other1`, `cost_other2`, `cost_other3`, `cost_other4`, `cost_other5`, `cost_other6`, `cost_other7`, `cost_other8`, `cost_other9`, `cost_other10`, `cost_other11`, `cost_other12`, `cost_other13`, `cost_other14`) VALUES (NULL, '".$jobID."', '".$setup."', '".$ot."', '".$ot_1."', '".$pd."', '".$ot_person."', '".$ot_day."', '".$travel."', '".$distance."', '".$detail1."', '".$detail2."', '".$detail3."', '".$detail3_1."', '".$detail4."', '".$detail5."', '".$detail6."', '".$detail7."', '".$detail8."', '".$detail9."', '".$technician1."', '".$technician2."', '".$technician3."', '".$technician4."', '".$technician5."', '".$technician6."', '".$technician7."', '".$technician8."', '".$cost_other1."', '".$cost_other2."', '".$cost_other3."', '".$cost_other4."', '".$cost_other5."', '".$cost_other6."', '".$cost_other7."', '".$cost_other8."', '".$cost_other9."', '".$cost_other10."', '".$cost_other11."', '".$cost_other12."', '".$cost_other13."', '".$cost_other14."');");
			}else{
				$quCost = mysqli_query($conn,"UPDATE `s_service_cost` SET `setup` = '".$setup."', `ot` = '".$ot."', `ot_1` = '".$ot_1."', `pd` = '".$pd."', `ot_person` = '".$ot_person."', `ot_day` = '".$ot_day."', `travel` = '".$travel."', `distance` = '".$distance."', `detail1` = '".$detail1."', `detail2` = '".$detail2."', `detail3` = '".$detail3."', `detail3_1` = '".$detail3_1."', `detail4` = '".$detail4."', `detail5` = '".$detail5."', `detail6` = '".$detail6."', `detail7` = '".$detail7."', `detail8` = '".$detail8."', `detail9` = '".$detail9."', `technician1` = '".$technician1."', `technician2` = '".$technician2."', `technician3` = '".$technician3."', `technician4` = '".$technician4."', `technician5` = '".$technician5."', `technician6` = '".$technician6."', `technician7` = '".$technician7."', `technician8` = '".$technician8."', `cost_other1` = '".$cost_other1."', `cost_other2` = '".$cost_other2."', `cost_other3` = '".$cost_other3."', `cost_other4` = '".$cost_other4."', `cost_other5` = '".$cost_other5."', `cost_other6` = '".$cost_other6."', `cost_other7` = '".$cost_other7."', `cost_other8` = '".$cost_other8."', `cost_other9` = '".$cost_other9."', `cost_other10` = '".$cost_other10."', `cost_other11` = '".$cost_other11."', `cost_other12` = '".$cost_other12."', `cost_other13` = '".$cost_other13."', `cost_other14` = '".$cost_other14."' WHERE `job_id` = '".$jobID."';");
			}
			
			header ("location:cost.php?mode=update&sr_id=".$jobID."&page=1"); 
		}
		
	}
	if ($_GET['mode'] == "add") { 
		 Check_Permission($conn,"ค่าใช้จ่าย",$_SESSION['login_id'],"add");
	}
	if ($_GET['mode'] == "update") { 
		
		Check_Permission($conn,"ค่าใช้จ่าย",$_SESSION['login_id'],"update");
		$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";
		$query = @mysqli_query($conn,$sql);
		while ($rec = @mysqli_fetch_array($query)) { 
			$$PK_field = $rec[$PK_field];
			foreach ($fieldlist as $key => $value) { 
				$$value = $rec[$value];
			}
		}
		
		$sql2 = "select * from s_service_cost where job_id = '" . $_GET[$PK_field] ."'";
		$query2 = @mysqli_query($conn,$sql2);
		while ($rec2 = @mysqli_fetch_array($query2)) { 
			$$PK_field = $rec2[$PK_field2];
			foreach ($fieldlist2 as $key => $value) { 
				$$value = $rec2[$value];
			}
		}
		
		if($detail3 != ""){
			$a_sdate=explode("-",$detail3);
			$detail3 = $a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		}else{
			$detail3 = date("d/m/Y");
		}
		
		if($ot_1 == ""){$ot_1 = "";}else{$ot_1 = number_format($ot_1,2);}
		if($detail6 == ""){$detail6 = "0";}else{$detail6 = number_format($detail6,2);}
		if($detail7 == ""){$detail6 = "0";}else{$detail7 = number_format($detail7,2);}
		if($detail8 == ""){$detail6 = "0";}else{$detail8 = number_format($detail8,2);}
		if($detail9 == ""){$detail6 = "0";}else{$detail9 = number_format($detail9,2);}
		
		if($cost_other1 == ""){$cost_other1 = "0";}else{$cost_other1 = number_format($cost_other1,2);}
		if($cost_other2 == ""){$cost_other2 = "0";}else{$cost_other2 = number_format($cost_other2,2);}
		if($cost_other3 == ""){$cost_other3 = "0";}else{$cost_other3 = number_format($cost_other3,2);}
		if($cost_other4 == ""){$cost_other4 = "0";}else{$cost_other4 = number_format($cost_other4,2);}
		if($cost_other5 == ""){$cost_other5 = "0";}else{$cost_other5 = number_format($cost_other5,2);}
		if($cost_other6 == ""){$cost_other6 = "0";}else{$cost_other6 = number_format($cost_other6,2);}
		if($cost_other7 == ""){$cost_other7 = "0";}else{$cost_other7 = number_format($cost_other7,2);}
		if($cost_other8 == ""){$cost_other8 = "0";}else{$cost_other8 = number_format($cost_other8,2);}
		if($cost_other10 == ""){$cost_other10 = "0";}else{$cost_other10 = number_format($cost_other10,2);}
		if($cost_other12 == ""){$cost_other12 = "0";}else{$cost_other12 = number_format($cost_other12,2);}
		if($cost_other13 == ""){$cost_other13 = "0";}else{$cost_other13 = number_format($cost_other13,2);}

		
		$a_sdate=explode("-",$sr_stime);
		$sr_stime=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$job_open);
		$job_open=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$job_close);
		$job_close=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$job_balance);
		$job_balance=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$finfo = get_firstorder($conn,$cus_id);
		
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
<SCRIPT type=text/javascript src="../js/jquery-1.3.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
<SCRIPT type=text/javascript src="ajax.js"></SCRIPT>
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

function isNumberKey(e) {
	var keyCode = (e.which) ? e.which : e.keyCode;
	if ((keyCode >= 48 && keyCode <= 57) || (keyCode == 8))
		return true;
	else if (keyCode == 46) {
		var curVal = document.activeElement.value;
		if (curVal != null && curVal.trim().indexOf('.') == -1)
			return true;
		else
			return false;
	}
	else
		return false;
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

	function submitForm() {
		document.getElementById("submitF").disabled = true;
		document.getElementById("resetF").disabled = true;
		document.form1.submit()
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
<P id=page-intro><?php  if ($mode == "add") { ?>Enter new information<?php  } else { ?>แก้ไข	[ค่าใช้จ่ายตามใบงาน]<?php  } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="index.php?page=<?php echo $_GET['page'];?>"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php  echo 'ค่าใช้จ่ายตามใบงาน'; ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
  <form action="cost.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
      <!--<legend><?php  echo $page_name; ?> </legend>-->
       <style>
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
	p.tby1{
		font-size:12px;
		font-weight:bold;
		padding-top:2px;
		padding-bottom:2px;	
	}
	
	</style>

	<!--<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="text-align:right;font-size:12px;">
        	<div style="position:relative;text-align:center;">
            	<img src="../images/form/header_service_report.png" width="100%" border="0" style="max-width:1182px;"/>
            </div>
		</td>
	  </tr>
	</table>-->
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
	  <tr>
	    <td width="43%"><strong>ชื่อลูกค้า :</strong>
	     <!-- <select name="cus_id" id="cus_id" onChange="checkfirstorder(this.value,'cusadd','cusprovince','custel','cusfax','contactid','datef','datet','cscont','cstel','sloc_name','sevlast','prolist');" style="width:300px;">
                	<option value="">กรุณาเลือก</option>
                	<?php  
						$qu_cusf = @mysqli_query($conn,"SELECT * FROM s_first_order ORDER BY cd_name ASC");
						while($row_cusf = @mysqli_fetch_array($qu_cusf)){
							?>
							<option value="<?php  echo $row_cusf['fo_id'];?>" <?php  if($row_cusf['fo_id'] == $cus_id){echo 'selected';}?>><?php  echo $row_cusf['cd_name']." (".$row_cusf['loc_name'].")";?></option>
							<?php 
						}
					?>
                </select>-->
                <?php  echo get_customername($conn,$cus_id);?>
                <input type="hidden" name="cus_id" value="<?php  echo $cus_id;?>">
                </td>
	    <td width="57%"><strong>ประเภทบริการลูกค้า :</strong>
	      <select name="sr_ctype" id="sr_ctype" disabled>
	        <!--<option value="">กรุณาเลือก</option>-->
	        <?php  
						$qu_cusftype = @mysqli_query($conn,"SELECT * FROM s_group_service ORDER BY group_name ASC");
						while($row_cusftype = @mysqli_fetch_array($qu_cusftype)){
							?>
	        <option value="<?php  echo $row_cusftype['group_id'];?>" <?php  if($row_cusftype['group_id'] == $sr_ctype){echo 'selected';}?>><?php  echo $row_cusftype['group_name'];?></option>
	        <?php 
						}
					?>
	        </select>
            <strong>ประเภทลูกค้า :</strong>
            	<select name="sr_ctype2" id="sr_ctype2" disabled>
            	  <!--<option value="">กรุณาเลือก</option>-->
            	  <?php  
						$qu_cusftype2 = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
						while($row_cusftype2 = @mysqli_fetch_array($qu_cusftype2)){
							?>
            	  <option value="<?php  echo $row_cusftype2['group_id'];?>" <?php  if($row_cusftype2['group_id'] == $sr_ctype2){echo 'selected';}?>><?php  echo $row_cusftype2['group_name'];?></option>
            	  <?php 
						}
					?>
          	  </select>
            </td>
	    </tr>
	  <tr>
	    <td><strong>ที่อยู่ :</strong> <span id="cusadd"><?php  echo $finfo['cd_address'];?></span></td>
	    <td><strong>เลขที่บริการ  :</strong><input type="text" name="sv_id" value="<?php  if($sv_id == ""){echo check_servicereport("SR".date("Y/m/"));}else{echo $sv_id;};?>" id="sv_id" class="inpfoder" style="border:0;" readonly><!--<input type="text" name="sv_id" value="<?php  if($sv_id == ""){echo "SR";}else{echo $sv_id;};?>" id="sv_id" class="inpfoder" style="border:0;">-->&nbsp;&nbsp;<strong>เลขที่สัญญา  :</strong><span id="contactid"><?php  echo $finfo['fs_id'];?></span></td>
	    </tr>
	  <tr>
	    <td><strong>จังหวัด :</strong> <span id="cusprovince"><?php  echo province_name($conn,$finfo['cd_province']);?></span></td>
	    <td><strong>วันที่ปิดงาน  :</strong> <span id="datef"></span><input type="text" name="job_close" readonly value="<?php  if($job_close==""){echo date("d/m/Y");}else{ echo $job_close;}?>" class="inpfoder"/>
	      <!--<script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'job_close'});</script>--><span id="datet"></span><input type="hidden" name="job_open" value="<?php  if($job_open==""){echo date("d/m/Y");}else{ echo $job_open;}?>" class="inpfoder"/><input type="hidden" name="job_balance" value="<?php  if($job_balance==""){echo date("d/m/Y");}else{ echo $job_balance;}?>" class="inpfoder"/></td>
	    </tr>
	  <tr>
	    <td><strong>โทรศัพท์ :</strong> <span id="custel"><?php  echo $finfo['cd_tel'];?></span><strong>&nbsp;&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> <span id="cusfax"><?php  echo $finfo['cd_fax'];?></span></td>
	    <td><strong>บริการครั้งล่าสุด : </strong><span id="sevlast"><?php  echo get_lastservice_f($conn,$cus_id,$sv_id);?></span> &nbsp;&nbsp;&nbsp;&nbsp;<strong><!--บริการครั้งต่อไป  :</strong><span style="font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
	      <input type="text" name="sr_stime" readonly value="<?php  if($sr_stime==""){echo date("d/m/Y");}else{ echo $sr_stime;}?>" class="inpfoder"/>
	      <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sr_stime'});</script>-->
	      </span></td>
	    </tr>
	  <tr>
	    <td><strong>ชื่อผู้ติดต่อ :</strong> <span id="cscont"><?php  echo $finfo['c_contact'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;<strong>เบอร์โทร :</strong> <span id="cstel"><?php  echo $finfo['c_tel'];?></span></td>
	    <td><strong>พนักงานขาย :</strong> <?php echo getsalenameFO($conn,$cus_id);?></td>
	    </tr>
	  </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
	  <tr>
	    <td width="46%"><strong>สถานที่ติดตั้ง / ส่งสินค้า : </strong><span id="sloc_name"><?php  echo $finfo['loc_name'];?></span><br /><br />
          <strong>ที่อยู่สาขา : </strong><?php echo getlocalAddressFO($conn,$cus_id);?>
         <br>
          <br />
            <strong>เครื่องล้างจาน / ยี่ห้อ : </strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;" id="lpa1">
            <?php  echo $loc_pro;?>
            </span><br>
            <br />
            <strong>รุ่นเครื่อง : </strong><?php  echo $loc_seal;?>&nbsp;&nbsp;&nbsp;<strong>S/N</strong>&nbsp;<span id="lpa3"><?php  echo $loc_sn;?></span><br /><br />
            <strong>เครื่องป้อนน้ำยา : </strong><?php  echo $loc_clean;?><br />
            <br>
	      <!--<strong>ช่างบริการประจำ :</strong>
            <select name="loc_contact" id="loc_contact" disabled>
                	<option value="">กรุณาเลือก</option>
                	<?php  
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
							<option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $loc_contact){echo 'selected';}?>><?php  echo $row_custec['group_name']. " (Tel : ".$row_custec['group_tel'].")";?></option>
							<?php 
						}
					?>
                </select>--></td>
	    <td width="54%" style="display: none;"><strong>ปริมาณน้ำยา</strong><br />
	      <br />
	      <strong>ปริมาณน้ำยาล้าง : </strong>
	      <input type="text" name="cl_01" value="<?php  echo $cl_01;?>" id="cl_01" class="inpfoder" style="width:20%;">
	      <strong>ml / rack</strong><br />
	      <br />
	      <strong>ปริมาณน้ำยาช่วยแห้ง : </strong>
	      <input type="text" name="cl_02" value="<?php  echo $cl_02;?>" id="cl_02" class="inpfoder" style="width:20%;">
	      <strong>ml / rack</strong><br />
	      <br />
	      <strong>ความเข้มข้น : </strong>
	      <input type="text" name="cl_03" value="<?php  echo $cl_03;?>" id="cl_03" class="inpfoder" style="width:20%;">
	      <strong>%</strong><br />
	      <br />
	      <strong>สต๊อกน้ำยา C =</strong>
	      <input type="text" name="cl_04" value="<?php  echo $cl_04;?>" id="cl_04" class="inpfoder" style="width:5%;">
	      <strong>ถัง R = </strong>
	      <input type="text" name="cl_05" value="<?php  echo $cl_05;?>" id="cl_05" class="inpfoder" style="width:5%;">
	      <strong>ถัง A =</strong>
	      <input type="text" name="cl_06" value="<?php  echo $cl_06;?>" id="cl_06" class="inpfoder" style="width:5%;">
	      <strong>ถัง</strong><br />
	      <strong><br />
	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WG = </span></strong>
	      <input type="text" name="cl_07" value="<?php  echo $cl_07;?>" id="cl_07" class="inpfoder" style="width:5%;">
	      <strong> ถัง RG = </strong>
	      <input type="text" name="cl_08" value="<?php  echo $cl_08;?>" id="cl_08" class="inpfoder" style="width:5%;">
	      <strong> ถัง </strong></td>
	    </tr>
	  </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb3" style="display: none;">
  <tr>
    <td width="48%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2"><strong>รายการตรวจเช็ค</strong></td>
      </tr>
      <tr>
        <td width="50%"><strong>ระบบไฟฟ้า</strong></td>
        <td width="50%"><strong>ระบบประปา</strong></td>
      </tr>
      <tr>
        <td ><input type="checkbox" name="ckl_list2[]" value="1" id="checkbox" <?php  if(@in_array('1', $ckl_list )){echo 'checked="checked"';}?>>
          ตรวจเช็คชุดควบคุม</td>
        <td ><input type="checkbox" name="ckw_list2[]" value="1" id="checkbox6" <?php  if(@in_array('1', $ckw_list )){echo 'checked="checked"';}?>>
          ตรวจเช็คน้ำรั่ว/ซึมภายนอก</td>
      </tr>
      <tr>
        <td ><input type="checkbox" name="ckl_list2[]" value="2" id="checkbox2" <?php  if(@in_array('2', $ckl_list )){echo 'checked="checked"';}?>>
          ตรวจเช็ค/ขัน Terminal</td>
        <td ><input type="checkbox" name="ckw_list2[]" value="2" id="checkbox7" <?php  if(@in_array('2', $ckw_list )){echo 'checked="checked"';}?>>
          ถอดล้างตะแกรงกรองเศษอาหาร</td>
      </tr>
      <tr>
        <td ><input type="checkbox" name="ckl_list2[]" value="3" id="checkbox3" <?php  if(@in_array('3', $ckl_list )){echo 'checked="checked"';}?>>
          วัดแรงดันไฟฟ้า และกระแสไฟฟ้า</td>
        <td ><input type="checkbox" name="ckw_list2[]" value="3" id="checkbox8" <?php  if(@in_array('3', $ckw_list )){echo 'checked="checked"';}?>>
          ถอดล้างสแตนเนอร์ Solinoid Value</td>
      </tr>
      <tr>
        <td ><input type="checkbox" name="ckl_list2[]" value="4" id="checkbox4" <?php  if(@in_array('4', $ckl_list )){echo 'checked="checked"';}?>>
          ตรวจเช็ค Heater</td>
        <td ><input type="checkbox" name="ckw_list2[]" value="4" id="checkbox9" <?php  if(@in_array('4', $ckw_list )){echo 'checked="checked"';}?>>
          ถอดล้างแขนฉีด/หัวฉีดน้ำ</td>
      </tr>
      <tr>
        <td ><input type="checkbox" name="ckl_list2[]" value="5" id="checkbox5" <?php  if(@in_array('5', $ckl_list )){echo 'checked="checked"';}?>>
          ตรวจเช็คมอเตอร์</td>
        <td ><input type="checkbox" name="ckw_list2[]" value="5" id="checkbox10" <?php  if(@in_array('5', $ckw_list )){echo 'checked="checked"';}?>>
          ทำความสะอาดภายใน/ภายนอก</td>
      </tr>
    </table></td>
    <td width="22%" style="vertical-align:top;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><strong>รายละเอียดการบริการและการแจ้งซ่อม</strong></td>
      </tr>
      <tr>
        <td><div class="setting" id="slapp">
          <div class="sc_wrap">
            <ul>
              <?php  
					 	$qu_fix = @mysqli_query($conn,"SELECT * FROM s_group_fix ORDER BY group_name ASC");
						$numfix = @mysqli_num_rows($qu_fix);
						$nd = 1;
						while($row_fix = @mysqli_fetch_array($qu_fix)){
							?>
              <li>
                <input type="checkbox" name="ckf_list2[]" onClick="CountChecks('listone',5,this,<?php  echo $numfix;?>)" value="<?php  echo $row_fix['group_id'];?>" id="checkbox<?php  echo $nd;?>" <?php  if(@in_array( $row_fix['group_id'] , $ckf_list )){echo 'checked="checked"';}?>>
                <label for="checkbox<?php  echo $nd;?>" style="font-weight:normal;"><?php  echo $row_fix['group_name'];?></label>
              </li>
              <?php 	
						$nd++;}
					 ?>
            </ul>
            <div class="clear"></div>
          </div>
        </div></td>
      </tr>
    </table></td>
     <td width="30%" style="vertical-align:top;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td style="text-align:center;"><strong>รายละเอียดการให้บริการ / ข้อเสนอแนะ</strong></td>
       </tr>
       <tr>
         <td style="text-align:left;"><span style="font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
           <textarea name="detail_recom2" class="inpfoder" id="detail_recom2" style="width:50%;height:180px;"><?php  echo strip_tags($detail_recom2);?></textarea>
         </span></td>
       </tr>
     </table></td>
  </tr>
</table>

	<?php  
		
		//$serviceID = substr($sv_id,3);
		$serviceID = $sv_id;
		//echo $serviceID;
		$row_service2 = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_service_report2 WHERE srid = '".trim($serviceID)."'"));

	?>
	<br>
<p class="tby1" style="display: none;"><strong>รายละเอียดการเปลี่ยนอะไหล่ / รายการใช้อุปกรณ์การติดตั้ง</strong> (เลขที่ใบเบิก <a href="../service_report2/update.php?mode=update&sr_id=<?php  echo $row_service2['sr_id'];?>&page=1&keyword=<?php  echo $row_service2['sv_id'];?>" target="_blank"><?php  echo $row_service2['sv_id'];?></a>)</p>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;display: none;">
    <tr>
      <td width="5%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="65%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา / ต่อหน่วย</strong></td>
      </tr>
    
    <?php  
		$qu_sr2 = @mysqli_query($conn,"SELECT * FROM s_service_report2sub WHERE sr_id = '".$row_service2['sr_id']."' AND codes != ''");
		$brf = 1;
		while($rowSRV = @mysqli_fetch_array($qu_sr2)){
	?>
		
	<tr>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><?php  echo $brf;?></td>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:left;"><?php  echo get_sparpart_name($conn,$rowSRV['lists']);?></td>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><?php  if($rowSRV['opens'] != 0){echo $rowSRV['opens'];}?></td>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><?php  if($rowSRV['prices'] != 0){echo number_format($rowSRV['prices']);}?></td>
    </tr>
    
	<?php 
	$brf++;
	}
	?>
    
    </table>
    <br>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;display: none;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong ><br />
            </strong></td>
          </tr>
          <tr>
            <td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ช่างบริการ</strong></td>
          </tr>
          <tr>
            <td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............<br />
              <br />
              เวลา............................................ </strong></td>
          </tr>
        </table></td>
        <td width="33%" style="border:1px solid #000000;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">&nbsp;</td>
          </tr>
          <tr>
            <td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้รับบริการ</strong></td>
          </tr>
          <tr>
            <td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............<br />
              <br />
              เวลา............................................ </strong></td>
          </tr>
        </table></td>
        <td width="33%" style="border:1px solid #000000;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">&nbsp;</td>
          </tr>
          <tr>
            <td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้ตรวจสอบ</strong></td>
          </tr>
          <tr>
            <td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............<br />
              <br />
              เวลา............................................ </strong></td>
          </tr>
        </table></td>
      </tr>
  </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ccontact" style="display: none;">
	  <tr>
	    <td valign="bottom" style="text-align:left;">&nbsp;</td>
	    <td valign="bottom" style="text-align:right;font-size:15px;"><strong>สายด่วน...งานบริการ 063-210-6557</strong></td>
      </tr>
    </table>
     </fieldset>
    </div>
    <style>
		table.tbCost tr td{
			padding: 0px !important;
    		line-height: 1.9em !important;
		}
		table.tbCost tr{
			background: none;
		}
		
		table.tbCost tbody tr.alt-row{
			background: none !important;
		}
		
	</style>
    <div class="formArea">
      
      <div style="margin-bottom: 30px;">
      	
      	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tbody>
			<tr>
			  <td style="border: 1px solid #000000;">
			  <p>
			    <strong>ค่าติดตั้ง</strong><br>
			  	<input type="radio" name="setup" value="600" <?php if($setup == '600'){echo 'checked';}?> class="fakeRadio"> 600 บาท (ก่อนเที่ยงคืน)<br>
			  	<input type="radio" name="setup" value="1000" <?php if($setup == '1000'){echo 'checked';}?> class="fakeRadio"> 1000 บาท (หลังเที่ยงคืน)<br>
			  	<input type="radio" name="setup" value="1500" <?php if($setup == '1500'){echo 'checked';}?> class="fakeRadio"> 1500 บาท (วันหยุดนักขัตฤกษ์)<br>
			  	<input type="radio" name="setup" value="" <?php if($setup == ''){echo 'checked';}?>> ไม่มีค่าติดตั้ง<br>
								
			  </p>
			  <p>
			    <strong>ค่าล่วงเวลา</strong><br>
			  	<input type="radio" name="ot" value="200" <?php if($ot == '200'){echo 'checked';}?>> 200 บาท (ก่อนเที่ยงคืน)<br>
			  	<input type="radio" name="ot" value="400" <?php if($ot == '400'){echo 'checked';}?>> 400 บาท (หลังเที่ยงคืน)<br>
			  	<input type="radio" name="ot" value="300" <?php if($ot == '300'){echo 'checked';}?>> 300 บาท (วันหยุดนักขัตฤกษ์)<br>
			  	
				<input type="radio" name="ot" value="" <?php if($ot == ''){echo 'checked';}?>> ไม่มีค่าล่วงเวลา<br>
			  </p>
			  <p>
			    <strong>ค่าเวรวันหยุด</strong><br>
<!--			  	<input type="radio" name="otH" value="0" <?php if($otH == '0'){echo 'checked';}?>> ค่าเวรวันหยุด -->
			  	<input type="text" name="ot_1" value="<?php echo $ot_1;?>" style="width: 60px;text-align: right;" onkeypress="return isNumberKey(event)"> บาท<br>
<!--			  	<input type="radio" name="otH" value="" <?php if($ot == ''){echo 'checked';}?>> ไม่มีค่าล่วงเวลา<br>-->
			  </p>
			  <p>
			  	<strong>ค่าเบี้ยเลี้ยง</strong><br>
			  	<input type="radio" name="pd" value="350" <?php if($pd == '350'){echo 'checked';}?>> 350 บาท/วัน<br>
			  	<!--<span style="padding-left: 20px;">จำนวน</span> <input type="text" name="ot_person" value="<?php echo $ot_person;?>" style="width: 60px;text-align: right;" onkeypress="return isNumberKey(event)"> คน / <input type="text" name="ot_day" value="<?php echo $ot_day;?>" style="width: 60px;text-align: right;" onkeypress="return isNumberKey(event)"> วัน<br>-->
				<span style="padding-left: 22px;">(ระยะทางเกิน 200 กม. ขึ้นไป)</span> <br>
				<input type="radio" name="pd" value="" <?php if($pd == ''){echo 'checked';}?>> ไม่มีค่าเบี้ยเลี้ยง<br>
			  </p>
			  </td>
			  <td rowspan="2" style="border: 1px solid #000000;">
			  	  <table style="border-collapse: separate;" class="tbCost">
						<tr>
							<td colspan="2"><strong>รายละเอียดงาน</strong></td>
						</tr>
						<tr>
							<td>ใบงานเลขที่</td>
							<td><span><input type="text" name="detail1" value="<?php echo $sv_id;?>" style="width: 100px;text-align: right;" readonly><input type="hidden" name="detail1_" value="<?php echo $sv_id;?>"></span></td>
						</tr>
						<tr>
							<td>ชื่อช่าง</td>
							<td><span><input type="text" name="detail2" value="<?php echo get_technician_name($conn,$loc_contact);?>" style="width: 144px;text-align: right;" readonly><input type="hidden" name="detail2_" value="<?php echo $loc_contact;?>"></span></td>
						</tr>
						<tr>
							<td>วันที่เข้ารับบริการ</td>
							<td><span><input type="text" name="detail3" value="<?php echo $detail3;?>" style="width: 100px;text-align: right;"></span><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'detail3'});</script></td>
						</tr>
						<tr>
							<td>เข้ารับบริการ</td>
							<td><span><input type="text" name="detail3_1" value="<?php echo $detail3_1;?>" style="width: 100px;text-align: right;" onkeypress="return isNumberKey(event)"></span> วัน</td>
						</tr>
						<tr>
							<td>ใบเสนอราคาเลขที่</td>
							<td><span><input type="text" name="detail4" value="<?php echo $detail4;?>" style="width: 100px;text-align: right;"></span></td>
						</tr>
						<tr>
							<td>ใบเสนอราคาค่าแรงเลขที่</td>
							<td><span><input type="text" name="detail5" value="<?php echo $detail5;?>" style="width: 100px;text-align: right;"></span></td>
						</tr>
						<tr>
							<td>จำนวนเงินที่เบิกล่วงหน้า</td>
							<td><span><input type="text" name="detail6" value="<?php echo $detail6;?>" style="width: 100px;text-align: right;" onkeypress="return isNumberKey(event)"></span> บาท</td>
						</tr>
						<tr>
							<td><strong>รวมค่าใช้จ่ายทั้งสิ้น</strong></td>
							<td><span><input type="text" name="detail7" value="<?php echo $detail7;?>" style="width: 100px;text-align: right;" onkeypress="return isNumberKey(event)" readonly></span> บาท</td>
						</tr>
						<tr>
							<td>จำนวนเงินที่ต้องคืนบริษัท</td>
							<td><span><input type="text" name="detail8" value="<?php echo $detail8;?>" style="width: 100px;text-align: right;" onkeypress="return isNumberKey(event)" readonly></span> บาท</td>
						</tr>
						<tr>
							<td>จำนวนเงินที่บริษัทต้องจ่ายเพิ่ม</td>
							<td><span><input type="text" name="detail9" value="<?php echo $detail9;?>" style="width: 100px;text-align: right;" onkeypress="return isNumberKey(event)" readonly></span> บาท</td>
						</tr>
						<tr>
							<td>ช่างปฏิบัติงาน</td>
							<td>1. <select name="technician1">
                	<option value="">กรุณาเลือก</option>
                	<?php  
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
							<option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $technician1){echo 'selected';}?>><?php  echo $row_custec['group_name'];?></option>
							<?php 
						}
					?>
                </select> <br>
				2. <select name="technician2">
                	<option value="">กรุณาเลือก</option>
                	<?php  
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
							<option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $technician2){echo 'selected';}?>><?php  echo $row_custec['group_name'];?></option>
							<?php 
						}
					?>
                </select><br>
                3. <select name="technician3">
                	<option value="">กรุณาเลือก</option>
                	<?php  
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
							<option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $technician3){echo 'selected';}?>><?php  echo $row_custec['group_name'];?></option>
							<?php 
						}
					?>
                </select> <br>
				4. <select name="technician4">
                	<option value="">กรุณาเลือก</option>
                	<?php  
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
							<option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $technician4){echo 'selected';}?>><?php  echo $row_custec['group_name'];?></option>
							<?php 
						}
					?>
                </select><br>
                	5. <select name="technician5">
                	<option value="">กรุณาเลือก</option>
                	<?php  
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
							<option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $technician5){echo 'selected';}?>><?php  echo $row_custec['group_name'];?></option>
							<?php 
						}
					?>
                </select> <br>
				6. <select name="technician6">
                	<option value="">กรุณาเลือก</option>
                	<?php  
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
							<option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $technician6){echo 'selected';}?>><?php  echo $row_custec['group_name'];?></option>
							<?php 
						}
					?>
                </select><br>
                7. <select name="technician7">
                	<option value="">กรุณาเลือก</option>
                	<?php  
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
							<option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $technician7){echo 'selected';}?>><?php  echo $row_custec['group_name'];?></option>
							<?php 
						}
					?>
                </select> <br>
					8. <select name="technician8">
                	<option value="">กรุณาเลือก</option>
                	<?php  
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
							<option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $technician8){echo 'selected';}?>><?php  echo $row_custec['group_name'];?></option>
							<?php 
						}
					?>
                </select></td>
						</tr>
				  </table>

			  </td>
			  <td rowspan="2" style="border: 1px solid #000000;">
					<table style="border-collapse: separate;" class="tbCost">
						<tr>
							<td colspan="2"><strong>ค่าใช่จ่ายอื่นๆ</strong></td>
						</tr>
						<tr>
							<td>ค่าแก็ส</td>
							<td><span><input type="text" name="cost_other1" value="<?php echo $cost_other1;?>" style="width: 100px;text-align: right;" onkeypress="return isNumberKey(event)"></span> บาท</td>
						</tr>
						<tr>
							<td>ค่าน้ำมัน</td>
							<td><span><input type="text" name="cost_other2" value="<?php echo $cost_other2;?>" style="width: 100px;text-align: right;" onkeypress="return isNumberKey(event)"></span> บาท</td>
						</tr>
						<tr>
							<td>ค่าทางด่วน</td>
							<td><span><input type="text" name="cost_other3" value="<?php echo $cost_other3;?>" style="width: 100px;text-align: right;" onkeypress="return isNumberKey(event)"></span> บาท</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>ค่าจอดรถ</td>
							<td><span><input type="text" name="cost_other4" value="<?php echo $cost_other4;?>" style="width: 100px;text-align: right;" onkeypress="return isNumberKey(event)"></span> บาท</td>
						</tr>
						<tr>
							<td>ค่าที่พัก</td>
							<td><span><input type="text" name="cost_other5" value="<?php echo $cost_other5;?>" style="width: 100px;text-align: right;" onkeypress="return isNumberKey(event)"></span> บาท</td>
						</tr>
						<tr>
							<td>ค่ารับรอง</td>
							<td><span><input type="text" name="cost_other6" value="<?php echo $cost_other6;?>" style="width: 100px;text-align: right;" onkeypress="return isNumberKey(event)"></span> บาท</td>
						</tr>
						<tr>
							<td>ค่าปรับ/ค่าธรรมเนียม</td>
							<td><span><input type="text" name="cost_other7" value="<?php echo $cost_other7;?>" style="width: 100px;text-align: right;" onkeypress="return isNumberKey(event)"></span> บาท</td>
						</tr>
						<tr>
							<td>ค่าอุปกรณ์/อะไหล่</td>
							<td><span><input type="text" name="cost_other8" value="<?php echo $cost_other8;?>" style="width: 100px;text-align: right;" onkeypress="return isNumberKey(event)"></span> บาท</td>
						</tr>
						<tr>
							<td>ระบุอุปกรณ์/อะไหล่</td>
							<td><span><input type="text" name="cost_other9" value="<?php echo $cost_other9;?>" style="width: 150px;text-align: right;"> </td>
						</tr>
						<tr>
							<td>ค่าพาหนะ</td>
							<td><span><input type="text" name="cost_other10" value="<?php echo $cost_other10;?>" style="width: 100px;text-align: right;" onkeypress="return isNumberKey(event)"></span> บาท</td>
						</tr>
						<tr>
							<td>ระบุพาหนะที่ใช้</td>
							<td><span><input type="text" name="cost_other11" value="<?php echo $cost_other11;?>" style="width: 150px;text-align: right;"></td>
						</tr>
						<tr>
							<td>ค่าจัดส่ง/ค่าขนส่ง</td>
							<td><span><input type="text" name="cost_other12" value="<?php echo $cost_other12;?>" style="width: 100px;text-align: right;" onkeypress="return isNumberKey(event)"></span> บาท</td>
						</tr>
						<tr>
							<td>ค่าอื่นๆ</td>
							<td><span><input type="text" name="cost_other13" value="<?php echo $cost_other13;?>" style="width: 100px;text-align: right;" onkeypress="return isNumberKey(event)"></span> บาท</td>
						</tr>
						<tr>
							<td>อื่นๆระบุ</td>
							<td><span><input type="text" name="cost_other14" value="<?php echo $cost_other14;?>" style="width: 150px;text-align: right;"></td>
						</tr>
					</table>
			  </td>
			</tr>
			<tr style="background: none;">
			  <td style="border: 1px solid #000000;">
					<table style="border-collapse: separate;" class="tbCost">
						<tr>
							<td colspan="2"><strong>จากบริษัท โอเมกา ดิชวอชเชอร์ (ประเทศไทย) จำกัด</strong></td>
						</tr>
						<tr>
							<td>ถึง</td>
							<td><input type="text" name="travel" value="<?php echo $travel;?>" style="width: 250px;text-align: right;"></td>
						</tr>
						<tr>
							<td>ระยะทาง</td>
							<td><input type="text" name="distance" value="<?php echo $distance;?>" style="width: 100px;text-align: right;"> กม.</td>
						</tr>
				  </table>				
	          </td>
		    </tr>
		  </tbody>
		</table>
      	
      </div>
     
	  <input type="button" value="Submit" id="submitF" class="button" onclick="submitForm()">
      <input type="reset" name="Reset" id="resetF" value="Reset" class="button">
      <?php  
			$a_not_exists = array();
			post_param($a_param,$a_not_exists); 
			?>
      <input name="mode" type="hidden" id="mode" value="<?php  echo $_GET['mode'];?>">
      <input name="detail_calpr" type="hidden" id="detail_calpr" value="<?php  echo strip_tags($detail_calpr);?>">
      <input name="detail_recom" type="hidden" id="detail_recom" value="<?php  echo strip_tags($detail_recom);?>">
      <input name="st_setting" type="hidden" id="st_setting" value="<?php  echo $st_setting;?>">   
      <input name="<?php  echo $PK_field;?>" type="hidden" id="<?php  echo $PK_field;?>" value="<?php  echo $_GET[$PK_field];?>">
      <input name="srid" type="hidden" id="mode" value="<?php  echo $row_service2['sr_id'];?>">
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
<?php  /*if($msg_user==1){?>
<script language=JavaScript>alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');</script>
<?php  }*/?>
</script>>
</BODY>
</HTML>

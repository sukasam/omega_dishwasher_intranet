<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

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
		
		$a_sdate=explode("/",$_POST['job_balance']);
		$_POST['job_balance']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['loc_date2']);
		$_POST['loc_date2']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['loc_date3']);
		$_POST['loc_date3']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['sell_date']);
		$_POST['sell_date']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		if ($_POST['mode'] == "add") { 
		
			$_POST['detail_recom'] = nl2br($_POST['detail_recom']);
			$_POST['detail_calpr'] = nl2br($_POST['detail_calpr']);
			$_POST['detail_calpr'] = nl2br($_POST['detail_calpr']);
			
			$codes = $_POST['codes'];
			$lists = $_POST['lists'];
			$units = $_POST['units'];
			$prices = $_POST['prices'];
			$amounts = $_POST['amounts'];
			$opens = $_POST['opens'];
			$remains = $_POST['remains'];
			
			$_POST['job_last'] = get_lastservice_s($conn,$_POST['cus_id'],"");
			
			foreach ($_POST['ckf_list2'] as $value) {
				$checklist .= $value.',';
			}
			
			$_POST['ckf_list'] = substr($checklist,0,-1);
			
			$_POST['ckf_list'];
			
			include "../include/m_add.php";
			
			
			$id = mysqli_insert_id($conn);
			
			foreach($codes as $a => $b){
				//$BX_NAME[$a]
				@mysqli_query($conn,"INSERT INTO `s_service_report4sub` (`r_id`, `sr_id`, `codes`, `lists`, `units`, `prices`, `amounts`, `opens`, `remains`) VALUES (NULL, '".$id."', '".$codes[$a]."', '".$lists[$a]."', '".$units[$a]."', '".$prices[$a]."', '".$amounts[$a]."', '".$opens[$a]."', '".$remains[$a]."');");
				$idsp = mysqli_insert_id($conn);
				@mysqli_query($conn,"UPDATE `s_group_sparpart` SET `group_stock` = `group_stock` - '".$opens[$a]."' WHERE `group_id` = '".$lists[$a]."';");
				@mysqli_query($conn,"UPDATE `s_service_report4sub` SET `amounts` = `amounts` - '".$opens[$a]."' WHERE `r_id` = '".$idsp."';");
			}
				
			include_once("../mpdf54/mpdf.php");
			include_once("form_serviceopen.php");
			$mpdf=new mPDF('UTF-8'); 
			$mpdf->SetAutoFont();
			$mpdf->WriteHTML($form);
			$chaf = str_replace("/","-",$_POST['sv_id']); 
			$mpdf->Output('../../upload/service_report_open/'.$chaf.'.pdf','F');
			
			header ("location:index.php?" . $param); 
		}
		if ($_POST['mode'] == "update" ) {
			
			$_POST['detail_recom'] = nl2br($_POST['detail_recom']);
			$_POST['detail_calpr'] = nl2br($_POST['detail_calpr']);
			
			$codes = $_POST['codes'];
			$lists = $_POST['lists'];
			$units = $_POST['units'];
			$prices = $_POST['prices'];
			$amounts = $_POST['amounts'];
			$opens = $_POST['opens'];
			$remains = $_POST['remains'];
			$rid = $_POST['r_id'];
			
			$_POST['job_last'] = get_lastservice_f($conn,$_POST['cus_id'],$_POST['sv_id']);
			
			$filename = "";
			
			/*foreach ($_POST['ckf_list2'] as $value) {
				$checklist .= $value.',';
			}
			
			$_POST['ckf_list'] = substr($checklist,0,-1);
			
			$_POST['ckf_list'];*/
			 
			include ("../include/m_update.php");
			
			/*if ($_FILES['ufimages']['name'] != "") { 
				$mname="";
				$mname=gen_random_num(5);
				$a_size = array('100');				
				foreach($a_size as $key => $value) {
					$path = "../../upload/install/";
					@unlink($path.$_POST['u_images']);
					$quality = 80;
					if($filename == "")
						$name_data=explode(".",$_FILES['ufimages']['name']);
						$type=$name_data[1];
						$filename =$mname.".".$type;
						list($width, $height) = getimagesize($_FILES['ufimages']['name']);
						uploadfile($path,$filename,$_FILES['ufimages']['tmp_name'],$width, $quality);
				} // end foreach				
				$sql = "update $tbl_name set u_images = '$filename' where $PK_field = '".$_POST[$PK_field]."' ";
				@mysqli_query($conn,$sql);				
				
				$_POST['filenames'] = '<img src="../../upload/install/'.$filename.'" width="600">';
				
			} // end if ($_FILES[ufimages][name] != "")*/
			
			if ($_FILES['ufimages']['name'] != "") { 
				$mname="";	
				$mname=gen_random_num(5);
				$a_size = array('600');	
				$filename = "";
					foreach($a_size as $key => $value) {
						$path = "../../upload/install/".$value."/";
						$quality = 80;
						if($filename == "")	
							$name_data=explode(".",$_FILES['ufimages']['name']);
							$type=$name_data[1];
							$filename =$mname.".".$type;
							list($width, $height) = getimagesize($_FILES['ufimages']['name']);
							$sizes = $value;
							uploadfile($path,$filename,$_FILES['ufimages']['tmp_name'],$sizes, $quality);
					} // end foreach				
					$sql = "update $tbl_name set u_images = '$filename' where $PK_field = '".$_POST[$PK_field]."' ";
					@mysqli_query($conn,$sql);				
					
					$_POST['filenames'] = '<br /><br />
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td style="text-align:center;font-size:12px;"><strong>รูปภาพงานติดตั้ง</strong></td>
						  </tr>
						  <tr>
							<td style="text-align:center;font-size:12px;"><img src="'.$path.$filename.'" width="600"></td>
						  </tr>
						</table>';
						
				} // end if ($_FILES[file1][name] != "")
				else{
					if(!empty($_POST['u_images'])){
						$_POST['filenames'] = '<br /><br />
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td style="text-align:center;font-size:12px;"><strong>รูปภาพงานติดตั้ง</strong></td>
						  </tr>
						  <tr>
							<td style="text-align:center;font-size:12px;"><img src="'.$path.$_POST['u_images'].'" width="600"></td>
						  </tr>
						</table>';
					}else{
						$_POST['filenames'] = '';
					}
				}
			
			
			
			$id = $_REQUEST[$PK_field];		
			
			foreach($codes as $a => $b){
				$resupdate = get_plusminus($conn,"s_group_sparpart","s_service_report4sub",$rid[$a],$lists[$a]);
				
				@mysqli_query($conn,"UPDATE `s_service_report4sub` SET `codes` = '".$codes[$a]."', `lists` = '".$lists[$a]."', `units` = '".$units[$a]."', `prices` = '".$prices[$a]."', `opens` = '".$opens[$a]."' WHERE `r_id` =".$rid[$a]."");
				@mysqli_query($conn,"UPDATE `s_group_sparpart` SET `group_stock` = `group_stock` - '".$opens[$a]."' WHERE `group_id` = '".$lists[$a]."';");
				
				$amount = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `s_group_sparpart` WHERE `group_id` = '".$lists[$a]."';"));
								
				@mysqli_query($conn,"UPDATE `s_service_report4sub` SET `amounts` = '".$amount['group_stock']."' WHERE `r_id` = '".$rid[$a]."';");	
				
				if($opens[$a] == 0){
					@mysqli_query($conn,"UPDATE `s_service_report4sub` SET `codes` = '', `lists` = '', `units` = '', `prices` = '', `amounts` = '', `opens` = '', `remains` = '' WHERE `r_id` =".$rid[$a]."");
				}
			}		
				
			include_once("../mpdf54/mpdf.php");
			include_once("form_serviceopen.php");
			$mpdf=new mPDF('UTF-8'); 
			$mpdf->SetAutoFont();
			$mpdf->WriteHTML($form);
			$chaf = str_replace("/","-",$_POST['sv_id']); 
			$mpdf->Output('../../upload/service_report_open/'.$chaf.'.pdf','F');
			
			header ("location:index.php?" . $param); 
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
		
		$a_sdate=explode("-",$sr_stime);
		$sr_stime=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$job_open);
		$job_open=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$job_close);
		$job_close=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$job_balance);
		$job_balance=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$loc_date2);
		$loc_date2=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$loc_date3);
		$loc_date3=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$sell_date);
		$sell_date=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$finfo = get_firstorder($conn,$cus_id);
		
		$ckf_list = explode(',',$ckf_list);
		
	}
	
	//--------------------------------------------------------------------------------
	if($_GET['del_id'] <> ""){	
		$a_size = array('100');	
		foreach($a_size as $key => $value) {	
			if(file_exists("../../upload/install/600/".$_GET['del_id']))
			@unlink("../../upload/install/600/".$_GET['del_id']);		
		}	
			$sql = "update $tbl_name set u_images ='' where $PK_field = '$_GET[$PK_field]' ";
			@mysqli_query($conn,$sql);	
			 
		    @header ("location:update.php?mode=update&sr_id=".$_GET['sr_id'].""); 
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
<SCRIPT language=Javascript>
      function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</SCRIPT>
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

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="text-align:right;font-size:12px;">
			<div style="position:relative;text-align:center;">
            	<img src="../images/form/header_service_report4.png" width="100%" border="0" style="max-width:1182px;"/>
            </div>
		</td>
	  </tr>
	</table>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td><strong>ชื่อลูกค้า :</strong> 
            	<!--<select name="cus_id" id="cus_id" onChange="checkfirstorder(this.value,'cusadd','cusprovince','custel','cusfax','contactid','datef','datet','cscont','cstel','sloc_name','sevlast','prolist');" style="width:300px;">
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
                <input name="cd_names" type="text" id="cd_names"  value="<?php  echo get_customername($conn,$cus_id);?>" style="width:50%;" readonly>
                <span id="rsnameid"><input type="hidden" name="cus_id" value="<?php  echo $cus_id;?>"></span><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
            </td>
            <td><strong>ประเภทบริการลูกค้า :</strong> 
            	<select name="sr_ctype" id="sr_ctype">
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
            	<select name="sr_ctype2" id="sr_ctype2">
            	  <!--<option value="">กรุณาเลือก</option>-->
            	  <?php  
						$qu_cusftype2 = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
						while($row_cusftype2 = @mysqli_fetch_array($qu_cusftype2)){
							if(substr($row_cusftype2['group_name'],0,2) == "SR"){
							?>
            	  <option value="<?php  echo $row_cusftype2['group_id'];?>" <?php  if($row_cusftype2['group_id'] == $sr_ctype2){echo 'selected';}?>><?php  echo $row_cusftype2['group_name'];?></option>
            	  <?php 
							}
						}
					?>
          	  </select>
                </td>
          </tr>
          <tr>
            <td><strong>ที่อยู่ :</strong> <span id="cusadd"><?php  echo $finfo['cd_address'];?></span></td>
            <td><strong>เลขที่บริการ : <input type="text" name="sv_id" value="<?php  if($sv_id == ""){echo check_servicereportinstall("IR ".date("Y/m/"));}else{echo $sv_id;};?>" id="sv_id" class="inpfoder" style="border:0;"><!--<input type="text" name="sv_id" value="<?php  if($sv_id == ""){echo "SR";}else{echo $sv_id;};?>" id="sv_id" class="inpfoder" style="border:0;">-->&nbsp;&nbsp;เลขที่สัญญา  :</strong> <span id="contactid"><?php  echo $finfo['fs_id'];?></span></td>
          </tr>
          <tr>
            <td><strong>จังหวัด :</strong> <span id="cusprovince"><?php  echo province_name($conn,$finfo['cd_province']);?></span></td>
            <td><strong>วันที่  :</strong> <span id="datef"></span><input type="text" name="job_open" readonly value="<?php  if($job_open==""){echo date("d/m/Y");}else{ echo $job_open;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'job_open'});</script></td>
          </tr>
          <tr>
            <td><strong>โทรศัพท์ :</strong> <span id="custel"><?php  echo $finfo['cd_tel'];?></span><strong>&nbsp;&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> <span id="cusfax"><?php  echo $finfo['cd_fax'];?></span></td>
            <td><strong>วันติดตั้ง :</strong> <span id="datet"></span>
              <input type="text" name="job_balance" readonly value="<?php  if($job_balance==""){echo date("d/m/Y");}else{ echo $job_balance;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'job_balance'});</script>
              <input type="hidden" name="job_close" value="<?php  if($job_close==""){echo date("d/m/Y");}else{ echo $job_close;}?>" class="inpfoder"/>
              <strong> วันที่ส่งงาน  :</strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <input type="text" name="sr_stime" readonly value="<?php  if($sr_stime==""){echo date("d/m/Y");}else{ echo $sr_stime;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sr_stime'});</script>
            </span>
              </td>
          </tr>
          <tr>
            <td><strong>ชื่อผู้ติดต่อ :</strong> <span id="cscont"><?php  echo $finfo['c_contact'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;<strong>เบอร์โทร :</strong> <span id="cstel"><?php  echo $finfo['c_tel'];?></span></td>
            <td><strong>เลขที่ใบงาน : 
              <input type="text" name="srid" value="<?php  echo $srid;?>" id="srid" class="inpfoder">
            </strong></td>
          </tr>
          <?php  
		  	if($_GET['mode'] == "update"){
				?>
				<tr class="formFields">
            <td nowrap class="name">&nbsp;</td>
            <td><span class="name"><strong>รูปภาพงานติดตั้ง</strong><br>
            </span>
              <input name="ufimages" type="file" id="ufimages">
              <br>
              <?php 
					  if(file_exists("../../upload/install/600/".$u_images)){?>
              <img src="../../upload/install/600/<?php  echo $u_images?>" width="155">[ <a href="?mode=<?php  echo $_GET['mode']?>&<?php  echo $PK_field?>=<?php  echo $$PK_field;?>&<?php  echo $FR_field?>=<?php  echo $$FR_field;?>&del_id=<?php  echo $u_images;?>&page=<?php  echo $page;?>">Delete</a>]
              <?php  }?>
              <input name="u_images" type="hidden" value="<?php  echo $u_images; ?>"></td>
          </tr>
				<?php 	
			}
		  ?>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
        <td width="36%"><strong>สถานที่ติดตั้ง / ส่งสินค้า : </strong><span id="sloc_name"><?php  echo $finfo['loc_name'];?></span><br />
          <br>
          <strong>เลือกสินค้า :</strong>
          <span id="prolist">
          		<?php  
				$prolist = get_profirstorder($conn,$cus_id);
				//$lispp = explode(",",$prolist);
				$plid = "<select name=\"bbfpro\" id=\"bbfpro\" onchange=\"get_podsn(this.value,'lpa1','lpa2','lpa3','".$cus_id."')\">
								<option value=\"\">กรุณาเลือก</option>       
							 ";
				for($i=0;$i<count($prolist);$i++){
					$plid .= "<option value=".$i.">".get_proname($conn,$prolist[$i])."</option>";
				}	
				echo $plid .=	 "</select>";
						?>
          </span>
          <br>
          <br />
            <strong>เครื่องล้างจาน / ยี่ห้อ : </strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;" id="lpa1">
            <input type="text" name="loc_pro" value="<?php  echo $loc_pro;?>" id="loc_pro" class="inpfoder" style="width:50%;">
            </span><br>
            <br />
            <strong>รุ่นเครื่อง : </strong><span id="lpa2"><input type="text" name="loc_seal" value="<?php  echo $loc_seal;?>" id="loc_seal" class="inpfoder" style="width:20%;"></span>&nbsp;&nbsp;&nbsp;<strong>S/N</strong>&nbsp;<span id="lpa3"><input type="text" name="loc_sn" value="<?php  echo $loc_sn;?>" id="loc_sn" class="inpfoder" style="width:20%;"></span><br /><br />
            <strong>เครื่องป้อนน้ำยา : </strong><input type="text" name="loc_clean" value="<?php  echo $loc_clean;?>" id="loc_clean" class="inpfoder" style="width:50%;"><br />
            <br>
            <strong>ช่างติดตั้ง :</strong>
            <select name="loc_contact" id="loc_contact">
                	<option value="">กรุณาเลือก</option>
                	<?php  
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
							<option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $loc_contact){echo 'selected';}?>><?php  echo $row_custec['group_name']. " (Tel : ".$row_custec['group_tel'].")";?></option>
							<?php 
						}
					?>
                </select></td>
        <td width="38%"><strong>ปริมาณน้ำยา</strong><br /><br />
            <strong>ปริมาณน้ำยาล้าง : </strong><input type="text" name="cl_01" value="<?php  echo $cl_01;?>" id="cl_01" class="inpfoder" style="width:20%;"> <strong>ml / rack</strong><br /><br />
            <strong>ปริมาณน้ำยาช่วยแห้ง : </strong><input type="text" name="cl_02" value="<?php  echo $cl_02;?>" id="cl_02" class="inpfoder" style="width:20%;"> <strong>ml / rack</strong><br /><br />
            <strong>ความเข้มข้น : </strong><input type="text" name="cl_03" value="<?php  echo $cl_03;?>" id="cl_03" class="inpfoder" style="width:20%;"> <strong>%</strong><br /><br />
            <strong>สต๊อกน้ำยา C =</strong> <input type="text" name="cl_04" value="<?php  echo $cl_04;?>" id="cl_04" class="inpfoder" style="width:5%;"> <strong>ถัง R = </strong><input type="text" name="cl_05" value="<?php  echo $cl_05;?>" id="cl_05" class="inpfoder" style="width:5%;"> <strong>ถัง A =</strong> <input type="text" name="cl_06" value="<?php  echo $cl_06;?>" id="cl_06" class="inpfoder" style="width:5%;"> <strong>ถัง</strong><br />
            <strong><br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WG = </span></strong><input type="text" name="cl_07" value="<?php  echo $cl_07;?>" id="cl_07" class="inpfoder" style="width:5%;"> <strong> ถัง RG = </strong><input type="text" name="cl_08" value="<?php  echo $cl_08;?>" id="cl_08" class="inpfoder" style="width:5%;"> <strong> ถัง </strong>
        </td>
        <td width="26%"><p><strong>- ค่าทางด่วน :</strong>
            <input type="text" name="mn_1" value="<?php  echo $mn_1;?>" id="mn_1" class="inpfoder" style="width:20%;">
          <strong>บาท</strong></p>
          <p><strong>- ค่าที่พัก : </strong>
            <input type="text" name="mn_2" value="<?php  echo $mn_2;?>" id="mn_2" class="inpfoder" style="width:20%;">
            <strong>บาท</strong></p>
          <p><strong>- ค่านำมัน : </strong>
            <input type="text" name="mn_3" value="<?php  echo $mn_3;?>" id="mn_3" class="inpfoder" style="width:20%;">
            <strong>บาท</strong></p>
          <p><strong>- ค่าแก๊ส : </strong>
            <input type="text" name="mn_5" value="<?php  echo $mn_5;?>" id="mn_5" class="inpfoder" style="width:20%;">
            <strong>บาท</strong></p>
          <p><strong>- อื่นๆ</strong>
            <strong>:</strong>
            <input type="text" name="mn_4" value="<?php  echo $mn_4;?>" id="mn_4" class="inpfoder" style="width:20%;">
            <strong>บาท</strong></p>
          <p><strong>รวมมูลค่า&nbsp;<?php  echo number_format($mn_1+$mn_2+$mn_3+$mn_4+$mn_5,2);?>&nbsp;บาท</strong></p></td>
      </tr>
    </table>
    <center>
      <br>
      <span style="font-size:18px;font-weight:bold;"><br>
      รายละเอียดการใช้อะไหล่</span>
      <br>
      <br>
    </center>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable" style="text-align:center;margin-top:5px;">
      <tr>
        <td width="4%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>ลำดับ</strong></td>
        <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>Code</strong></td>
        <td width="30%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><strong>รายการ</strong></td>
        <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>หน่วยนับ</strong></td>
        <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>ราคา/หน่วย</strong></td>
        <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>จำนวนใน Stock</strong></td>
        <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>จำนวนเบิก</strong></td>
        <!--<td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>จำนวนคงเหลือ</strong></td>-->
        </tr>
        <?php  
		 $qu = @mysqli_query($conn,"SELECT * FROM s_service_report4sub WHERE sr_id = '".$sr_id."' ORDER BY r_id ASC");
		 while($row_sub = @mysqli_fetch_array($qu)){
			 $brid[] = $row_sub['r_id'];
			 $bcodes[] = $row_sub['codes'];
			 $blists[] = $row_sub['lists'];
			 $bunits[] = $row_sub['units'];
			 $bprices[] = $row_sub['prices'];
			 $bamounts[] = $row_sub['amounts'];
			 $bopens[] = $row_sub['opens'];
			 $bremains[] = $row_sub['remains'];
	     }
		 for($i=1;$i<=18;$i++){
		?>
		<tr >
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><?php  echo $i;?></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="codes[]" id="codes<?php  echo $i;?>" value="<?php  echo $bcodes[$i-1];?>" style="width:100%" readonly><input type="hidden" name="r_id[]" value="<?php  echo $brid[$i-1]?>"></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">
        <span id="listss<?php  echo $i;?>"><select name="lists[]" id="lists<?php  echo $i;?>" class="inputselect" style="width:92%" onchange="showspare(this.value,'<?php  echo "codes".$i;?>','<?php  echo "units".$i;?>','<?php  echo "prices".$i;?>','<?php  echo "amounts".$i;?>')">
        <option value="">กรุณาเลือกรายการอะไหล่</option>
                <?php 
                	$qucgspare = @mysqli_query($conn,"SELECT * FROM s_group_sparpart ORDER BY group_name ASC");
					while($row_spare = @mysqli_fetch_array($qucgspare)){
					  ?>
					  	<option value="<?php  echo $row_spare['group_id'];?>" <?php  if($blists[$i-1] == $row_spare['group_id']){echo 'selected';}?>><?php  echo $row_spare['group_name'];?></option>
					  <?php 	
					}
				?>
            </select></span><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search2.php?resdata=<?php  echo $i;?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="units[]" id="units<?php  echo $i;?>" value="<?php  echo $bunits[$i-1];?>" style="width:100%;text-align:center;" readonly></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="prices[]" id="prices<?php  echo $i;?>" value="<?php  if($bprices[$i-1] != 0){echo $bprices[$i-1];}?>" style="width:100%;text-align:right;" readonly></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="amounts[]" id="amounts<?php  echo $i;?>" value="<?php  if($bamounts[$i-1] != 0){echo $bamounts[$i-1];}?>" style="width:100%;text-align:right;" readonly></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="opens[]" id="opens<?php  echo $i;?>" value="<?php  if($bopens[$i-1] != 0){echo $bopens[$i-1];}?>" style="width:100%;text-align:right;" onkeypress="return isNumberKey(event)"></td>
        <!--<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="remains[]" id="remains" value="<?php  if($bremains[$i-1] != 0){echo $bremains[$i-1];}?>" style="width:100%;text-align:right;"><input type="hidden" name="r_id[]" value="<?php  echo $brid[$i-1]?>"></td>-->
        </tr>
				<?php 	
			}
		?>
        <tr >
				  <td colspan="5" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>รวมจำนวนที่เบิก</strong></td>
				  <td colspan="3" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong>รายการ</strong></td>
				  </tr>
        <tr >
          <td colspan="5" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>ใช้จ่ายรวม (รวมมูลค่าอะไหล่ที่เบิก)</strong></td>
          <td colspan="3" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong>บาท</strong></td>
          </tr>
        <tr >
          <td colspan="5" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>ใช้จ่ายรวม (ค่าอะไหล่และอื่นๆ (จากช่างค่าน้ำมัน, ค่าทางด่วน, ที่พัก))</strong></td>
          <td colspan="3" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong>บาท</strong></td>
        </tr>
      </table>
    
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;margin-top:5px;">
	  <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >
                  <select name="loc_contact2" id="loc_contact2" style="width:50%;">
                      <?php  
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
                      <option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $loc_contact2){echo 'selected';}?>><?php  echo $row_custec['group_name']. " (Tel : ".$row_custec['group_tel'].")";?></option>
                      <?php 
						}
					?>
                  </select>
                </strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ช่างเบิก</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>
                  <input type="text" name="loc_date2" readonly value="<?php  if($loc_date2==""){echo date("d/m/Y");}else{ echo $loc_date2;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'loc_date2'});</script></td>
              </tr>
            </table>

        </td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>
                  <select name="cs_sell" id="cs_sell" class="inputselect" style="width:50%;">
                    <?php  
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician WHERE 1 AND (group_id = 12 OR group_id = 13) ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
                    <option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $cs_sell){echo 'selected';}?>><?php  echo $row_custec['group_name']. " (Tel : ".$row_custec['group_tel'].")";?></option>
                    <?php 
						}
					?>
                  </select>
                </strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้จ่ายอ่ะไหล่</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ :</strong>
                  <input type="text" name="sell_date" readonly value="<?php  if($sell_date==""){echo date("d/m/Y");}else{ echo $sell_date;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sell_date'});</script></td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >
                  <select name="loc_contact3" id="loc_contact3" style="width:50%;">
                    <?php  
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
                    <option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $loc_contact3){echo 'selected';}?>><?php  echo $row_custec['group_name']. " (Tel : ".$row_custec['group_tel'].")";?></option>
                    <?php 
						}
					?>
                  </select>
                </strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้อนุมัติ</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ :</strong>
                  <input type="text" name="loc_date3" readonly value="<?php  if($loc_date3==""){echo date("d/m/Y");}else{ echo $loc_date3;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'loc_date3'});</script></td>


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
      <input type="submit" name="Submit" value="Submit" class="button">
      <input type="reset" name="Submit" value="Reset" class="button">
      <?php  
			$a_not_exists = array();
			post_param($a_param,$a_not_exists); 
			?>
      <input name="mode" type="hidden" id="mode" value="<?php  echo $_GET['mode'];?>">
      <input name="ckl_list" type="hidden" id="ckl_list" value="<?php  echo $ckl_list;?>">
      <input name="ckw_list" type="hidden" id="ckw_list" value="<?php  echo $ckw_list;?>">
      <input name="detail_recom2" type="hidden" id="detail_recom2" value="<?php  echo strip_tags($detail_recom2);?>">
      
      <input name="cpro1" type="hidden" id="cpro1" value="<?php  echo $cpro1;?>">
      <input name="cpro2" type="hidden" id="cpro2" value="<?php  echo $cpro2;?>">
      <input name="cpro3" type="hidden" id="cpro3" value="<?php  echo $cpro3;?>">
      <input name="cpro4" type="hidden" id="cpro4" value="<?php  echo $cpro4;?>">
      <input name="cpro5" type="hidden" id="cpro5" value="<?php  echo $cpro5;?>">
      
      <input name="camount1" type="hidden" id="camount1" value="<?php  echo $camount1;?>">
      <input name="camount2" type="hidden" id="camount2" value="<?php  echo $camount2;?>">
      <input name="camount3" type="hidden" id="camount3" value="<?php  echo $camount3;?>">
      <input name="camount4" type="hidden" id="camount4" value="<?php  echo $camount4;?>">
      <input name="camount5" type="hidden" id="camount5" value="<?php  echo $camount5;?>">  
      
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

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
			
			$_POST['approve'] = 0;
			$_POST['st_setting'] = 0;
			$_POST['supply'] = 0;
			$_POST['approve_return'] = 0;
			

			$codes = $_POST['barcode'];
			$lists = $_POST['lists'];
			$units = $_POST['cnamecall'];
			// $prices = $_POST['prices'];
			$amounts = $_POST['cstock'];
			$opens = $_POST['camount'];
			// $remains = $_POST['remains'];
			
			$_POST['job_last'] = get_lastservice_s($conn,$_POST['cus_id'],"");
			

			include "../include/m_add.php";
			
			$id = mysqli_insert_id($conn);
			
			foreach($codes as $a => $b){
				
				if($lists[$a] != ""){
					if($opens[$a] == ""){
						$opens[$a] = 0;
					}
					@mysqli_query($conn,"INSERT INTO `s_service_report3sub` (`r_id`, `sr_id`, `codes`, `lists`, `units`, `prices`, `amounts`, `opens`, `remains`) VALUES (NULL, '".$id."', '".$codes[$a]."', '".$lists[$a]."', '".$units[$a]."', '0', '".$amounts[$a]."', '".$opens[$a]."', '0');");
					@mysqli_query($conn,"UPDATE `s_group_sparpart` SET `group_stock` = `group_stock` - '".$opens[$a]."' WHERE `group_id` = '".$lists[$a]."';");
				}
			}
			
				
			include_once("../mpdf54/mpdf.php");
			include_once("form_serviceopen.php");
			$mpdf=new mPDF('UTF-8'); 
			$mpdf->SetAutoFont();
			$mpdf->WriteHTML($form);
			$chaf = str_replace("/","-",$_POST['sv_id']); 
			$mpdf->Output('../../upload/service_report_open/'.$chaf.'.pdf','F');
			
			header ("location:../service_report/" . $param); 
		}
		if ($_POST['mode'] == "update" ) {
			
			$_POST['detail_recom'] = nl2br($_POST['detail_recom']);
			$_POST['detail_calpr'] = nl2br($_POST['detail_calpr']);
			
			$_POST['job_last'] = get_lastservice_f($conn,$_POST['cus_id'],$_POST['sv_id']);
			
			$codes = $_POST['barcode'];
			$lists = $_POST['lists'];
			$units = $_POST['cnamecall'];
			// $prices = $_POST['prices'];
			$amounts = $_POST['cstock'];
			$opens = $_POST['camount'];
			// $remains = $_POST['remains'];
			$rid = $_POST['r_id'];

			
			$sql2 = "select * from s_service_report3sub where sr_id = '".$_REQUEST[$PK_field]."'";
			$quPro = @mysqli_query($conn,$sql2);
			while($rowPro = mysqli_fetch_array($quPro)){
				@mysqli_query($conn,"UPDATE `s_group_sparpart` SET `group_stock` = `group_stock`+'".$rowPro['opens']."' WHERE `group_id` = '".$rowPro['lists']."';");
			}
			
			@mysqli_query($conn,"DELETE FROM `s_service_report3sub` WHERE `sr_id` = '".$_REQUEST[$PK_field]."'");
			 
			include ("../include/m_update.php");
			
			$id = $_REQUEST[$PK_field];		
			
			foreach($codes as $a => $b){
				
				if($lists[$a] != ""){
					if($opens[$a] == ""){
						$opens[$a] = 0;
					}
					@mysqli_query($conn,"INSERT INTO `s_service_report3sub` (`r_id`, `sr_id`, `codes`, `lists`, `units`, `prices`, `amounts`, `opens`, `remains`) VALUES (NULL, '".$id."', '".$codes[$a]."', '".$lists[$a]."', '".$units[$a]."', '0', '".$amounts[$a]."', '".$opens[$a]."', '0');");
					@mysqli_query($conn,"UPDATE `s_group_sparpart` SET `group_stock` = `group_stock` - '".$opens[$a]."' WHERE `group_id` = '".$lists[$a]."';");
				}
						
			}	
			
	
				
			include_once("../mpdf54/mpdf.php");
			include_once("form_serviceopen.php");
			$mpdf=new mPDF('UTF-8'); 
			$mpdf->SetAutoFont();
			$mpdf->WriteHTML($form);
			$chaf = str_replace("/","-",$_POST['sv_id']); 
//			echo '../../upload/service_report_open/'.$chaf.'.pdf';
//			exit();
			$mpdf->Output('../../upload/service_report_open/'.$chaf.'.pdf','F');
			
			header ("location:../service_report/" . $param); 
		}
		
	}
	if ($_GET['mode'] == "add") { 
		 Check_Permission($conn,$check_module,$_SESSION['login_id'],"add");
		
		$rowSR = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM s_service_report WHERE sr_id = '".$_GET['srid']."'"));
		 $finfo = get_firstorder($conn,$rowSR['cus_id']);
		
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
		
		$rowSR = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM s_service_report WHERE sr_id = '".$_GET['srid']."'"));
		
		$finfo = get_firstorder($conn,$rowSR['cus_id']);
		
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
		
		
		$ckf_list = explode(',',$ckf_list);
		
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
<script type="text/javascript" src="scriptform.js"></script> 
<META name=GENERATOR content="MSHTML 8.00.7600.16535">

<script language="JavaScript" src="../Carlender/calendar_us.js"></script>
<link rel="stylesheet" href="../Carlender/calendar.css">

<script>

var sparPartList = [];

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

	function submitForm() {
		document.getElementById("submitF").disabled = true;
		document.getElementById("resetF").disabled = true;
		document.form1.submit()
	}

	function getUrlVars() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,
			function(m, key, value) {
				vars[key] = value;
			});
		return vars;
	}



	function changeAmount(id) {
		console.log("change id = " + id)
		var amount = parseInt($("#camount" + id).val())
		console.log('amount=' + amount)
		var amountold = parseInt($("#camountold" + id).val())
		var amountdiv = parseInt(amountold - amount);

		var cstockold = parseInt($("#cstockold" + id).val())
		var stocknew = parseInt(cstockold + amountdiv);
		console.log("newstock=" + stocknew);

		//if (amount >= 1) {
		console.log(amount, id)
		let objSpareReplacing = sparPartList.find((o, i) => {
			if (o.group_id == id) {
				sparPartList[i] = {
					"group_id": o.group_id,
					"group_spar_barcode": o.group_spar_barcode,
					"group_name": o.group_name,
					"group_namecall": o.group_namecall,
					"group_stock": parseInt(cstockold + amountdiv),
					"group_qty": parseInt(amount)
				};
				return true; // stop searching
			}
		});

		var tableSpatList = '';

		for (i = 0; i < sparPartList.length; i++) {
			// if (sparPartList[i].group_qty >= 1) {
			tableSpatList += '<tr>';
			tableSpatList += '<td style="border:1px solid #000000;padding:5;text-align:center;">' + parseInt(i + 1) + '<input type="hidden" name="lists[]" value="' + sparPartList[i]['group_id'] + '" id="lists' + sparPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;"></td>';
			tableSpatList += '<td style="border:1px solid #000000;padding:5;text-align:center;">' + sparPartList[i]['group_spar_barcode'] + '<input type="hidden" name="barcode[]" value="' + sparPartList[i]['group_spar_barcode'] + '" id="barcode' + sparPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;"></td>';
			tableSpatList += '<td style="border:1px solid #000000;text-align:left;padding:5;">' + sparPartList[i]['group_name'] + '<input type="hidden" name="cname[]" value="' + sparPartList[i]['group_name'] + '" id="cname' + sparPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;"></td>';
			tableSpatList += '<td style="border:1px solid #000000;text-align:center;padding:5;">' + sparPartList[i]['group_namecall'] + '<input type="hidden" name="cnamecall[]" value="' + sparPartList[i]['group_namecall'] + '" id="cnamecall' + sparPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;"></td>';
			tableSpatList += '<td style="border:1px solid #000000;text-align:center;padding:5;">' + sparPartList[i]['group_stock'] + '<input type="hidden" name="cstock[]" value="' + sparPartList[i]['group_stock'] + '" id="cstock' + sparPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;"><input type="hidden" name="cstockold[]" value="' + sparPartList[i]['group_stock'] + '" id="cstockold' + sparPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;"></td>';
			tableSpatList += '<td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="camount[]" value="' + sparPartList[i]['group_qty'] + '" id="camount' + sparPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)" onchange="changeAmount(' + sparPartList[i]['group_id'] + ')"><input type="hidden" name="camountold[]" value="' + sparPartList[i]['group_qty'] + '" id="camountold' + sparPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;"></td>';
			tableSpatList += '</tr>';
			// }

		}
		$("#msg_scan").html('')
		$("#exp").html(tableSpatList);
		$('#scan_part').val('');
		$('#scan_part').focus();
		//}
		console.log(JSON.stringify(sparPartList))
	}


	$(document).ready(function() {

		if (getUrlVars()["mode"] === 'update') {
			$.ajax({
				type: "GET",
				url: "call_return.php?action=getSparScan&scan_part=" + getUrlVars()["sr_id"],
				success: function(data) {
					var listSpars = JSON.parse(data);
					if (listSpars.items.length >= 1) {
						sparPartList = listSpars.items;
					}
					console.log(JSON.stringify(sparPartList))
				}
			});
		}


		$("#scan_part").on('keyup', function(event) {
			if (event.keyCode === 13) {
				var scan_part = $('#scan_part').val();
				if (scan_part.length >= 5) {
					$.ajax({
						type: "GET",
						url: "call_return.php?action=chkSparScan&scan_part=" + scan_part,
						success: function(data) {
							var obj = JSON.parse(data);
							if (obj.status === 'yes') {

								var foundValue = sparPartList.filter(findSpar => findSpar.group_spar_barcode == obj.group_spar_barcode);
								// let objFind = arr.find(o => o.group_spar_barcode === obj.group_spar_barcode);

								if (foundValue.length <= 0) {
									var sparList = {
										"group_id": obj.group_id,
										"group_spar_barcode": obj.group_spar_barcode,
										"group_name": obj.group_name,
										"group_namecall": obj.group_namecall,
										"group_stock": parseInt(obj.group_stock)-parseInt(1),
										"group_qty": parseInt(1)
									}
									sparPartList.push(sparList);

								} else {

									let objSpareReplacing = sparPartList.find((o, i) => {
										if (o.group_spar_barcode == obj.group_spar_barcode) {
											sparPartList[i] = {
												"group_id": o.group_id,
												"group_spar_barcode": o.group_spar_barcode,
												"group_name": o.group_name,
												"group_namecall": o.group_namecall,
												"group_stock": parseInt(o.group_stock)-parseInt(1),
												"group_qty": parseInt(sparPartList[i].group_qty + 1)
											};
											return true; // stop searching
										}
									});
								}
								$('#scan_part').val('');
								$('#scan_part').focus();

								var tableSpatList = '';

								for (i = 0; i < sparPartList.length; i++) {
									// if (sparPartList[i].group_qty >= 1) {
									tableSpatList += '<tr>';
									tableSpatList += '<td style="border:1px solid #000000;padding:5;text-align:center;">' + parseInt(i + 1) + '<input type="hidden" name="lists[]" value="' + sparPartList[i]['group_id'] + '" id="lists' + sparPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;"></td>';
									tableSpatList += '<td style="border:1px solid #000000;padding:5;text-align:center;">' + sparPartList[i]['group_spar_barcode'] + '<input type="hidden" name="barcode[]" value="' + sparPartList[i]['group_spar_barcode'] + '" id="barcode' + sparPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;"></td>';
									tableSpatList += '<td style="border:1px solid #000000;text-align:left;padding:5;">' + sparPartList[i]['group_name'] + '<input type="hidden" name="cname[]" value="' + sparPartList[i]['group_name'] + '" id="cname' + sparPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;"></td>';
									tableSpatList += '<td style="border:1px solid #000000;text-align:center;padding:5;">' + sparPartList[i]['group_namecall'] + '<input type="hidden" name="cnamecall[]" value="' + sparPartList[i]['group_namecall'] + '" id="cnamecall' + sparPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;"></td>';
									tableSpatList += '<td style="border:1px solid #000000;text-align:center;padding:5;">' + sparPartList[i]['group_stock'] + '<input type="hidden" name="cstock[]" value="' + sparPartList[i]['group_stock'] + '" id="cstock' + sparPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;"><input type="hidden" name="cstockold[]" value="' + sparPartList[i]['group_stock'] + '" id="cstockold' + sparPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;"></td>';
									tableSpatList += '<td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="camount[]" value="' + sparPartList[i]['group_qty'] + '" id="camount' + sparPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)" onchange="changeAmount(' + sparPartList[i]['group_id'] + ')"><input type="hidden" name="camountold[]" value="' + sparPartList[i]['group_qty'] + '" id="camountold' + sparPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;"></td>';
									tableSpatList += '</tr>';
									// }

								}
								$("#msg_scan").html('')
								$("#exp").html(tableSpatList);
								console.log(JSON.stringify(sparPartList))
							} else {
								console.log(JSON.stringify(obj))
								$("#msg_scan").html('ไม่พบรหัสบาร์โค้ด')
								$('#scan_part').val('');
								$('#scan_part').focus();
							}
						}
					});
				} else {
					$("#msg_scan").html('ไม่พบรหัสบาร์โค้ด')
					$('#scan_part').val('');
					$('#scan_part').focus();
				}
			}
		});
	});
	
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
            	<img src="../images/form/header_service_report2.png" width="100%" border="0" style="max-width:1182px;"/>
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
                <input name="cd_names" type="text" id="cd_names"  value="<?php  echo get_customername($conn,$rowSR['cus_id']);?>" style="width:100%;" readonly>
                <span id="rsnameid"><input type="hidden" name="cus_id" value="<?php  echo $rowSR['cus_id'];?>"></span><!--<a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>-->
            </td>
            <td><strong>ประเภทบริการลูกค้า :</strong> 
            	<select name="sr_ctype" id="sr_ctype">
                	<!--<option value="">กรุณาเลือก</option>-->
                	<?php  
						$qu_cusftype = @mysqli_query($conn,"SELECT * FROM s_group_service ORDER BY group_name ASC");
						while($row_cusftype = @mysqli_fetch_array($qu_cusftype)){
							?>
							<option value="<?php  echo $row_cusftype['group_id'];?>" <?php  if($row_cusftype['group_id'] == $rowSR['sr_ctype']){echo 'selected';}?>><?php  echo $row_cusftype['group_name'];?></option>
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
            	  <option value="<?php  echo $row_cusftype2['group_id'];?>" <?php  if($row_cusftype2['group_id'] == $rowSR['sr_ctype2']){echo 'selected';}?>><?php  echo $row_cusftype2['group_name'];?></option>
            	  <?php 
							}
						}
					?>
          	  </select>
            	</td>
          </tr>
          <tr>
            <td><strong>ที่อยู่ :</strong> <span id="cusadd"><?php  echo $finfo['cd_address'];?></span></td>
            <td><strong><strong>เลขที่บริการ</strong> :
<input type="text" name="sv_id" value="<?php  if($sv_id == ""){echo check_serviceman2($conn);}else{echo $sv_id;};?>" id="sv_id" class="inpfoder" style="border:0;"><!--<input type="text" name="sv_id" value="<?php  if($sv_id == ""){echo "SR";}else{echo $sv_id;};?>" id="sv_id" class="inpfoder" style="border:0;">&nbsp;&nbsp;เลขที่สัญญา  :</strong> <span id="contactid"><?php  echo $finfo['fs_id'];?></span>--></td>
          </tr>
          <tr>
            <td><strong>จังหวัด :</strong> <span id="cusprovince"><?php  echo province_name($conn,$finfo['cd_province']);?></span></td>
            <td><strong>วันที่ยืมอะไหล่  :</strong> <span id="datef"></span>
              <input type="text" name="job_open" readonly value="<?php  if($job_open == ""){echo date("d/m/Y");}else{ echo $job_open;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'job_open'});</script></td>
          </tr>
          <tr>
            <td><strong>โทรศัพท์ :</strong> <span id="custel"><?php  echo $finfo['cd_tel'];?></span><strong>&nbsp;&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> <span id="cusfax"><?php  echo $finfo['cd_fax'];?></span></td>
            <td><!--<strong>บริการครั้งล่าสุด : </strong> <span id="sevlast"><?php  echo get_lastservice_f($conn,$cus_id,$sv_id);?></span> &nbsp;&nbsp;&nbsp;&nbsp;--><strong>กำหนดคืนอะไหล่ :</strong> <span id="datet"></span>
              <input type="text" name="job_balance" readonly value="<?php  if($job_balance==""){echo date("d/m/Y");}else{ echo $job_balance;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'job_balance'});</script>
              <input type="hidden" name="job_close" value="<?php  if($job_close==""){echo date("d/m/Y");}else{ echo $job_close;}?>" class="inpfoder"/></td>
          </tr>
          <tr>
            <td><strong>ชื่อผู้ติดต่อ :</strong> <span id="cscont"><?php  echo $finfo['c_contact'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;<strong>เบอร์โทร :</strong> <span id="cstel"><?php  echo $finfo['c_tel'];?></span></td>
            <td><strong>วันที่คืนอะไหล่  :</strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <input type="text" name="sr_stime" readonly value="<?php  if($sr_stime==""){echo date("d/m/Y");}else{ echo $sr_stime;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sr_stime'});</script>
            </span></td>
          </tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
      <tr>
        <td width="50%"><strong>สถานที่ติดตั้ง / ส่งสินค้า : </strong><span id="sloc_name"><?php  echo $finfo['loc_name'];?></span><br />
          <br>
          <!--<strong>เลือกสินค้า :</strong>
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
          <br>-->
          <br />
            <strong>เครื่องล้างจาน / ยี่ห้อ : </strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;" id="lpa1">
            <input type="text" name="loc_pro" value="<?php  echo $rowSR['loc_pro'];?>" id="loc_pro" class="inpfoder" style="width:50%;">
            </span><br>
            <br />
            <strong>รุ่นเครื่อง : </strong><span id="lpa2"><input type="text" name="loc_seal" value="<?php  echo $rowSR['loc_seal'];?>" id="loc_seal" class="inpfoder" style="width:20%;"></span>&nbsp;&nbsp;&nbsp;<strong>S/N</strong>&nbsp;<span id="lpa3"><input type="text" name="loc_sn" value="<?php  echo $rowSR['loc_sn'];?>" id="loc_sn" class="inpfoder" style="width:20%;"></span><br /><br />
            <strong>เครื่องป้อนน้ำยา : </strong><input type="text" name="loc_clean" value="<?php  echo $rowSR['loc_clean'];?>" id="loc_clean" class="inpfoder" style="width:50%;"><br />
            <br>
            <strong>ช่างบริการประจำ :</strong>
            <select name="loc_contact" id="loc_contact">
                	<option value="">กรุณาเลือก</option>
                	<?php  
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
							<option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $rowSR['loc_contact']){echo 'selected';}?>><?php  echo $row_custec['group_name']. " (Tel : ".$row_custec['group_tel'].")";?></option>
							<?php 
						}
					?>
                </select></td>
                
        <td width="50%"><center>
        <strong>อาการเสีย</strong>
        </center><br><br>
        <textarea name="detail_recom" class="inpfoder" id="detail_recom" style="width:50%;height:100px;background:#FFFFFF;"><?php  echo strip_tags($detail_recom);?></textarea></td>
      </tr>
    </table>
    
    <center>
      <br>
      <span style="font-size:18px;font-weight:bold;">รายละเอียดการเปลี่ยนอะไหล่</span></center><br>
	  <div>
			<center><strong>แสกนรหัสอะไหล่ : </strong><input name="scan_part" type="text" id="scan_part" value="" size="30"> <span id="msg_scan" style="color:red;font-weight: bold;"></span></center><br>
	</div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable" style="text-align:center;margin-top:5px;">
      <tr>
        <td width="4%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>ลำดับ</strong></td>
        <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>รหัสบาร์โค้ด</strong></td>
        <td width="30%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><strong>รายการ</strong></td>
        <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>หน่วยนับ</strong></td>
        <!-- <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>ราคา/หน่วย</strong></td> -->
        <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>จำนวนใน Stock</strong></td>
        <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>จำนวนเบิก</strong></td>
       <!-- <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>จำนวนคงเหลือ</strong></td>-->
        </tr>
		<tbody id="exp" name="exp">
        <?php  
		 $runRow = 1;
		 $qu = @mysqli_query($conn,"SELECT * FROM s_service_report3sub WHERE sr_id = '".$sr_id."' ORDER BY r_id ASC");
		 while($row_sub = @mysqli_fetch_array($qu)){
			//  $brid[] = $row_sub['r_id'];
			//  $bcodes[] = $row_sub['codes'];
			//  $blists[] = $row_sub['lists'];
			//  $bunits[] = $row_sub['units'];
			//  $bprices[] = $row_sub['prices'];
			//  $bamounts[] = $row_sub['amounts'];
			//  $bopens[] = $row_sub['opens'];
			//  $bremains[] = $row_sub['remains'];
			?>
			<tr>
				<td style="border:1px solid #000000;padding:5;text-align:center;"><?php echo $runRow; ?><input type="hidden" name="lists[]" value="<?php echo $row_sub['lists']; ?>" id="lists<?php echo $row_sub['lists']; ?>" class="inpfoder" style="width:100%;text-align:center;"></td>
				<td style="border:1px solid #000000;padding:5;text-align:center;"><?php echo $row_sub['codes']; ?><input type="hidden" name="barcode[]" value="<?php echo $row_sub['codes']; ?>" id="barcode<?php echo $row_sub['lists']; ?>" class="inpfoder" style="width:100%;text-align:center;"></td>
				<td style="border:1px solid #000000;text-align:left;padding:5;"><?php echo get_sparpart_name($conn, $row_sub['lists']); ?><input type="hidden" name="cname[]" value="<?php echo get_sparpart_name($conn, $row_sub['lists']); ?>" id="cname<?php echo $row_sub['lists']; ?>" class="inpfoder" style="width:100%;text-align:center;"></td>
				<td style="border:1px solid #000000;text-align:center;padding:5;"><?php echo $row_sub['units']; ?><input type="hidden" name="cnamecall[]" value="<?php echo $row_sub['units']; ?>" id="cnamecall<?php echo $row_sub['lists']; ?>" class="inpfoder" style="width:100%;text-align:center;"></td>
				<td style="border:1px solid #000000;text-align:center;padding:5;"><?php echo getStockSpar($conn, $row_sub['lists']); ?><input type="hidden" name="cstock[]" value="<?php echo getStockSpar($conn, $row_sub['lists']); ?>" id="cstock<?php echo $row_sub['lists']; ?>" class="inpfoder" style="width:100%;text-align:center;">
					<input type="hidden" name="cstockold[]" value="<?php echo getStockSpar($conn, $row_sub['lists']); ?>" id="cstockold<?php echo $row_sub['lists']; ?>" class="inpfoder" style="width:100%;text-align:center;">
				</td>
				<td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="camount[]" value="<?php echo $row_sub['opens']; ?>" id="camount<?php echo $row_sub['lists']; ?>" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)" onchange="changeAmount(<?php echo $row_sub['lists']; ?>)">
					<input type="hidden" name="camountold[]" value="<?php echo $row_sub['opens']; ?>" id="camountold<?php echo $row_sub['lists']; ?>" class="inpfoder" style="width:100%;text-align:center;">
				</td>
			</tr>
			<?php
	     
		 /*for($i=1;$i<=10;$i++){
		?>
		<tr >
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><?php  echo $i;?></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="codes[]" id="codes<?php  echo $i;?>" value="<?php  echo $bcodes[$i-1];?>" style="width:100%" readonly><input type="hidden" name="r_id[]" value="<?php  echo $brid[$i-1]?>"></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">
        <span id="listss<?php  echo $i;?>"><select name="lists[]" id="lists<?php  echo $i;?>" class="inputselect" style="width:92%" onchange="showspare(this.value,'<?php  echo "codes".$i;?>','<?php  echo "units".$i;?>','<?php  echo "prices".$i;?>','<?php  echo "amounts".$i;?>','<?php  echo "opens".$i;?>')">
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
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="amounts[]" id="amounts<?php  echo $i;?>" value="<?php   
		echo getStockSpar($conn,$blists[$i-1]);
		?>" style="width:100%;text-align:right;" readonly></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="opens[]" id="opens<?php  echo $i;?>" value="<?php  if($bopens[$i-1] != 0){echo $bopens[$i-1];}?>" style="width:100%;text-align:right;" onkeypress="return isNumberKey(event)"></td>
        <!--<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="remains[]" id="remains" value="<?php  if($bremains[$i-1] != 0){echo $bremains[$i-1];}?>" style="width:100%;text-align:right;"></td>-->
        </tr>
				<?php 	
			}*/
			$runRow++;
		}
		?>
		</tbody>
        <!-- <tr >
				  <td colspan="5" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>รวมจำนวนที่เบิก</strong></td>
				  <td colspan="3" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong>รายการ</strong></td>
				  </tr>
        <tr >
          <td colspan="5" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>ใช้จ่ายรวม (รวมมูลค่าอะไหล่ที่เบิก)</strong></td>
          <td colspan="3" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong>บาท</strong></td>
          </tr> -->
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
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ช่างยืม</strong></td>
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
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician WHERE 1 AND (group_id = 11) ORDER BY group_name ASC");
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
							if($loc_contact3 != ""){$loc_contact3 = $loc_contact3;}
							else{$loc_contact3 = 9;}
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
</table>
</td>
          </tr>
        </table>
        </fieldset>
    </div><br>
    <div class="formArea">
	<input type="button" value="Submit" id="submitF" class="button" onclick="submitForm()">
      <input type="reset" name="Reset" id="resetF" value="Reset" class="button">
      <?php  
			$a_not_exists = array();
			post_param($a_param,$a_not_exists); 
			?>
      <input name="mode" type="hidden" id="mode" value="<?php  echo $_GET['mode'];?>">
      <input name="ckl_list" type="hidden" id="ckl_list" value="<?php  echo $ckl_list;?>">
      <input name="ckw_list" type="hidden" id="ckw_list" value="<?php  echo $ckw_list;?>">
      <input name="detail_recom2" type="hidden" id="detail_recom2" value="<?php  echo strip_tags($detail_recom2);?>">
      
<!--
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
-->
      
      <input name="st_setting" type="hidden" id="border: 1px solid;" value="<?php   echo $st_setting;?>">   
      <input name="approve_return" type="hidden" id="border: 1px solid;" value="<?php   echo $approve_return;?>">   
      <input name="approve" type="hidden" id="approve" value="<?php   echo $approve;?>">  
      <input name="supply" type="hidden" id="supply" value="<?php   echo $supply;?>"> 
      <input name="srid" type="hidden" id="srid" value="<?php  echo $_GET['srid'];?>">         
    
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

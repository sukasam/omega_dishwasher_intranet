<?php    
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	if ($_POST["mode"] <> "") { 
		
		$param = "";
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);
		
		$a_sdate=explode("/",$_POST['sub_billdate']);
		$_POST['sub_billdate']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['stock_date']);
		$_POST['stock_date']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		
		if ($_POST["mode"] == "add") { 
			
				
				include "../include/m_add.php";
				$id = mysqli_insert_id($conn);

				for($i=0;$i<=count($_POST['cpro']);$i++){
					if($_POST['cpro'][$i] != ""){

						$_POST['cprice'][$i] = preg_replace("/,/","",$_POST['cprice'][$i]);
						
						$cost = $_POST['camount'][$i] * $_POST['cprice'][$i];
					
						@mysqli_query($conn,"INSERT INTO `s_group_sparpart_bill_pro` (`id`, `id_bill`, `sparpart_id`, `sparpart_qty`, `sparpart_unit_price`, `sparpart_total`) VALUES (NULL,'".$id."','".$_POST['cpro'][$i]."','".$_POST['camount'][$i]."','".$_POST['cprice'][$i]."','".$cost."');");
						
						@mysqli_query($conn,"UPDATE `s_group_sparpart` SET `group_stock` = `group_stock`+'".$_POST['camount'][$i]."' WHERE `group_id` = '".$_POST['cpro'][$i]."';");
					}
				}
			
			include_once("../mpdf54/mpdf.php");
			include_once("form_stockin.php");
			$mpdf=new mPDF('UTF-8'); 
			$mpdf->SetAutoFont();
			$mpdf->WriteHTML($form);
			$chaf = preg_replace("/\//","-",$id); 
			$mpdf->Output('../../upload/stockin/'.$chaf.'_sparpart.pdf','F');
				
			header ("location:index.php?" . $param); 
		}
		if ($_POST["mode"] == "update" ) { 
				
			
				$sql2 = "select * from s_group_sparpart_bill_pro where id_bill = '".$_REQUEST[$PK_field]."'";
				$quPro = @mysqli_query($conn,$sql2);
				while($rowPro = mysqli_fetch_array($quPro)){
					@mysqli_query($conn,"UPDATE `s_group_sparpart` SET `group_stock` = `group_stock`-'".$rowPro['sparpart_qty']."' WHERE `group_id` = '".$rowPro['sparpart_id']."';");
				}
			
				@mysqli_query($conn,"DELETE FROM `s_group_sparpart_bill_pro` WHERE `id_bill` = '".$_REQUEST[$PK_field]."'");
			
				include ("../include/m_update.php");
				$id = $_REQUEST[$PK_field];	
			
				for($i=0;$i<=count($_POST['cpro']);$i++){
					if($_POST['cpro'][$i] != ""){

						$_POST['cprice'][$i] = preg_replace("/,/","",$_POST['cprice'][$i]);
						
						$cost = $_POST['camount'][$i] * $_POST['cprice'][$i];
					
						@mysqli_query($conn,"INSERT INTO `s_group_sparpart_bill_pro` (`id`, `id_bill`, `sparpart_id`, `sparpart_qty`, `sparpart_unit_price`, `sparpart_total`) VALUES (NULL,'".$id."','".$_POST['cpro'][$i]."','".$_POST['camount'][$i]."','".$_POST['cprice'][$i]."','".$cost."');");
						
						@mysqli_query($conn,"UPDATE `s_group_sparpart` SET `group_stock` = `group_stock`+'".$_POST['camount'][$i]."' WHERE `group_id` = '".$_POST['cpro'][$i]."';");
					}
				}

			include_once("../mpdf54/mpdf.php");
			include_once("form_stockin.php");
			$mpdf=new mPDF('UTF-8'); 
			$mpdf->SetAutoFont();
			$mpdf->WriteHTML($form);
			$chaf = preg_replace("/\//","-",$id); 
			$mpdf->Output('../../upload/stockin/'.$chaf.'_sparpart.pdf','F');
			
			header ("location:index.php?" . $param); 
		}
	}
	if ($_GET["mode"] == "add") { 
		 Check_Permission($conn,$check_module,$_SESSION["login_id"],"add");
	}
	if ($_GET["mode"] == "update") { 
		 Check_Permission($conn,$check_module,$_SESSION["login_id"],"update");
		$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";
		$query = @mysqli_query($conn,$sql);
		while ($rec = @mysqli_fetch_array ($query)) { 
			$$PK_field = $rec[$PK_field];
			foreach ($fieldlist as $key => $value) { 
				$$value = $rec[$value];
			}
		}
		
		$a_sdate=explode("-",$sub_billdate);
		$sub_billdate=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$stock_date);
		$stock_date=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php     echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="../css/reset.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/style.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.9.1.min.js"></SCRIPT>
<!--
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
-->
<SCRIPT type=text/javascript src="../js/popup.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/accounting.js"></SCRIPT>
<SCRIPT type=text/javascript src="ajax.js"></SCRIPT>

<script language="JavaScript" src="../Carlender/calendar_us.js"></script>
<link rel="stylesheet" href="../Carlender/calendar.css">

<META name=GENERATOR content="MSHTML 8.00.7600.16535">
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
	
	//console.log(keyCode);
	
	if ((keyCode >= 48 && keyCode <= 57) || (keyCode == 8))
		return true;
	else if (keyCode == 46) {
		var curVal = document.activeElement.value;
		if (curVal != null && curVal.trim().indexOf('.') == -1)
			return true;
		else
			return false;
	}else if (keyCode == 45) {
		var curVal = document.activeElement.value;
		if (curVal != null && curVal.trim().indexOf('.') == -1)
			return true;
		else
			return false;
	}
	else
		return false;
}

function chksign(vals){
	//alert(vals);	
}
	
function changeSpar(key){
	//alert("sss");
	var sparChk = $('#cpro'+key).val();
	$.ajax({
		type: "GET",
		url: "call_return.php?action=chkSparID&group_id="+sparChk,
		success: function(data){
			var obj = JSON.parse(data);
			if(obj.status === 'yes'){
				$("#ccode"+key).html(obj.group_spro_id);
				$("#cpod"+key).val('');
				$("#camount"+key).val('0');
				$("#cprice"+key).val('0');
				$("#ctotal"+key).html('');
				checkTotal(key);
			}else{
				$("#ccode"+key).html('');
				$("#cpod"+key).val('');
				$("#camount"+key).val('0');
				$("#cprice"+key).val('0');
				$("#sumtotal").html('');
				checkTotal(key);
			}
		}
	});
}
	
function checkTotal(key){
	//console.log('Sumtotal : '+key);
	var camount = parseInt(accounting.unformat($("#camount"+key).val()));
	var cprice = parseInt(accounting.unformat($("#cprice"+key).val()));
	var total = 0;
	
	console.log(camount);
	console.log(cprice);
	console.log(total);

	if(camount == "" || camount == 0){
		$("#ctotal"+key).html(accounting.formatNumber(total));
	}
	
	if(cprice == "" || cprice == 0){
		$("#ctotal"+key).html(accounting.formatNumber(total));
	}
	
	if(cprice != 0 && camount != 0){
		total = parseInt(camount*cprice);
		$("#ctotal"+key).html(accounting.formatNumber(total));
	}
	
	var rowCal = $("#countexp").val();
	var sumTotal = 0;
	for(var i=1;i<rowCal;i++){
		if(accounting.unformat($("#camount"+i).val()) != "" && accounting.unformat($("#cprice"+i).val()) != ""){
			sumTotal = parseInt(sumTotal)+parseInt(accounting.unformat($("#camount"+i).val())*accounting.unformat($("#cprice"+i).val()));
		}
	}
	
	$("#sumtotal").html(accounting.formatNumber(sumTotal));
}

</script>
</HEAD>
<?php     include ("../../include/function_script.php"); ?>
<BODY>
<DIV id=body-wrapper>
<?php     include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php     include('../top.php');?>
<P id=page-intro><?php     if ($mode == "add") { ?>Enter new information<?php     } else { ?>แก้ไข	[<?php     echo $page_name; ?>]<?php     } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="index.php"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php     echo $page_name; ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
      <legend><?php     echo $page_name; ?> </legend>
	  <table>
		<tbody>
			<tr>
				<td>
					<table class="formFields" cellspacing="0" width="100%">
					  <tr >
						<td nowrap class="name">ผู้จำหน่าย / ส่งสินค้า</td>
						  <td><input name="sub_name" type="text" id="sub_name"  value="<?php     echo $sub_name; ?>" size="60"> 
						</td>
					  </tr>
					  <tr >
						<td nowrap class="name">ที่อยู่</td>
						<td><input name="sub_address" type="text" id="sub_address"  value="<?php   echo $sub_address; ?>" size="60"></td>
					  </tr>
					  <tr >
						<td nowrap class="name">เบอร์โทร</td>
						<td><input name="sub_tel" type="text" id="sub_tel"  value="<?php   echo $sub_tel; ?>" size="60"></td>
					  </tr>
					  <tr >
						<td nowrap class="name">วันที่รับเข้า</td>
						<td><input type="text" name="stock_date" readonly value="<?php     if($stock_date==""){echo date("d/m/Y");}else{ echo $stock_date;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'stock_date'});</script>
						</td>
					  </tr>
				  </table>
				</td>
				<td>
					<table class="formFields" cellspacing="0" width="100%">
					  <tr >
						<td nowrap class="name">เลขที่บิล</td>
						  <td><input name="sub_billnum" type="text" id="sub_billnum"  value="<?php     echo $sub_billnum; ?>" size="20%">&nbsp;&nbsp;วันที่บิล <input type="text" name="sub_billdate" readonly value="<?php     if($sub_billdate==""){echo date("d/m/Y");}else{ echo $sub_billdate;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sub_billdate'});</script>
						</td>
					  </tr>
					  <tr >
						<td nowrap class="name">หมายเหตุ</td>
						<td><input name="sub_comment" type="text" id="sub_comment"  value="<?php   echo $sub_comment; ?>" size="60"></td>
					  </tr>
					  <tr >
						<td nowrap class="name" colspan="2">
							<input name="sub_vat" type="radio" id="radio" value="1" <?php   if($sub_vat == 1){echo 'checked';}?>>Not vat &nbsp;
							<input name="sub_vat" type="radio" id="radio" value="2" <?php   if($sub_vat == 2 || $sub_vat == ""){echo 'checked';}?>>Vat 7%
						</td>
					  </tr>
					  <tr >
						<td nowrap class="name" colspan="2">&nbsp;

						</td>
					  </tr>
				  </table>
				</td>
			</tr>
		</tbody>
	</table>
  <br>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;">
    <tr>
      <td width="3%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="5%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>Code</strong></td>
      <td width="30%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา / ต่อหน่วย</strong></td>
      <td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวนเงิน</strong></td>
      
      
    </tr>
    <tbody id="exp" name="exp">
    <?php    
		$sub_id = $_GET['sub_id'];
		$quQry = mysqli_query($conn,"SELECT * FROM `s_group_sparpart_bill_pro` WHERE id_bill = '".$sub_id."' ORDER BY id ASC");
		$numRowPro = mysqli_num_rows($quQry);
		$rowCal = 1;
		$sumPrice = 0;
		$sumCost = 0;
		if($_GET['mode'] == "add"){
			for($i=1;$i<=10;$i++,$rowCal++){
				?>
				<tr>
				  <td style="border:1px solid #000000;padding:5;text-align:center;"><?php   echo $rowCal;?></td>
				  <td style="border:1px solid #000000;padding:5;text-align:center;" id="ccode<?php   echo $rowCal;?>">
				  <?php   echo $rowPro['ccode'];?></td>
				  <td style="border:1px solid #000000;text-align:left;padding:5;">
				  <select name="cpro[]" id="cpro<?php   echo $rowCal;?>" class="inputselect" style="width:90%;" onchange="changeSpar('<?php   echo $rowCal;?>');">
						<option value="">กรุณาเลือกรายการ</option>
						<?php    
							$qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_sparpart ORDER BY group_name ASC");
							while($row_qupro1 = @mysqli_fetch_array($qupro1)){
							  ?>
								<option value="<?php     echo $row_qupro1['group_id'];?>" <?php    if($rowPro['cpro'] == $row_qupro1['group_id']){echo 'selected';}?>><?php     echo $row_qupro1['group_name'];?></option>
							  <?php    	
							}
					  ?>
				  </select>
				  <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_spar.php?protype=cpro<?php   echo $rowCal;?>&ccode=ccode<?php   echo $rowCal;?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
				  </td>
				  <td style="border:1px solid #000000;padding:5;text-align:center;">
					<input type="text" name="camount[]" value="<?php   echo number_format($rowPro['camount']);?>" id="camount<?php     echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)" onblur="checkTotal('<?php   echo $rowCal;?>')">
				
				  </td>
				  <td style="border:1px solid #000000;padding:5;text-align:center;">
					<input type="text" name="cprice[]" value="<?php   echo number_format($rowPro['cprice']);?>" id="cprice<?php   echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)" onblur="checkTotal('<?php   echo $rowCal;?>')">
				  </td>
				  <td style="border:1px solid #000000;padding:5;text-align:right;" id="ctotal<?php   echo $rowCal;?>">
				  	<?php   echo number_format($rowPro['camount']*$rowPro['cprice'])?>
				  </td>
				</tr>
				<?php  
			}
		}else{
			while($rowPro = mysqli_fetch_array($quQry)){
				?>
				<tr>
				  <td style="border:1px solid #000000;padding:5;text-align:center;"><?php   echo $rowCal;?></td>
				  <td style="border:1px solid #000000;padding:5;text-align:center;" id="ccode<?php   echo $rowCal;?>">
				  <?php   echo get_sparpart_id($conn,$rowPro['sparpart_id']);?>
				  </td>
				  <td style="border:1px solid #000000;text-align:left;padding:5;">
				  <select name="cpro[]" id="cpro<?php     echo $rowCal;?>" class="inputselect" style="width:90%;" onchange="changeSpar('<?php   echo $rowCal;?>');">
						<option value="">กรุณาเลือกรายการ</option>
						<?php    
							$qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_sparpart ORDER BY group_name ASC");
							while($row_qupro1 = @mysqli_fetch_array($qupro1)){
							  ?>
								<option value="<?php     echo $row_qupro1['group_id'];?>" <?php    if($rowPro['sparpart_id'] == $row_qupro1['group_id']){echo 'selected';}?>><?php     echo $row_qupro1['group_name'];?></option>
							  <?php    	
							}
					  ?>
				  </select>
				  <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_spar.php?protype=cpro<?php   echo $rowCal;?>&ccode=ccode<?php   echo $rowCal;?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
				  </td>
				  <td style="border:1px solid #000000;padding:5;text-align:center;">
					<input type="text" name="camount[]" value="<?php     echo number_format($rowPro['sparpart_qty']);?>" id="camount<?php     echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)" onblur="checkTotal('<?php   echo $rowCal;?>')">
				  </td>
				  <td style="border:1px solid #000000;padding:5;text-align:center;">
					<input type="text" name="cprice[]" value="<?php     echo number_format($rowPro['sparpart_unit_price']);?>" id="cprice<?php     echo $rowCal;?>" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)" onblur="checkTotal('<?php   echo $rowCal;?>')">
				  </td>
				  <td style="border:1px solid #000000;padding:5;text-align:right;" id="ctotal<?php   echo $rowCal;?>">
					<?php   echo number_format($rowPro['sparpart_qty']*$rowPro['sparpart_unit_price'])?>
				  </td>
				</tr>
				<?php    
				$sumPrice = $sumPrice+($rowPro['sparpart_qty']*$rowPro['sparpart_unit_price']);
				$rowCal++;
			}
		}
	?>
    </tbody>
    <input type="text" hidden="hidden" value="<?php   echo $rowCal;?>" id="countexp" name="countexp"/>
    <tr>
      <td colspan="5" style="text-align: right;border: 1px solid #000000;padding: 5;vertical-align: middle;font-size: 15px;font-weight: bold;">จำนวนเงินรวมทั้งสิ้น</td>
      <td  style="text-align: left;border: 1px solid #000000;padding: 5;vertical-align: middle;text-align: right;font-size: 15px;font-weight: bold;" id="sumtotal"><?php     echo number_format($sumPrice);?></td>
      
    </tr>
   
    </table>
    
    <p style="margin-top: 10px;"><span><input  type="button" id="2" value="+ เพิ่มรายการอะไหล่"  onclick="addExp()"/></span><span style="padding-left: 10px;"><input  type="button" id="2" value="- ลบรายการอะไหล่"  onclick="delExp()"/></span></p>
    
	<script>
		
		var countBox = 0;
		
	 function addExp(){

			var newChild = document.createElement("tr");
		 
				countBox = $("#countexp").val();
		 
		 		var filedMore  = '<tr>';
		 			filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;">'+countBox+'</td>';
		 			filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;" id="ccode'+countBox+'">';
      				filedMore += '	</td>';
		 			filedMore += '	<td style="border:1px solid #000000;text-align:left;padding:5;">';
		 			filedMore += '		<select name="cpro[]" id="cpro'+countBox+'" class="inputselect" style="width:90%;" onchange="changeSpar(\''+countBox+'\');">';
		 			filedMore += '		<option value="">กรุณาเลือกรายการ</option>';
		 			filedMore += '';
		 			filedMore += '	</select>';	
		 			filedMore += '<a href="javascript:void(0);" onClick="windowOpener(\'400\', \'500\', \'\', \'search_spar.php?protype=cpro'+countBox+'&ccode=ccode'+countBox+'\');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>';
		 			filedMore += '	</td>';
      				filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;">';
      				filedMore += '		<input type="text" name="camount[]" value="0" id="camount'+countBox+'" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)" onblur="checkTotal(\''+countBox+'\')"></td>';
      				filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:center;">';
      				filedMore += '		<input type="text" name="cprice[]" value="0" id="cprice'+countBox+'" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)" onblur="checkTotal(\''+countBox+'\')"></td>';
		 			filedMore += '	<td style="border:1px solid #000000;padding:5;text-align:right;" id="ctotal'+countBox+'">';
      				filedMore += '	0</td>';
     				filedMore += '</tr>';
	

				$("#exp").append(filedMore);

				 countBox = parseInt(countBox) + parseInt(1);
		 
		 		$("#countexp").val(countBox);
		}
		
		function delExp() {
			
			var rowCount = document.getElementById("exp").rows.length;
			
			
			if(rowCount >= 1){
				document.getElementById("exp").deleteRow(-1);
				
				countBox = $("#countexp").val();
				
				countBox = parseInt(countBox) - parseInt(1);
				$("#countexp").val(countBox);
			}
			
		}
		
	</script>
	
    
        </fieldset>
    </div><br>
    <div class="formArea">
      <input type="submit" name="Submit" value="Submit" class="button">
      <input type="reset" name="Submit" value="Reset" class="button">
      <?php     
			$a_not_exists = array();
			post_param($a_param,$a_not_exists); 
			?>
      <input name="mode" type="hidden" id="mode" value="<?php     echo $_GET["mode"];?>">
      <input name="<?php     echo $PK_field;?>" type="hidden" id="<?php     echo $PK_field;?>" value="<?php     echo $_GET[$PK_field];?>">
    </div>
  </form>
</DIV>
</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php     include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
<?php     if($msg_user==1){?>
<script language=JavaScript>alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');</script>
<?php     }?>
</BODY>
</HTML>

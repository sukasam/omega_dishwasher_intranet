<?php
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
  include ("config.php");
  
  $vowels = array(",");

	if ($_POST['mode'] <> "") {
		$param = "";
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);

    $_POST['fo_inventory'] = '2';

		$a_sdate=explode("/",$_POST['date_forder']);
		$_POST['date_forder']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$a_sdate=explode("/",$_POST['cs_ship']);
		$_POST['cs_ship']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$a_sdate=explode("/",$_POST['cs_setting']);
		$_POST['cs_setting']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$a_sdate=explode("/",$_POST['date_quf']);
		$_POST['date_quf']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$a_sdate=explode("/",$_POST['date_qut']);
		$_POST['date_qut']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$_POST['ccomment'] = nl2br(addslashes($_POST['ccomment']));
		$_POST['qucomment'] = nl2br(addslashes($_POST['qucomment']));
		$_POST['remark'] = nl2br(addslashes($_POST['remark']));

		$_POST['separate'] = 0;

		$_POST["cprice1"] = str_replace($vowels,"",$_POST["cprice1"]);
		$_POST["cprice2"] = str_replace($vowels,"",$_POST["cprice2"]);
		$_POST["cprice3"] = str_replace($vowels,"",$_POST["cprice3"]);
		$_POST["cprice4"] = str_replace($vowels,"",$_POST["cprice4"]);
		$_POST["cprice5"] = str_replace($vowels,"",$_POST["cprice5"]);
		$_POST["cprice6"] = str_replace($vowels,"",$_POST["cprice6"]);
		$_POST["cprice7"] = str_replace($vowels,"",$_POST["cprice7"]);

		if ($_POST['mode'] == "add") {
				
				$_POST['fs_id'] = get_snfirstorders($conn,$_POST['fs_id']);
				$_POST['status_use'] = 1;
				$_POST['status'] = 0;
				$_POST['loc_name'] = addslashes($_POST['loc_name']);
			    $_POST['google_map'] = addslashes($_POST['google_map']);
			
				$chkSale = checkSaleMustApprove($conn,$_POST['cs_sell']);
			
				if($chkSale == '5'){
					$_POST['chkprocess'] = '1';
				}else{
					$_POST['chkprocess'] = '0';
				}
			
				for($i=1;$i<=7;$i++){

					if($_POST['cpro'.$i] != ""){
						if($_POST['camount'.$i] == ""){
							$_POST['camount'.$i] = 0;
						}
						
						@mysqli_query($conn,"UPDATE `s_group_typeproduct` SET `group_stock` = `group_stock` - '".$_POST['camount'.$i]."' WHERE `group_id` = '".$_POST['cpro'.$i]."';");
					}
				}	
			

				include "../include/m_add.php";
				$id = mysqli_insert_id($conn);
			
//	      if($chkSale == '0'){
//					@mysqli_query($conn,"UPDATE `s_first_order` SET `process` = '5' WHERE `s_first_order`.`fo_id` = ".$id.";");
//				}else{
//					@mysqli_query($conn,"UPDATE `s_first_order` SET `process` = '0' WHERE `s_first_order`.`fo_id` = ".$id.";");
//				}
			
        $sql_status = "update $tbl_name set status_use_date='".date("Y-m-d H:i:s")."' WHERE `s_first_order`.`fo_id` = ".$id.";";
        $process = '0';
        @mysqli_query($conn,"UPDATE `s_first_order` SET `process` = '0' WHERE `s_first_order`.`fo_id` = ".$id.";");

				
				include_once("../mpdf54/mpdf.php");
				include_once("form_firstorder.php");
				$mpdf=new mPDF('UTF-8');
				$mpdf->SetAutoFont();
				if($chkSale == '1'){
					$mpdf->showWatermarkText = true;
					$mpdf->WriteHTML('<watermarktext content="NOT YET APPROVED" alpha="0.4" />');
				}
				$mpdf->WriteHTML($form);
				$chaf = str_replace("/","-",$_POST['fs_id']);
        $mpdf->Output('../../upload/first_order/'.$chaf.'.pdf','F');
        
        setLogSystem($conn,$_SESSION["login_id"],$tbl_name,$_POST['mode'],addslashes($sqlIns));

			header ("location:index.php?" . $param);
		}
		if ($_POST['mode'] == "update" ) {
				
				$_POST['loc_name'] = addslashes($_POST['loc_name']);
			    $_POST['google_map'] = addslashes($_POST['google_map']);
				
				$bpro = $_POST['bpro'];
				$bpod = $_POST['bpod'];
				$bamount = $_POST['bamount'];
			
				foreach($bpro as $a => $b){

					if($bpro[$a] != ""){
						if($bamount[$a] == ""){
							$bamount[$a] = 0;
						}
						
						@mysqli_query($conn,"UPDATE `s_group_typeproduct` SET `group_stock` = `group_stock` + '".$bamount[$a]."' WHERE `group_id` = '".$bpro[$a]."';");
					}
				}
				
				include ("../include/m_update.php");
				$id = $_REQUEST[$PK_field];
			
			
				for($i=1;$i<=7;$i++){

					if($_POST['cpro'.$i] != ""){
						if($_POST['camount'.$i] == ""){
							$_POST['camount'.$i] = 0;
						}
						
						@mysqli_query($conn,"UPDATE `s_group_typeproduct` SET `group_stock` = `group_stock` - '".$_POST['camount'.$i]."' WHERE `group_id` = '".$_POST['cpro'.$i]."';");
					}
				}

				if($_POST['chkprocess'] == '0'){
					$process = '0';
					@mysqli_query($conn,"UPDATE `s_first_order` SET `process` = '".$process."' WHERE `s_first_order`.`fo_id` = ".$id.";");
					@mysqli_query($conn,"DELETE FROM `s_approve` WHERE tag_db = '".$tbl_name."' AND t_id = '".$id."'");
        }
        

				include_once("../mpdf54/mpdf.php");
				include_once("form_firstorder.php");
				$mpdf=new mPDF('UTF-8');
				$mpdf->SetAutoFont();
			
				if($_POST['chkprocess'] == '0'){
					$mpdf->showWatermarkText = true;
					$mpdf->WriteHTML('<watermarktext content="NOT YET APPROVED" alpha="0.4" />');
				}
				
				$mpdf->WriteHTML($form);
				$chaf = str_replace("/","-",$_POST['fs_id']);
        $mpdf->Output('../../upload/first_order/'.$chaf.'.pdf','F');
        
        setLogSystem($conn,$_SESSION["login_id"],$tbl_name,$_POST['mode'],addslashes($sqlIns));

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

		$a_sdate=explode("-",$date_forder);
		$date_forder=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$cs_ship);
		$cs_ship=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$cs_setting);
		$cs_setting=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$date_quf);
		$date_quf=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$date_qut);
		$date_qut=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
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
<!--<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>-->
<!--
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
-->
<SCRIPT type=text/javascript src="../js/popup.js"></SCRIPT>
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

function chksign(vals){
	//alert(vals);
}
	
function checkVal(c){
	//alert (c.value);
	//document.form1.textgaruntree.innerHtmnl = c.value;
	if(c.value == 2){
		document.getElementById("textgaruntree").innerHTML = 'เงินค่าเช่าล่วงหน้า';
	}else{
		document.getElementById("textgaruntree").innerHTML = 'เงินประกัน';
	}
	
}
	
function changePod(s1,s2,id,foid){
	
	var x = document.getElementById(s1).value;
	 //console.log(x,s2);
	
	$.ajax({
		type: "GET",
		url: "call_return.php?action=changeSN&pod="+x+"&id="+id+"&fo_id="+foid,
		success: function(data){
			var ds = data.split('|');
			//console.log(ds[1]);
			document.getElementById(s2).innerHTML = ds[1];
			document.getElementById('search_sn'+id).innerHTML = ds[2];
			
		}
	});
}

function submitForm() {
		document.getElementById("submitF").disabled = true;
		document.getElementById("resetF").disabled = true;
		document.form1.submit()
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

  var proPartList = [];

  function changeAmount(id) {
		console.log("change id = " + id)
		var amount = $("#camount" + id).val()
		console.log('amount=' + amount)
		if (amount.length >= 1) {

			let objSpareReplacing = proPartList.find((o, i) => {
				if (o.group_id == id) {
					proPartList[i] = {
						"group_id": o.group_id,
						"group_spar_barcode": o.group_spar_barcode,
						"group_name": o.group_name,
						"group_pro_pod":o.group_pro_pod,
						"group_pro_pod_name":o.group_pro_pod_name,
						"group_qty": parseInt(amount),
            "group_price": parseInt(o.group_price)
					};
					return true; // stop searching
				}
			});

			$('#scan_part').val('');
			$('#scan_part').focus();

      console.log(JSON.stringify(proPartList));
		}
	}

  function changePrice(id) {
		console.log("change id = " + id)
		var cpriceP = $("#cprice" + id).val()
		console.log('price=' + cpriceP)
		if (cpriceP.length >= 1) {

			let objSpareReplacing = proPartList.find((o, i) => {
				if (o.group_id == id) {
					proPartList[i] = {
						"group_id": o.group_id,
						"group_spar_barcode": o.group_spar_barcode,
						"group_name": o.group_name,
						"group_pro_pod":o.group_pro_pod,
						"group_pro_pod_name":o.group_pro_pod_name,
						"group_qty": parseInt(o.group_qty),
            "group_price": parseInt(cpriceP)
					};
					return true; // stop searching
				}
			});

			$('#scan_part').val('');
			$('#scan_part').focus();

      console.log(JSON.stringify(proPartList));
		}
	}

  function getUrlVars() {
			var vars = {};
			var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,
				function(m, key, value) {
					vars[key] = value;
				});
			return vars;
		}

  $(document).ready(function() {

    $.ajax({
		type: "GET",
		url: "call_return.php?action=getProScan&fo_id=" + getUrlVars()["fo_id"],
		success: function(data) {
			var listSpars = JSON.parse(data);
			if (listSpars.items.length >= 1) {
				proPartList = listSpars.items;
			}
			console.log(JSON.stringify(proPartList))
		}
	});

    $("#scan_part").on('keyup', function(event) {
      if (event.keyCode === 13) {
        var scan_part = $('#scan_part').val();
        $.ajax({
          type: "GET",
          url: "call_return.php?action=chkProScan&scan_part=" + scan_part,
          success: function(data) {
            var obj = JSON.parse(data);
            if (obj.status === 'yes') {

              var foundValue = proPartList.filter(findSpar => findSpar.group_id === obj.group_id);
              // let objFind = arr.find(o => o.group_spar_barcode === obj.group_spar_barcode);

              if (foundValue.length <= 0) {
                var sparList = {
                  "group_id": obj.group_id,
                  "group_spar_barcode": obj.group_spar_barcode,
                  "group_name": obj.group_name,
                  "group_pro_pod":obj.group_pro_pod,
                  "group_pro_pod_name":obj.group_pro_pod_name,
                  "group_qty": parseInt(1),
                  "group_price": parseInt(obj.group_price)
                }
                proPartList.push(sparList);

              } else {

                let objSpareReplacing = proPartList.find((o, i) => {
                  if (o.group_id === obj.group_id) {
                    proPartList[i] = {
                      "group_id": o.group_id,
                      "group_spar_barcode": o.group_spar_barcode,
                      "group_name": o.group_name,
                      "group_pro_pod":o.group_pro_pod,
                      "group_pro_pod_name":o.group_pro_pod_name,
                      "group_qty": parseInt(proPartList[i].group_qty + 1),
                      "group_price": parseInt(o.group_price)
                    };
                    return true; // stop searching
                  }
                });
              }
              $('#scan_part').val('');
              $('#scan_part').focus();
              $("#msg_scan").html('');

              // $("#exp").html('<p>กำลังโหลดข้อมูล...</p>');

              // $.ajax({
              //   type: "POST",
              //   data: { data: JSON.stringify(proPartList)},
              //   url: "call_return.php?action=genTablePro&fo_id=" + getUrlVars()["fo_id"],
              //   success: function(data) {
              //     $("#exp").html(data);
              //   }
              // });

              // var tableProList = '<tr>';
              //     tableProList += '<td width="3%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>';
              //     tableProList += '<td width="40%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>';
              //     tableProList += '<td width="21%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น</strong></td>';
              //     tableProList += '<td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>S/N</strong></td>';
              //     tableProList += '<td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>';
              //     tableProList += '<td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา / ต่อหน่วย</strong></td>';
              //     tableProList += '</tr>';

              // for (i = 0; i < proPartList.length; i++) {
              //   // if (proPartList[i].group_qty >= 1) {
              //     tableProList += '<tr>';
              //     tableProList += '<td style="border:1px solid #000000;padding:5;text-align:center;">' + parseInt(i + 1) + '</td>';
              //     tableProList += '<td style="border:1px solid #000000;padding:5;text-align:center;">' + proPartList[i]['group_name'] + '</td>';
              //     tableProList += '<td style="border:1px solid #000000;text-align:left;padding:5;">' + proPartList[i]['group_pro_pod'] + '</td>';
              //     tableProList += '<td style="border:1px solid #000000;text-align:left;padding:5;">' + proPartList[i]['group_pro_sn'] + '</td>';
              //     tableProList += '<td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="camount'+parseInt(i+1)+'" value="' + proPartList[i]['group_qty'] + '" id="camount' + proPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)" onchange="changeAmount(' + proPartList[i]['group_id'] + ')"></td>';
              //     tableProList += '<td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="cprice'+parseInt(i+1)+'" value="' + proPartList[i]['group_price'] + '" id="cprice' + proPartList[i]['group_id'] + '" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)" onchange="changePrice(' + proPartList[i]['group_id'] + ')"></td>';
              //     tableProList += '</tr>';
              //   // }

              // }
              
              //  console.log(JSON.stringify(proPartList))
            } else {
              console.log(JSON.stringify(obj))
              $("#msg_scan").html('ไม่พบรหัสบาร์โค้ดนี้')
              $('#scan_part').val('');
              $('#scan_part').focus();
            }
          }
        });
      }
    })
  });

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
    <td style="padding-bottom:5px;">
    <?php
    $userCreate = getCreatePaper($conn,$tbl_name," AND `fo_id`=".$fo_id);
    $headerIMG = get_headerPaper($conn,"FO",$userCreate);
    ?>
    <img src="<?php echo $headerIMG;?>" width="100%" border="0" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อบริษัท/ลูกค้า :</strong> <input type="text" name="cd_name" value="<?php  echo $cd_name;?>" id="cd_name" class="inpfoder" style="width:70%;"></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>กลุ่มลูกค้า :</strong>
            <select name="cg_type" id="cg_type" class="inputselect">
                <?php
                	$qucgtype = @mysqli_query($conn,"SELECT * FROM s_group_type ORDER BY group_name ASC");
					while($row_cgtype = @mysqli_fetch_array($qucgtype)){
					  ?>
					  	<option value="<?php  echo $row_cgtype['group_id'];?>" <?php  if($cg_type == $row_cgtype['group_id']){echo 'selected';}?>><?php  echo $row_cgtype['group_name'];?></option>
					  <?php
					}
				?>
            </select>
             <strong>ประเภทลูกค้า :</strong>
             <select name="ctype" id="ctype" class="inputselect" onChange="chksign(this.value);">
                <?php
                	$quccustommer = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
					while($row_cgcus = @mysqli_fetch_array($quccustommer)){
						//if(substr($row_cgcus['group_name'],0,2) != "SR"){
					  ?>
					  	<option value="<?php  echo $row_cgcus['group_id'];?>" <?php  if($ctype == $row_cgcus['group_id']){echo 'selected';}?>><?php  echo $row_cgcus['group_name'];?></option>
					  <?php
						//}
					}
				?>
            </select> </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong> <input type="text" name="cd_address" value="<?php  echo $cd_address;?>" id="cd_address" class="inpfoder" style="width:80%;"></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            <input name="cd_type" type="radio" id="cd_type1" value="1" <?php if($cd_type == '1' || $cd_type == ''){echo 'checked';}?>><strong>นิติบุคคล</strong> &nbsp;&nbsp;<input name="cd_type" type="radio" id="cd_type2" value="2" <?php if($cd_type == '2'){echo 'checked';}?>><strong>บุคคลธรรมดา</strong> &nbsp;&nbsp;&nbsp;
            <strong>ประเภทสินค้า :</strong>
            <select name="pro_type" id="pro_type" class="inputselect">
                <?php
                	$quprotype = @mysqli_query($conn,"SELECT * FROM s_group_product ORDER BY group_name ASC");
					while($row_protype = @mysqli_fetch_array($quprotype)){
					  ?>
					  	<option value="<?php  echo $row_protype['group_id'];?>" <?php  if($pro_type == $row_protype['group_id']){echo 'selected';}?>><?php  echo $row_protype['group_name'];?></option>
					  <?php
					}
				?>
            </select>
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>จังหวัด :</strong>
            <select name="cd_province" id="cd_province" class="inputselect">
                <?php
                	$quprovince = @mysqli_query($conn,"SELECT * FROM s_province ORDER BY province_id ASC");
					while($row_province = @mysqli_fetch_array($quprovince)){
					  ?>
					  	<option value="<?php  echo $row_province['province_id'];?>" <?php  if($cd_province == $row_province['province_id']){echo 'selected';}?>><?php  echo $row_province['province_name'];?></option>
					  <?php
					}
				?>
            </select>
           	&nbsp;&nbsp;&nbsp;<strong>Tax/ID :</strong> <input type="text" name="cd_tax" value="<?php  echo $cd_tax;?>" id="cd_tax" class="inpfoder">
           	</td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>เลขที่ใบเสนอราคา / PO.NO. :</strong> <input type="text" name="po_id" value="<?php  echo $po_id;?>" id="po_id" class="inpfoder">
            &nbsp;&nbsp;<strong>แผนที่ลูกค้า (Google Map) :</strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <input type="text" name="google_map" value="<?php  echo stripslashes($google_map);?>" id="google_map" class="inpfoder" style="width: 220px;">
            </span></strong>
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>โทรศัพท์ :</strong> <input type="text" name="cd_tel" value="<?php  echo $cd_tel;?>" id="cd_tel" class="inpfoder">
              <strong>แฟกซ์ :</strong>
              <input type="text" name="cd_fax" value="<?php  echo $cd_fax;?>" id="cd_fax" class="inpfoder"></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>เลขที่ First order :</strong> <!--<input type="text" name="fs_id" value="<?php  echo $fs_id;?>">--><input type="text" name="fs_id" value="<?php  if($fs_id == ""){echo check_firstorder($conn);}else{echo $fs_id;};?>" id="fs_id" class="inpfoder" > <strong> วันที่ :</strong> <input type="text" name="date_forder" readonly value="<?php  if($date_forder==""){echo date("d/m/Y");}else{ echo $date_forder;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_forder'});</script></td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อผู้ติดต่อ :</strong>
              <input type="text" name="c_contact" value="<?php  echo $c_contact;?>" id="c_contact" class="inpfoder">
              <strong>เบอร์โทร :</strong>
              <input type="text" name="c_tel" value="<?php  echo $c_tel;?>" id="c_tel" class="inpfoder"></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อผู้มีอำนาจลงนามสัญญา<strong> :</strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <input type="text" name="name_consign" value="<?php  echo $name_consign;?>" id="cusid" class="inpfoder">
            </span></strong><strong>รหัสลูกค้า<strong> :</strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <input type="text" name="cusid" value="<?php  echo $cusid;?>" id="cusid" class="inpfoder">
				</span></strong>
            </td>
          </tr>
</table>
  <br>
  <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border:1px solid #000000;" class="tb2">
  <tr>
    <td style="vertical-align:top;"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>สถานที่ติดตั้ง :</strong> <input type="text" name="loc_name" value="<?php  echo $loc_name;?>" id="loc_name" class="inpfoder" style="width:60%;"></td>
    </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong> <input type="text" name="loc_address" value="<?php  echo $loc_address;?>" id="loc_address" class="inpfoder" style="width:80%;"> </td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>สถานที่จัดส่ง :</strong> <input type="text" name="loc_name2" value="<?php  echo $loc_name2;?>" id="loc_name2" class="inpfoder" style="width:60%;"></td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong> <input type="text" name="loc_address2" value="<?php  echo $loc_address2;?>" id="loc_address2" class="inpfoder" style="width:80%;"> </td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ขนส่งโดย :</strong> <input type="text" name="loc_shopping" value="<?php  echo $loc_shopping;?>" id="loc_shopping" class="inpfoder" style="width:80%;"></td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">&nbsp;</td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
			  <input name="typegaruntree" type="radio" id="radio" value="1" <?php  if($typegaruntree == 1 || $typegaruntree == ""){echo 'checked';}?> onclick="checkVal(this)"> เงินค่าประกัน &nbsp;&nbsp;&nbsp; <input name="typegaruntree" type="radio" id="radio" value="2" <?php  if($typegaruntree == 2){echo 'checked';}?> onclick="checkVal(this)"> เงินค่าเช่าล่วงหน้า
            </td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong><span id="textgaruntree"><?php if($typegaruntree == 2){echo 'เงินค่าเช่าล่วงหน้า';}else{echo 'เงินประกัน';}?></span> :
                <input type="text" name="money_garuntree" value="<?php  echo $money_garuntree;?>" id="money_garuntree" class="inpfoder" >
            <small style="color:#F00;">ไม่ต้องใส่ (,)</small>
            <input name="notvat1" type="radio" id="radio" value="1" <?php  if($notvat1 == 1 || $notvat1 == "0"){echo 'checked';}?>>
            Not vat
            <input type="radio" name="notvat1" id="radio2" value="2" <?php  if($notvat1 == 2){echo 'checked';}?>>
            Vat 7%</strong></td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ค่าขนส่งและติดตั้ง :
                <input type="text" name="money_setup" value="<?php  echo $money_setup;?>" id="money_setup" class="inpfoder" >
            <small style="color:#F00;">ไม่ต้องใส่ (,)</small>
            <input name="notvat2" type="radio" id="radio3" value="1" <?php  if($notvat2 == 1 || $notvat2 == "0"){echo 'checked';}?>>
Not vat
<input type="radio" name="notvat2" id="radio4" value="2" <?php  if($notvat2 == 2){echo 'checked';}?>>
Vat 7%</strong></td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>การเลือกรายการสินค้า</strong></td>
          </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
			  <input name="prowithliquid" type="radio" id="radio" value="1" <?php  if($prowithliquid != '2'){echo 'checked';}?>> สินค้าเท่านั้น &nbsp;&nbsp;&nbsp; <input name="prowithliquid" type="radio" id="radio" value="2" <?php  if($prowithliquid == '2'){echo 'checked';}?> > สินค้ากับน้ำยา
            </td>
          </tr>
    </table></td>
    <td style="vertical-align:top;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
         <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>เครื่องป้อนน้ำยา :</strong>
              <input type="text" name="loc_clean" value="<?php  echo $loc_clean;?>" id="loc_clean" class="inpfoder">&nbsp; <strong>S/N</strong> &nbsp;<input type="text" name="loc_clean_sn" value="<?php  echo $loc_clean_sn;?>" id="loc_clean_sn" class="inpfoder"></td>
    </tr>
    <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong><u>รายการน้ำยาลูกค้า</u></strong>
              </td>
    </tr>
          <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>01. </strong>
              <!-- <input type="text" name="warter01" value="<?php  echo $warter01;?>" id="warter01" class="inpfoder"> -->
              <select name="warter01" id="warter01" class="inputselect">
              <option value="">กรุณาเลือกน้ำยา</option>
            <?php
            $quOrder = mysqli_query($conn,"SELECT * FROM s_group_typeproduct WHERE 1 AND group_spro_id LIKE '04-%' ORDER BY group_spro_id ASC");
            while($rowOrder = mysqli_fetch_array($quOrder)){
              ?>
              <option value="<?php  echo $rowOrder['group_id'];?>" <?php  if($warter01 == $rowOrder['group_id']){echo 'selected';}?>><?php  echo $rowOrder['group_spro_id']." | ".$rowOrder['group_name'];?></option>
              <?php
            }
            ?>
            </select>
            </td>
    </tr><tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>02. </strong>
              <!-- <input type="text" name="warter02" value="<?php  echo $warter02;?>" id="warter02" class="inpfoder">-->
              <select name="warter02" id="warter02" class="inputselect">
              <option value="">กรุณาเลือกน้ำยา</option>
            <?php
            $quOrder = mysqli_query($conn,"SELECT * FROM s_group_typeproduct WHERE 1 AND group_spro_id LIKE '04-%' ORDER BY group_spro_id ASC");
            while($rowOrder = mysqli_fetch_array($quOrder)){
              ?>
              <option value="<?php  echo $rowOrder['group_id'];?>" <?php  if($warter02 == $rowOrder['group_id']){echo 'selected';}?>><?php  echo $rowOrder['group_spro_id']." | ".$rowOrder['group_name'];?></option>
              <?php
            }
            ?>
            </select>
            </td> 
    </tr><tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>03. </strong>
              <!-- <input type="text" name="warter03" value="<?php  echo $warter03;?>" id="warter03" class="inpfoder"> -->
              <select name="warter03" id="warter03" class="inputselect">
              <option value="">กรุณาเลือกน้ำยา</option>
            <?php
            $quOrder = mysqli_query($conn,"SELECT * FROM s_group_typeproduct WHERE 1 AND group_spro_id LIKE '04-%' ORDER BY group_spro_id ASC");
            while($rowOrder = mysqli_fetch_array($quOrder)){
              ?>
              <option value="<?php  echo $rowOrder['group_id'];?>" <?php  if($warter03 == $rowOrder['group_id']){echo 'selected';}?>><?php  echo $rowOrder['group_spro_id']." | ".$rowOrder['group_name'];?></option>
              <?php
            }
            ?>
            </select>
            </td>
    </tr><tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>04. </strong>
              <!-- <input type="text" name="warter04" value="<?php  echo $warter04;?>" id="warter04" class="inpfoder"> -->
              <select name="warter04" id="warter04" class="inputselect">
              <option value="">กรุณาเลือกน้ำยา</option>
            <?php
            $quOrder = mysqli_query($conn,"SELECT * FROM s_group_typeproduct WHERE 1 AND group_spro_id LIKE '04-%' ORDER BY group_spro_id ASC");
            while($rowOrder = mysqli_fetch_array($quOrder)){
              ?>
              <option value="<?php  echo $rowOrder['group_id'];?>" <?php  if($warter04 == $rowOrder['group_id']){echo 'selected';}?>><?php  echo $rowOrder['group_spro_id']." | ".$rowOrder['group_name'];?></option>
              <?php
            }
            ?>
            </select>
            </td>
    </tr>
     <tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>05. </strong>
              
              <select name="warter05" id="warter05" class="inputselect">
              <option value="">กรุณาเลือกน้ำยา</option>
            <?php
            $quOrder = mysqli_query($conn,"SELECT * FROM s_group_typeproduct WHERE 1 AND group_spro_id LIKE '04-%' ORDER BY group_spro_id ASC");
            while($rowOrder = mysqli_fetch_array($quOrder)){
              ?>
              <option value="<?php  echo $rowOrder['group_id'];?>" <?php  if($warter05 == $rowOrder['group_id']){echo 'selected';}?>><?php  echo $rowOrder['group_spro_id']." | ".$rowOrder['group_name'];?></option>
              <?php
            }
            ?>
            </select>
            </td>
    </tr>
    <!--<tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>06. </strong>
              
              <select name="warter06" id="warter06" class="inputselect">
              <option value="">กรุณาเลือกน้ำยา</option>
            <?php
            $quOrder = mysqli_query($conn,"SELECT * FROM s_group_typeproduct WHERE 1 AND group_spro_id LIKE '04-%' ORDER BY group_spro_id ASC");
            while($rowOrder = mysqli_fetch_array($quOrder)){
              ?>
              <option value="<?php  echo $rowOrder['group_id'];?>" <?php  if($warter06 == $rowOrder['group_id']){echo 'selected';}?>><?php  echo $rowOrder['group_spro_id']." | ".$rowOrder['group_name'];?></option>
              <?php
            }
            ?>
            </select>
            </td>
    </tr><tr>
            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>07. </strong>
             
              <select name="warter07" id="warter07" class="inputselect">
              <option value="">กรุณาเลือกน้ำยา</option>
            <?php
            $quOrder = mysqli_query($conn,"SELECT * FROM s_group_typeproduct WHERE 1 AND group_spro_id LIKE '04-%' ORDER BY group_spro_id ASC");
            while($rowOrder = mysqli_fetch_array($quOrder)){
              ?>
              <option value="<?php  echo $rowOrder['group_id'];?>" <?php  if($warter07 == $rowOrder['group_id']){echo 'selected';}?>><?php  echo $rowOrder['group_spro_id']." | ".$rowOrder['group_name'];?></option>
              <?php
            }
            ?>
            </select>
            </td>
    </tr> -->
</table>
    </td>
  </tr>
</table>
  <br>
  <table>
  <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:left;padding-top:10px;padding-bottom:10px;">
        <strong>แสกนรหัสสินค้า:</strong>
        <input type="text" name="scan_part" value="" id="scan_part" class="inpfoder"> <span id="msg_scan" style="color:red;font-weight: bold;"></span>
        </td>
      </tr>
  </table>
  <br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;" id="exp">
    <tr>
      <td width="3%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="40%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="21%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น</strong></td>
      <td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>S/N</strong></td>
      <td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา / ต่อหน่วย</strong></td>
    </tr>
    
    <?php
		
		$cproTmp = array($cpro1, $cpro2, $cpro3, $cpro4, $cpro5, $cpro6, $cpro7);
		$cpodTmp = array($pro_pod1, $pro_pod2, $pro_pod3, $pro_pod4, $pro_pod5, $pro_pod6, $pro_pod7);
		$csnTmp = array($pro_sn1, $pro_sn2, $pro_sn3, $pro_sn4, $pro_sn5, $pro_sn6, $pro_sn7);
		$camountTmp = array($camount1, $camount2, $camount3, $camount4, $camount5, $camount6, $camount7);
		$cpriceTmp = array($cprice1, $cprice2, $cprice3, $cprice4, $cprice5, $cprice6, $cprice7);
		
	
		for($i=1;$i<=7;$i++){
			
			$bpro[] = $cproTmp[$i-1];
			$bpod[] = $cpodTmp[$i-1];
			$bamount[] = $camountTmp[$i-1];
			
			?>
			<tr>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $i;?>
			  <input type="hidden" name="bpro[]" value="<?php  echo $bpro[$i-1];?>">
			  <input type="hidden" name="bpod[]" value="<?php  echo $bpod[$i-1];?>">
			  <input type="hidden" name="bamount[]" value="<?php  echo $bamount[$i-1];?>">
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <select name="cpro<?php echo $i;?>" id="cpro<?php echo $i;?>" class="inputselect" style="width:90%;">
					<option value="">กรุณาเลือกรายการ</option>
				  <?php
					  $qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
					  while($row_qupro1 = @mysqli_fetch_array($qupro1)){
						?>
						  <option value="<?php  echo $row_qupro1['group_id'];?>" <?php  if($cproTmp[$i-1] == $row_qupro1['group_id']){echo 'selected';}?>><?php  echo $row_qupro1['group_name']." ".$row_qupro1['group_detail'];?></option>
						<?php
					  }
				  ?>
			  </select>
			  <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro<?php echo $i;?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <select name="pro_pod<?php echo $i;?>" id="pro_pod<?php echo $i;?>" class="inputselect" style="width:80%;" onchange="changePod('pro_pod<?php echo $i;?>','pro_sn<?php echo $i;?>','<?php echo $i;?>','<?php echo $_GET['fo_id']?>');">
					<option value="">กรุณาเลือกรายการ</option>
				  <?php
					  $qupros1 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
					  while($row_qupros1 = @mysqli_fetch_array($qupros1)){
						?>
						  <option value="<?php  echo $row_qupros1['group_name'];?>" <?php  if($cpodTmp[$i-1] == $row_qupros1['group_name']){echo 'selected';}?>><?php  echo $row_qupros1['group_name'];?></option>
						<?php
					  }
				  ?>
			  </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod<?php echo $i;?>&protype2=pro_sn<?php echo $i;?>&protype3=<?php echo $i;?>&fo_id=<?php echo $_GET['fo_id'];?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;white-space: nowrap;" >
			 <select name="pro_sn<?php echo $i;?>" id="pro_sn<?php echo $i;?>" class="inputselect" style="width:80%;">
					<option value="">กรุณาเลือกรายการ</option>
          <option value="<?php echo $csnTmp[$i-1];?>" selected><?php echo $csnTmp[$i-1];?></option>
				  <?php
          // echo "SELECT * FROM s_group_sn WHERE group_pod = '".getpod_id($conn,$cpodTmp[$i-1])."' AND group_status = '0' AND group_inv = '0' ORDER BY group_id ASC";
					  $qusn1 = @mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_pod = '".getpod_id($conn,$cpodTmp[$i-1])."' AND group_status = '0' AND group_inv = '2' ORDER BY group_id DESC");
            while($row_qusn1 = @mysqli_fetch_array($qusn1)){
              // echo $csnTmp[$i-1] ." | ".$row_qusn1['group_name']." || ";
              // if($csnTmp[$i-1] == $row_qusn1['group_name']){
              //   chkSeries($conn,$row_qusn1['group_name'],$_GET['fo_id']);
              // }
						  if(chkSeries($conn,$row_qusn1['group_name'],$_GET['fo_id']) == 0){
							  ?>
							  <!-- <option value="<?php  echo $row_qusn1['group_name'];?>" <?php if($csnTmp[$i-1] == $row_qusn1['group_name']){echo 'selected';}?>><?php  echo $row_qusn1['group_name'];?></option> -->
							<?php 
						  }
              /*else{
                ?>
                <option><?php echo $row_qusn1['group_name'];?>:<?php echo chkSeries($conn,$row_qusn1['group_name'],$_GET['fo_id']);?></option>
                <?php
              }*/
					  }
				  ?>
			  </select><span id="search_sn<?php echo $i;?>">
				<a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_sn.php?protype=pro_sn<?php echo $i;?>&pod=<?php echo getpod_id($conn,$cpodTmp[$i-1]);?>&fo_id=<?php echo $_GET['fo_id'];?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
			  </span>

			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="text" name="camount<?php echo $i;?>" value="<?php  echo $camountTmp[$i-1];?>" id="camount<?php echo $i;?>" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)" onchange="changeAmount('<?php echo $i;?>')">
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="text" name="cprice<?php echo $i;?>" value="<?php  echo $cpriceTmp[$i-1];?>" id="cprice<?php echo $i;?>" class="inpfoder" style="width:100%;text-align:center;" onkeypress="return isNumberKey(event)" onchange="changePrice('<?php echo $i;?>')">
			  </td>
			</tr>
			<?php
		}
	?>

    <tr>
      <td colspan="7" style="text-align:left;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;"><strong>หมายเหตุ :</strong><br><textarea name="ccomment" id="ccomment" ><?php  echo strip_tags(stripslashes($ccomment));?></textarea><br></td>
    </tr>
    </table><br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="border:0;padding:0;width:60%;vertical-align:top;">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <th width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></th>
                  <th width="60%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการแถม</strong></th>
                  <th width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></th>
                  <th width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>นาม</strong></th>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">1</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro1" value="<?php  echo $cs_pro1;?>" id="cs_pro1" class="inpfoder" style="width:90%;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount1" value="<?php  echo $cs_amount1;?>" id="cs_amount1" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_namecall1" value="<?php  echo $cs_namecall1;?>" id="cs_namecall1" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">2</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro2" value="<?php  echo $cs_pro2;?>" id="cs_pro2" class="inpfoder" style="width:90%;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount2" value="<?php  echo $cs_amount2;?>" id="cs_amount2" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_namecall2" value="<?php  echo $cs_namecall2;?>" id="cs_namecall2" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">3</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro3" value="<?php  echo $cs_pro3;?>" id="cs_pro3" class="inpfoder" style="width:90%;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount3" value="<?php  echo $cs_amount3;?>" id="cs_amount3" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_namecall3" value="<?php  echo $cs_namecall3;?>" id="cs_namecall3" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">4</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro4" value="<?php  echo $cs_pro4;?>" id="cs_pro4" class="inpfoder" style="width:90%;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount4" value="<?php  echo $cs_amount4;?>" id="cs_amount4" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_namecall4" value="<?php  echo $cs_namecall4;?>" id="cs_namecall4" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">5</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro5" value="<?php  echo $cs_pro5;?>" id="cs_pro5" class="inpfoder" style="width:90%;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount5" value="<?php  echo $cs_amount5;?>" id="cs_amount5" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_namecall5" value="<?php  echo $cs_namecall5;?>" id="cs_namecall5" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
              </tr>
            </table></td>
            <td style="border:0;padding:0;width:40%;vertical-align:top;padding-left:5px;font-size:12px;border:1px solid #000000;padding-top:10px;"><p><strong>
              เลขที่สัญญา : <input type="text" name="r_id" value="<?php  echo $r_id;?>" id="r_id" class="inpfoder" ><!--<input type="text" name="r_id" value="<?php  if($r_id == ""){echo check_contactfo("R".date("Y/m/"));}else{echo $r_id;};?>" id="r_id" class="inpfoder" >--><br><br>
              วันเริ่มสัญญา : </strong>
              <input type="text" name="date_quf" readonly value="<?php  if($date_quf==""){echo date("d/m/Y");}else{ echo $date_quf;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_quf'});</script>
              <strong>&nbsp;สิ้นสุด : </strong>
              <input type="text" name="date_qut" readonly value="<?php  if($date_qut==""){echo date("d/m/Y");}else{ echo $date_qut;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_qut'});</script><br>
<!--
              <div id="cssign"><strong>ผู้มีอำนาจเซ็นสัญญา</strong>
              <input type="text" name="cs_sign" value="<?php  echo $cs_sign;?>" id="cs_sign" class="inpfoder" style="width:50%;">
              <br><br></div>
-->
              <br><strong>เงื่อนไขการชำระเงิน :<br>
              <textarea name="qucomment" id="qucomment" style="height:50px;"><?php  echo strip_tags(stripslashes($qucomment));?></textarea>
              </strong><!--<br>
                <br>
                <strong>กำหนดวางบิล : </strong>ตั้งแต่วันที่ 12-15 ของเดือน-->
              </p></td>
          </tr>
        </table>
  <br>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="50%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>บุคคลติดต่อทางด้านการเงิน : <input type="text" name="cs_contact" value="<?php  echo $cs_contact;?>" id="cs_contact" class="inpfoder" style="width:50%;"></strong></td>
      <td width="50%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"> <strong>โทรศัพท์ : </strong><input type="text" name="cs_tel" value="<?php  echo $cs_tel;?>" id="cs_tel" class="inpfoder" style="width:50%;"></td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>วันที่ส่งสินค้า : </strong><input type="text" name="cs_ship" readonly value="<?php  if($cs_ship==""){echo date("d/m/Y");}else{ echo $cs_ship;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'cs_ship'});</script></td>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>วันที่ติดตั้งเครื่อง : </strong><input type="text" name="cs_setting" readonly value="<?php  if($cs_setting==""){echo date("d/m/Y");}else{ echo $cs_setting;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'cs_setting'});</script></td>
    </tr>
    <tr>
      <td width="50%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong> ชื่อช่างเข้าบริการ : </strong><select name="technic_service" id="technic_service" class="inputselect" style="width:50%;">
      		<option value="">กรุณาเลือกช่าง</option>
		  <?php
              $qusTec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
              while($rowTec = @mysqli_fetch_array($qusTec)){
                ?>
                  <option value="<?php  echo $rowTec['group_id'];?>" <?php  if($technic_service == $rowTec['group_id']){echo 'selected';}?>><?php  echo $rowTec['group_name'];?></option>
                <?php
              }
          ?>
      </select>
      </td>
      <td width="50%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"> <strong>ประเภทบริการ : </strong>
      <select name="type_service" id="type_service" class="inputselect" style="width:50%;">
      		<option value="">กรุณาเลือกประเภทบริการ</option>
		  <?php
              $qusTec = @mysqli_query($conn,"SELECT * FROM  `s_group_service` WHERE 1 AND (`group_id` = '1' OR `group_id` = '2' OR `group_id` = '3' OR `group_id` = '4' OR `group_id` = '5' OR `group_id` = '6' OR `group_id` = '31') ORDER BY `group_name` ASC");
              while($rowTec = @mysqli_fetch_array($qusTec)){
                ?>
                  <option value="<?php  echo $rowTec['group_id'];?>" <?php  if($type_service == $rowTec['group_id']){echo 'selected';}?>><?php  echo $rowTec['group_name'];?></option>
                <?php
              }
          ?>
      </select>
      </td>
    </tr>
  </table>
  <br>
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="25%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>พนักงานขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............</strong></td>
              </tr>
            </table>
        </td>
        <td width="25%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <?php
					$hsale = '';
					if($cs_hsell != ""){
						$hsale = $cs_hsell;
					}else{
						$hsale = getNameSaleApprove($conn);
					}
				?>
                <strong ><input type="text" name="cs_hsell" value="<?php  echo $hsale;?>" id="cs_hsell" class="inpfoder" style="width:50%;text-align:center;border: none;"></strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้อนุมัติการขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............</strong></td>
              </tr>
            </table>

        </td>
        <td width="25%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <?php
					$haccount = '';
					if($cs_account != ""){
						$haccount = $cs_account;
					}else{
						$haccount = getNameAccountApprove($conn);
					}
				?>
                <strong><input type="text" name="cs_account" value="<?php  echo $haccount;?>" id="cs_account" class="inpfoder" style="width:50%;text-align:center;border: none;"></strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ฝ่ายบัญชีการเงิน</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............</strong></td>
              </tr>
            </table>
        </td>
        <td width="25%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <?php
					$hBig = '';
					if($cs_aceep != ""){
						$hBig = $cs_aceep;
					}else{
						$hBig = getNameBigApprove($conn);
					}
				?>
                <strong><input type="text" name="cs_aceep" value="<?php  echo $hBig;?>" id="cs_aceep" class="inpfoder" style="width:50%;text-align:center;border: none;"></strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้มีอำนาจลงนาม</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............</strong></td>
              </tr>
            </table>
        </td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:left;padding-top:10px;padding-bottom:10px;">
        <strong>หมายเหตุอื่นๆ :</strong>
        <br>
        <textarea name="remark" id="remark" style="height:150px;"><?php  echo strip_tags(stripslashes($remark));?></textarea>
        </td>
      </tr>
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:left;padding-top:10px;padding-bottom:10px;">
        <strong>ข้อความแจ้งผู้อนุมัติ :</strong>
        <input type="text" name="noti_comment" value="<?php  echo $noti_comment;?>" id="noti_comment" class="inpfoder" style="width:90%;">
        </td>
      </tr>
    </table>

        </fieldset>
    </div><br>
    <div class="formArea">
      <div style="text-align: center;">
      <input type="button" value=" บันทึก " id="submitF" class="button bt_save" onclick="submitForm()">
      <input type="button" name="Cancel" id="resetF" value=" ยกเลิก " class="button bt_cancel" onClick="window.location='index.php'">
      </div>
<!--      <input type="reset" name="Submit" value="Reset" class="button">-->
      <?php
			$a_not_exists = array();
			post_param($a_param,$a_not_exists);
			?>
      <input name="mode" type="hidden" id="mode" value="<?php  echo $_GET['mode'];?>">
      <input name="status" type="hidden" id="status" value="<?php echo $status;?>">
      <input name="status_use" type="hidden" id="status_use" value="<?php  echo $status_use;?>">
      <input name="st_setting" type="hidden" id="st_setting" value="<?php  echo $st_setting;?>">
      <input name="chkprocess" type="hidden" id="chkprocess" value="<?php  echo $chkprocess;?>">
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
<?php
include "../../include/config.php";
include "../../include/connect.php";
include "../../include/function.php";
include "config.php";

if ($_POST['mode'] != "") {
    $param = "";
    $a_not_exists = array();
    $param = get_param($a_param, $a_not_exists);

    $_POST['remark1'] = addslashes($_POST['remark1']);

    if ($_POST['memo_open'] == "") {
        $_POST['memo_open'] = date("Y-m-d");
    } else {
        $a_sdate = explode("/", $_POST['memo_open']);
        $_POST['memo_open'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];
    }

    if ($_POST['date_sell'] == "") {
        $_POST['date_sell'] = date("Y-m-d");
    } else {
        $a_sdate = explode("/", $_POST['date_sell']);
        $_POST['date_sell'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];
    }

    if ($_POST['date_hsell'] == "") {
        $_POST['date_hsell'] = date("Y-m-d");
    } else {
        $a_sdate = explode("/", $_POST['date_hsell']);
        $_POST['date_hsell'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];
    }

    if ($_POST['date_haccount'] == "") {
        $_POST['date_haccount'] = date("Y-m-d");
    } else {
        $a_sdate = explode("/", $_POST['date_haccount']);
        $_POST['date_haccount'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];
    }

    if ($_POST['date_accep'] == "") {
        $_POST['date_accep'] = date("Y-m-d");
    } else {
        $a_sdate = explode("/", $_POST['date_accep']);
        $_POST['date_accep'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];
    }

    $checklist = '';

    foreach ($_POST['chkPro'] as $value) {
        $checklist .= $value . ',';
    }

    $checkProFree = '';

    foreach ($_POST['chkProfree'] as $value) {
        $checkProFree .= $value . ',';
    }

    $_POST['con_chkpro'] = substr($checklist, 0, -1);
    $_POST['con_chkprofree'] = substr($checkProFree, 0, -1);

    $userCreate = getCreatePaper($conn, $tbl_name, " AND `id`=" . $_POST['id']);
    $headerIMG = get_headerPaper($conn, "DH", $userCreate);
    $footerIMG = get_headerPaper($conn, "DF", $userCreate);

    if ($_POST['mode'] == "update") {

        $_POST['remark1'] = nl2br($_POST['remark1']);
        $_POST['remark2'] = nl2br($_POST['remark2']);
        $_POST['remark3'] = nl2br($_POST['remark3']);
        $_POST['remark4'] = nl2br($_POST['remark4']);

        $numApp = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM s_approve WHERE tag_db = '" . $tbl_name . "' AND t_id = '" . $_REQUEST[$PK_field] . "'"));

        if ($numApp >= 1) {
            if ($_POST['process'] == '2') {
                @mysqli_query($conn, "UPDATE `s_approve` SET `process_2` = '1', `process_2_date` = '" . date("Y-m-d H:i:s") . "'  WHERE tag_db = '" . $tbl_name . "' AND t_id = '" . $_REQUEST[$PK_field] . "';");
            }
            if ($_POST['process'] == '3') {
                @mysqli_query($conn, "UPDATE `s_approve` SET `process_3` = '1', `process_3_date` = '" . date("Y-m-d H:i:s") . "' WHERE tag_db = '" . $tbl_name . "' AND t_id = '" . $_REQUEST[$PK_field] . "';");
            }
            if ($_POST['process'] == '4') {
                @mysqli_query($conn, "UPDATE `s_approve` SET `process_4` = '1', `process_4_date` = '" . date("Y-m-d H:i:s") . "' WHERE tag_db = '" . $tbl_name . "' AND t_id = '" . $_REQUEST[$PK_field] . "';");
            }
        } else {
            @mysqli_query($conn, "INSERT INTO `s_approve` (`id`, `tag_db`, `t_id`, `process_1`, `process_2`, `process_3`, `process_4`, `process_1_date`) VALUES (NULL, '" . $tbl_name . "', '" . $_REQUEST[$PK_field] . "', '1', '0', '0', '0','" . date("Y-m-d H:i:s") . "');");
        }

        addNotification($conn, 3, $tbl_name, $_REQUEST[$PK_field], $_POST['process']);

        //@mysqli_query($conn,"INSERT INTO `s_notification` (`id`, `tag_db`, `t_id`, `process`, `process_date`) VALUES (NULL, '".$tbl_name."', '".$_REQUEST[$PK_field]."', '".$_POST['process']."','".date("Y-m-d H:i:s")."');");

        if ($_POST['process'] == '3') {
            $_POST['process'] = '5';
        } else {
            $_POST['process'] = $_POST['process'] + 1;
        }

        include "../include/m_update.php";

        $id = $_REQUEST[$PK_field];

//            mysqli_query($conn,"UPDATE `s_memo` SET `process` = '0' WHERE `s_memo`.`id` = ".$id.";");

        include_once "../mpdf54/mpdf.php";
        include_once "../memo/form_memo.php";
        $mpdf = new mPDF('UTF-8');
        $mpdf->SetAutoFont();
        $mpdf->SetHTMLHeader('<div><img src="'.$headerIMG.'"/></div>');
        $mpdf->SetHTMLFooter('<div><img src="'.$footerIMG.'"/></div>');
        if ($_POST['process'] != '5') {
            $mpdf->showWatermarkText = true;
            $mpdf->WriteHTML('<watermarktext content="NOT YET APPROVED" alpha="0.4" />');
        }
        $mpdf->WriteHTML($form);
        $chaf = str_replace("/", "-", $_POST['mo_id']);
        $mpdf->Output('../../upload/memo/' . $chaf . '.pdf', 'F');

        header("location:index.php");
    }

}
if ($_GET['mode'] == "add") {
    Check_Permission($conn, $check_module, $_SESSION['login_id'], "add");

}
if ($_GET['mode'] == "update") {

    Check_Permission($conn, $check_module, $_SESSION['login_id'], "update");
    $sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] . "'";
    $query = @mysqli_query($conn, $sql);
    while ($rec = @mysqli_fetch_array($query)) {
        $$PK_field = $rec[$PK_field];
        foreach ($fieldlist as $key => $value) {
            $$value = $rec[$value];
        }
    }

    $a_sdate = explode("-", $memo_open);
    $memo_open = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];
    $a_sdate = explode("-", $date_sell);
    $date_sell = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];
    $a_sdate = explode("-", $date_hsell);
    $date_hsell = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];
    $a_sdate = explode("-", $date_haccount);
    $date_haccount = ($a_sdate[2] != "") ? $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0] : date("d/m/Y");
    $a_sdate = explode("-", $date_accep);
    $date_accep = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];
    $a_sdate = explode("-", $date_appoint1);
    $date_appoint1 = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];
    $a_sdate = explode("-", $date_appoint2);
    $date_appoint2 = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];
    $a_sdate = explode("-", $date_appoint3);
    $date_appoint3 = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];
    $a_sdate = explode("-", $date_appoint4);
    $date_appoint4 = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];
    $a_sdate = explode("-", $date_appoint5);
    $date_appoint5 = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];
    $a_sdate = explode("-", $date_appoint6);
    $date_appoint6 = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];
    $a_sdate = explode("-", $date_appoint7);
    $date_appoint7 = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $con_chkpro = explode(',', $con_chkpro);
    $con_chkprofree = explode(',', $con_chkprofree);

    $quinfo = get_quotation($conn, $fo_id, 3);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php echo $s_title; ?></TITLE>
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

	function submitForm() {
		document.getElementById("submitF").disabled = true;
		document.getElementById("resetF").disabled = true;
		document.form1.submit()
	}


</script>
</HEAD>
<?php include "../../include/function_script.php";?>
<BODY onload="submitForm()">
<!--<BODY>-->
<DIV id=body-wrapper>
<?php include "../left.php";?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php include '../top.php';?>
<P id=page-intro><?php if ($mode == "add") {?>Enter new information<?php } else {?>แก้ไข	[<?php echo $page_name; ?>]<?php }?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php echo $check_module; ?></H3>
<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<div><center><img src="../images/waiting.gif" width="450"></center></div>
<DIV class=content-box-content style="display: none;">
<DIV id=tab1 class="tab-content default-tab">
  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
      <legend><?php echo $page_name; ?> </legend>
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
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> <?php echo $quinfo['cd_name']; ?></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>ประเภทสินค้า :</strong>
            	<?php echo protype_name($conn, $quinfo['pro_type']); ?>
            </td>

          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong> <?php echo $quinfo['cd_address']; ?></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong>เลขที่:</strong>
            <?php echo $quinfo['fs_id']; ?>&nbsp;&nbsp;<strong>เลขที่ Memo : <input type="text" name="mo_id" value="<?php if ($mo_id == "") {echo check_memo($conn);} else {echo $mo_id;}
;?>" id="mo_id" class="inpfoder" style="border:0;">
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>จังหวัด :</strong>
            <?php echo province_name($conn, $quinfo['cd_province']); ?>
           	</td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong> วันที่ :</strong> <input type="text" name="memo_open" readonly value="<?php if ($memo_open == "") {echo date("d/m/Y");} else {echo $memo_open;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'memo_open'});</script>
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>โทรศัพท์ :</strong> <?php echo $quinfo['cd_tel']; ?>
             &nbsp;&nbsp;<strong>อีเมล์ :</strong> <?php echo $quinfo['cd_fax']; ?>
         	</td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>ชื่อผู้ติดต่อ :</strong>
            	<?php echo $quinfo['c_contact']; ?>
              &nbsp;&nbsp;<strong>เบอร์โทร :</strong>
              <?php echo $quinfo['c_tel']; ?>
            </td>
          </tr>
</table>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb3">
  	  <tr>
	    <td width="50%"><strong>เรื่อง :</strong> <input type="text" name="subject" value="<?php echo $subject; ?>" id="subject" class="inpfoder" style="width:50%;">
        </td>
      </tr>
      <tr>
	    <td width="50%"><strong>เรียน :</strong> <input type="text" name="dear" value="<?php if ($dear != '') {echo $dear;} else {echo 'ผู้เกี่ยวข้อง';}?>" id="dear" class="inpfoder" style="width:50%;">


        </td>
      </tr>
      <tr>
	    <td width="50%"><strong>รายละเอียด :</strong><br><br />
        <span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
        <textarea name="remark1" class="inpfoder" id="remark1" style="width:50%;height:150px;"><?php if ($remark1 != "") {echo strip_tags($remark1);} else {echo strip_tags($quinfo['cd_name'] . " ได้ทำการ" . custype_name($conn, $quinfo['ctype']) . protype_name($conn, $quinfo['pro_type']) . " ของบริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด สถานที่ติดตั้ง " . $quinfo['loc_name'] . " " . $quinfo['loc_address'] . " สัญญาเริ่มวันที่ " . format_date_th($quinfo["date_quf"], 1) . " – " . format_date_th($quinfo["date_qut"], 1) . " (สัญญา 1 ปี) <br><br>

โดยลูกค้าได้แจ้งความประสงค์ขอถอด" . protype_name($conn, $quinfo['pro_type']) . "เนื่องจากทางลูกค้าได้ทำการเซ้งร้านให้กับเจ้าของคนใหม่ และทางเจ้าของร้านคนใหม่แจ้งว่าขอดูยอดขายของร้านก่อน หากต้องการติด" . protype_name($conn, $quinfo['pro_type']) . "ใหม่จะแจ้งให้ทราบอีกครั้ง<br><br>

จึงขอแจ้งแผนกช่าง เข้าไปดำเนินการถอด" . protype_name($conn, $quinfo['pro_type']) . " พร้อมอุปกรณ์ต่างๆ ตามรายละเอียด ดังนี้");}?></textarea>
        </span><br /></td>
      </tr>
      <tr>
      	<td>
      		<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;" id="productConlist">
    <tr>
     <td width="3%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>เลือก</strong></td>
      <td width="43%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="21%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น</strong></td>
      <td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>S/N</strong></td>
      <td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>


    </tr>
    <?php
for ($i = 1; $i <= 7; $i++) {
    if ($quinfo['cpro' . $i]) {
        ?>
			<tr>
		  	  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="checkbox" name="chkPro[]" value="<?php echo $i; ?>" <?php if (@in_array($i, $con_chkpro)) {echo 'checked="checked"';}?>><br>
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_proname($conn, $quinfo['cpro' . $i]); ?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $quinfo['pro_pod' . $i]; ?>
			 </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $quinfo['pro_sn' . $i]; ?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $quinfo['camount' . $i]; ?>
			  </td>
			</tr>
			<?php
}
}
?>

    </table><br>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
<!--                  <th width="3%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>เลือก</strong></th>-->
                 <th width="3%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></th>
                  <th width="85%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการแถม</strong></th>
                  <th width="12%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></th>
              </tr>
              <?php

for ($i = 1; $i <= 5; $i++) {
    if ($quinfo['cs_pro' . $i]) {
        ?>
						<tr>

							<td style="border:1px solid #000000;padding:5;text-align:center;">
							<input type="checkbox" name="chkProfree[]" value="<?php echo $i; ?>" <?php if (@in_array($i, $con_chkprofree)) {echo 'checked="checked"';}?>>
						  </td>
							<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><?php echo $quinfo['cs_pro' . $i]; ?></td>
							<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><?php echo $quinfo['cs_amount' . $i]; ?></td>
						  </tr>
					<?php
}

}
?>


            </table>

        </fieldset>
    </div><br>
      	</td>
      </tr>
<!--
      <tr>
	    <td width="50%">
        <span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
        <textarea name="remark2" class="inpfoder" id="remark2" style="width:50%;height:150px;"><?php echo strip_tags($remark2); ?></textarea>
        </span><br /></td>
      </tr>
      <tr>
	    <td width="50%">
        <span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
        <textarea name="remark3" class="inpfoder" id="remark3" style="width:50%;height:150px;"><?php echo strip_tags($remark3); ?></textarea>
        </span><br /></td>
      </tr>
-->
	  <tr>
	    <td width="50%"><strong>หมายเหตุ</strong><br />
        <br />
        <span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
        <textarea name="remark4" class="inpfoder" id="remark4" style="width:50%;height:50px;"><?php echo strip_tags($remark4); ?></textarea>
        </span><br /></td>
      </tr>
    </table>

	<table width="100%" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
	  <td width="25%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong><!--<input type="text" name="cs_sell" value="<?php echo $cs_sell; ?>" id="cs_sell" class="inpfoder" style="width:50%;text-align:center;">-->
                <select name="cs_sell" id="cs_sell" class="inputselect" style="width:50%;">
                <?php
$qusaletype = @mysqli_query($conn, "SELECT * FROM s_group_sale ORDER BY group_name ASC");
while ($row_saletype = @mysqli_fetch_array($qusaletype)) {
    ?>
					  	<option value="<?php echo $row_saletype['group_id']; ?>" <?php if ($cs_sell == $row_saletype['group_id']) {echo 'selected';}?>><?php echo $row_saletype['group_name']; ?></option>
					  <?php
}
?>
            </select></strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>พนักงานฝ่ายขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
<!--
                <strong>เบอร์โทร <input type="text" name="tel_sell" value="<?php echo $tel_sell; ?>" style="text-align: center;width: 150px;"></strong>
                <br><br>
-->
                <strong>วันที่ <input type="text" name="date_sell" style="text-align: center;" readonly value="<?php if ($date_sell == "") {echo date("d/m/Y");} else {echo $date_sell;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_sell'});</script></strong></td>
              </tr>
            </table>
        </td>
        <td width="25%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >
                <?php
$hsale = '';
if ($cs_hsell != "") {
    $hsale = $cs_hsell;
} else {
    $hsale = getNameSaleApprove($conn);
}
?>
                <input type="text" name="cs_hsell" value="<?php echo $hsale; ?>" id="cs_hsell" class="inpfoder" style="width:50%;text-align:center;border: none;"></strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>หัวหน้าฝ่ายขาย</strong></td>
              </tr>
              <tr>
              <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
<!--
              <strong>เบอร์โทร <input type="text" name="tel_hsell" value="<?php echo $tel_hsell; ?>" style="text-align: center;width: 150px;"></strong>
                <br><br>
-->
              <strong>วันที่ <input type="text" name="date_hsell" style="text-align: center;" readonly value="<?php if ($date_hsell == "") {echo date("d/m/Y");} else {echo $date_hsell;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_hsell'});</script></strong></td>
              </tr>
            </table>

        </td>
		<td width="25%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >
                <?php
$haccount = '';
if ($cs_account != "") {
    $haccount = $cs_account;
} else {
    $haccount = getNameAccountApprove($conn);
}
?>
                <input type="text" name="cs_haccount" value="<?php echo $haccount; ?>" id="cs_haccount" class="inpfoder" style="width:50%;text-align:center;border: none;"></strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>หัวหน้าฝ่ายการเงิน</strong></td>
              </tr>
              <tr>
              <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
<!--
              <strong>เบอร์โทร <input type="text" name="tel_hsell" value="<?php echo $tel_hsell; ?>" style="text-align: center;width: 150px;"></strong>
                <br><br>
-->
              <strong>วันที่ <input type="text" name="date_haccount" style="text-align: center;" readonly value="<?php if ($date_haccount == "") {echo date("d/m/Y");} else {echo $date_haccount;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_haccount'});</script></strong></td>
              </tr>
            </table>

        </td>
        <td width="25%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
               	 <?php
$hBig = '';
if ($cs_aceep != "") {
    $hBig = $cs_aceep;
} else {
    $hBig = getNameBigApprove($conn);
}
?>
                <strong><input type="text" name="cs_aceep" value="<?php echo $hBig; ?>" id="cs_aceep" class="inpfoder" style="width:50%;text-align:center;border: none;"></strong></td>
                </td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้มีอำนาจลงนาม</strong></td>
              </tr>
              <tr>
              <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
<!--
              <strong>เบอร์โทร <input type="text" name="tel_providers" value="<?php echo $tel_providers; ?>" style="text-align: center;width: 150px;"></strong>
                <br><br>
-->
              <strong>วันที่ <input type="text" name="date_accep" style="text-align: center;" readonly value="<?php if ($date_accep == "") {echo date("d/m/Y");} else {echo $date_accep;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_accep'});</script></strong></td>
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
	  <input type="button" value=" บันทึก " id="submitF" class="button bt_save" onclick="submitForm()">
      <input type="button" name="Cancel" id="resetF" value=" ยกเลิก " class="button bt_cancel" onClick="history.back();">
      </div>
      <?php
$a_not_exists = array();
post_param($a_param, $a_not_exists);
?>
      <input name="mode" type="hidden" id="mode" value="<?php echo $_GET['mode']; ?>">
      <input name="fo_id" type="hidden" id="fo_id" value="<?php echo $fo_id; ?>">
      <input name="process" type="hidden" id="process" value="<?php echo $process; ?>">
      <input name="st_setting" type="hidden" id="st_setting" value="<?php echo $st_setting; ?>">
      <input name="<?php echo $PK_field; ?>" type="hidden" id="<?php echo $PK_field; ?>" value="<?php echo $_GET[$PK_field]; ?>">
    </div>
  </form>
</DIV>
</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php include "../footer.php";?>
</DIV><!-- End #main-content -->
</DIV>
<?php if ($msg_user == 1) {?>
<script language=JavaScript>alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');</script>
<?php }?>
</BODY>
</HTML>

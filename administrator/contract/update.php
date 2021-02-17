<?php
include "../../include/config.php";
include "../../include/connect.php";
include "../../include/function.php";
include "config.php";

$vowels = array(",", "");

if ($_POST['mode'] != "") {
    $param = "";
    $a_not_exists = array();
    $param = get_param($a_param, $a_not_exists);

    if ($_POST['con_stime'] == "") {
        $_POST['con_stime'] = date("Y-m-d");
    } else {
        $a_sdate = explode("/", $_POST['con_stime']);
        $_POST['con_stime'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];
    }

    if ($_POST['con_startdate'] == "") {
        $_POST['con_startdate'] = date("Y-m-d");
    } else {
        $a_sdate = explode("/", $_POST['con_startdate']);
        $_POST['con_startdate'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];
    }

    if ($_POST['con_enddate'] == "") {
        $_POST['con_enddate'] = date("Y-m-d");
    } else {
        $a_sdate = explode("/", $_POST['con_enddate']);
        $_POST['con_enddate'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];
    }

    $_POST['con_price'] = str_replace($vowels, '', $_POST['con_price']);

    $checklist = '';

    foreach ($_POST['chkPro'] as $value) {
        $checklist .= $value . ',';
    }

    $checkTypePro = '';

    foreach ($_POST['chkTypePro'] as $value) {
        $checkTypePro .= $value . ',';
    }

    $checkProFree = '';

    foreach ($_POST['chkProfree'] as $value) {
        $checkProFree .= $value . ',';
    }

    $_POST['con_chkpro'] = substr($checklist, 0, -1);
    $_POST['con_chktypepro'] = substr($checkTypePro, 0, -1);
    $_POST['con_chkprofree'] = substr($checkProFree, 0, -1);

    $userCreate = getCreatePaper($conn, $tbl_name, " AND `ct_id`=" . $_POST['ct_id']);
    $headerIMG = get_headerPaper($conn, "DH", $userCreate);
    $footerIMG = get_headerPaper($conn, "DF", $userCreate);

    if ($_POST['mode'] == "add" || $_POST['mode'] == "cadd") {

        if ($_POST['con_id'] == "") {
            $_POST['con_id'] = check_contract_number($conn);
        }

        include "../include/m_add.php";

        $id = mysqli_insert_id($conn);

        if ($_POST['mode'] == "cadd") {
            $_FILES['fimages1']['name'] = "";
            $_FILES['fimages2']['name'] = "";

            @unlink("../../upload/contract/img/" . $_POST['con_img1']);
            @unlink("../../upload/contract/img/" . $_POST['con_img2']);

            $sql = "update $tbl_name set con_img1 = '',con_img2 = '' where $PK_field = '" . $id . "' ";
            mysqli_query($conn, $sql);
        } else {
            if ($_FILES['fimages1']['name'] != "") {

                @unlink("../../upload/contract/img/" . $_POST['con_img1']);

                $mname = "";
                $mname = gen_random_num(5);
                $filename = "";
                if ($filename == "") {
                    $name_data = explode(".", $_FILES['fimages1']['name']);
                }

                $type = $name_data[1];
                $filename = $mname . "." . $type;

                $target_dir = "../../upload/contract/img/";
                $target_file = $target_dir . basename($filename);
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["fimages1"]["tmp_name"]);

                if ($check !== false) {

                    move_uploaded_file($_FILES["fimages1"]["tmp_name"], $target_file);
                    $sql = "update $tbl_name set con_img1 = '" . $filename . "' where $PK_field = '" . $id . "' ";
                    //exit();
                    mysqli_query($conn, $sql);

                }
                $_POST['con_img1'] = $filename;

            } // end if ($_FILES[fimages][name] != "")

            if ($_FILES['fimages2']['name'] != "") {

                @unlink("../../upload/contract/img/" . $_POST['con_img2']);

                $mname = "";
                $mname = gen_random_num(5);
                $filename = "";
                if ($filename == "") {
                    $name_data = explode(".", $_FILES['fimages2']['name']);
                }

                $type = $name_data[1];
                $filename = $mname . "." . $type;

                $target_dir = "../../upload/contract/img/";
                $target_file = $target_dir . basename($filename);
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["fimages2"]["tmp_name"]);

                if ($check !== false) {

                    move_uploaded_file($_FILES["fimages2"]["tmp_name"], $target_file);
                    $sql = "update $tbl_name set con_img2 = '" . $filename . "' where $PK_field = '" . $id . "' ";
                    //exit();
                    mysqli_query($conn, $sql);

                }
                $_POST['con_img2'] = $filename;

            } // end if ($_FILES[fimages][name] != "")
        }

        include_once "../mpdf54/mpdf.php";

        $txtcsign = '';
        if ($_POST['csign'] == '0') {
            $txtcsign = '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;margin-top:5px;">
      <tr>
        <td width="50%" class="signature" style="vertical-align: top;line-height: 35px;">
			(ลงชื่อ)………………………....……………ผู้เช่า<br><br>
        </td>
        <td width="50%" class="signature" style="vertical-align: top;">
			(ลงชื่อ)………………………………………………ผู้ให้เช่า<br><br>
        </td>
      </tr>
    </table>';
        } else {
            $txtcsign = '';
        }

        include_once "form_contract.php";
        $mpdf = new mPDF('UTF-8', 'A4', '', '', '15', '15', '50', '40');
        $mpdf->SetAutoFont();
        $mpdf->SetHTMLHeader('<div><img src="'.$headerIMG.'"/></div>');

        $mpdf->SetHTMLFooter($txtcsign . '<div><img src="'.$footerIMG.'"/></div>');
        $mpdf->WriteHTML($form);
        $chaf = str_replace("/", "-", $_POST['con_id']);
        $mpdf->Output('../../upload/contract/' . $chaf . '.pdf', 'F');

        include_once "form_contract2.php";
        $mpdf = new mPDF('UTF-8', 'A4', '', '', '15', '15', '50', '40');
        $mpdf->SetAutoFont();
        $mpdf->SetHTMLHeader('<div><img src="'.$headerIMG.'"/></div>');
        $mpdf->SetHTMLFooter($txtcsign . '<div><img src="'.$footerIMG.'"/></div>');
        $mpdf->WriteHTML($form);
        $chaf = str_replace("/", "-", $_POST['con_id']);
        $mpdf->Output('../../upload/contract/' . $chaf . '-2.pdf', 'F');

        if ($_POST['mode'] == "cadd") {
            header("location:update.php?mode=update&ct_id=" . $id);
        } else {
            header("location:index.php?" . $param);
        }
    }
    if ($_POST['mode'] == "update" || $_POST['mode'] == "cupdate") {

        include "../include/m_update.php";

        $id = $_POST[$PK_field];

        if ($_POST['mode'] == "cupdate") {
            
            $_FILES['fimages1']['name'] = "";
            $_FILES['fimages2']['name'] = "";
            @unlink("../../upload/contract/img/" . $_POST['con_img1']);
            @unlink("../../upload/contract/img/" . $_POST['con_img2']);

            $sql = "update $tbl_name set con_img1 = '',con_img2 = '' where $PK_field = '" . $id . "' ";
            mysqli_query($conn, $sql);

        } else {

            if ($_FILES['fimages1']['name'] != "") {

                @unlink("../../upload/contract/img/" . $_POST['con_img1']);

                $mname = "";
                $mname = gen_random_num(5);
                $filename = "";
                if ($filename == "") {
                    $name_data = explode(".", $_FILES['fimages1']['name']);
                }

                $type = $name_data[1];
                $filename = $mname . "." . $type;

                $target_dir = "../../upload/contract/img/";
                $target_file = $target_dir . basename($filename);
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["fimages1"]["tmp_name"]);

                if ($check !== false) {

                    move_uploaded_file($_FILES["fimages1"]["tmp_name"], $target_file);
                    $sql = "update $tbl_name set con_img1 = '" . $filename . "' where $PK_field = '" . $id . "' ";
                    //exit();
                    mysqli_query($conn, $sql);

                }
                $_POST['con_img1'] = $filename;

            } // end if ($_FILES[fimages][name] != "")

            if ($_FILES['fimages2']['name'] != "") {

                @unlink("../../upload/contract/img/" . $_POST['con_img2']);

                $mname = "";
                $mname = gen_random_num(5);
                $filename = "";
                if ($filename == "") {
                    $name_data = explode(".", $_FILES['fimages2']['name']);
                }

                $type = $name_data[1];
                $filename = $mname . "." . $type;

                $target_dir = "../../upload/contract/img/";
                $target_file = $target_dir . basename($filename);
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["fimages2"]["tmp_name"]);

                if ($check !== false) {

                    move_uploaded_file($_FILES["fimages2"]["tmp_name"], $target_file);
                    $sql = "update $tbl_name set con_img2 = '" . $filename . "' where $PK_field = '" . $id . "' ";
                    //exit();
                    mysqli_query($conn, $sql);

                }
                $_POST['con_img2'] = $filename;

            } // end if ($_FILES[fimages][name] != "")
        }

        include_once "../mpdf54/mpdf.php";

        $txtcsign = '';
        if ($_POST['csign'] == '0') {
            $txtcsign = '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;margin-top:5px;">
      <tr>
        <td width="50%" class="signature" style="vertical-align: top;line-height: 35px;">
			(ลงชื่อ)………………………....……………ผู้เช่า<br><br>
        </td>
        <td width="50%" class="signature" style="vertical-align: top;">
			(ลงชื่อ)………………………………………………ผู้ให้เช่า<br><br>
        </td>
      </tr>
    </table>';
        } else {
            $txtcsign = '';
        }

        include_once "form_contract.php";
        $mpdf = new mPDF('UTF-8', 'A4', '', '', '15', '15', '50', '40');
        $mpdf->SetAutoFont();
        $mpdf->SetHTMLHeader('<div><img src="'.$headerIMG.'"/></div>');
        $mpdf->SetHTMLFooter($txtcsign . '<div><img src="'.$footerIMG.'"/></div>');
        $mpdf->WriteHTML($form);
        $chaf = str_replace("/", "-", $_POST['con_id']);
        $mpdf->Output('../../upload/contract/' . $chaf . '.pdf', 'F');

        include_once "form_contract2.php";
        $mpdf = new mPDF('UTF-8', 'A4', '', '', '15', '15', '50', '40');
        $mpdf->SetAutoFont();
        $mpdf->SetHTMLHeader('<div><img src="'.$headerIMG.'"/></div>');
        $mpdf->SetHTMLFooter($txtcsign . '<div><img src="'.$footerIMG.'"/></div>');
        $mpdf->WriteHTML($form);
        $chaf = str_replace("/", "-", $_POST['con_id']);
        $mpdf->Output('../../upload/contract/' . $chaf . '-2.pdf', 'F');

        if ($_POST['mode'] == "cupdate") {
            header("location:update.php?mode=update&ct_id=" . $id);
        } else {
            header("location:index.php?" . $param);
        }

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

    $a_sdate = explode("-", $con_stime);
    $con_stime = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $con_startdate);
    $con_startdate = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $con_enddate);
    $con_enddate = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $finfo = get_firstorder($conn, $cus_id);

    $con_chkpro = explode(',', $con_chkpro);
    $con_chktypepro = explode(',', $con_chktypepro);
    $con_chkprofree = explode(',', $con_chkprofree);

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

	function checkFluency(id){
		//console.log(id);

		if(id == 1){
			document.getElementById("Fluency1").checked = true;
			document.getElementById("Fluency2").checked = false;
			document.getElementById("Fluency3").checked = false;
		}else if(id == 2){
			document.getElementById("Fluency1").checked = false;
			document.getElementById("Fluency2").checked = true;
			document.getElementById("Fluency3").checked = false;
		}else{
			document.getElementById("Fluency1").checked = false;
			document.getElementById("Fluency2").checked = false;
			document.getElementById("Fluency3").checked = true;
		}
	}

	function changeContactNumber(){

		var con_id = document.getElementById("con_id").value.split(" ");
		var con_type_pro = document.getElementById("con_type_pro").value;


		document.getElementById("con_id").value = con_type_pro+' '+con_id[1];
		//console.log(document.getElementById("con_id").value,document.getElementById("con_type_pro").value);

	}


</script>
</HEAD>
<?php include "../../include/function_script.php";?>
<BODY>
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
<DIV class=content-box-content>
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

	<div>
	    <strong>เลือกประเภทสัญญาเช่า</strong>
		<input type="checkbox" name="chkTypePro[]" id="Fluency1" value="เครื่องล้างจาน" <?php if (@in_array('เครื่องล้างจาน', $con_chktypepro)) {echo 'checked="checked"';}?> onclick="javascript:checkFluency(1);"> เครื่องล้างจาน
        <input type="checkbox" name="chkTypePro[]" id="Fluency2" value="เครื่องล้างแก้ว" <?php if (@in_array('เครื่องล้างแก้ว', $con_chktypepro)) {echo 'checked="checked"';}?> onclick="javascript:checkFluency(2);"> เครื่องล้างแก้ว
        <input type="checkbox" name="chkTypePro[]" id="Fluency3" value="เครื่องผลิตน้ำแข็ง" <?php if (@in_array('เครื่องผลิตน้ำแข็ง', $con_chktypepro)) {echo 'checked="checked"';}?> onclick="javascript:checkFluency(3);"> เครื่องผลิตน้ำแข็ง
	</div><br>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td><strong>ชื่อลูกค้า :</strong>
            	<!--<select name="cus_id" id="cus_id" onChange="checkfirstorder(this.value,'cusadd','cusprovince','custel','cusfax','contactid','datef','datet','cscont','cstel','sloc_name','sevlast','prolist');" style="width:300px;">
                	<option value="">กรุณาเลือก</option>
                	<?php
$qu_cusf = @mysqli_query($conn, "SELECT * FROM s_first_order ORDER BY cd_name ASC");
while ($row_cusf = @mysqli_fetch_array($qu_cusf)) {

    ?>
							<option value="<?php echo $row_cusf['fo_id']; ?>" <?php if ($row_cusf['fo_id'] == $cus_id) {echo 'selected';}?>><?php echo $row_cusf['cd_name'] . " (" . $row_cusf['loc_name'] . ")"; ?></option>
							<?php
}
?>
                </select>-->
                <input name="cd_names" type="text" id="cd_names"  value="<?php echo get_customername($conn, $cus_id); ?>" style="width:50%;" readonly>
                <span id="rsnameid"><input type="hidden" name="cus_id" value="<?php echo $cus_id; ?>"></span><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
            </td>
            <td>
            	<strong>ประเภทสินค้า : </strong>
            	<select name="con_type_pro" id="con_type_pro" class="inputselect" onchange="changeContactNumber();">
					<option value="">กรุณาเลือกรายการ</option>
				  <?php
$qupro1 = @mysqli_query($conn, "SELECT * FROM s_group_contract ORDER BY group_id ASC");
while ($row_qupro1 = @mysqli_fetch_array($qupro1)) {
    ?>
						  <option value="<?php echo $row_qupro1['group_con_id']; ?>" <?php if ($con_type_pro == $row_qupro1['group_con_id']) {echo 'selected';}?>><?php echo $row_qupro1['group_con_id'] . ' - ' . $row_qupro1['group_name']; ?></option>
						<?php
}
?>
			  </select>&nbsp;&nbsp;&nbsp;
            	<strong>เลขที่สัญญา : <input type="text" name="con_id" value="<?php if ($con_id == "") {echo check_contract_number($conn);} else {echo $con_id;}
;?>" id="con_id" class="inpfoder" style="border:0;">&nbsp;&nbsp;เลขที่ FO  :</strong> <span id="contactid"><?php echo $finfo['fs_id']; ?></span>
            </td>
          </tr>
          <tr>
            <td><strong>ที่อยู่ :</strong> <span id="cusadd"><?php echo $finfo['cd_address']; ?></span></td>
            <td>
            	<strong>วันทำสัญญา  :</strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="con_stime" readonly value="<?php if ($con_stime == "") {echo date("d/m/Y");} else {echo $con_stime;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'con_stime'});</script></span>
            	<span style="padding-left: 20px;"> <strong>ลายเซ็นลูกค้า : </strong> </span><span style="padding-right: 5px;"><input type="radio" name="csign" value="0" <?php if ($csign == "0" || $csign == "") {echo 'checked';}?>> ทุกหน้า </span><span style="padding-right: 5px;"><input type="radio" name="csign" value="1" <?php if ($csign == "1") {echo 'checked';}?>> เฉพาะหน้าสุดท้าย </span>
            </td>
          </tr>
          <tr>
            <td><strong>จังหวัด :</strong> <span id="cusprovince"><?php echo province_name($conn, $finfo['cd_province']); ?></span></td>
            <td>
            	<strong>เริ่มสัญญา  :</strong> <span id="con_startdate"></span><input type="text" name="con_startdate" readonly value="<?php if ($con_startdate == "") {echo date("d/m/Y");} else {echo $con_startdate;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'con_startdate'});</script><strong> สิ้นสุดสัญญา :</strong> <span id="con_enddate"></span><input type="text" name="con_enddate" readonly value="<?php if ($con_enddate == "") {echo date("d/m/Y");} else {echo $con_enddate;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'con_enddate'});</script>
            </td>
          </tr>
          <tr>
            <td><strong>โทรศัพท์ :</strong> <span id="custel"><?php echo $finfo['cd_tel']; ?></span><strong>&nbsp;&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> <span id="cusfax"><?php echo $finfo['cd_fax']; ?></span></td>
            <td>
				<strong>โดยชำระค่าเช่าและค่าติดตั้งเครื่อง ทุกวันที่ </strong><span id="con_paymonth"><input type="text" name="con_paymonth" value="<?php echo number_format($con_paymonth); ?>" id="con_paymonth" class="inpfoder" style="width:10%;text-align: center;"></span> ของทุกเดือน
            </td>
          </tr>
          <tr>
            <td style="vertical-align: top;"><strong>ชื่อผู้ติดต่อ :</strong> <span id="cscont"><?php echo $finfo['c_contact']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<strong>เบอร์โทร :</strong> <span id="cstel"><?php echo $finfo['c_tel']; ?></span></td>
            <td style="vertical-align: top;">
            	<table>
                    <tr>
                        <td style="vertical-align: top;">
                        <input name="fimages1" type="file" id="fimages1"><br>
			  <?php
if ($con_img1) {
    ?>
                  <img src="../../upload/contract/img/<?php echo $con_img1 ?>" width="150">
                  <?php }?>
                  <input name="con_img1" type="hidden" value="<?php echo $con_img1; ?>">
                        </td>
                        <td style="vertical-align: top;">
                        <input name="fimages2" type="file" id="fimages2"><br>
			  <?php
if ($con_img2) {
    ?>
                  <img src="../../upload/contract/img/<?php echo $con_img2 ?>" width="150">
                  <?php }?>
                  <input name="con_img2" type="hidden" value="<?php echo $con_img2; ?>">
                  </td>
                    </tr>
                </table>
            </td>
          </tr>
	</table><br><br>
	<strong>กรุณาเลือกสินค้า <span style="color: red;">(เฉพาะเครื่องล้างจาน, เครื่องล้างแก้ว, เครื่องผลิตน้ำแข็ง เท่านั้น)</span></strong><br><br>
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
    if ($finfo['cpro' . $i]) {
        ?>
			<tr>
		  	  <td style="border:1px solid #000000;padding:5;text-align:center;">
				<input type="checkbox" name="chkPro[]" value="<?php echo $i; ?>" <?php if (@in_array($i, $con_chkpro)) {echo 'checked="checked"';}?>><br>
			  </td>
			  <td style="border:1px solid #000000;text-align:left;padding:5;">
			  <?php echo get_proname($conn, $finfo['cpro' . $i]) . ' ' . get_prodetail($conn, $finfo['cpro' . $i]); ?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_pod' . $i]; ?>
			 </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;" >
			  <?php echo $finfo['pro_sn' . $i]; ?>
			  </td>
			  <td style="border:1px solid #000000;padding:5;text-align:center;">
			  <?php echo $finfo['camount' . $i]; ?>
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
    if ($finfo['cs_pro' . $i]) {
        ?>
						<tr>
<!--
							<td style="border:1px solid #000000;padding:5;text-align:center;">
							<input type="checkbox" name="chkProfree[]" value="<?php echo $i; ?>" <?php if (@in_array($i, $con_chkprofree)) {echo 'checked="checked"';}?>>
						  </td>
-->
							<td style="border:1px solid #000000;padding:5;text-align:center;">
							<?php echo $i; ?>
						  </td>
							<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><?php echo $finfo['cs_pro' . $i]; ?></td>
							<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><?php echo $finfo['cs_amount' . $i]; ?></td>
						  </tr>
					<?php
}

}
?>


            </table>

        </fieldset>
    </div><br>
    <div class="formArea">
      <input type="submit" name="Submit" id="Submit" value="Submit" class="button">
      <input type="reset" name="Submit" value="Reset" class="button">
      <?php
$a_not_exists = array();
post_param($a_param, $a_not_exists);
?>
      <input name="mode" type="hidden" id="mode" value="<?php echo $_GET['mode']; ?>">
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

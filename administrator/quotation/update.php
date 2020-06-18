<?php
include_once "../../include/config.php";
include_once "../../include/connect.php";
include_once "../../include/function.php";
include_once "config.php";

$vowels = array(",");

if ($_POST['mode'] != "") {
    $param = "";
    $a_not_exists = array();
    $param = get_param($a_param, $a_not_exists);

    $_POST['cd_name'] = addslashes($_POST['cd_name']);
    $_POST['cd_address'] = addslashes($_POST['cd_address']);
    $_POST['c_contact'] = addslashes($_POST['c_contact']);

    $a_sdate = explode("/", $_POST['pay_apv']);
    $_POST['pay_apv'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    $date_forder = $_POST['date_forder'];
    $a_sdate = explode("/", $_POST['date_forder']);
    $date_forder = $a_sdate[0] . "-" . $a_sdate[1] . "-" . ($a_sdate[2] + 543);
    $_POST['date_forder'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    $a_sdate = explode("/", $_POST['cs_ship']);
    $_POST['cs_ship'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    $a_sdate = explode("/", $_POST['cs_setting']);
    $_POST['cs_setting'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    $a_sdate = explode("/", $_POST['date_sell']);
    $_POST['date_sell'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    $a_sdate = explode("/", $_POST['date_hsell']);
    $_POST['date_hsell'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    $a_sdate = explode("/", $_POST['date_account']);
    $_POST['date_account'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    $a_sdate = explode("/", $_POST['date_quf']);
    $_POST['date_quf'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    $a_sdate = explode("/", $_POST['date_qut']);
    $_POST['date_qut'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

    $_POST['ccomment'] = nl2br($_POST['ccomment']);
    $_POST['qucomment'] = nl2br($_POST['qucomment']);
    $_POST['remark'] = nl2br(addslashes($_POST['remark']));

    $_POST['separate'] = 0;

    $_POST["cprice1"] = str_replace($vowels, "", $_POST["cprice1"]);
    $_POST["cprice2"] = str_replace($vowels, "", $_POST["cprice2"]);
    $_POST["cprice3"] = str_replace($vowels, "", $_POST["cprice3"]);
    $_POST["cprice4"] = str_replace($vowels, "", $_POST["cprice4"]);
    $_POST["cprice5"] = str_replace($vowels, "", $_POST["cprice5"]);
    $_POST["cprice6"] = str_replace($vowels, "", $_POST["cprice6"]);
    $_POST["cprice7"] = str_replace($vowels, "", $_POST["cprice7"]);

    $_POST["paym"] = str_replace($vowels, "", $_POST["paym"]);
    $_POST["paym2"] = str_replace($vowels, "", $_POST["paym2"]);
    $_POST["paym3"] = str_replace($vowels, "", $_POST["paym3"]);
    $_POST["pays"] = str_replace($vowels, "", $_POST["pays"]);
    $_POST["paysa"] = str_replace($vowels, "", $_POST["paysa"]);
    $_POST["paysad"] = str_replace($vowels, "", $_POST["paysad"]);

    $sumTotal = 0;

    if ($_POST['cpro1'] != "") {
        if ($_POST['pro_sn1'] == "") {
            $_POST['pro_sn1'] = 1;
        }
        $totalSub1 = $_POST['pro_sn1'] * $_POST['camount1'];
        if ($_POST['cprice1'] != "") {$totalSub1 = $totalSub1 - $_POST['cprice1'];
        } else { $_POST['cprice1'] = "";}
        $sumTotal = $sumTotal + $totalSub1;
        if ($totalSub1 != "" || $totalSub1 != 0) {
            $totalSub1s = number_format($totalSub1);
        }
    }

    if ($_POST['cpro2'] != "") {
        if ($_POST['pro_sn2'] == "") {
            $_POST['pro_sn2'] = 1;
        }
        $totalSub2 = $_POST['pro_sn2'] * $_POST['camount2'];
        if ($_POST['cprice2'] != "") {$totalSub2 = $totalSub2 - $_POST['cprice2'];
        } else { $_POST['cprice2'] = "";}
        $sumTotal = $sumTotal + $totalSub2;
        if ($totalSub2 != "" || $totalSub2 != 0) {
            $totalSub2s = number_format($totalSub2);
        }
    }

    if ($_POST['cpro3'] != "") {
        if ($_POST['pro_sn3'] == "") {
            $_POST['pro_sn3'] = 1;
        }
        $totalSub3 = $_POST['pro_sn3'] * $_POST['camount3'];
        if ($_POST['cprice3'] != "") {$totalSub3 = $totalSub3 - $_POST['cprice3'];
        } else { $_POST['cprice3'] = "";}
        $sumTotal = $sumTotal + $totalSub3;
        if ($totalSub3 != "" || $totalSub3 != 0) {
            $totalSub3s = number_format($totalSub3);
        }
    }

    if ($_POST['cpro4'] != "") {
        if ($_POST['pro_sn4'] == "") {
            $_POST['pro_sn4'] = 1;
        }
        $totalSub4 = $_POST['pro_sn4'] * $_POST['camount4'];
        if ($_POST['cprice4'] != "") {$totalSub4 = $totalSub4 - $_POST['cprice4'];
        } else { $_POST['cprice4'] = "";}
        $sumTotal = $sumTotal + $totalSub4;
        if ($totalSub4 != "" || $totalSub4 != 0) {
            $totalSub4s = number_format($totalSub4);
        }
    }

    if ($_POST['cpro5'] != "") {
        if ($_POST['pro_sn5'] == "") {
            $_POST['pro_sn5'] = 1;
        }
        $totalSub5 = $_POST['pro_sn5'] * $_POST['camount5'];
        if ($_POST['cprice5'] != "") {$totalSub5 = $totalSub5 - $_POST['cprice5'];
        } else { $_POST['cprice5'] = "";}
        $sumTotal = $sumTotal + $totalSub5;
        if ($totalSub5 != "" || $totalSub5 != 0) {
            $totalSub5s = number_format($totalSub5);
        }
    }

    if ($_POST['cpro6'] != "") {
        if ($_POST['pro_sn6'] == "") {
            $_POST['pro_sn6'] = 1;
        }
        $totalSub6 = $_POST['pro_sn6'] * $_POST['camount6'];
        if ($_POST['cprice6'] != "") {$totalSub6 = $totalSub6 - $_POST['cprice6'];
        } else { $_POST['cprice6'] = "";}
        $sumTotal = $sumTotal + $totalSub6;
        if ($totalSub6 != "" || $totalSub6 != 0) {
            $totalSub6s = number_format($totalSub6);
        }
    }

    if ($_POST['cpro7'] != "") {
        if ($_POST['pro_sn7'] == "") {
            $_POST['pro_sn7'] = 1;
        }
        $totalSub7 = $_POST['pro_sn7'] * $_POST['camount7'];
        if ($_POST['cprice7'] != "") {$totalSub7 = $totalSub7 - $_POST['cprice7'];
        } else { $_POST['cprice7'] = "";}
        $sumTotal = $sumTotal + $totalSub7;
        if ($totalSub7 != "" || $totalSub7 != 0) {
            $totalSub7s = number_format($totalSub7);
        }
    }

    $sumprice = $sumTotal;
    $sumpricevat = ($sumprice * 7) / 100;
    $sumtotals = $sumprice + $sumpricevat;

    if ($_POST["payc"] == "1") {

        $_POST['guaran3'] = "";
        $_POST['guaran4'] = "0";

        if ($_POST['paym'] != "") {
            $_POST['paym2'] = $sumtotals - $_POST['paym'];
        }

        // if($_POST['guaran3'] != ""){
        //   $_POST['paym'] = ($_POST['guaran3']/100)*$sumtotals;
        //   $_POST['guaran4'] = ($_POST['guaran3']/100)*$sumtotals;
        //   $_POST['paym2'] = ($sumtotals - (($_POST['guaran3']/100)*$sumtotals));
        // }else{
        //   $_POST['paym'] = "0";
        //   $_POST['paym2'] = $sumtotals;
        //   $_POST['guaran4'] = "0";
        // }

        $_POST['pays'] = "";
        $_POST['paysa'] = "0";
        $_POST['paysad'] = "";
    } else {

        if ($_POST['pays'] != "") {
            if ($_POST['guaran3'] != "") {
                //$_POST['paysa'] = ($sumtotals - (($_POST['guaran3']/100)*$sumtotals)) / $_POST['pays'];
                $_POST['paysa'] = $sumtotals / $_POST['pays'];
                $_POST['guaran4'] = ($_POST['guaran3'] / 100) * $sumtotals;
            } else {
                $_POST['paysa'] = $sumtotals / $_POST['pays'];
                $_POST['guaran4'] = "0";
            }

        }

        $_POST['paym'] = "0";
        $_POST['paym2'] = "0";
        $_POST['paym3'] = "0";
    }

    if ($_POST['mode'] == "add") {

        $_POST['fs_id'] = get_snfirstorders($conn, $_POST['fs_id']);
        $_POST['status_use'] = 1;
        $_POST['loc_name'] = addslashes($_POST['loc_name']);
        $_POST['st_setting'] = 0;

        include_once "../include/m_add.php";
        $id = mysqli_insert_id($conn);

        include_once "../mpdf54/mpdf.php";
        include_once "form_quotation.php";
        $mpdf = new mPDF('UTF-8');
        $mpdf->SetAutoFont();
        //$mpdf->showWatermarkText = true;
        //$mpdf->WriteHTML('<watermarktext content="NOT YET APPROVED" alpha="0.4" />');
        $mpdf->WriteHTML($form);
        $chaf = str_replace("/", "-", $_POST['fs_id']);
        $mpdf->Output('../../upload/quotation/' . $chaf . '.pdf', 'F');
        // header("Location:update.php?mode=update&qu_id=".$id);
        header("location:index.php?" . $param);
    }
    if ($_POST['mode'] == "update") {

        $_POST['loc_name'] = addslashes($_POST['loc_name']);

        include_once "../include/m_update.php";
        $id = $_REQUEST[$PK_field];

        //require_once("genpdf.php");

        @mysqli_query($conn, "UPDATE `s_quotation` SET `process` = '0' WHERE `s_quotation`.`qu_id` = " . $id . ";");

        @mysqli_query($conn, "DELETE FROM `s_approve` WHERE tag_db = '" . $tbl_name . "' AND t_id = '" . $id . "'");

        include_once "../mpdf54/mpdf.php";
        include_once "form_quotation.php";
        $mpdf = new mPDF('UTF-8');
        $mpdf->SetAutoFont();
//                $mpdf->showWatermarkText = true;
        //                $mpdf->WriteHTML('<watermarktext content="NOT YET APPROVED" alpha="0.4" />');
        $mpdf->WriteHTML($form);
        $chaf = str_replace("/", "-", $_POST['fs_id']);
        $mpdf->Output('../../upload/quotation/' . $chaf . '.pdf', 'F');

        //header("Location:update.php?mode=update&qu_id=".$id);
        header("location:index.php?" . $param);
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

    $a_sdate = explode("-", $pay_apv);
    $pay_apv = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $date_forder);
    $date_forder = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $cs_ship);
    $cs_ship = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $cs_setting);
    $cs_setting = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $date_sell);
    $date_sell = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $date_hsell);
    $date_hsell = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $date_account);
    $date_account = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $date_quf);
    $date_quf = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $a_sdate = explode("-", $date_qut);
    $date_qut = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

    $sumTotal = 0;

    if ($cpro1 != "") {
        if ($pro_sn1 == "") {
            $pro_sn1 = 1;
        }
        $totalSub1 = $pro_sn1 * $camount1;
        if ($cprice1 != "") {$totalSub1 = $totalSub1 - $cprice1;
        } else { $cprice1 = "";}
        $sumTotal = $sumTotal + $totalSub1;
        if ($totalSub1 != "" || $totalSub1 != 0) {
            $totalSub1s = number_format($totalSub1);
        }
    }

    if ($cpro2 != "") {
        if ($pro_sn2 == "") {
            $pro_sn2 = 1;
        }
        $totalSub2 = $pro_sn2 * $camount2;
        if ($cprice2 != "") {$totalSub2 = $totalSub2 - $cprice2;
        } else { $cprice2 = "";}
        $sumTotal = $sumTotal + $totalSub2;
        if ($totalSub2 != "" || $totalSub2 != 0) {
            $totalSub2s = number_format($totalSub2);
        }
    }

    if ($cpro3 != "") {
        if ($pro_sn3 == "") {
            $pro_sn3 = 1;
        }
        $totalSub3 = $pro_sn3 * $camount3;
        if ($cprice3 != "") {$totalSub3 = $totalSub3 - $cprice3;
        } else { $cprice3 = "";}
        $sumTotal = $sumTotal + $totalSub3;
        if ($totalSub3 != "" || $totalSub3 != 0) {
            $totalSub3s = number_format($totalSub3);
        }
    }

    if ($cpro4 != "") {
        if ($pro_sn4 == "") {
            $pro_sn4 = 1;
        }
        $totalSub4 = $pro_sn4 * $camount4;
        if ($cprice4 != "") {$totalSub4 = $totalSub4 - $cprice4;
        } else { $cprice4 = "";}
        $sumTotal = $sumTotal + $totalSub4;
        if ($totalSub4 != "" || $totalSub4 != 0) {
            $totalSub4s = number_format($totalSub4);
        }
    }

    if ($cpro5 != "") {
        if ($pro_sn5 == "") {
            $pro_sn5 = 1;
        }
        $totalSub5 = $pro_sn5 * $camount5;
        if ($cprice5 != "") {$totalSub5 = $totalSub5 - $cprice5;
        } else { $cprice5 = "";}
        $sumTotal = $sumTotal + $totalSub5;
        if ($totalSub5 != "" || $totalSub5 != 0) {
            $totalSub5s = number_format($totalSub5);
        }
    }

    if ($cpro6 != "") {
        if ($pro_sn6 == "") {
            $pro_sn6 = 1;
        }
        $totalSub6 = $pro_sn6 * $camount6;
        if ($cprice6 != "") {$totalSub6 = $totalSub6 - $cprice6;
        } else { $cprice6 = "";}
        $sumTotal = $sumTotal + $totalSub6;
        if ($totalSub6 != "" || $totalSub6 != 0) {
            $totalSub6s = number_format($totalSub6);
        }
    }

    if ($cpro7 != "") {
        if ($pro_sn7 == "") {
            $pro_sn7 = 1;
        }
        $totalSub7 = $pro_sn7 * $camount7;
        if ($cprice7 != "") {$totalSub7 = $totalSub7 - $cprice7;
        } else { $cprice7 = "";}
        $sumTotal = $sumTotal + $totalSub7;
        if ($totalSub7 != "" || $totalSub7 != 0) {
            $totalSub7s = number_format($totalSub7);
        }
    }

    $sumprice = $sumTotal;
    $sumpricevat = ($sumprice * 7) / 100;
    $sumtotals = $sumprice + $sumpricevat;

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

function submitForm() {
		document.getElementById("submitF").disabled = true;
		document.getElementById("resetF").disabled = true;
		document.form1.submit()
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
  <LI><A class=shortcut-button href="../quotation/"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
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
    <td style="padding-bottom:5px;">
    <?php
$userCreate = getCreatePaper($conn, $tbl_name, " AND `qu_id`= " . $qu_id);
$headerIMG = get_headerPaper($conn, "QAB", $userCreate);
?>
    <img src="<?php echo $headerIMG; ?>" width="100%" /></td>
  </tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> <input type="text" name="cd_name" value="<?php echo $cd_name; ?>" id="cd_name" class="inpfoder" style="width:70%;"></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>ประเภทสินค้า :</strong>
            <select name="pro_type" id="pro_type" class="inputselect">
                <?php
$quprotype = @mysqli_query($conn, "SELECT * FROM s_group_product ORDER BY group_name ASC");
while ($row_protype = @mysqli_fetch_array($quprotype)) {
    ?>
					  	<option value="<?php echo $row_protype['group_id']; ?>" <?php if ($pro_type == $row_protype['group_id']) {echo 'selected';}?>><?php echo $row_protype['group_name']; ?></option>
					  <?php
}
?>
            </select>
            </td>

          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong> <input type="text" name="cd_address" value="<?php echo $cd_address; ?>" id="cd_address" class="inpfoder" style="width:80%;"></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong>เลขที่ใบเสนอราคาซื้อ:</strong>
            <input type="text" name="fs_id" value="<?php if ($fs_id == "") {echo check_quotation($conn);} else {echo $fs_id;}
;?>" id="fs_id" class="inpfoder" >
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>จังหวัด :</strong>
            <select name="cd_province" id="cd_province" class="inputselect">
                <?php
$quprovince = @mysqli_query($conn, "SELECT * FROM s_province ORDER BY province_id ASC");
while ($row_province = @mysqli_fetch_array($quprovince)) {
    ?>
					  	<option value="<?php echo $row_province['province_id']; ?>" <?php if ($cd_province == $row_province['province_id']) {echo 'selected';}?>><?php echo $row_province['province_name']; ?></option>
					  <?php
}
?>
            </select>
           	</td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong> วันที่ :</strong> <input type="text" name="date_forder" readonly value="<?php if ($date_forder == "") {echo date("d/m/Y");} else {echo $date_forder;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_forder'});</script>
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>โทรศัพท์ :</strong> <input type="text" name="cd_tel" value="<?php echo $cd_tel; ?>" id="cd_tel" class="inpfoder">
              <strong>อีเมล์ :</strong>
              <input type="text" name="cd_fax" value="<?php echo $cd_fax; ?>" id="cd_fax" class="inpfoder"></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>ชื่อผู้ติดต่อ :</strong>
              <input type="text" name="c_contact" value="<?php echo $c_contact; ?>" id="c_contact" class="inpfoder">
              <strong>เบอร์โทร :</strong>
              <input type="text" name="c_tel" value="<?php echo $c_tel; ?>" id="c_tel" class="inpfoder">
            </td>
          </tr>
</table>

  <br>
<table width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;">
    <tr>
      <td width="3%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="40%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="20%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น</strong></td>
      <td width="7%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ส่วนลด</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคาสุทธิ</strong></td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">1</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">
      <select name="cpro1" id="cpro1" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
$qupro1 = @mysqli_query($conn, "SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
while ($row_qupro1 = @mysqli_fetch_array($qupro1)) {
    ?>
                  <option value="<?php echo $row_qupro1['group_id']; ?>" <?php if ($cpro1 == $row_qupro1['group_id']) {echo 'selected';}?>><?php echo $row_qupro1['group_name']; ?></option>
                <?php
}
?>
      </select>
      <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro1');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod1" id="pro_pod1" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
$qupros1 = @mysqli_query($conn, "SELECT * FROM s_group_pod ORDER BY group_name ASC");
while ($row_qupros1 = @mysqli_fetch_array($qupros1)) {
    ?>
                  <option value="<?php echo $row_qupros1['group_name']; ?>" <?php if ($pro_pod1 == $row_qupros1['group_name']) {echo 'selected';}?>><?php echo $row_qupros1['group_name']; ?></option>
                <?php
}
?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod1');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
        <input type="text" name="pro_sn1" value="<?php echo $pro_sn1; ?>" id="pro_sn1" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount1" value="<?php echo $camount1; ?>" id="camount1" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice1" value="<?php echo $cprice1; ?>" id="cprice1" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub1s; ?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">2</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro2" id="cpro2" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
$qupro1 = @mysqli_query($conn, "SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
while ($row_qupro2 = @mysqli_fetch_array($qupro1)) {
    ?>
                  <option value="<?php echo $row_qupro2['group_id']; ?>" <?php if ($cpro2 == $row_qupro2['group_id']) {echo 'selected';}?>><?php echo $row_qupro2['group_name']; ?></option>
                <?php
}
?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro2');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod2" id="pro_pod2" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
$qupros2 = @mysqli_query($conn, "SELECT * FROM s_group_pod ORDER BY group_name ASC");
while ($row_qupros2 = @mysqli_fetch_array($qupros2)) {
    ?>
                  <option value="<?php echo $row_qupros2['group_name']; ?>" <?php if ($pro_pod2 == $row_qupros2['group_name']) {echo 'selected';}?>><?php echo $row_qupros2['group_name']; ?></option>
                <?php
}
?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod2');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="pro_sn2" value="<?php echo $pro_sn2; ?>" id="pro_sn2" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount2" value="<?php echo $camount2; ?>" id="camount2" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      <input type="text" name="cprice2" value="<?php echo $cprice2; ?>" id="cprice2" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub2s; ?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">3</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro3" id="cpro3" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
$qupro3 = @mysqli_query($conn, "SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
while ($row_qupro3 = @mysqli_fetch_array($qupro3)) {
    ?>
                  <option value="<?php echo $row_qupro3['group_id']; ?>" <?php if ($cpro3 == $row_qupro3['group_id']) {echo 'selected';}?>><?php echo $row_qupro3['group_name']; ?></option>
                <?php
}
?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro3');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod3" id="pro_pod3" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
$qupros3 = @mysqli_query($conn, "SELECT * FROM s_group_pod ORDER BY group_name ASC");
while ($row_qupros3 = @mysqli_fetch_array($qupros3)) {
    ?>
                  <option value="<?php echo $row_qupros3['group_name']; ?>" <?php if ($pro_pod3 == $row_qupros3['group_name']) {echo 'selected';}?>><?php echo $row_qupros3['group_name']; ?></option>
                <?php
}
?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod3');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn3" value="<?php echo $pro_sn3; ?>" id="pro_sn3" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount3" value="<?php echo $camount3; ?>" id="camount3" class="inpfoder" style="width:100%;text-align:center;">
      </td>
		<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice3" value="<?php echo $cprice3; ?>" id="cprice3" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub3s; ?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">4</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro4" id="cpro4" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
$qupro4 = @mysqli_query($conn, "SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
while ($row_qupro4 = @mysqli_fetch_array($qupro4)) {
    ?>
                  <option value="<?php echo $row_qupro4['group_id']; ?>" <?php if ($cpro4 == $row_qupro4['group_id']) {echo 'selected';}?>><?php echo $row_qupro4['group_name']; ?></option>
                <?php
}
?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro4');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod4" id="pro_pod4" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
$qupros4 = @mysqli_query($conn, "SELECT * FROM s_group_pod ORDER BY group_name ASC");
while ($row_qupros4 = @mysqli_fetch_array($qupros4)) {
    ?>
                  <option value="<?php echo $row_qupros4['group_name']; ?>" <?php if ($pro_pod4 == $row_qupros4['group_name']) {echo 'selected';}?>><?php echo $row_qupros4['group_name']; ?></option>
                <?php
}
?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod4');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn4" value="<?php echo $pro_sn4; ?>" id="pro_sn4" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount4" value="<?php echo $camount4; ?>" id="camount4" class="inpfoder" style="width:100%;text-align:center;">
      </td>
	<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice4" value="<?php echo $cprice4; ?>" id="cprice4" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub4s; ?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">5</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro5" id="cpro5" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
$qupro5 = @mysqli_query($conn, "SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
while ($row_qupro5 = @mysqli_fetch_array($qupro5)) {
    ?>
                  <option value="<?php echo $row_qupro5['group_id']; ?>" <?php if ($cpro5 == $row_qupro5['group_id']) {echo 'selected';}?>><?php echo $row_qupro5['group_name']; ?></option>
                <?php
}
?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro5');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod5" id="pro_pod5" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
$qupros5 = @mysqli_query($conn, "SELECT * FROM s_group_pod ORDER BY group_name ASC");
while ($row_qupros5 = @mysqli_fetch_array($qupros5)) {
    ?>
                  <option value="<?php echo $row_qupros5['group_name']; ?>" <?php if ($pro_pod5 == $row_qupros5['group_name']) {echo 'selected';}?>><?php echo $row_qupros5['group_name']; ?></option>
                <?php
}
?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod5');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn5" value="<?php echo $pro_sn5; ?>" id="pro_sn5" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount5" value="<?php echo $camount5; ?>" id="camount5" class="inpfoder" style="width:100%;text-align:center;">
      </td>
		<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice5" value="<?php echo $cprice5; ?>" id="cprice5" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub5s; ?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">6</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro6" id="cpro6" class="inputselect" style="width:90%;" >
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
$qupro6 = @mysqli_query($conn, "SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
while ($row_qupro6 = @mysqli_fetch_array($qupro6)) {
    ?>
                  <option value="<?php echo $row_qupro6['group_id']; ?>" <?php if ($cpro6 == $row_qupro6['group_id']) {echo 'selected';}?>><?php echo $row_qupro6['group_name']; ?></option>
                <?php
}
?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro6');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod6" id="pro_pod6" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
$qupros6 = @mysqli_query($conn, "SELECT * FROM s_group_pod ORDER BY group_name ASC");
while ($row_qupros6 = @mysqli_fetch_array($qupros6)) {
    ?>
                  <option value="<?php echo $row_qupros6['group_name']; ?>" <?php if ($pro_pod6 == $row_qupros6['group_name']) {echo 'selected';}?>><?php echo $row_qupros6['group_name']; ?></option>
                <?php
}
?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod6');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn6" value="<?php echo $pro_sn6; ?>" id="pro_sn6" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount6" value="<?php echo $camount6; ?>" id="camount6" class="inpfoder" style="width:100%;text-align:center;">
      </td>
		<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice6" value="<?php echo $cprice6; ?>" id="cprice6" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub6s; ?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">7</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro7" id="cpro7" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
$qupro7 = @mysqli_query($conn, "SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
while ($row_qupro7 = @mysqli_fetch_array($qupro7)) {
    ?>
                  <option value="<?php echo $row_qupro7['group_id']; ?>" <?php if ($cpro7 == $row_qupro7['group_id']) {echo 'selected';}?>><?php echo $row_qupro7['group_name']; ?></option>
                <?php
}
?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro7');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod7" id="pro_pod7" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
$qupros7 = @mysqli_query($conn, "SELECT * FROM s_group_pod ORDER BY group_name ASC");
while ($row_qupros7 = @mysqli_fetch_array($qupros7)) {
    ?>
                  <option value="<?php echo $row_qupros7['group_name']; ?>" <?php if ($pro_pod7 == $row_qupros7['group_name']) {echo 'selected';}?>><?php echo $row_qupros7['group_name']; ?></option>
                <?php
}
?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod7');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn7" value="<?php echo $pro_sn7; ?>" id="pro_sn7" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount7" value="<?php echo $camount7; ?>" id="camount7" class="inpfoder" style="width:100%;text-align:center;">
      </td>
	<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice7" value="<?php echo $cprice7; ?>" id="cprice7" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub7s; ?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>รวมทั้งหมด</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;"><?php echo number_format($sumprice, 2); ?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>VAT 7 %</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;"><?php echo number_format($sumpricevat, 2); ?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" style="text-align:center;border:0px solid #003399;padding:9px 5px;background-color: #ddebf7;"><strong><?php echo baht_text($sumtotals); ?></strong></td>
      <td style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>ราคารวมทั้งสิ้น</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;"><?php echo number_format($sumtotals, 2); ?>&nbsp;&nbsp;</td>
    </tr>
    </table><br>
	<table width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td style="border:0;padding:0;width:60%;vertical-align:top;">
            	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                  <th width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></th>
                  <th width="75%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการแถม</strong></th>
                  <th width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></th>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">1</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro1" value="<?php echo $cs_pro1; ?>" id="cs_pro1" class="inpfoder" style="width:90%;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount1" value="<?php echo $cs_amount1; ?>" id="cs_amount1" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">2</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro2" value="<?php echo $cs_pro2; ?>" id="cs_pro2" class="inpfoder" style="width:90%;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount2" value="<?php echo $cs_amount2; ?>" id="cs_amount2" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">3</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro3" value="<?php echo $cs_pro3; ?>" id="cs_pro3" class="inpfoder" style="width:90%;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount3" value="<?php echo $cs_amount3; ?>" id="cs_amount3" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">4</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro4" value="<?php echo $cs_pro4; ?>" id="cs_pro4" class="inpfoder" style="width:90%;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount4" value="<?php echo $cs_amount4; ?>" id="cs_amount4" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">5</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro5" value="<?php echo $cs_pro5; ?>" id="cs_pro5" class="inpfoder" style="width:90%;height:27px;"></td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount5" value="<?php echo $cs_amount5; ?>" id="cs_amount5" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
              </tr>
            </table></td>
          </tr>
        </table>
  <br>
	<table width="100%" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:left;padding-top:10px;padding-bottom:10px;">
        <p><strong>เงื่อนไขการชำระเงิน</strong></p>
        <p>
        	<input type="radio" name="payc" value="1" <?php if ($payc == "1") {echo "checked";}?>> ชำระเงินสด
       		<br>
       		<span style="padding-left: 23px;">ชำระมัดจำสินค้า จำนวน</span> <input type="text" name="paym" value="<?php echo $paym; ?>" style="text-align: center;width: 80px;"> บาท ณ วันอนุมัติสั่งซื้อสินค้า <br/>
           <span style="padding-left: 23px;">ชำระส่วนที่เหลือ จำนวน</span> <?php echo number_format($paym2, 2); ?> บาท <span style="padding-left: 23px;">เครดิต</span> <input type="text" name="paym3" value="<?php echo $paym3; ?>" style="text-align: center;width: 80px;"> วัน

<!--       		<input type="text" name="pay_apv" readonly value="<?php if ($pay_apv == "") {echo date("d/m/Y");} else {echo $pay_apv;}?>" class="inpfoder" style="    width: 75px;"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'pay_apv'});</script>-->

       	</p>
        <p>
        	<input type="radio" name="payc" value="2" <?php if ($payc == "2") {echo "checked";}?>> แบ่งชำระ <input type="text" name="pays" value="<?php echo $pays; ?>" style="text-align: center;width: 50px;"> งวด<br>
        	<span style="padding-left: 23px;width: 50px;">ชำระงวดละ</span> <?php echo number_format($paysa, 2); ?> บาท ทุกวันที่ <input type="text" name="paysad" value="<?php echo $paysad; ?>" style="text-align: center;width: 50px;"> ของทุกเดือน <br/>
          <br/><span>**ราคาดังกล่าวรวมภาษีมูลค่าเพิ่ม 7% เรียบร้อยแล้ว</span>
        </p>
        <p><strong>เงื่อนไขการรับประกันและการส่งสินค้า</strong></p>
        <p>
			1. การรับประกันสินค้า รับประกันตัวเครื่อง อะไหล่และบริการฟรี <input type="text" name="guaran1" value="<?php echo $guaran1; ?>" style="text-align: center;width: 70px;"> ปี หรือตามเงื่อนไขการขาย<br>
			2. บริษัทเข้าบริการตรวจเช็คทุกๆ <select name="type_service" id="type_service" class="inputselect">
      		<option value="">กรุณาเลือกประเภทบริการ</option>
		  <?php
$qusTec = @mysqli_query($conn, "SELECT * FROM  `s_group_service` WHERE  `group_ser_id` !=  '' ORDER BY `group_ser_id` ASC");
while ($rowTec = @mysqli_fetch_array($qusTec)) {
    ?>
                  <option value="<?php echo $rowTec['group_id']; ?>" <?php if ($type_service == $rowTec['group_id']) {echo 'selected';}?>><?php echo $rowTec['group_name']; ?></option>
                <?php
}
?>
      </select> ฟรี<br>
			3. จัดส่งสินค้าภายใน <input type="text" name="guaran2" value="<?php echo $guaran2; ?>" style="text-align: center;width: 50px;"> วัน หลังจากชำระมัดจำสินค้า <input type="text" name="guaran3" value="<?php echo $guaran3; ?>" style="text-align: center;width: 50px;">% จำนวน <?php echo number_format($guaran4, 2); ?> บาท<br>
			4. ลูกค้าเป็นผู้ตรียมระบบไฟฟ้า <select name="type_electric" id="type_electric" class="inputselect">
      <option value="no" <?php if ($type_electric == "no") {echo 'selected';}?>>ไม่เลือก</option>
      <option value="3 เฟส (380V.) เบรกเกอร์ 32A" <?php if ($type_electric == "3 เฟส (380V.) เบรกเกอร์ 32A") {echo 'selected';}?>>3 เฟส (380V.) เบรกเกอร์ 32A</option>
      <option value="3 เฟส (380V.) เบรกเกอร์ 80A" <?php if ($type_electric == "3 เฟส (380V.) เบรกเกอร์ 80A") {echo 'selected';}?>>3 เฟส (380V.) เบรกเกอร์ 80A</option>
      <option value="1 เฟส (220V.) เบรกเกอร์ 20A" <?php if ($type_electric == "1 เฟส (220V.) เบรกเกอร์ 20A") {echo 'selected';}?>>1 เฟส (220V.) เบรกเกอร์ 20A</option>
      <option value="1 เฟส (220V.) เบรกเกอร์ 30A" <?php if ($type_electric == "1 เฟส (220V.) เบรกเกอร์ 30A") {echo 'selected';}?>>1 เฟส (220V.) เบรกเกอร์ 30A</option>
      </select> ท่อน้ำดี ขนาด 6 หุน น้ำทิ้ง ขนาด 2 นิ้ว ระยะไม่เกิน 5 เมตร จากตำแหน่งติดตั้ง<br>
      5. กำหนดยืนราคา <input type="text" name="giveprice" value="<?php echo $giveprice; ?>" style="text-align: center;width: 50px;"> วัน<br>
        </p>
        </td>
      </tr>
    </table>
    <br>
    <table width="100%" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:left;padding-top:10px;padding-bottom:10px;">
        <strong>หมายเหตุอื่นๆ :</strong>
        <br>
        <textarea name="remark" id="remark" style="height:150px;"><?php echo strip_tags($remark); ?></textarea>
        </td>
      </tr>
    </table>
    <br>
  	<table width="100%" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
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
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>พนักงานขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <strong>เบอร์โทร <input type="text" name="tel_sell" value="<?php echo $tel_sell; ?>" style="text-align: center;width: 150px;"></strong>
                <br><br>
                <strong>วันที่ <input type="text" name="date_sell" style="text-align: center;" readonly value="<?php if ($date_sell == "") {echo date("d/m/Y");} else {echo $date_sell;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_sell'});</script></strong></td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <?php
$hsale = '';
if ($cs_hsell != "") {
    $hsale = $cs_hsell;
} else {
    $hsale = getNameSaleApprove($conn);
}
?>
                <strong ><input type="text" name="cs_hsell" value="<?php echo $hsale; ?>" id="cs_hsell" class="inpfoder" style="width:50%;text-align:center;border: none;"></strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้จัดการฝ่ายขาย</strong></td>
              </tr>
              <tr>
              <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
              <strong>เบอร์โทร <input type="text" name="tel_hsell" value="<?php echo $tel_hsell; ?>" style="text-align: center;width: 150px;"></strong>
                <br><br>
              <strong>วันที่ <input type="text" name="date_hsell" style="text-align: center;" readonly value="<?php if ($date_hsell == "") {echo date("d/m/Y");} else {echo $date_hsell;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_hsell'});</script></strong></td>
              </tr>
            </table>

        </td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong><input type="text" name="cs_account" value="<?php echo $cs_account; ?>" id="cs_account" class="inpfoder" style="width:50%;text-align:center;"></strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้อนุมัติสั่งซื้อสินค้า</strong></td>
              </tr>
              <tr>
              <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
              <strong>เบอร์โทร <input type="text" name="tel_account" value="<?php echo $tel_account; ?>" style="text-align: center;width: 150px;"></strong>
                <br><br>
              <strong>วันที่ <input type="text" name="date_account" style="text-align: center;" readonly value="<?php if ($date_account == "") {echo date("d/m/Y");} else {echo $date_account;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_account'});</script></strong></td>
              </tr>
            </table>
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
      <?php
$a_not_exists = array();
post_param($a_param, $a_not_exists);
?>
      <input name="mode" type="hidden" id="mode" value="<?php echo $_GET['mode']; ?>">
      <input name="status_use" type="hidden" id="status_use" value="<?php echo $status_use; ?>">
      <input name="quotation" type="hidden" id="quotation" value="<?php echo $quotation; ?>">
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

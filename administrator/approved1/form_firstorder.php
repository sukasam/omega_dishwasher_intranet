﻿<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

if ($_POST["cprice1"] != "") {$prpro1 = number_format($_POST["cprice1"], 2);}
if ($_POST["cprice2"] != "") {$prpro2 = number_format($_POST["cprice2"], 2);}
if ($_POST["cprice3"] != "") {$prpro3 = number_format($_POST["cprice3"], 2);}
if ($_POST["cprice4"] != "") {$prpro4 = number_format($_POST["cprice4"], 2);}
if ($_POST["cprice5"] != "") {$prpro5 = number_format($_POST["cprice5"], 2);}
if ($_POST["cprice6"] != "") {$prpro6 = number_format($_POST["cprice6"], 2);}
if ($_POST["cprice7"] != "") {$prpro7 = number_format($_POST["cprice7"], 2);}

$prspro1 = get_sprice($_POST["cprice1"], $_POST["camount1"]);
$prspro2 = get_sprice($_POST["cprice2"], $_POST["camount2"]);
$prspro3 = get_sprice($_POST["cprice3"], $_POST["camount3"]);
$prspro4 = get_sprice($_POST["cprice4"], $_POST["camount4"]);
$prspro5 = get_sprice($_POST["cprice5"], $_POST["camount5"]);
$prspro6 = get_sprice($_POST["cprice6"], $_POST["camount6"]);
$prspro7 = get_sprice($_POST["cprice7"], $_POST["camount7"]);

$vowels = array(",");

$sumprice = str_replace($vowels, "", $prspro1) + str_replace($vowels, "", $prspro2) + str_replace($vowels, "", $prspro3) + str_replace($vowels, "", $prspro4) + str_replace($vowels, "", $prspro5) + str_replace($vowels, "", $prspro6) + str_replace($vowels, "", $prspro7);
$sumpricevat = ($sumprice * 7) / 100;
$sumtotal = $sumprice + $sumpricevat;

if ($_POST['notvat1'] == 2) {
    $money_garuntree = $_POST['money_garuntree'] * 1.07;
} else {
    $money_garuntree = $_POST['money_garuntree'];
}

if ($_POST['notvat2'] == 2) {
    $money_setup = $_POST['money_setup'] * 1.07;
} else {
    $money_setup = $_POST['money_setup'];
}

// if($_REQUEST['notvat1'] == 2){$money_garuntree = $_REQUEST["money_garuntree"] + (($_REQUEST["money_garuntree"] * 7 ) / 100);}else{$money_garuntree = $_REQUEST["money_garuntree"];}
// if($_REQUEST['notvat2'] == 2){$money_setup = $_REQUEST["money_setup"]+ (($_REQUEST["money_setup"] * 7 ) / 100);}else{$money_setup = $_REQUEST["money_setup"];}

//break;
if ($_POST["loc_clean"] != "") {$loc_clean = $_POST["loc_clean"];} else { $loc_clean = " - ";}
if ($_POST["loc_clean_sn"] != "") {$loc_clean_sn = $_POST["loc_clean_sn"];} else { $loc_clean_sn = " - ";}
// if($_POST["warter01"] != ""){$warter01 = $_POST["warter01"];}else{$warter01 = " - ";}
// if($_POST["warter02"] != ""){$warter02 = $_POST["warter02"];}else{$warter02 = " - ";}
// if($_POST["warter03"] != ""){$warter03 = $_POST["warter03"];}else{$warter03 = " - ";}
// if($_POST["warter04"] != ""){$warter04 = $_POST["warter04"];}else{$warter04 = " - ";}
// if($_POST["warter05"] != ""){$warter05 = $_POST["warter05"];}else{$warter05 = " - ";}
// if($_POST["warter06"] != ""){$warter06 = $_POST["warter06"];}else{$warter06 = " - ";}
// if($_POST["warter07"] != ""){$warter07 = $_POST["warter07"];}else{$warter07 = " - ";}

$chkProcess = checkProcess($conn, $tbl_name, $PK_field, $id);

$saleSignature = '<img src="../../upload/user/signature/' . get_sale_signature($conn, $_POST['cs_sell']) . '" height="50" border="0" />';

if ($chkProcess == '5' || $chkProcess == '4') {

    $hSaleSignature = '<img src="../../upload/user/signature/' . get_hsale_signature($conn) . '" height="50" border="0" />';
    $hAccountSignature = '<img src="../../upload/user/signature/' . get_haccount_signature($conn) . '" height="50" border="0" />';
    $hCompanySignature = '<img src="../../upload/user/signature/' . get_hcompany_signature($conn) . '" height="50" border="0" />';

} else {

    if ($chkProcess == '0') {
        $hSaleSignature = '<img src="../../upload/user/signature/none.png" height="50" border="0" />';
        $hAccountSignature = '<img src="../../upload/user/signature/none.png" height="50" border="0" />';
        $hCompanySignature = '<img src="../../upload/user/signature/none.png" height="50" border="0" />';
    } else {

        $chkHSaleAP = checkHSaleApplove($conn, $tbl_name, $id);
        $chkHAccountAP = checkHAccountApplove($conn, $tbl_name, $id);
        $chkHCompanyAP = checkHCompanyApplove($conn, $tbl_name, $id);

        if ($chkHSaleAP == 1) {
            $hSaleSignature = '<img src="../../upload/user/signature/' . get_hsale_signature($conn) . '" height="50" border="0" />';
        } else {
            $hSaleSignature = '<img src="../../upload/user/signature/none.png" height="50" border="0" />';
        }

        if ($chkHAccountAP == 1) {
            $hAccountSignature = '<img src="../../upload/user/signature/' . get_haccount_signature($conn) . '" height="50" border="0" />';
        } else {
            $hAccountSignature = '<img src="../../upload/user/signature/none.png" height="50" border="0" />';
        }

        if ($chkHCompanyAP == 1) {
            $hCompanySignature = '<img src="../../upload/user/signature/' . get_hcompany_signature($conn) . '" height="50" border="0" />';
        } else {
            $hCompanySignature = '<img src="../../upload/user/signature/none.png" height="50" border="0" />';
        }
    }

}

$typegaruntreeTxt = '';

if ($_POST['typegaruntree'] == 2) {
    $typegaruntreeTxt = 'เงินค่าเช่าล่วงหน้า';
} else {
    $typegaruntreeTxt = 'เงินค่าประกัน';
}

$userCreate = getCreatePaper($conn,$tbl_name," AND `fo_id`=".$_POST['fo_id']);
$headerIMG = get_headerPaper($conn,"FO",$userCreate);

$form = '
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-bottom:5px;"><img src="'.$headerIMG.'" width="100%" border="0" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000000;">
          <tr>
            <td width="57%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> ' . $_POST["cd_name"] . ' ' . $_POST["cd_tax"] . '<strong><br />
              <br />
            ที่อยู่ :</strong> ' . $_POST["cd_address"] . '<br />
            <br />
            <strong>โทรศัพท์ :</strong> ' . $_POST["cd_tel"] . '<strong>&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> ' . $_POST["cd_fax"] . '<br /><br />
            <strong>ชื่อผู้ติดต่อ : </strong>' . $_POST["c_contact"] . '<strong>&nbsp;&nbsp;&nbsp;เบอร์โทร :</strong> ' . $_POST["c_tel"] . ' </td>
            <td width="43%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>กลุ่มลูกค้า : </strong> ' . get_groupcusname($conn, $_POST['cg_type']) . '&nbsp;&nbsp;&nbsp;&nbsp;<strong>ประเภทลูกค้า : </strong>' . custype_name($conn, $_POST["ctype"]) . '<strong><br />
              <br />
            ประเภทสินค้า :</strong> ' . protype_name($conn, $_POST["pro_type"]) . '<br />
            <br />
            <strong>เลขที่ใบเสนอราคา / PO.NO. : </strong>' . $_POST["po_id"] . '<br />
            <br />
            <strong>เลขที่ First order :</strong>' . $_POST["fs_id"] . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;วันที่ :</strong> ' . format_date($_POST["date_forder"]) . '
			<br /><br />
            <strong>รหัสลูกค้า : </strong>' . $_POST["cusid"] . '
			</td>
          </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2" style="border:1px solid #000000;margin-top: 10px;">
          <tr>
            <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>สถานที่ติดตั้ง :</strong> ' . $_POST["loc_name"] . '<br />
            <br />              <strong>ที่อยู่ :</strong> ' . $_POST["loc_address"] . '<strong><br />
            <br />
            ขนส่งโดย :</strong> ' . $_POST["loc_shopping"] . '</td>
            <td style="vertical-align:top;font-size:10px;padding:5px;">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:none;font-size:10px;font-family:Verdana, Geneva, sans-serif;">
				  <tr>
					<td width="60%"><strong>เครื่องป้อนน้ำยา :</strong> ' . $loc_clean . '</td>
					<td width="40%"><strong>SN :</strong> ' . $loc_clean_sn . '</td>
				  </tr>';
if(!empty($_POST["warter01"])){
$form .= '<tr>
            <td colspan="2"><strong>รายการน้ำยา</strong></td>
          </tr>';
$form .= '<tr>
            <td colspan="2">01. '.get_product_name($conn, $_POST["warter01"]).'</td>
          </tr>';
  if(!empty($_POST["warter02"])){
  $form .= '<tr>
              <td colspan="2">02. '.get_product_name($conn, $_POST["warter02"]).'</td>
            </tr>';
  }
  if(!empty($_POST["warter03"])){
  $form .= '<tr>
              <td colspan="2">03. '.get_product_name($conn, $_POST["warter03"]).'</td>
            </tr>';
  }
  if(!empty($_POST["warter04"])){
  $form .= '<tr>
              <td colspan="2">04. '.get_product_name($conn, $_POST["warter04"]).'</td>
            </tr>';
  }
  if(!empty($_POST["warter05"])){
  $form .= '<tr>
              <td colspan="2">05. '.get_product_name($conn, $_POST["warter05"]).'</td>
            </tr>';
  }
}
$form .= '</table>
            </td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:10px;text-align:center;margin-top: 10px;">
    <tr>
      <td width="5%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="35%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>S/N</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="15%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา / หน่วย</strong></td>
      <td width="15%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคารวม (บาท)</strong></td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;">1</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">' . get_proname($conn, $_POST["cpro1"]) . ' ' . get_prodetail($conn, $_POST["cpro1"]) . '</td>
      <td style="border:1px solid #000000;padding:5;width:100px;">' . $_POST["pro_pod1"] . '</td>
      <td style="border:1px solid #000000;padding:5;">' . $_POST["pro_sn1"] . '</td>
      <td style="border:1px solid #000000;padding:5;">' . $_POST["camount1"] . '</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . $prpro1 . '&nbsp;&nbsp;</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . $prspro1 . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;">2</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">' . get_proname($conn, $_POST["cpro2"]) . ' ' . get_prodetail($conn, $_POST["cpro2"]) . '</td>
      <td style="border:1px solid #000000;padding:5;width:100px;">' . $_POST["pro_pod2"] . '</td>
      <td style="border:1px solid #000000;padding:5;">' . $_POST["pro_sn2"] . '</td>
      <td style="border:1px solid #000000;padding:5;">' . $_POST["camount2"] . '</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . $prpro2 . '&nbsp;&nbsp;</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . $prspro2 . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;">3</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">' . get_proname($conn, $_POST["cpro3"]) . ' ' . get_prodetail($conn, $_POST["cpro3"]) . '</td>
      <td style="border:1px solid #000000;padding:5;width:100px;">' . $_POST["pro_pod3"] . '</td>
      <td style="border:1px solid #000000;padding:5;">' . $_POST["pro_sn3"] . '</td>
      <td style="border:1px solid #000000;padding:5;">' . $_POST["camount3"] . '</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . $prpro3 . '&nbsp;&nbsp;</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . $prspro3 . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;">4</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">' . get_proname($conn, $_POST["cpro4"]) . ' ' . get_prodetail($conn, $_POST["cpro4"]) . '</td>
      <td style="border:1px solid #000000;padding:5;width:100px;">' . $_POST["pro_pod4"] . '</td>
      <td style="border:1px solid #000000;padding:5;">' . $_POST["pro_sn4"] . '</td>
      <td style="border:1px solid #000000;padding:5;">' . $_POST["camount4"] . '</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . $prpro4 . '&nbsp;&nbsp;</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . $prspro4 . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;">5</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">' . get_proname($conn, $_POST["cpro5"]) . ' ' . get_prodetail($conn, $_POST["cpro5"]) . '</td>
      <td style="border:1px solid #000000;padding:5;width:100px;">' . $_POST["pro_pod5"] . '</td>
      <td style="border:1px solid #000000;padding:5;">' . $_POST["pro_sn5"] . '</td>
      <td style="border:1px solid #000000;padding:5;">' . $_POST["camount5"] . '</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . $prpro5 . '&nbsp;&nbsp;</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . $prspro5 . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;">6</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">' . get_proname($conn, $_POST["cpro6"]) . ' ' . get_prodetail($conn, $_POST["cpro6"]) . '</td>
      <td style="border:1px solid #000000;padding:5;width:100px;">' . $_POST["pro_pod6"] . '</td>
      <td style="border:1px solid #000000;padding:5;">' . $_POST["pro_sn6"] . '</td>
      <td style="border:1px solid #000000;padding:5;">' . $_POST["camount6"] . '</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . $prpro6 . '&nbsp;&nbsp;</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . $prspro6 . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;">7</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">' . get_proname($conn, $_POST["cpro7"]) . ' ' . get_prodetail($conn, $_POST["cpro7"]) . '</td>
      <td style="border:1px solid #000000;padding:5;width:100px;">' . $_POST["pro_pod7"] . '</td>
      <td style="border:1px solid #000000;padding:5;">' . $_POST["pro_sn7"] . '</td>
      <td style="border:1px solid #000000;padding:5;">' . $_POST["camount7"] . '</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . $prpro7 . '&nbsp;&nbsp;</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . $prspro7 . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5" rowspan="3" style="text-align:left;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;"><strong>หมายเหตุ :</strong> ' . nl2br($_POST['ccomment']) . '<br>
</td>
      <td style="border:1px solid #000000;padding:5;"><strong>รวมทั้งหมด</strong></td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . number_format($sumprice, 2) . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;"><strong>VAT 7 %</strong></td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . number_format($sumpricevat, 2) . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;"><strong>ราคารวมทั้งสิ้น</strong></td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">' . number_format($sumtotal, 2) . '&nbsp;&nbsp;</td>
    </tr>
</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px;">
          <tr>
            <td style="border:0;padding:0;width:60%;vertical-align:top;">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <th width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></th>
                  <th width="75%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการแถม</strong></th>
                  <th width="15%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></th>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">1</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;">' . $_POST["cs_pro1"] . '</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">' . $_POST["cs_amount1"] . '</td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">2</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;">' . $_POST["cs_pro2"] . '</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">' . $_POST["cs_amount2"] . '</td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">3</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;">' . $_POST["cs_pro3"] . '</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">' . $_POST["cs_amount3"] . '</td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">4</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;">' . $_POST["cs_pro4"] . '</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">' . $_POST["cs_amount4"] . '</td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">5</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;">' . $_POST["cs_pro5"] . '</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">' . $_POST["cs_amount5"] . '</td>
              </tr>
            </table></td>
            <td style="border:0;padding:0;width:40%;vertical-align:top;padding-left:5px;font-size:10px;border:1px solid #000000;padding-top:10px;">';

//if($_POST['ctype'] != 1){
$form .= '<strong>เลขที่สัญญา : </strong> ' . $_POST["r_id"] . '<br><br />';
if (($_POST["date_quf"] == date("Y-m-d")) && ($_POST["date_qut"] == date("Y-m-d"))) {
    $form .= '<strong>วันเริ่มสัญญา : </strong> - <strong>&nbsp;สิ้นสุดสัญญา : </strong> - <br><br>';
} else {
    $form .= '<strong>วันเริ่มสัญญา : </strong>' . format_date($_POST["date_quf"]) . ' <strong>&nbsp;สิ้นสุดสัญญา : </strong>' . format_date($_POST["date_qut"]) . '
			  <br><br>';
}

//}

if ($_POST["cs_sign"] != "") {
    $form .= '<div id="cssign"><strong>ผู้มีอำนาจเซ็นสัญญา : </strong>
              	  ' . $_POST["cs_sign"] . '
              <br><br></div>';
}
$form .= '
              <strong>เงื่อนไขการชำระเงิน :</strong> ' . nl2br($_POST["qucomment"]) . '
		   </td>
          </tr>
</table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px;">
    <tr>
      <td width="50%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:6px;"><strong>บุคคลติดต่อทางด้านการเงิน : ' . $_POST["cs_contact"] . '</strong></td>
      <td width="50%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:6px;"> <strong>โทรศัพท์ : </strong>' . $_POST["cs_tel"] . '</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:6px;"><strong>วันที่ส่งสินค้า : ' . format_date($_POST["cs_ship"]) . '</strong></td>
      <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:6px;"><strong>วันที่ติดตั้งเครื่อง : ' . format_date($_POST["cs_setting"]) . '</strong></td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:6px;"><strong>' . $typegaruntreeTxt . ' : ' . number_format($money_garuntree, 2) . '</strong></td>
      <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:6px;"><strong>ค่าขนส่งและติดตั้ง : ' . number_format($money_setup, 2) . '</strong></td>
    </tr>
  </table>
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;margin-top: 10px;">
      <tr>
        <td width="25%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">' . $saleSignature . '</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >( ' . getsalename($conn, $_POST["cs_sell"]) . ' )</strong><br><br><strong>พนักงานขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............</strong></td>
              </tr>
            </table>

        </td>
        <td width="25%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">' . $hSaleSignature . '</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>( ' . $_POST["cs_hsell"] . ' )</strong><br><br><strong>ผู้อนุมัติการขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............</strong></td>
              </tr>
            </table>
        </td>
        <td width="25%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">' . $hAccountSignature . '</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>( ' . $_POST["cs_account"] . ' )</strong><br><br><strong>ฝ่ายบัญชีการเงิน</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............</strong></td>


              </tr>
            </table>
        </td>
        <td width="25%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">' . $hCompanySignature . '</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>( ' . $_POST["cs_aceep"] . ' )</strong><br><br><strong>ผู้มีอำนาจลงนาม</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............</strong></td>


              </tr>
            </table>
        </td>
      </tr>
    </table>
  ';

//<table width="100%" border="0" cellspacing="0" cellpadding="0">
//      <tr>
//        <td style="padding-bottom:5px;"><img src="../images/form/header-first-order.png" width="100%" border="0" /></td>
//      </tr>
//    </table>
//
//<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000000;">
//          <tr>
//            <td width="57%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> '.$_POST["cd_name"].'<strong><br />
//              <br />
//            ที่อยู่ :</strong> '.$_POST["cd_address"].'&nbsp;'.province_name($conn,$_POST["cd_province"]).'<br />
//            <br />
//            <strong>โทรศัพท์ :</strong> '.$_POST["cd_tel"].'<strong>&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> '.$_POST["cd_fax"].'<br /><br />
//            <strong>ชื่อผู้ติดต่อ : </strong>'.$_POST["c_contact"].'<strong>&nbsp;&nbsp;&nbsp;เบอร์โทร :</strong> '.$_POST["c_tel"].' </td>
//            <td width="43%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>กลุ่มลูกค้า : </strong> '.get_groupcusname($conn,$_POST['cg_type']).'&nbsp;&nbsp;&nbsp;&nbsp;<strong>ประเภทลูกค้า : </strong>'.custype_name($conn,$_POST["ctype"]).'<strong><br />
//              <br />
//            สินค้า :</strong> '.protype_name($conn,$_POST["pro_type"]).'<br />
//            <br />
//            <strong>เลขที่ใบเสนอราคา / PO.NO. : </strong>'.$_POST["po_id"].'<br />
//            <br />            <strong>เลขที่ First order :</strong><strong> </strong>'.$_POST["fs_id"].'<strong>&nbsp;&nbsp;&nbsp;&nbsp;วันที่ :</strong> '.format_date($_POST["date_forder"]).'<strong></td>
//          </tr>
//</table>

if ($_POST['remark'] != "") {
    $form .= '

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:15px;"><strong>หมายเหตุอื่นๆ : </strong>' . $_POST["remark"] . '</td>
          </tr>
</table>';
}
;
?>

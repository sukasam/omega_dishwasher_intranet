<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

if ($_POST["cprice1"] != "") {$prpro1 = number_format($_POST["cprice1"]);}
if ($_POST["cprice2"] != "") {$prpro2 = number_format($_POST["cprice2"]);}
if ($_POST["cprice3"] != "") {$prpro3 = number_format($_POST["cprice3"]);}
if ($_POST["cprice4"] != "") {$prpro4 = number_format($_POST["cprice4"]);}
if ($_POST["cprice5"] != "") {$prpro5 = number_format($_POST["cprice5"]);}
if ($_POST["cprice6"] != "") {$prpro6 = number_format($_POST["cprice6"]);}
if ($_POST["cprice7"] != "") {$prpro7 = number_format($_POST["cprice7"]);}

if ($_POST["pro_pod1"] != "") {$pro_pod1 = " (รุ่น " . $_POST["pro_pod1"] . ")";}
if ($_POST["pro_pod2"] != "") {$pro_pod2 = " (รุ่น " . $_POST["pro_pod2"] . ")";}
if ($_POST["pro_pod3"] != "") {$pro_pod3 = " (รุ่น " . $_POST["pro_pod3"] . ")";}
if ($_POST["pro_pod4"] != "") {$pro_pod4 = " (รุ่น " . $_POST["pro_pod4"] . ")";}
if ($_POST["pro_pod5"] != "") {$pro_pod5 = " (รุ่น " . $_POST["pro_pod5"] . ")";}
if ($_POST["pro_pod6"] != "") {$pro_pod6 = " (รุ่น " . $_POST["pro_pod6"] . ")";}
if ($_POST["pro_pod7"] != "") {$pro_pod7 = " (รุ่น " . $_POST["pro_pod7"] . ")";}

if ($_POST["cs_pro1"] != "") {$profree1 = "1";} else { $profree1 = "&nbsp;";}
if ($_POST["cs_pro2"] != "") {$profree2 = "2";} else { $profree2 = "&nbsp;";}
if ($_POST["cs_pro3"] != "") {$profree3 = "3";} else { $profree3 = "&nbsp;";}
if ($_POST["cs_pro4"] != "") {$profree4 = "4";} else { $profree4 = "&nbsp;";}
if ($_POST["cs_pro5"] != "") {$profree5 = "5";} else { $profree5 = "&nbsp;";}

if ($_POST["cpro1"] != "") {$cpro1 = "1";} else { $cpro1 = "&nbsp;";}
if ($_POST["cpro2"] != "") {$cpro2 = "2";} else { $cpro2 = "&nbsp;";}
if ($_POST["cpro3"] != "") {$cpro3 = "3";} else { $cpro3 = "&nbsp;";}
if ($_POST["cpro4"] != "") {$cpro4 = "4";} else { $cpro4 = "&nbsp;";}
if ($_POST["cpro5"] != "") {$cpro5 = "5";} else { $cpro5 = "&nbsp;";}
if ($_POST["cpro6"] != "") {$cpro6 = "6";} else { $cpro6 = "&nbsp;";}
if ($_POST["cpro7"] != "") {$cpro7 = "7";} else { $cpro7 = "&nbsp;";}

if ($_POST["type_service"] == '2') {
    $typeS = "เครื่องล้างแก้ว";
} else if ($_POST["type_service"] == '3') {
    $typeS = "เครื่องผลิตน้ำแข็ง";
} else {
    $typeS = "เครื่องล้างจาน";
}

$userCreate = getCreatePaper($conn, $tbl_name, " AND `order_id`= " . $_POST['order_id']);
$headerIMG = get_headerPaper($conn, "RP", $userCreate);

$userSignature = '<img src="../../upload/user/signature/'.get_user_signature($conn,$_POST['who_sale']).'" height="50" border="0" />';
$technicianSignature = '<img src="../../upload/user/signature/'.get_technician_signature($conn,$_POST['cs_technic']).'" height="50" border="0" />';

if(!empty($_POST['signature'])){
  $cusSignature = '<img src="../../upload/customer/signature/'.base64_encode($_POST['fs_id']).'.png" height="50" border="0" />';
  $cusSignatureDate = format_date(substr($_POST['signature_date'],0,10));
}else{
  $cusSignature ='';
  $cusSignatureDate = '';
}

$form = '
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-bottom:5px;"><img src="'.$headerIMG.'" width="100%" border="0" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #003399;">
          <tr>
            <td width="57%" valign="top" style="font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;"><strong>ชื่อลูกค้า :</strong> ' . $_POST["cd_name"] . '<strong><br />
              <br />
            ที่อยู่ :</strong> ' . $_POST["ship_address"] . '<br />
            <br />
            <strong>โทรศัพท์ :</strong> ' . $_POST["cd_tel"] . '<strong>&nbsp;&nbsp;&nbsp; แฟกซ์ :</strong> ' . $_POST["cd_fax"] . '<br /><br />
            <strong>ชื่อผู้ติดต่อ : </strong>' . $_POST["c_contact"] . '<strong>&nbsp;&nbsp;&nbsp;เบอร์โทร :</strong> ' . $_POST["c_tel"] . '
            </td>
            <td width="43%" valign="top" style="font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">
            <strong>วันที่รับคืนสินค้า : </strong> ' . format_date($_POST["date_forder"]) . '<br /><br />
            <strong>เลขที่ใบรับคืนสินค้า : </strong>' . $_POST["fs_id"] . '<br /><br />
            <strong>สถานที่รับคืนสินค้า : </strong>' . $_POST["ship_name"] . '<br /><br />
            <strong>พนักงานขาย : </strong>' . $_POST["cs_sell"] . '
			</td>
          </tr>
</table>
  <p style="font-size:12px;"><strong>ทางบริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด ขอรับคืนสินค้า โดยมีรายละเอียดดังนี้</strong></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:11px;text-align:center;">
    <tr>
      <td width="5%" style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="10%" style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รหัส</strong></td>
      <td width="10%" style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>SN</strong></td>
      <td width="30%" style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="10%" style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="10%" style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>หน่วย</strong></td>
    </tr>';

$nrow = 1;
$sumTotal = 0;
$sumpricevat = 0;
$sumtotals = 0;
$sumprice = 0;

$vowels = array(",");

foreach($_POST['chkOrder'] as $a => $b){
  if(!empty($_POST['chkCode'][$b])){
        // $_POST['chkPrice'][$b] = str_replace($vowels, "", $_POST['chkPrice'][$b]);
        $form .= '<tr>
          <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
          ' . $nrow . '
          </td>
          <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
          ' . $_POST['chkSproid'][$b] . '
          </td>
          <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
          ' . $_POST['chkSn'][$b] . '
          </td>
          <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:left;">
          ' . get_proname($conn, $_POST['chkCode'][$b]) . ' ' . get_prodetail($conn, $_POST['chkCode'][$b]) . '
          </td>
          <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
          ' . number_format($_POST['chkAmount'][$b]) . '
          </td>
          <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
          ' . get_pronamecall($conn, $_POST['chkCode'][$b]) . '
          </td>
        </tr>';
        // $sumprice =  $sumprice + ($_POST['chkAmount'][$a]*$_POST['chkPrice'][$a]);
        // $sumpricevat = ($sumprice * 7) / 100;
        // $sumtotals = $sumprice + $sumpricevat;
        $nrow++;
    }
}

$csPro = array('cs_pro1','cs_pro2','cs_pro3','cs_pro4','cs_pro5');
$csAmount = array('cs_amount1','cs_amount2','cs_amount3','cs_amount4','cs_amount5');
$csNameCall = array('cs_namecall1','cs_namecall2','cs_namecall3','cs_namecall4','cs_namecall5');

for($i=1;$i<=count($csPro);$i++){
  if($csPro[$i-1] !== ''){
    $form .= '<tr>
              <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
             '.($nrow).'
              </td>
              <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
              &nbsp;&nbsp;
              </td>
              <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
              &nbsp;&nbsp;
              </td>
              <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:left;">
              '.$_POST[$csPro[$i-1]].'
              </td>
              <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
              '.$_POST[$csAmount[$i-1]].'
              </td>
              <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
              '.$_POST[$csNameCall[$i-1]].'
              </td>
            </tr>';
            $nrow++;
  }
}

// if ($nrow <= 8) {
//     for ($i = $nrow; $i <= 8; $i++) {
//         $form .= '<tr>
//           <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
//           &nbsp;&nbsp;
//           </td>
//           <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
//           &nbsp;&nbsp;
//           </td>
//           <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:left;">
//           &nbsp;&nbsp;
//           </td>
//           <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
//           &nbsp;&nbsp;
//           </td>
//           <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
//           &nbsp;&nbsp;
//           </td>
//         </tr>';
//     }
// }



// $form .='<tr>
//   <td colspan="3" style="border:0px solid #003399;padding:9px 5px;"></td>
//   <td style="border:1px solid #003399;padding:9px 5px;"><strong>รวมทั้งหมด</strong></td>
//   <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.number_format($sumprice,2).'&nbsp;&nbsp;</td>
// </tr>
// <tr>
//   <td colspan="3" style="border:0px solid #003399;padding:9px 5px;"></td>
//   <td style="border:1px solid #003399;padding:9px 5px;"><strong>VAT 7 %</strong></td>
//   <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.number_format($sumpricevat,2).'&nbsp;&nbsp;</td>
// </tr>
// <tr>
//   <td colspan="3" style="text-align:center;border:0px solid #003399;padding:9px 5px;background-color: #ddebf7;"><strong>'.baht_text($sumtotals).'</strong></td>
//   <td style="border:1px solid #003399;padding:9px 5px;"><strong>ราคารวมทั้งสิ้น</strong></td>
//   <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.number_format($sumtotals,2).'&nbsp;&nbsp;</td>
// </tr>';

$form .= '</table><br>';

// $form .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1" >
//     <tr>
//       <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:15px;"><strong>หมายเหตุ : </strong>' . $_POST["remark"] . '</td>
//     </tr>
//   </table>';

$form .='<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1" >
          <tr>
          <td style="border:0px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:15px;text-align:right;"><p style="font-size:12px;"><strong>ในนาม บริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด</strong></p></td>
          </tr>
        </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">

<tr>
<td width="40%" style="border:0px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;"></td>
<td width="20%" style="border:0px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;"></td>
<td width="40%" style="border:0px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1" >
      <tr>
        <td style="border:0px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-bottom:10px;"><p style="font-size:12px;">'.$userSignature.'</p></td>
      </tr>
      <tr>
        <td style="border-top:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-bottom:10px;"></td>
      </tr>
      <tr>
        <td style="border:0px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-bottom:10px;"><p style="font-size:12px;">'.get_username($conn,$_POST['who_sale']).'</p></td>
      </tr>
      <tr>
        <td style="border:0px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-bottom:10px;"><p style="font-size:12px;"><strong>ผู้จัดทำ</strong></p></td>
      </tr>
      <tr>
        <td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
        <strong>วันที่ '.format_date($_POST["date_forder"]).'</strong></td>
      </tr>
    </table>
  </td>
  </tr>
  </table>
</td>
</tr>
<tr>
<td></td>
<td></td>
<td><br><br><br><br></td>
</tr>
<tr>
<td width="40%" style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="border:0px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-bottom:10px;"><p style="font-size:12px;">'.$cusSignature.'</p></td>
  </tr>
  <tr>
    <td style="border-top:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-bottom:10px;"></td>
  </tr>
  <tr>
    <td style="border:0px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-bottom:10px;"><p style="font-size:12px;">'.$_POST['cd_name'].'</p></td>
  </tr>
  <tr>
    <td style="border:0px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-bottom:10px;"><p style="font-size:12px;"><strong>ผู้ส่งคืนสินค้า</strong></p></td>
  </tr>
  <tr>
  <td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
    <strong>วันที่ '.$cusSignatureDate.'</strong></td>
  </tr>
  </table>

</td>
<td width="20%" style="border:0px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">

</td>
<td width="40%" style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="border:0px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-bottom:10px;"><p style="font-size:12px;">'.$technicianSignature.'</p></td>
  </tr>
  <tr>
    <td style="border-top:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-bottom:10px;"></td>
  </tr>
  <tr>
    <td style="border:0px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-bottom:10px;"><p style="font-size:12px;">'.get_technician_name($conn,$_POST['cs_technic']).'</p></td>
  </tr>
  <tr>
    <td style="border:0px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-bottom:10px;"><p style="font-size:12px;"><strong>ผู้รับคืนสินค้า</strong></p></td>
  </tr>
  <tr>
  <td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
    <strong>วันที่ '.format_date($_POST["date_forder"]).'</strong></td>
  </tr>
  </table>
</td>
</tr>
</table>
';
?>

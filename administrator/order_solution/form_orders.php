<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

if($_POST["cprice1"] != ""){$prpro1 = number_format($_POST["cprice1"]);}
if($_POST["cprice2"] != ""){$prpro2 = number_format($_POST["cprice2"]);}
if($_POST["cprice3"] != ""){$prpro3 = number_format($_POST["cprice3"]);}
if($_POST["cprice4"] != ""){$prpro4 = number_format($_POST["cprice4"]);}
if($_POST["cprice5"] != ""){$prpro5 = number_format($_POST["cprice5"]);}
if($_POST["cprice6"] != ""){$prpro6 = number_format($_POST["cprice6"]);}
if($_POST["cprice7"] != ""){$prpro7 = number_format($_POST["cprice7"]);}


if($_POST["pro_pod1"] != ""){$pro_pod1 = " (รุ่น ".$_POST["pro_pod1"].")";}
if($_POST["pro_pod2"] != ""){$pro_pod2 = " (รุ่น ".$_POST["pro_pod2"].")";}
if($_POST["pro_pod3"] != ""){$pro_pod3 = " (รุ่น ".$_POST["pro_pod3"].")";}
if($_POST["pro_pod4"] != ""){$pro_pod4 = " (รุ่น ".$_POST["pro_pod4"].")";}
if($_POST["pro_pod5"] != ""){$pro_pod5 = " (รุ่น ".$_POST["pro_pod5"].")";}
if($_POST["pro_pod6"] != ""){$pro_pod6 = " (รุ่น ".$_POST["pro_pod6"].")";}
if($_POST["pro_pod7"] != ""){$pro_pod7 = " (รุ่น ".$_POST["pro_pod7"].")";}


if($_POST["cs_pro1"] != ""){$profree1 = "1";}else{$profree1 = "&nbsp;";}
if($_POST["cs_pro2"] != ""){$profree2 = "2";}else{$profree2 = "&nbsp;";}
if($_POST["cs_pro3"] != ""){$profree3 = "3";}else{$profree3 = "&nbsp;";}
if($_POST["cs_pro4"] != ""){$profree4 = "4";}else{$profree4 = "&nbsp;";}
if($_POST["cs_pro5"] != ""){$profree5 = "5";}else{$profree5 = "&nbsp;";}

if($_POST["cpro1"] != ""){$cpro1 = "1";}else{$cpro1 = "&nbsp;";}
if($_POST["cpro2"] != ""){$cpro2 = "2";}else{$cpro2 = "&nbsp;";}
if($_POST["cpro3"] != ""){$cpro3 = "3";}else{$cpro3 = "&nbsp;";}
if($_POST["cpro4"] != ""){$cpro4 = "4";}else{$cpro4 = "&nbsp;";}
if($_POST["cpro5"] != ""){$cpro5 = "5";}else{$cpro5 = "&nbsp;";}
if($_POST["cpro6"] != ""){$cpro6 = "6";}else{$cpro6 = "&nbsp;";}
if($_POST["cpro7"] != ""){$cpro7 = "7";}else{$cpro7 = "&nbsp;";}


if($_POST["type_service"] == '2'){
	$typeS = "เครื่องล้างแก้ว";
}else if($_POST["type_service"] == '3'){
	$typeS = "เครื่องผลิตน้ำแข็ง";
}else{
	$typeS = "เครื่องล้างจาน";
}


$form = '
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-bottom:5px;"><img src="../images/form/header-order_solution.jpg" width="100%" border="0" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #003399;">
          <tr>
            <td width="57%" valign="top" style="font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;"><strong>ชื่อลูกค้า :</strong> '.$_POST["cd_name"].'<strong><br />
              <br />
            ที่อยู่ :</strong> '.$_POST["cd_address"].'<br />
            <br />
            <strong>โทรศัพท์ :</strong> '.$_POST["cd_tel"].'<strong>&nbsp;&nbsp;&nbsp; แฟกซ์ :</strong> '.$_POST["cd_fax"].'<br /><br />
            <strong>ชื่อผู้ติดต่อ : </strong>'.$_POST["c_contact"].'<strong>&nbsp;&nbsp;&nbsp;เบอร์โทร :</strong> '.$_POST["c_tel"].' 
            </td>
            <td width="43%" valign="top" style="font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">
            <strong>วันที่สั่งซื้อ : </strong> '.format_date($_POST["date_forder"]).'&nbsp;&nbsp;&nbsp;<strong>ประเภทลูกค้า :</strong> '.custype_name($conn,$_POST['type_service']).'<br /><br />
            <strong>เลขที่ใบสั่งน้ำยา : </strong>'.$_POST["fs_id"].'&nbsp;&nbsp;<strong>เลขที่ PO : </strong>'.$_POST["po_id"].'<br /><br />
            <strong>สถานที่จัดส่ง : </strong>'.$_POST["ship_name"].'<br /><br />
            <strong>ที่อยู่ : </strong>'.$_POST["ship_address"].'
			</td>
          </tr>
</table>
  <p style="font-size:12px;"><strong>ทางบริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด มีความยินดีขอเสนอราคาน้ำยาให้พิจารณา ดังนี้</strong></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:11px;text-align:center;">
    <tr>
      <td width="5%" style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="10%" style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รหัส</strong></td>
      <td width="40%" style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="10%" style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
    </tr>';

    $nrow = 1;
    $sumTotal = 0;
    $sumpricevat = 0;
    $sumtotals = 0;
    $sumprice = 0;

    $vowels = array(",");

    foreach($_POST['chkCode'] as $a => $b){
      if($_POST['chkAmount'][$a] != "" && $_POST['chkPrice'][$a] != ""){
        $_POST['chkPrice'][$a] = str_replace($vowels,"",$_POST['chkPrice'][$a]);
        $form .='<tr>
          <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
          '.$nrow.'
          </td>
          <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
          '.$_POST['chkSproid'][$a].'
          </td>
          <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:left;">
          '.get_proname($conn,$_POST['chkCode'][$a]).' '.get_prodetail($conn,$_POST['chkCode'][$a]).'
          </td>
          <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
          '.number_format($_POST['chkAmount'][$a]).'
          </td>
        </tr>';
        // $sumprice =  $sumprice + ($_POST['chkAmount'][$a]*$_POST['chkPrice'][$a]);
        // $sumpricevat = ($sumprice * 7) / 100;
        // $sumtotals = $sumprice + $sumpricevat;
        $nrow++;
      }
    }

    if($nrow <= 10){
      for($i=$nrow;$i<=10;$i++){
        $form .='<tr>
          <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
          &nbsp;&nbsp;
          </td>
          <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
          &nbsp;&nbsp;
          </td>
          <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:left;">
          &nbsp;&nbsp;
          </td>
          <td style="border:1px solid #003399;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
          &nbsp;&nbsp;
          </td>
        </tr>';
      }
    }

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

    $form .='</table><br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1" >
    <tr>
      <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:15px;"><strong>หมายเหตุ : </strong>'.$_POST["remark"].'</td>
    </tr>
  </table>';
  
  /*$form .='<p style="font-size:12px;"><strong><u>เงื่อนไขการขาย</u></strong></p>
  <p style="font-size:12px;">1. <strong ><u>การชำระเงิน</u></strong> ชำระเงินสด นับจากวันที่ส่งมอบสินค้า<br>
  2. กำหนดยืนราคา '.$_POST['giveprice'].' วัน</p>
  <p style="font-size:12px;"><strong>** รับประกันอะไหล่ '.$_POST['guaran'].' เดือน **</strong></p>
  <p style="font-size:12px;">จึงเรียนมาเพื่อโปรดพิจารณา และทางบริษัท ฯ หวังเป็นอย่างยิ่งว่าจะได้รับการพิจารณาจากท่าน</p><br>
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #003399;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><br><br><br></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>อนุมัติสั่งซื้อสินค้าตามรายการข้างต้น</strong></td>
              </tr>
              <tr>
                <td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <br><br><strong>วันที่ __________________________</strong></td>
              </tr>
            </table>

        </td>
        <td width="33%" style="border:0px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	
        </td>
        <td width="33%" style="border:0px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:0px solid #003399;padding-bottom:10px;font-size:13px;font-family:Verdana, Geneva, sans-serif;text-align:center;">ขอแสดงความนับถือ</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><img src="../../upload/user/signature/'.get_technician_signature($conn,$_POST['cs_technic']).'" width="130" border="0" /></td>
              </tr>
              <tr>
              <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
              <strong>('.get_technician_name($conn,$_POST['cs_technic']).')</strong>
			  </td>
              </tr>
            </table>
        </td>
      </tr>
    </table>
  ';*/
?>

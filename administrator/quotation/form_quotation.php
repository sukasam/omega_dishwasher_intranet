<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

if($_POST["cprice1"] != ""){$prpro1 = number_format($_POST["cprice1"],2);}
if($_POST["cprice2"] != ""){$prpro2 = number_format($_POST["cprice2"],2);}
if($_POST["cprice3"] != ""){$prpro3 = number_format($_POST["cprice3"],2);}
if($_POST["cprice4"] != ""){$prpro4 = number_format($_POST["cprice4"],2);}
if($_POST["cprice5"] != ""){$prpro5 = number_format($_POST["cprice5"],2);}
if($_POST["cprice6"] != ""){$prpro6 = number_format($_POST["cprice6"],2);}
if($_POST["cprice7"] != ""){$prpro7 = number_format($_POST["cprice7"],2);}



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


if($_REQUEST['notvat1'] == 2){$money_garuntree = $_REQUEST["money_garuntree"] + (($_REQUEST["money_garuntree"] * 7 ) / 100);}else{$money_garuntree = $_REQUEST["money_garuntree"];}
if($_REQUEST['notvat2'] == 2){$money_setup = $_REQUEST["money_setup"]+ (($_REQUEST["money_setup"] * 7 ) / 100);}else{$money_setup = $_REQUEST["money_setup"];}

//break;
if($_POST["loc_clean"] != ""){$loc_clean = $_POST["loc_clean"];}else{$loc_clean = " - ";}
if($_POST["loc_clean_sn"] != ""){$loc_clean_sn = $_POST["loc_clean_sn"];}else{$loc_clean_sn = " - ";}
if($_POST["warter01"] != ""){$warter01 = number_format($_POST["warter01"]);}else{$warter01 = " - ";}
if($_POST["warter02"] != ""){$warter02 = number_format($_POST["warter02"]);}else{$warter02 = " - ";}
if($_POST["warter03"] != ""){$warter03 = number_format($_POST["warter03"]);}else{$warter03 = " - ";}
if($_POST["warter04"] != ""){$warter04 = number_format($_POST["warter04"]);}else{$warter04 = " - ";}
if($_POST["warter05"] != ""){$warter05 = number_format($_POST["warter05"]);}else{$warter05 = " - ";}
if($_POST["warter06"] != ""){$warter06 = number_format($_POST["warter06"]);}else{$warter06 = " - ";}
if($_POST["warter07"] != ""){$warter07 = number_format($_POST["warter07"]);}else{$warter07 = " - ";}

if($_POST['type_service'] == 6){
  $checkService = 1;
}else if($_POST['type_service'] == 1 || $_POST['type_service'] == 31){
  $checkService = 2;
}else if($_POST['type_service'] == 2){
  $checkService = 3;
}else if($_POST['type_service'] == 3){
  $checkService = 4;
}

if($_POST['paym3'] != "" && $_POST['paym3'] != "0"){
  $paym3g = '&nbsp;&nbsp;&nbsp;เครดิต '.$_POST['paym3'].' วัน';
}else{
  $paym3g = '';
}

$chkProcess = checkProcess($conn,$tbl_name,$PK_field,$id);

$saleSignature = '<img src="../../upload/user/signature/'.get_sale_signature($conn,$_POST['cs_sell']).'" height="50" border="0" />';

if($chkProcess == '5'){
	
	$hSaleSignature = '<img src="../../upload/user/signature/'.get_hsale_signature($conn).'" height="50" border="0" />';
	
}else{
	
	if($chkProcess == '0'){
		$hSaleSignature = '<img src="../../upload/user/signature/none.png" height="50" border="0" />';
	}else{
		
		$chkHSaleAP = checkHSaleApplove($conn,$tbl_name,$id);
		
		if($chkHSaleAP == 1){
			$hSaleSignature = '<img src="../../upload/user/signature/'.get_hsale_signature($conn).'" height="50" border="0" />';
		}else{
			$hSaleSignature = '<img src="../../upload/user/signature/none.png" height="50" border="0" />';
		}
		
	}

}

$userCreate = getCreatePaper($conn, $tbl_name, " AND `qu_id`=" . $_POST['qu_id']);
$headerIMG = get_headerPaper($conn, "QAB", $userCreate);

$form = '
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-bottom:5px;"><img src="'.$headerIMG.'" width="100%" border="0" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #003399;">
          <tr>
            <td width="57%" valign="top" style="font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;"><strong>ชื่อลูกค้า :</strong> '.$_POST["cd_name"].'<strong><br />
              <br />
            ที่อยู่ :</strong> '.$_POST["cd_address"].'<br />
            <br />
            <strong>โทรศัพท์ :</strong> '.$_POST["cd_tel"].'<strong>&nbsp;&nbsp;&nbsp;อีเมล์ :</strong> '.$_POST["cd_fax"].'<br /><br />
            <strong>ชื่อผู้ติดต่อ : </strong>'.$_POST["c_contact"].'<strong>&nbsp;&nbsp;&nbsp;เบอร์โทร :</strong> '.$_POST["c_tel"].' </td>
            <td width="43%" valign="top" style="font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">
            <strong>วันที่ :</strong> '.format_date($_POST["date_forder"]).'<br /><br />
            <strong>เลขที่เสนอราคา :</strong>'.$_POST["fs_id"].'<br /><br />
            <strong>ประเภทสินค้า :</strong> '.protype_name($conn,$_POST["pro_type"]).'<br /><br />
			</td>
          </tr>
</table>
  <br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:11px;text-align:center;">
    <tr>
      <td width="5%" style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="35%" style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="10%" style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="10%" style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>ราคา</strong></td>
      <td width="15%" style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>ส่วนลด</strong></td>
      <td width="15%" style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>ราคาสุทธิ</strong></td>
    </tr>
    <tr>
      <td style="border:1px solid #003399;padding:9px 5px;">'.$cpro1.'</td>
      <td style="border:1px solid #003399;text-align:left;padding:9px 5px;">'.get_proname($conn,$_POST["cpro1"]).$pro_pod1.'</td>
      <td style="border:1px solid #003399;padding:9px 5px;">'.$_POST["pro_sn1"].'</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.number_format($_POST["camount1"]).'</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.$prpro1.'&nbsp;&nbsp;</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.$totalSub1s.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #003399;padding:9px 5px;">'.$cpro2.'</td>
      <td style="border:1px solid #003399;text-align:left;padding:9px 5px;">'.get_proname($conn,$_POST["cpro2"]).$pro_pod2.'</td>
      <td style="border:1px solid #003399;padding:9px 5px;">'.$_POST["pro_sn2"].'</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.number_format($_POST["camount2"]).'</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.$prpro2.'&nbsp;&nbsp;</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.$totalSub2s.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #003399;padding:9px 5px;">'.$cpro3.'</td>
      <td style="border:1px solid #003399;text-align:left;padding:9px 5px;">'.get_proname($conn,$_POST["cpro3"]).$pro_pod3.'</td>
      <td style="border:1px solid #003399;padding:9px 5px;">'.$_POST["pro_sn3"].'</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.number_format($_POST["camount3"]).'</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.$prpro3.'&nbsp;&nbsp;</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.$totalSub3s.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #003399;padding:9px 5px;">'.$cpro4.'</td>
      <td style="border:1px solid #003399;text-align:left;padding:9px 5px;">'.get_proname($conn,$_POST["cpro4"]).$pro_pod4.'</td>
      <td style="border:1px solid #003399;padding:9px 5px;">'.$_POST["pro_sn4"].'</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.number_format($_POST["camount4"]).'</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.$prpro4.'&nbsp;&nbsp;</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.$totalSub4s.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #003399;padding:9px 5px;">'.$cpro5.'</td>
      <td style="border:1px solid #003399;text-align:left;padding:9px 5px;">'.get_proname($conn,$_POST["cpro5"]).$pro_pod5.'</td>
      <td style="border:1px solid #003399;padding:9px 5px;">'.$_POST["pro_sn5"].'</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.number_format($_POST["camount5"]).'</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.$prpro5.'&nbsp;&nbsp;</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.$totalSub5s.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #003399;padding:9px 5px;">'.$cpro6.'</td>
      <td style="border:1px solid #003399;text-align:left;padding:9px 5px;">'.get_proname($conn,$_POST["cpro6"]).$pro_pod6.'</td>
      <td style="border:1px solid #003399;padding:9px 5px;">'.$_POST["pro_sn6"].'</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.number_format($_POST["camount6"]).'</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.$prpro6.'&nbsp;&nbsp;</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.$totalSub6s.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #003399;padding:9px 5px;">'.$cpro7.'</td>
      <td style="border:1px solid #003399;text-align:left;padding:9px 5px;">'.get_proname($conn,$_POST["cpro7"]).$pro_pod7.'</td>
      <td style="border:1px solid #003399;padding:9px 5px;">'.$_POST["pro_sn7"].'</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.number_format($_POST["camount7"]).'</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.$prpro7.'&nbsp;&nbsp;</td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.$totalSub7s.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>รวมทั้งหมด</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.number_format($sumprice,2).'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>VAT 7 %</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.number_format($sumpricevat,2).'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" style="text-align:center;border:0px solid #003399;padding:9px 5px;background-color: #ddebf7;"><strong>'.baht_text($sumtotals).'</strong></td>
      <td style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>ราคารวมทั้งสิ้น</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;">'.number_format($sumtotals,2).'&nbsp;&nbsp;</td>
    </tr>
</table><br>
<p style="font-size:12px;"><strong><u>รายการของแถม</u></strong></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:11px;">
    <tr>
        <th width="10%" style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>ลำดับ</strong></th>
        <th width="75%" style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>รายการสินค้า</strong></th>
        <th width="15%" style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>จำนวน</strong></th>
    </tr>
    <tr>
      <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$profree1.'</td>
      <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">'.$_POST["cs_pro1"].'</td>
      <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$_POST["cs_amount1"].'</td>
    </tr>
    <tr>
      <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$profree2.'</td>
      <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">'.$_POST["cs_pro2"].'</td>
      <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$_POST["cs_amount2"].'</td>
    </tr>
    <tr>
      <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$profree3.'</td>
      <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">'.$_POST["cs_pro3"].'</td>
      <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$_POST["cs_amount3"].'</td>
    </tr>
    <tr>
      <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$profree4.'</td>
      <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">'.$_POST["cs_pro4"].'</td>
      <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$_POST["cs_amount4"].'</td>
    </tr>
    <tr>
      <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$profree5.'</td>
      <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">'.$_POST["cs_pro5"].'</td>
      <td style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$_POST["cs_amount5"].'</td>
    </tr>
  </table>
  <br><br><br><br><br><br><br>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td style="padding-bottom:5px;"><img src="'.$headerIMG.'" width="100%" border="0" /></td>
    </tr>
  </table>
  <p style="font-size:12px;"><strong><u>เงื่อนไขการชำระเงิน</u></strong></p>';
  
  if($_POST["payc"] == "1"){
    $form .= '<p style="font-size:12px;"><strong>ชำระเงินสด<strong></p>
    <p style="font-size:12px;">ชำระมัดจำสินค้า จำนวน '.number_format($_POST['paym'],2).' บาท ณ วันอนุมัติสั่งซื้อสินค้า</p>
    <p style="font-size:12px;">ชำระส่วนที่เหลือ จำนวน '.number_format($_POST['paym2'],2).' บาท'.$paym3g.'</p>';
  }else{
    $form .='<p style="font-size:12px;"><strong>แบ่งชำระ '.$_POST['pays'].' งวด<strong></p>
    <p style="font-size:12px;">ชำระงวดละ '.number_format($_POST['paysa'],2).' บาท&nbsp;&nbsp;&nbsp;ทุกวันที่ '.$_POST['paysad'].' ของทุกเดือน</p>';
  }

  $form .='<p style="font-size:12px;"><strong>**ราคาดังกล่าวรวมภาษีมูลค่าเพิ่ม 7% เรียบร้อยแล้ว</strong></p>
  <br>
  <p style="font-size:12px;"><strong><u>เงื่อนไขการรับประกันและการส่งสินค้า</u></strong></p>
  <p style="font-size:12px;">1. การรับประกันสินค้า รับประกันตัวเครื่อง อะไหล่และบริการฟรี '.$_POST['guaran1'].' หรือตามเงื่อนไขการขาย</p>
  <p style="font-size:12px;">2. บริษัทเข้าบริการตรวจเช็คทุกๆ '.$checkService.' เดือน/ครั้ง ฟรี</p>
  <p style="font-size:12px;">3. จัดส่งสินค้าภายใน '.$_POST['guaran2'].' วัน หลังจากชำระมัดจำสินค้า '.$_POST['guaran3'].'% จำนวน '.number_format($_POST['guaran4'],2).' บาท</p>';
  
  if($_POST['type_electric'] != "no"){
	  $form .='<p style="font-size:12px;">4. ลูกค้าเป็นผู้เตรียมระบบไฟฟ้า '.$_POST['type_electric'].' ท่อน้ำดี ขนาด 6 หุน น้ำทิ้ง ขนาด 2 นิ้ว ระยะไม่เกิน 5 เมตร จากตำแหน่งติดตั้ง</p>';
	  $form .='<p style="font-size:12px;">5. กำหนดยืนราคา '.$_POST['giveprice'].' วัน</p>';
  }else{
	   $form .='<p style="font-size:12px;">4. กำหนดยืนราคา '.$_POST['giveprice'].' วัน</p>';
  }
  

 $form .='<br>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1" >
    <tr>
      <td style="border:1px solid #003399;font-size:11px;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:15px;"><strong>หมายเหตุ : </strong>'.$_POST["remark"].'</td>
    </tr>
  </table>
  <br>
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #003399;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.$saleSignature.'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >( '.getsalename($conn,$_POST["cs_sell"]).' )</strong><br><br><strong>พนักงานขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <strong>เบอร์โทร '.$_POST["tel_sell"].'</strong>
                <br><br><strong>วันที่ '.format_date($_POST["date_sell"]).'</strong></td>
              </tr>
            </table>

        </td>
        <td width="33%" style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #003399;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.$hSaleSignature.'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>( '.$_POST["cs_hsell"].' )</strong><br><br><strong>ผู้จัดการฝ่ายขาย</strong></td>
              </tr>
              <tr>
              <td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
              <strong>เบอร์โทร '.$_POST["tel_hsell"].'</strong>
              <br><br>
              <strong>วันที่ '.format_date($_POST["date_hsell"]).'</strong></td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #003399;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #003399;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><img src="../../upload/user/signature/none.png" height="50" border="0" /></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>( '.$_POST["cs_account"].' )</strong><br><br><strong>ผู้อนุมัติสั่งซื้อสินค้า</strong></td>
              </tr>
              <tr>
              <td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
              <strong>เบอร์โทร '.$_POST["tel_account"].'</strong>
              <br><br>
              <strong>วันที่ '.format_date($_POST["date_account"]).'</strong></td>
              </tr>
            </table>
        </td>
      </tr>
    </table>
  ';
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
.bbcusinfo{
	height:120px;
	overflow:hidden;
}
</style>
<?php 
	
	
	$finfos = get_firstorder($conn,$_POST['cus_id']);

	$proList ='';
	$proList2 ='';
	$totalPrice = 0;

	foreach ($_POST['chkPro'] as $key => $value) {
		
		$priceP = $finfos['cprice'.$value] * $finfos['camount'.$value];
		
		$proList .= "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.".($key+1).".".get_proname($conn,$finfos['cpro'.$value]).' OMEGA &nbsp;&nbsp;รุ่น	'.$finfos['pro_pod'.$value].'  จำนวน '.$finfos['camount'.$value].' เครื่อง';
		
		$proList2 .= "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.".($key+1)." ".get_proname($conn,$finfos['cpro'.$value]).' OMEGA &nbsp;&nbsp;รุ่น	'.$finfos['pro_pod'.$value].'&nbsp;&nbsp;S/N '.$finfos['pro_sn'.$value];
		
		$totalPrice += $priceP;
	}

	$totalVat = ($totalPrice * 7 )/100;
	$sumTotal = $totalPrice+$totalVat;

	$setUpPrice = 0;
	$setUpVat = 0;
	

	if($finfos['notvat2'] == 2 && $finfos['money_setup'] != ""){
		$setUpPrice = $finfos['money_setup'] - ($finfos['money_setup'] * 0.07);
		$setUpVat = $finfos['money_setup'] * 0.07;
	}else{
		$setUpPrice = $finfos['money_setup'];
		$setUpVat = ($setUpPrice * 7) / 100;
	}

	$setupTotal = $setUpPrice + $setUpVat;

	$companyName = '';
	$companyTax = '';
	if($finfos['cd_type'] == '1' || $finfos['cd_type'] == ''){
		$companyName ='<strong>'.$finfos['cd_name'].'</strong> โดย';
		$companyTax = ' เลขประจําตัวผู้เสียภาษี <strong>'.$finfos['cd_tax'].'</strong>';
	}else{
		$companyName = '';
		$companyTax = ' เลขประจำตัวประชาชน <strong>'.$finfos['cd_tax'].'</strong>';
	}


	$form = '<style>
	.hdTitle{
	 	text-align: center;
		font-size:18px;
		margin-top:20px;
		font-weight: bold;
	}
	.conID{
	 	text-align: right;
		font-size:16px;
		font-weight: bold;
	}
	.textMedium{
		font-size:16px;
		line-height: 28px;
	}
	.textCenter{
		text-align: center;
	}
	.colorRed{
		color: red;
	}
	.signature{
		line-height: 35px;
	}
	</style>
	<div style="margin-left:35px;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;margin-top:5px;">
      <tr>
        <td width="50%" class="signature" style="vertical-align: top;text-align: left;">
            เลขที่ '.$_POST['con_id'].'
        </td>
        <td width="50%" class="signature" style="vertical-align: top;text-align: right;">
        	คู่ฉบับ
        </td>
      </tr>
    </table>
	<p class="hdTitle">สัญญาซื้อขาย</p>
	<div class="textMedium">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สัญญาฉบับนี้ทำขึ้นที่ บริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด เมื่อ'.format_date_th($_POST['con_stime'],1).' ระหว่าง<br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>บริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด</strong> โดย <strong>นางอัญชลี  อภิรักษ์โยธิน/นายคณวัฒน์ อภิรักษ์โยธิน</strong> กรรมการผู้มีอำนาจ สำนักงานตั้งอยู่เลขที่ 31 ซอยโชคชัย 4 ซอย 50 แยก 4 ถนนโชคชัย 4 แขวงลาดพร้าว เขตลาดพร้าวกรุงเทพมหานคร รหัสไปรษณีย์ 10230  เบอร์โทร 02-530-6357, 082-323-3535 แฟกซ์ 02-539-6842 ซึ่งต่อไปในสัญญานี้จะเรียกว่า “ผู้ขาย” ฝ่ายหนึ่ง กับ<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$companyName.' <strong>'.$finfos['name_consign'].'</strong> กรรมการผู้มีอำนาจ '.$companyTax.' สำนักงานตั้งอยู่เลขที่ '.$finfos['cd_address'].' โทรศัพท์ '.$finfos['cd_tel'].' โทรสาร '.$finfos['cd_fax'].' ซึ่งต่อไปในสัญญานี้จะเรียกว่า “ผู้ซื้อ” อีกฝ่ายหนึ่ง คู่สัญญาทั้งสองฝ่ายตกลงทำสัญญานี้ ดังมีเงื่อนไขรายละเอียดต่อไปนี้: -<br><br>';
	
//	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$finfos['cd_name'].'</strong> โดย '.$finfos['name_consign'].' กรรมการผู้มีอำนาจ สำนักงานตั้งอยู่เลขที่ '.$finfos['cd_address'].' โทรศัพท์ '.$finfos['cd_tel'].' โทรสาร '.$finfos['cd_fax'].' ซึ่งต่อไปในสัญญานี้จะเรียกว่า “ผู้ซื้อ” อีกฝ่ายหนึ่ง คู่สัญญาทั้งสองฝ่ายตกลงทำสัญญานี้ ดังมีเงื่อนไขรายละเอียดต่อไปนี้: -<br><br>

	
	
	$form .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 1.</strong>  คู่สัญญาทั้งสองฝ่ายตกลงให้ถือเอาเอกสารที่แนบท้ายสัญญานี้เป็นส่วนหนึ่งแห่งสัญญานี้ด้วย คือ<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.1 แบบฟอร์มใบเสนอราคาของผู้ขาย ลงวันที่ '.format_date_th($_POST['con_qatime'],1).' จำนวน '.$_POST['con_qap'].' ฉบับ<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.2 แบบฟอร์มใบสั่งซื้อของผู้ซื้อ ลงวันที่ '.format_date_th($_POST['con_ortime'],1).' จำนวน '.$_POST['con_orp'].' ฉบับ<br><br>';
	
//	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 2.</strong> ผู้ขายตกลงขาย และผู้ซื้อตกลงซื้อสินค้าของผู้ขาย คือ '.$proList.' ภาษีมูลค่าเพิ่ม 7% เป็นเงิน '.number_format($totalVat).' บาท ('.baht_text($totalVat).') <strong>รวมเป็นเงิน '.number_format($sumTotal).' บาท ('.baht_text($sumTotal).')</strong> โดยผู้ขายจะส่งของให้แก่ผู้ซื้อ ณ  '.$finfos['loc_name'].' ซึ่งมีค่าขนส่งและติดตั้ง เป็นเงิน '.number_format($setUpPrice).' บาท ('.baht_text($setUpPrice).') ภาษีมูลค่าเพิ่ม 7% เป็นเงิน '.number_format($setUpVat).' บาท ('.baht_text($setUpVat).') <strong>รวมเป็นเงิน '.number_format($setupTotal).' บาท ('.baht_text($setupTotal).')</strong> '.$finfos['qucomment'].' นับแต่วันทำสัญญานี้<br><br>

	$form .='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 2.</strong> ผู้ขายตกลงขาย และผู้ซื้อตกลงซื้อสินค้าของผู้ขาย คือ '.$proList.' ภาษีมูลค่าเพิ่ม 7% เป็นเงิน '.number_format($totalVat).' บาท ('.baht_text($totalVat).') <strong><br/>รวมเป็นเงิน '.number_format($sumTotal).' บาท ('.baht_text($sumTotal).')</strong><br><br>';
	
	
	$form .='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 3.1</strong>  ในกรณีที่ผู้ซื้อผิดนัด ไม่ชำระราคาสินค้าให้แก่ผู้ขายภายในกำหนดตาม ข้อ 2. ผู้ซื้อตกลงให้ผู้ขายริบค่ามัดจำที่ผู้ซื้อชำระให้แก่ผู้ขายได้ทันทีและผู้ซื้อยินยอมจ่ายเป็นเบี้ยปรับให้แก่ผู้ขาย<strong>เป็นจำนวนเงิน '.number_format($_POST['con_fines']).' บาท ('.baht_text($_POST['con_fines']).')</strong> พร้อมทั้งผู้ขายมีสิทธิบอกเลิกสัญญาได้อีกด้วย หากผู้ซื้อผิดสัญญาชำระเงินตามข้อ 3.1 ผู้ขายมีสิทธิจะขอเรียกเก็บดอกเบี้ยเงินกู้เท่ากับธนาคาร MR+1 ของธนาคารกรุงเทพ<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 3.2</strong>  ผู้ซื้อจะชำระส่วนที่เหลือ เป็นเงิน '.number_format($_POST['con_remainprice']).' บาท ('.baht_text($_POST['con_remainprice']).') ต่อเดือน โดยจะมี<strong>เช็ค</strong>ค้ำประกัน<br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>1.</strong>	เช็คเลขที่ '.$_POST['con_checknum'].' ประจำเดือน '.$_POST['con_checkmonth'].' ธนาคาร '.$_POST['con_checkbank'].' <strong>จำนวนเงิน '.number_format($_POST['con_checkamount']).' บาท ('.baht_text($_POST['con_checkamount']).')</strong><br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 4. รายการอุปกรณ์ประกอบ อันเป็นส่วนหนึ่งของสัญญา</strong>
'.$proList2.' <br><br>
ยังคงเป็นทรัพย์สินของบริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด ถึงงวดสุดท้าย ตามข้อ 3. หากคู่สัญญาฝ่ายหนึ่งฝ่ายใดผิดสัญญาให้อีกฝ่ายหนึ่งมีสิทธิบอกเลิกสัญญาและมีสิทธิเรียกร้องค่าเสียหายจากฝ่ายที่ผิดสัญญาได้ตามความเป็นจริง <br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สัญญานี้ทำขึ้นเป็นสองฉบับ มีข้อความถูกต้องตรงกันคู่สัญญาต่างยึดถือไว้ฝ่ายละฉบับและทั้งสองฝ่าย
ได้ศึกษาเข้าใจข้อความในสัญญานี้ดีโดยตลอดแล้ว จึงได้ลงลายมือชื่อและประทับตราสำคัญไว้เป็นหลักฐานต่อ
หน้าพยาน<br><br><br><br>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;margin-top:5px;">
      <tr>
        <td width="45%" class="signature" style="vertical-align: top;text-align: left;">
		&nbsp;
        </td>
        <td width="55%" class="signature textMedium" style="vertical-align: top;text-align: center;">
        	ลงชื่อ ………………………………… ผู้ขาย<br><br>
         ( นางอัญชลี อภิรักษ์โยธิน/นายคณวัฒน์ อภิรักษ์โยธิน )<br><br><br>
		 
		 	ลงชื่อ ………………………………… ผู้ซื้อ<br><br>
        		(…………………………………)<br><br><br>

			ลงชื่อ ………………………………… พยาน<br><br>
                (…………………………………)<br><br><br>

			ลงชื่อ ………………………………… พยาน<br><br>
				(…………………………………)

        </td>
      </tr>
    </table>
	</div>
	</div>
	';
?>
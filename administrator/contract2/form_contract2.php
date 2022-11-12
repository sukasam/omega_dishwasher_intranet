<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
.bbcusinfo{
	height:120px;
	overflow:hidden;
}
</style>
<?php 
	
	
	$finfos = get_firstorder($conn,$_POST['cus_id']);

	$txt4Service = "";
	if($finfos['cd_province'] == 2 || $finfos['cd_province'] == "2"){
		$txt4Service = 'ภายใน 24 ชั่วโมง <strong>กรณีวันทำการปกติ</strong> หรือ ภายใน 48 ชั่วโมง <strong>กรณีวันหยุด</strong>';
	}else{
		$txt4Service = 'ภายใน 48 ชั่วโมง <strong>กรณีวันทำการปกติ</strong> หรือ ภายใน 72 ชั่วโมง <strong>กรณีวันหยุด</strong>';
	}
	
	if($_POST['con_spar'] == '1' || $_POST['con_spar'] == 1){
	 $conSpar = 'แบบรวมอะไหล่';
	}else{
	 $conSpar = 'แบบไม่รวมอะไหล่';
	}

	$type_service = '';

	if(!empty($finfos['type_service'])){
		$type_service = str_replace("(คู่)","",get_servicename($conn, $finfos['type_service']));
		$type_service = str_replace("(คี่)","",$type_service);
	}else{
		$type_service = 'ประจำทุกเดือน เดือนละ 1 ครั้ง';
	}

	$productList = '';
    $productListImg = '';
	$nameConpro = '';
	foreach ($_POST['chkPro'] as $key => $value) {
		$productList .= 'ประเภท'.get_proname($conn,$finfos['cpro'.$value]).' 
		ยี่ห้อ	<strong>OMEGA</strong>
		&nbsp;&nbsp;รุ่น	'.$finfos['pro_pod'.$value].'
		&nbsp;&nbsp;หมายเลขเครื่อง '.$finfos['pro_sn'.$value].'<br>';
		$productListImg .= get_proname($conn,$finfos['cpro'.$value]).' 
		ยี่ห้อ	<strong>OMEGA</strong>
		&nbsp;&nbsp;รุ่น	'.$finfos['pro_pod'.$value].'
		&nbsp;&nbsp;หมายเลขเครื่อง '.$finfos['pro_sn'.$value].'<br><br>';
		if($_POST['con_img'.$value] != ""){
			$productListImg .='<img src="../../upload/contract2/img/'.$_POST['con_img'.$value].'" height="660"><br>';
		}
		
		if($key >= 1){
			$nameConpro .= "และ".get_proname($conn,$finfos['cpro'.$value]);
		}else{
			$nameConpro .= get_proname($conn,$finfos['cpro'.$value]);
		}
	}

	$conPrice = $_POST['con_price'];
    $conPriceVat = ($_POST['con_price'] * 7) / 100;
	$conPriceTotal = $conPrice + $conPriceVat;
	
	$companyName = '';
	$companyTax = '';
	if($finfos['cd_type'] == '1' || $finfos['cd_type'] == ''){
		$companyName ='<strong>'.$finfos['cd_name'].'</strong> โดย';
		$companyTax = ' เลขประจําตัวผู้เสียภาษี <strong>'.$finfos['cd_tax'].'</strong>';
	}else{
		$companyName = '';
		$companyTax = ' เลขประจำตัวประชาชน <strong>'.$finfos['cd_tax'].'</strong>';
	}

	$cdf = convertDate($_POST['con_startdate'], 'Y-m-d');
	$cdt = convertDate($_POST['con_enddate'], 'Y-m-d');

	$monthDiff = diffMonth($cdf, $cdt);

	$form = '<style>
	.hdTitle{
	 	text-align: center;
		font-size:18px;
		margin-top:20px;
		font-weight: bold;
	}
	.conID{
	 	text-align: right;
		font-size:15px;
		font-weight: bold;
	}
	.textMedium{
		font-size:15px;
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
	<p class="hdTitle">สัญญาบริการบำรุงรักษา'.$nameConpro.'</p>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;margin-top:5px;">
      <tr>
        <td width="50%" class="signature conID" style="vertical-align: top;text-align: left;">
           เลขที่สัญญา '.$_POST['con_id'].'
        </td>
        <td width="50%" class="signature conID" style="vertical-align: top;text-align: right;">
        	 คู่ฉบับ
        </td>
      </tr>
    </table><br>
	<div class="textMedium">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สัญญาฉบับนี้ทำขึ้นที่	'.$_POST['companyName'].' เมื่อ'.format_date_th($_POST['con_stime'],1).' ระหว่าง<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$_POST['companyName'].'</strong>  โดย นายคณวัฒน์ อภิรักษ์โยธิน  กรรมการผู้มีอำนาจ ลงนาม สำนักงานตั้งอยู่เลขที่ '.$_POST['companyAddress'].' โทรศัพท์ '.$_POST['companyTelephone'].'  ซึ่งต่อไปนี้ในสัญญาเรียกว่า <strong>“ผู้ให้บริการ”</strong> ฝ่ายหนึ่ง กับ
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$companyName.' <strong>'.$finfos['name_consign'].'</strong> ผู้มีอำนาจลงนามสัญญา '.$companyTax.'	สำนักงานตั้งอยู่เลขที่ '.$finfos['cd_address'].' โทรศัพท์ '.$finfos['cd_tel'].' โทรสาร '.$finfos['cd_fax'].' ซึ่งต่อไปนี้ในสัญญาเรียกว่า <strong>“ผู้รับบริการ”</strong> อีกฝ่ายหนึ่ง 
</p>
	<p class="textCenter"><br>
	โดยทั้งสองฝ่ายตกลงทำสัญญาบริการมีเงื่อนไขดังต่อไปนี้<br>
	'.$productList.'
โดย'.$nameConpro.'ดังกล่าว ตั้งอยู่ที่ '.$finfos['loc_name'].' เลขที่ '.$finfos['loc_address'].'<br>
<strong>สัญญาบริการฉบับนี้ การบริการบำรุงรักษา '.$monthDiff.' เดือน (สิบสองเดือน)</strong><br>
วันที่เริ่มสัญญาบริการ <mark>'.format_date_th($_POST['con_startdate'],1).'</mark>	วันสิ้นสุดสัญญาบริการ  <mark>'.format_date_th($_POST['con_enddate'],1).'</mark>

	</p>
	<p class="textCenter">
	<strong>** ราคาสัญญาบริการรายปี '.$conSpar.'  **</strong><br>
	ราคาสัญญาบริการ'.$conSpar.'ต่อปี เป็นเงินจำนวน  '.number_format($conPrice).' บาท ( '.baht_text($conPrice).' )<br>
	ภาษีมูลค่าเพิ่ม   7 %   เป็นเงินจำนวน  '.number_format($conPriceVat).' บาท ( '.baht_text($conPriceVat).' )<br>
	<strong>รวมเป็นเงินทั้งสิ้น จำนวน '.number_format($conPriceTotal).' บาท ('.baht_text($conPriceTotal).')<br> 
	การชำระเงินค่าสัญญาบริการดังกล่าว ณ วันที่ลงนามสัญญาบริการเรียบร้อยแล้ว</strong>

	</p>
	</div>
	<div class="textMedium"><br><br><br><br>
	<p class="textCenter"><strong>**เงื่อนไขและข้อตกลง ของสัญญาบริการรายปี'.$conSpar.'  **<strong></p>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>1.</strong>  ผู้รับบริการตกลงว่าจ้างผู้ให้บริการทำการบำรุงรักษา แก้ไขซ่อมแซม รวมถึงให้คำแนะนำเกี่ยวกับ '.$nameConpro.'ของผู้รับบริการ เป็นระยะเวลา 1 ปี นับตั้งแต่วันที่ '.format_date_th($_POST['con_startdate'],1).' ถึง วันที่ '.format_date_th($_POST['con_enddate'],1).'<br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>2.</strong>  ผู้ให้บริการสัญญาว่าจะทำการให้บริการโดยการตรวจเช็คทำความสะอาดเครื่อง ทั้งภายในและ ภายนอกเป็น'.$type_service.'  ตลอดสัญญาบริการ  โดยผู้ให้บริการจะทำการแจ้งผล การตรวจเช็คสภาพ เครื่อง  ให้ผู้รับบริการทราบ ทุก ๆ ครั้งที่เข้าบริการ และผู้รับบริการต้องให้ความสะดวก ในการที่ผู้ให้สัญญาหรือพนักงานของผู้ให้สัญญาทำการให้บริการทุกครั้ง<br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>3.</strong> ผู้ให้บริการให้สัญญาว่า จะจัดส่งพนักงานที่มีความรู้ ความชำนาญ ความสามารถ มาให้บริการในการ บำรุงรักษา แก้ไขซ่อมแซมเครื่อง รวมตลอดทั้งการให้คำปรึกษาแนะนำการใช้งานที่ถูกต้องของเครื่อง อีกทั้งดูแลรักษา เครื่องเพื่อป้องกันความเสียหายที่อาจเกิดขึ้นได้ในภายหน้า<br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>4.</strong> ในกรณีเครื่องขัดข้องกะทันหัน เมื่อผู้รับบริการแจ้งให้ผู้ให้บริการทราบ ไม่ว่าจะเป็นการแจ้งด้วยวาจา หรือ ลายลักษณ์อักษรก็ตาม ผู้ให้บริการให้สัญญาว่า จะจัดส่งพนักงานไปดำเนินการแก้ไข ซ่อมแซม ให้แก่ผู้รับบริการ '.$txt4Service.'<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทั้งนี้ ผู้ให้บริการจะเปิดให้บริการในวันจันทร์ ถึง วันเสาร์ เวลา 08.30 - 17.30 น. หยุดวันอาทิตย์ และ วันหยุดนักขัตฤกษ์<br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>5.</strong>  ในการให้บริการตามสัญญานี้ ไม่รวมถึงการเปลี่ยนอะไหล่ต่าง ๆ ที่ชำรุดจากการโยกย้ายสถานที่ตั้ง
ของ'.$nameConpro.'โดยบุคคลอื่นที่มิใช่พนักงานของบริษัท โอเมก้าฯ<br>';
	
	if($conSpar == 'แบบรวมอะไหล่'){
		$form .='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>6.</strong>  หากในการให้บริการ	พบเครื่องเสีย ขัดข้อง ต้องเปลี่ยนอะไหล่ หรืออุปกรณ์ส่วนหนึ่งส่วนใด ผู้ ให้บริการ จะทำการแจ้ง ให้ผู้รับบริการทราบ และ<strong>ทำการเปลี่ยนอะไหล่ หรือ อุปกรณ์นั้นทันที หรือกรณีที่จะต้องรอ อะไหล่ ก็จะแจ้งกำหนดการให้ทราบล่วงหน้า โดยผู้ให้บริการจะไม่คิดค่าใช้จ่ายใด ๆ ทั้งสิ้น</strong><br>';
	}else{
		$form .='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>6.</strong> หากในการให้บริการ ผู้ให้บริการพบว่ามีความจำเป็นต้อง เปลี่ยนอะไหล่ หรืออุปกรณ์ส่วนหนึ่งส่วนใด ผู้ให้บริการจะทำการแจ้งให้ผู้รับบริการทราบ พร้อมทั้งเสนอรายการ รายละเอียด และราคา ให้ผู้รับบริการรับพิจารณาก่อนว่า	จะทำการเปลี่ยนอะไหล่ หรือ อุปกรณ์นั้น หรือไม่<br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ในกรณีที่ผู้รับบริการตกลงเปลี่ยนอะไหล่ หรืออุปกรณ์จากผู้ให้บริการ ผู้ให้บริการตกลงลดราคา อะไหล่ให้ผู้รับบริการอีก 10 %  จากราคาปกติ โดยผู้ให้บริการตกลงว่าจะไม่คิดค่าจ้าง หรือค่าแรงในการ เปลี่ยนอะไหล่ หรืออุปกรณ์แต่ประการใด</strong><br>';
	}

	$form .='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>7.</strong>  ผู้ให้บริการจะไม่รับผิดชอบต่อความเสียหายที่เกิดกับเครื่อง อันเนื่องมาจาก อุบัติเหตุ ภัยธรรมชาติ สัตว์ หรือแมลง ความประมาทเลินเล่อ ของพนักงานผู้รับบริการ หรือการใช้เคม หรืออุปกรณ์ที่ไม่ได้คุณภาพ รวมไปถึงความเสียหายที่เกิดจากการซ่อมที่ไม่ใช่พนักงานของผู้ให้บริการ<br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>8.  สัญญาบริการฉบับนี้กำหนดให้เครื่องล้างจาน หรือ เครื่องล้างแก้ว ที่ทำสัญญาบริการกับผู้ให้บริการ ต้องใช้น้ำยาทำความสะอาดภาชนะทุกชนิด ของ '.$_POST['companyName'].' หรือ ตามที่ผู้ให้บริการ เป็นผู้กำหนดให้ เท่านั้น</strong><br><br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>9. ผู้ให้บริการมีสิทธิในการบอกยกเลิกสัญญาบริการ หากผู้รับบริการไม่ปฏิบัติตามข้อตกลงดังต่อไปนี้</strong><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9.1 กรณีที่พบว่าผู้รับบริการไม่ได้ใช้น้ำยาของ'.$_POST['companyName'].' หรือ น้ำยา ที่บริษัท กำหนดให้ ผู้ให้บริการจะแจ้งเป็นลายลักษณ์อักษร ให้ผู้รับบริการทราบและให้เวลาผู้รับบริการ แก้ไขตาม สมควรหรือไม่เกิน 30 วัน หากยังไม่แก้ไข ผู้ให้บริการมีสิทธิในการบอกเลิกสัญญาบริการดังกล่าว ได้ทันที โดยให้ถือว่า ผู้รับบริการยกเลิกสัญญาและผู้รับบริการยินยอมให้ริบเงินค่าบริการทั้งหมดและให้ถือว่า ผู้ให้บริการไม่ผิดเงื่อนไขและข้อตกลง<br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>10.</strong> สัญญาฉบับนี้ จะสมบูรณ์ครบถ้วน ก็ต่อเมื่อ ผู้ว่าจ้าง ได้ชำระเงินค่าสัญญาบริการดังกล่าวนี้ ตาม จำนวนเงินที่ระบุไว้ข้างต้น ให้แก่ผู้ให้บริการเป็นที่เรียบร้อยแล้ว
สัญญานี้จัดทำขึ้นเป็นสองฉบับ  โดยมีข้อความถูกต้องสมบูรณ์ตรงกันทุกประการ  คู่สัญญาทั้งสองฝ่ายได้อ่าน ข้อความในสัญญานี้โดยตลอดแล้ว จึงได้ลงลายมือชื่อ พร้อมประทับตรา ไว้ต่อหน้าพยานเป็นสำคัญ<br><br>
	</div><br>
	<div class="textMedium">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;margin-top:5px;">
      <tr>
        <td width="50%" class="signature" style="vertical-align: top;line-height: 35px;">
            ในนาม<br><br>
			<strong>'.$finfos['cd_name'].'</strong><br><br><br>
			ลงชื่อ………………………....……………ผู้รับบริการ<br><br>
			( '.$finfos['name_consign'].' )<br>
			ผู้มีอำนาจลงนามสัญญา<br><br><br>
			ลงชื่อ…………………………………………..พยาน<br><br>
			( ................................................ )<br><br><br><br>
			ลงชื่อ…………………………………………..พยาน<br><br>
			( ................................................ )
        </td>
        <td width="50%" class="signature" style="vertical-align: top;">
        	ในนาม<br><br>
			<strong>'.$_POST['companyName'].'</strong><br><br><br>
			ลงชื่อ………………………………………………ผู้ให้บริการ<br><br>
			( '.$_POST['companyPerson'].' )<br>
			กรรมการผู้มีอำนาจลงนาม<br><br><br>
			ลงชื่อ…………………………………………..พยาน<br><br>
			( ................................................ )<br><br><br><br>
			ลงชื่อ…………………………………………..พยาน<br><br>
			( ................................................ )
        </td>
      </tr>
    </table>
	</div><br><br><br><br><br><br><br><br>
	<div class="hdTitle">
		รูป'.$nameConpro.' ตั้งอยู่ที่ '.$finfos['loc_name'].' <br>
		เลขที่ '.$finfos['loc_address'].' <br><br>
		'.$productListImg.'
	</div>
	</div>
	';
?>
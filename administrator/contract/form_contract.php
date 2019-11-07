<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
.bbcusinfo{
	height:120px;
	overflow:hidden;
}
</style>
<?php 

	$finfos = get_firstorder($conn,$_POST['cus_id']);
	$nameConpro = '';
	$hrService = '';
	$proCH = 0;
	foreach ($_POST['chkTypePro'] as $key => $value) {
		if($key >= 1){
			$nameConpro .= "และ".$value;
		}else{
			$nameConpro .= $value;
		}
		
		if($value === 'เครื่องผลิตน้ำแข็ง'){
			$hrService = '72';
			$proCH = 1;
		}else{
			$hrService = '48';
			$proCH = 0;
		}
	}

	$listPro = '';
	$runPro = 0;
	for($i=1;$i<=7;$i++){
		if($finfos['cpro'.$i]){
			if($finfos['pro_pod'.$i] != ""){$propod = ' รุ่น '.$finfos['pro_pod'.$i];}
			if($finfos['pro_sn'.$i] != ""){$prosn = ' S/N '.$finfos['pro_sn'.$i];}
			$listPro .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.'.$i.' '.get_proname($conn,$finfos['cpro'.$i]).$propod.$prosn.' จำนวน '.$finfos['camount'.$i].' '.get_pronamecall($conn,$finfos['cpro'.$i]).'<br>';
			$runPro++;
		}
	}

	$listProFree = '';
	for($i=1;$i<=5;$i++){
		if($finfos['cs_pro'.$i]){
			$runPro++;
			$listProFree .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.'.$runPro.' '.$finfos['cs_pro'.$i].' จำนวน '.$finfos['cs_amount'.$i].' '.$finfos['cs_namecall'.$i].'<br>';
			//$runPro++;
		}
	}

	$nameConproCh = '';
	$rentPro = '';
    $totalRentPro = 0;
	foreach ($_POST['chkPro'] as $key => $value) {
		if($key >= 1){
			$rentMonth = $finfos['camount'.$value]*$finfos['cprice'.$value];
			$nameConproCh .= " และ".get_proname($conn,$finfos['cpro'.$value]).' รุ่น '.$finfos['pro_pod'.$value];
			$rentPro .= " และค่าเช่า".get_proname($conn,$finfos['cpro'.$value])." รุ่น ".$finfos['pro_pod'.$value]." เดือนละ ".number_format($rentMonth)." (".baht_text($rentMonth).")";
			$totalRentPro += $rentMonth;
		}else{
			$rentMonth = $finfos['camount'.$value]*$finfos['cprice'.$value];
			$nameConproCh .= get_proname($conn,$finfos['cpro'.$value]).' รุ่น '.$finfos['pro_pod'.$value];
			$rentPro .= "ค่าเช่า".get_proname($conn,$finfos['cpro'.$value])." รุ่น ".$finfos['pro_pod'.$value]." เดือนละ ".number_format($rentMonth)." (".baht_text($rentMonth).")";
			$totalRentPro += $rentMonth;
		}
	}

	$totalRentProVat = ($totalRentPro*7) / 100;
	$sumTotal = $totalRentPro+$totalRentProVat;

	$type_service = '';
	
	if($finfos['type_service'] == 6){
		$type_service = "และเข้าบริการประจำ 1";
	}else if($finfos['type_service'] == 31 || $finfos['type_service'] == 1){
		$type_service = "และเข้าบริการประจำ 2";
	}else if($finfos['type_service'] == 2){
		$type_service = "และเข้าบริการประจำ 3";
	}else if($finfos['type_service'] == 3){
		$type_service = "และเข้าบริการประจำ 4";
	}

	$setUpPrice = 0;
	$setUpVat = 0;
	

//	if($finfos['notvat2'] == 2 && $finfos['money_setup'] != ""){
//		$setUpPrice = $finfos['money_setup'] - ($finfos['money_setup'] * 0.07);
//		$setUpVat = $finfos['money_setup'] * 0.07;
//	}else{
//		$setUpPrice = $finfos['money_setup'];
//		$setUpVat = ($setUpPrice * 7) / 100;
//	}

	if($finfos['notvat2'] == 2 && $finfos['money_setup'] != ""){
		$setUpPrice = $finfos['money_setup'];
		$setUpVat = $finfos['money_setup'] * 0.07;
	}else{
		$setUpPrice = $finfos['money_setup'] - ($finfos['money_setup'] * 0.07);
		$setUpVat = $finfos['money_setup'] * 0.07;
	}


	$setupTotal = $setUpPrice + $setUpVat;

	
	$garunteePrice = 0;
	$garunteeVat = 0;
	

//	if($finfos['notvat1'] == 2 && $finfos['money_garuntree'] != ""){
//		$garunteePrice = $finfos['money_garuntree'] - ($finfos['money_garuntree'] * 0.07);
//		$garunteeVat = $finfos['money_garuntree'] * 0.07;
//	}else{
//		$garunteePrice = $finfos['money_garuntree'];
//		$garunteeVat = ($garunteePrice * 7) / 100;
//	}

	if($finfos['notvat1'] == 2 && $finfos['money_garuntree'] != ""){
		$garunteePrice = $finfos['money_garuntree'];
		$garunteeVat = $finfos['money_garuntree'] * 0.07;
	}else{
		$garunteePrice = $finfos['money_garuntree'] - ($finfos['money_garuntree'] * 0.07);
		$garunteeVat = ($garunteePrice * 7) / 100;
	}

	$garunteeTotal = $garunteePrice + $garunteeVat;

	$numContract = checkNumContractRent($conn,$_POST['cus_id']);
	$numContractInfo = checkContractRent($conn,$_POST['cus_id']);

	$numContractFY = 0;
	if($numContract >= 2){
		$contractFN = $numContractInfo['con_id'];
		$contractFY = date("Y",strtotime($numContractInfo['con_startdate']))+543;
		$contractFM = date('Y-m-d', strtotime('-1 months', strtotime($numContractInfo['con_startdate'])));
		$contractFM = format_date_th($contractFM,7);
	}else{
		$contractFY = date("Y",strtotime($_POST['con_startdate']))+543;
		$contractFM = date('Y-m-d', strtotime('-1 months', strtotime($_POST['con_startdate'])));
		$contractFM = format_date_th($contractFM,7);
		$contractFN = $_POST['con_id'];
	}

	if($_POST['con_img1']){
		$imgPro .= '<img src="../../upload/contract/img/'.$_POST['con_img1'].'" height="500"><br>';
	}

	if($proCH == 1){
		$numTop = 11;
		$text1 = 'ผลิตน้ำแข็ง';
	}else{
		$numTop = 12;
		$text1 = 'ล้างภาชนะ';
	}

	if($finfos['typegaruntree'] == 2){
		$typegaruntree = 'เงินค่าเช่าล่วงหน้า';
	}else{
		$typegaruntree = 'เงินประกัน';
	}

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
	.hdTitle2{
	 	text-align: center;
		font-size:20px;
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
	.colorbBlue{
		color: #296dd4;
	}
	.signature{
		line-height: 35px;
	}
	.text-italic{
		font-style: italic;
	}
	</style>
	<div style="margin-left:35px;">
	<p class="hdTitle">สัญญาเช่า'.$nameConpro.'</p>
	<p class="textMedium" style="text-align: center;">เงื่อนไข : '.getcustom_type($conn,$finfos['ctype']).'</p>
	<div></div>
	<div class="textMedium">
	<div class="conID">
	 ต้นฉบับ<br>
	 สัญญาเลขที่ '.$_POST['con_id'].'<br><br>
	</div>
	 
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สัญญาฉบับนี้ทำขึ้นที่ บริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด เมื่อ'.format_date_th($_POST['con_stime'],1).' ระหว่าง<br>
	
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>บริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด</strong> โดย <strong>นางอัญชลี อภิรักษ์โยธิน / นายคณวัฒน์ อภิรักษ์โยธิน</strong> กรรมการผู้มีอำนาจ สำนักงานตั้งอยู่เลขที่ 31 ซอยโชคชัย 4 ซอย 50 แยก 4 ถนนโชคชัย 4 แขวงลาดพร้าว เขตลาดพร้าว กรุงเทพมหานคร 10230 เบอร์โทร 02-530-6357, 082-323-3535 แฟกซ์ 02-539-6842 ซึ่งต่อไปนี้สัญญานี้เรียกว่า “ ผู้ให้เช่า ” ฝ่ายหนึ่ง กับ<br>
	 
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$companyName.' <strong>'.$finfos['name_consign'].'</strong> กรรมการผู้มีอำนาจ '.$companyTax.' สำนักงานใหญ่ตั้งอยู่เลขที่ '.$finfos['cd_address'].' โทรศัพท์ '.$finfos['cd_tel'].' ซึ่งต่อไปในสัญญานี้เรียกว่า “ผู้เช่า” อีกฝ่ายหนึ่ง<br><br>
	 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 1. ข้อตกลงเช่า</strong><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้เช่าตกลงเช่าและผู้ให้เช่าตกลงให้เช่า'.$nameConproCh.' ของ บริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด เพื่อใช้'.$text1.'ใน '.$finfos['loc_name'].' ที่ตั้งร้านเลขที่ '.$finfos['loc_address'].'  โทรศัพท์ '.$finfos['cd_tel'].' ซึ่งต่อไปในสัญญานี้เรียกว่า “'.$nameConpro.'” ตามรายละเอียดแนบท้ายสัญญา<br><br>

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 2. รายการอุปกรณ์ประกอบ อันเป็นส่วนหนึ่งของสัญญา</strong><br>
	'.$listPro.'
	'.$listProFree.'
	<br>';
	
	if($proCH == 1){
		$txt2 = 'และกรณีกรณีไส้กรองหมดอายุ ทางลูกค้า เป็นผู้ออกค่าใช้จ่ายในการเปลี่ยนไส้กรอง';	
	}else{
		$txt2 = '';
	}

	$cdf = convertDate($_POST['con_startdate'],'Y-m-d');
	$cdt = convertDate($_POST['con_enddate'],'Y-m-d');
				
	$monthDiff = diffMonth($cdf,$cdt);
	
	$form .= 'หมายเหตุ : อุปกรณ์เสริมที่ทางผู้ให้เช่าให้ผู้เช่ายืม (หากอุปกรณ์ที่ยืมมีความเสียหายใด ๆ หรือมีการสูญหาย เกิดขึ้นทางผู้เช่าจะเป็นผู้รับผิดชอบทั้งหมดทุกกรณีโดยไม่มีเงื่อนไข'.$txt2.')	<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 3. ระยะเวลาการเช่า</strong><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สัญญานี้ มีผลบังคับตั้งแต่วันที่ลงนามในสัญญาเช่า'.$nameConpro.'นี้ ให้มีกำหนด <strong>ระยะเวลาการเช่า '.$monthDiff.' เดือน</strong> เริ่มตั้งแต่วันที่ '.format_date_th($_POST['con_startdate'],1).' ถึงวันที่ '.format_date_th($_POST['con_enddate'],1).' ถัดจากวันที่ผู้เช่ารับมอบ '.$nameConpro.'เรียบร้อยแล้ว <br>
	<strong class="colorbBlue">(สัญญาเล่มนี้เป็นสัญญาปีที่ '.$numContract.' (ปีแรก ปี '.$contractFY.' เดือน '.$contractFM.') ตามเลขที่สัญญาเล่มแรก '.$contractFN.')</strong><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ตลอดระยะเวลาการเช่าและหลังครบกำหนดระยะเวลาการเช่า ผู้ให้เช่าเป็นผู้ครอบครองและเป็นเจ้าของ กรรมสิทธิ์ในเครื่องล้างจานและอุปกรณ์ประกอบต่าง ๆ ตามสัญญาข้อ 1. และ ข้อ 2. โดยผู้เช่าไม่มีสิทธิ์ โต้แย้งใด ๆ ทั้งสิ้น</strong>
	<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 4. การชำระค่าเช่าและค่าติดตั้งเครื่อง</strong> <br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;การเช่า'.$nameConpro.'ตามสัญญานี้ เป็นการเช่าแบบมีกำหนดระยะเวลา โดยผู้เช่าตกลงชำระค่าเช่า เป็นรายเดือนทุกเดือนในอัตราที่ผู้ให้เช่ากำหนด<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$rentPro.' และภาษีมูลค่าเพิ่ม 7% เป็นเงิน '.number_format($totalRentProVat).' บาท ('.baht_text($totalRentProVat).') <strong>รวมเป็นเงิน '.number_format($sumTotal).' บาท ('.baht_text($sumTotal).')</strong> <strong class="colorRed">โดยชำระก่อนทุกวันที่ '.$_POST['con_paymonth'].' ของทุกเดือน เริ่มงวดแรก คือ เดือน '.format_date_th($_POST['con_startdate'],7).' เป็นต้นไป จนกว่าจะครบกำหนดตามสัญญา</strong><br><br>

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ค่าติดตั้งและค่าขนส่ง'.$nameConpro.'</strong>ผู้เช่าตกลงชำระค่าติดตั้งทรัพย์สินที่เช่าเป็นจำนวนเงิน '.number_format($setUpPrice).' บาท ('.baht_text($setUpPrice).') และภาษีมูลค่าเพิ่ม 7% เป็นเงิน '.number_format($setUpVat).' บาท ('.baht_text($setUpVat).') <strong>รวมเป็นเงิน '.number_format($setupTotal).' บาท ('.baht_text($setupTotal).')</strong><br><br>

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 5. '.$typegaruntree.'</strong><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในวันที่ทำสัญญา ผู้เช่าได้โอน'.$typegaruntree.'เครื่องให้แก่ผู้ให้เช่า ดังนี้<br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.1 '.$nameConproCh.' เป็นจำนวนเงิน '.number_format($garunteePrice).' บาท ('.baht_text($garunteePrice).') และภาษีมูลค่าเพิ่ม 7% เป็นเงิน '.number_format($garunteeVat).' บาท ('.baht_text($garunteeVat).') <strong>รวมเป็นเงิน '.number_format($garunteeTotal).' บาท ('.baht_text($garunteeTotal).')</strong> มอบไว้แก่ผู้ให้เช่าเพื่อเป็นหลักประกันความเสียหาย ซึ่งอาจเกิดขึ้นกับ '.$nameConpro.'ที่เช่าและให้ปฏิบัติตามสัญญาดังนี้ หากผู้เช่า เช่าไม่ครบตามกำหนดระยะเวลา ในสัญญาหรือผิดสัญญาข้อใดข้อหนึ่ง ผู้เช่ายอมให้ผู้ให้เช่าริบ'.$typegaruntree.'เครื่องได้ทั้งหมด<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.2 เมื่อครบกำหนดระยะเวลาในการเช่าและผู้เช่าไม่ได้ผิดสัญญาหรือทำความเสียหายต่อ '.$nameConpro.'ข้อ 2 หรือติดค้างค่าเช่าและหรือค่าเสียหายใด ๆ ผู้ให้เช่ายินดีจะคืน'.$typegaruntree.' ตามวรรคแรกให้กับผู้เช่าโดยไม่มี ดอกเบี้ยภายใน 30 วัน นับตั้งแต่วันที่ได้รับคืน'.$nameConpro.' เรียบร้อยแล้ว<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 6. การรับรองคุณภาพ</strong><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ให้เช่ารับรองว่า'.$nameConpro.'ที่ให้เช่าตามสัญญานี้ มีคุณสมบัติเหมือนหรือไม่ต่ำกว่า ที่กำหนดไว้ตามใบเสนอราคาและแคตตาล็อกสินค้าตามที่เสนอรายละเอียดทั้งหมดให้แล้ว <br><br>

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 7. การส่งมอบและติดตั้ง</strong><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ให้เช่าจะทำการขนส่งและติดตั้ง'.$nameConpro.'เช่าตามสัญญานี้ โดยผู้เช่าจะต้องจัดเตรียม สถานที่ไว้ให้พร้อม ทั้งระบบน้ำประปาและระบบไฟฟ้ามายังจุดที่ติดตั้ง'.$nameConpro.' ให้แก่ผู้ให้เช่าถูกต้องครบถ้วนตามที่กำหนดไว้ตามสัญญาข้อ 2 แห่งสัญญานี้ในลักษณะพร้อมใช้งานได้  ซึ่งผู้เช่าต้องจัดเตรียมสถานที่ ระบบไฟฟ้า ระบบน้ำดี ระบบน้ำทิ้งและอื่น ๆ ที่จำเป็นในการติดตั้งตาม คำแนะนำของผู้ให้เช่า โดยให้ผู้เช่าเป็นผู้ออกค่าใช้จ่ายเองทั้งสิ้น<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 8. การตรวจรับ</strong><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เมื่อผู้เช่าได้ตรวจรับ'.$nameConpro.'ที่ส่งมอบถูกต้องครบถ้วนตามสัญญานี้แล้วให้ผู้เช่า ลงลายมือชื่อในเอกสาร การส่งมอบไว้เป็นหลักฐานการรับมอบ เพื่อผู้ให้เช่านำมาใช้เป็นหลักฐานประกอบ การขอรับเงินค่าเช่า '.$nameConpro.'<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 9.  การบำรุงรักษา</strong><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9.1  ผู้เช่าตกลงดูแลรักษาและใช้'.$nameConpro.'ที่เช่าตามคำแนะนำของผู้ให้เช่าอย่างเคร่งครัด หากทรัพย์สิน ที่เช่าเสียหายเพราะการใช้งานนอกเหนือจากการล้างจานตามปกติที่ผู้ให้เช่า แนะนำไว้ผู้เช่าตกลงรับผิดชอบ ในความเสียหายทั้งหมด <br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9.2  ผู้เช่าตกลงให้ผู้ให้เช่าหรือตัวแทนเข้าตรวจสอบและบำรุงรักษา'.$nameConpro.' ให้อยู่ในสภาพใช้งานได้ดี อยู่เสมอ โดยช่างผู้มีความรู้ความชำนาญและมีฝีมือดีมาตรวจสอบ บำรุงรักษาและซ่อมแซมแก้ไข '.$nameConpro.'ที่ให้เช่า '.$type_service.' เดือน/ครั้ง ตลอดอายุสัญญาเช่านี้ <br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 10.  การซ่อมแซมแก้ไข</strong><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10.1 ในกรณี'.$nameConpro.'ชำรุดบกพร่องใช้งานไม่ได้ ผู้ให้เช่าจะจัดให้ช่างที่มีความรู้ ความชำนาญ และฝีมือดีมาจัดการซ่อมแซมแก้ไขให้อยู่ในสภาพใช้งานได้ดี โดยเริ่มการดำเนินการดังนี้<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(1) กรณี'.$nameConpro.'ชำรุดบกพร่อง ในเขตกรุงเทพมหานครและปริมณฑล ผู้ให้เช่าจะดำเนินการ เข้าซ่อมแซมภายใน 24 ชั่วโมง นับแต่เวลาที่ได้รับแจ้งจากผู้เช่าหรือผู้ที่ได้รับมอบหมายจากผู้เช่า<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(2) กรณี'.$nameConpro.'ชำรุดบกพร่อง ในเขตต่างจังหวัด ผู้ให้เช่าจะดำเนินการเข้าซ่อมแซมภายใน '.$hrService.' ชั่วโมง นับแต่เวลาที่ได้รับแจ้งจากผู้เช่าหรือผู้ที่ได้รับมอบหมายจากผู้เช่า';
	if($proCH == 1){
		$form .= '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(3) กรณีเครื่องผลิตน้ำแข็งชำรุดอันเกิดจากความประมาทเลินเล่อของผู้เช่า ผู้เช่าจะต้องเป็นผู้รับภาระค่าใช้จ่าย ในการซ่อมให้กลับสู่สภาพปกติ<br><br>';
	}else{
		$form .= '<br><br>';
	}
	
	if($proCH == 0){
		$form .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 11. การใช้น้ำยาทำความสะอาดภาชนะสำหรับเครื่อง</strong> <br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;11.1 ผู้เช่าตกลงใช้น้ำยาทำความสะอาดภาชนะสำหรับ'.$nameConpro.'ของ บริษัท โอเมก้า ดิชวอชเชอร์(ประเทศไทย) จำกัด กับ'.$nameConpro.'ที่เช่าตามสัญญานี้<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;11.2 ผู้ให้เช่าจะจัดส่งน้ำยาทำความสะอาดภาชนะให้ผู้เช่าในปริมาณที่เพียงพอกับการใช้งานจริง โดยไม่มีการจำกัดปริมาณ<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;11.3 น้ำยาทำความสะอาดภาชนะที่ผู้ให้เช่าให้ผู้เช่าใช้ตามสัญญานี้ ผู้เช่าไม่มีสิทธิแลกเป็นเงินหรือ นำออกจำหน่ายแก่บุคคลภายนอก <br><br>';
	}
	
	if($proCH == 1){
		$numTop = 11;
		$text11 = 'การใช้งานเครื่องผลิตน้ำแข็ง';
	}else{
		$numTop = 12;
		$text11 = 'การล้างภาชนะด้วยเครื่อง';
	}
	
	
	$form .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ '.$numTop++.'.   การจัดอบรม</strong><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ให้เช่าจะจัดอบรมวิธีการใช้เครื่องและ'.$text11.'ให้แก่เจ้าหน้าที่ของผู้เช่าหลังการติดตั้ง โดยผู้เช่าจะต้องจัดเจ้าหน้าที่ วันเวลา สถานที่ ให้แก่ผู้ให้เช่าเข้าอบรม โดยผู้ให้เช่าจะไม่คิดค่าใช้จ่ายใด ๆ ถ้าผู้เช่าไม่จัดให้เจ้าหน้าที่เข้าอบรม หากเกิดความเสียหายขึ้น ผู้เช่าต้องรับผิดชอบตามสัญญาข้อที่ 9.1<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ '.$numTop++.'.  การบอกเลิกสัญญา</strong><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หากผู้เช่าผิดนัดหรือผิดสัญญาข้อหนึ่งข้อใด ผู้เช่าตกลงให้ผู้ให้เช่าเรียกร้องสิทธิ  ดังต่อไปนี้<br>
	<strong class="text-italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	'.($numTop -= 1).'.1 ในกรณีผู้เช่าผิดนัดชำระค่าเช่า ผู้ให้เช่ามีสิทธิในการคิดดอกเบี้ยในอัตราร้อยละ 15(สิบห้า) ต่อปี และเบี้ยปรับในอัตราร้อยละ 9(เก้า) ต่อปี หรือ ร้อยละ 0.75 ต่อเดือน ของค่าเช่าที่ค้างชำระจนกว่า ผู้เช่าจะชำระครบและผู้ให้เช่าสามารถระงับการใช้งานของ'.$nameConpro.'ได้ หากผู้เช่าค้างชำระค่าเช่าเป็นเวลา 2 เดือน โดยไม่จำต้องบอกกล่าวทวงถาม<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	'.$numTop.'.2 ในกรณีที่ผู้เช่าผิดสัญญาข้อใดข้อหนึ่ง ผู้ให้เช่าจะแจ้งให้ผู้เช่าทราบเป็นลายลักษณ์อักษร เพื่อให้ผู้เช่าดำเนินการแก้ไขภายในระยะเวลา 30 วัน นับแต่วันที่ผู้เช่าได้รับการแจ้งเตือนและหากผู้เช่า ไม่ดำเนินการแก้ไขภายในระยะเวลาที่กำหนด ผู้ให้เช่ามีสิทธิบอกเลิกสัญญาได้ทันที แต่หากเป็นกรณีที่ ไม่อาจแก้ไขได้ผู้ให้เช่ามีสิทธิในการบอกเลิกสัญญาทันทีและเมื่อบอกเลิกสัญญาแล้ว ผู้ให้เช่ามีสิทธิริบ'.$typegaruntree.'ทั้งหมดและให้ผู้ให้เช่ากลับเข้าครอบครองทรัพย์สินของผู้ให้เช่าได้ทันที โดยผู้ให้เช่ามีสิทธิดำเนินการถอดถอน'.$nameConpro.'ที่เช่าออกจากสถานที่ติดตั้งของผู้เช่าโดยถือว่าผู้เช่า อนุญาตให้ผู้ให้เช่าเข้าไปในสถานที่หรือร้านค้าของผู้เช่าหรือผู้เช่าต้องประสานและแจ้งเจ้าของสถานที่ทราบโดยถือว่า ผู้เช่าอนุญาตให้เข้าไปโดยผู้เช่ายินยอมและกรณีผู้ให้เช่าเป็นฝ่ายถอดเครื่องออก หากการถอดถอนก่อให้เกิดความเสียหาย ผู้ให้เช่าจะเป็นผู้รับผิดชอบ แต่ถ้ากรณีผู้เช่าเป็นฝ่ายถอดเครื่องออกเอง หากเกิดความเสียหาย ผู้เช่าต้องเป็นฝ่ายรับผิดชอบ<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	'.$numTop++.'.3 ในกรณีผู้ให้เช่าผิดสัญญาทำผิดเงื่อนไขการเช่า ผู้เช่าสามารถบอกเลิกสัญญาล่วงหน้าอย่างน้อย 30 วัน และหากพบว่าเป็นความผิดจริง ให้ผู้ให้เช่าคืน'.$typegaruntree.'ให้ผู้เช่าภายใน 30 วัน เช่นกัน<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ '.$numTop++.'.  การต่อสัญญาเช่า</strong><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;การเช่า'.$nameConpro.'ตามสัญญาเป็นการเช่าแบบมีกำหนดระยะเวลา ผู้ให้เช่าจะแจ้งการต่อสัญญาเช่า และการเปลี่ยนแปลงอัตราค่าเช่าใหม่ให้ผู้เช่าทราบก่อนครบกำหนดระยะเวลาเช่า 60 วัน หากเมื่อสัญญาครบระยะเวลาเช่าและยังไม่มีการต่อสัญญาหรือบอกยกเลิกสัญญาเช่าของทั้งสองฝ่าย ผู้ให้เช่าและผู้เช่าตกลงปฏิบัติตามเงื่อนไขในสัญญาเดิมโดยถือว่าคู่สัญญาตกลงทำสัญญากันใหม่โดย ไม่มีกำหนดระยะเวลาจนกว่าจะมีการทำสัญญาใหม่หรือยกเลิกสัญญาเดิม<br><br></strong>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong class="colorRed text-italic">ข้อ '.$numTop++.'. ข้อสำคัญต่าง ๆ เหล่านี้ล้วนถูกระบุไว้แล้วในสัญญาโดยละเอียด กรุณาอ่านทั้งหมดโดยละเอียด</strong><br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สัญญานี้ทำขึ้นสองฉบับ มีข้อความถูกต้องตรงกัน คู่สัญญาได้อ่านและเข้าใจข้อความโดยละเอียดตลอดแล้ว จึงได้ลงลายมือชื่อพร้อมทั้งประทับตรา (ถ้ามี) ไว้เป็นสำคัญต่อหน้าพยานและคู่สัญญาต่างยึดถือไว้ฝ่ายละฉบับ<br><br>
	 
	</div>
	
	<div class="textMedium">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;margin-top:5px;">
      <tr>
        <td width="50%" class="signature" style="vertical-align: top;line-height: 35px;">
            <br><br>ในนาม <strong>'.$finfos['cd_name'].'</strong><br><br><br><br>
			ลงชื่อ………………………....……………ผู้เช่า<br><br>
			( '.$finfos['name_consign'].' )<br>
			กรรมการผู้มีอำนาจ<br><br><br><br><br>
			ลงชื่อ…………………………………………..พยาน<br><br>
			( ................................................ )<br><br><br><br><br>
			ลงชื่อ…………………………………………..พยาน<br><br>
			( ................................................ )
        </td>
        <td width="50%" class="signature" style="vertical-align: top;">
        	<br><br>ในนาม <strong>บริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด</strong><br><br><br><br>
			ลงชื่อ………………………………………………ผู้ให้เช่า<br><br>
			( นางอัญชลี อภิรักษ์โยธิน / นายคณวัฒน์ อภิรักษ์โยธิน )<br>
			กรรมการผู้มีอำนาจ<br><br><br><br><br>
			ลงชื่อ…………………………………………..พยาน<br><br>
			( ................................................ )<br><br><br><br><br>
			ลงชื่อ…………………………………………..พยาน<br><br>
			( ................................................ )
        </td>
      </tr>
    </table>
	</div><br><br><br><br><br><br><br><br><br><br><br><br><br>
	
	<div class="textCenter textMedium"><br><br><br>
	<p class="hdTitle2">“ รูปถ่าย'.$nameConpro.'สำหรับแนบท้าย ”<br>
		สัญญาเช่าเลขที่ '.$_POST['con_id'].'<br>
	</p>
	<div>
		'.$imgPro.'
	</div>
	<p class="hdTitle2">
	'.$finfos['loc_name'].'<br>
	</p>
	</div>
	</div>
	';
?>


	

	
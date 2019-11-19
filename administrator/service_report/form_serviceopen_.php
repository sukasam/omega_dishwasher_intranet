<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
	
	
	$finfos = get_firstorder($conn,$_POST['cus_id']);
	
	$chk = get_fixlist($_POST['ckf_list']);
	
	$tecinfos = get_technician($conn,$_POST['loc_contact']);
	
	foreach($chk as $vals){
		$sfix .= '
		  <tr>
			<td ><img src="../images/aroow_ch.png" width="10" height="10" border="0" alt="" />&nbsp;'.get_fixname($conn,$vals).'</td>
		  </tr>
		';	
	}

	$form = '<style>
	.bgheader{
		font-size:10px;
		position:absolute;
		margin-top:100px;
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
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;	
	}
	.tb2,.tb3{
		border:1px solid #000000;	
		margin-top:5px;
	}
	.tb2 tr td{
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;		
	}
	
	.tb3 tr td{
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;		
	}
	.tb3 img{
		vertical-align:bottom;
	}
	
	.ccontact{
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
	}
	.ccontact tr td{
		
	}
	
	.cdetail{
		border: 1px solid #000000;
		padding:5px;
		font-size:10px;
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
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
		margin-top:5px;
	}
	
	</style>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="text-align:right;font-size:12px;">
			<img src="../images/form/header_service_report.png" width="100%" border="0" />
			<div class="bgheader">'.$_POST['sv_id'].'</div>
		</td>
	  </tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td width="57%" valign="top"><strong>ชื่อลูกค้า :</strong> '.$finfos['cd_name'].' <br />              <strong><br />
            ที่อยู่ :</strong> '.$finfos['cd_address'].'&nbsp;'.province_name($conn,$finfos['cd_province']).'<strong><br />
            <br />
            โทรศัพท์ :</strong> '.$finfos['cd_tel'].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>แฟกซ์ :</strong> '.$finfos['cd_fax'].'<br />
            <br />
            <strong>ชื่อผู้ติดต่อ :</strong> '.$finfos['c_contact'].' <strong>&nbsp;&nbsp;&nbsp;&nbsp;เบอร์โทร :</strong> '.$finfos['c_tel'].'</td>
            <td width="43%"><strong>ประเภทบริการลูกค้า :</strong> '.get_servicename($conn,$_POST['sr_ctype']).' <strong><br />
              <br />
            เลขที่สัญญา  :</strong> '.$finfos['fs_id'].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>วันที่  :</strong> '.format_date($_POST['job_open']).' <strong>&nbsp;&nbsp;<br />
            <br />
            วันครบกำหนดบริการ :</strong> '.format_date($_POST['job_balance']).'<br /><br /><strong>บริการครั้งก่อน : </strong>'.$_POST['job_last'].'&nbsp;&nbsp;<strong>บริการครั้งต่อไป  :</strong> '.format_date($_POST['sr_stime']).'</td>
          </tr>
    </table>	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
        <td width="53%"><strong>สถานที่ติดตั้ง / ส่งสินค้า : </strong>'.$finfos['loc_name'].'<br /><br />
            <strong>เครื่องล้างจาน / ยี่ห้อ : </strong> '.$_POST['loc_pro'].'<br /><br />
            <strong>รุ่นเครื่อง : </strong> '.$_POST['loc_seal'].' <strong> S/N : </strong> '.$_POST['loc_sn'].'<br /><br />
            <strong>เครื่องป้อนน้ำยา : </strong> '.$_POST['loc_clean'].'<br /><br />
            <strong>ช่างบริการประจำ : </strong> '.$tecinfos['group_name'].'&nbsp;&nbsp;&nbsp;<strong> เบอร์โทร : </strong> '.$tecinfos['group_tel'].'</td>
        <td width="47%"><strong>ปริมาณน้ำยา</strong><br /><br />
            <strong>ปริมาณน้ำยาล้าง : </strong> '.$_POST['cl_01'].' <strong> ml / rack</strong><br /><br />
            <strong>ปริมาณน้ำยาช่วยแห้ง : </strong> '.$_POST['cl_02'].' <strong>ml / rack</strong><br /><br />
            <strong>ความเข้มข้น : </strong> '.$_POST['cl_03'].' <strong>%</strong><br /><br />
            <strong>สต๊อกน้ำยา C =</strong> '.$_POST['cl_04'].' <strong>ถัง R = </strong> '.$_POST['cl_05'].' <strong>ถัง A =</strong> '.$_POST['cl_06'].' <strong>ถัง</strong><br />
            <strong><br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WG = </span></strong> '.$_POST['cl_07'].' <strong>ถัง RG = </strong> '.$_POST['cl_08'].' <strong>ถัง</strong>
        </td>
      </tr>
    </table>
	
	<table width="100%" border="0">
	  <tr>
		<td width="58%" style="font-size:11px;"><strong>รายการตรวจเช็ค</strong></td>
		<td width="42%" style="font-size:11px;"><strong>รายการแจ้งซ่อม</strong></td>
	  </tr>
	</table>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb3">
  <tr>
    <td width="58%">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%"><strong>ระบบไฟฟ้า</strong></td>
            <td width="50%"><strong>ระบบประปา</strong></td>
          </tr>
          <tr>
            <td ><img src="../images/aroow_nch.png" width="10"  border="0" alt="" />&nbsp;ตรวจเช็คชุดควบคุม</td>
            <td ><img src="../images/aroow_nch.png" width="10"  border="0" alt="" />&nbsp;ตรวจเช็คน้ำรั่ว/ซึมภายนอก</td>
          </tr>
          <tr>
            <td ><img src="../images/aroow_nch.png" width="10"  border="0" alt="" />&nbsp;ตรวจเช็ค/ขัน Terminal</td>
            <td ><img src="../images/aroow_nch.png" width="10"  border="0" alt="" />&nbsp;ถอดล้างตะแกรงกรองเศษอาหาร</td>
          </tr>
          <tr>
            <td ><img src="../images/aroow_nch.png" width="10"  border="0" alt="" />&nbsp;วัดแรงดันไฟฟ้า และกระแสไฟฟ้า</td>
            <td ><img src="../images/aroow_nch.png" width="10"  border="0" alt="" />&nbsp;ถอดล้างสแตนเนอร์ Solinoid Value</td>
          </tr>
          <tr>
            <td ><img src="../images/aroow_nch.png" width="10"  border="0" alt="" />&nbsp;ตรวจเช็ค Heater</td>
            <td ><img src="../images/aroow_nch.png" width="10"  border="0" alt="" />&nbsp;ถอดล้างแขนฉีด/หัวฉีดน้ำ</td>
          </tr>
          <tr>
            <td ><img src="../images/aroow_nch.png" width="10"  border="0" alt="" />&nbsp;ตรวจเช็คมอเตอร์</td>
            <td ><img src="../images/aroow_nch.png" width="10"  border="0" alt="" />&nbsp;ทำความสะอาดภายใน/ภายนอก</td>
          </tr>
        </table>
    </td>
    <td width="42%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  '.$sfix.'
    </table></td>
  </tr>
</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb3">
	  <tr>
	    <td width="50%"><strong>รายละเอียดการให้บริการ / ข้อเสนอแนะ</strong><br />
        <br />
        '.$_POST['detail_recom'].'
        <br /></td>
	    <td width="50%"><strong>ประเมินค่าซ่อมและบริการเบื้องต้น</strong><br />
        <br />
'.$_POST['detail_calpr'].'</td>
      </tr>
    </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb3">
	  <tr>
	    <td><strong>การรับประกันการซ่อมและการบริการตรวจเซ็คบำรุง</strong><br />
	      บริษัทฯใคร่ขอแสดงความขอบคุณแก่ท่านผู้มีอุปการะคุณที่ใช้เครื่องล้างจานและผลิตภัณฑ์ของโอเมก้าทุกท่าน ด้วยความตั้งใจอันแน่วแน่ในการบริการที่เป็นเลิศ<br />
	      ทั้งด้านสินค้าและคุณภาพในการให้การบริการด้วยความรับผิดชอบสูงสุด แผนกบริการลูกค้ายินดีรับประกันการบริการและการซ่อมบำรุงรักษา ตามรายละเอียดดังนี้<br />
        <br />
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><strong>เงื่อนไขการรับประกันการซ่อมและการบริการซ่อมบำรุง</strong><br />
              1. กรณีเครื่องเช่า รับประกันการซ่อมเปลี่ยนอะไหล่และบริการ ฟรี ตลอดสัญญา<br />
              2. กรณีขาย/สัญญาบริการ รับประกัน 1 ปี หรือตามเงื่อนไขการขาย<br />
            3. ระยะเวลาในการรับประกันงานซ่อมและบริการ 3 เดือน นับจากวันซ่อม</td>
            <td style="text-align:center;"><img src="../images/line_sf.png" width="2" height="70" border="0" /></td>
            <td><strong>ข้อยกเว้นการรับประกันการซ่อมและการบริการ</strong><br />
              1. ความเสียหายที่เกิดขึ้นจากผลของการที่ลูกค้าปฏิเสธที่จะทำตามคำแนะนำ<br />
              วิธีการใช้และการดูแลบำรุงรักษาของบริษัทฯหรือกรณีลูกค้านำวัสดุอุปกรณ์มา<br />
              ดัดแปลงเอง
              <br />
            2. การซ่อมบำรุงไม่ได้มารตฐานโดยไม่ใช่ช่างบริการหรืออะไหล่ของบริษัทฯ</td>
          </tr>
        </table></td>
      </tr>
    </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ccontact">
	  <tr>
	    <td valign="bottom" style="text-align:left;"><strong>ได้ตรวจสอบและอ่านรายละเอียดการให้บริการดังกล่าวข้างต้นเรียบร้อยแล้ว</strong></td>
	    <td valign="bottom" style="text-align:right;font-size:15px;"><strong>สายด่วน...งานบริการ 086-319-3766 </strong></td>
      </tr>
    </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong ><br />
                </strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ช่างบริการ</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............<br />
                <br />
                  เวลา............................................
                </strong></td>
              </tr>
            </table>

        </td>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">&nbsp;</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้รับบริการ</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............<br />
                  <br />
                เวลา............................................                </strong></td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">&nbsp;</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้ตรวจสอบ</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่............./.............../..............<br />
                  <br />
                เวลา............................................                </strong></td>


              </tr>
            </table>
        </td>
      </tr>
    </table>';
?>


	

	
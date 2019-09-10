<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
	

	$quinfo =get_quotation($conn,$_REQUEST['qu_id'],$_REQUEST['qu_table']);

	$checkApp1 = "uncheck.png";
	$checkApp2 = "uncheck.png";
	$checkApp3 = "uncheck.png";
	$checkApp4 = "uncheck.png";
	$checkApp5 = "uncheck.png";
	$checkApp6 = "uncheck.png";
	$checkApp7 = "uncheck.png";
	
	$dateApp1 = "";
	$dateApp2 = "";
	$dateApp3 = "";
	$dateApp4 = "";
	$dateApp5 = "";
	$dateApp6 = "";
	$dateApp7 = "";

	if($_POST['type_service'] == 1){
		$checkApp1 = "check.png";
		$dateApp1 = format_date_th($_POST['date_appoint1'],2);
	}else if($_POST['type_service'] == 2){
		$checkApp2 = "check.png";
		$dateApp2 = format_date_th($_POST['date_appoint2'],2);
	}else if($_POST['type_service'] == 3){
		$checkApp3 = "check.png";
		$dateApp3 = format_date_th($_POST['date_appoint3'],2);
	}else if($_POST['type_service'] == 4){
		$checkApp4 = "check.png";
		$dateApp4 = format_date_th($_POST['date_appoint4'],2);
	}else if($_POST['type_service'] == 5){
		$checkApp5 = "check.png";
		$dateApp5 = format_date_th($_POST['date_appoint5'],2);
	}else if($_POST['type_service'] == 6){
		$checkApp6 = "check.png";
		$dateApp6 = format_date_th($_POST['date_appoint6'],2);
	}else if($_POST['type_service'] == 7){
		$checkApp7 = "check.png";
		$dateApp7 = format_date_th($_POST['date_appoint7'],2);
	}

	$form = '<style>
	.bgheader{
		font-size:10px;
		position:absolute;
		margin-top:98px;
		padding-left:581px;
	}
	table tr td{
		vertical-align:top;
		padding:10px;
		line-height: 20px;
	}	
	.tb1{
		margin-top:5px;
	}
	.tb1 tr td{
		border:1px solid #000000;
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		padding:6px;	
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
	p.tby1{
		font-size:14px;
		font-weight:bold;
		text-align: center;
		border: 1px solid #000000;
		padding: 10px;
		background-color: #dddddd;
	}
	
	
	</style>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="text-align:right;font-size:12px;">
			<img src="../images/form/header_service_card.jpg" width="100%" border="0" />
			<div class="bgheader"><strong>'.$_POST['sv_id'].'</strong></div>
		</td>
	  </tr>
	</table>
	<table width="100%" cellspacing="0" cellpadding="0" class="tb1">
		<tr>
			<td colspan="2" style="text-align:center;background-color: #dddddd;border:1px solid #000000;font-size:14px;"><strong>ใบแจ้งงานบริการ</strong></td>
		</tr>
		
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>ชื่อลูกค้า/CUST.NAME :</strong></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;">
            	'.$quinfo['cd_name'].'
            </td>
          </tr>
		  <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>ที่อยู่/ADDRESS :</strong></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;">
            	'.$quinfo['cd_address'].'
            </td>
          </tr>
		  <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>โทรศัพท์/TEL :</strong></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;">
            	'.$quinfo['cd_tel'].'
            </td>
          </tr>
		  <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>วันที่/DATE :</strong></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;">
            	'.format_date_th($_POST['job_open'],2).'
            </td>
          </tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
        	<tr>
				<td >
					<table>
					<tr>
						<td style="border:0px solid #000000;padding:0px;"><img src="../images/'.$checkApp1.'" width="15" border="0"/></td>
						<td style="border:0px solid #000000;padding:0px;">&nbsp;&nbsp;<strong>ติดตั้งเครื่องล้างจาน</strong></td>
					</tr>
					</table>
				</td>
				<td width="20%"><center>'.$_POST['ser_pro1'].'</center></td>
				<td width="10%"><center>&nbsp;&nbsp;&nbsp;รุ่น&nbsp;&nbsp;&nbsp;</center></td>
				<td width="20%"><center>'.$_POST['ser_sn1'].'</center></td>
				<td width="24%"><strong>วันที่นัด </strong> '.$dateApp1.'</td>
        	</tr>
			<tr>
				<td >
					<table>
					<tr>
						<td style="border:0px solid #000000;padding:0px;"><img src="../images/'.$checkApp7.'" width="15" border="0"/></td>
						<td style="border:0px solid #000000;padding:0px;">&nbsp;&nbsp;<strong>ติดตั้งเครื่องล้างแก้ว</strong></td>
					</tr>
					</table>
				</td>
				<td width="20%"><center>'.$_POST['ser_pro7'].'</center></td>
				<td width="10%"><center>&nbsp;&nbsp;&nbsp;รุ่น&nbsp;&nbsp;&nbsp;</center></td>
				<td width="20%"><center>'.$_POST['ser_sn5'].'</center></td>
				<td width="24%"><strong>วันที่นัด </strong> '.$dateApp7.'</td>
        	</tr>
			<tr>
				<td >
					<table>
					<tr>
						<td style="border:0px solid #000000;padding:0px;"><img src="../images/'.$checkApp6.'" width="15" border="0"/></td>
						<td style="border:0px solid #000000;padding:0px;">&nbsp;&nbsp;<strong>ติดตั้งเครื่องผลิตน้ำแข็ง</strong></td>
					</tr>
					</table>
				</td>
				<td><center>'.$_POST['ser_pro6'].'</center></td>
				<td><center>&nbsp;&nbsp;&nbsp;รุ่น&nbsp;&nbsp;&nbsp;</center></td>
				<td><center>'.$_POST['ser_sn4'].'</center></td>
				<td><strong>วันที่นัด </strong> '.$dateApp6.'</td>
        	</tr>
			<tr>
				<td >
					<table>
					<tr>
						<td style="border:0px solid #000000;padding:0px;"><img src="../images/'.$checkApp2.'" width="15" border="0"/></td>
						<td style="border:0px solid #000000;padding:0px;">&nbsp;&nbsp;<strong>ติดตั้งเครื่องจ่ายน้ำยา</strong></td>
					</tr>
					</table>
				</td>
				<td><center>'.$_POST['ser_pro2'].'</center></td>
				<td><center>&nbsp;&nbsp;&nbsp;รุ่น&nbsp;&nbsp;&nbsp;</center></td>
				<td><center>'.$_POST['ser_sn2'].'</center></td>
				<td><strong>วันที่นัด </strong> '.$dateApp2.'</td>
        	</tr>
			<tr>
				<td >
					<table>
					<tr>
						<td style="border:0px solid #000000;padding:0px;"><img src="../images/'.$checkApp3.'" width="15" border="0"/></td>
						<td style="border:0px solid #000000;padding:0px;">&nbsp;&nbsp;<strong>ตรวจเช็คเพื่อซ่อม</strong></td>
					</tr>
					</table>
				</td>
				<td><center>'.$_POST['ser_pro3'].'</center></td>
				<td><center>&nbsp;&nbsp;&nbsp;รุ่น&nbsp;&nbsp;&nbsp;</center></td>
				<td><center>'.$_POST['ser_sn3'].'</center></td>
				<td><strong>วันที่นัด </strong> '.$dateApp3.'</td>
        	</tr>
        	<tr>
				<td >
					<table>
					<tr>
						<td style="border:0px solid #000000;padding:0px;"><img src="../images/'.$checkApp4.'" width="15" border="0"/></td>
						<td style="border:0px solid #000000;padding:0px;">&nbsp;&nbsp;<strong>ดูพื้นที่</strong></td>
					</tr>
					</table>
				</td>
				<td colspan="3"><center>'.$_POST['ser_pro4'].'</center></td>
				<td><strong>วันที่นัด </strong> '.$dateApp4.'</td>
        	</tr>
			<tr>
        		<td >
					<table>
					<tr>
						<td style="border:0px solid #000000;padding:0px;"><img src="../images/'.$checkApp5.'" width="15" border="0"/></td>
						<td style="border:0px solid #000000;padding:0px;">&nbsp;&nbsp;<strong>อื่นๆ</strong></td>
					</tr>
					</table>
				</td>
				<td colspan="3"><center>'.$_POST['ser_pro5'].'</center></td>
				<td><strong>วันที่นัด </strong> '.$dateApp5.'</td>
        	</tr>
			<tr>
        		<td><strong>ชื่อผู้ติดต่อ :</strong></td>
				<td colspan="4">'.$quinfo['c_tel'].'&nbsp;&nbsp;'.$quinfo['c_contact'].'</td>
        	</tr>
        </table>
	<table width="100%" cellspacing="0" cellpadding="0" style="text-align:left;">
		<tr>
			<td style="text-align:center;background-color: #dddddd;border:1px solid #000000;"><strong>รายละเอียดงาน</strong></td>
		</tr>
		<tr>
			<td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:left;padding:20px;border:1px solid #000000;height: 200px;">
			'.$_POST['detail_recom'].'
			</td>
		</tr>
    </table>
	
	<table width="100%" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><img src="../../upload/user/signature/'.get_sale_signature($conn,$_POST['cs_sell']).'" width="100" border="0" /></td>
              </tr>
              <tr>
                <td style="padding-top:6px;padding-bottom:6px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>( '.getsalename($conn,$_POST['cs_sell']).' )</strong><br><br><strong>ผู้แจ้งงาน</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <strong>วันที่ '.format_date_th($_POST['date_sell'],2).'</strong></td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><img src="../../upload/user/signature/'.get_hsale_signature($conn).'" width="100" border="0" /></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >( '.$_POST['cs_hsell'].' )</strong><br><br><strong>หัวหน้าฝ่ายขาย</strong></td>
              </tr>
              <tr>
              <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
              <strong>วันที่ '.format_date_th($_POST['date_hsell'],2).'</strong></td>
              </tr>
            </table>

        </td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><img src="../../upload/user/signature/'.get_technician_signature($conn,$_POST['cs_providers']).'" width="100" border="0" /></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>( '.get_technician_name($conn,$_POST['cs_providers']).' )</strong><br><br><strong>ผู้ให้บริการ</strong></td>
              </tr>
              <tr>
              <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
              <strong>วันที่ '.format_date_th($_POST['date_providers'],2).'</strong></td>
              </tr>
            </table>
        </td>
      </tr>
    </table>
	';
?>



	

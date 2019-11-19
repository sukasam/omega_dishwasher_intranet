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
	
	.tb4{
		margin-top:5px;
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
			<img src="../images/form/header_service_report4.png" width="100%" border="0" />
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
            วันที่ติดตั้ง :</strong> '.format_date($_POST['job_balance']).' &nbsp;&nbsp;&nbsp;&nbsp;<strong>วันที่ส่งงาน  :</strong> '.format_date($_POST['sr_stime']).'<br /><br><strong>เลขที่ใบงาน :</strong> '.$_POST['srid'].'</td>
          </tr>
    </table>	
	<br>
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
	
		<br>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
        <td width="4%"><strong>ลำดับ</strong></td>
        <td width="8%"><strong>Code</strong></td>
        <td width="44%"><strong>รายการ</strong></td>
        <td width="9%"><strong>หน่วยนับ</strong></td>
        <td width="9%"><strong>ราคา/หน่วย</strong></td>
        <td width="9%"><strong>จำนวนใน Stock</strong></td>
        <td width="9%"><strong>จำนวนเบิก</strong></td>
        </tr>';
		
		$sumtotal = 0;
		$total = 0;

		foreach($codes as $a => $b){
			//if($units[$a] != 0){$bunits = $units[$a];$units[$a] = number_format($units[$a]);}
			if($prices[$a] != 0){$bprices = $prices[$a];$prices[$a] = number_format($prices[$a]);}
			if($amounts[$a] != 0){$amounts[$a] = number_format($amounts[$a]);}
			if($opens[$a] != 0){$bopens = $opens[$a];$opens[$a] = number_format($opens[$a]);}
			if($remains[$a] != 0){$remains[$a] = number_format($remains[$a]);}
			if($codes[$a] != "" || $lists[$a] != ""){$sumlist = $sumlist+1;}
			
			$sumtotal = $bopens * $bprices;
			
		 $form .='<tr >
			<td><center>'.($a+1).'</center></td>
			<td>'.$codes[$a].'</td>
			<td>'.get_sparpart_name($conn,$lists[$a]).'</td>
			<td align="center">'.$units[$a].'</td>
			<td align="right">'.$prices[$a].'</td>
			<td align="right">'.$amounts[$a].'</td>
			<td align="right">'.$opens[$a].'</td>
			</tr>';
			
			if($codes[$a] != "" || $lists[$a] != ""){$total += $sumtotal;}
		}
        $form .= '<tr >
			<td colspan="4"><center><strong>รวมจำนวนที่เบิก</strong></center></td>
			<td colspan="3" align="right"><strong>'.$sumlist.'&nbsp;&nbsp;รายการ</strong></td>
		</tr>
		
        <tr >
          <td colspan="4"><center><strong>ใช้จ่ายรวม (รวมมูลค่าอะไหล่ที่เบิก)</strong></center></td>
          <td colspan="3" align="right"><strong>'.number_format($total,2).'&nbsp;&nbsp;บาท</strong></td>
          </tr>
    </table>
	
    <br>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;"  class="tb4">
      <tr>
        
		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:23px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.get_technician_name($conn,$_POST['loc_contact2']).'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ช่างเบิก</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.format_date($_POST['loc_date2']).'</td>
              </tr>
            </table>
        </td>	
		
		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.getsalename($conn,$_POST['cs_sell']).'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้จ่ายอะไหล่</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.format_date($_POST['sell_date']).'</td>
              </tr>
            </table>
        </td>
		
		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.get_technician_name($conn,$_POST['loc_contact3']).'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้อนุมัติ</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.format_date($_POST['loc_date3']).'</td>
              </tr>
            </table>
        </td>

      </tr>
    </table><br /><br />
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
        <td style="text-align:center;font-size:12px;"><strong>รูปภาพงานติดตั้ง</strong></td>
      </tr>
      <tr>
        <td style="text-align:center;font-size:12px;"><img src="../../upload/install/'.$filename.'" width="600"></td>
      </tr>
    </table>
	';
?>


	

	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
	
	$finfos = get_firstorder($conn,$_POST['fo_id']);

	$chkProcess = checkProcess($conn,$tbl_name,$PK_field,$id);

	$saleSignature = '<img src="../../upload/user/signature/'.get_sale_signature($conn,$_POST['cs_sell']).'" height="50" border="0" />';

if($chkProcess == '5'){
	
	$hSaleSignature = '<img src="../../upload/user/signature/'.get_hsale_signature($conn).'" height="50" border="0" />';
	$hCompanySignature = '<img src="../../upload/user/signature/'.get_hcompany_signature($conn).'" height="50" border="0" />';
	
}else{
	
	if($chkProcess == '0'){
		$hSaleSignature = '<img src="../../upload/user/signature/none.png" height="50" border="0" />';
		$hCompanySignature = '<img src="../../upload/user/signature/none.png" height="50" border="0" />';
	}else{
		
		$chkHSaleAP = checkHSaleApplove($conn,$tbl_name,$id);
		$chkHCompanyAP = checkHCompanyApplove($conn,$tbl_name,$id);
		
		if($chkHSaleAP == 1){
			$hSaleSignature = '<img src="../../upload/user/signature/'.get_hsale_signature($conn).'" height="50" border="0" />';
		}else{
			$hSaleSignature = '<img src="../../upload/user/signature/none.png" height="50" border="0" />';
		}
		
		if($chkHCompanyAP == 1){
			$hCompanySignature = '<img src="../../upload/user/signature/'.get_hcompany_signature($conn).'" height="50" border="0" />';
		}else{
			$hCompanySignature = '<img src="../../upload/user/signature/none.png" height="50" border="0" />';
		}
	}

}


	$form = '<style>
	p.pDate{
		text-align: right;
		font-size:15px;
	}
	p.pSubject{
		text-align: left;
		font-size:15px;
	}
	.pDetail{
		text-align: left;
		font-size:15px;
		line-height: 25px;
	}
	</style>
	<br><br><br><br><br><br>
	<p class="pDate">วันที่ '.format_date_th($_POST['memo_open'],1).'</p>
	<p class="pSubject">เรื่อง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$_POST['subject'].'</p>
	<p class="pSubject">เรียน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$_POST['dear'].'</p>
	<div class="pDetail">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.stripslashes($_POST['remark1']).'
	</div>';

$nameConpro = '<br><div class="pDetail"><table>';
	$numRow = 1;
	foreach ($_POST['chkPro'] as $key => $value) {
		
		$podName = '';
		if($finfos['pro_pod'.$value] != ''){
			$podName.= ' รุ่น '.$finfos['pro_pod'.$value];
		}
		
		$snName = '';
		if($finfos['pro_sn'.$value] != ''){
			$snName.= ' S/N '.$finfos['pro_sn'.$value];
		}
		
		$nameConpro .= "<tr>
		<td width=\"60%\">".$numRow.".&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".get_proname($conn,$finfos['cpro'.$value])." ".$podName.$snName."</td>
		<td width=\"15%\">จำนวน</td>
		<td width=\"10%\">".$finfos['camount'.$value]."</td>
		<td width=\"15%\">".get_pronamecall($conn,$finfos['cpro'.$value])."</td>
		</tr>";
		
		$numRow++;
	}
	
	foreach ($_POST['chkProfree'] as $key => $value) {
		
		$nameConpro .= "<tr>
		<td>".$numRow.".&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$finfos['cs_pro'.$value]."</td>
		<td>จำนวน</td>
		<td>".$finfos['cs_amount'.$value]."</td>
		<td>".$finfos['cs_namecall'.$value]."</td>
		</tr>";
		$numRow++;
	}

	$nameConpro .= '</table></div>';
	
	$form .= $nameConpro;
	

	if($_POST['remark4'] != ''){
		$form .= '<br><div class="pDetail" style="color: red;">
	<strong>หมายเหตุ :</strong> '.$_POST['remark4'].'
	</div>';
	}
	
	$form .='<p class="pDetail">จึงแจ้งมาเพื่อดำเนินการ</p>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;margin-top: 10px;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.$saleSignature.'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >( '.getsalename($conn,$_POST["cs_sell"]).' )</strong><br><br><strong>พนักงานขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่'.format_date_th($_POST['date_sell'],1).'</strong></td>
              </tr>
            </table>

        </td>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.$hSaleSignature.'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>( '.$_POST["cs_hsell"].' )</strong><br><br><strong>ผู้อนุมัติการขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่'.format_date_th($_POST['date_hsell'],1).'</strong></td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.$hCompanySignature.'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>( '.$_POST["cs_aceep"].' )</strong><br><br><strong>ผู้อนุมัติ</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่'.format_date_th($_POST['date_accep'],1).'</strong></td>


              </tr>
            </table>
		</td>
		</tr>
		</table>
		<p class="pDetail">CC : ฝ่ายบัญชี&nbsp;&nbsp;&nbsp;CC : ฝ่ายช่าง</p>';
	
?>



	

<?php 

	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	
	
	$fs_id = $_POST['fs_id'];
	
	$a_sdate=explode("/",$_POST['f_date']);
	$f_date = $a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	
	$cus_province = $_POST['cus_province'];
	$cus_name = $_POST['cus_name'];
	$cus_group = $_POST['cus_group'];
	$cus_grouptype = $_POST['cus_grouptype'];
	$cus_protype = $_POST['cus_protype'];
	$pro_sn = $_POST['pro_sn'];
	$pro_sr = $_POST['pro_sr'];
	$sv_fix = $_POST['sv_fix'];
	$pro_sparpart = $_POST['pro_sparpart'];
	//$price_fix = $_POST['price_fix'];
	$en_tech = $_POST['en_tech'];
	
	if($fs_id != ""){ $condition .= " AND sv_id  LIKE '%".$fs_id."'%" ;}
	if($_POST['alldate'] != 1){
		$condition .= " AND job_open = '".$f_date."'";
	}
	if($cus_province != ""){ $condition .= " AND cd_province  = '".$cus_province."'" ;}
	if($cus_name != ""){ $condition .= " AND cd_name  LIKE '%".$cus_name."%'" ;}
	if($cus_group != ""){ $condition .= " AND cg_type   = '".$cus_group."'" ;}
	if($cus_grouptype != ""){ $condition .= " AND ctype  = '".$cus_grouptype."'" ;}
	if($cus_protype != ""){ $condition .= " AND pro_type  = '".$cus_protype."'" ;}
	if($loc_seal != ""){ $condition .= " AND loc_seal  LIKE '%".$pro_sn."%'" ;}
	if($loc_sn != ""){ $condition .= " AND loc_sn  LIKE '%".$pro_sr."%'" ;}
	if($en_tech != ""){ $condition .= " AND loc_contact  LIKE '%".$en_tech."%'" ;}
	
	/*echo "SELECT sr.*,fo.* FROM s_service_report as sr, s_first_order as fo  WHERE 1 AND sr.cus_id = fo.fo_id ".$condition."  group by sv_id ORDER BY sv_id ASC";
	break;*/
	
	$qu_serfirsh = @mysqli_query($conn,"SELECT sr.*,fo.* FROM s_service_report as sr, s_first_order as fo  WHERE 1 AND sr.cus_id = fo.fo_id ".$condition."  group by sv_id ORDER BY sv_id ASC");
	$numfrish  = @mysqli_num_rows($qu_serfirsh);
	@mysqli_query($conn,"SET NAMES tis620");

	
# Example of using the WriteExcel module to create worksheet panes.
#
# reverse('ฉ'), May 2001, John McNamara, jmcnamara@cpan.org

# PHP port by Johann Hanne, 2005-11-01

set_time_limit(10);
require_once "../excel/class.writeexcel_workbook.inc.php";
require_once "../excel/class.writeexcel_worksheet.inc.php";

$fname = tempnam("/tmp", "Service-Report".date("YmdHis").".xls");
$workbook = &new writeexcel_workbook($fname);

$worksheet1 =& $workbook->addworksheet('Firsh Order');

# Frozen panes
$worksheet1->freeze_panes(1, 0); # 1 row


#######################################################################
#
# Set up some formatting and text to highlight the panes
#

$header =& $workbook->addformat();
$header->set_color('white');
$header->set_align('center');
$header->set_align('vcenter');
$header->set_pattern();
$header->set_fg_color('black');

$center =& $workbook->addformat();
$center->set_align('center');

$right =& $workbook->addformat();
$right->set_align('right');

$left =& $workbook->addformat();
$left->set_align('left');

#######################################################################
#
# Sheet 1
#

$worksheet1->set_column('A:I', 16);
$worksheet1->set_row(0, 20);
$worksheet1->set_selection('C3');

$hdtop = array("เลขที่ ใบบริการ","วันที่เปิด / ปิด ใบงาน / วันที่บริการ (วันครบกำหนดใบเปิด job)","ชื่อ/ที่อยู่/โทร","กลุ่มลูกค้า","ประเภทการขาย","ชนิดเครื่อง / รุ่น / หมายเลข","วันที่เริ่มสัญญา /หมดสัญญา","อาการเสีย (รายการแจ้งซ่อม)","รายการอะไหล่ที่เปลี่ยน","ราคาประเมินการซ่อม","ช่างซ่อม (ช่างบริการประจำ)");

for ($i=0;$i<=10;$i++) {
    $worksheet1->write(0, $i, $hdtop[$i], $header);
}


$row_ex = 1;
while($row_serreport = @mysqli_fetch_array($qu_serfirsh)){

	$serreportinfo = get_servicereport($conn,$row_serreport['sv_id']);
	$firshoinfo = get_firstorder($conn,$row_serreport['cus_id']);
	
	$spaimfo1 = get_sparpart($conn,$serreportinfo['cpro1']);
	$spaimfo2 = get_sparpart($conn,$serreportinfo['cpro2']);
	$spaimfo3 = get_sparpart($conn,$serreportinfo['cpro3']);
	$spaimfo4 = get_sparpart($conn,$serreportinfo['cpro4']);
	$spaimfo5 = get_sparpart($conn,$serreportinfo['cpro5']);
	
	$totalprice = ($serreportinfo['camount1'] * $serreportinfo['cprice1']) + ($serreportinfo['camount2'] * $serreportinfo['cprice2']) + ($serreportinfo['camount3'] * $serreportinfo['cprice3']) + ($serreportinfo['camount4'] * $serreportinfo['cprice4']) + ($serreportinfo['camount5'] * $serreportinfo['cprice5']);
	
	if($serreportinfo['loc_pro'] != ""){$loc_pro = $serreportinfo['loc_pro'];}else{$loc_pro = " - ";}
	if($serreportinfo['loc_seal'] != ""){$loc_seal = $serreportinfo['loc_seal'];}else{$loc_seal = " - ";}
	if($serreportinfo['loc_sn'] != ""){$loc_sn = $serreportinfo['loc_sn'];}else{$loc_sn = " - ";}
		
	$worksheet1->write($row_ex, 0, $serreportinfo['sv_id'], $center);
	$worksheet1->write($row_ex, 1, "( ".format_date($serreportinfo['job_open']).") / (".format_date($serreportinfo['job_close'])." ) / (".format_date($serreportinfo['job_balance'])." )", $center);
	$worksheet1->write($row_ex, 2, "( ".$firshoinfo['cd_name']." ) / ( ".$firshoinfo['cd_address']." ) / ( ".$firshoinfo['cd_tel']." )", $left);
	$worksheet1->write($row_ex, 3, get_groupcusname($conn,$firshoinfo['cg_type']), $left);
	$worksheet1->write($row_ex, 4, get_servicename($conn,$serreportinfo['sr_ctype']), $left);
	$worksheet1->write($row_ex, 5, $loc_pro." / ".$loc_seal." / ".$loc_sn, $left);
	$worksheet1->write($row_ex, 6, "(".format_date($firshoinfo['date_quf']).") / (".format_date($firshoinfo['date_qut']).")", $center);
	
	$numfixs = get_numfixs($conn,$row_serreport['sr_id']);
	$listfixs = get_listfixs($conn,$row_serreport['sr_id']);
	
	for($by=0;$by<sizeof($listfixs);$by++){
		$worksheet1->write($row_ex+$by, 7, get_fixname($conn,$listfixs[$by]), $left);
	}
	
	$numspartpart = get_numspapartsall($conn,$row_serreport['sr_id']);
	$psspartpart = get_prospapart($conn,$row_serreport['sr_id']);
	
	for($i=0;$i<=sizeof($psspartpart);$i++){
		$worksheet1->write($row_ex+$i, 8, get_sparpart_name($conn,$psspartpart[$i]), $left);
	}
	
	$worksheet1->write($row_ex, 9, number_format($totalprice,2), $right);
	$worksheet1->write($row_ex, 10, $serreportinfo['loc_contact'], $left);
	
	if($numspartpart >= $numfixs){
		$row_ex = $row_ex + $numspartpart + 1;
	}else{
		$row_ex = $row_ex + $numfixs + 1;
	}
}


$workbook->close();

header("Content-Type: application/x-msexcel; name=\"Service-Report-".date("YmdHis").".xls\"");
header("Content-Disposition: inline; filename=\"Service-Report-".date("YmdHis").".xls\"");
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);

?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />



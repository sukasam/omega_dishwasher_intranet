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
	
	$condition = "";
	if($fs_id != ""){ $condition .= " AND fs_id  LIKE '%".$fs_id."%'" ;}
	if($_POST['alldate'] != 1){
		$condition .= " AND date_forder = '".$f_date."'" ;	
	}
	if($cus_province != ""){ $condition .= " AND cd_province  = '".$cus_province."'" ;}
	if($cus_name != ""){ $condition .= " AND cd_name  LIKE '%".$cus_name."%'" ;}
	if($cus_group != ""){ $condition .= " AND cg_type   = '".$cus_group."'" ;}
	if($cus_grouptype != ""){ $condition .= " AND ctype  = '".$cus_grouptype."'" ;}
	if($cus_protype != ""){ $condition .= " AND pro_type  = '".$cus_protype."'" ;}
	/*if($fs_id != ""){ $condition .= " AND pro_type  = '".$pro_sn."'" ;}
	if($fs_id != ""){ $condition .= " AND pro_type  = '".$pro_sr."'" ;}*/
	
	$qu_serfirsh = @mysqli_query($conn,"SELECT * FROM s_first_order WHERE 1 ".$condition." ORDER BY fs_id ASC");
	$numfrish  = @mysqli_num_rows($qu_serfirsh);
	@mysqli_query($conn,"SET NAMES tis620");
	
	# Example of using the WriteExcel module to create worksheet panes.
#
# reverse('ฉ'), May 2001, John McNamara, jmcnamara@cpan.org

# PHP port by Johann Hanne, 2005-11-01

set_time_limit(10);
require_once "../excel/class.writeexcel_workbook.inc.php";
require_once "../excel/class.writeexcel_worksheet.inc.php";

$fname = tempnam("/tmp", "Firsh-Order".date("YmdHis").".xls");
$workbook = &new writeexcel_workbook($fname);

$worksheet1 =& $workbook->addworksheet('First Order');

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

$hdtop = array("เลขที่ First Order","วันที่","ชื่อ/ที่อยู่/โทร","กลุ่มลูกค้า","ชนิดเครื่อง / รุ่น / หมายเลข","จำนวน","ราคาขาย / ค่าเช่า","ประเภทการขาย","วันที่เริ่มสัญญา /หมดสัญญา","วันที่ติดตั้ง","ขนส่ง (ขนส่งโดย)","สถานที่ติดตั้ง","ผู้ขาย (พนักงานขาย)");

for ($i=0;$i<=12;$i++) {
    $worksheet1->write(0, $i, $hdtop[$i], $header);
}

$row_ex = 1;
while($row_serfirsh = @mysqli_fetch_array($qu_serfirsh)){

	$firshoinfo = get_firstorder($conn,$row_serfirsh['fo_id']);
	
	$a_sdate=explode("-",$firshoinfo['date_forder']);
	$date_forder=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
	
	$worksheet1->write($row_ex, 0, $firshoinfo['fs_id'], $center);
	$worksheet1->write($row_ex, 1, $date_forder, $center);
	$worksheet1->write($row_ex, 2, "( ".$firshoinfo['cd_name']." ) / ( ".$firshoinfo['cd_address']." ) / ( ".$firshoinfo['cd_tel']." )", $left);
	$worksheet1->write($row_ex, 3, get_groupcusname($conn,$firshoinfo['cg_type']), $left);
	
	$numprosall = get_numprosall($conn,$firshoinfo['fo_id']);
	$prosall = get_profirsod($conn,$firshoinfo['fo_id']);
	$nprosall = get_numprofirsod($conn,$firshoinfo['fo_id']);
	
	for($ui = 0; $ui < sizeof($prosall); $ui++){
		$worksheet1->write($row_ex+$ui, 4, get_rpfprosrsn($prosall[$ui]), $left);	
	}
		
	for($bi = 0; $bi < sizeof($nprosall); $bi++){
		$worksheet1->write($row_ex+$bi, 5, $nprosall[$bi], $right);
	}
	
	$worksheet1->write($row_ex, 6, number_format(get_totalprice($conn,$firshoinfo["fo_id"]),2), $right);
	$worksheet1->write($row_ex, 7, custype_name($conn,$firshoinfo['ctype']), $center);
	$worksheet1->write($row_ex, 8, "(".format_date($firshoinfo['date_quf']).") / (".format_date($firshoinfo['date_qut']).")", $center);
	$worksheet1->write($row_ex, 9, format_date($firshoinfo['cs_setting']), $center);
	$worksheet1->write($row_ex, 10, $firshoinfo['loc_shopping'], $left);
	$worksheet1->write($row_ex, 11, $firshoinfo['loc_name'], $left);
	$worksheet1->write($row_ex, 12, $firshoinfo['cs_sell'], $left);
	
	$row_ex = $row_ex + $numprosall + 1;
}


$workbook->close();

header("Content-Type: application/x-msexcel; name=\"Firsh-Order-".date("YmdHis").".xls\"");
header("Content-Disposition: inline; filename=\"Firsh-Order-".date("YmdHis").".xls\"");
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);
	
?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
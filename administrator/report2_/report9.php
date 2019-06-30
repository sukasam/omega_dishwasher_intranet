<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	$cd_province = $_REQUEST['cd_province'];
	$sr_ctype = $_REQUEST['sr_ctype'];
	$a_sdate=explode("/",$_REQUEST['date_fm']);
	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	$a_sdate=explode("/",$_REQUEST['date_to']);
	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	
	if($_REQUEST['priod'] == 0){
		$daterriod = " AND `sr_stime`  between '".$date_fm."' and '".$date_to."'"; 
		$dateshow = "เริ่มวันที่ : ".format_date($conn,$date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($conn,$date_to); 
	}
	else{
		$dateshow = "วันที่ค้นหา : ".format_date($conn,date("Y-m-d")); 
	}
	
	$condition = " AND fr.cd_province = '".$cd_province."'";
	
	if($sr_ctype != ""){
		$condition .= " AND sv.sr_ctype = '".$sr_ctype."'";
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>เลือกตามเขต / จังหวัด ( <?php  echo province_name($conn,$cd_province);?> )</title>
<style type="text/css">
 .tbreport{
 	font-size:10px;
 }
 .tbreport th{
	font-weight:bold;
	text-align:left;
	border-bottom:1px solid #000000;
	padding:5;
 }
 .tbreport td{
	 padding:5px;
	 vertical-align:top;
	 border-bottom:1px solid #000000;
 }
</style>
</head>

<body>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
	  <tr>
	    <th colspan="2" style="text-align:left;font-size:12px;">บริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด<br />
รายงานตามเขต / จังหวัด ( <?php  echo province_name($conn,$cd_province);?> )<br />
ประเภทลูกค้า  :
<?php  if($_POST['ctype'] != ""){echo custype_name($conn,$_POST['ctype']);}else{echo "ทั้งหมด";}?>
<br />
ประเภทบริการ  :
<?php  if($_POST['sr_ctype']){echo get_servicename($conn,$_POST['sr_ctype']);}else{echo "ทั้งหมด";}?></th>
	    <th colspan="6" style="text-align:right;font-size:11px;"><?php  echo $dateshow;?></th>
      </tr>
      <tr>
        <th width="21%">ชื่อลูกค้า / บริษัท + เบอร์โทร</th>
        <th width="26%">ชื่อร้าน / สถานที่ติดตั้ง</th>
        <th width="19%">จังหวัด</th>
        <th width="19%">กลุ่มลูกค้า</th>
        <th width="15%">ประเภทลูกค้า</th>
      </tr>
      <?php  
		$sql = "SELECT * FROM s_first_order as fr, s_service_report as sv WHERE sv.cus_id = fr.fo_id ".$condition." ".$daterriod." ORDER BY fr.cd_name ASC";
	  	$qu_fr = @mysqli_query($conn,$sql);
		$sum = 0;
		while($row_fr = @mysqli_fetch_array($qu_fr)){
			?>
			<tr>
              <td><?php  echo $row_fr['cd_name'];?><br />
              <?php  echo $row_fr['cd_tel'];?></td>
              <td><?php  echo $row_fr['loc_name'];?><br />
              <?php  echo $row_fr['loc_address'];?></td>
              <td><?php  echo province_name($conn,$row_fr['cd_province']);?></td>
              <td><?php  echo get_groupcusname($conn,$row_fr['cg_type']);?></td>
              <td><?php  echo custype_name($conn,$row_fr['sr_ctype']);?></td>
            </tr>
			<?php 
			$sum += 1;
		}
	  ?>
      <tr>
		<td colspan="5" style="text-align:right;"> <strong>ให้บริการตามตามเขต / จังหวัดทั้งหมด&nbsp;&nbsp;<?php  echo $sum;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>
	  </tr>
    </table>

</body>
</html>
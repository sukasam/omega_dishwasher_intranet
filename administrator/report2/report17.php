<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission ($check_module,$_SESSION[login_id],"read");
	if ($_GET[page] == ""){$_REQUEST[page] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	$loc_contact = $_REQUEST['loc_contact'];
	$a_sdate=explode("/",$_REQUEST['date_fm']);
	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	$a_sdate=explode("/",$_REQUEST['date_to']);
	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	
	if($_REQUEST['priod'] == 0){
		$daterriod = " AND `detail3`  between '".$date_fm."' and '".$date_to."'"; 
		$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($date_to); 
	}
	else{
		$dateshow = "วันที่ค้นหา : ".format_date(date("Y-m-d")); 
	}
	
	if($loc_contact != ""){
		$condition = "AND (technician1 = '".$loc_contact."' OR technician2 = '".$loc_contact."' OR technician3 = '".$loc_contact."' OR technician4 = '".$loc_contact."' OR technician5 = '".$loc_contact."' OR technician6 = '".$loc_contact."' OR technician7 = '".$loc_contact."' OR technician8 = '".$loc_contact."')";
	}
	
	
	$sql = "SELECT * FROM s_service_cost WHERE 1 ".$daterriod." ".$condition." ORDER BY detail1 ASC";

	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>เลือก ST/OT/PD/HD ตามชื่อช่าง ( <?php  if($loc_contact != ""){echo $loc_contact;}else{echo "ทั้งหมด";}?>)</title>
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
        รายงาน ST/OT/PD/HD ตามชื่อช่าง ( <?php  if($loc_contact != ""){echo get_technician_name($loc_contact);}else{echo "ทั้งหมด";}?> )</th>
	    <th colspan="6" style="text-align:right;font-size:11px;"><?php  echo $dateshow;?></th>
      </tr>
      <tr>
        <th>เลขที่ใบงาน</th>
        <th>ชื่อร้าน / สถานที่ติดตั้ง</th>
        <th>วันที่บริการ</th>
        <th style="text-align:right;font-size:12px;">ค่าติดตั้ง</th>
        <th style="text-align:right;font-size:12px;">ค่าโอที</th>
        <th style="text-align:right;font-size:12px;">ค่าเบี้ยเลี้ยง</th>
        <th style="text-align:right;font-size:12px;">ค่าวันหยุด</th>
      </tr>
      <?php  
	  	$qu_sr = @mysql_query($sql);
		$sum = 0;
		$sumST = 0;
		$sumOT = 0;
		$sumPD = 0;
		$sumHD = 0;
		$sumTotal = 0;
		$datSV = 1;
		while($row_sr = @mysql_fetch_array($qu_sr)){
			
			
			$row_srv = mysql_fetch_array(mysql_query("SELECT * FROM s_service_report WHERE sr_id= '".$row_sr['job_id']."'"));
			
			$row_fr = mysql_fetch_array(mysql_query("SELECT * FROM s_first_order WHERE fo_id= '".$row_srv['cus_id']."'"));
			
			$numTechnician = get_number_technician_cost($row_sr['job_id']);
			
			if($row_sr['detail3_1'] != ""){
				$datSV = $row_sr['detail3_1'];
			}else{
				$datSV = 1;
			}
			
			//if($loc_contact != ""){
				if($row_sr['setup'] > 0 && $numTechnician > 0){
					if($loc_contact != ""){
						//$setupCost = ($row_sr['setup']/$numTechnician) * $datSV;
						$setupCost = ($row_sr['setup']/$numTechnician);
					}else{
						//$setupCost = $row_sr['setup']* $datSV;
						$setupCost = $row_sr['setup'];
					}
				}else{
					if($row_sr['setup'] != ""){
						//$setupCost = $row_sr['setup'] * $datSV;
						$setupCost = $row_sr['setup'];
					}else{
						$setupCost = 0;
					}
				}
			//}
			
			
//			if($row_sr['setup'] > 0){
//				if($numTechnician > 0){
//					$setupCost = ($row_sr['setup'] / $numTechnician) * $datSV;
//				}else{
//					$setupCost = 0;
//				}
//			}else{
//				$setupCost = 0;
//			}
			
//			echo $row_sr['detail1']."".$setupCost." ".$row_sr['setup']." ".$numTechnician." (".$row_sr['setup'] / $numTechnician.")<br>";

			$sumST = $sumST+$setupCost;
			
			if($row_sr['ot'] == 0){
				if($row_sr['ot_1'] != ""){
					//$otCost = $row_sr['ot_1'] * $datSV;
					$otCost = $row_sr['ot_1'];
				}else{
					$otCost = 0;
				}
			}
			
			if($row_sr['ot'] != 0){
				//$otCost = $row_sr['ot'] * $datSV;
				$otCost = $row_sr['ot'];
			}
			
			if($row_sr['ot'] == ""){
				$otCost = 0;
			}
			
			$sumOT = $sumOT+$otCost;
			
			if($row_sr['ot_1'] != ""){
				$hdCost = $row_sr['ot_1'] * $datSV;
			}else{
				$hdCost = 0;
			}
			
			 $sumHD = $sumHD+$hdCost;
			
			if($row_sr['pd'] != ""){
				$pdCost = $row_sr['pd'] * $datSV;
			}else{
				$pdCost = 0;
			}
			$sumPD = $sumPD+$pdCost;
		    
			?>
			<tr>
              <td><?php echo $row_sr['detail1']?></td>
              <td><?php  if($row_fr['loc_name'] != ""){echo $row_fr['loc_name'];}else{echo $row_fr['cd_name'];}?><br />
              <?php  echo $row_fr['loc_address'];?></td>
              <td><?php  echo $row_sr['detail3'];?></td>
              <td style="padding:0;text-align: right;"><?php  echo number_format($setupCost,2);?></td>
              <td style="text-align: right;"><?php echo number_format($otCost,2);?></td>
              <td style="text-align: right;"><?php echo number_format($pdCost,2);?></td>
              <td style="text-align: right;"><?php echo number_format($hdCost,2);?></td>
            </tr>
 
			
			<?php 
			$sum += 1;
			
		}
		
		$sumTotal = $sumST+$sumOT+$sumPD+$sumHD;
		
	  ?>
     <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th style="text-align:right;font-size:12px;">ค่าติดตั้ง = <?php echo number_format($sumST,2);?></th>
        <th style="text-align:right;font-size:12px;">ค่าโอที = <?php echo number_format($sumOT,2)?></th>
        <th style="text-align:right;font-size:12px;">ค่าเบี้ยเลี้ยง = <?php echo number_format($sumPD,2);?></th>
        <th style="text-align:right;font-size:12px;">ค่าวันหยุด = <?php echo number_format($sumHD,2);?></th>
      </tr>
      <tr>
		<td colspan="7" style="text-align:right;"> <strong>รวมเงินทั้งหมด&nbsp;&nbsp;<?php  echo number_format($sumTotal,2);?>&nbsp;&nbsp;บาท&nbsp;&nbsp;</strong></td>
	  </tr>
	  <tr>
		<td colspan="7" style="text-align:right;"> <strong>ทั้งหมด&nbsp;&nbsp;<?php  echo $sum;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>
	  </tr>
    </table>

</body>
</html>
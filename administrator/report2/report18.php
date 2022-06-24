<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
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
	
	$sql = "SELECT * FROM s_service_cost WHERE 1 ".$daterriod." ORDER BY detail3 ASC";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>สรุปค่าใช้จ่ายงานบริการ</title>
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
        รายงานสรุปค่าใช้จ่ายงานบริการ</th>
	    <th colspan="6" style="text-align:right;font-size:11px;"><?php  echo $dateshow;?></th>
      </tr>
      <?php  
		
	  	$qu_sr = @mysqli_query($conn,$sql);
		$sum = 0;
		$sumDetail7 = 0;
		$sumDetail8 = 0;
		while($row_sr = @mysqli_fetch_array($qu_sr)){
			
			
			$row_srv = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM s_service_report WHERE sr_id= '".$row_sr['job_id']."'"));
			
			$row_fr = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM s_first_order WHERE fo_id= '".$row_srv['cus_id']."'"));
			
			//$numTechnician = get_number_technician_cost($conn,$row_sr['job_id']);
			
			
			if($row_sr['setup'] == ""){
				//$sumsetup = $row_sr['setup'] * $row_sr['detail3_1'];
				$sumsetup = $row_sr['setupP'];
			}else{
				$sumsetup = $row_sr['setup'];
			}
			
			if($row_sr['ot'] != ""){
				//$sumOT = $row_sr['ot'] * $row_sr['detail3_1'];
				$sumOT = $row_sr['ot'];
			}else{
				$sumOT = 0;
			}
			if($row_sr['ot_1'] != ""){
				$sumOT1 = $row_sr['ot_1'] * $row_sr['detail3_1'];
			}else{
				$sumOT1 = 0;
			}
			if($row_sr['pd'] != ""){
				$sumPD = $row_sr['pd'] * $row_sr['detail3_1'];
			}else{
				$sumPD = 0;
			}
			
			$sumDetail7 = $row_sr['cost_other1']+$row_sr['cost_other2']+$row_sr['cost_other3']+$row_sr['cost_other4']+$row_sr['cost_other5']+$row_sr['cost_other6']+$row_sr['cost_other7']+$row_sr['cost_other8']+$row_sr['cost_other10']+$row_sr['cost_other12']+$row_sr['cost_other13']+$sumsetup+$sumOT+$sumOT1+$sumPD;
			
			$detail7 = $sumDetail7;
			
			$sumDetail8 = $detail7 - $row_sr['detail6'];
			
			//echo $sumDetail8." mkung";
			
			if($sumDetail8 <= 0){
				$detail8 = str_replace('-','',$sumDetail8);
				$detail9 = "0.00";
			}else{
				$detail9 = str_replace('-','',$sumDetail8);
				$detail8 = "0.00";
			}
			
			?>
			<tr>
				<th>เลขที่ใบงาน</th>
				<th>ชื่อร้าน / สถานที่ติดตั้ง</th>
				<th>วันที่บริการ</th>
				<th style="text-align: right;">เข้ารับบริการ</th>
			  </tr>
			<tr>
              <td><?php echo $row_sr['detail1']?></td>
              <td><?php  if($row_fr['loc_name'] != ""){echo $row_fr['loc_name'];}else{echo $row_fr['cd_name'];}?><br />
              <?php  echo $row_fr['loc_address'];?></td>
              <td><?php  echo $row_sr['detail3'];?></td>
              <td style="text-align: right;"><?php  if($row_sr['detail3_1'] == ""){echo "1 วัน";}else{echo $row_sr['detail3_1']." วัน";}?></td>
            </tr>
 
 			<tr>
				<td colspan="3"><strong>รายการ</strong></td>
				<td style="text-align: right;"><strong>ยอดเงิน</strong></td>
			</tr>
			<tr>
				<td colspan="3"><strong>ค่าติดตั้ง (ถอด/เปลี่ยน/ย้าย)</strong></td>
				<td style="text-align: right;"><?php echo number_format($sumsetup,2);?></td>
			</tr>
			<tr>
				<td colspan="3"><strong>ค่าล่วงเวลา</strong></td>
				<td style="text-align: right;"><?php echo number_format($sumOT,2);?></td>
			</tr>
			<tr>
				<td colspan="3"><strong>ค่าเบี้ยเลี้ยง</strong></td>
				<td style="text-align: right;"><?php echo number_format($sumPD,2)?></td>
			</tr>
			<tr>
				<td colspan="3"><strong>ค่าเวรวันหยุด</strong></td>
				<td style="text-align: right;"><?php echo number_format($sumOT1,2);?></td>
			</tr>
			<tr>
				<td colspan="3"><strong>ค่าแก็ส</strong></td>
				<td style="text-align: right;"><?php echo number_format($row_sr['cost_other1'],2);?></td>
			</tr>
			<tr>
				<td colspan="3"><strong>ค่าน้ำมัน</strong></td>
				<td style="text-align: right;"><?php echo number_format($row_sr['cost_other2'],2);?></td>
			</tr>
			<tr>
				<td colspan="3"><strong>ค่าทางด่วน</strong></td>
				<td style="text-align: right;"><?php echo number_format($row_sr['cost_other3'],2);?></td>
			</tr>
			<tr>
				<td colspan="3"><strong>ค่าจอดรถ</strong></td>
				<td style="text-align: right;"><?php echo number_format($row_sr['cost_other4'],2);?></td>
			</tr>
			<tr>
				<td colspan="3"><strong>ค่าที่พัก</strong></td>
				<td style="text-align: right;"><?php echo number_format($row_sr['cost_other5'],2);?></td>
			</tr>
			<tr>
				<td colspan="3"><strong>ค่ารับรอง</strong></td>
				<td style="text-align: right;"><?php echo number_format($row_sr['cost_other6'],2);?></td>
			</tr>
			<tr>
				<td colspan="3"><strong>ค่าปรับ/ค่าธรรมเนียม</strong></td>
				<td style="text-align: right;"><?php echo number_format($row_sr['cost_other7'],2);?></td>
			</tr>
			<tr>
				<td colspan="3"><strong>ค่าอุปกรณ์/อะไหล่</strong> <?php if($row_sr['cost_other9'] != ""){echo "(".$row_sr['cost_other9'].")";};?></td>
				<td style="text-align: right;"><?php echo number_format($row_sr['cost_other8'],2);?></td>
			</tr>
			<tr>
				<td colspan="3"><strong>ค่าพาหนะ</strong> <?php if($row_sr['cost_other11'] != ""){echo "(".$row_sr['cost_other11'].")";};?></td>
				<td style="text-align: right;"><?php echo number_format($row_sr['cost_other10'],2);?></td>
			</tr>
			<tr>
				<td colspan="3"><strong>ค่าจัดส่ง/ค่าขนส่ง</strong></td>
				<td style="text-align: right;"><?php echo number_format($row_sr['cost_other12'],2);?></td>
			</tr>
			<tr>
				<td colspan="3"><strong>ค่าอื่นๆ</strong> <?php if($row_sr['cost_other14'] != ""){echo "(".$row_sr['cost_other14'].")";};?></td>
				<td style="text-align: right;"><?php echo number_format($row_sr['cost_other13'],2);?></td>
			</tr>
			<tr>
				<td colspan="3"><strong>จำนวนเงินที่เบิกล่วงหน้า</strong></td>
				<td style="text-align: right;"><strong><?php echo number_format($row_sr['detail6'],2);?></strong></td>
			</tr>
			<tr>
				<td colspan="3"><strong>รวมค่าใช้จ่ายทั้งสิ้น</strong></td>
				<td style="text-align: right;"><strong><?php echo number_format($sumDetail7,2);?></strong></td>
			</tr>
			<tr>
				<td colspan="3"><strong>จำนวนเงินที่ต้องคืนบริษัท</strong></td>
				<td style="text-align: right;"><strong><?php echo number_format($detail8,2);?></strong></td>
			</tr>
			<tr>
				<td colspan="3"><strong>จำนวนเงินที่บริษัทต้องจ่ายเพิ่ม</strong></td>
				<td style="text-align: right;"><strong><?php echo number_format($detail9,2);?></strong></td>
			</tr>

			<tr>
				<td colspan="4" style="padding-bottom: 30px;">&nbsp;</td>
			</tr>
			<?php 
			$sum += 1;
			
		}
		
		
		
	  ?>
    </table>

</body>
</html>
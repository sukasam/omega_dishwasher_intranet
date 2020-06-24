<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	$contact_status = $_REQUEST['contact_status'];
	$a_sdate=explode("/",$_REQUEST['date_fm']);
	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	$a_sdate=explode("/",$_REQUEST['date_to']);
	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	
	if($_REQUEST['priod'] == 0){
		$daterriod = " AND `con_enddate`  between '".$date_fm."' and '".$date_to."'"; 
		$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($date_to); 
	}
	else{
		$dateshow = "วันที่ค้นหา : ".format_date(date("Y-m-d")); 
	}

	// $condi = '';

	// if($order_status != ""){
	// 	$condi = " AND `st_setting`  = '".$order_status."'"; 
	// }
	
	// $codi = " AND status_use = 0";
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานวันหมดอายุสัญญา <?php if($contact_status == 1){echo "(สัญญาเช่า)";}else{echo "(สัญญาบริการ)";}?></title>
<style type="text/css">
 .tbreport{
 	font-size:10px;
 }
 .tbreport th{
	font-weight:bold;
	text-align:left;
	border-bottom:1px solid #000000;
	padding:5;
	text-align: center;
	/* white-space: nowrap; */
	
 }
 .tbreport td{
	 padding:5px;
	 vertical-align:top;
	 border-bottom:1px solid #000000;
	 /* white-space: nowrap; */
	 text-align: center;
 }
</style>
</head>

<body>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
	  <tr>
	    <th colspan="6" style="text-align:left;font-size:12px;">บริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด<br />
        รายงานวันหมดอายุสัญญา <?php if($contact_status == 1){echo "(สัญญาเช่า)";}else{echo "(สัญญาบริการ)";}?></th>
	    <th colspan="11" style="text-align:right;font-size:11px;"><?php  echo $dateshow;?></th>
      </tr>
      <tr>
		<th>No.</th>
		<th>เลขที่สัญญา</th>
		<th>ชื่อบริษัท</th>
		<th>ชื่อร้าน/สถานที่ตั้ง</th>
		<th>เครื่องรุ่น</th>
		<th>S/N</th>
		<th>ค่าขนส่ง/ค่าติดตั้ง</th>
		<th>เงินประกัน</th>
		<!-- <th>VAT</th> -->
		<th>ค่าเช่า</th>
		<th>จำนวนเครื่อง</th>
		<th style="white-space: nowrap;">เริ่มสัญญา</th>
		<th style="white-space: nowrap;">สิ้นสุดสัญญา</th>
		<th>บุคคลติดต่อ</th>
		<th>โทร</th>
		<th>ประเภทลูกค้า</th>
		<!-- <th>หมายเหตุ</th> -->
      </tr>
	  <?php  
		  
		$tableDB = '';
		if($contact_status == 2){
			$tableDB = 's_contract2';
		}else{
			$tableDB = 's_contract';
		}

		$sql = "SELECT * FROM ".$tableDB." WHERE 1 ".$daterriod." ORDER BY con_enddate ASC";
	  	$qu_fr = @mysqli_query($conn,$sql);
		$sum = 0;
		while($row_fr = @mysqli_fetch_array($qu_fr)){
			$foInfo = get_firstorder($conn, $row_fr['cus_id']);
			$money_setup = 0;
			$money_garuntree = 0;
			if($foInfo['notvat1'] == 2){
				$money_setup = $foInfo['money_setup'] * 1.07;
			}else{
				$money_setup = $foInfo['money_setup'];
			}

			if($foInfo['notvat2'] == 2){
				$money_garuntree = $foInfo['money_garuntree'] * 1.07;
			}else{
				$money_garuntree = $foInfo['money_garuntree'];
			}

			?>
			<tr>
				<td><?php echo ($sum+1);?></td>
				<td style="white-space: nowrap;"><?php echo $row_fr['con_id'];?></td>
				<td style="text-align: left;"><?php echo $foInfo['cd_name'];?></td>
				<td style="text-align: left;"><?php echo $foInfo['loc_name'];?></td>
				<td><?php echo $foInfo['pro_pod1'];?></td>
				<td><?php echo $foInfo['pro_sn1'];?></td>
				<td><?php echo number_format($money_setup,2);?></td>
				<td><?php echo number_format($money_garuntree,2);?></td>
				<!-- <td></td> -->
				<td><?php echo number_format($foInfo['cprice1'],2);?></td>
				<td><?php echo $foInfo['camount1'];?></td>
				<td style="white-space: nowrap;"><?php echo format_date_th($row_fr['con_startdate'], 6);?></td>
				<td style="white-space: nowrap;"><?php echo format_date_th($row_fr['con_enddate'], 6);?></td>
				<td><?php echo $foInfo['c_contact'];?></td>
				<td><?php echo $foInfo['c_tel'];?></td>
				<td><?php echo custype_name($conn, $foInfo['ctype']);?></td>
				<!-- <td></td> -->
            </tr>
			
			<?php 
			$sum += 1;
		}
	  ?>
       <tr>
		<td colspan="17" style="text-align:right;"> <strong>ทั้งหมด&nbsp;&nbsp;<?php  echo $sum;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>
	  </tr>
    </table>

</body>
</html>
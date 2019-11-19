<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	if(isset($_GET['pro_pod'])){$_REQUEST['sh1'] = 1;$_REQUEST['sh2'] = 1;$_REQUEST['sh3'] = 1;$_REQUEST['sh4'] = 1;$_REQUEST['sh5'] = 1;$_REQUEST['sh6'] = 1;$_REQUEST['sh7'] = 1;$_REQUEST['sh8'] = 1;$_REQUEST['sh9'] = 1;$_REQUEST['sh10'] = 1;}
	
	$pro_pod = $_REQUEST['pro_pod'];
	$a_sdate=explode("/",$_REQUEST['date_fm']);
	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	$a_sdate=explode("/",$_REQUEST['date_to']);
	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	
	if($_REQUEST['priod'] == 0){
		$daterriod = " AND `job_open`  between '".$date_fm."' and '".$date_to."'"; 
		$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($date_to); 
	}
	else{
		$dateshow = "วันที่ค้นหา : ".format_date(date("Y-m-d")); 
	}
	
	if($pro_pod != ""){
		$condition = "AND (loc_seal = '".$pro_pod."')";
	}
	
	
	$sql = "SELECT * FROM s_service_report WHERE 1 ".$daterriod." ".$condition." ORDER BY job_open ASC";

	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>เลือกตามรุ่นเครื่อง ( <?php  if($pro_pod != ""){echo $pro_pod;}else{echo "ทั้งหมด";}?>)</title>
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
        รายงานตามรุ่นเครื่อง ( <?php  if($pro_pod != ""){echo $pro_pod;}else{echo "ทั้งหมด";}?> )</th>
	    <th colspan="6" style="text-align:right;font-size:11px;"><?php  echo $dateshow;?></th>
      </tr>
      <tr>
        
        <?php  if($_REQUEST['sh2'] == 1){?><th width="20%">ชื่อร้าน / สถานที่ติดตั้ง</th><?php  }?>
        <?php  if($_REQUEST['sh4'] == 1){?><th width="9%">ประเภทลูกค้า</th><?php  }?>
        <th style="text-align:center;font-size:12px;">รุ่น / SN</th>
        <th style="text-align:center;font-size:12px;">รายการอะไหล่</th>
        <th style="text-align:center;font-size:12px;">สาเหตุที่เปลี่ยน</th>
      </tr>
      <?php  
	  	$qu_sr = @mysqli_query($conn,$sql);
		$sum = 0;
		while($row_sr = @mysqli_fetch_array($qu_sr)){
			
			$row_fr = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM s_first_order WHERE fo_id= '".$row_sr['cus_id']."'"));
			
			/*$replace1 = str_replace("LP","LP ",$row_sr['srid2']);
			$replace2 = str_replace("LP  ","LP ",$replace1);*/
			
			$row_sr2 = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM s_service_report2 WHERE srid= '".$row_sr['sr_id']."'"));
			
			/*$row_sr3 = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM s_service_report3 WHERE cus_id= '".$row_sr['cus_id']."'"));
			
			$row_sr5 = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM s_service_report5 WHERE cus_id= '".$row_sr['cus_id']."'"));*/
			
			//echo $row_sr['srid2'] ."<br />";

			?>
			<tr>
              <?php  if($_REQUEST['sh2'] == 1){?><td><?php  if($row_fr['loc_name'] != ""){echo $row_fr['loc_name'];}else{echo $row_fr['cd_name'];}?><br />
              <?php  echo $row_fr['loc_address'];?></td><?php  }?>
              <?php  if($_REQUEST['sh4'] == 1){?><td><?php  echo custype_name($conn,$row_fr['ctype']);?></td><?php  }?>
              
              <td style="padding:0;text-align: center;"><?php echo $row_sr['loc_seal']." / ".$row_sr['loc_sn'];?></td>
              <td>
              <?php 
				  $qurow_sr2 = mysqli_query($conn,"SELECT * FROM s_service_report2sub WHERE sr_id = '".$row_sr2['sr_id']."' AND codes != ''");
				  $numRS2 = mysqli_num_rows($qurow_sr2);
				
				if($numRS2 >= 1){
			  ?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbreport">
					<tr>
						<th>รายการ</th>
						<th>จำนวน</th>
					</tr>
					<?php
						while($rowSR2 = mysqli_fetch_array($qurow_sr2)){

							?>
							<tr>
								<td style="width: 60%;"><?php echo get_sparpart_name($conn,$rowSR2['lists']);?></td>
								<td style="width: 40%;"><?php echo $rowSR2['opens']." ".$rowSR2['units'];?></td>
							</tr>
							<?php
						}
					?>
					<?php ?>
				</table>
             	<?php }?>	
              </td>
              <td><?php echo $row_sr2['detail_recom'];?></td>
            </tr>
 
			
			<?php 
			$sum += 1;
		}
	  ?>
      <tr>
		<td colspan="6" style="text-align:right;"> <strong>ทั้งหมด&nbsp;&nbsp;<?php  echo $sum;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>
	  </tr>
    </table>

</body>
</html>
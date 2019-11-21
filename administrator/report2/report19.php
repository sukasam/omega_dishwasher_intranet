<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");
	if ($_GET["page"] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	$cpro = $_REQUEST['cpro'];
	
	$a_sdate=explode("/",$_REQUEST['date_fm']);
	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	$a_sdate=explode("/",$_REQUEST['date_to']);
	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

	$loc_contact = $_REQUEST['loc_contact'];
	$sr_ctype = $_REQUEST['sr_ctype'];		
	$ctype = $_REQUEST['ctype'];
	
	if($_REQUEST['priod'] == 0){
		$daterriod = " AND `sr_stime`  between '".$date_fm."' and '".$date_to."'"; 
		$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($date_to); 
	}
	else{
		$dateshow = "วันที่ดำเนินการ : ".format_date(date("Y-m-d")); 
	}
	
	$condition = "";

	if($cpro != ""){
		$condition = "AND (sv2.lists = '".$cpro."')";
	}

	if($sr_ctype != ""){
		$condition .= " AND sv.sr_ctype = '".$sr_ctype."'";
	}
	
	if($ctype != ""){
		$condition .= " AND sv.sr_ctype2 = '".$ctype."'";
	}

	if($loc_contact != ""){
		$condition .= " AND sv.loc_contact2 LIKE '%".$loc_contact."%'";
	}
	
//echo $_REQUEST['database1'];
//echo $_REQUEST['database2'];
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>เลือกรายงานอะไหล่</title>
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
	    <th colspan="4" style="text-align:left;font-size:12px;">บริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด<br />
รายงานอะไหล่</th>
	    <th colspan="4" style="text-align:right;font-size:11px;"><?php  echo $dateshow;?></th>
      </tr>
      <tr>
        <?php  if($_REQUEST['sh1'] == 1){?><th width="15%">ชื่อลูกค้า / บริษัท + เบอร์โทร</th><?php  }?>
        <?php  if($_REQUEST['sh2'] == 1){?><th width="15%">ชื่อร้าน / สถานที่ติดตั้ง</th><?php  }?>
        <?php  if($_REQUEST['sh3'] == 1){?><th width="10%">ประเภทลูกค้า</th><?php  }?>
        <?php  if($_REQUEST['sh4'] == 1 || $_REQUEST['sh5'] == 1){?><th width="20%"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
          <tr>
            <?php  if($_REQUEST['sh4'] == 1){?><th style="border:0;" width="50%">สินค้า</th><?php  }?>
            <?php  if($_REQUEST['sh5'] == 1){?><th style="border:0;" width="50%">รุ่นเครื่อง/SN</th><?php  }?>
          </tr>
        </table></th><?php  }?>
        <?php  if($_REQUEST['sh7'] == 1){?><th width="10%">เลขที่ใบเบิก/ใบยืม</th><?php  }?>
        <?php  if($_REQUEST['sh11'] == 1 || $_REQUEST['sh8'] == 1 || $_REQUEST['sh9'] == 1){?><th width="20%"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
          <tr>
            <?php  if($_REQUEST['sh11'] == 1){?><td style="border-bottom:none;" width="33%"><strong>รหัสอะไหล่</strong></td><?php  }?>
            <?php  if($_REQUEST['sh8'] == 1){?><td style="border-bottom:none;" width="33%"><strong>รายการอะไหล่</strong></td><?php  }?>
            <?php  if($_REQUEST['sh9'] == 1){?><td style="border-bottom:none;" width="33%"><strong>ราคาขาย</strong></td><?php  }?>
          </tr>
        </table></th><?php  }?>
        <?php  if($_REQUEST['sh9'] == 1){?><th width="10%"><strong>ช่าง</strong></th><?php  }?>
      </tr>
      <?php  
	  	
		if($_REQUEST['database1'] == 1){
		
			$dbservice = "s_service_report2";
			$dbservicesub = "s_service_report2sub";

			$sql = "SELECT * FROM s_first_order as fr, ".$dbservice." as sv, ".$dbservicesub." as sv2 WHERE sv.cus_id = fr.fo_id AND sv.sr_id = sv2.sr_id ".$condition." ".$daterriod." GROUP BY sv_id ORDER BY fr.cd_name ASC";
			$qu_fr = @mysqli_query($conn,$sql);
			$sum = 0;
			$totals = 0;
			$totalamount = 0;
			while($row_fr = @mysqli_fetch_array($qu_fr)){

				?>
				<tr>
				  <?php  if($_REQUEST['sh1'] == 1){?><td><?php  echo $row_fr['cd_name'];?><br />
				  <?php  echo $row_fr['cd_tel'];?></td><?php  }?>
				  <?php  if($_REQUEST['sh2'] == 1){?><td><?php  echo $row_fr['loc_name'];?><br />
				  <?php  echo $row_fr['loc_address'];?></td><?php  }?>
				  <?php  if($_REQUEST['sh3'] == 1){?><td><?php  echo getcustom_type($conn,$row_fr['sr_ctype2']);?></td><?php  }?>
				  <?php  if($_REQUEST['sh4'] == 1 || $_REQUEST['sh5'] == 1){?><td><table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbreport" style="margin-bottom:5px;">
					<?php  

					for($i=1;$i<=7;$i++){
						if($row_fr['pro_pod'.$i] != ""){
							?>
						<tr>
						  <?php  if($_REQUEST['sh4'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo get_proname($conn,$row_fr['cpro'.$i]);?></td><?php  }?>
						  <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['pro_pod'.$i]."/".$row_fr['pro_sn'.$i];?></td><?php  }?>
						</tr>
						<?php 	
						}
					}
					?>
				  </table></td>    <?php  }?>
				   <?php  if($_REQUEST['sh7'] == 1){?><td><?php  echo $row_fr['sv_id'];?><br />วันที่คืน:<?php  echo format_date($row_fr['sr_stime']);?></td><?php  }?>
				  <?php  if($_REQUEST['sh11'] == 1 || $_REQUEST['sh8'] == 1 || $_REQUEST['sh9'] == 1){?><td style="padding:0;">
					<?php  
					$qu_pfirst = @mysqli_query($conn,"SELECT * FROM ".$dbservicesub." WHERE sr_id = '".$row_fr['sr_id']."'");
					?>
					<table border="0" width="90%" cellspacing="0" cellpadding="0" class="tbreport">
					<?php 

					while($row = @mysqli_fetch_array($qu_pfirst)){
						if($row['codes'] != "" || $row['lists'] != ""){
							$totalamount += $row['opens'];
						?>
						<tr>
						  <?php  if($_REQUEST['sh11'] == 1){?><td style="border-bottom:none;" width="33%"><?php  echo get_sparpart_id($conn,$row['lists']);?></td><?php  }?>
						  <?php  if($_REQUEST['sh8'] == 1){?><td style="border-bottom:none;" width="33%"><?php  echo get_sparpart_name($conn,$row['lists']);?></td><?php  }?>
						  <?php  if($_REQUEST['sh9'] == 1){?><td align="right" style="border-bottom:none;" width="33%"><?php  echo number_format($row['prices'],2);?></td><?php  }?>
						</tr>
					<?php  

						}	
					}
						$totals += $totalamount

					?>
					</table>
				  </td><?php  }?>
				  <?php  if($_REQUEST['sh9'] == 1){?><td style="padding:0;"><?php  echo get_technician_name($conn,$row_fr['loc_contact']);?></td><?php  }?>
				</tr>
				<?php 
				$sum += 1;
			}
		}
		
		if($_REQUEST['database2'] == 1){
		
			$dbservice3 = "s_service_report3";
			$dbservicesub3 = "s_service_report3sub";

			$sql2 = "SELECT * FROM s_first_order as fr, ".$dbservice3." as sv, ".$dbservicesub3." as sv2 WHERE sv.cus_id = fr.fo_id AND sv.sr_id = sv2.sr_id ".$condition." ".$daterriod." GROUP BY sv_id ORDER BY fr.cd_name ASC";
			$qu_fr2 = @mysqli_query($conn,$sql2);
			$sum2 = 0;
			$totals2 = 0;
			$totalamount2 = 0;
			while($row_fr2 = @mysqli_fetch_array($qu_fr2)){

				?>
				<tr>
				  <?php  if($_REQUEST['sh1'] == 1){?><td><?php  echo $row_fr2['cd_name'];?><br />
				  <?php  echo $row_fr2['cd_tel'];?></td><?php  }?>
				  <?php  if($_REQUEST['sh2'] == 1){?><td><?php  echo $row_fr2['loc_name'];?><br />
				  <?php  echo $row_fr2['loc_address'];?></td><?php  }?>
				  <?php  if($_REQUEST['sh3'] == 1){?><td><?php  echo getcustom_type($conn,$row_fr2['sr_ctype2']);?></td><?php  }?>
				  <?php  if($_REQUEST['sh4'] == 1 || $_REQUEST['sh5'] == 1){?><td><table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbreport" style="margin-bottom:5px;">
					<?php  

					for($i=1;$i<=7;$i++){
						if($row_fr2['pro_pod'.$i] != ""){
							?>
						<tr>
						  <?php  if($_REQUEST['sh4'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo get_proname($conn,$row_fr2['cpro'.$i]);?></td><?php  }?>
						  <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr2['pro_pod'.$i]."/".$row_fr2['pro_sn'.$i];?></td><?php  }?>
						</tr>
						<?php 	
						}
					}
					?>
				  </table></td>    <?php  }?>
				   <?php  if($_REQUEST['sh7'] == 1){?><td><?php  echo $row_fr2['sv_id'];?><br />วันที่คืน:<?php  echo format_date($row_fr2['sr_stime']);?></td><?php  }?>
				  <?php  if($_REQUEST['sh4'] == 1 || $_REQUEST['sh5'] == 1 || $_REQUEST['sh8'] == 1){?><td style="padding:0;">
					<?php  
					$qu_pfirst2 = @mysqli_query($conn,"SELECT * FROM ".$dbservicesub3." WHERE sr_id = '".$row_fr2['sr_id']."'");
					?>
					<table border="0" width="90%" cellspacing="0" cellpadding="0" class="tbreport">
					<?php 
					while($row2 = @mysqli_fetch_array($qu_pfirst2)){
						if($row2['codes'] != "" || $row2['lists'] != ""){
							$totalamount2 += $row2['opens'];
						?>
						<tr>
						  <?php  if($_REQUEST['sh11'] == 1){?><td style="border-bottom:none;" width="33%"><?php  echo get_sparpart_id($conn,$row2['lists']);?></td><?php  }?>
						  <?php  if($_REQUEST['sh8'] == 1){?><td style="border-bottom:none;" width="33%"><?php  echo get_sparpart_name($conn,$row2['lists']);?></td><?php  }?>
						  <?php  if($_REQUEST['sh9'] == 1){?><td align="right" style="border-bottom:none;" width="33%"><?php  echo number_format($row2['prices'],2);?></td><?php  }?>
						</tr>
					<?php  

						}	
					}

					$totals2 += $totalamount2

					?>
					</table>
				  </td><?php  }?>
				  <?php  if($_REQUEST['sh9'] == 1){?><td style="padding:0;"><?php  echo get_technician_name($conn,$row_fr2['loc_contact2']);?></td><?php  }?>
				</tr>
				<?php 
				$sum2 += 1;
			}
		}
		
		if($_REQUEST['database1'] == 1){
			?>
			<tr>
				<td colspan="8" style="text-align:right;"> <strong>จำนวน<?php  if($_POST['sr_stock'] == "s_service_report2"){echo 'ใบเบิก';}else{echo "ใบเบิก";}?>ทั้งหมด&nbsp;&nbsp;<?php  echo $sum;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>
		  </tr>
		  <tr>
				<td colspan="8" style="text-align:right;"> <strong>รวมอะไหล่ที่เบิก&nbsp;&nbsp;<?php  echo $totals;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>
		  </tr>
			<?php
		}
		if($_REQUEST['database2'] == 1){
			?>
			<tr>
			  <td colspan="8" style="text-align:right;"> <strong>จำนวน<?php  if($_POST['sr_stock'] == "s_service_report3"){echo 'ใบยืม';}else{echo "ใบยืม";}?>ทั้งหมด&nbsp;&nbsp;<?php  echo $sum2;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>
	  		</tr>
      		<tr>
			  <td colspan="8" style="text-align:right;"> <strong>รวมอะไหล่ที่ยืม&nbsp;&nbsp;<?php  echo $totals2;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>
	  		</tr>
			<?php
		}
	  ?>
      
     
    </table>

</body>
</html>
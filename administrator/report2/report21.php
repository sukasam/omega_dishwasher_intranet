<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	$cd_name = $_REQUEST['cd_name'];
	$cpro = $_REQUEST['cpro'];
	$ctype = $_REQUEST['ctype'];
	$sr_ctype = $_REQUEST['sr_ctype'];
	$a_sdate=explode("/",$_REQUEST['date_fm']);
	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	$a_sdate=explode("/",$_REQUEST['date_to']);
	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	
	if($_REQUEST['priod'] == 0){
		$daterriod = " AND `sr_stime`  between '".$date_fm."' and '".$date_to."'"; 
		$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($date_to); 
	}
	else{
		$dateshow = "วันที่ค้นหา : ".format_date(date("Y-m-d")); 
	}
	
	// if($cpro != ""){
	// 	$condition = "AND (sv.cpro1 = '".$cpro."' OR sv.cpro2 = '".$cpro."' OR sv.cpro3 = '".$cpro."' OR sv.cpro4 = '".$cpro."' OR sv.cpro5 = '".$cpro."')";
	// }
	
	// if($sr_ctype != ""){
	// 	$condition .= " AND sv.sr_ctype = '".$sr_ctype."'";
	// }
	
	// if($ctype != ""){
	// 	$condition .= " AND sv.sr_ctype2 = '".$ctype."'";
	// }
	
	if($cd_name != ""){
		$condition .= " AND fr.cd_name LIKE '%".$cd_name."%'";
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ใบรับคืนสินค้า ( <?php  if($cpro != ""){echo $cd_name;}else{echo "ทั้งหมด";}?> )</title>
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
	    <th colspan="5" style="text-align:left;font-size:12px;">บริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด<br />
        รายงานใบรับคืนสินค้า ( <?php  if($cd_name !== ""){echo $cd_name;}else{echo "ทั้งหมด";}?> )<br />       
        <br /></th>
	    <th colspan="4" style="text-align:right;font-size:11px;"><?php  echo $dateshow;?></th>
      </tr>
      <tr>
	  	<?php  if($_REQUEST['sh7'] == 1){?><th width="8%"><div align="center">เลขที่ใบรับคืนสินค้า</div></th><?php  }?>
        <?php  if($_REQUEST['sh1'] == 1){?><th width="14%">ชื่อลูกค้า / บริษัท</th><?php  }?>
        <?php  if($_REQUEST['sh2'] == 1){?><th width="14%">ชื่อร้าน / สถานที่ติดตั้ง</th><?php  }?>
        <?php  if($_REQUEST['sh3'] == 1){?><th width="10%">ประเภทลูกค้า</th><?php  }?>
		<?php  if($_REQUEST['sh5'] == 1){?><th width="10%">รายการสินค้า / จำนวน</th><?php  }?>
        <?php  if($_REQUEST['sh6'] == 1){?>
			<th width="13%"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
          <tr>
            <?php  if($_REQUEST['sh6'] == 1){?><th style="border:0;" width="50%">รายการของแถม</th><?php  }?>
          </tr>
        </table></th>
		<?php  }?>
       
        <?php  if($_REQUEST['sh8'] == 1){?><th width="9%"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
          <tr>
            <?php  if($_REQUEST['sh8'] == 1){?><th style="border:0;" width="50%">รายการอะไหล่</th><?php  }?>
          </tr>
        </table>
       </th><?php  }?>
       <!-- <?php  if($_REQUEST['sh9'] == 1){?><th width="15%">รายละเอียดบริการ</th><?php  }?> -->
       <?php  if($_REQUEST['sh10'] == 1){?><th width="5%">ผู้รับคืนสินค้า</th><?php  }?>
	   <?php  if($_REQUEST['sh11'] == 1){?><th width="5%">วันรับคืนสินค้า</th><?php  }?>
      </tr>
      <?php  
		$sql = "SELECT * FROM s_first_order as fr, s_return_product as rp WHERE rp.cus_id = fr.fo_id ".$condition." ".$daterriod." ORDER BY fr.cd_name ASC";
	  	$qu_fr = @mysqli_query($conn,$sql);
		$sum = 0;
		while($row_fr = @mysqli_fetch_array($qu_fr)){
				
			?>
			<tr>
			<?php  if($_REQUEST['sh7'] == 1){?><td align="center"><?php  echo $row_fr['fs_id'];?></td><?php  }?>   
              <?php  if($_REQUEST['sh1'] == 1){?><td><?php  echo $row_fr['cd_name'];?><br />
              <?php  echo $row_fr['cd_tel'];?></td><?php  }?>
              <?php  if($_REQUEST['sh2'] == 1){?><td><?php  echo $row_fr['loc_name']."<br />".$row_fr['loc_address'];?></td><?php  }?>
              <?php  if($_REQUEST['sh3'] == 1){?><td><?php  echo getcustom_type($conn,$row_fr['type_service']);?></td>    <?php  }?> 
			  <?php  if($_REQUEST['sh5'] == 1){?><td><table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbreport" style="margin-bottom:5px;">
				<?php 
					$sqlProReturn = mysqli_query($conn,"SELECT * FROM s_return_product_pro WHERE order_id = '".$row_fr['order_id']."'");
					while($rowProReturn = mysqli_fetch_array($sqlProReturn)){
						?>
						<tr>
							<td style="border:0;padding-bottom:0;" width="50%"><?php echo get_proname($conn,$rowProReturn['pro_id']);?></td>
							<td style="border:0;padding-bottom:0;" width="50%"><?php echo $rowProReturn['pro_amount'];?> <?php echo get_pronamecall($conn,$rowProReturn['pro_id']);?></td>
						</tr>
						<?php
					}
				?>
			  </table></td>    <?php  }?> 
              <?php  if($_REQUEST['sh6'] == 1){?><td><table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbreport" style="margin-bottom:5px;">
                <?php  
					if($row_fr['cs_pro1'] != ""){
						?>
                <tr>
                  <td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['cs_pro1'];?></td>
                </tr>
                <?php 	
					}
				?>
                <?php  
					if($row_fr['cs_pro2'] != ""){
						?>
                <tr>
                    <td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['cs_pro2'];?></td>
                </tr>
                <?php 	
					}
				?>
                <?php  
					if($row_fr['cs_pro3'] != ""){
						?>
                <tr>
                  <td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['cs_pro3'];?></td>
                </tr>
                <?php 	
					}
				?>
                <?php  
					if($row_fr['cs_pro4'] != ""){
						?>
                <tr>
                 <td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['cs_pro4'];?></td>
                </tr>
                <?php 	
					}
				?>
                <?php  
					if($row_fr['cs_pro5'] != ""){
						?>
                <tr>
				<td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['cs_pro5'];?></td>
                </tr>
                <?php 	
					}
				?>
              </table></td>    <?php  }?>
              <?php  if($_REQUEST['sh8'] == 1){?><td style="padding:0;">
              	<table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbreport" style="margin-bottom:5px;">
                <?php  
					if($cpro == ""){
						
						if($row_fr['cpro1'] != ""){
							?>
							<tr>
							  <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;" width="37%"><?php  echo get_sparpart_name($conn,$row_fr['cpro1']);?></td><?php  }?>
							</tr>
							<?php 	
						}
					?>
					<?php  
						if($row_fr['cpro2'] != ""){
							?>
							<tr>
							  <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_sparpart_name($conn,$row_fr['cpro2']);?></td><?php  }?>
							</tr>
							<?php 	
						}
					?>
					<?php  
						if($row_fr['cpro3'] != ""){
							?>
							<tr>
							  <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_sparpart_name($conn,$row_fr['cpro3']);?></td><?php  }?>
							</tr>
							<?php 	
						}
					?>
					<?php  
						if($row_fr['cpro4'] != ""){
							?>
							<tr>
							  <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_sparpart_name($conn,$row_fr['cpro4']);?></td><?php  }?>
							</tr>
							<?php 	
						}
					?>
					<?php  
						if($row_fr['cpro5'] != ""){
							?>
							<tr>
							  <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_sparpart_name($conn,$row_fr['cpro5']);?></td><?php  }?>
							</tr>
							<?php 	
						}
		
					}else{
					
						if($row_fr['cpro1'] == $cpro){
							?>
							<tr>
							  <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;" width="37%"><?php  echo get_sparpart_name($conn,$row_fr['cpro1']);?></td><?php  }?>
							</tr>
							<?php 	
						}
					?>
					<?php  
						if($row_fr['cpro2'] == $cpro){
							?>
							<tr>
							  <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_sparpart_name($conn,$row_fr['cpro2']);?></td><?php  }?>
							</tr>
							<?php 	
						}
					?>
					<?php  
						if($row_fr['cpro3'] == $cpro){
							?>
							<tr>
							  <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_sparpart_name($conn,$row_fr['cpro3']);?></td><?php  }?>
							</tr>
							<?php 	
						}
					?>
					<?php  
						if($row_fr['cpro4'] == $cpro){
							?>
							<tr>
							  <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_sparpart_name($conn,$row_fr['cpro4']);?></td><?php  }?>
							</tr>
							<?php 	
						}
					?>
					<?php  
						if($row_fr['cpro5'] == $cpro){
							?>
							<tr>
							  <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_sparpart_name($conn,$row_fr['cpro5']);?></td><?php  }?>
							</tr>
							<?php 	
						}
				
					}
				?>
              </table></td> <?php  }?>
              <!-- <?php  if($_REQUEST['sh9'] == 1){?><td><?php  echo $row_fr['detail_recom2'];?></td><?php  }?> -->
              <?php  if($_REQUEST['sh10'] == 1){?><td><?php  echo get_technician_name($conn,$row_fr['cs_technic']);?></td><?php  }?>
			  <?php  if($_REQUEST['sh11'] == 1){?><td><?php  echo format_date_th($row_fr["date_forder"], 5);?></td><?php  }?>
      </tr>
			
			<?php 
			//$sum += ($row_fr['cprice1']+$row_fr['cprice2']+$row_fr['cprice3']+$row_fr['cprice4']+$row_fr['cprice5']);
			$sum += 1;
		}
		
	  ?>
      <tr>
			  <td colspan="9" align="right"><strong>ใบรับคืนสินค้าทั้งหมด</strong>&nbsp;&nbsp;&nbsp;<strong><?php  echo $sum;?>&nbsp;&nbsp;รายการ</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	  </tr>
    </table>

</body>
</html>
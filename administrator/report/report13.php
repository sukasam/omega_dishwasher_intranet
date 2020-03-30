<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	$order_status = $_REQUEST['order_status'];
	$a_sdate=explode("/",$_REQUEST['date_fm']);
	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	$a_sdate=explode("/",$_REQUEST['date_to']);
	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	
	if($_REQUEST['priod'] == 0){
		$daterriod = " AND `date_forder`  between '".$date_fm."' and '".$date_to."'"; 
		$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($date_to); 
	}
	else{
		$dateshow = "วันที่ค้นหา : ".format_date(date("Y-m-d")); 
	}

	$condi = '';

	if($order_status != ""){
		$condi = " AND `st_setting`  = '".$order_status."'"; 
	}
	
	// $codi = " AND status_use = 0";
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานใบสั่งน้ำยา</title>
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
        รายงานใบสั่งน้ำยา</th>
	    <th colspan="6" style="text-align:right;font-size:11px;"><?php  echo $dateshow;?></th>
      </tr>
      <tr>
        <?php  if($_REQUEST['sh1'] == 1){?><th width="15%">ชื่อลูกค้า / บริษัท + เบอร์โทร</th><?php  }?>
        <?php  if($_REQUEST['sh2'] == 1){?><th width="20%">ชื่อร้าน / สถานที่จัดส่ง</th><?php  }?>
        <?php  if($_REQUEST['sh4'] == 1){?><th width="9%">ประเภทลูกค้า</th><?php  }?>
        <?php  if($_REQUEST['sh5'] == 1){?><th width="8%">สถานะใบสั่งน้ำยา</th><?php  }?>
		<?php  if($_REQUEST['sh6'] == 1 || $_REQUEST['sh7'] == 1 || $_REQUEST['sh8'] == 1){?><th width="26%"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
          <tr>
            <?php  if($_REQUEST['sh6'] == 1){?><th style="border:0;text-align:left;" >รหัสสินค้า</th><?php  }?>
            <?php  if($_REQUEST['sh7'] == 1){?><th style="border:0;text-align:left;" >ชื่อสินค้า</th><?php  }?>
            <?php  if($_REQUEST['sh8'] == 1){?><th style="border:0;text-align:left;">จำนวน</th><?php  }?>
          </tr>
        </table></th><?php  }?>
        <?php  if($_REQUEST['sh9'] == 1){?><th width="8%">วันที่สั่งน้ำยา</th><?php  }?>
        <?php  /*if($_REQUEST['sh10'] == 1){?><th width="4%">ผู้ขาย</th><?php  }*/?>
      </tr>
      <?php  
		$sql = "SELECT * FROM s_order_solution WHERE 1 ".$condi.$daterriod." ORDER BY date_forder ASC";
	  	$qu_fr = @mysqli_query($conn,$sql);
		$sum = 0;
		while($row_fr = @mysqli_fetch_array($qu_fr)){
			?>
			<tr>
             <?php  if($_REQUEST['sh1'] == 1){?><td><?php  echo $row_fr['cd_name'];?><br />
              <?php  echo $row_fr['cd_tel'];?></td><?php  }?>
              <?php  if($_REQUEST['sh2'] == 1){?><td><?php  echo $row_fr['ship_name'];?><br />
              <?php  echo $row_fr['ship_address'];?></td><?php  }?>
              <?php  if($_REQUEST['sh4'] == 1){?><td><?php  echo custype_name($conn,$row_fr['type_service']);?></td><?php  }?>
              <?php  if($_REQUEST['sh5'] == 1){?><td><?php  echo getStatusSolution($row_fr['st_setting']);?></td><?php  }?>
              <?php  if($_REQUEST['sh6'] == 1 || $_REQUEST['sh7'] == 1 || $_REQUEST['sh8'] == 1){?><td style="padding:0;">
              	<table width="92%" border="0" cellpadding="0" cellspacing="0" class="tbreport" style="margin-bottom:5px;">
				<?php  
				 //echo "SELECT * FROM s_order_solution_pro WHERE  order_id = '".$row_fr['order_id']."' ORDER BY ASC";
				  $quOrderPro = mysqli_query($conn,"SELECT * FROM s_order_solution_pro WHERE  order_id = '".$row_fr['order_id']."' ORDER BY `id` ASC");
					while($rowOrderPro = mysqli_fetch_array($quOrderPro)){
						?>
						<tr>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;" width="31%"><?php  echo $rowOrderPro['pro_code'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh7'] == 1){?><td style="border:0;padding-bottom:0;" width="33%"><?php  echo get_product_name($conn,$rowOrderPro['pro_id']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;text-align: center;" width="33%"><?php  echo $rowOrderPro['pro_amount'];?></td><?php  }?>
                        </tr>
						<?php 	
					}
				?>
              </table></td><?php  }?>
              <?php  if($_REQUEST['sh9'] == 1){?><td><?php  echo format_date($row_fr['date_forder']);?></td><?php  }?>
              <?php  /*if($_REQUEST['sh10'] == 1){?><td><?php  echo get_sale_id($conn,$row_fr['cs_sell']);?></td><?php  }*/?>
            </tr>
			
			<?php 
			$sum += 1;
		}
	  ?>
       <tr>
		<td colspan="7" style="text-align:right;"> <strong>ทั้งหมด&nbsp;&nbsp;<?php  echo $sum;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>
	  </tr>
    </table>

</body>
</html>
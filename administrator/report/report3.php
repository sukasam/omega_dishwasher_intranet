<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	if(isset($_GET['cg_type'])){$_REQUEST['sh1'] = 1;$_REQUEST['sh2'] = 1;$_REQUEST['sh3'] = 1;$_REQUEST['sh4'] = 1;$_REQUEST['sh5'] = 1;$_REQUEST['sh6'] = 1;$_REQUEST['sh7'] = 1;$_REQUEST['sh8'] = 1;$_REQUEST['sh9'] = 1;$_REQUEST['sh10'] = 1;}
	
	$ctype = $_REQUEST['ctype'];
	$cg_type = $_REQUEST['cg_type'];
	$pro_pod = $_REQUEST['pro_pod'];
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
	
	$condition = "";
	
	if($pro_pod != ""){
		$condition .= "AND (pro_pod1 = '".$pro_pod."' OR pro_pod2 = '".$pro_pod."' OR pro_pod3 = '".$pro_pod."' OR pro_pod4 = '".$pro_pod."' OR pro_pod5 = '".$pro_pod."' OR pro_pod6 = '".$pro_pod."' OR pro_pod7 = '".$pro_pod."')";
	}
	
	if($cg_type != ""){
		$condition .= " AND cg_type = '".$cg_type."'";
	}
	
	if($ctype != ""){
		$condition .= " AND ctype = '".$ctype."'";
	}
	
	$codi = " AND status_use = 0";
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>เลือกตามกลุ่มลูกค้า ( <?php  echo get_groupcusname($conn,$cg_type);?> )</title>
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
        รายงานตามกลุ่มลูกค้า ( <?php  echo get_groupcusname($conn,$cg_type);?> )</th>
	    <th colspan="6" style="text-align:right;font-size:11px;"><?php  echo $dateshow;?></th>
      </tr>
      <tr>
        <?php  if($_REQUEST['sh1'] == 1){?><th width="15%">ชื่อลูกค้า / บริษัท + เบอร์โทร</th><?php  }?>
        <?php  if($_REQUEST['sh2'] == 1){?><th width="20%">ชื่อร้าน / สถานที่ติดตั้ง</th><?php  }?>
        <?php  if($_REQUEST['sh3'] == 1){?><th>ประเภทลูกค้า</th><?php  }?>
        <?php  if($_REQUEST['sh4'] == 1 || $_REQUEST['sh5'] == 1 || $_REQUEST['sh6'] == 1){?><th><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
          <tr>
            <?php  if($_REQUEST['sh4'] == 1){?><th style="border:0;" width="40%">ประเภทสินค้า</th><?php  }?>
            <?php  if($_REQUEST['sh5'] == 1){?><th style="border:0;" width="40%">รุ่นเครื่อง/SN</th><?php  }?>
            <?php  if($_REQUEST['sh6'] == 1){?><th style="border:0;" width="20%">ราคาขาย/ค่าเช่า</th><?php  }?>
          </tr><?php  }?>
        </table></th>
        <?php  if($_REQUEST['sh7'] == 1){?><th width="10%">ผู้ขาย</th><?php  }?>
      </tr>
      <?php  
		$sql = "SELECT * FROM `s_first_order` WHERE 1 ".$condition." ".$daterriod." ".$codi." ORDER BY date_forder ASC";
	  	$qu_fr = @mysqli_query($conn,$sql);
		$sum = 0;
		while($row_fr = @mysqli_fetch_array($qu_fr)){
			?>
			<tr>
              <?php  if($_REQUEST['sh1'] == 1){?><td><?php  echo $row_fr['cd_name'];?><br />
              <?php  echo $row_fr['cd_tel'];?></td><?php  }?>
              <?php  if($_REQUEST['sh2'] == 1){?><td><?php  echo $row_fr['loc_name'];?><br />
              <?php  echo $row_fr['loc_address'];?></td><?php  }?>
              <?php  if($_REQUEST['sh3'] == 1){?><td><?php  echo custype_name($conn,$row_fr['ctype']);?></td><?php  }?>
              <?php  if($_REQUEST['sh4'] == 1 || $_REQUEST['sh5'] == 1 || $_REQUEST['sh6'] == 1){?><td style="padding:0;">
              	<table width="96%" border="0" cellpadding="0" cellspacing="0" class="tbreport" style="margin-bottom:5px;">
                <?php  
					if($row_fr['cpro1'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh4'] == 1){?><td style="border:0;padding-bottom:0;" width="34%"><?php  echo get_proname($conn,$row_fr['cpro1']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;" width="34%"><?php  echo $row_fr['pro_pod1']." / ".$row_fr['pro_sn1'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh6'] == 1){?> <td style="border:0;padding-bottom:0;text-align:right;" width="32%"><?php  echo number_format($row_fr['cprice1']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro2'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh4'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="34%"><?php  echo get_proname($conn,$row_fr['cpro2']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="34%"><?php  echo $row_fr['pro_pod2']." / ".$row_fr['pro_sn2'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;" width="32%"><?php  echo number_format($row_fr['cprice2']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro3'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh4'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="34%"><?php  echo get_proname($conn,$row_fr['cpro3']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="34%"><?php  echo $row_fr['pro_pod3']." / ".$row_fr['pro_sn3'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;" width="32%"><?php  echo number_format($row_fr['cprice3']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro4'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh4'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="34%"><?php  echo get_proname($conn,$row_fr['cpro4']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="34%"><?php  echo $row_fr['pro_pod4']." / ".$row_fr['pro_sn4'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;" width="32%"><?php  echo number_format($row_fr['cprice4']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro5'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh4'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="34%"><?php  echo get_proname($conn,$row_fr['cpro5']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="34%"><?php  echo $row_fr['pro_pod5']." / ".$row_fr['pro_sn5'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;" width="32%"><?php  echo number_format($row_fr['cprice5']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro6'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh4'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="34%"><?php  echo get_proname($conn,$row_fr['cpro6']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="34%"><?php  echo $row_fr['pro_pod6']." / ".$row_fr['pro_sn6'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;" width="32%"><?php  echo number_format($row_fr['cprice6']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro7'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh4'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="34%"><?php  echo get_proname($conn,$row_fr['cpro7']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="34%"><?php  echo $row_fr['pro_pod7']." / ".$row_fr['pro_sn7'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;" width="32%"><?php  echo number_format($row_fr['cprice7']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                        </tr>
						<?php 
						
					}
				?>
              </table></td><?php  }?>
              <?php  if($_REQUEST['sh7'] == 1){?><td><?php  echo get_sale_id($conn,$row_fr['cs_sell']);?></td><?php  }?>
            </tr>
			<?php 
			$sum += 1;	
		}
	  ?>
      <tr>
		<td colspan="5" style="text-align:right;"> <strong>ทั้งหมด&nbsp;&nbsp;<?php  echo $sum;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>
	  </tr>
    </table>

</body>
</html>
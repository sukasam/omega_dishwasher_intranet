<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	$cd_name = $_REQUEST['cd_name'];

	$condition = "";
	//$conditionb = " AND (ctype != 2 OR ctype != 4 OR ctype != 24 OR ctype != 9 OR ctype != 8)";
	$conditionb = " AND (fs_id LIKE '%SV%')";
	$orderby = "";
	
	
	$a_sdate=explode("/",$_REQUEST['date_fm']);
	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	$a_sdate=explode("/",$_REQUEST['date_to']);
	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	
	
	if($_REQUEST['cd_name'] != ""){
		$condition .= " AND cd_name LIKE '%".$cd_name."%'";
	}
	
	
	if(($_REQUEST['base1'] != 1 || $_REQUEST['basebox2'] != 1) && ($_REQUEST['base1'] != 2 || $_REQUEST['basebox2'] != 1) && ($_REQUEST['base1'] != 3 || $_REQUEST['basebox2'] != 3) && ($_REQUEST['base1'] != 4 || $_REQUEST['basebox2'] != 3)){
		if($_REQUEST['priod'] == 0){
			$daterriod = " AND `date_forder`  between '".$date_fm."' and '".$date_to."'"; 
			$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($date_to); 
		}
		else{
			$dateshow = "วันที่ค้นหา : ".format_date(date("Y-m-d")); 
		}	
	}
	
	
	if($_REQUEST['base1'] == 1){
		if($_REQUEST['basebox2'] == 1){
			if($_REQUEST['baseboxlist3'] == 1){
				$a_sdate=explode("/",$_REQUEST['create_date']);
				$create_date=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
				
				$a_sdate=explode("/",$_REQUEST['create_dateto']);
				$create_dateto=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
				
				$condition .= " AND `date_forder` BETWEEN '".$create_date."' AND '".$create_dateto."' ".$conditionb;
				$orderby .= "ORDER BY date_forder ASC";
				
				$headtitle = "วันที่คีย์ : ".$create_date." - "."ถึงวันที่คีย์ : ".$create_dateto;
				
				$bselect = "แยกตามประเภทลูกค้า > วันที่ > วันที่คีย์";
				
			}
			if($_REQUEST['baseboxlist3'] == 2){
				$a_sdate=explode("/",$_REQUEST['date_quf']);
				$date_quf=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
				
				$a_sdate=explode("/",$_REQUEST['date_qut']);
				$date_qut=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
				
				$condition .= " AND `date_qut` BETWEEN '".$date_quf."' AND '".$date_qut."' ".$conditionb;
				$orderby .= "ORDER BY date_qut ASC";
				
				$headtitle = "วันที่เริ่มสัญญา : ".$date_quf." - "."วันที่สิ้นสุดสัญญา : ".$date_qut;
				
				$bselect = "แยกตามประเภทลูกค้า > วันที่ > วันที่เริ่มสัญญา - สิ้นสุด";
				
			}
			if($_REQUEST['baseboxlist3'] == 3){
				
				$a_sdate=explode("/",$_REQUEST['cs_setting']);
				$cs_setting=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
				
				$condition .= " AND date(`cs_setting`) = '".$cs_setting."' ".$conditionb;
				$orderby .= "ORDER BY cs_setting ASC";
				
				$headtitle = "วันที่ติดตั้ง : ".$cs_setting;
				
				$bselect = "แยกตามประเภทลูกค้า > วันที่ > วันที่ติดตั้ง";
			}
		}
		if($_REQUEST['basebox2'] == 2){
			$condition .= " AND ctype = ".$_REQUEST['baseboxlist3'];
			$orderby .= "ORDER BY date_forder ASC";
			
			$headtitle = "ประเภทลูกค้า : ".custype_name($conn,$_REQUEST['baseboxlist3']);
			
			$bselect = "แยกตามประเภทลูกค้า > ประเภทลูกค้า > ".custype_name($conn,$_REQUEST['baseboxlist3']);
		}
		if($_REQUEST['basebox2'] == 3){
			$condition .= " AND cs_sell = ".$_REQUEST['baseboxlist3']." ".$conditionb;
			$orderby .= "ORDER BY date_forder ASC";
			
			$headtitle = "พนักงานขาย : ".getsalename($conn,$_REQUEST['baseboxlist3']);
			
			$bselect = "แยกตามประเภทลูกค้า > พนักงานขาย > ".getsalename($conn,$_REQUEST['baseboxlist3']);
		}
	}
	if($_REQUEST['base1'] == 2){
		if($_REQUEST['basebox2'] == 1){
			if($_REQUEST['baseboxlist3'] == 1){
				$a_sdate=explode("/",$_REQUEST['create_date']);
				$create_date=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
				
				$a_sdate=explode("/",$_REQUEST['create_dateto']);
				$create_dateto=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
				
				$condition .= " AND `date_forder` BETWEEN '".$create_date."' AND '".$create_dateto."' ".$conditionb;
				$orderby .= "ORDER BY date_forder ASC";
				
				$headtitle = "วันที่คีย์ : ".$create_date." - "."ถึงวันที่คีย์ : ".$create_dateto;
				
				$bselect = "แยกตามกลุ่มลูกค้า > วันที่ > วันที่คีย์";
			}
			if($_REQUEST['baseboxlist3'] == 2){
				
				$a_sdate=explode("/",$_REQUEST['date_quf']);
				$date_quf=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
				
				$a_sdate=explode("/",$_REQUEST['date_qut']);
				$date_qut=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
				
				$condition .= " AND `date_qut` BETWEEN '".$date_quf."' AND '".$date_qut."' ".$conditionb;
				$orderby .= "ORDER BY date_qut ASC";
				
				$headtitle = "ระหว่างวันที่ : ".$date_quf." - "."ถึง วันที : ".$date_qut;
				
				$bselect = "แยกตามกลุ่มลูกค้า > วันที่ > วันที่เริ่มสัญญา - สิ้นสุุด";
			}
			if($_REQUEST['baseboxlist3'] == 3){
				$a_sdate=explode("/",$_REQUEST['cs_setting']);
				$cs_setting=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
				
				$condition .= " AND date(`cs_setting`) = '".$cs_setting."' ".$conditionb;
				$orderby .= "ORDER BY cs_setting ASC";
				
				$headtitle = "วันที่ติดตั้ง : ".$cs_setting;
				
				$bselect = "แยกตามกลุ่มลูกค้า > วันที่ > วันที่ติดตั้ง";
			}
		}
		if($_REQUEST['basebox2'] == 2){
			
			$condition .= " AND cg_type = ".$_REQUEST['baseboxlist3']." ".$conditionb;
			$orderby .= "ORDER BY date_forder ASC";
			
			$headtitle = "กลุ่มลูกค่า : ".get_groupcusname($conn,$_REQUEST['baseboxlist3']);
			
			$bselect = "แยกตามกลุ่มลูกค้า > กลุ่มลูกค้า > ".get_groupcusname($conn,$_REQUEST['baseboxlist3']);
			
		}
		if($_REQUEST['basebox2'] == 3){
			
			$condition .= " AND cs_sell = ".$_REQUEST['baseboxlist3']." ".$conditionb;
			$orderby .= "ORDER BY date_forder ASC";
			
			$headtitle = "พนักงานขาย : ".getsalename($conn,$_REQUEST['baseboxlist3']);
			
			$bselect = "แยกตามกลุ่มลูกค้า > พนักงานขาย > ".getsalename($conn,$_REQUEST['baseboxlist3']);
			
		}
	}
	if($_REQUEST['base1'] == 3){
		if($_REQUEST['basebox2'] == 1){
			$condition .= " AND ctype = ".$_REQUEST['baseboxlist3'];
			$orderby .= "ORDER BY r_id ASC";
			
			$headtitle = "ประเภทลูกค้า : ".custype_name($conn,$_REQUEST['baseboxlist3']);
			
			$bselect = "เรียงตามเลขสัญญา > ประเภทลูกค้า > ".custype_name($conn,$_REQUEST['baseboxlist3']);
			
			
		}
		if($_REQUEST['basebox2'] == 2){
			$condition .= " AND cg_type = ".$_REQUEST['baseboxlist3']." ".$conditionb;
			$orderby .= "ORDER BY r_id ASC";
			
			$headtitle = "กลุ่มลูกค้า : ".get_groupcusname($conn,$_REQUEST['baseboxlist3']);
			
			$bselect = "เรียงตามเลขสัญญา > กลุ่มลูกค้า > ".get_groupcusname($conn,$_REQUEST['baseboxlist3']);
			
		}
		if($_REQUEST['basebox2'] == 3){
			
			$a_sdate=explode("/",$_REQUEST['date_quf']);
			$date_quf=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
			
			$a_sdate=explode("/",$_REQUEST['date_qut']);
			$date_qut=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
			
			$condition .= " AND `date_qut` BETWEEN '".$date_quf."' AND '".$date_qut."' "." ".$conditionb;
			$orderby .= "ORDER BY r_id ASC";
			
			$headtitle = "ระหว่างวันที่ : ".$date_quf." - "."ถึง วันที : ".$date_qut;
			
			$bselect = "เรียงตามเลขสัญญา > วันที่เริ่มสัญญา-สิ้นสุด";
			
		}
		if($_REQUEST['basebox2'] == 4){
			$condition .= " AND cs_sell = ".$_REQUEST['baseboxlist3']." ".$conditionb;
			$orderby .= "ORDER BY r_id ASC";
			
			$headtitle = "พนักงานขาย : ".getsalename($conn,$_REQUEST['baseboxlist3']);
			
			$bselect = "เรียงตามเลขสัญญา > พนักงานขาย > ".getsalename($conn,$_REQUEST['baseboxlist3']);
			
		}
	}
	if($_REQUEST['base1'] == 4){
		if($_REQUEST['basebox2'] == 1){
			$condition .= " AND ctype = ".$_REQUEST['baseboxlist3'];
			$orderby .= "ORDER BY cd_name ASC";
			
			$headtitle = "ประเภทลูกค้า : ".custype_name($conn,$_REQUEST['baseboxlist3']);
			
			$bselect = "เรียงตามรายชื่อลูกค้า > ประเภทลูกค้า > ".custype_name($conn,$_REQUEST['baseboxlist3']);
		}
		if($_REQUEST['basebox2'] == 2){
			$condition .= " AND cg_type = ".$_REQUEST['baseboxlist3']." ".$conditionb;
			$orderby .= "ORDER BY cd_name ASC";
			
			$headtitle = "กลุ่มลูกค้า : ".get_groupcusname($conn,$_REQUEST['baseboxlist3']);
			
			$bselect = "เรียงตามรายชื่อลูกค้า > กลุ่มลูกค้า > ".get_groupcusname($conn,$_REQUEST['baseboxlist3']);
			
		}
		if($_REQUEST['basebox2'] == 3){
			$a_sdate=explode("/",$_REQUEST['date_quf']);
			$date_quf=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
			
			$a_sdate=explode("/",$_REQUEST['date_qut']);
			$date_qut=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
			
			$condition .= " AND `date_qut` BETWEEN '".$date_quf."' AND '".$date_qut."' ".$conditionb;
			$orderby .= "ORDER BY cd_name ASC";
			
			$headtitle = "ระหว่างวันที่ : ".$date_quf." - "."ถึง วันที : ".$date_qut;
			
			$bselect = "เรียงตามรายชื่อลูกค้า > วันที่เริ่มสัญญา-สิ้นสุด";
		}
		if($_REQUEST['basebox2'] == 4){
			$condition .= " AND cs_sell = ".$_REQUEST['baseboxlist3']." ".$conditionb;
			$orderby .= "ORDER BY cd_name ASC";
			
			$headtitle = "พนักงานขาย : ".getsalename($conn,$_REQUEST['baseboxlist3']);
			
			$bselect = "เรียงตามรายชื่อลูกค้า > พนักงานขาย > ".getsalename($conn,$_REQUEST['baseboxlist3']);
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานคุมสัญญาเช่า</title>
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
        รายงานคุมสัญญาบริการ (<?php  echo $bselect;?>)</th>
	    <th colspan="5" style="text-align:right;font-size:11px;"><span style="text-align:right;font-size:12px;"><?php  echo $headtitle;?></span></th>
      </tr>
      <tr>
        <?php  if($_REQUEST['sh1'] == 1){?>
        <th width="6%">สัญญาบริการ</th><?php  }?>
        <?php  if($_REQUEST['sh2'] == 1){?><th width="15%">ชื่อลูกค้า / บริษัท + เบอร์โทร</th><?php  }?>
        <?php  if($_REQUEST['sh3'] == 1){?><th width="16%">ชื่อร้าน / สถานที่ติดตั้ง</th><?php  }?>
        <?php  if($_REQUEST['sh4'] == 1){?><th width="11%">ประเภทลูกค้า</th><?php  }?>
        <?php  if($_REQUEST['sh10'] == 1){?><th width="11%">กลุ่มลูกค้า</th><?php  }?>
        <?php  if($_REQUEST['sh5'] == 1 || $_REQUEST['sh6'] == 1 || $_REQUEST['sh7'] == 1){?><th width="39%"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
          <tr>
            <?php  if($_REQUEST['sh5'] == 1){?><th style="border:0;" width="40%">ประเภทสินค้า</th><?php  }?>
            <?php  if($_REQUEST['sh6'] == 1){?><th style="border:0;" width="40%">รุ่นเครื่อง/SN</th><?php  }?>
            <?php  if($_REQUEST['sh7'] == 1){?><th style="border:0;" width="20%">ราคาขาย/ค่าเช่า</th><?php  }?>
          </tr>
        </table></th><?php  }?>
        <?php  if($_REQUEST['sh8'] == 1){?><th width="7%">วันเริ่มสัญญา</th><?php  }?>
        <?php  if($_REQUEST['sh9'] == 1){?><th width="6%">สิ้นสุดสัญญา</th><?php  }?>
      </tr>
      <?php  
	 	 $sql = "SELECT * FROM s_first_order WHERE 1 ".$condition." ".$conditionb." ".$daterriod." ".$orderby;
	  	$qu_fr = @mysqli_query($conn,$sql);
		$sumtotal = 0;
		$sum = 0;
		while($row_fr = @mysqli_fetch_array($qu_fr)){
			?>
			<tr>
              <?php  if($_REQUEST['sh1'] == 1){?><td><?php  echo $row_fr['fs_id'];?></td><?php  }?>
              <?php  if($_REQUEST['sh2'] == 1){?><td><?php  echo $row_fr['cd_name'];?><br />
              <?php  echo $row_fr['cd_tel'];?></td><?php  }?>
              <?php  if($_REQUEST['sh3'] == 1){?><td><?php  echo $row_fr['loc_name'];?><br />
              <?php  echo $row_fr['loc_address'];?></td><?php  }?>
              <?php  if($_REQUEST['sh4'] == 1){?><td><?php  echo custype_name($conn,$row_fr['ctype']);?></td><?php  }?>
              <?php  if($_REQUEST['sh10'] == 1){?><td><?php  echo get_groupcusname($conn,$row_fr['cg_type']);?></td><?php  }?>
              <?php  if($_REQUEST['sh5'] == 1 || $_REQUEST['sh6'] == 1 || $_REQUEST['sh7'] == 1){?><td style="padding:0;">
              	<table width="94%" border="0" cellpadding="0" cellspacing="0" class="tbreport" style="margin-bottom:5px;">
                <?php  
					if($row_fr['cpro1'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;" width="37%"><?php  echo get_sparpart_name($conn,$row_fr['cpro1']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;" width="31%"><?php  echo $row_fr['pro_pod1']." / ".$row_fr['pro_sn1'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh7'] == 1){?><td style="border:0;padding-bottom:0;text-align:right;" width="32%"><?php  echo number_format($row_fr['cprice1']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                          <?php  $sumtotal += $row_fr['cprice1'];?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro2'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="37%"><?php  echo get_sparpart_name($conn,$row_fr['cpro2']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="31%"><?php  echo $row_fr['pro_pod2']." / ".$row_fr['pro_sn2'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh7'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;" width="32%"><?php  echo number_format($row_fr['cprice2']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                          <?php  $sumtotal += $row_fr['cprice2'];?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro3'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="37%"><?php  echo get_sparpart_name($conn,$row_fr['cpro3']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="31%"><?php  echo $row_fr['pro_pod3']." / ".$row_fr['pro_sn3'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh7'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;" width="32%"><?php  echo number_format($row_fr['cprice3']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                          <?php  $sumtotal += $row_fr['cprice3'];?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro4'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="37%"><?php  echo get_sparpart_name($conn,$row_fr['cpro4']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="31%"><?php  echo $row_fr['pro_pod4']." / ".$row_fr['pro_sn4'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh7'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;" width="32%"><?php  echo number_format($row_fr['cprice4']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                          <?php  $sumtotal += $row_fr['cprice4'];?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro5'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="37%"><?php  echo get_sparpart_name($conn,$row_fr['cpro5']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="31%"><?php  echo $row_fr['pro_pod5']." / ".$row_fr['pro_sn5'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh7'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;" width="32%"><?php  echo number_format($row_fr['cprice5']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                          <?php  $sumtotal += $row_fr['cprice5'];?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro6'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="37%"><?php  echo get_sparpart_name($conn,$row_fr['cpro6']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="31%"><?php  echo $row_fr['pro_pod6']." / ".$row_fr['pro_sn6'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh7'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;" width="32%"><?php  echo number_format($row_fr['cprice6']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                          <?php  $sumtotal += $row_fr['cprice6'];?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro7'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="37%"><?php  echo get_sparpart_name($conn,$row_fr['cpro7']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;" width="31%"><?php  echo $row_fr['pro_pod7']." / ".$row_fr['pro_sn7'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh7'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;" width="32%"><?php  echo number_format($row_fr['cprice7']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                          <?php  $sumtotal += $row_fr['cprice7'];?>
                        </tr>
						<?php 
						
					}
				?>
              </table></td><?php  }?>
              <?php  if($_REQUEST['sh8'] == 1){?><td><?php  echo format_date($row_fr['date_quf']);?></td><?php  }?>
              <?php  if($_REQUEST['sh9'] == 1){?><td><?php  echo format_date($row_fr['date_qut']);?></td><?php  }?>
            </tr>
			<?php 
			$sum += 1;	
		}
	  ?>
      <tr>
		<td colspan="8" style="text-align:right;"> <strong>ราคารวมทั้งหมด <?php  echo number_format($sumtotal,2);?> บาท<br />
	    ทั้งหมด&nbsp;&nbsp;<?php  echo $sum;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>
	  </tr>
    </table>

</body>
</html>
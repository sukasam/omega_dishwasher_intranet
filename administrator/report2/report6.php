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
		$daterriod = " AND sv.sr_stime  between '".$date_fm."' and '".$date_to."'"; 
		$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($date_to); 
	}
	else{
		$dateshow = "วันที่ค้นหา : ".format_date(date("Y-m-d")); 
	}
	
	// if($cpro != ""){
	// 	$condition = "AND sb.lists = '".$cpro."'";
	// }
	
	if($sr_ctype != ""){
		$condition .= " AND sv.sr_ctype = '".$sr_ctype."'";
	}
	
	if($ctype != ""){
		$condition .= " AND sv.sr_ctype2 = '".$ctype."'";
	}
	
	if($cd_name != ""){
		$condition .= " AND fr.cd_name LIKE '%".$cd_name."%'";
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>เลือกตามการใช้อะไหล่ ( <?php  if($cpro != ""){echo get_sparpart_name($conn,$cpro);}else{echo "ทั้งหมด";}?> )</title>
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
        รายงานตามการใช้อะไหล่ ( <?php  if($cpro != ""){echo get_sparpart_name($conn,$cpro);}else{echo "ทั้งหมด";}?> )<br />
        ประเภทลูกค้า  :
        <?php  if($_POST['ctype'] != ""){echo getcustom_type($conn,$_POST['ctype']);}else{echo "ทั้งหมด";}?>
        <br />
ประเภทบริการ  :
<?php  if($_POST['sr_ctype']){echo get_servicename($conn,$_POST['sr_ctype']);}else{echo "ทั้งหมด";}?>
<br />        
        <br /></th>
	    <th colspan="4" style="text-align:right;font-size:11px;"><?php  echo $dateshow;?></th>
      </tr>
      <tr>
        <?php  if($_REQUEST['sh1'] == 1){?><th width="14%">ชื่อลูกค้า / บริษัท</th><?php  }?>
        <?php  if($_REQUEST['sh2'] == 1){?><th width="14%">ชื่อร้าน / สถานที่ติดตั้ง</th><?php  }?>
        <?php  if($_REQUEST['sh3'] == 1){?><th width="10%">ประเภทลูกค้า</th><?php  }?>
        <?php  if($_REQUEST['sh4'] == 1){?><th width="8%">ประเภทบริการ</th><?php  }?>
        <?php  if($_REQUEST['sh5'] == 1 || $_REQUEST['sh6'] == 1){?><th width="13%"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
          <tr>
            <?php  if($_REQUEST['sh5'] == 1){?><th style="border:0;" width="50%">รุ่นเครื่อง</th><?php  }?>
            <?php  if($_REQUEST['sh6'] == 1){?><th style="border:0;" width="50%">SN</th><?php  }?>
          </tr>
        </table></th><?php  }?>
        <?php  if($_REQUEST['sh7'] == 1){?><th width="12%"><div align="center">เลขที่ใบบริการ</div></th><?php  }?>
        <?php  if($_REQUEST['sh8'] == 1){?><th width="9%"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
          <tr>
            <?php  if($_REQUEST['sh8'] == 1){?><th style="border:0;" width="50%">รายการอะไหล่</th><?php  }?>
          </tr>
        </table>
       </th><?php  }?>
       <?php  if($_REQUEST['sh9'] == 1){?><th width="15%">รายละเอียดบริการ</th><?php  }?>
       <?php  if($_REQUEST['sh10'] == 1){?><th width="5%">ชื่อช่าง</th><?php  }?>
      </tr>
      <?php  
		$sql = "SELECT * FROM s_first_order as fr, s_service_report3 as sv, s_service_report3sub as sb WHERE sv.cus_id = fr.fo_id and sv.sr_id = sb.sr_id ".$condition." ".$daterriod." GROUP BY sb.sr_id
		HAVING COUNT(sb.sr_id) > 1 ORDER BY fr.cd_name ASC";
	  	$qu_fr = @mysqli_query($conn,$sql);
		$sum = 0;
		while($row_fr = @mysqli_fetch_array($qu_fr)){
				
			?>
			<tr>
              <?php  if($_REQUEST['sh1'] == 1){?><td><?php  echo $row_fr['cd_name'];?><br />
              <?php  echo $row_fr['cd_tel'];?></td><?php  }?>
              <?php  if($_REQUEST['sh2'] == 1){?><td><?php  echo $row_fr['loc_name']."<br />".$row_fr['loc_address'];?></td><?php  }?>
              <?php  if($_REQUEST['sh3'] == 1){?><td><?php  echo getcustom_type($conn,$row_fr['sr_ctype2']);?></td>    <?php  }?> 
              <?php  if($_REQUEST['sh4'] == 1){?><td><?php  echo get_servicename($conn,$row_fr['sr_ctype']);?></td>  <?php  }?>   
              <?php  if($_REQUEST['sh5'] == 1 || $_REQUEST['sh6'] == 1){?><td><table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbreport" style="margin-bottom:5px;">
                <?php  
					if($row_fr['pro_pod1'] != ""){
						?>
                <tr>
                  <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['pro_pod1'];?></td><?php  }?>
                  <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['pro_sn1'];?></td><?php  }?>
                </tr>
                <?php 	
					}
				?>
                <?php  
					if($row_fr['pro_pod2'] != ""){
						?>
                <tr>
                  <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['pro_pod2'];?></td><?php  }?>
                  <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['pro_sn2'];?></td><?php  }?>
                </tr>
                <?php 	
					}
				?>
                <?php  
					if($row_fr['pro_pod3'] != ""){
						?>
                <tr>
                  <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['pro_pod3'];?></td><?php  }?>
                  <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['pro_sn3'];?></td><?php  }?>
                </tr>
                <?php 	
					}
				?>
                <?php  
					if($row_fr['pro_pod4'] != ""){
						?>
                <tr>
                  <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['pro_pod4'];?></td><?php  }?>
                  <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['pro_sn4'];?></td><?php  }?>
                </tr>
                <?php 	
					}
				?>
                <?php  
					if($row_fr['pro_pod5'] != ""){
						?>
                <tr>
                  <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['pro_pod5'];?></td><?php  }?>
                  <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['pro_sn5'];?></td><?php  }?>
                </tr>
                <?php 	
					}
				?>
                <?php  
					if($row_fr['pro_pod6'] != ""){
						?>
                <tr>
                  <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['pro_pod6'];?></td><?php  }?>
                  <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['pro_sn6'];?></td><?php  }?>
                </tr>
                <?php 	
					}
				?>
                <?php  
					if($row_fr['pro_pod6'] != ""){
						?>
                <tr>
                  <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['pro_pod7'];?></td><?php  }?>
                  <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;" width="50%"><?php  echo $row_fr['pro_sn7'];?></td><?php  }?>
                </tr>
                <?php 	
					}
				?>
              </table></td>    <?php  }?>
              <?php  if($_REQUEST['sh7'] == 1){?><td align="center"><?php  echo $row_fr['sv_id'];?></td><?php  }?>   
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
              <?php  if($_REQUEST['sh9'] == 1){?><td><?php  echo $row_fr['detail_recom2'];?></td><?php  }?>
              <?php  if($_REQUEST['sh10'] == 1){?><td><?php  echo get_technician_id($conn,$row_fr['loc_contact']);?></td><?php  }?>
      </tr>
			
			<?php 
			//$sum += ($row_fr['cprice1']+$row_fr['cprice2']+$row_fr['cprice3']+$row_fr['cprice4']+$row_fr['cprice5']);
			$sum += 1;
		}
		
	  ?>
      <tr>
			  <td colspan="9" align="right"><strong>ให้บริการตามการใช้อะไหล่ทั้งหมด</strong>&nbsp;&nbsp;&nbsp;<strong><?php  echo $sum;?>&nbsp;&nbsp;รายการ</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	  </tr>
    </table>

</body>
</html>
<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	$cd_name = $_REQUEST['cd_name'];
	$sfix = $_REQUEST['sfix'];
	$a_sdate=explode("/",$_REQUEST['date_fm']);
	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	$a_sdate=explode("/",$_REQUEST['date_to']);
	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	
	if($_REQUEST['priod'] == 0){
		$daterriod = " AND `sr_stime`  between '".$date_fm."' and '".$date_to."'"; 
		$dateshow = "เริ่มวันที่ : ".format_date($conn,$date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($conn,$date_to); 
	}
	else{
		$dateshow = "วันที่ค้นหา : ".format_date($conn,date("Y-m-d")); 
	}
	
	$condition = "";
	if($cd_name != ""){
		$condition .= " AND fr.cd_name LIKE '%".$cd_name."%'";
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>เลือกตามมูลค่าการใช้</title>
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
รายงานตามมูลค่าการใช้<br />
ประเภทลูกค้า  :
<?php  if($_POST['ctype'] != ""){echo custype_name($conn,$_POST['ctype']);}else{echo "ทั้งหมด";}?>
<br />
ประเภทบริการ  :
<?php  if($_POST['sr_ctype']){echo get_servicename($conn,$_POST['sr_ctype']);}else{echo "ทั้งหมด";}?></th>
	    <th width="47%" colspan="2" style="text-align:right;font-size:11px;vertical-align:bottom;"><?php  echo $dateshow;?></th>
      </tr>
      <tr>
        <th width="31%">ชื่อลูกค้า / บริษัท + เบอร์โทร</th>
        <th width="22%">จังหวัด</th>
        <th><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
          <tr>
            <th style="border:0;" width="50%">รายการอะไหล่</th>
            <th style="border:0;text-align:right;" width="50%">มูลค่าการใช้อะไหล่</th>
          </tr>
        </table>
       </th>
      </tr>
      <?php  
		$sql = "SELECT * FROM s_first_order as fr, s_service_report as sv WHERE sv.cus_id = fr.fo_id ".$condition." ".$daterriod." ORDER BY fr.cd_name ASC";
	  	$qu_fr = @mysqli_query($conn,$sql);
		$sum = 0;
		while($row_fr = @mysqli_fetch_array($qu_fr)){
				
			?>
			<tr>
              <td><?php  echo $row_fr['cd_name'];?><br />
              <?php  echo $row_fr['cd_tel'];?></td>
              <td><?php  echo province_name($conn,$row_fr['cd_province']);?></td>   
              <td style="padding:0;">
              	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport" style="margin-bottom:5px;">
                <?php  
					if($row_fr['cpro1'] != ""){
						?>
						<tr>
                          <td style="border:0;padding-bottom:0;" width="37%"><?php  echo get_sparpart_name($conn,$row_fr['cpro1']);?></td>
                          <td style="border:0;padding-bottom:0;text-align:right;" width="37%"><?php  echo number_format($row_fr['cprice1']);?>&nbsp;&nbsp;</td>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro2'] != ""){
						?>
						<tr>
                          <td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_sparpart_name($conn,$row_fr['cpro2']);?></td>
                          <td style="border:0;padding-bottom:0;padding-top:0;text-align:right;" width="33%"><?php  echo number_format($row_fr['cprice2']);?>&nbsp;&nbsp;</td>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro3'] != ""){
						?>
						<tr>
                          <td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_sparpart_name($conn,$row_fr['cpro3']);?></td>
                          <td style="border:0;padding-bottom:0;padding-top:0;text-align:right;" width="33%"><?php  echo number_format($row_fr['cprice3']);?>&nbsp;&nbsp;</td>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro4'] != ""){
						?>
						<tr>
                          <td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_sparpart_name($conn,$row_fr['cpro4']);?></td>
                          <td style="border:0;padding-bottom:0;padding-top:0;text-align:right;" width="33%"><?php  echo number_format($row_fr['cprice4']);?>&nbsp;&nbsp;</td>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro5'] != ""){
						?>
						<tr>
                          <td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_sparpart_name($conn,$row_fr['cpro5']);?></td>
                          <td style="border:0;padding-bottom:0;padding-top:0;text-align:right;" width="33%"><?php  echo number_format($row_fr['cprice5']);?>&nbsp;&nbsp;</td>
                        </tr>
						<?php 	
					}
				?>
              </table></td>      
            </tr>
			
			<?php 
			$sum += ($row_fr['cprice1']+$row_fr['cprice2']+$row_fr['cprice3']+$row_fr['cprice4']+$row_fr['cprice5']);
		}
		
	  ?>
      <tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td style="padding:5px 0 0;text-align:right;">มูลต่ารวมทั้งหมด&nbsp;&nbsp;&nbsp;<?php  echo number_format($sum);?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	  </tr>
    </table>

</body>
</html>
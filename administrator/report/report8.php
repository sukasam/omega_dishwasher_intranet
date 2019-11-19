<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	$cs_company = $_REQUEST['cs_company'];
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
	
	
	$codi = " AND status_use = 0";
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>เลือกตามชื่อช่างติดตั้งเครื่อง ( <?php  echo $cs_company;?> )</title>
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
        รายงานตามชื่อช่างติดตั้งเครื่อง ( <?php  echo $cs_company;?> )</th>
	    <th colspan="6" style="text-align:right;font-size:11px;"><?php  echo $dateshow;?></th>
      </tr>
      <tr>
        <th width="15%">ชื่อลูกค้า / บริษัท + เบอร์โทร</th>
        <th width="20%">ชื่อร้าน / สถานที่ติดตั้ง</th>
        <th>จังหวัด</th>
        <th>ประเภทลูกค้า</th>
        <th><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
          <tr>
            <th style="border:0;" width="37%">สินค้า</th>
            <th style="border:0;" width="37%">รุ่นเครื่อง/SN</th>
          </tr>
        </table></th>
        <th width="5%">วันที่ติดตั้ง</th>
        <th width="10%">ผู้ขาย</th>
      </tr>
      <?php  
		$sql = "SELECT * FROM s_first_order WHERE cs_company = '".$cs_company."'".$daterriod." ".$codi." ORDER BY date_forder ASC";
	  	$qu_fr = @mysqli_query($conn,$sql);
		$sum = 0;
		while($row_fr = mysqli_fetch_array($qu_fr)){
			?>
			<tr>
              <td><?php  echo $row_fr['cd_name'];?><br />
              <?php  echo $row_fr['cd_tel'];?></td>
              <td><?php  echo $row_fr['loc_name'];?><br />
              <?php  echo $row_fr['loc_address'];?></td>
              <td><?php  echo province_name($conn,$row_fr['cd_province']);?></td>
              <td><?php  echo custype_name($conn,$row_fr['ctype']);?></td>
              <td style="padding:0;">
              	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport" style="margin-bottom:5px;">
                <?php  
					if($row_fr['cpro1'] != ""){
						?>
						<tr>
                          <td style="border:0;padding-bottom:0;" width="37%"><?php  echo get_proname($conn,$row_fr['cpro1']);?></td>
                          <td style="border:0;padding-bottom:0;" width="37%"><?php  echo $row_fr['pro_pod1']." / ".$row_fr['pro_sn1'];?></td>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro2'] != ""){
						?>
						<tr>
                          <td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_proname($conn,$row_fr['cpro2']);?></td>
                          <td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo $row_fr['pro_pod2']." / ".$row_fr['pro_sn2'];?></td>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro3'] != ""){
						?>
						<tr>
                          <td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_proname($conn,$row_fr['cpro3']);?></td>
                          <td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo $row_fr['pro_pod3']." / ".$row_fr['pro_sn3'];?></td>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro4'] != ""){
						?>
						<tr>
                          <td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_proname($conn,$row_fr['cpro4']);?></td>
                          <td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo $row_fr['pro_pod4']." / ".$row_fr['pro_sn4'];?></td>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro5'] != ""){
						?>
						<tr>
                          <td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_proname($conn,$row_fr['cpro5']);?></td>
                          <td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo $row_fr['pro_pod5']." / ".$row_fr['pro_sn5'];?></td>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro6'] != ""){
						?>
						<tr>
                          <td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_proname($conn,$row_fr['cpro6']);?></td>
                          <td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo $row_fr['pro_pod6']." / ".$row_fr['pro_sn6'];?></td>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro7'] != ""){
						?>
						<tr>
                          <td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo get_proname($conn,$row_fr['cpro7']);?></td>
                          <td style="border:0;padding-bottom:0;padding-top:0;" width="33%"><?php  echo $row_fr['pro_pod7']." / ".$row_fr['pro_sn7'];?></td>
                        </tr>
						<?php 	
					}
				?>
              </table></td>
              <td style="text-align:right;"><?php  echo format_date($row_fr['cs_setting']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td><?php  echo get_sale_id($conn,$row_fr['cs_sell']);?></td>
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
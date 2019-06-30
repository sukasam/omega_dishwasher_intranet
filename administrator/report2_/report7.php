<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	$sfix = $_REQUEST['sfix'];
	$a_sdate=explode("/",$_REQUEST['date_fm']);
	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	$a_sdate=explode("/",$_REQUEST['date_to']);
	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	
	if($_REQUEST['priod'] == 0){
		$daterriod = " AND `date_forder`  between '".$date_fm."' and '".$date_to."'"; 
		$dateshow = "เริ่มวันที่ : ".format_date($conn,$date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($conn,$date_to); 
	}
	else{
		$dateshow = "วันที่ค้นหา : ".format_date($conn,date("Y-m-d")); 
	}
	
	$condition = "";
	
	if($sfix != ""){
		$condition .= " AND sv.ckf_list LIKE '%".$sfix."%'";
	}
	if($cd_name != ""){
		$condition .= " AND fr.cd_name LIKE '%".$cd_name."%'";
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>เลือกตามการอาการเสีย</title>
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
	    <th colspan="3" style="text-align:left;font-size:12px;">บริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด<br />
        รายงานตามอาการเสีย<br /></th>
	    <th width="33%" colspan="2" style="text-align:right;font-size:11px;"><?php  echo $dateshow;?></th>
      </tr>
      <tr>
        <th width="22%">ชื่อลูกค้า / บริษัท + เบอร์โทร</th>
        <th width="19%">จังหวัด</th>
        <th width="26%">เลขที่บริการ</th>
        <th>รายการอาการเสีย</th>
      </tr>
      <?php  
		$sql = "SELECT * FROM s_first_order as fr, s_service_report as sv WHERE fr.fo_id = sv.cus_id ".$condition." ".$daterriod." ORDER BY fr.cd_name ASC";
	  	$qu_fr = @mysqli_query($conn,$sql);
		$sum = 0;
		$sums = 0;
		while($row_fr = @mysqli_fetch_array($qu_fr)){
				
			?>
			<tr>
              <td><?php  echo $row_fr['cd_name'];?><br />
              <?php  echo $row_fr['cd_tel'];?></td>
              <td><?php  echo province_name($conn,$row_fr['cd_province']);?></td>
              <td><?php  echo $row_fr['sv_id'];?></td>     
              <td style="">
              	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbreport">
                  <?php  
				  	$chk = get_fixlist($row_fr['ckf_list']);
					for($i=0;$i<sizeof($chk);$i++){
						if(get_fixname($conn,$chk[$i]) != ""){
							?>
		  <tr>
							<td style="border:0;padding-bottom:0;padding-top:0;"><?php  echo get_fixname($conn,$chk[$i]);?></td>
						  	</tr>
							<?php 
						}
					}
				  ?>
                </table>
              </td>      
            </tr>
			
			<?php 
			$sum += ($row_fr['cprice1']+$row_fr['cprice2']+$row_fr['cprice3']+$row_fr['cprice4']+$row_fr['cprice5']);
			$sums += 1;
		}
		
	  ?>
      <tr>
		<td colspan="8" style="text-align:right;"> <strong>ให้บริการตามตามอาการเสียทั้งหมด&nbsp;&nbsp;<?php  echo $sums;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>
	  </tr>
    </table>

</body>
</html>
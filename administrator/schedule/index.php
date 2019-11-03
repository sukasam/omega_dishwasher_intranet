<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	

	if(!isset($_GET['month']) && !isset($_GET['year'])){
		$monthStart = date("n")+1;
		$yearStart = date('Y');
		header("Location:index.php?month=".$monthStart ."&year=".$yearStart);	
	}
	
	if($_GET['month']== "" && $_GET['year'] == ""){
		$monthStart = date("n")+1;
		$yearStart = date('Y');
	}else{
		$monthStart = $_GET['month'];
		$yesrStart = $_GET['year'];	
	}
	
	if($_GET['action'] == "delete"){
		$code = Check_Permission($conn,$check_module,$_SESSION["login_id"],"delete");		
		if ($code == "1") {
			$sql = "delete from $tbl_name  where $PK_field = '$_GET[$PK_field]'";
			@mysqli_query($conn,$sql);			
			header ("location:index.php");
		} 
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php  echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel="stylesheet" type=text/css href="../css/reset.css" media=screen>
<LINK rel="stylesheet" type=text/css href="../css/style.css" media=screen>
<LINK rel="stylesheet" type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.3.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/popup.js"></SCRIPT>
<META name=GENERATOR content="MSHTML 8.00.7600.16535">
<script>
function confirmDelete(delUrl,text) {
  if (confirm("Are you sure you want to delete\n"+text)) {
    document.location = delUrl;
  }
}
//----------------------------------------------------------
function check_select(frm){
		if (frm.choose_action.value==""){
			alert ('Choose an action');
			frm.choose_action.focus(); return false;
		}
}	

</script>


<link href="cal.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</HEAD>
<?php  include ("../../include/function_script.php"); ?>
<BODY>
<DIV id=body-wrapper>
<?php  include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php  include('../top.php');?>
<P id=page-intro><?php  echo $page_name; ?></P>

<UL class=shortcut-buttons-set>
  <!--<LI><A class=shortcut-button href="update.php?mode=add<?php  if ($param <> "") echo "&".$param; ?>"><SPAN><IMG  alt=icon src="../images/pencil_48.png"><BR>
    เพิ่ม</SPAN></A></LI>-->
    <?php  
	if ($FR_module <> "") { 
	$param2 = get_return_param();
	?>
  <LI><A class=shortcut-button href="../<?php  echo $FR_module; ?>/?<?php  if($param2 <> "") echo $param2;?>"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
  <?php  }?> 
</UL>
  
  <!-- End .shortcut-buttons-set -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right" style="padding-right:15px;">

<H3 align="left"><?php  echo $check_module; ?></H3>
<div style="padding-top:4px;">

	<?php  
		if($_GET['loccontact'] != ""){
			$paramLoc = "&loccontact=".$_GET['loccontact'];
		}
		
		if($_GET['sr_ctype'] != ""){
			$paramCtype = "&sr_ctype=".$_GET['sr_ctype'];
		}
		
	?>

	<select name="loccontact" id="loccontact" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)" style="height:30px;">
      <option value="index.php?month=<?php  echo $monthStart;?>&year=<?php  echo $yesrStart;?><?php  echo $paramCtype;?>"><== กรุณาเลือกชื่อช่าง ==></option>
          <?php  
              $qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
              while($row_custec = @mysqli_fetch_array($qu_custec)){
                  ?>
                  <option value="index.php?month=<?php  echo $monthStart;?>&year=<?php  echo $yesrStart;?>&loccontact=<?php  echo $row_custec['group_id'];?><?php  echo $paramCtype;?>" <?php  if($row_custec['group_id'] == $_GET['loccontact']){echo 'selected';}?>><?php  echo $row_custec['group_name']. " (Tel : ".$row_custec['group_tel'].")";?></option>
                  <?php 
              }
          ?>
      </select>
      
      <select name="sr_ctype" id="sr_ctype" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)" style="height:30px;display: none;">
                <option value="index.php?month=<?php  echo $monthStart;?>&year=<?php  echo $yesrStart;?><?php  echo $paramLoc;?>"><== กรุณาเลือกประเภทบริการลูกค้า ==></option>
                	<?php  
						$qu_cusftype = @mysqli_query($conn,"SELECT * FROM s_group_service ORDER BY group_name ASC");
						while($row_cusftype = @mysqli_fetch_array($qu_cusftype)){
							?>
							<option value="index.php?month=<?php  echo $monthStart;?>&year=<?php  echo $yesrStart;?><?php  echo $paramLoc;?>&sr_ctype=<?php  echo $row_cusftype['group_id'];?>" <?php  if($row_cusftype['group_id'] == $_GET['sr_ctype']){echo 'selected';}?>><?php  echo $row_cusftype['group_name'];?></option>
							<?php 
						}
					?>
      </select>
</div>
<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
  <?php 

function getmicrotime(){ 
    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 
} 

$time_start = getmicrotime();

if(!isset($_GET['year'])){
    $_GET['year'] = date("Y");
}
if(!isset($_GET['month'])){
    $_GET['month'] = date("n")+1;
}

$month = addslashes($_GET['month'] - 1);
$year = addslashes($_GET['year']);

if(isset($_GET['loccontact'])){
	$getLocontract = "&loccontact=".$_GET['loccontact'];
}else{
	$getLocontract = "";
}

if(isset($_GET['sr_ctype'])){
	$getSr_ctype = "&sr_ctype=".$_GET['sr_ctype'];
}else{
	$getSr_ctype = "";
}

/*$query = "SELECT event_id,event_title,event_day,event_time FROM $db_table WHERE event_month='$month' AND event_year='$year' ORDER BY event_time";
$query_result = @mysqli_query($conn,$query);
while ($info = @mysqli_fetch_array($query_result))
{
    $day = $info['event_day'];
    $event_id = $info['event_id'];
    $events[$day][] = $info['event_id'];
    $event_info[$event_id]['0'] = substr($info['event_title'], 0, 8);;
    $event_info[$event_id]['1'] = $info['event_time'];
}*/

$todays_date = date("j");
$todays_month = date("n");

$days_in_month = date ("t", mktime(0,0,0,$_GET['month'],0,$_GET['year']));
$first_day_of_month = date ("w", mktime(0,0,0,$_GET['month']-1,1,$_GET['year']));
$first_day_of_month = $first_day_of_month + 1;
$count_boxes = 0;
$days_so_far = 0;

if($_GET['month'] == 13){
    $next_month = 2;
    $next_year = $_GET['year'] + 1;
} else{
    $next_month = $_GET['month'] + 1;
    $next_year = $_GET['year'];
}

if($_GET['month'] == 2){
    $prev_month = 13;
    $prev_year = $_GET['year'] - 1;
} else{
    $prev_month = $_GET['month'] - 1;
    $prev_year = $_GET['year'];
}



?>


<div align="center"><span class="currentdate"><?php  echo format_month_th(date ("F", mktime(0,0,0,$_GET['month']-1,1,$_GET['year'])))." ".(date ("Y", mktime(0,0,0,$_GET['month']-1,1,$_GET['year']))+543); ?></spanbr>
  <br>
</div>
<div align="center"><br>
  <table width="700" border="0" cellspacing="0" cellpadding="0" style="display: none;">
    <tr> 
      <td><div align="right"><a href="<?php  echo "index.php?month=$prev_month&amp;year=$prev_year$getLocontract$getSr_ctype"?>">&lt;&lt;</a></div></td>
      <td width="200"><div align="center">
            
          <select name="month" id="month" onChange="MM_jumpMenu('parent',this,0)">
            <?php 
			for ($i = 1; $i <= 12; $i++) {
				$link = $i+1;
				IF($_GET['month'] == $link){
					$selected = "selected";
				} ELSE {
					$selected = "";
				}
				echo "<option value=\"index.php?month=$link&amp;year=$_GET[year]$getLocontract$getSr_ctype\" $selected>" . format_month_th(date ("F", mktime(0,0,0,$i,1,$_GET['year']))) . "</option>\n";
			}
			?>
          </select>
          <select name="year" id="year" onChange="MM_jumpMenu('parent',this,0)" style="">
		  <?php 
		  for ($i = date("Y")-10; $i <= (date("Y"))+5; $i++) {
		  	IF($i == $_GET['year']){
				$selected = "selected";
			} ELSE {
				$selected = "";
			}
		  	echo "<option value=\"index.php?month=$_GET[month]&amp;year=$i$getLocontract$getSr_ctype\" $selected>".($i+543)."</option>\n";
		  }
		  ?>
          </select>
        </div></td>
      <td><div align="left"><a href="<?php  echo "index.php?month=$next_month&amp;year=$next_year$getLocontract$getSr_ctype"; ?>">&gt;&gt;</a></div></td>
    </tr>
  </table>
  <br>
</div>
<style>
	.tableSc tr th{
		text-align: center;
    	vertical-align: middle;
	}	
	.tableSc tr td{
		text-align: center;
    	vertical-align: middle;
	}	
</style>

<?php
	$condition = "";
	$getMonth = $_GET['month']-1;
	
	if($getMonth % 2 == 0){
		$condition.= " AND type_service != 31";
	}else{
		$condition.= " AND type_service != 1";
	}
	
	if($getMonth != 3 && $getMonth != 6 && $getMonth != 9 && $getMonth != 12){
		$condition.= " AND type_service != 2";
	}
	
	if($getMonth != 4 && $getMonth != 8 && $getMonth != 12){
		$condition.= " AND type_service != 3";
	}
	
	$condition.= " AND type_service != '0'";
	
	$sqlSched = "SELECT * FROM `s_first_order` WHERE `technic_service` = ".$_GET['loccontact'].$condition." AND status_use != '2' ORDER BY `cd_province` ,`loc_name` ASC;";
	
	$quSched = mysqli_query($conn,$sqlSched);
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableSc">
  <tbody>
    <tr>
      <th>ลำดับ</th>
      <th>ลูกค้า</th>
      <th>เครื่อง</th>
      <th>รุ่น</th>
      <th>S/N</th>
      <th>จังหวัด</th>
      <th>ชนิดลูกค้า</th>
      <th>ระยะเวลา</th>
      <th>FOID</th>
<!--      <th>ดาวโหลด</th>-->
    </tr>
    <?php 
	  $runRow = 1;
	  while($rowSched = mysqli_fetch_array($quSched)){
		  
		  $getFileSH = getScheduleFile($conn,$_GET['loccontact'],$_GET['month']-1,$rowSched['fs_id']);
		  
		  if($rowSched['cpro2'] == 1 || $rowSched['cpro2'] == 2 || $rowSched['cpro2'] == 99 || $rowSched['cpro2'] == 148 || $rowSched['cpro2'] == 201){
			  
			  if($rowSched['cpro1'] == 147){
				  if($getMonth == 3 || $getMonth == 6 || $getMonth == 9 || $getMonth == 12){
				  ?>
				<tr>
				  <td><?php echo $runRow++;?></td>
				  <td style="text-align: left;"><?php echo $rowSched['loc_name'];?></td>
				  <td><?php echo get_proname($conn,$rowSched['cpro1']);?></td>
				  <td><?php echo $rowSched['pro_pod1'];?></td>
				  <td><?php echo $rowSched['pro_sn1'];?></td>
				  <td><?php echo province_name($conn,$rowSched['cd_province']);?></td>
				  <td><?php echo custype_name($conn,$rowSched['ctype']);?></td>
				  <td><?php if($rowSched['cpro1'] == 147){echo "งานบริการประจำ 3 เดือน/ครั้ง";}else{echo get_servicename($conn,$rowSched['type_service']);}?></td>
				  <td><?php echo $rowSched['fs_id'];?></td>
				  
<!--		
				  <td>
					<?php
					if(file_exists("../../upload/service_report_open/".$getFileSH['pdf'])){
				  ?>
				  <a href="../../upload/service_report_open/<?php echo $getFileSH['pdf'];?>" target="_blank"><?php echo $getFileSH['pdf'];?></a>
				  <?php }?>
				  </td>
-->
				</tr>
				  <?php
				  }
			  }else{
				  ?>
				<tr>
				  <td><?php echo $runRow++;?></td>
				  <td style="text-align: left;"><?php echo $rowSched['loc_name'];?></td>
				  <td><?php echo get_proname($conn,$rowSched['cpro1']);?></td>
				  <td><?php echo $rowSched['pro_pod1'];?></td>
				  <td><?php echo $rowSched['pro_sn1'];?></td>
				  <td><?php echo province_name($conn,$rowSched['cd_province']);?></td>
				  <td><?php echo custype_name($conn,$rowSched['ctype']);?></td>
				  <td><?php if($rowSched['cpro1'] == 147){echo "งานบริการประจำ 3 เดือน/ครั้ง";}else{echo get_servicename($conn,$rowSched['type_service']);}?></td>
				  <td><?php echo $rowSched['fs_id'];?></td>
<!--
				  <td>
				  	<?php
					if(file_exists("../../upload/service_report_open/".$getFileSH['pdf'])){
				  ?>
				  <a href="../../upload/service_report_open/<?php echo $getFileSH['pdf'];?>" target="_blank"><?php echo $getFileSH['pdf'];?></a>
				  <?php }?>
				  </td>
-->
				</tr>
				  <?php
			  }
			  
			  if($rowSched['cpro2'] == 147){
				  if($getMonth == 3 || $getMonth == 6 || $getMonth == 9 || $getMonth == 12){
				   ?>
				   <tr>
					  <td><?php echo $runRow++;?></td>
					  <td style="text-align: left;"><?php echo $rowSched['loc_name'];?></td>
					  <td><?php echo get_proname($conn,$rowSched['cpro2']);?></td>
					  <td><?php echo $rowSched['pro_pod2'];?></td>
					  <td><?php echo $rowSched['pro_sn2'];?></td>
					  <td><?php echo province_name($conn,$rowSched['cd_province']);?></td>
					  <td><?php echo custype_name($conn,$rowSched['ctype']);?></td>
					  <td><?php if($rowSched['cpro2'] == 147){echo "งานบริการประจำ 3 เดือน/ครั้ง";}else{echo get_servicename($conn,$rowSched['type_service']);}?></td>
					  <td><?php echo $rowSched['fs_id'];?></td>
<!--
					  <td>
					   <?php
					if(file_exists("../../upload/service_report_open/".$getFileSH['pdf'])){
				  ?>
				  <a href="../../upload/service_report_open/<?php echo $getFileSH['pdf'];?>" target="_blank"><?php echo $getFileSH['pdf'];?></a>
				  <?php }?>
					   </td>
-->
					</tr>
				  <?php
				  }
			  }else{
				   ?>
			   <tr>
				  <td><?php echo $runRow++;?></td>
				  <td style="text-align: left;"><?php echo $rowSched['loc_name'];?></td>
				  <td><?php echo get_proname($conn,$rowSched['cpro2']);?></td>
				  <td><?php echo $rowSched['pro_pod2'];?></td>
				  <td><?php echo $rowSched['pro_sn2'];?></td>
				  <td><?php echo province_name($conn,$rowSched['cd_province']);?></td>
				  <td><?php echo custype_name($conn,$rowSched['ctype']);?></td>
				  <td><?php if($rowSched['cpro2'] == 147){echo "งานบริการประจำ 3 เดือน/ครั้ง";}else{echo get_servicename($conn,$rowSched['type_service']);}?></td>
				  <td><?php echo $rowSched['fs_id'];?></td>
<!--
				  <td>
				   <?php
					if(file_exists("../../upload/service_report_open/".$getFileSH['pdf'])){
				  ?>
				  <a href="../../upload/service_report_open/<?php echo $getFileSH['pdf'];?>" target="_blank"><?php echo $getFileSH['pdf'];?></a>
				  <?php }?>
				   </td>
-->
				</tr>
			  <?php
			  }
			  
			 
		  }else{
			  ?>
				<tr>
				  <td><?php echo $runRow++;?></td>
				  <td style="text-align: left;"><?php echo $rowSched['loc_name'];?></td>
				  <td><?php echo get_proname($conn,$rowSched['cpro1']);?></td>
				  <td><?php echo $rowSched['pro_pod1'];?></td>
				  <td><?php echo $rowSched['pro_sn1'];?></td>
				  <td><?php echo province_name($conn,$rowSched['cd_province']);?></td>
				  <td><?php echo custype_name($conn,$rowSched['ctype']);?></td>
				  <td><?php echo get_servicename($conn,$rowSched['type_service']);?></td>
				  <td><?php echo $rowSched['fs_id'];?></td>
<!--
				  <td>
				  <?php
					if(file_exists("../../upload/service_report_open/".$getFileSH['pdf'])){
				  ?>
				  <a href="../../upload/service_report_open/<?php echo $getFileSH['pdf'];?>" target="_blank"><?php echo $getFileSH['pdf'];?></a>
				  <?php }?>
				  </td>
-->
				</tr>
			<?php
		 }
		  
	  }
	?>
  </tbody>
</table>

<?php
	if($_GET['loccontact'] != ""){
		?>
		<div style="text-align: center;margin-top: 20px;">
<?php $linkPrint = "print.php?month=".$_GET['month']."&year=".$_GET['year']."&loccontact=".$_GET['loccontact'];?>
<input type="image" src="icon_print.png" alt="Submit" width="48" style="background-color: #dddddd;padding: 10px 40px;border-radius: 5px;" onclick="window.open('<?php echo $linkPrint;?>');">
<?php
	$getMonth = $_GET['month']-1;
	$getYear = $_GET['year'];
		
	$quGen = mysqli_query($conn,"SELECT * FROM service_schedule WHERE month = '".$getMonth."' AND technician = '".$_GET['loccontact']."' AND year= '".$getYear."'");
		
	$numCreated = mysqli_num_rows($quGen);
	//echo $numCreated;
	if($numCreated == 0){
		$linkGenPDF = "createService.php?month=".$_GET['month']."&year=".$_GET['year']."&loccontact=".$_GET['loccontact'];
		?>
		<input type="image" src="icon_genPDF.png" alt="Submit" width="40" style="background-color: #dddddd;padding: 10px 40px;border-radius: 5px;" onclick="window.open('<?php echo $linkGenPDF;?>');">
		<?php
	}else{
		$linkGenPDF = "createService.php?month=".$_GET['month']."&year=".$_GET['year']."&loccontact=".$_GET['loccontact'];
//		$linkGenPDF2 = "createService_test.php?month=".$_GET['month']."&year=".$_GET['year']."&loccontact=".$_GET['loccontact'];
		?>
		<input type="image" src="icon_pdf_print.png" alt="Submit" width="48" style="background-color: #dddddd;padding: 10px 40px;border-radius: 5px;" onclick="window.open('<?php echo $linkGenPDF;?>');">
<!--		&nbsp;&nbsp;<input type="image" src="icon_pdf_print.png" alt="Submit" width="48" style="background-color: #dddddd;padding: 10px 40px;border-radius: 5px;" onclick="window.open('<?php echo $linkGenPDF2;?>');">-->
		<?php
	}
?>

</div>
		<?php
	}
?>
<br>
<div><img src="icon_print.png" width="25"> พิพม์ใบปะใบงาน</div><br>
<div><img src="icon_genPDF.png" width="25"> สร้างใบเปิดใบงาน</div><br>
<div><img src="icon_pdf_print.png" width="25"> พิพม์ใบเปิดใบงาน</div>

</DIV><!-- End #tab1 -->


</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php  include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
</BODY>
</HTML>

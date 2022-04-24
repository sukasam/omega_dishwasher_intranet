<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);

	if($_SESSION['QR_FIELD'] == ""){
		echo "<script>window.location='../scanqr/index.php';</script>";
	}

	$getFO = get_firstorder_qr($conn,$_SESSION['QR_FIELD']);

	$serviceID = mysqli_fetch_array(mysqli_query($conn,"SELECT sr . * , fd.cd_name FROM s_service_report AS sr, s_first_order AS fd WHERE sr.cus_id = fd.fo_id AND `loc_sn` = '".$_SESSION["QR_FIELD"]."' and ( cus_id = '".$getFO["fo_id"]."' ) order by sr.sr_id DESC limit 0,1"));
	$serviceLogin = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM s_service_report WHERE sr_id = '".$serviceID['sr_id']."'"));
	if(empty($serviceLogin['server_before'])){
		//echo "Not have";
		$dateTine = date('Y-m-d H:i:s');
		// echo "UPDATE `s_service_report` SET `server_before` = '".$dateTine."' WHERE `s_service_report`.`sr_id` = ".$serviceLogin['sr_id'].";";
		@mysqli_query($conn,"UPDATE `s_service_report` SET `server_before` = '".$dateTine."' WHERE `s_service_report`.`sr_id` = ".$serviceLogin['sr_id'].";");
	}else{
		//echo "have";
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php  echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel="stylesheet" type=text/css href="../css/reset.css" media=screen>
<LINK rel="stylesheet" type=text/css href="../css/style.css" media=screen>
<!--<LINK rel="stylesheet" type=text/css href="../css/invalid.css" media=screen>-->
<META name=GENERATOR content="MSHTML 8.00.7600.16535">

<script src="../js/jquery-1.9.1.min.js"></script>

<style>
input, label {vertical-align:middle}
.qrcode-text {padding-right:1.7em; margin-right:0;border: none;}
.qrcode-text-btn {display:inline-block; background:url(qrcode.svg) 50% 50% no-repeat; height:15em; width:12.7em; margin-left:-1.7em; cursor:pointer}
.qrcode-text-btn > input[type=file] {position:absolute; overflow:hidden; width:1px; height:1px; opacity:0}
.hide{display: none;}
</style>


</HEAD>

<BODY>
<DIV id=body-wrapper>
<?php  include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php  include('../top.php');?>
<br><br>
  
  <!-- End .shortcut-buttons-set -->

<DIV class=content-box><!-- Start Content Box -->
	<DIV class=content-box-header align="right">
		<H3 align="left"><?php  echo $check_module; ?> <!--latitude : <?php echo $_SESSION["LATITUDE"];?>, longitude : <?php echo $_SESSION["LONGITUDE"];?>--></H3>
		<DIV class=clear></DIV>
	</DIV>

	<DIV class="content-box-content">
		<?php
//		echo $_SESSION["QR_FIELD"]."<br>";
//		echo $_SESSION["QR_DATABASE"]."<br>";
//		echo $_SESSION["QR_TARGET"]."<br>";
	
//		if($_SESSION['QR_TARGET'] === 'SV'){
//			
//			$getSV = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM s_service_report WHERE sr_id =".$_SESSION['QR_FIELD']));
//			$getFO = get_firstorder($conn,$getSV['cus_id']);
//		}else{
//			$getFO = get_firstorder($conn,$_SESSION['QR_FIELD']);
//		}
		
		
		//echo $_SESSION['QR_FIELD'];
		?>
		
		<div class="bbmainmenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbmainindex">
      <tr>
        <td width="25%">
        <?php
			$chafFO = str_replace("/","-",$getFO["fs_id"]);
		?>
        <a href="../../upload/first_order/<?php  echo $chafFO;?>.pdf" target="_blank"><img src="../images/menu/frish_order_qr.png" width="151" height="130" border="0" alt="" /></a>
        
        </td>
        <td  width="25%">
        <?php

			/*if($_SESSION['QR_TARGET'] == 'SV'){
				$chafSV = str_replace("/","-",$getSV["sv_id"]);
			?>
				<a href="../../upload/service_report_open/<?php  echo $chafSV;?>.pdf" target="_blank"><img src="../images/menu/service-form_qr.png" width="151" height="130" border="0" alt="" /></a>
				<?php
			}else{
				?>
				<a href="../service_report/service.php?cus_id=<?php echo $_SESSION['QR_FIELD'];?>"><img src="../images/menu/service-form_qr.png" width="151" height="130" border="0" alt="" /></a>
				<?php
			}*/
		?>
       <a href="../service_report/service.php?cus_id=<?php echo $getFO["fo_id"];?>" target="_blank"><img src="../images/menu/service-form_qr.png" width="151" height="130" border="0" alt="" /></a>
        </td>
        <td  width="25%">
			<a href="../order_solution/update.php?mode=add&cus_id=<?php echo $getFO["fo_id"];?>" target="_blank"><img src="../images/menu/service-form_ordersolution.png" width="151" height="130" border="0" alt="" /></a>
		</td>
        <td  width="25%"></td>
      </tr>
     
    </table>
</div>
		
	</DIV>

</DIV>
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php  include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
</BODY>
</HTML>

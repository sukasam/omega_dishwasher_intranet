<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	//Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php  echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel="stylesheet" type=text/css href="../css/reset.css" media=screen>
<LINK rel="stylesheet" type=text/css href="../css/style.css" media=screen>
<LINK rel="stylesheet" type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.9.1.min.js"></SCRIPT>
<!--<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>-->
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
<META name=GENERATOR content="MSHTML 8.00.7600.16535"></HEAD>
<BODY onLoad="clock();">
<DIV id=body-wrapper>
<?php  include("../left.php");?>
<DIV id=main-content><!-- Main Content Section with everything --><NOSCRIPT><!-- Show a notification if the user has disabled javascript -->
</NOSCRIPT><!-- Page Head -->
<?php  //include('../top.php');?>

<div class="bbmainmenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbmainindex">
      <tr>
        <td width="25%"><a href="../first_order/?mid=12"><img src="../images/menu/frish_order_01.png" width="136" height="139" border="0" alt="" /></a></td>
        <td  width="25%"><a href="../service_report/?mid=13"><img src="../images/menu/service-form_01.png" width="151" height="130" border="0" alt="" /></a></td>
        <td  width="25%"><a href="../schedule/?mid=14"><img src="../images/menu/service-schedule_01.png" width="198" height="124" border="0" alt="" /></a></td>
        <td  width="25%"><a href="../report/?mid=16"><img src="../images/menu/report_01.png" width="111" height="158" border="0" alt="" /></a></td>
      </tr>
      <tr>
        <td colspan="3"><br /><br /><br /></td>
      </tr>
      <tr>
        <td><a href="../quotation/"><img src="../images/menu/quotation-form_01.png" width="151" border="0" alt="" /></a></td>
        <td><a href="../contract/"><img src="../images/menu/contract-form_01.png" width="151" border="0" alt="" /></a></td>
        <td><a href="../setting/"><img src="../images/menu/setting_01.png" width="97" height="134" border="0" alt="" /></a></td>
        <td><a href="../logout.php"><img src="../images/menu/logout_01.png" width="108" height="126" border="0" alt=""></a></td>
      </tr>
      <tr>
        <td colspan="3"><br /><br /></td>
      </tr>
      <tr>
        <td colspan="3" style="text-align:left;">
        <script type="text/javascript" src="../js/clock.js"></script>
           <div class="boxclock">
                <ul>
                    <li><div id="clockDiv"></div></li>
                    <li><div id="dateDiv"></div><div id="yearDiv"></div></li>
                </ul>
                <div class="clear"></div>
           </div>
        </td>
      </tr>
    </table>
</div>

<?php  //include('../footer.php');?>
</DIV>
<!-- End #main-content -->
</DIV>
</BODY>
</HTML>

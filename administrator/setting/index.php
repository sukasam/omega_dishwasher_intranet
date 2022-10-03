<?php
include("../../include/config.php");
include("../../include/connect.php");
include("../../include/function.php");
//Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">

<HEAD>
  <TITLE><?php echo $s_title; ?></TITLE>
  <META content="text/html; charset=utf-8" http-equiv=Content-Type>
  <LINK rel="stylesheet" type=text/css href="../css/reset.css" media=screen>
  <LINK rel="stylesheet" type=text/css href="../css/style.css" media=screen>
  <LINK rel="stylesheet" type=text/css href="../css/invalid.css" media=screen>
  <SCRIPT type=text/javascript src="../js/jquery-1.9.1.min.js"></SCRIPT>
  <!--<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>-->
  <SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
  <META name=GENERATOR content="MSHTML 8.00.7600.16535">
</HEAD>

<BODY onLoad="clock();">
  <DIV id=body-wrapper>
    <?php include("../left.php"); ?>
    <DIV id=main-content>
      <!-- Main Content Section with everything --><NOSCRIPT>
        <!-- Show a notification if the user has disabled javascript -->
      </NOSCRIPT><!-- Page Head -->
      <?php include('../top.php'); ?>

      <div class="bbmainmenu">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbmainindex">
          <tr>
            <td width="25%">
              <div align="center"><a href="../group_type/?mid=5"><img src="../images/menu/mn_serting01.png" width="71" height="60" border="0" alt=""><br><br><strong>กลุ่มลูกค้า</strong></a></div>
            </td>
            <td width="25%">
              <div align="center"><a href="../group_custommer/?mid=6"><img src="../images/menu/mn_serting02.png" width="89" height="61" border="0" alt=""><br><br><strong>ประเภทลูกค้า</strong></a></div>
            </td>
            <td width="25%">
              <div align="center"><a href="../group_service/?mid=7"><img src="../images/menu/mn_serting03.png" width="77" height="61" border="0" alt=""><br><br><strong>ประเภทบริการลูกค้า</strong></a></div>
            </td>
            <td width="25%">
              <div align="center"><a href="../group_product/?mid=8"><img src="../images/menu/mn_serting04.png" width="62" height="60" border="0" alt=""><br><br><strong>ประเภทสินค้า</strong></a></div>
            </td>
          </tr>
          <tr>
            <td colspan="4"><br /><br /><br /></td>
          </tr>
          <tr>
            <td>
              <div align="center"><a href="../group_typeproduct?mid=11"><img src="../images/menu/mn_serting05.png" width="62" height="60" border="0" alt=""><br><br><strong>รายการสินค้า</strong></a></div>
            </td>
            <td>
              <div align="center"><a href="../group_sparpart/?mid=9"><img src="../images/menu/mn_serting06.png" width="68" height="60" border="0" alt=""><br><br><strong>รายการอะไหล่</strong></a></div>
            </td>
            <td>
              <div align="center"><a href="../group_fix?mid=10"><img src="../images/menu/mn_serting07.png" width="77" height="60" border="0" alt=""><br><br><strong>รายการแจ้งซ่อม</strong></a></div>
            </td>
            <td>
              <div align="center"><a href="../group_technician/?mid=17"><img src="../images/menu/menu_tec.png" width="77" height="60" border="0" alt=""><br><br><strong>รายชื่อพนักงานช่าง</strong></a></div>
            </td>
          </tr>
          <tr>
            <td colspan="4"><br /><br /><br /></td>
          </tr>
          <tr>
            <td>
              <div align="center"><a href="../group_sale/"><img src="../images/menu/mn_serting02.png" width="89" height="61" border="0" alt=""><br><br>
                </a><a href="../group_sale/"><strong>รายชื่อพนักงานขาย</strong></a></div>
            </td>
            <td>
              <div align="center"><a href="../backup_database/"><img src="../images/menu/backup-database.png" alt="" width="96" height="58" border="0"><br><br><strong>สำรองฐานข้อมูล</strong></a></div>
            </td>
            <td>
              <div align="center"><a href="../user/?smid=3&mid=9999"><img src="../images/menu/mn_serting08.png" width="100" height="60" border="0" alt=""><br><br><strong>ผู้ใช้งาน / การอนุญาต</strong></a></div>
            </td>
            <td>
              <div align="center"><a href="../group/?smid=4&mid=9999"><img src="../images/menu/mn_serting09.png" width="106" height="60" border="0" alt=""><br><br><strong>กลุ่มผู้ใช้งาน / การอนุญาต</strong></a></div>
            </td>
          </tr>
          <tr>
            <td colspan="4"><br /><br /></td>
          </tr>
          <tr>
            <td>
              <div align="center"><a href="../group_pod/?inv=0"><img src="../images/menu/serial.png" width="89" height="61" border="0" alt=""><br>
                  <br>
                  <strong>รายการคลังสินค้า</strong></a></div>
            </td>
            <!--
        <td><div align="center"><a href="../group_sn/"><img src="../images/menu/serial2.png" width="89" height="61" border="0" alt=""><br>
              <br>
        <strong>รายการซีรี่ย์สินค้า</strong></a></div></td>
-->
            <td>
              <div align="center"><a href="../group_approve/"><img src="../images/menu/mn_serting08.png" width="100" height="60" border="0" alt=""><br><br><strong>กำหนดผู้อนุมัติเอกสาร</strong></a></div>
            </td>
            <td>
              <div align="center"><a href="../group_notification/"><img src="../images/menu/mn_notifications.png" width="100" height="60" border="0" alt=""><br><br><strong>ระบบแจ้งเตือนการอนุมัติ</strong></a></div>
            </td>
            <td>
              <div align="center"><a href="../order_solution/"><img src="../images/menu/mn_serting051.png" width="62" height="60" border="0" alt=""><br><br><strong>ระบบใบสั่งน้ำยา</strong></a></div>
      </div>
      </td>
      </tr>
      <tr>
        <td colspan="4"><br /><br /></td>
      </tr>

      <tr>
        <td>
          <div align="center"><a href="../group_headpaper/"><img src="../images/menu/head-paper.png" width="89" height="61" border="0" alt=""><br><br><strong>ประเภทหัวกระดาษ</strong></a></div>
        </td>
        <td>
          <div align="center"><a href="../group_cat_pro/"><img src="../images/menu/icon-catpro.png" width="89" height="61" border="0" alt=""><br><br><strong>หมวดหมู่สินค้า</strong></a></div>
        </td>
        <td>
          <div align="center"><a href="../group_cat_spare/"><img src="../images/menu/icon-catspare.png" width="89" height="61" border="0" alt=""><br><br><strong>หมวดหมู่อะไหล่</strong></a></div>
        </td>
        <td>
          <div align="center"></div>
    </div>
    </td>
    </tr>
    <!--
      <tr>
        <td colspan="4" style="text-align:left;">
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
-->
    </table>
  </div>

  <?php  //include('../footer.php');
  ?>
  </DIV>
  <!-- End #main-content -->
  </DIV>
</BODY>

</HTML>
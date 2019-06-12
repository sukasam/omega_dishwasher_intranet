<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission ($check_module,$_SESSION[login_id],"read");
	if ($_GET[page] == ""){$_REQUEST[page] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	if($_GET[action] == "delete"){
		$code = Check_Permission ($check_module,$_SESSION["login_id"],"delete");		
		if ($code == "1") {
			$sql = "delete from $tbl_name  where $PK_field = '$_GET[$PK_field]'";
			@mysql_query($sql);			
			header ("location:index.php");
		} 
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php  echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="../css/reset.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/style.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.3.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/popup.js"></SCRIPT>
<META name=GENERATOR content="MSHTML 8.00.7600.16535">

<script language="JavaScript" src="../Carlender/calendar_us.js"></script>
<link rel="stylesheet" href="../Carlender/calendar.css">

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
  <LI><A class=shortcut-button href="../report/?mid=16"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
        <strong>First Order</strong></SPAN></A></LI>
  <LI><A class=shortcut-button href="../report2/?mid=16"><SPAN><IMG  alt=icon src="../images/icons/icon-48-section.png"><BR>
        <strong>Service Report</strong></SPAN></A></LI>
</UL>
  
  <!-- End .shortcut-buttons-set -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right" style="padding-right:15px;">

<H3 align="left"><?php  echo $page_name; ?></H3>
<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
<UL class=shortcut-buttons-set>
      <LI><A class=shortcut-button href="../report2/?mid=16&act=1"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ใบเปิดงาน<br>
      <br></strong></SPAN></A></LI>
      <LI><A class=shortcut-button href="../report2/?mid=16&act=2"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ใบปิดงาน<br>
      <br></strong></SPAN></A></LI>
      <LI><A class=shortcut-button href="../report2/?mid=16&act=3"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ตามกลุ่มลูกค้า</strong><br>
      <br>
      </SPAN></A></LI>
      <!--<LI><A class=shortcut-button href="../report2/?mid=16&act=4"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ลูกค้าแต่ละกลุ่ม<br><br></strong></SPAN></A></LI>-->
      <LI><A class=shortcut-button href="../report2/?mid=16&act=5"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ตามรายการ<br>แจ้งซ่อม</strong></SPAN></A></LI>
      <LI><A class=shortcut-button href="../report2/?mid=16&act=6"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ตามรายการ<br>ใช้อะไหล่</strong></SPAN></A></LI>
      <!--<LI><A class=shortcut-button href="../report2/?mid=16&act=7"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ตามอาการเสีย<br><br></strong></SPAN></A></LI>-->
      <!--<LI><A class=shortcut-button href="../report2/?mid=16"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ใบเสนอราคา<br><br></strong></SPAN></A></LI>-->
      <LI><A class=shortcut-button href="../report2/?mid=16&act=8"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ตามชื่อช่าง<br>
      <br>
      </strong></SPAN></A></LI>
      <!--<LI><A class=shortcut-button href="../report2/?mid=16&act=9"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ตามเขต<br>จังหวัด</strong></SPAN></A></LI>-->
      <LI><A class=shortcut-button href="../report2/?mid=16&act=10"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ตามมูลค่าการใช้      <br>
      </strong><br>
      </SPAN></A></LI>
  </UL>
  <DIV class="clear"></DIV>
</DIV><!-- End #tab1 -->


<?php  
	if($_GET['act'] == 1){
		?>
		<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามใบเปิดงาน</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report1.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check1(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr >
                            <td nowrap class="name">ประเภทบริการ</td>
                            <td><select name="sr_ctype" id="sr_ctype">
                              <option value="">กรุณาเลือก</option>
                              <?php  
                                    $qu_cusftype = @mysql_query("SELECT * FROM s_group_service ORDER BY group_name ASC");
                                    while($row_cusftype = @mysql_fetch_array($qu_cusftype)){
                                        ?>
                              <option value="<?php  echo $row_cusftype['group_id'];?>" <?php  if($row_cusftype['group_id'] == $sr_ctype){echo 'selected';}?>><?php  echo $row_cusftype['group_name'];?></option>
                              <?php 
                                    }
                                ?>
                            </select></td>
                          </tr>
                          <tr >
                            <td width="10%" nowrap class="name">ประเภทลูกค้า</td>
                            <td width="90%">
                            <select name="ctype" id="ctype" class="inputselect" >
                            	<option value="">กรุณาเลือก</option>
								<?php 
                                    $quccustommer = @mysql_query("SELECT * FROM s_group_custommer ORDER BY group_name ASC");
                                    while($row_cgcus = @mysql_fetch_array($quccustommer)){
                                      ?>
                                        <option value="<?php  echo $row_cgcus['group_id'];?>" <?php  if($ctype == $row_cgcus['group_id']){echo 'selected';}?>><?php  echo $row_cgcus['group_name'];?></option>
                                      <?php 	
                                    }
                                ?>
                            </select>
                            </td>
                          </tr>
                          <tr >
                            <td nowrap class="name">ชื่อลูกค้า</td>
                            <td><input name="cd_name" type="text" id="cd_name"  value="" style="width:40%;">
                              <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                              ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
		<?php 	
	}
	if($_GET['act'] == 2){
		?>
		<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามใบปิดงาน</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report2.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check2(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr >
                            <td nowrap class="name">ประเภทบริการ</td>
                            <td><select name="sr_ctype" id="sr_ctype">
                              <option value="">กรุณาเลือก</option>
                              <?php  
                                    $qu_cusftype = @mysql_query("SELECT * FROM s_group_service ORDER BY group_name ASC");
                                    while($row_cusftype = @mysql_fetch_array($qu_cusftype)){
                                        ?>
                              <option value="<?php  echo $row_cusftype['group_id'];?>" <?php  if($row_cusftype['group_id'] == $sr_ctype){echo 'selected';}?>><?php  echo $row_cusftype['group_name'];?></option>
                              <?php 
                                    }
                                ?>
                            </select></td>
                          </tr>
                          <tr >
                            <td width="10%" nowrap class="name">ประเภทลูกค้า</td>
                            <td width="90%">
                            <select name="ctype" id="ctype" class="inputselect" >
                            	<option value="">กรุณาเลือก</option>
								<?php 
                                    $quccustommer = @mysql_query("SELECT * FROM s_group_custommer ORDER BY group_name ASC");
                                    while($row_cgcus = @mysql_fetch_array($quccustommer)){
                                      ?>
                                        <option value="<?php  echo $row_cgcus['group_id'];?>" <?php  if($ctype == $row_cgcus['group_id']){echo 'selected';}?>><?php  echo $row_cgcus['group_name'];?></option>
                                      <?php 	
                                    }
                                ?>
                            </select>
                            </td>
                          </tr>
                          <tr >
                            <td nowrap class="name">ชื่อลูกค้า</td>
                            <td><input name="cd_name" type="text" id="cd_name"  value="" style="width:40%;">
                              <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                              ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
		<?php 
	}
	if($_GET['act'] == 3){
		?>
		<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามการให้บริการลูกค้าแต่ละกลุ่มแต่ล่ะประเภท</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report3.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check3(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr >
                            <td nowrap class="name">ประเภทบริการ</td>
                            <td><select name="sr_ctype" id="sr_ctype">
                              <option value="">กรุณาเลือก</option>
                              <?php  
                                    $qu_cusftype = @mysql_query("SELECT * FROM s_group_service ORDER BY group_name ASC");
                                    while($row_cusftype = @mysql_fetch_array($qu_cusftype)){
                                        ?>
                              <option value="<?php  echo $row_cusftype['group_id'];?>" <?php  if($row_cusftype['group_id'] == $sr_ctype){echo 'selected';}?>><?php  echo $row_cusftype['group_name'];?></option>
                              <?php 
                                    }
                                ?>
                            </select></td>
                          </tr>
                          <tr >
                            <td width="10%" nowrap class="name">ประเภทลูกค้า</td>
                            <td width="90%">
                            <select name="ctype" id="ctype" class="inputselect" >
                            	<option value="">กรุณาเลือก</option>
								<?php 
                                    $quccustommer = @mysql_query("SELECT * FROM s_group_custommer ORDER BY group_name ASC");
                                    while($row_cgcus = @mysql_fetch_array($quccustommer)){
                                      ?>
                                        <option value="<?php  echo $row_cgcus['group_id'];?>" <?php  if($ctype == $row_cgcus['group_id']){echo 'selected';}?>><?php  echo $row_cgcus['group_name'];?></option>
                                      <?php 	
                                    }
                                ?>
                            </select>
                            </td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                              ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
		<?php 
	}
	if($_GET['act'] == 4){
		?>
		<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามลูกค้าแต่ล่ะกลุ่ม</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report4.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check4(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr >
                            <td width="10%" nowrap class="name">ประเภทลูกค้า</td>
                            <td width="90%">
                            <select name="ctype" id="ctype" class="inputselect" >
								<?php 
                                    $quccustommer = @mysql_query("SELECT * FROM s_group_custommer ORDER BY group_name ASC");
                                    while($row_cgcus = @mysql_fetch_array($quccustommer)){
                                      ?>
                                        <option value="<?php  echo $row_cgcus['group_id'];?>" <?php  if($ctype == $row_cgcus['group_id']){echo 'selected';}?>><?php  echo $row_cgcus['group_name'];?></option>
                                      <?php 	
                                    }
                                ?>
                            </select>
                            </td>
                          </tr>
                          <tr >
                            <td nowrap class="name">ประเภทบริการ</td>
                            <td><select name="sr_ctype" id="sr_ctype">
                                <option value="">กรุณาเลือก</option>
                                <?php  
                                    $qu_cusftype = @mysql_query("SELECT * FROM s_group_service ORDER BY group_name ASC");
                                    while($row_cusftype = @mysql_fetch_array($qu_cusftype)){
                                        ?>
                                        <option value="<?php  echo $row_cusftype['group_id'];?>" <?php  if($row_cusftype['group_id'] == $sr_ctype){echo 'selected';}?>><?php  echo $row_cusftype['group_name'];?></option>
                                        <?php 
                                    }
                                ?>
                            </select></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                            ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
		<?php 
	}
	if($_GET['act'] == 5){
		?>
		<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามรายการแจ้งซ่อม หรือตามให้บริการต่างๆ</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report5.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check5(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr >
                            <td nowrap class="name">ประเภทบริการ</td>
                            <td><select name="sr_ctype" id="sr_ctype">
                              <option value="">กรุณาเลือก</option>
                              <?php  
                                    $qu_cusftype = @mysql_query("SELECT * FROM s_group_service ORDER BY group_name ASC");
                                    while($row_cusftype = @mysql_fetch_array($qu_cusftype)){
                                        ?>
                              <option value="<?php  echo $row_cusftype['group_id'];?>" <?php  if($row_cusftype['group_id'] == $sr_ctype){echo 'selected';}?>><?php  echo $row_cusftype['group_name'];?></option>
                              <?php 
                                    }
                                ?>
                            </select></td>
                          </tr>
                          <tr >
                            <td width="10%" nowrap class="name">ประเภทลูกค้า</td>
                            <td width="90%">
                            <select name="ctype" id="ctype" class="inputselect" >
                            	<option value="">กรุณาเลือก</option>
								<?php 
                                    $quccustommer = @mysql_query("SELECT * FROM s_group_custommer ORDER BY group_name ASC");
                                    while($row_cgcus = @mysql_fetch_array($quccustommer)){
                                      ?>
                                        <option value="<?php  echo $row_cgcus['group_id'];?>" <?php  if($ctype == $row_cgcus['group_id']){echo 'selected';}?>><?php  echo $row_cgcus['group_name'];?></option>
                                      <?php 	
                                    }
                                ?>
                            </select>
                            </td>
                          </tr>
                          <tr >
                            <td nowrap class="name">ชื่อลูกค้า</td>
                            <td><input name="cd_name" type="text" id="cd_name"  value="" style="width:40%;">
                              <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                          <tr >
                            <td nowrap class="name">รุ่นเครื่อง</td>
                            <td><input name="loc_seal" type="text" id="loc_seal"  value="" style="width:40%;"></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                              ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
		<?php 
	}
	if($_GET['act'] == 6){
		?>
		<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามการใช้อะไหล่</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report6.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check6(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                        <tr >
                            <td nowrap class="name">เลือกอะไหล่</td>
                            <td><select name="cpro" id="cpro_ecip">
                            	<option value="">กรุณาเลือก</option>
                              <?php 
                                  $qupro1 = @mysql_query("SELECT * FROM s_group_sparpart ORDER BY group_name ASC");
                                  while($row_qupro1 = @mysql_fetch_array($qupro1)){
                                    ?>
                                      <option value="<?php  echo $row_qupro1['group_id'];?>"><?php  echo $row_qupro1['group_name'];?></option>
                                    <?php 	
                                  }
                              ?>
                          </select>                              <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search2.php?protype=cpro_ecip');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                          <tr >
                            <td nowrap class="name">ชื่อลูกค้า</td>
                            <td><input name="cd_name" type="text" id="cd_name"  value="" style="width:40%;">
                              <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                          <tr >
                            <td nowrap class="name">ประเภทบริการ</td>
                            <td><select name="sr_ctype" id="sr_ctype">
                              <option value="">กรุณาเลือก</option>
                              <?php  
                                    $qu_cusftype = @mysql_query("SELECT * FROM s_group_service ORDER BY group_name ASC");
                                    while($row_cusftype = @mysql_fetch_array($qu_cusftype)){
                                        ?>
                              <option value="<?php  echo $row_cusftype['group_id'];?>" <?php  if($row_cusftype['group_id'] == $sr_ctype){echo 'selected';}?>><?php  echo $row_cusftype['group_name'];?></option>
                              <?php 
                                    }
                                ?>
                            </select></td>
                          </tr>
                          <tr >
                            <td nowrap class="name">ประเภทลูกค้า</td>
                            <td><select name="ctype2" id="ctype2" class="inputselect" >
                              <option value="">กรุณาเลือก</option>
                              <?php 
                                    $quccustommer = @mysql_query("SELECT * FROM s_group_custommer ORDER BY group_name ASC");
                                    while($row_cgcus = @mysql_fetch_array($quccustommer)){
                                      ?>
                              <option value="<?php  echo $row_cgcus['group_id'];?>" <?php  if($ctype == $row_cgcus['group_id']){echo 'selected';}?>><?php  echo $row_cgcus['group_name'];?></option>
                              <?php 	
                                    }
                                ?>
                            </select></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                              ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
		<?php 
	}
	if($_GET['act'] == 7){
		?>
		<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามอาการเสีย</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report7.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check7(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                        <tr >
                            <td nowrap class="name">เลือกอาการเสีย</td>
                            <td><select name="sfix" id="sfix">
                            	<option value="">กรุณาเลือก</option>
                                    <?php  
										$qu_fix = @mysql_query("SELECT * FROM s_group_fix ORDER BY group_name ASC");
										$numfix = @mysql_num_rows($qu_fix);
										$nd = 1;
										while($row_fix = @mysql_fetch_array($qu_fix)){
                                            ?>
                                            <option value="<?php  echo $row_fix['group_id'];?>"><?php  echo $row_fix['group_name'];?></option>
                                            <?php 
                                        }
                                    ?>
                                </select></td>
                          </tr>
                          <tr >
                            <td nowrap class="name">ชื่อลูกค้า</td>
                            <td><input name="cd_name" type="text" id="cd_name"  value="" style="width:40%;">
                              <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                              ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
		<?php 
	}
	if($_GET['act'] == 8){
		?>
		<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามรายชื่อช่าง</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report8.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check8(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr>
                            <td nowrap class="name">ชื่อช่าง</td>
                            <td><select name="loc_contact" id="loc_contact">
                            	<!--<option value="">กรุณาเลือก</option>-->
                                    <?php  
                                        $qu_custec = @mysql_query("SELECT * FROM s_group_technician ORDER BY group_name ASC");
                                        while($row_custec = @mysql_fetch_array($qu_custec)){
                                            ?>
                                            <option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $loc_contact){echo 'selected';}?>><?php  echo $row_custec['group_name']. " (Tel : ".$row_custec['group_tel'].")";?></option>
                                            <?php 
                                        }
                                    ?>
                                </select></td>
                          </tr>
                          <tr >
                            <td nowrap class="name">ประเภทบริการ</td>
                            <td><select name="sr_ctype" id="sr_ctype">
                              <option value="">กรุณาเลือก</option>
                              <?php  
                                    $qu_cusftype = @mysql_query("SELECT * FROM s_group_service ORDER BY group_name ASC");
                                    while($row_cusftype = @mysql_fetch_array($qu_cusftype)){
                                        ?>
                              <option value="<?php  echo $row_cusftype['group_id'];?>" <?php  if($row_cusftype['group_id'] == $sr_ctype){echo 'selected';}?>><?php  echo $row_cusftype['group_name'];?></option>
                              <?php 
                                    }
                                ?>
                            </select></td>
                          </tr>
                          <tr >
                            <td nowrap class="name">ประเภทลูกค้า</td>
                            <td><select name="ctype2" id="ctype2" class="inputselect" >
                              <option value="">กรุณาเลือก</option>
                              <?php 
                                    $quccustommer = @mysql_query("SELECT * FROM s_group_custommer ORDER BY group_name ASC");
                                    while($row_cgcus = @mysql_fetch_array($quccustommer)){
                                      ?>
                              <option value="<?php  echo $row_cgcus['group_id'];?>" <?php  if($ctype == $row_cgcus['group_id']){echo 'selected';}?>><?php  echo $row_cgcus['group_name'];?></option>
                              <?php 	
                                    }
                                ?>
                            </select></td>
                          </tr>
                          <tr >
                            <td nowrap class="name">ประเภทใบงาน</td>
                            <td><select name="openclose" id="openclose" class="inputselect" >
                                <option value="">กรุณาเลือก</option>
								<option value="1">เปิดใบงาน</option>
                                <option value="2">ปิดใบงาน</option>
                               </select></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">รายการอะไหล่</td>
                            <td>
                            	<select id="cpro_ecip" name="cpro">
                                <option value="">กรุณาเลือกรายการ</option>
                                	 <?php  
                                    $qu_sparpart = @mysql_query("SELECT * FROM s_group_sparpart ORDER BY group_name ASC");
                                    while($row_sparpart = @mysql_fetch_array($qu_sparpart)){
                                        ?>
                                        <option value="<?php  echo $row_sparpart['group_id'];?>"><?php  echo $row_sparpart['group_name'];?></option>
                                     <?php 
                                    }
                                ?>
                                    
                                 </select>
                           	  <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search2.php?protype=cpro_ecip');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                              ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
		<?php 
	}
	if($_GET['act'] == 9){
		?>
		<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามจังหวัด</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report9.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check9(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr >
                            <td width="10%" nowrap class="name">จังหวัด</td>
                            <td width="90%">
                            <select name="cd_province" id="cd_province" class="inputselect">
							<?php 
                                $quprovince = @mysql_query("SELECT * FROM s_province ORDER BY province_id ASC");
                                while($row_province = @mysql_fetch_array($quprovince)){
                                  ?>
                                    <option value="<?php  echo $row_province['province_id'];?>" <?php  if($cd_province == $row_province['province_id']){echo 'selected';}?>><?php  echo $row_province['province_name'];?></option>
                                  <?php 	
                                }
                            ?>
                        </select>
                            </td>
                          </tr>
                          <tr >
                            <td nowrap class="name">ประเภทบริการ</td>
                            <td><select name="sr_ctype" id="sr_ctype">
                                <option value="">กรุณาเลือก</option>
                                <?php  
                                    $qu_cusftype = @mysql_query("SELECT * FROM s_group_service ORDER BY group_name ASC");
                                    while($row_cusftype = @mysql_fetch_array($qu_cusftype)){
                                        ?>
                                        <option value="<?php  echo $row_cusftype['group_id'];?>" <?php  if($row_cusftype['group_id'] == $sr_ctype){echo 'selected';}?>><?php  echo $row_cusftype['group_name'];?></option>
                                        <?php 
                                    }
                                ?>
                            </select></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                            ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
		<?php 
	}
	if($_GET['act'] == 10){
		?>
		<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามมูลค่าการใช้</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report10.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check10(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr >
                            <td nowrap class="name">ชื่อลูกค้า</td>
                            <td><input name="cd_name" type="text" id="cd_name"  value="" style="width:40%;">
                              <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                          <tr >
                            <td nowrap class="name">ประเภทบริการ</td>
                            <td><select name="sr_ctype" id="sr_ctype">
                              <option value="">กรุณาเลือก</option>
                              <?php  
                                    $qu_cusftype = @mysql_query("SELECT * FROM s_group_service ORDER BY group_name ASC");
                                    while($row_cusftype = @mysql_fetch_array($qu_cusftype)){
                                        ?>
                              <option value="<?php  echo $row_cusftype['group_id'];?>" <?php  if($row_cusftype['group_id'] == $sr_ctype){echo 'selected';}?>><?php  echo $row_cusftype['group_name'];?></option>
                              <?php 
                                    }
                                ?>
                              </select></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                              ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
		<?php 
	}
?>


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

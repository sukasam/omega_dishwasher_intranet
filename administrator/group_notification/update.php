<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	if ($_POST['mode'] <> "") { 
		$param = "";
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);

		if ($_POST['mode'] == "add") { 
				include "../include/m_add.php";
			header ("location:index.php?typenoti=".$_POST['group_name']); 
		}
		if ($_POST['mode'] == "update" ) { 
			include ("../include/m_update.php");
			header ("location:index.php?typenoti=".$_POST['group_name']); 
		}
	}
	if ($_GET['mode'] == "add") { 
		 Check_Permission($conn,$check_module,$_SESSION['login_id'],"add");
	}
	if ($_GET['mode'] == "update") { 
		 Check_Permission($conn,$check_module,$_SESSION['login_id'],"update");
		$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";
		$query = @mysqli_query($conn,$sql);
		while ($rec = @mysqli_fetch_array($query)) { 
			$$PK_field = $rec[$PK_field];
			foreach ($fieldlist as $key => $value) { 
				$$value = $rec[$value];
			}
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
<SCRIPT type=text/javascript src="../js/jquery-1.9.1.min.js"></SCRIPT>
<!--<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>-->
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
<META name=GENERATOR content="MSHTML 8.00.7600.16535">
<script>
function confirmDelete(delUrl,text) {
  if (confirm("Are you sure you want to delete\n"+text)) {
    document.location = delUrl;
  }
}
//----------------------------------------------------------
function check(frm){
	   
	// if (frm.group_name.value == 0 || frm.group_name.value == ''){
	// 	alert ('กรุณาเลือก ประเภทการแจ้งเตือน!!');
	// 	frm.group_name.focus(); return false;
	// }		
}	

function submitForm() {

	if (document.getElementById("group_name").value == 0 || document.getElementById("group_name").value == ''){
		alert ('กรุณาเลือก ประเภทการแจ้งเตือน!!');
		document.getElementById("group_name").focus(); return false;
	}	
	if (document.getElementById("user_account").value == 0 || document.getElementById("user_account").value == ''){
		alert ('กรุณาเลือก ชื่อเข้าใช้ระบบ!!');
		document.getElementById("user_account").focus(); return false;
	}	
	document.getElementById("submitF").disabled = true;
	document.getElementById("resetF").disabled = true;
	document.form1.submit()
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
<P id=page-intro><?php  if ($mode == "add") { ?>Enter new information<?php  } else { ?>แก้ไข	[<?php  echo $page_name; ?>]<?php  } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php  echo $check_module; ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
      <legend><?php  echo $page_name; ?> </legend>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tr>
            <td><table class="formFields" cellspacing="0" width="100%">

			<tr >
                <td nowrap class="name">ประเภทการแจ้งเตือน</td>
                <td>
			 	 	<select name="group_name" id="group_name" class="inputselect" style="width:50%;">
			 	 		<option value="0" <?php if($group_name == '0'){echo 'selected';}?>>กรุณาเลือก</option>
						<option value="1" <?php if($group_name == '1'){echo 'selected';}?>>อนุมัติเอกสาร (First Order)</option>
						<option value="2" <?php if($group_name == '2'){echo 'selected';}?>>อนุมัติเอกสาร (ใบแจ้งงาน)</option>
						<option value="3" <?php if($group_name == '3'){echo 'selected';}?>>อนุมัติเอกสาร (Memo)</option>
						<option value="4" <?php if($group_name == '4'){echo 'selected';}?>>อนุมัติเอกสาร (ใบเสนอราคาซื้อ)</option>
						<option value="5" <?php if($group_name == '5'){echo 'selected';}?>>อนุมัติเอกสาร (ใบเสนอราคาเช่า)</option>
						<option value="6" <?php if($group_name == '6'){echo 'selected';}?>>อนุมัติเอกสาร (ใบงานบริการ)</option>
						<option value="7" <?php if($group_name == '7'){echo 'selected';}?>>วันหมดสัญญา (สัญญาเข่า)</option>
						<option value="8" <?php if($group_name == '8'){echo 'selected';}?>>วันหมดสัญญา (สัญญาบริการ)</option>
						<option value="9" <?php if($group_name == '9'){echo 'selected';}?>>วันหมดสัญญา (สัญญาซื้อ-ขาย)</option>
						<option value="12" <?php if($group_name == '12'){echo 'selected';}?>>ว้นสิ้นสุดอายุของเครื่อง (ล้างแก้ว/ล้างจาน/ทำน้ำแข็ง)</option>
						<option value="10" <?php if($group_name == '10'){echo 'selected';}?>>สถานะใบสั่งน้ำยา</option>
						<option value="11" <?php if($group_name == '11'){echo 'selected';}?>>สถานะใบแจ้งซ่อม</option>
				</select>
            	 </td>
              </tr>

             <tr >
                <td nowrap class="name">ชื่อเข้าใช้ระบบ</td>
                <td>
			 	 	<select name="user_account" id="user_account" class="inputselect" style="width:50%;">
			 	 	<option value="0">กรุณาเลือก ชื่อเข้าใช้ระบบ</option>
					<?php
						$quAccount = @mysqli_query($conn,"SELECT * FROM `s_user` ORDER BY `s_user`.`name` ASC");
						while($rowAccount = @mysqli_fetch_array($quAccount)){
						  ?>
							<option value="<?php  echo $rowAccount['user_id'];?>" <?php  if($user_account == $rowAccount['user_id']){echo 'selected';}?>><?php  echo $rowAccount['name'].' ('.$rowAccount['username'].')';?></option>
						  <?php
						}
					?>
				</select>
            	 </td>
              </tr>
          </table></td>
          </tr>
        </table>
        </fieldset>
    </div><br>
    <div class="formArea">
	<input type="button" value="Submit" id="submitF" class="button" onclick="submitForm()">
      <input type="reset" name="Reset" id="resetF" value="Reset" class="button">
      <?php  
			$a_not_exists = array();
			post_param($a_param,$a_not_exists); 
			?>
      <input name="mode" type="hidden" id="mode" value="<?php  echo $_GET['mode'];?>">
	  <input name="typenoti" type="hidden" id="typenoti" value="<?php  echo $_GET['typenoti'];?>">
      <input name="approve" type="hidden" id="approve" value="<?php  echo $approve;?>">
      <input name="<?php  echo $PK_field;?>" type="hidden" id="<?php  echo $PK_field;?>" value="<?php  echo $_GET[$PK_field];?>">
    </div>
  </form>
</DIV>
</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php  include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
<?php  if($msg_user==1){?>
<script language=JavaScript>alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');</script>
<?php  }?>
</BODY>
</HTML>

<?php
include("../../include/config.php");
include("../../include/connect.php");
include("../../include/function.php");
include("config.php");

if ($_POST['mode'] <> "") {
	$param = "";
	$a_not_exists = array();
	$param = get_param($a_param, $a_not_exists);

	if ($_POST['mode'] == "add") {
		include "../include/m_add.php";

		if ($_FILES['ufimages']['name'] != "") {
			$mname = "";
			$mname = gen_random_num(5);
			$a_size = array('100');
			$filename = "";
			foreach ($a_size as $key => $value) {
				$path = "../../upload/headerpaper/";
				$quality = 80;
				if ($filename == "")
					$name_data = explode(".", $_FILES['ufimages']['name']);
				$type = $name_data[1];
				$filename = $mname . "." . $type;
				list($width, $height) = getimagesize($_FILES['ufimages']['name']);
				//$sizes = $value;
				uploadfile($path, $filename, $_FILES['ufimages']['tmp_name'], $width, $quality);
			} // end foreach				
			$sql = "update $tbl_name set u_images  = '" . $filename . "' where $PK_field = '" . $id . "' ";
			@mysqli_query($conn, $sql);
		} // end if ($_FILES[ufimages][name] != "")	

		header("location:index.php?user_id=" . $_POST['user_id']);
	}
	if ($_POST['mode'] == "update") {
		include("../include/m_update.php");

		if ($_FILES['ufimages']['name'] != "") {
			$mname = "";
			$mname = gen_random_num(5);
			$a_size = array('100');
			$filename = "";
			foreach ($a_size as $key => $value) {
				$path = "../../upload/headerpaper/";
				@unlink($path . $_POST['u_images']);
				$quality = 80;
				if ($filename == "")
					$name_data = explode(".", $_FILES['ufimages']['name']);
				$type = $name_data[1];
				$filename = $mname . "." . $type;
				list($width, $height) = getimagesize($_FILES['ufimages']['name']);
				uploadfile($path, $filename, $_FILES['ufimages']['tmp_name'], $width, $quality);
			} // end foreach				
			$sql = "update $tbl_name set u_images = '" . $filename . "' where $PK_field = '" . $_POST[$PK_field] . "' ";
			@mysqli_query($conn, $sql);
		} // end if ($_FILES[ufimages][name] != "")

		header("location:index.php?user_id=" . $_POST['user_id']);
	}
}
if ($_GET['mode'] == "add") {
	Check_Permission($conn, $check_module, $_SESSION['login_id'], "add");
}
if ($_GET['mode'] == "update") {
	Check_Permission($conn, $check_module, $_SESSION['login_id'], "update");
	$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] . "'";
	$query = @mysqli_query($conn, $sql);
	while ($rec = @mysqli_fetch_array($query)) {
		$$PK_field = $rec[$PK_field];
		foreach ($fieldlist as $key => $value) {
			$$value = $rec[$value];
		}
	}
}

if (isset($_GET['user_id'])) {
	$userInfo = get_user_info($conn, $_GET['user_id']);
} else {
	//header("location:../error/permission.php");
}

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
	<script>
		function confirmDelete(delUrl, text) {
			if (confirm("Are you sure you want to delete\n" + text)) {
				document.location = delUrl;
			}
		}
		

		function submitForm() {

			if (document.getElementById('key_head').value.length == 0) {
				alert('Please select header paper name !!');
				document.getElementById('key_head').focus();
				return false;
			} else {
				document.getElementById("submitF").disabled = true;
				document.getElementById("resetF").disabled = true;
				document.form1.submit()
			}


		}

		function setKeyPaper(){
			
			// var element = document.getElementById('key_head');
			// alert(element.value);
			
		}
	</script>
</HEAD>
<?php include("../../include/function_script.php"); ?>

<BODY>
	<DIV id=body-wrapper>
		<?php include("../left.php"); ?>
		<DIV id=main-content>
			<NOSCRIPT>
			</NOSCRIPT>
			<?php include('../top.php'); ?>
			<P id=page-intro><?php if ($mode == "add") { ?>Enter new information<?php  } else { ?>แก้ไข [<?php echo $page_name; ?>]<?php  } ?> </P>
			<UL class=shortcut-buttons-set>
				<LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG alt=icon src="../images/btn_back.gif"><BR>
							กลับ</SPAN></A></LI>
			</UL>
			<H3 align="left">ชื่อตัวแทนจำหน่าย : <?php echo $userInfo['name']; ?></H3>
			<H3 align="left">ที่อยู่ : <?php echo $userInfo['address']; ?></H3>
			<H3 align="left">เบอร์โทร : <?php echo $userInfo['telephone']; ?></H3>
			<H3 align="left">อีเมล์ : <?php echo $userInfo['email']; ?></H3>
			<!-- End .clear -->
			<DIV class=clear></DIV><!-- End .clear -->
			<DIV class=content-box>
				<!-- Start Content Box -->
				<DIV class=content-box-header align="right">

					<H3 align="left"><?php echo $check_module; ?></H3>
					<DIV class=clear>

					</DIV>
				</DIV><!-- End .content-box-header -->
				<DIV class=content-box-content>
					<DIV id=tab1 class="tab-content default-tab">
						<form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onSubmit="return check(this)">
							<div class="formArea">
								<fieldset>
									<legend><?php echo $page_name; ?> </legend>
									<table width="100%" cellspacing="0" cellpadding="0" border="0">
										<tr>
											<td>
												<table class="formFields" cellspacing="0" width="100%">
													<tr>
														<td nowrap class="name">ชื่อ</td>
														<td>
															<select name="key_head" id="key_head" class="inputselect" onchange="setKeyPaper()">
															<option value="">กรุณาเลือก</option>
																<?php
																$qucgtype = @mysqli_query($conn, "SELECT * FROM s_group_headpaper ORDER BY group_name ASC");
																while ($row_cgtype = @mysqli_fetch_array($qucgtype)) {
																	if (checkHeadPaper($conn, $row_cgtype['group_id'], $userInfo['user_id'],$_GET['mode']) == 0) {
																?>
																		<option value="<?php echo $row_cgtype['group_id']; ?>" <?php if ($key_head == $row_cgtype['group_id']) {
																																	echo 'selected';
																																} ?>><?php echo $row_cgtype['group_name']; ?></option>
																<?php
																	}
																}
																?>
															</select>
															
														</td>
													</tr>
													<tr>
														<td nowrap class="name">รูปภาพ<br>
															<small>Size 1182px × 219px</small></td>
														<td><input name="ufimages" type="file" id="ufimages">
															<br>
															<?php
															if ($u_images != "") { ?>
																<img src="../../upload/headerpaper/<?php echo $u_images ?>" height="100">
															<?php  } ?>
															<input name="u_images" type="hidden" value="<?php echo $u_images; ?>"></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</fieldset>
							</div><br>
							<div class="formArea">
								<input type="hidden" name="user_id" value="<?php echo $userInfo['user_id'] ?>">
								<input type="button" value="Submit" id="submitF" class="button" onclick="submitForm()">
								<input type="reset" name="Reset" id="resetF" value="Reset" class="button">
								<?php
								$a_not_exists = array();
								post_param($a_param, $a_not_exists);
								?>
								<input name="mode" type="hidden" id="mode" value="<?php echo $_GET['mode']; ?>">
								<input name="<?php echo $PK_field; ?>" type="hidden" id="<?php echo $PK_field; ?>" value="<?php echo $_GET[$PK_field]; ?>">
							</div>
						</form>
					</DIV>
				</DIV><!-- End .content-box-content -->
			</DIV><!-- End .content-box -->
			<!-- End .content-box -->
			<!-- End .content-box -->
			<DIV class=clear></DIV><!-- Start Notifications -->
			<!-- End Notifications -->

			<?php include("../footer.php"); ?>
		</DIV><!-- End #main-content -->
	</DIV>
	<?php if ($msg_user == 1) { ?>
		<script language=JavaScript>
			alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');
		</script>
	<?php  } ?>
</BODY>

</HTML>
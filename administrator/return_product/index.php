<?php
include("../../include/config.php");
include("../../include/connect.php");
include("../../include/function.php");
include("config.php");
Check_Permission($conn, $check_module, $_SESSION['login_id'], "read");
if ($_GET['page'] == "") {
	$_REQUEST['page'] = 1;
}
$param = get_param($a_param, $a_not_exists);

if ($_GET['action'] == "delete") {
	$code = Check_Permission($conn, $check_module, $_SESSION["login_id"], "delete");
	if ($code == "1") {
		$sql = "delete from $tbl_name  where $PK_field = '$_GET[$PK_field]'";
		@mysqli_query($conn, $sql);

		//			$sql2 = "UPDATE `s_quotation32` SET `quotation` = '' WHERE `quotation` = ".$_GET[$PK_field].";";
		//			@mysqli_query($conn,$sql2);	
		//			//exit();

		header("location:index.php");
	}
}

//-------------------------------------------------------------------------------------
if ($_GET['b'] != "" && $_GET['s'] != "") {
	if ($_GET['s'] == 0) $status = 1;
	if ($_GET['s'] == 1) $status = 0;
	Check_Permission($conn, $check_module, $_SESSION['login_id'], "update");
	$sql_status = "update $tbl_name set st_setting = " . $status . " where $PK_field = " . $_GET['b'] . "";
	@mysqli_query($conn, $sql_status);

	if ($_GET['page'] != "") {
		$conpage = "page=" . $_GET['page'];
	}

	$sql = "select * from $tbl_name where $PK_field = " . $_GET['b'] . "";
	$query = @mysqli_query($conn, $sql);
	while ($rec = @mysqli_fetch_array($query)) {
		$$PK_field = $rec[$PK_field];
		foreach ($fieldlist as $key => $value) {
			$$value = $rec[$value];
		}
	}

	if ($status == 1) {
		$foid = check_firstorder($conn);

		@mysqli_query($conn, "INSERT INTO `s_first_order` (`fo_id`, `cd_name`, `cd_address`, `cd_province`, `cd_tel`, `cd_fax`, `fs_id`, `date_forder`, `cg_type`, `ctype`, `pro_type`, `po_id`, `pro_sn1`, `pro_sn2`, `pro_sn3`, `pro_sn4`, `pro_sn5`, `pro_sn6`, `pro_sn7`, `c_contact`, `c_tel`, `cpro1`, `cpro2`, `cpro3`, `cpro4`, `cpro5`, `cpro6`, `cpro7`, `camount1`, `camount2`, `camount3`, `camount4`, `camount5`, `camount6`, `camount7`, `cprice1`, `cprice2`, `cprice3`, `cprice4`, `cprice5`, `cprice6`, `cprice7`, `cs_pro1`, `cs_pro2`, `cs_pro3`, `cs_pro4`, `cs_pro5`, `cs_amount1`, `cs_amount2`, `cs_amount3`, `cs_amount4`, `cs_amount5`, `type_service`, `cs_sell`, `cs_ship`, `cs_setting`, `date_quf`, `date_qut`) VALUES (NULL, '" . $cd_name . "', '" . $cd_address . "', '" . $cd_province . "', '" . $cd_tel . "', '" . $cd_fax . "', '" . $foid . "','" . $date_forder . "','17','16', '" . $pro_type . "', '" . $fs_id . "', '" . $pro_sn1 . "', '" . $pro_sn2 . "', '" . $pro_sn3 . "', '" . $pro_sn4 . "', '" . $pro_sn5 . "', '" . $pro_sn6 . "', '" . $pro_sn7 . "', '" . $c_contact . "', '" . $c_tel . "', '" . $cpro1 . "', '" . $cpro2 . "', '" . $cpro3 . "', '" . $cpro4 . "', '" . $cpro5 . "', '" . $cpro6 . "', '" . $cpro7 . "', '" . $camount1 . "', '" . $camount2 . "', '" . $camount3 . "', '" . $camount4 . "', '" . $camount5 . "', '" . $camount6 . "', '" . $camount7 . "', '" . $cprice1 . "', '" . $cprice2 . "', '" . $cprice3 . "', '" . $cprice4 . "', '" . $cprice5 . "', '" . $cprice6 . "', '" . $cprice7 . "', '" . $cs_pro1 . "', '" . $cs_pro2 . "', '" . $cs_pro3 . "', '" . $cs_pro4 . "', '" . $cs_pro5 . "', '" . $cs_amount1 . "', '" . $cs_amount2 . "', '" . $cs_amount3 . "', '" . $cs_amount4 . "', '" . $cs_amount5 . "', '" . $type_service . "', '" . $cs_sell . "','" . $date_forder . "','" . $date_forder . "','" . $date_forder . "','" . $date_forder . "');");
	} else {
		echo "DELETE FROM `s_first_order` WHERE `po_id` = '" . $fs_id . "'";
		@mysqli_query($conn, "DELETE FROM `s_first_order` WHERE `po_id` = '" . $fs_id . "'");
	}

	header("location:?" . $conpage);
}


//-------------------------------------------------------------------------------------
if ($_GET['ff'] !== "" && $_GET['gg'] <> "") {
	if ($_GET['gg'] == 0) $st_setting = 0;
	if ($_GET['gg'] == 1) $st_setting = 1;
	if ($_GET['gg'] == 2) $st_setting = 2;
	Check_Permission($conn, $check_module, $_SESSION['login_id'], "update");
	$sql_status = "update $tbl_name set st_setting = '" . $st_setting . "' where $PK_field = '" . $_GET['ff'] . "'";
	@mysqli_query($conn, $sql_status);

	if ($_GET['page'] != "") {
		$conpage = "page=" . $_GET['page'];
	}
	header("location:?" . $conpage);
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
	<SCRIPT type=text/javascript src="ajax.js"></SCRIPT>
	<META name=GENERATOR content="MSHTML 8.00.7600.16535">
	<script>
		function confirmDelete(delUrl, text) {
			if (confirm("Are you sure you want to delete\n" + text)) {
				document.location = delUrl;
			}
		}
		//----------------------------------------------------------
		function check_select(frm) {
			if (frm.choose_action.value == "") {
				alert('Choose an action');
				frm.choose_action.focus();
				return false;
			}
		}

		function setStatus(evt) {
			var process_val = document.getElementById('process_' + evt).value;
			var xmlHttp;
			xmlHttp = GetXmlHttpObject(); //Check Support Brownser
			URL = 'call_api.php?action=changeProcess&id=' + evt + '&process=' + process_val;
			if (xmlHttp == null) {
				alert("Browser does not support HTTP Request");
				return;
			}
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					var ds = xmlHttp.responseText;
					//console.log(ds);
					document.getElementById('process_' + evt).style.backgroundColor = ds;
				} else {
					//document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
				}
			};
			xmlHttp.open("GET", URL, true);
			xmlHttp.send(null);
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
			<P id=page-intro><?php echo $page_name; ?></P>

			<UL class=shortcut-buttons-set>
				<LI><A class=shortcut-button href="update.php?mode=add<?php if ($param <> "") echo "&" . $param; ?>"><SPAN><IMG alt=icon src="../images/pencil_48.png"><BR>
							เพิ่ม</SPAN><br></A></LI>
				<?php
				if ($FR_module <> "") {
					$param2 = get_return_param();
				?>
					<LI><A class=shortcut-button href="../<?php echo $FR_module; ?>/?<?php if ($param2 <> "") echo $param2; ?>"><SPAN><IMG alt=icon src="../images/btn_back.gif"><BR>
								กลับ</SPAN></A></LI>
				<?php  } ?>

			</UL>

			<!-- End .shortcut-buttons-set -->
			<DIV class=clear></DIV><!-- End .clear -->
			<DIV class=content-box>
				<!-- Start Content Box -->
				<DIV class=content-box-header align="right" style="padding-right:15px;">

					<H3 align="left"><?php echo $check_module; ?></H3>
					<br>
					<form name="form1" method="get" action="index.php">
						<input name="keyword" type="text" id="keyword" value="<?php echo $keyword; ?>">
						<input name="Action" type="submit" id="Action" value="ค้นหา">
						<?php
						$a_not_exists = array('keyword');
						$param2 = get_param($a_param, $a_not_exists);
						?>
						<a href="index.php?<?php echo $param2; ?>">แสดงทั้งหมด</a>
						<?php
						/*$a_not_exists = array();
			post_param($a_param,$a_not_exists);*/
						?>
					</form>
					<DIV class=clear>

					</DIV>
				</DIV><!-- End .content-box-header -->
				<DIV class=content-box-content>
					<DIV id=tab1 class="tab-content default-tab">
						<!-- This is the target div. id must match the href of this div's tab -->
						<form name="form2" method="post" action="confirm.php" onSubmit="return check_select(this)">
							<TABLE>
								<THEAD>
									<TR>
										<!-- <TH width="5%"><INPUT class=check-all type=checkbox name="ca" value="true" onClick="chkAll(this.form, 'del[]', this.checked)"></TH> -->
										<TH width="5%">
											<div align="center"><a>ลำดับ</a></div>
										</TH>
										<TH width="12%">
											<div align="center"><a>เลขที่ใบรับคืนสินค้า</a></div>
										</TH>
										<TH width="35%">
											<div align="left"><a>ชื่อลูกค้า</a></div>
										</TH>
										<TH width="12%">
											<div align="center"><a>วันที่รับคืน</a></div>
										</TH>
										<TH width="12%">
											<div align="center"><a>ผู้จัดทำ</a></div>
										</TH>
										<!--          <TH width="18%"><strong>สถานที่ติดตั้ง</strong></TH>-->
										<!--          <TH width="5%" nowrap ><div align="center"><img src="../icons/favorites_use.png" width="15" height="15"> ใช้งาน / <img src="../icons/favorites_stranby.png" width="15" height="15"> Standby / <img src="../icons/favorites_close.png" width="15" height="15"> ยกเลิก</div></TH>-->
										<!--
		  <TH width="5%" nowrap ><div align="center"><a>ใบแจ้งงานบริการ</a></div></TH>
          <TH width="5%" nowrap ><div align="center"><a>เปิดใบเสนอราคาเช่า</a></div></TH> -->
										<!-- <TH width="5%">
											<div align="center"><a>สถานะ</a></div>
										</TH>
										<TH width="5%" nowrap>
											<div align="center"><a>แนบไฟล์</a></div>
										</TH> -->
										<!-- <TH width="5%" style="white-space: nowrap;"><div align="center"><a>ดาวโหลด</a></div></TH> -->
										<TH width="5%">
											<div align="center"><a>แก้ไข</a></div>
										</TH>
										<TH width="5%">
											<div align="center"><a>ลบ</a></div>
										</TH>
									</TR>
								</THEAD>
								<TFOOT>
								</TFOOT>
								<TBODY>
									<?php
									if ($orderby == "") $orderby = $tbl_name . "." . $PK_field;
									if ($sortby == "") $sortby = "DESC";

									$conDealer = "";
									if (userGroup($conn, $_SESSION['login_id']) === "Dealer") {
										$conDealer = " AND create_by = '" . $_SESSION['login_id'] . "'";
									}

									$sql = " select *,$tbl_name.create_date as c_date from $tbl_name  where 1 ".$conDealer;
									if ($_GET[$PK_field] <> "") $sql .= " and ($PK_field  = '" . $_GET[$PK_field] . " ' ) ";
									if ($_GET[$FR_field] <> "") $sql .= " and ($FR_field  = '" . $_GET[$FR_field] . " ' ) ";
									if ($_GET['keyword'] <> "") {
										$sql .= "and ( " .  $PK_field  . " like '%" . $_GET['keyword'] . "%' ";
										if (count($search_key) > 0) {
											$search_text = " and ( ";
											foreach ($search_key as $key => $value) {
												$subtext .= " or " . $value  . " like '%" . $_GET['keyword'] . "%'";
											}
										}
										$sql .=  $subtext . " ) ";
									}
									if ($orderby <> "") $sql .= " order by " . $orderby;
									if ($sortby <> "") $sql .= " " . $sortby;
									include("../include/page_init.php");
									//echo $sql;
									$query = @mysqli_query($conn, $sql);
									if ($_GET['page'] == "") $_GET['page'] = 1;
									$counter = ($_GET['page'] - 1) * $pagesize;

									while ($rec = @mysqli_fetch_array($query)) {
										$counter++;
									?>
										<TR>
											<!-- <TD><INPUT type=checkbox name="del[]" value="<?php echo $rec[$PK_field]; ?>" ></TD> -->
											<TD><center><span class="text"><?php echo sprintf("%04d", $counter); ?></span></center></TD>
											<TD><center><?php $chaf = str_replace("/", "-", $rec["fs_id"]); ?><span class="text"><a href="../../upload/return_product/<?php echo $chaf; ?>.pdf" target="_blank"><?php echo $rec["fs_id"]; ?></a></span></center></TD>

											<TD> <span class="text"><?php echo $rec["cd_name"]; ?></span></TD>
											<TD> <center><span class="text"><?php echo format_date_th($rec["date_forder"], 5); ?></span></center></TD>
											<TD> <center><span class="text"><?php echo get_username($conn,$rec['who_sale']);?></span></center></TD>
											<!--			  <td>
			  	<center><a href="../quotation_jobcard/?tab=1&id=<?php echo $rec[$PK_field]; ?>"><img src="../images/hammer_screwdriver.png" width="20" height="20"></a></center>
			  </td>
					<TD style="text-align: center;"><?php
													if ($rec["quotation"] != "") {
														$chafQA = preg_replace("/", "-", getQaHNumber($conn, $rec["quotation"]))
													?>
							<a href="../quotation2/update.php?mode=update&order_id=<?php echo $rec["quotation"]; ?>"><?php echo getQaHNumber($conn, $rec["quotation"]); ?></a> 
							<?php
														$file_pointer = '../../upload/return_product/' . $chafQA . '.pdf';
														if (file_exists($file_pointer)) {
							?>
									| <a href="../../upload/return_product/<?php echo $chafQA; ?>.pdf" target="_blank"><img src="../images/icon2/download_f2.png" width="20" height="20"></a>
									<?php
														}
									?>
							<?php
													} else {
							?>
							<a href="../return_product/?action=createQA&id=<?php echo $rec[$PK_field]; ?>"><img src="../images/paper_content_pencil_48.png" width="20" height="20"></a>
							<?php
													}
							?></TD>
-->
											<!-- <TD nowrap style="vertical-align:middle;"><div align="center">
            <?php if ($rec["st_setting"] == 0) { ?>
            <img src="../icons/favorites_use.png" width="15" height="15">
            <?php  } elseif ($rec["st_setting"] == 2) { ?>
            <img src="../icons/favorites_close.png" width="15" height="15">
            <?php  } else { ?>
            <img src="../icons/favorites_stranby.png" width="15" height="15">
            <?php  } ?>
            <div align="center" style="padding-top:5px;">
            <a href="../return_product/?ff=<?php echo $rec[$PK_field]; ?>&gg=0&page=<?php echo $_GET['page']; ?>&<?php echo $FK_field; ?>=<?php echo $_REQUEST["$FK_field"]; ?>"><img src="../icons/favorites_use.png" width="15" height="15"> | </a>
            <a href="../return_product/?ff=<?php echo $rec[$PK_field]; ?>&gg=1&page=<?php echo $_GET['page']; ?>&<?php echo $FK_field; ?>=<?php echo $_REQUEST["$FK_field"]; ?>"><img src="../icons/favorites_stranby.png" width="15" height="15"> | </a>
            <a href="../return_product/?ff=<?php echo $rec[$PK_field]; ?>&gg=2&page=<?php echo $_GET['page']; ?>&<?php echo $FK_field; ?>=<?php echo $_REQUEST["$FK_field"]; ?>"><img src="../icons/favorites_close.png" width="15" height="15"></a>
            </div>
          </div></TD> -->
											<!--<TD nowrap style="vertical-align:middle;display: none;"><div align="center">
            <?php if ($rec["status"] == 0) { ?>
            <a href="../return_product/?bb=<?php echo $rec[$PK_field]; ?>&ss=<?php echo $rec["status"]; ?>&page=<?php echo $_GET['page']; ?>&<?php echo $FK_field; ?>=<?php echo $_REQUEST["$FK_field"]; ?>&foid=<?php echo $rec["order_id"]; ?>"><img src="../icons/status_on.gif" width="10" height="10"></a>
            <?php  } else { ?>
            <a href="../return_product/?bb=<?php echo $rec[$PK_field]; ?>&ss=<?php echo $rec["status"]; ?>&page=<?php echo $_GET['page']; ?>&<?php echo $FK_field; ?>=<?php echo $_REQUEST["$FK_field"]; ?>&foid=<?php echo $rec["order_id"]; ?>"><img src="../icons/status_off.gif" width="10" height="10"></a>
            <div align="center"><a href="../../upload/service_report_close/<?php echo get_srreport($conn, $rec["fs_id"]); ?>.pdf" target="_blank"><p style="background:#999;color:#FFFFFF;padding:2px;"><?php echo get_srreport($conn, $rec["order_id"]); ?></p></a></div>
            <?php  } ?>
          </div>
          <div align="center"><A href="service_close.php?order_id=<?php echo $rec["order_id"]; ?>"><IMG  alt=icon src="../images/icons/icon-48-install.png"></A></div>
          </TD>-->
											<!---->
											<!-- <TD nowrap style="vertical-align:middle">
												<div align="center">
													<select name="st_setting" id="process_<?php echo $rec[$PK_field]; ?>" style="background:<?php echo getStatusSolutionColor($rec['st_setting']); ?>;color:#000;" onchange="setStatus('<?php echo $rec[$PK_field]; ?>');">
														<option value="0" <?php if ($rec['st_setting'] == 0) {
																				echo 'selected';
																			} ?>><?php echo getStatusSolution(0); ?></option>
														<option value="1" <?php if ($rec['st_setting'] == 1) {
																				echo 'selected';
																			} ?>><?php echo getStatusSolution(1); ?></option>
														<option value="2" <?php if ($rec['st_setting'] == 2) {
																				echo 'selected';
																			} ?>><?php echo getStatusSolution(2); ?></option>
														<option value="3" <?php if ($rec['st_setting'] == 3) {
																				echo 'selected';
																			} ?>><?php echo getStatusSolution(3); ?></option>
														<option value="4" <?php if ($rec['st_setting'] == 4) {
																				echo 'selected';
																			} ?>><?php echo getStatusSolution(4); ?></option>
														<option value="5" <?php if ($rec['st_setting'] == 5) {
																				echo 'selected';
																			} ?>><?php echo getStatusSolution(5); ?></option>
														<option value="6" <?php if ($rec['st_setting'] == 6) {
																				echo 'selected';
																			} ?>><?php echo getStatusSolution(6); ?></option>
														<option value="7" <?php if ($rec['st_setting'] == 7) {
																				echo 'selected';
																			} ?>><?php echo getStatusSolution(7); ?></option>
													</select>
												</div>
											</TD> -->

											<!-- <TD><div align="center"><a href="../../upload/return_product/<?php echo $chaf; ?>.pdf" target="_blank"><img src="../images/icon2/download_f2.png" width="20" height="20" border="0" alt=""></a></div></TD> -->
											<!-- <td style="vertical-align: middle;">
												<center><a href="../document_order_solution/?fo_id=<?php echo $rec[$PK_field]; ?>&target=OS"><img src="../images/document.png" height="30"></a></center>
											</td> -->
											<TD><center><!-- Icons -->
												<A title=Edit href="update.php?mode=update&<?php echo $PK_field; ?>=<?php echo $rec[$PK_field];
																														if ($param <> "") { ?>&<?php echo $param;
																																									} ?>"><IMG alt=Edit src="../images/pencil.png"></A> <A title=Delete href="#"></A></center></TD>
											<TD><center><A title=Delete href="#"><IMG alt=Delete src="../images/cross.png" onClick="confirmDelete('?action=delete&<?php echo $PK_field; ?>=<?php echo $rec[$PK_field]; ?>','Group  <?php echo $rec[$PK_field]; ?> : <?php echo $rec["group_name"]; ?>')"></A></center></TD>
										</TR>
									<?php  } ?>
								</TBODY>
							</TABLE>
							<br><br>
							<DIV class="bulk-actions align-left">
								<!-- <SELECT name="choose_action" id="choose_action">
              <OPTION selected value="">กรุณาเลือก...</OPTION>
              <OPTION value="del">ลบ</OPTION>
            </SELECT>             -->
								<?php
								$a_not_exists = array();
								post_param($a_param, $a_not_exists);
								?>
								<!-- <input class=button name="Action2" type="submit" id="Action2" value="ตกลง"> -->
							</DIV>
							<DIV class=pagination> <?php include("../include/page_show.php"); ?> </DIV>
						</form>
					</DIV><!-- End #tab1 -->


				</DIV><!-- End .content-box-content -->
			</DIV><!-- End .content-box -->
			<!-- End .content-box -->
			<!-- End .content-box -->
			<DIV class=clear></DIV><!-- Start Notifications -->
			<!-- End Notifications -->

			<?php include("../footer.php"); ?>
		</DIV><!-- End #main-content -->
	</DIV>
</BODY>

</HTML>
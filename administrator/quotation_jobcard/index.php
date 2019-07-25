<?php
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);

	if($_GET['action'] == "delete"){
		$code = Check_Permission($conn,$check_module,$_SESSION["login_id"],"delete");
		if ($code == "1") {
			$sql = "delete from $tbl_name  where $PK_field = '$_GET[$PK_field]'";
			@mysqli_query($conn,$sql);
			header ("location:?tab=".$_GET['tab']."&id=".$_GET['id']);
		}
	}

	//-------------------------------------------------------------------------------------
	 if ($_GET['b'] <> "" and $_GET['s'] <> "") {
		if ($_GET['s'] == 0) $status = 1;
		if ($_GET['s'] == 1) $status = 0;
		Check_Permission($conn,$check_module,$_SESSION['login_id'],"update");
		$sql_status = "update $tbl_name set st_setting = '".$status."' where $PK_field = ".$_GET['b']."";
		@mysqli_query($conn,$sql_status);
		/*$sql_fostatus = "update s_first_order set status = ".$status." where fo_id = '$_GET[cus_id]'";
		@mysqli_query($conn,$sql_fostatus);*/
		if($_GET['page'] != ""){$conpage = "&page=".$_GET['page'];}
		header ("location:?tab=".$_GET['tab']."&id=".$_GET['id'].$conpage);
	}


	$quinfo =get_quotation($conn,$_GET['id'],$_GET['tab']);

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

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
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
  <LI>
   <?php
	  if($_GET['tab'] == 2){
		  $backLink = '../quotation2';
	  }else{
		  $backLink = '../quotation';
	  }
   ?>
   <A class=shortcut-button href="<?php echo $backLink;?>"><SPAN><IMG  alt=icon src="../images/btn_back.png"><BR>
    กลับ</SPAN></A></LI>
  <LI><A class=shortcut-button href="update.php?mode=add&cus_id=<?php echo $_GET['id'];?>&tab=<?php echo $_GET['tab'];?>"><SPAN><IMG  alt=icon src="../images/pencil_48.png"><BR>
    เพิ่ม</SPAN></A></LI>
    <?php
	if ($FR_module <> "") {
	$param2 = get_return_param();
	?>
  <LI><A class=shortcut-button href="../<?php  echo $FR_module; ?>/?<?php  if($param2 <> "") echo $param2;?>"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
  <?php  }?>
</UL>
<DIV class=clear></DIV><!-- End .clear -->
<H3 align="left">ชื่อลูกค้า : <?php  echo $quinfo['cd_name']; ?></H3>
<H3 align="left">ที่อยู่ : <?php  echo $quinfo['cd_address']; ?></H3>
<H3 align="left">ใบเสนอราคา<?php if($_GET['tab'] == 2){echo 'เช่า';}else{echo 'ซื้อ';}?> : <?php  echo $quinfo['fs_id']; ?></H3><br>

  <!-- End .shortcut-buttons-set -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right" style="padding-right:15px;">

<H3 align="left"><?php  echo $check_module; ?></H3>

<div style="float:right;padding-top:5px;">
	<form name="form1" method="get" action="index.php">
    <input name="keyword" type="text" id="keyword" value="<?php  echo $keyword;?>">
    <input name="Action" type="submit" id="Action" value="ค้นหา">
    <?php
			$a_not_exists = array('keyword');
			$param2 = get_param($a_param,$a_not_exists);
			  ?>
    <a href="index.php?<?php  echo $param2;?>">แสดงทั้งหมด</a>
    <?php
			/*$a_not_exists = array();
			post_param($a_param,$a_not_exists);*/
			?>
  </form>
</div>

<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
  <form name="form2" method="post" action="confirm.php" onSubmit="return check_select(this)">
    <TABLE>
      <THEAD>
        <TR>
          <TH width="10%"><div align="center"><a>ลำดับ.</a></div></TH>
          <TH width="15%"><div align="center"><a>Service Card ID</a></div></TH>
          <TH width="15%"><div align="center"><a>ผู้แจ้งงาน</a></div></TH>
          <TH width="15%"><div align="center"><a>วันที่แจ้งงาน</a></div></TH>
          <TH width="15%"><div align="center"><a>Open / Close</a></div></TH>
          <TH width="15%"><div align="center"><a>แก้ไข</a></div></TH>
          <TH width="15%"><div align="center"><a>ลบ</a></div></TH>
          </TR>
      </THEAD>
      <TFOOT>
        </TFOOT>
      <TBODY>
        <?php
					if($orderby=="") $orderby = "sc.".$PK_field;
					if ($sortby =="") $sortby ="DESC";

				   	$sql = "SELECT * FROM $tbl_name AS sc WHERE qu_id =".$_GET['id'];
					if ($_GET[$PK_field] <> "") $sql .= " and ($PK_field  = '" . $_GET[$PK_field] . " ' ) ";
					if ($_GET[$FR_field] <> "") $sql .= " and ($FR_field  = '" . $_GET[$FR_field] . " ' ) ";
 					if ($_GET['keyword'] <> "") {
						$sql .= " and ( " .  $PK_field  . " like '%".$_GET['keyword']."%' ";
						if (count ($search_key) > 0) {
							$search_text = " and ( " ;
							foreach ($search_key as $key=>$value) {
									$subtext .= "or " . $value  . " like '%" . $_GET['keyword'] . "%'";
							}
						}
						$sql .=  $subtext . " ) ";
					}


					if ($orderby <> "") $sql .= " order by " . $orderby;
					if ($sortby <> "") $sql .= " " . $sortby;
					include ("../include/page_init.php");
					/*echo $sql;
					break;*/
					$query = @mysqli_query($conn,$sql);
					if($_GET['page'] == "") $_GET['page'] = 1;
					$counter = ($_GET['page']-1)*$pagesize;

					while ($rec = @mysqli_fetch_array($query)) {
					$counter++;
//						$row_sr2 = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM s_quotation_jobcard2 WHERE srid= '".$rec['qc_id']."'"));

				   ?>
        <TR>
         
          <TD style="vertical-align:middle;"><center><span class="text"><?php  echo sprintf("%04d",$counter); ?></span></center></TD>
          <TD style="vertical-align:middle;"><?php  $chaf = str_replace("/","-",$rec["sv_id"]); ?><div align="center"><span class="text"><a href="../../upload/quotation_jobcard/<?php  echo $chaf;?>.pdf" target="_blank"><?php  echo $rec["sv_id"] ; ?></a></span></div></TD>
          <TD style="vertical-align:middle;"><center><span class="text"><?php echo getsalename($conn,$rec["cs_sell"]);?></span></center></TD>
           <TD style="vertical-align:middle;"><center><span class="text"><?php echo format_date_th($rec["job_open"],2);?></span></center></TD>
          <TD style="vertical-align:middle"><div align="center">
            <?php  if($rec["st_setting"]==0) {?>
            <a href="../quotation_jobcard/?b=<?php  echo $rec[$PK_field]; ?>&s=<?php  echo $rec["st_setting"]; ?>&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>&id=<?php  echo $rec["qu_id"];?>&tab=<?php echo $rec["qu_table"];?>"><img src="../icons/status_on.gif" width="10" height="10"></a>
            <?php  } else{?>
            <a href="../quotation_jobcard/?b=<?php  echo $rec[$PK_field]; ?>&s=<?php  echo $rec["st_setting"]; ?>&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>&id=<?php  echo $rec["qu_id"];?>&tab=<?php echo $rec["qu_table"];?>"><img src="../icons/status_off.gif" width="10" height="10"></a>
            <?php  }?>
          </div></TD>
          <TD style="vertical-align:middle;"><!-- Icons -->
            <div align="center"><A title=Edit href="update.php?mode=update&cus_id=<?php echo $_GET['id'];?>&tab=<?php echo $_GET['tab'];?>&qc_id=<?php  echo $rec[$PK_field];?>"><IMG src="../images/icons/paper_content_pencil_48.png" alt=Edit width="25" height="25" title="แก้ไขใบแจ้งงานบริการ"></A><a href="../../upload/quotation_jobcard/<?php  echo $chaf;?>.pdf" target="_blank"><img src="../images/icon2/backup.png" width="25" height="25" title="ดาวน์โหลดใบแจ้งงานบริการ" style="margin-left:10px;"></a></div></TD>
          <TD style="vertical-align:middle;"><div align="center"><A title=Delete  href="#"><IMG alt=Delete src="../images/cross.png" onClick="confirmDelete('?action=delete&id=<?php  echo $rec["qu_id"];?>&tab=<?php echo $rec["qu_table"];?>&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field];?>','Group  <?php  echo $rec[$PK_field];?> : <?php  echo $rec["sv_id"];?>')"></A></div></TD>
          </TR>
		<?php  }?>
      </TBODY>
    </TABLE>
    <br><br>
    <DIV class="bulk-actions align-left">
<!--
            <SELECT name="choose_action" id="choose_action">
              <OPTION selected value="">กรุณาเลือก...</OPTION>
              <OPTION value="del">ลบ</OPTION>
            </SELECT>

           
            <input class=button name="Action2" type="submit" id="Action2" value="ตกลง">--> 
            <?php
				$a_not_exists = array();
				post_param($a_param,$a_not_exists);
			?>
          </DIV> <DIV class=pagination> <?php  include("../include/page_show.php");?> </DIV>
  </form>
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

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
	
	//-------------------------------------------------------------------------------------
	 if ($_GET[b] <> "" and $_GET[s] <> "") { 
		if ($_GET[s] == 0) $status = 1;
		if ($_GET[s] == 1) $status = 0;
		Check_Permission ($check_module,$_SESSION[login_id],"update");
		$sql_status = "update $tbl_name set st_setting = '$status' where $PK_field = '$_GET[b]'";
		@mysql_query ($sql_status);
		header ("location:?"); 
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
  <LI><A class=shortcut-button href="update.php?mode=add<?php  if ($param <> "") echo "&".$param; ?>"><SPAN><IMG  alt=icon src="../images/pencil_48.png"><BR>
    เพิ่ม</SPAN></A></LI>
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
<br><form name="form1" method="get" action="index.php">
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
<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
  <form name="form2" method="post" action="confirm.php" onSubmit="return check_select(this)">
    <TABLE>
      <THEAD>
        <TR>
          <TH width="5%"><INPUT class=check-all type=checkbox name="ca" value="true" onClick="chkAll(this.form, 'del[]', this.checked)"></TH>
          <TH width="5%" <?php  Show_Sort_bg ("user_id", $orderby) ?>> <?php 
		$a_not_exists = array('orderby','sortby');
		$param2 = get_param($a_param,$a_not_exists);
	?>
            <?php   Show_Sort_new ("user_id", "ลำดับ.", $orderby, $sortby,$page,$param2);?>
            &nbsp;</TH>
          <TH width="9%"><div align="center"><a>Serive ID</a></div></TH>
          <TH width="25%"><a>ชื่อลูกค้า</a></TH>
          <TH width="24%"><a>สถานที่ติดตั้ง</a></TH>
          <TH width="8%"><div align="center"><a>Open / Close</a></div></TH>
          <TH width="9%"><div align="center"><a>แก้ไข (Open)</a></div></TH>
          <TH width="10%"><div align="center"><a>แก้ไข (Close)</a></div></TH>
          <TH width="5%"><div align="center"><a>ลบ</a></div></TH>
          </TR>
      </THEAD>
      <TFOOT>
        </TFOOT>
      <TBODY>
        <?php  
					if($orderby=="") $orderby = "sr.".$PK_field;
					if ($sortby =="") $sortby ="DESC";
					
				   	$sql = "SELECT sr . * , fd.cd_name FROM $tbl_name AS sr, s_first_order AS fd WHERE sr.cus_id = fd.fo_id";
					if ($_GET[$PK_field] <> "") $sql .= " and ($PK_field  = '" . $_GET[$PK_field] . " ' ) ";					
					if ($_GET[$FR_field] <> "") $sql .= " and ($FR_field  = '" . $_GET[$FR_field] . " ' ) ";					
 					if ($_GET[keyword] <> "") { 
						$sql .= " and ( " .  $PK_field  . " like '%$_GET[keyword]%' ";
						if (count ($search_key) > 0) { 
							$search_text = " and ( " ;
							foreach ($search_key as $key=>$value) { 
									$subtext .= "or " . $value  . " like '%" . $_GET[keyword] . "%'";
							}	
						}
						$sql .=  $subtext . " ) ";
					} 
					if ($orderby <> "") $sql .= " order by " . $orderby;
					if ($sortby <> "") $sql .= " " . $sortby;
					include ("../include/page_init.php");
					//echo $sql;
					$query = @mysql_query ($sql);
					if($_GET[page] == "") $_GET[page] = 1;
					$counter = ($_GET[page]-1)*$pagesize;
					
					while ($rec = @mysql_fetch_array ($query)) { 
					$counter++;
				   ?>
        <TR>
          <TD style="vertical-align:middle;"><INPUT type=checkbox name="del[]" value="<?php  echo $rec[$PK_field]; ?>" ></TD>
          <TD style="vertical-align:middle;"><span class="text"><?php  echo sprintf("%04d",$counter); ?></span></TD>
          <TD style="vertical-align:middle;"><?php  $chaf = eregi_replace("/","-",$rec["sv_id"]); ?><div align="center"><span class="text"><a href="../../upload/service_report_open/<?php  echo $chaf;?>.pdf" target="_blank"><?php  echo $rec["sv_id"] ; ?></a></span></div></TD>
          <TD style="vertical-align:middle;"><span class="text"><?php  echo get_customername($rec["cus_id"]); ?></span></TD>
          <TD style="vertical-align:middle;"><span class="text"><?php  echo get_localsettingname($rec["cus_id"]); ?></span></TD>
          <TD style="vertical-align:middle"><div align="center">
            <?php  if($rec["st_setting"]==0) {?>
            <a href="../service_report/?b=<?php  echo $rec[$PK_field]; ?>&s=<?php  echo $rec["st_setting"]; ?>&page=<?php  echo $page; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/status_on.gif" width="10" height="10"></a>
            <?php  } else{?>
            <a href="../service_report/?b=<?php  echo $rec[$PK_field]; ?>&s=<?php  echo $rec["st_setting"]; ?>&page=<?php  echo $page; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/status_off.gif" width="10" height="10"></a>
            <?php  }?>
          </div></TD>
          <TD style="vertical-align:middle;"><div align="center"><!-- Icons -->
            <A title=Edit href="update.php?mode=update&<?php  echo $PK_field; ?>=<?php  echo $rec["$PK_field"]; if($param <> "") {?>&<?php  echo $param; }?>"><IMG src="../images/icons/paper_content_pencil_48.png" alt=Edit width="25" height="25" title="แก้ไขรายงานแจ้งซ่อม"></A>&nbsp;<a href="../../upload/service_report_open/<?php  echo $chaf;?>.pdf" target="_blank"><img src="../images/icon2/backup.png" alt="" width="25" height="25" style="margin-left:10px;" title="ดาวน์โหลดรายงานช่างซ่ิอม"></a></div></TD>
          <TD style="vertical-align:middle;"><!-- Icons -->
            <div align="center"><A title=Edit href="update2.php?mode=update&<?php  echo $PK_field; ?>=<?php  echo $rec["$PK_field"]; if($param <> "") {?>&<?php  echo $param; }?>"><IMG src="../images/icons/paper_content_pencil_48.png" alt=Edit width="25" height="25" title="แก้ไขรายงานแจ้งซ่อม"></A><a href="../../upload/service_report_close/<?php  echo $chaf;?>.pdf" target="_blank"><img src="../images/icon2/backup.png" width="25" height="25" title="ดาวน์โหลดรายงานช่างซ่ิอม" style="margin-left:10px;"></a></div></TD>
          <TD style="vertical-align:middle;"><div align="center"><A title=Delete  href="#"><IMG alt=Delete src="../images/cross.png" onClick="confirmDelete('?action=delete&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field];?>','Group  <?php  echo $rec[$PK_field];?> : <?php  echo $rec["group_name"];?>')"></A></div></TD>
          </TR>  
		<?php  }?>
      </TBODY>
    </TABLE>
    <br><br>
    <DIV class="bulk-actions align-left">
            <SELECT name="choose_action" id="choose_action">
              <OPTION selected value="">กรุณาเลือก...</OPTION>
              <OPTION value="del">ลบ</OPTION>
            </SELECT>            
            <?php 
				$a_not_exists = array();
				post_param($a_param,$a_not_exists); 
			?>
            <input class=button name="Action2" type="submit" id="Action2" value="ตกลง">
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

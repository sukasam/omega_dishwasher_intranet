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
			header ("location:index.php");
		} 
	}

	//-------------------------------------------------------------------------------------
//	 if ($_GET['b'] <> "" and $_GET['s'] <> "") {
//		if ($_GET['s'] == 0) $status = 1;
//		if ($_GET['s'] == 1) $status = 0;
//		Check_Permission($conn,$check_module,$_SESSION['login_id'],"update");
//		$sql_status = "update $tbl_name set approve = '".$status."' where group_id = ".$_GET['b']."";
//		@mysqli_query($conn,$sql_status);
//		if($_GET['page'] != ""){$conpage = "&page=".$_GET['page'];}
//		header ("location:index.php");
//	}

 	if ($_GET['id'] <> "" and $_GET['id'] <> "") {
		Check_Permission($conn,$check_module,$_SESSION['login_id'],"update");
		$sql_status = "update $tbl_name set approve = '".$_GET['process']."' where group_id = ".$_GET['id']."";
		@mysqli_query($conn,$sql_status);
		if($_GET['page'] != ""){$conpage = "&page=".$_GET['page'];}
		header ("location:index.php");
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
<div style="float:right;padding-top:5px;">
	<!-- <form name="form1" method="get" action="index.php">
    <input name="keyword" type="text" id="keyword" value="<?php     echo $keyword;?>">
    <input name="Action" type="submit" id="Action" value="ค้นหา">
    <?php    
			$a_not_exists = array('keyword');
			$param2 = get_param($a_param,$a_not_exists);
			  ?>
    <a href="index.php?<?php     echo $param2;?>">แสดงทั้งหมด</a>
    <?php     
			/*$a_not_exists = array();
			post_param($a_param,$a_not_exists);*/
			?>
  </form> -->
</div>
<div style="float:right;margin-right:20px;padding-top:5px;">  
	<label><strong>ประเภทการแจ้งเตือน : </strong></label>
    <select name="catalog_master" id="catalog_master" style="height:24px;" onChange="MM_jumpMenu('parent',this,0)">
		 <option value="index.php?typenoti=0" <?php if($_GET['typenoti'] == 0){echo "selected";}?>>กรุณาเลือก</option>
		 <option value="index.php?typenoti=1" <?php if($_GET['typenoti'] == 1){echo "selected";}?>>อนุมัติเอกสาร (First Order)</option>
         <option value="index.php?typenoti=2" <?php if($_GET['typenoti'] == 2){echo "selected";}?>>อนุมัติเอกสาร (ใบแจ้งงาน)</option>
		 <option value="index.php?typenoti=3" <?php if($_GET['typenoti'] == 3){echo "selected";}?>>อนุมัติเอกสาร (Memo)</option>
		 <option value="index.php?typenoti=4" <?php if($_GET['typenoti'] == 4){echo "selected";}?>>อนุมัติเอกสาร (ใบเสนอราคาซื้อ)</option>
		 <option value="index.php?typenoti=5" <?php if($_GET['typenoti'] == 5){echo "selected";}?>>อนุมัติเอกสาร (ใบเสนอราคาเช่า)</option>
		 <option value="index.php?typenoti=6" <?php if($_GET['typenoti'] == 6){echo "selected";}?>>อนุมัติเอกสาร (ใบงานบริการ)</option>
		 <option value="index.php?typenoti=7" <?php if($_GET['typenoti'] == 7){echo "selected";}?>>วันหมดสัญญา (สัญญาเข่า)</option>
		 <option value="index.php?typenoti=8" <?php if($_GET['typenoti'] == 8){echo "selected";}?>>วันหมดสัญญา (สัญญาบริการ)</option>
		 <option value="index.php?typenoti=9" <?php if($_GET['typenoti'] == 9){echo "selected";}?>>วันหมดสัญญา (สัญญาซื้อ-ขาย)</option>
		 <option value="index.php?typenoti=10" <?php if($_GET['typenoti'] == 10){echo "selected";}?>>สถานะใบสั่งน้ำยา</option>
		 <option value="index.php?typenoti=11" <?php if($_GET['typenoti'] == 10){echo "selected";}?>>สถานะใบแจ้งซ่อม</option>
  	</select>
    </div>
<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
  <form name="form2" method="post" action="confirm.php" onSubmit="return check_select(this)">
    <TABLE>
      <THEAD>
        <TR>
          <!-- <TH width="5%"><INPUT class=check-all type=checkbox name="ca" value="true" onClick="chkAll(this.form, 'del[]', this.checked)"></TH> -->
		  <TH width="10%"><a>ลำดับ.</a></TH>
		  <TH width="20%"><a>ชื่อพนักงานขาย</a></TH>
		  <TH width="20%"><a>ชื่อเข้าใช้ระบบ</a></TH>
		  <TH width="20%"><a>ประเภทการแจ้งเตือน</a></TH>
          <TH width="5%"><a>แก้ไข</a></TH>
          <TH width="5%"><a>ลบ</a></TH>
        </TR>
      </THEAD>
      <TFOOT>
        </TFOOT>
      <TBODY>
        <?php  
					if($orderby=="") $orderby = $tbl_name.".group_name";
					if ($sortby =="") $sortby ="ASC";
					
				   	$sql = " select *,$tbl_name.create_date as c_date from $tbl_name  where 1 ";
					if ($_GET[$PK_field] <> "") $sql .= " and ($PK_field  = '" . $_GET[$PK_field] . " ' ) ";					
					if ($_GET[$FR_field] <> "") $sql .= " and ($FR_field  = '" . $_GET[$FR_field] . " ' ) ";					
 					if ($_GET['keyword'] <> "") { 
						$sql .= "and ( " .  $PK_field  . " like '%".$_GET['keyword']."%' ";
						if (count ($search_key) > 0) { 
							$search_text = " and ( " ;
							foreach ($search_key as $key=>$value) { 
									$subtext .= "or " . $value  . " like '%" . $_GET['keyword'] . "%'";
							}	
						}
						$sql .=  $subtext . " ) ";
					} 

					if ($_GET['typenoti'] != "" && $_GET['typenoti'] != "0") { 
						$sql .= " and ( group_name = '$_GET[typenoti]' ";
						$sql .=  $subtext . " ) ";
					}

					if ($orderby <> "") $sql .= " order by " . $orderby;
					if ($sortby <> "") $sql .= " " . $sortby;
					include ("../include/page_init.php");
					//echo $sql;
					$query = @mysqli_query($conn,$sql);
					if($_GET['page'] == "") $_GET['page'] = 1;
					$counter = ($_GET['page']-1)*$pagesize;
					
					while ($rec = @mysqli_fetch_array($query)) { 
					$counter++;
				   ?>
        <TR>
        <!-- <TD><INPUT type=checkbox name="del[]" value="<?php  echo $rec[$PK_field]; ?>" ></TD> -->
          <TD><span class="text"><?php  echo sprintf("%04d",$counter); ?></span></TD>
          <TD><span class="text"><?php  echo get_username($conn,$rec["user_account"]); ?></span></TD>
          <TD><span class="text"><?php  echo get_useraccount($conn,$rec["user_account"]); ?></span></TD>
          <TD><span class="text"><?php  echo get_typeNoti($rec["group_name"]); ?></span></TD>
          <TD><!-- Icons -->
            <A title=Edit href="update.php?mode=update&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field]; if($param <> "") {?>&<?php  echo $param; }?>"><IMG alt=Edit src="../images/pencil.png"></A> <A title=Delete  href="#"></A></TD>
          <TD><A title=Delete  href="#"><IMG alt=Delete src="../images/cross.png" onClick="confirmDelete('?action=delete&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field];?>','Group  <?php  echo $rec[$PK_field];?> : <?php  echo $rec["group_name"];?>')"></A></TD>
        </TR>  
		<?php  }?>
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
				post_param($a_param,$a_not_exists); 
			?>
            <!-- <input class=button name="Action2" type="submit" id="Action2" value="ตกลง"> -->
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

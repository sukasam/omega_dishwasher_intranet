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
			header ("location:index.php?inv=".$_GET['inv']);
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
  <LI><A class=shortcut-button href="update.php?inv=<?php echo $_GET['inv'];?>&mode=add<?php  if ($param <> "") echo "&".$param; ?>"><SPAN><IMG  alt=icon src="../images/pencil_48.png"><BR>
    เพิ่ม</SPAN></A></LI>
    <LI><A class=shortcut-button href="../group_pod/?inv=0"><SPAN><IMG  alt=icon src="../images/icons/icon-48-module.png"><BR>
    คลังสินค้าใหม่</SPAN></A></LI>
    <LI><A class=shortcut-button href="../group_pod/?inv=1"><SPAN><IMG  alt=icon src="../images/icons/icon-48-module.png"><BR>
    คลังซ่อมบำรุง</SPAN></A></LI>
    <LI><A class=shortcut-button href="../group_pod/?inv=2"><SPAN><IMG  alt=icon src="../images/icons/icon-48-module.png"><BR>
    คลังสินค้ามือสอง</SPAN></A></LI>
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

<div>
<strong>หมวดหมู่ V1 : </strong><select name="catv1" id="catv1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)" style="height:30px;">
  <option value="index.php"><== กรุณาเลือก ==></option>
      <?php  
          $qucatv1 = @mysqli_query($conn, "SELECT * FROM s_group_catpro ORDER BY group_name ASC");
          while ($row_catv1 = @mysqli_fetch_array($qucatv1)) {
          ?>
              <option value="index.php?inv=<?php if($_GET['inv'] != ''){echo $_GET['inv'];}else{echo "0";};?>&catv1=<?php echo $row_catv1['group_id']; ?>" <?php  if($row_catv1['group_id'] == $_GET['catv1']){echo 'selected';}?>><?php echo $row_catv1['group_name']; ?></option>
          <?php
            }
      ?>
  </select>
<br><br>
<?php
if($_GET['catv1'] != ""){
?>
<strong>หมวดหมู่ V2 : </strong>
<select name="catv2" id="catv2" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)" style="height:30px;">
  <option value="index.php"><== กรุณาเลือก ==></option>
      <?php  
         $condi2 = ' AND group_cat_id ='.$_GET['catv1'];
         $qucatv2 = @mysqli_query($conn, "SELECT * FROM s_group_catpro2 WHERE 1 ".$condi2." ORDER BY group_name ASC");
         while ($row_catv2 = @mysqli_fetch_array($qucatv2)) {
          ?>
              <option value="index.php?inv=<?php if($_GET['inv'] != ''){echo $_GET['inv'];}else{echo "0";};?>&catv1=<?php echo $_GET['catv1']; ?>&catv2=<?php echo $row_catv2['group_id']; ?>" <?php  if($row_catv2['group_id'] == $_GET['catv2']){echo 'selected';}?>><?php echo $row_catv2['group_name']; ?></option>
          <?php
            }
      ?>
  </select>
<br><br>
<?php
}
if($_GET['catv2'] != ""){
  ?>
  <strong>หมวดหมู่ V3 : </strong>
  <select name="catv3" id="catv3" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)" style="height:30px;">
    <option value="index.php"><== กรุณาเลือก ==></option>
        <?php  
           $condi3 = ' AND group_cat2_id ='.$_GET['catv2'];
           $qucatv3 = @mysqli_query($conn, "SELECT * FROM s_group_catpro3 WHERE 1 ".$condi3." ORDER BY group_name ASC");
           while ($row_catv3 = @mysqli_fetch_array($qucatv3)) {
            ?>
                <option value="index.php?inv=<?php if($_GET['inv'] != ''){echo $_GET['inv'];}else{echo "0";};?>&catv1=<?php echo $_GET['catv1']; ?>&catv2=<?php echo $_GET['catv2']; ?>&catv3=<?php echo $row_catv3['group_id']; ?>" <?php  if($row_catv3['group_id'] == $_GET['catv3']){echo 'selected';}?>><?php echo $row_catv3['group_name']; ?></option>
            <?php
              }
        ?>
    </select>
  <br><br>
  <?php
  }
  if($_GET['catv3'] != ""){
    ?>
    <strong>หมวดหมู่ V4 : </strong>
    <select name="catv4" id="catv4" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)" style="height:30px;">
      <option value="index.php"><== กรุณาเลือก ==></option>
          <?php  
             $condi4 = ' AND group_cat3_id ='.$_GET['catv3'];
             $qucatv4 = @mysqli_query($conn, "SELECT * FROM s_group_catpro4 WHERE 1 ".$condi4." ORDER BY group_name ASC");
             while ($row_catv4 = @mysqli_fetch_array($qucatv4)) {
              ?>
                  <option value="index.php?inv=<?php if($_GET['inv'] != ''){echo $_GET['inv'];}else{echo "0";};?>&catv1=<?php echo $_GET['catv1']; ?>&catv2=<?php echo $_GET['catv2']; ?>&catv3=<?php echo $_GET['catv3']; ?>&catv4=<?php echo $row_catv4['group_id']; ?>" <?php  if($row_catv4['group_id'] == $_GET['catv4']){echo 'selected';}?>><?php echo $row_catv4['group_name']; ?></option>
              <?php
                }
          ?>
      </select>
    <br><br>
    <?php
    }
?>
</div><br><br>

<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right" style="padding-right:15px;">

<H3 align="left"><?php  echo $page_name; ?></H3>
<br><form name="form1" method="get" action="index.php">
    <input name="keyword" type="text" id="keyword" value="<?php  echo $keyword;?>">
    <input name="inv" type="hidden" id="inv" value="<?php  echo $_GET['inv'];?>">
    <input name="Action" type="submit" id="Action" value="ค้นหา">
    <?php 
			$a_not_exists = array('keyword');
			$param2 = get_param($a_param,$a_not_exists);
			  ?>
    <a href="index.php?inv=<?php echo $_GET['inv'];?>&<?php  echo $param2;?>">แสดงทั้งหมด</a>
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
          <!-- <TH width="3%"><INPUT class=check-all type=checkbox name="ca" value="true" onClick="chkAll(this.form, 'del[]', this.checked)"></TH> -->
          <TH width="9%" <?php  Show_Sort_bg ("user_id", $orderby) ?>> <?php 
		$a_not_exists = array('orderby','sortby');
		$param2 = get_param($a_param,$a_not_exists);
	?>
            <?php   Show_Sort_new ("user_id", "ลำดับ.", $orderby, $sortby,$page,$param2);?>
            &nbsp;</TH>
          <!--<TH width="19%" <?php  Show_Sort_bg ("group_name", $orderby) ?>>
           <?php   Show_Sort_new ("group_name", "รหัสสินค้า", $orderby, $sortby,$page,$param2);?>
            &nbsp;</TH>-->
            <TH width="30%"><a>หมวดหมู่</a></TH>
          <TH width="30%" <?php  Show_Sort_bg ("group_name", $orderby) ?>> <?php   Show_Sort_new ("group_name", "รุ่นสินค้า", $orderby, $sortby,$page,$param2);?>
            &nbsp;</TH>
         <!-- <TH width="15%" <?php  Show_Sort_bg ("group_name", $orderby) ?>> <?php   Show_Sort_new ("group_name", "จำนวน", $orderby, $sortby,$page,$param2);?>
  &nbsp;</TH>-->
  		<!--<TH width="17%" <?php  Show_Sort_bg ("group_name", $orderby) ?>> <?php   Show_Sort_new ("group_name", "รุ่น", $orderby, $sortby,$page,$param2);?>
  &nbsp;</TH>
          <TH width="18%" <?php  Show_Sort_bg ("group_name", $orderby) ?>> <?php   Show_Sort_new ("group_name", "S/N", $orderby, $sortby,$page,$param2);?>
            &nbsp;</TH>-->
          <TH width="10%"><a>ทั้งหมด</a></TH>
          <TH width="10%"><a>คงเหลือ</a></TH>
          <TH width="5%"><a>ซีรีย์</a></TH>
          <TH width="5%"><a>แก้ไข</a></TH>
          <TH width="4%"><a>ลบ</a></TH>
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
          
          if ($_REQUEST['catv1'] <> "") { 
						$sql .= " and catv1 = '".$_REQUEST['catv1']."'";
          }
          if ($_REQUEST['catv2'] <> "") { 
						$sql .= " and catv2 = '".$_REQUEST['catv2']."'";
          }
          if ($_REQUEST['catv3'] <> "") { 
						$sql .= " and catv3 = '".$_REQUEST['catv3']."'";
          }
          if ($_REQUEST['catv4'] <> "") { 
						$sql .= " and catv4 = '".$_REQUEST['catv4']."'";
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
          <!--<TD><span class="text"><?php  echo $rec["group_spro_id"] ; ?></span></TD>-->
          <TD><span class="text"><?php echo getCatProAllName($conn,$rec['catv1'],$rec['catv2'],$rec['catv3'],$rec['catv4']);?></span></TD>
          <TD><span class="text"><?php  echo $rec["group_name"] ; ?></span></TD>
          <!--<TD><span class="text"><?php  echo $rec["group_stock"] ; ?></span></TD>-->
          <TD><span class="text"><?php echo getTotalSNofPod($conn,$rec[$PK_field],$_GET['inv']);?>
        </span></TD>
          <TD><span class="text"><?php echo checkSNRemain($conn,$rec[$PK_field],$_GET['inv']);?></span></TD>
          <TD><!-- Icons -->
            <A title='Series' href="../group_sn/index.php?inv=<?php if($_GET['inv'] != ''){echo $_GET['inv'];}else{echo "0";};?>&pod=<?php  echo $rec[$PK_field];?>"><IMG alt=Edit src="../images/icon2/addedit.png" width="25"></A></TD>
          <TD><A title=Edit href="update.php?mode=update&inv=<?php if($_GET['inv'] != ''){echo $_GET['inv'];}else{echo "0";};?>&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field]; if($param <> "") {?>&<?php  echo $param; }?>"><IMG alt=Edit src="../images/pencil.png"></A> <A title=Delete  href="#"></A></TD>
          <TD><A title=Delete  href="#"><IMG alt=Delete src="../images/cross.png" onClick="confirmDelete('?action=delete&inv=<?php if($_GET['inv'] != ''){echo $_GET['inv'];}else{echo "0";};?>&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field];?>','Group  <?php  echo $rec[$PK_field];?> : <?php  echo $rec["group_name"];?>')"></A></TD>
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

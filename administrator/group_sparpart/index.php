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
    <LI><A class=shortcut-button href="index.php"><SPAN><IMG  alt=icon src="../images/menu/mn_serting06.png"><BR>
    สต๊อคอะไหล่</SPAN></A></LI>
    <LI><A class=shortcut-button href="update.php?mode=add<?php  if ($param <> "") echo "&".$param; ?>"><SPAN><IMG  alt=icon src="../images/menu/mn_serting21.png"><BR>
    เพิ่มอะไหล่</SPAN></A></LI>
    <LI><A class=shortcut-button href="../group_sparpart_stockin/update.php?mode=add"><SPAN><IMG  alt=icon src="../images/menu/mn_serting22.png"><BR>
    รับเข้าสต๊อค</SPAN></A></LI>
    <LI><A class=shortcut-button href="../report2/?mid=16&act=19"><SPAN><IMG  alt=icon src="../images/menu/mn_serting23.png"><BR>
    รายงานสต็อค</SPAN></A></LI>
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
          $qucatv1 = @mysqli_query($conn, "SELECT * FROM s_group_catspare ORDER BY group_name ASC");
          while ($row_catv1 = @mysqli_fetch_array($qucatv1)) {
          ?>
              <option value="index.php?catv1=<?php echo $row_catv1['group_id']; ?>" <?php  if($row_catv1['group_id'] == $_GET['catv1']){echo 'selected';}?>><?php echo $row_catv1['group_name']; ?></option>
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
         $qucatv2 = @mysqli_query($conn, "SELECT * FROM s_group_catspare2 WHERE 1 ".$condi2." ORDER BY group_name ASC");
         while ($row_catv2 = @mysqli_fetch_array($qucatv2)) {
          ?>
              <option value="index.php?catv1=<?php echo $_GET['catv1']; ?>&catv2=<?php echo $row_catv2['group_id']; ?>" <?php  if($row_catv2['group_id'] == $_GET['catv2']){echo 'selected';}?>><?php echo $row_catv2['group_name']; ?></option>
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
           $qucatv3 = @mysqli_query($conn, "SELECT * FROM s_group_catspare3 WHERE 1 ".$condi3." ORDER BY group_name ASC");
           while ($row_catv3 = @mysqli_fetch_array($qucatv3)) {
            ?>
                <option value="index.php?catv1=<?php echo $_GET['catv1']; ?>&catv2=<?php echo $_GET['catv2']; ?>&catv3=<?php echo $row_catv3['group_id']; ?>" <?php  if($row_catv3['group_id'] == $_GET['catv3']){echo 'selected';}?>><?php echo $row_catv3['group_name']; ?></option>
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
             $qucatv4 = @mysqli_query($conn, "SELECT * FROM s_group_catspare4 WHERE 1 ".$condi4." ORDER BY group_name ASC");
             while ($row_catv4 = @mysqli_fetch_array($qucatv4)) {
              ?>
                  <option value="index.php?catv1=<?php echo $_GET['catv1']; ?>&catv2=<?php echo $_GET['catv2']; ?>&catv3=<?php echo $_GET['catv3']; ?>&catv4=<?php echo $row_catv4['group_id']; ?>" <?php  if($row_catv4['group_id'] == $_GET['catv4']){echo 'selected';}?>><?php echo $row_catv4['group_name']; ?></option>
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
<!--          <TH width="4%"><INPUT class=check-all type=checkbox name="ca" value="true" onClick="chkAll(this.form, 'del[]', this.checked)"></TH>-->
          <TH width="5%"><center><a>ลำดับ</a></center></TH>
          <TH width="10%"><center><a>รหัสต่างประเทศ</a></center></TH>
          <TH width="10%"><center><a>รหัสภายใน</a></center></TH>
          <TH width="10%"><center><a>รหัส Barcode</a></center></TH>
          <TH width="20%"><a>ชื่ออะไหล่</a></TH>
          <TH width="5%"><a>หน่วย</a></TH>
<!--          <TH width="10%"><a>สถานที่จัดเก็บ</a></TH>-->
          <TH width="10%"><center><a>คงเหลือ</a></center></TH>
<!--          <TH width="10%"><a>ชนิดสินค้า</a></TH>-->
          <TH width="10%"><center><a>ราคาต้นทุน</a></center></TH>
          <TH width="10%"><center><a>รวมราคาต้นทุน</a></center></TH>
<!--          <TH width="10%"><center><a>ราคาขาย</a></center></TH>-->
        <TH width="5%"><center><a>แก้ไข</a></center></TH>
          <TH width="5%"><center><a>ลบ</a></center></TH>
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
						$sql .= "and ( " .  $PK_field  . " like '%".$_GET['keyword']."%' OR `group_spar_barcode` = '".$_GET['keyword']."' ";
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
<!--          <TD><INPUT type=checkbox name="del[]" value="<?php     echo $rec[$PK_field]; ?>" ></TD>-->
          <TD><span class="text"><?php     echo sprintf("%04d",$counter); ?></span></TD>
          <TD style="text-align: center;"><span class="text"><?php echo $rec["group_spar_id"] ; ?></span></TD>
          <TD style="text-align: center;"><span class="text"><?php echo $rec["group_spar_account_id"] ; ?></span></TD>
          <!-- <TD style="text-align: center;"><span class="text"><a href="../../qrcode_gen/qr_barcode.php?val=<?php echo $rec["group_spar_barcode"];?>" target="_blank"><?php echo $rec["group_spar_barcode"];?></span></a></TD> -->
          <TD style="text-align: center;"><span class="text"><a href="../../barcode_gen/barcode.php?val=<?php echo $rec["group_spar_barcode"];?>" target="_blank" style="color: #2958df;"><?php echo $rec["group_spar_barcode"];?></span></a></TD>
          
          <TD><span class="text"><?php     echo $rec["group_name"] ; ?></span></TD>
          <TD><span class="text"><?php     echo $rec["group_namecall"] ; ?></span></TD>
<!--          <TD><span class="text"><?php     echo $rec["group_location"] ; ?></span></TD>-->
          <TD style="text-align: center;"><span class="text"><?php     echo number_format($rec["group_stock"]); ?></span></TD>
<!--          <TD style="text-align: center;"><span class="text"><?php     echo $rec["group_type"] ; ?></span></TD>-->
          <TD style="text-align: right;"><span class="text"><?php     echo number_format($rec["group_unit_price"],2); ?></span></TD>
          <TD style="text-align: right;"><span class="text"><?php     echo number_format($rec["group_stock"]*$rec["group_unit_price"],2) ; ?></span></TD>
<!--          <TD style="text-align: right;"><span class="text"><?php     echo number_format($rec["group_price"],2); ?></span></TD>-->
          <TD style="text-align: center;"><A title=Edit href="update.php?mode=update&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field]; if($param <> "") {?>&<?php  echo $param; }?>"><IMG alt=Edit src="../images/pencil.png"></A></TD>
          <TD style="text-align: center;"><A title=Delete  href="#"><IMG alt=Delete src="../images/cross.png" onClick="confirmDelete('?action=delete&<?php     echo $PK_field; ?>=<?php     echo $rec[$PK_field];?>','Group  <?php     echo $rec[$PK_field];?> : <?php     echo $rec["group_name"];?>')"></A></TD>
        </TR>  
		<?php  }?>
      </TBODY>
    </TABLE>
    <br><br>
    <div>
    	<center><a href="print.php?keyword=<?php echo $_GET['keyword'];?>" target="_blank"><input class=button name="btprint" type="button" value="พิมพ์รายการอะไหล่"></a></center>
    </div>
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

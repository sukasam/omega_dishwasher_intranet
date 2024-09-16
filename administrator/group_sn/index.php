<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	if(!isset($_GET['pod']) || $_GET['pod'] == ''){
		header("Location:../group_pod/index.php");
	}
	
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	if($_GET['action'] == "delete"){
		$code = Check_Permission($conn,$check_module,$_SESSION["login_id"],"delete");		
		if ($code == "1") {
			$sql = "delete from $tbl_name  where $PK_field = '$_GET[$PK_field]'";
			@mysqli_query($conn,$sql);			
			header ("location:index.php?pod=".$_GET['pod']."&inv=".$_GET['inv']);
		} 
	}

  //-------------------------------------------------------------------------------------

if ($_GET['s'] == '') {
  $_GET['s'] = 0;
}

if ($_GET['b'] != "" && $_GET['s'] != "") {

  if ($_GET['s'] == 0) {
      $status = 1;
  }

  if ($_GET['s'] == 1) {
      $status = 0;
  }

  Check_Permission($conn, $check_module, $_SESSION['login_id'], "update");
  $sql_status = "update $tbl_name set group_status = '" . $status . "' where $PK_field = " . $_GET['b'] . "";
  @mysqli_query($conn, $sql_status);
  /*$sql_fostatus = "update s_first_order set status = ".$status." where fo_id = '$_GET[cus_id]'";
  @mysqli_query($conn,$sql_fostatus);*/
  $conpage = '';
  if ($_GET['page'] != "") {
      $conpage .= "page=" . $_GET['page'];
  }
  if ($_GET['pod'] != "") {
    if ($_GET['page'] != "") {
        $conpage .= "&pod=" . $_GET['pod'];
    } else {
        $conpage .= "pod=" . $_GET['pod'];
    }
  }

  $conpage .= "&inv=" . $_GET['inv'];

  header("location:?" . $conpage);
}

if ($_GET['ff'] != "" && $_GET['gg'] != "") { 
	
  if ($_GET['gg'] == 0) $group_inv = 0;
  if ($_GET['gg'] == 1) $group_inv = 1;
  if ($_GET['gg'] == 2) $group_inv = 2;

  $sql_status = "update $tbl_name set group_inv = '".$group_inv."' where $PK_field = '".$_GET['ff']."'";

  $conpage = '';
  if ($_GET['page'] != "") {
      $conpage .= "page=" . $_GET['page'];
  }
  if ($_GET['pod'] != "") {
    if ($_GET['page'] != "") {
        $conpage .= "&pod=" . $_GET['pod'];
    } else {
        $conpage .= "pod=" . $_GET['pod'];
    }
  }

  $conpage .= "&inv=" . $group_inv;

  // $code = Check_Permission($conn,"Move Inventory Star",$_SESSION['login_id'],"update");

  // if ($code == "1") {
    @mysqli_query($conn,$sql_status);
    // if($_GET['page'] != ""){$conpage = "page=".$_GET['page'];}
    header ("location:?".$conpage); 
  // }
  
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
 <LI><A class=shortcut-button href="../group_pod/?inv=<?php echo $_GET['inv'];?>"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR><br>
  กลับ</SPAN></A></LI>
  <LI><A class=shortcut-button href="update.php?mode=add&inv=<?php echo $_GET['inv'];?><?php  if ($param <> "") echo "&".$param; ?>&pod=<?php echo $_GET['pod'];?>"><SPAN><IMG  alt=icon src="../images/pencil_48.png"><BR>
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
<div><strong><img src="../icons/favorites_stranby.png" width="15" height="15"> คลังสินค้าใหม่ / <img src="../icons/favorites_close.png" width="15" height="15"> คลังสินค้าซ่อม / <img src="../icons/favorites_use.png" width="15" height="15"> คลังสินค้ามือสอง</strong></div><br><br>
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right" style="padding-right:15px;">

<H3 align="left"><?php  echo $page_name; ?></H3>
<br>
<div style="float:right;">
<form name="form1" method="get" action="index.php">
    <input name="keyword" type="text" id="keyword" value="<?php  echo $keyword;?>">
    <input name="pod" type="hidden" id="pod" value="<?php  echo $_GET['pod'];?>">
    <input name="inv" type="hidden" id="inv" value="<?php  echo $_GET['inv'];?>">
    <input name="Action" type="submit" id="Action" value="ค้นหา">
    <?php 
			$a_not_exists = array('keyword');
			$param2 = get_param($a_param,$a_not_exists);
			  ?>
    <a href="index.php?inv=<?php echo $_GET['inv'];?>&pod=<?php echo $_GET['pod'];?>&<?php  echo $param2;?>">แสดงทั้งหมด</a>
    <?php  
			/*$a_not_exists = array();
			post_param($a_param,$a_not_exists);*/
			?>
  </form>
  </div>
  <!-- <div style="float:right;margin-right:20px;">  
  <label><strong>การใช้งาน SN : </strong></label>
    <select name="catalog_master" id="catalog_master" style="height:24px;" onChange="MM_jumpMenu('parent',this,0)">
     <option value="index.php" <?php  if(!isset($_GET['process'])){echo "selected";}?>>กรุณาเลือก</option>
     <option value="index.php?snuse=1&pod=<?php echo $_GET['pod'];?>" <?php  if($_GET['process'] == '0'){echo "selected";}?>>คงเหลือ</option>
		 <option value="index.php?snuse=2&pod=<?php echo $_GET['pod'];?>" <?php  if($_GET['process'] == '0'){echo "selected";}?>>ใช้งานแล้ว</option>
  	</select>
    </div> -->
<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
  <form name="form2" method="post" action="confirm.php" onSubmit="return check_select(this)">
    <TABLE>
      <THEAD>
        <TR>
<!--          <TH width="3%"><INPUT class=check-all type=checkbox name="ca" value="true" onClick="chkAll(this.form, 'del[]', this.checked)"></TH>-->
          <TH width="5%" <?php  Show_Sort_bg ("user_id", $orderby) ?>> <?php 
		$a_not_exists = array('orderby','sortby');
		$param2 = get_param($a_param,$a_not_exists);
	?>
            <?php   Show_Sort_new ("user_id", "ลำดับ.", $orderby, $sortby,$page,$param2);?>
            &nbsp;</TH>
            <TH width="12%"><center>QR Code</center></TH>
           <TH width="10%" <?php  Show_Sort_bg ("group_name", $orderby) ?>>
           <center><?php   Show_Sort_new ("group_name", "บาร์โค้ด", $orderby, $sortby,$page,$param2);?></center></TH>
          <TH width="15%" <?php  Show_Sort_bg ("group_name", $orderby) ?>> <?php   Show_Sort_new ("group_name", "รหัสซีรี่ย์สินค้า", $orderby, $sortby,$page,$param2);?>
            &nbsp;</TH>
         <TH width="15%" <?php  Show_Sort_bg ("group_datetime_key", $orderby) ?>> <?php   Show_Sort_new ("group_datetime_key", "วันรับเข้า / <br>วันสิ้นสุดการใช้งาน", $orderby, $sortby,$page,$param2);?>
  &nbsp;</TH>
  		<TH width="15%" <?php  Show_Sort_bg ("group_shipnumber", $orderby) ?>> <?php   Show_Sort_new ("group_shipnumber", "เลขที่ใบขน", $orderby, $sortby,$page,$param2);?>
  &nbsp;</TH>
          <TH width="15%" <?php  Show_Sort_bg ("group_invoicenumber", $orderby) ?>> <?php   Show_Sort_new ("group_invoicenumber", "เลขที่ Invoice", $orderby, $sortby,$page,$param2);?>
            &nbsp;</TH>
            <TH width="16%"><center>ย้ายคลังสินค้า</center></TH>
            <TH width="8%">
                      <div align="center" style="white-space: nowrap;"><a>เปิด / ปิด</a></div>
                    </TH>
          <TH width="5%"><a></a></TH>
          <TH width="4%" style="white-space: nowrap;"><a>แก้ไข | ลบ</a></TH>
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

          // if ($_GET['snuse'] != "") { 
					// 	$sql .= " and ( snuse = '".$_GET['snuse']."' ";
					// 	$sql .=  $subtext . " ) ";
					// }
		  			
		  		if ($_REQUEST['pod'] <> "") { 
						$sql .= " and group_pod = '".$_REQUEST['pod']."'";
					}

          if ($_REQUEST['inv'] <> "") { 
						$sql .= " and group_inv = '".$_REQUEST['inv']."'";
					}
		  
					if ($orderby <> "") $sql .= " order by " . $orderby;
					if ($sortby <> "") $sql .= " " . $sortby;
					include ("../include/page_init.php");
					//echo $sql;
					$query = @mysqli_query($conn,$sql);
					if($_GET['page'] == "") $_GET['page'] = 1;
					$counter = ($_GET['page']-1)*$pagesize;

          $numRemain = 0;
					
					while ($rec = @mysqli_fetch_array($query)) { 
					$counter++;

          $snUse = ''; 
          $foid = getFOSNuseID($conn, $rec["group_name"]);
          $linkFO = '';
          $chaf = str_replace("/","-",$foid);

          
          
          if(getFOSNuse($conn,$rec["group_name"]) >= 1){
            $snUse = 'color: red;';
            $linkFO = '<a href="../../upload/first_order/'.$chaf.'.pdf" target="_blank" style="color: red;">'.$rec['group_name'].'</a>';
            $numRemain++;
          }else{
            $linkFO = $rec['group_name'];
          }
          
				   ?>
         <TR>
<!--          <TD><INPUT type=checkbox name="del[]" value="<?php  echo $rec[$PK_field]; ?>" ></TD>-->
          <TD><span class="text"><?php  echo sprintf("%04d",$counter); ?></span></TD>
          <TD><center><img src="../../qrcode_gen/qrcode.php?val=<?php echo $rec["group_name"];?>" width="80"></center></TD>
          <!-- <TD><a href="../../barcode_gen/barcode.php?val=<?php echo $rec["group_name"];?>" target="_blank" style="color: #2958df;"><?php echo $rec["group_name"];?></span></a></TD> -->
          <td><a href="../../barcode_gen/barcode.php?val=<?php echo $rec["group_name"];?>" target="_blank" style="color: #2958df;"><img alt="<?php echo $rec["group_name"];?>" width="150" height="50" src="https://barcode.tec-it.com/barcode.ashx?data=<?php echo $rec["group_name"];?>&amp;code=&amp;translate-esc=true"></a></td>
          <TD><span class="text" style="<?php echo $snUse;?>"><?php echo $linkFO;?></span></TD>
          <TD><span class="text"><?php  echo format_date_th($rec["group_datetime_key"],6); ?> / <br><?php  echo format_date_th($rec["group_expired"],6); ?></span></TD>
          <TD><span class="text"><?php  echo $rec["group_shipnumber"] ; ?></span></TD>
          <TD><span class="text"><?php  echo $rec["group_invoicenumber"] ; ?></span></TD>
          <TD><span class="text">
          <div align="center">
            <?php  if($rec["group_inv"] == '2') {?>
            <img src="../icons/favorites_use.png" width="30" height="30">
            <?php  } elseif($rec["group_inv"] == '1') {?>
            <img src="../icons/favorites_close.png" width="30" height="30">
            <?php  } else{?>
            <img src="../icons/favorites_stranby.png" width="30" height="30">
            <?php  }?>
            <?php
            if(!getFOSNuse($conn,$rec["group_name"]) >= 1){
              ?>
               <div align="center" style="padding-top:5px;">
                <a href="../group_sn/?ff=<?php  echo $rec[$PK_field]; ?>&gg=0&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>&inv=<?php echo $_GET['inv'];?>&pod=<?php echo $_GET['pod'];?>"><img src="../icons/favorites_stranby.png" width="15" height="15"> | </a>
                <a href="../group_sn/?ff=<?php  echo $rec[$PK_field]; ?>&gg=1&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>&inv=<?php echo $_GET['inv'];?>&pod=<?php echo $_GET['pod'];?>"><img src="../icons/favorites_close.png" width="15" height="15"> | </a> 
                <a href="../group_sn/?ff=<?php  echo $rec[$PK_field]; ?>&gg=2&page=<?php  echo $_GET['page']; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>&inv=<?php echo $_GET['inv'];?>&pod=<?php echo $_GET['pod'];?>"><img src="../icons/favorites_use.png" width="15" height="15"></a>
               </div>
              <?php
            }
            ?>
           
          </div>
          </TD>
          <!--<TD><span class="text"><?php  echo $rec["group_stock"] ; ?></span></TD>-->
          <!--<TD><span class="text"><?php  echo $rec["group_pro_pod"] ; ?></span></TD>-->
          <TD><center>
                <?php if ($rec["group_status"] === '1' || $rec["group_status"] == 1) {?>
                  <a href="../group_sn/?inv=<?php  echo $_GET['inv'];?>&b=<?php echo $rec[$PK_field]; ?>&s=<?php echo $rec["group_status"]; ?>&page=<?php echo $_GET['page']; ?>&<?php echo $FK_field; ?>=<?php echo $_REQUEST[$FK_field]; ?>&pod=<?php echo $_GET['pod'];?>"><img src="../icons/status_off.gif" width="10" height="10"></a>
                <?php } else {?>
                  <a href="../group_sn/?inv=<?php  echo $_GET['inv'];?>&b=<?php echo $rec[$PK_field]; ?>&s=<?php if(empty($rec["group_status"])){echo 0;}else{echo $rec["group_status"];} ?>&page=<?php echo $_GET['page']; ?>&<?php echo $FK_field; ?>=<?php echo $_REQUEST[$FK_field]; ?>&pod=<?php echo $_GET['pod'];?>"><img src="../icons/status_on.gif" width="10" height="10"></a>
                <?php }?>
          </center></TD>
          <TD><!-- Icons -->
            </TD>
          <TD style="white-space: nowrap;"><center><A title=Edit href="update.php?mode=update&inv=<?php  echo $_GET['inv'];?>&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field]; if($param <> "") {?>&<?php  echo $param; }?>&pod=<?php echo $_GET['pod'];?>"><IMG alt=Edit src="../images/pencil.png"></A> <A title=Delete  href="#"></A> <span style="font-size: 30px;padding-left: 5px;padding-right: 5px;">|</span> <A title="Delete"  href="#"><IMG alt=Delete src="../images/cross.png" onClick="confirmDelete('?action=delete&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field];?>&pod=<?php echo $_GET['pod'];?>&inv=<?php  echo $_GET['inv'];?>','Group  <?php  echo $rec[$PK_field];?> : <?php  echo $rec["group_name"];?>')"></A></center></TD>
        </TR>  
		<?php  } 
    // echo $numRemain;
    ?>
      </TBODY>
    </TABLE>
    <br><br>
    <DIV class="bulk-actions align-left">
<!--
            <SELECT name="choose_action" id="choose_action">
              <OPTION selected value="">กรุณาเลือก...</OPTION>
              <OPTION value="del">ลบ</OPTION>
            </SELECT>            
            <?php 
				$a_not_exists = array();
				post_param($a_param,$a_not_exists); 
			?>
            <input class=button name="Action2" type="submit" id="Action2" value="ตกลง">
-->
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

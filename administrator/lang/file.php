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
<P id=page-intro><?php  echo ucfirst ($page_name); ?> (<?php  echo $_GET['lang_key'];?>)</P>

<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="../lang/index.php?mid=<?php  echo $_GET['mid'];?>"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>Back</SPAN></A></LI>
</UL>
  
  <!-- End .shortcut-buttons-set -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right" style="padding-right:15px;">

<H3 align="left"><?php  echo ucfirst ($check_module); ?></H3>
<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
  <form name="form2" method="post" action="confirm.php" onSubmit="return check_select(this)">
    <TABLE>
      <THEAD>
        <TR>
          <TH width="4%">&nbsp;</TH>
          <TH width="10%" <?php  Show_Sort_bg ("user_id", $orderby) ?>> <?php 
		$a_not_exists = array('orderby','sortby');
		$param2 = get_param($a_param,$a_not_exists);
	?>
            <?php   Show_Sort_new ("user_id", "No.", $orderby, $sortby,$page,$param2);?>
            &nbsp;</TH>
          <TH width="78%" <?php  Show_Sort_bg ("name", $orderby) ?>><a>File Name</a></TH>
          <TH width="8%"><a>Edit</a></TH>
          </TR>
      </THEAD>
      <TFOOT>
        </TFOOT>
      <TBODY>
        <?php  
			$objScan = scandir("../../language/".$_GET['lang_key']);
$i=1;
		foreach ($objScan as $value) {
			if($i>2){
					//echo "<a href=\"test1.php?page=".$value."\">".$value."</a><br>";

				   ?>
        <TR>
          <TD>&nbsp;</TD>
          <TD><span class="text"><?php  echo $i-2 ; ?></span></TD>
          <TD><span class="text"><strong><?php  echo $value;?></strong></span></TD>
          <TD><!-- Icons -->
            <A title=Edit href="file_edit.php?<?php  echo $PK_field; ?>=<?php  echo $_GET["lang_id"]; if($param <> "") {?>&<?php  echo $param; }?>&lang_key=<?php  echo $_GET['lang_key'];?>&f=<?php  echo $value;?>"><IMG alt=Edit src="../images/pencil.png"></A> <A title=Delete  href="#"></A></TD>
          </TR>  
		<?php  	}
			$i++;}
		?>
      </TBODY>
    </TABLE>
    <br><br>
     <DIV class=pagination> <?php  include("../include/page_show.php");?> </DIV>
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

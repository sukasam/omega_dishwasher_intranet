<?php     
include ("../../include/config.php"); 
include ("../../include/connect.php"); 
include ("../../include/function.php"); 
include ("config.php");
	
	//$del = $_POST['del'];
	Check_Permission($conn,$check_module,$_SESSION["login_id"],"delete");
	$param = get_param($a_param,$a_not_exists);
	if (!isset ($_POST[del])) header ("location:index.php?$param"); 
	if ($_POST[Action] == "OK") { 
		if ($_POST[confirm] == "yes") { 
			$msg = explode(" ", $_POST[msg]);
			foreach ($msg as $key=>$value) { 
				$sql_su = "delete from $tbl_name where " . $PK_field . " = '$value'";
				@mysqli_query($conn,$sql_su);				
			} 
			header ("location:index.php?$param"); 	
		}
		else
		{
			header ("location:index.php?$param"); 	
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php     echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="../css/reset.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/style.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.3.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
<META name=GENERATOR content="MSHTML 8.00.7600.16535">
</HEAD>
<?php     include ("../../include/function_script.php"); ?>
<BODY>
<DIV id=body-wrapper>
<?php     include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php     include('../top.php');?>
<P id=page-intro>What would you like to do?</P>

<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>Back</SPAN></A></LI>
</UL>
  
  <!-- End .shortcut-buttons-set -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php     echo $page_name; ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
  <form name="form1" method="post" action="confirm.php">
    <p>ข้อมูลต่อไปนี้จะถูกลบออก: </p>
    <ul>
      <?php     
					$msg = "";
				  foreach ($_POST[del] as $key =>$value) { ?>
      <li> <?php     echo Show_data($tbl_name,$PK_field, $value, $field_confirm_showname) ; ?>
        <?php     $msg .= $value . " " ;
                     }
				  ?>
      </li>
    </ul>
    <?php     $msg = trim ($msg); ?>
    <input name="msg" type="hidden" id="msg" value="<?php     echo $msg; ?>">
    <p>
      <input name="confirm" type="checkbox" id="confirm" value="yes" >
     ยืนยันการลบ.
    </p>
    <input name="Action" type="submit" id="Action" value="OK" class=button>
    <input type="reset" name="Reset" value="Reset" class=button>
    <?php     
			post_param($a_param,$a_not_exists); 
			?>
  </form>
</DIV><!-- End #tab1 -->

<DIV id=tab2 class=tab-content>

<FORM method=post action="">
  <DIV class=clear></DIV><!-- End .clear -->
</FORM>
</DIV><!-- End #tab2 -->

</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php     include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
</BODY>
</HTML>

<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php  echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="../css/reset.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/style.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/invalid.css" media=screen>
<META name=GENERATOR content="MSHTML 8.00.7600.16535">
</HEAD>
<?php  include ("../../include/function_script.php"); ?>
<BODY>
<DIV id=body-wrapper>
<?php  include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php  include('../top.php');?>
<P id=page-intro><?php  if ($mode == "add") { ?>Enter new information<?php  } else { ?>Update  details	[<?php  echo $page_name;?>]<?php  } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="file.php?lang_id=<?php  echo $_GET['lang_id'];?>&page=<?php  echo $_GET['page'];?>&mid=<?php  echo $_GET['mid'];?>&lang_key=<?php  echo $_GET['lang_key'];?>"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>Back</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php  echo ucfirst ($page_name); ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
<?php 
$firstfile =  "../../language/".$_GET['lang_key']."/".$_GET['f'];
//echo $firstfile;   // the file is shown, and is there
$fn = $firstfile;

if (isset($_POST['content']))
{     
    $content = stripslashes($_POST['content']);
    $fp = fopen($fn,"w") or die ("Error opening file in write mode!");
    fputs($fp,$content);
     
    fclose($fp) or die ("Error closing file!");
}

?>
  <form action="<?php  echo $_SERVER['PHP_SELF'];?>?<?php  echo $_SERVER['QUERY_STRING'];?>" method="post"  name="form1" id="form1"  enctype="multipart/form-data"  onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tr>
            <td>
                <textarea rows="10" cols="100" name="content"><?php  readfile($fn); ?></textarea><br />
                <br><input type="submit" value="Save" class="button">  
            </td>
          </tr>
        </table>
      </fieldset>
    </div>
  </form>
</DIV>
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

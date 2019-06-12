<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	$mode=$_REQUEST['mode'];

	



	if ($_POST[mode] <> "") { 

		$param = "";

		$a_not_exists = array();

		$param = get_param($a_param,$a_not_exists);



		if ($_POST[mode] == "add") { 

				include "../include/m_add.php";

				$id=mysql_insert_id();

				$sql="update $tbl_name set rank ='$id' where $PK_field='$id' ";

				@mysql_query($sql);

			header ("location:index.php?" . $param); 

		}

		if ($_POST[mode] == "update" ) { 

			

			$_POST['menucate_id']=$_POST['menucate_id2'];

			include ("../include/m_update.php");

			header ("location:index.php?" . $param); 

		}

	}

	if ($_GET[mode] == "add") { 

		 Check_Permission ($check_module,$_SESSION[login_id],"add");

	}

	if ($_GET[mode] == "update") { 

		 Check_Permission ($check_module,$_SESSION[login_id],"update");

		$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";

		$query = @mysql_query ($sql);

		while ($rec = @mysql_fetch_array ($query)) { 

			$$PK_field = $rec[$PK_field];

			foreach ($fieldlist as $key => $value) { 

				$$value = $rec[$value];

			}

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

function check(frm){

		if (frm.submenu_name.value.length==0){

			alert ('Please enter menu name !!');

			frm.submenu_name.focus(); return false;

		}	

		if (frm.submenu_url_link.value.length==0){

			alert ('Please enter url link !!');

			frm.submenu_url_link.focus(); return false;

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

<P id=page-intro><?php  if ($mode == "add") { ?>Enter new information<?php  } else { ?>Update  details	[<?php  echo $page_name; ?>]<?php  } ?>	</P>

<UL class=shortcut-buttons-set>

  <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>Back</SPAN></A></LI>

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

  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  onSubmit="return check(this)">

    <div class="formArea">

      <fieldset>

      <legend><?php  echo ucfirst ($page_name); ?> </legend>

        <table width="100%" cellspacing="0" cellpadding="0" border="0">

          <tr>

            <td><table class="formFields" cellspacing="0" width="100%">

              <tr >

                <td nowrap class="name">Main menu</td>

                <td>

                <select name="<?php =$FR_field?>2" id="<?php =$FR_field?>2">

                <?php  

				$sqlcatemenu = "select * from tb_menu_cate";

				$querycatemenu = @mysql_query($sqlcatemenu)or die(mysql_error());

				while($rscatemenu = @mysql_fetch_array($querycatemenu)){?>

                <option value="<?php =$rscatemenu['menucate_id']?>" <?php  if($rscatemenu['menucate_id']==$_REQUEST['menucate_id']){echo "selected";}?>><?php =$rscatemenu['menucate_name']?></option>

                <?php  }?>

                </select>

                </td>

              </tr>

              <tr >

                <td nowrap class="name">Menu Name</td>

                <td><input name="submenu_name" type="text" id="submenu_name"  value="<?php  echo $submenu_name; ?>" size="60"></td>

              </tr>

               <tr >

                <td nowrap class="name">URL link</td>

                <td><input name="submenu_url_link" type="text" id="submenu_url_link"  value="<?php  echo $submenu_url_link; ?>" size="60"></td>

              </tr>

              

              <?php  if ($_GET[mode] == "add") { ?>

              <?php  } ?>

              <?php  if ($_GET[mode] == "update") { ?>

              <?php  } ?>

          </table></td>

          </tr>

        </table>

        </fieldset>

    </div><br>

    <div class="formArea">

      <input type="submit" name="Submit" value="Submit" class="button">

      <input type="reset" name="Submit" value="Reset" class="button">

      <?php  

			$a_not_exists = array();

			post_param($a_param,$a_not_exists); 

			?>

      <input name="mode" type="hidden" id="mode" value="<?php  echo $_REQUEST[mode];?>">

      <input name="<?php  echo $PK_field;?>" type="hidden" id="<?php  echo $PK_field;?>" value="<?php  echo $_GET[$PK_field];?>">

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

<?php  if($msg_user==1){?>

<script language=JavaScript>alert('Menu name ซ้ำ กรุณาเปลี่ยน Menu name ใหม่ !');</script>

<?php  }?>

</BODY>

</HTML>


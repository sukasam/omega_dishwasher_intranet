<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	if ($_POST['mode'] <> "") { 
		$param = "";
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);

		if ($_POST['mode'] == "add") { 
			
			include "../include/m_add.php";
			
			
			if ($_FILES['fimages']['name'] != "") { 
				$mname="";
				$mname=gen_random_num(5);
				$a_size = array('100');	
				$filename = "";
				foreach($a_size as $key => $value) {
					$path = "../../upload/lang/";
					$quality = 80;
					if($filename == "")
						$name_data=explode(".",$_FILES['fimages']['name']);
						$type=$name_data[1];
						$filename =$mname.".".$type;
						list($width, $height) = getimagesize($_FILES['fimages']['name']);
						//$sizes = $value;
						uploadfile($path,$filename,$_FILES['fimages']['tmp_name'],$width, $quality);
				} // end foreach				
					$sql = "update $tbl_name set lang_images = '$filename' where $PK_field = '$id' ";
					@mysqli_query($conn,$sql);				
				} // end if ($_FILES[fimages][name] != "")	
				
			header ("location:index.php?" . $param); 
			
		}
//-------------------------------------------------------------------------------------------------------------------------------------
		if ($_POST['mode'] == "update" ) { 	
			
			include "../include/m_update.php";
			$id=$_REQUEST['lang_id'];
			
			if ($_FILES['fimages']['name'] != "") { 
				$mname="";
				$mname=gen_random_num(5);
				$a_size = array('100');				
				$filename = "";
				foreach($a_size as $key => $value) {
					$path = "../../upload/lang/";
					@unlink($path.$_POST['lang_images']);
					$quality = 80;
					if($filename == "")
						$name_data=explode(".",$_FILES['fimages']['name']);
						$type=$name_data[1];
						$filename =$mname.".".$type;
						list($width, $height) = getimagesize($_FILES['fimages']['name']);
						uploadfile($path,$filename,$_FILES['fimages']['tmp_name'],$width, $quality);
				} // end foreach		
				$sql = "update $tbl_name set lang_images = '$filename' where $PK_field = '$id' ";
				@mysqli_query($conn,$sql);				
			} // end if ($_FILES[fimages][name] != "")
			
			header ("location:index.php?" . $param); 
			
	}
}
//-------------------------------------------------------------------------------------------------------------------------------------
	if ( ($_GET['mode'] == "add") && (count($_POST) == 0)) { 
		 Check_Permission($conn,$check_module,$_SESSION['login_id'],"add");
	}
//-------------------------------------------------------------------------------------------------------------------------------------
	if ( ($_GET['mode'] == "update") && (count($_POST) == 0) ) { 
		 Check_Permission($conn,$check_module,$_SESSION['login_id'],"update");
		$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";
		$query = @mysqli_query($conn,$sql);
		while ($rec = @mysqli_fetch_array($query)) { 
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
function check(frm){
		if (frm.name.value.length==0){
			alert ('กรุณาระบุ ชื่อ-สกุล');
			frm.name.focus(); return false;
		}
		if (frm.username.value.length==0){
			alert ('กรุณาระบุ username');
			frm.username.focus(); return false;
		}
		if (frm.password.value.length==0){
			alert ('กรุณาระบุ password');
			frm.password.focus(); return false;
		}
		if (frm.password.value.length<4){
			alert ('กรุณาระบุ password มากกว่า 4 ตัวอักษร');
			frm.password.focus(); return false;
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
  <form action="update.php" method="post"  name="form1" id="form1"  enctype="multipart/form-data"  onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
        <legend><?php  echo ucfirst ($page_name); ?></legend>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tr>
            <td><table class="formFields" cellspacing="0" width="100%">
              <tr >
                <td class="name">Lang Name <span class="required">*</span></td>
                <td><input name="lang_name" type="text" id="lang_name"  value="<?php  echo $lang_name; ?>" style="width:200px;"></td>
              </tr>
              <tr >
                <td class="name">Lang Key <span class="required">*</span></td>
                <td><input name="lang_key" type="text" id="lang_key"  value="<?php  echo $lang_key; ?>" style="width:200px;"></td>
              </tr>
              <tr >
                <td nowrap class="name">Lang Images</td>
                <td><input name="fimages" type="file" id="fimages">
                  <br>
                  <?php  
				  if($_GET['mode'] != 'add'){
					  if(!empty($lang_images)){?>
                  <img src="../../upload/lang/<?php  echo $lang_images?>" alt="" width="60">[ <a href="?mode=<?php  echo $_GET['mode']?>&<?php  echo $PK_field?>=<?php  echo $$PK_field;?>&<?php  echo $FR_field?>=<?php  echo $$FR_field;?>&del_id=<?php  echo $lang_images;?>&page=<?php  echo $page;?>">Delete</a>]
                  <?php  }?>
                  <input name="lang_images" type="hidden" value="<?php  echo $lang_images; ?>">
                  <?php  }?></td>
              </tr>
              <?php  if ($_REQUEST['mode'] == "add") { ?>
              <?php  } ?>
              <?php  if ($_REQUEST['mode'] == "update") { ?>
              <?php  } ?>
              <!--
              <tr >
                <td class="name">Super admin</td>
                <td><input name="admin_flag" type="checkbox" id="admin_flag" value="1" <?php  if($admin_flag == 1) echo "checked";?>></td>
              </tr>
              -->
              <tr >
                <td class="name">&nbsp;</td>
                <td><input type="submit" name="Submit" value="Submit" class=button>
                  <input type="reset" name="Submit" value="Reset" class=button>
                  <?php  
			$a_not_exists = array();
			post_param($a_param,$a_not_exists); 
			?>
                  <input name="mode" type="hidden" id="mode" value="<?php  echo $_REQUEST['mode'];?>">
                  <input name="<?php  echo $PK_field;?>" type="hidden" id="<?php  echo $PK_field;?>" value="<?php  echo $_REQUEST[$PK_field];?>"></td>
              </tr>
            </table></td>
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
<?php  if($msg_user==1){?>
<script language=JavaScript>alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');</script>
<?php  }?>
</BODY>
</HTML>

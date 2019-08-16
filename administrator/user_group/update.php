<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	$param = "";
	$a_not_exists = array();
	$param = get_param($a_param,$a_not_exists);
	if ($_POST['mode'] <> "") { 

		if ($_POST['mode'] == "update") { 
			$param = get_return_param();
		
			$sql = "delete from $tbl_name where user_id = '".$_POST['user_id']."' ";
			@mysqli_query($conn,$sql);
			$sql = "delete from s_user_p where user_id = '".$_POST['user_id']."' and module_id = '0' ";
			@mysqli_query($conn,$sql);
			
			if(count($_POST[group_id]) > 0){
				foreach($_POST[group_id] as $key => $value){
					$_POST[group_id] = $value;
					include "../include/m_add.php";
					//echo $sql;
					
						$sql = "insert into s_user_p (user_id,group_id) values ";
						$sql.= "('".$_POST['user_id']."','".$_POST['group_id']."')";
						@mysqli_query($conn,$sql);
				} // end foreach
			}// end if(count($_POST[group_id]) > 0)
			header ("location:../user/index.php?" . $param); 
		}
	}
	

	
	if ($_GET['mode'] == "update") { 
		 Check_Permission($conn,$check_module,$_SESSION['login_id'],"update");
		$sql = "select * from s_user where user_id = '".$_GET['user_id']."' ";
		$rec = @mysqli_fetch_array(@mysqli_query($conn,$sql));
		$user_name = $rec['username'];
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
		if (frm.group_name.value.length==0){
			alert ('Please enter group name !!');
			frm.group_name.focus(); return false;
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
<P id=page-intro><?php  if ($mode == "add") { ?>Enter new information<?php  } else { ?>แก้ไข	[<?php  echo $check_module; ?>]<?php  } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php  echo $check_module; ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <div class="formArea">
      <fieldset>
      <legend><?php  echo ucfirst ($page_name); ?> form </legend>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tr>
            <td><table class="formFields" cellspacing="0" width="100%">
              <tr >
                <td width="19%" valign="top" class="name">User : <?php  echo $user_name;?></td>
                <td width="81%"><select name="group_id[]" size="10" multiple>
                    <?php 
					  	unset($a_group_id);
					  	$sql = "select * from s_user_group where user_id = '".$_GET['user_id']."' ";
						$query = @mysqli_query($conn,$sql);
						while($rec = @mysqli_fetch_array($query)){
							$a_group_id[] = $rec[group_id]; 
						}
						
					  	$sql = "select * from s_group order by group_id";
						$query = @mysqli_query($conn,$sql);
						while($rec = @mysqli_fetch_array($query)){
					  ?>
                    <option value="<?php  echo $rec[group_id];?>" <?php  if( @in_array($rec[group_id],$a_group_id) ) echo "selected";?>><?php  echo $rec['group_name'];?></option>
                    <?php  } ?>
                  </select>
                </td>
              </tr>
          </table></td>
          </tr>
        </table>
        </fieldset>
    </div>
    <div class="formArea">
      <input type="submit" name="Submit" value="Submit" class="button">
      <input type="reset" name="Submit" value="Reset" class="button">
      <?php  
			$a_not_exists = array();
			post_param($a_param,$a_not_exists); 
			?>
      <input name="mode" type="hidden" id="mode" value="<?php  echo $_GET['mode'];?>">
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
<script language=JavaScript>alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');</script>
<?php  }?>
</BODY>
</HTML>

<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	if ($_POST['mode'] <> "") {  
		$param = "";
		if ($_POST[$FR_field] <> "") { $param .=  "&" . $FR_field . "=" . $_POST[$FR_field]; } 
		if ($_POST[page] <> "") { $param .=  "&" . page . "=" . $_POST[page]; } 
		if ($_POST['mode'] <> "") { $param .=  "&" . mode . "=" . $_POST['mode']; } 
		if ($_POST[user_id] <> "") { $param .=  "&" . user_id . "=" . $_POST[user_id]; } 
		$param = substr ($param,1);

		if ($_POST[option] == "Add") { 
			include "../include/m_add.php";
			header ("location:?" . $param); 
		}
		if ($_POST[option] == "Edit" ) { 
			include ("../include/m_update.php");
			header ("location:?" . $param); 
		}
	}
	
	if($_GET['action'] == "delete"){
		$sql = "delete from $tbl_name where $PK_field = '$_GET[$PK_field]'";
		@mysqli_query($conn,$sql);
	}
	
	if ($_GET['mode'] == "add") { 
		 Check_Permission($conn,$check_module,$_SESSION['login_id'],"add");
	}
	if ($_GET['mode'] == "update") { 
		// Check_Permission($conn,$check_module,$_SESSION['login_id'],"update");
		 $_SESSION[s_user_id] = $_GET[user_id];
		/*$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";
		$query = @mysqli_query($conn,$sql);
		while ($rec = @mysqli_fetch_array($query)) { 
			$$PK_field = $rec[$PK_field];
			foreach ($fieldlist as $key => $value) { 
				$$value = $rec[$value];
			}
		}*/
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

<H3 align="left"><?php  echo ucfirst ($check_module); ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  >
    <div class="formArea">
      <fieldset>
      <legend><?php  echo ucfirst ($page_name); ?> form </legend>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tr>
          <td height="54"><table width="100%" border="0" cellspacing="0" class="formFields">
              <tr >
                <td class="name" style="color:#0C0">
   
                    User &gt;
                    <?php  
							$sql = "select * from s_user where user_id = '$_GET[user_id]' ";
							$rec = @mysqli_fetch_array(@mysqli_query($conn,$sql));
							echo $rec[username];
						?>
                        
                </td>
                <td colspan="6">&nbsp;</td>
              </tr>
              <tr>
                <td height="26" class="text">Module</td>
                <td class="text"><div align="center">Read</div></td>
                <td class="text"><div align="center">Add</div></td>
                <td class="text"><div align="center">Update</div></td>
                <td class="text"><div align="center">Delete</div></td>
                <td><div align="center"></div></td>
                <td><div align="center"></div></td>
              </tr>
              <?php 
	$counter = 0;
	$sql = "select * from s_user_p,s_module where user_id = '$_SESSION[s_user_id]' and s_module.module_id = s_user_p.module_id  order by $PK_field desc ";
		$query = @mysqli_query($conn,$sql);
		while($rec = @mysqli_fetch_array($query)){
?>
              <tr <?php  if ($counter++%2) { ?>class="oddrowbg" <?php  } else { ?> class="evenrowbg"<?php  } ?>>
                <td height="26" ><?php  echo $rec[module_name]; ?></td>
                <td><div align="center">
                    <input type="checkbox" name="checkbox" value="checkbox" <?php  if($rec[read_p] == 1) echo "checked"; ?>>
                </div></td>
                <td><div align="center">
                    <input type="checkbox" name="checkbox2" value="checkbox" <?php  if($rec[add_p] == 1) echo "checked"; ?>>
                </div></td>
                <td><div align="center">
                    <input type="checkbox" name="checkbox3" value="checkbox" <?php  if($rec[update_p] == 1) echo "checked"; ?>>
                </div></td>
                <td><div align="center">
                    <input type="checkbox" name="checkbox4" value="checkbox" <?php  if($rec[delete_p] == 1) echo "checked"; ?>>
                </div></td>
                <td><div align="center"><a href="?action=Edit&user_id=<?php  echo $_GET[user_id];?>&mode=<?php  echo $_GET['mode']?>&<?php  echo "$PK_field=".$rec[$PK_field];?>">Edit</a></div></td>
                <td><div align="center"><a href="javascript:confirmDelete('update.php?action=delete&user_id=<?php  echo $_GET[user_id];?>&mode=<?php  echo $_GET['mode']?>&<?php  echo "$PK_field=".$rec[$PK_field];?>','Module <?php  echo $rec[module_name];?>')">Delete</a></div></td>
              </tr>
              <?php 
			} // end while
?>
              <tr >
                <td height="26" class="name"><?php 
					  	if($_GET['action'] == "Edit"){
							$sql = "select * from s_user_p  where $PK_field = '$_GET[$PK_field]' ";
							$query = @mysqli_query($conn,$sql);
							$rec = @mysqli_fetch_array($query);
							$module_id = $rec[module_id];
							$read_p = $rec[read_p];
							$add_p = $rec[add_p];
							$update_p = $rec[update_p];
							$delete_p = $rec[delete_p];
						}
					  ?>
                    <select name="module_id">
                      <option>Select One</option>
                      <?php 
								$sql = "select * from s_module order by module_id desc";
								$query = @mysqli_query($conn,$sql);
								while($rec = @mysqli_fetch_array($query)){
							?>
                      <option value="<?php  echo $rec[module_id];?>" <?php  if($module_id == $rec[module_id]) echo "selected";?>><?php  echo $rec[module_name];?></option>
                      <?php  } ?>
                    </select>
                </td>
                <td><div align="center">
                    <input name="read_p" type="checkbox" id="read_p" value="1" <?php  if($read_p == "1") echo "checked"; ?>>
                </div></td>
                <td><div align="center">
                    <input name="add_p" type="checkbox" id="add_p" value="1" <?php  if($add_p == "1") echo "checked"; ?>>
                </div></td>
                <td><div align="center">
                    <input name="update_p" type="checkbox" id="update_p" value="1" <?php  if($update_p == "1") echo "checked"; ?>>
                </div></td>
                <td><div align="center">
                    <input name="delete_p" type="checkbox" id="delete_p" value="1" <?php  if($delete_p == "1") echo "checked"; ?>>
                </div></td>
                <td colspan="2"><?php 
							if($_GET['action'] <> "Edit") $option_value = "Add";
							else $option_value = "Edit";
						?>
                    <div align="left">
                      <input name="option" type="submit" id="option" value="<?php  echo $option_value;?>" class="button">
                  </div></td>
              </tr>
          </table></td>
          </tr>
        </table>
        </fieldset>
    </div>
    <div class="formArea">
      <?php  foreach ($_GET as $key => $value) { ?>
<input name="<?php  echo $key;?>" type="hidden" id="<?php  echo $key;?>" value="<?php  echo $value;?>">
      <?php  } ?>
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

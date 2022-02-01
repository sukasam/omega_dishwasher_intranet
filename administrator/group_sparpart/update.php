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
			header ("location:index.php?" . $param); 
		}
		if ($_POST['mode'] == "update" ) { 
			include ("../include/m_update.php");
			header ("location:index.php?" . $param); 
		}
	}
	if ($_GET['mode'] == "add") { 
		 Check_Permission($conn,$check_module,$_SESSION['login_id'],"add");
	}
	if ($_GET['mode'] == "update") { 
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

  if (frm.group_spar_id.value.length==0){
			alert ('กรุณากรอกรหัสอะไหล่ !!');
			frm.group_spar_id.focus(); return false;
		}		

		if (frm.group_name.value.length==0){
			alert ('กรุณากรอก ชื่ออะไหล่ !!');
			frm.group_name.focus(); return false;
		}	

}	

function submitForm() {
		document.getElementById("submitF").disabled = true;
		document.getElementById("resetF").disabled = true;
		document.form1.submit()
	}

  function setCatV1(){
    var catv1 = document.getElementById("catv1").value;
    $.ajax({
        type: "GET",
        url: "callAPI.php?action=getcatv1&catv1="+catv1,
        //async: false,
        success: function(result) {
          var obj = result.split("|")
          //console.log(obj[1]);
          document.getElementById("catv2").innerHTML = obj[1];
          document.getElementById("catv3").innerHTML = '<option value="0">กรุณาเลือก</option>';
          document.getElementById("catv4").innerHTML = '<option value="0">กรุณาเลือก</option>';
        }
    });
  }
  function setCatV2(){
    var catv1 = document.getElementById("catv1").value;
    var catv2 = document.getElementById("catv2").value;
    $.ajax({
        type: "GET",
        url: "callAPI.php?action=getcatv2&catv1="+catv1+"&catv2="+catv2,
        //async: false,
        success: function(result) {
          var obj = result.split("|")
          //console.log(obj[1]);
          document.getElementById("catv3").innerHTML = obj[1];
          document.getElementById("catv4").innerHTML = '<option value="0">กรุณาเลือก</option>';
        }
    });
  }
  function setCatV3(){
    var catv1 = document.getElementById("catv1").value;
    var catv2 = document.getElementById("catv2").value;
    var catv3 = document.getElementById("catv3").value;
    $.ajax({
        type: "GET",
        url: "callAPI.php?action=getcatv3&catv1="+catv1+"&catv2="+catv2+"&catv3="+catv3,
        //async: false,
        success: function(result) {
          var obj = result.split("|")
          //console.log(obj[1]);
          document.getElementById("catv4").innerHTML = obj[1];
        }
    });
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
<P id=page-intro><?php  if ($mode == "add") { ?>Enter new information<?php  } else { ?>แก้ไข	[<?php  echo $page_name; ?>]<?php  } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php  echo $page_name; ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
      <legend><?php  echo $page_name; ?> </legend>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tr>
            <td><table class="formFields" cellspacing="0" width="100%">
            <tr>
                <td nowrap class="name">ประเภทของอะไหล่</td>
				        <td>
                <select name="catv1" id="catv1" class="inputselect" onchange="setCatV1()" style="width: 200px;">
										<option value="0">กรุณาเลือก</option>
                  <?php
                  $qucatv1 = @mysqli_query($conn, "SELECT * FROM s_group_catspare ORDER BY group_name ASC");
                  while ($row_catv1 = @mysqli_fetch_array($qucatv1)) {
                  ?>
                      <option value="<?php echo $row_catv1['group_id']; ?>" <?php if ($catv1 == $row_catv1['group_id']) {
                                                    echo 'selected';
                                                  } ?>><?php echo $row_catv1['group_name']; ?></option>
                  <?php
                    }
                  ?>
                </select>
                </td>
              </tr>
              <tr>
                <td nowrap class="name">ชนิดของอะไหล่</td>
				        <td>
                <select name="catv2" id="catv2" class="inputselect" onchange="setCatV2()" style="width: 200px;">
										<option value="0">กรุณาเลือก</option>
                  <?php
                  if($catv1 != "" && $catv1 != '0'){
                    
                    $condi2 = ' AND group_cat_id ='.$catv1;
                    $qucatv2 = @mysqli_query($conn, "SELECT * FROM s_group_catspare2 WHERE 1 ".$condi2." ORDER BY group_name ASC");
                    while ($row_catv2 = @mysqli_fetch_array($qucatv2)) {
                    ?>
                        <option value="<?php echo $row_catv2['group_id']; ?>" <?php if ($catv2 == $row_catv2['group_id']) {
                                                      echo 'selected';
                                                    } ?>><?php echo $row_catv2['group_name']; ?></option>
                    <?php
                   }
                  }
                  ?>
                </select>
                </td>
              </tr>
              <tr>
                <td nowrap class="name">Model</td>
				        <td>
                <select name="catv3" id="catv3" class="inputselect" onchange="setCatV3()" style="width: 200px;">
										<option value="0">กรุณาเลือก</option>
                  <?php
                  if($catv2 != "" && $catv2 != '0'){
                    $condi3 = ' AND group_cat2_id ='.$catv2;
                  $qucatv3 = @mysqli_query($conn, "SELECT * FROM s_group_catspare3 WHERE 1 ".$condi3." ORDER BY group_name ASC");
                  while ($row_catv3 = @mysqli_fetch_array($qucatv3)) {
                  ?>
                      <option value="<?php echo $row_catv3['group_id']; ?>" <?php if ($catv3 == $row_catv3['group_id']) {
                                                    echo 'selected';
                                                  } ?>><?php echo $row_catv3['group_name']; ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
                </td>
              </tr>
              <tr>
                <td nowrap class="name">อื่นๆ</td>
				        <td>
                <select name="catv4" id="catv4" class="inputselect" style="width: 200px;">
										<option value="0">กรุณาเลือก</option>
                  <?php
                  if($catv3 != "" && $catv3 != '0'){
                    $condi4 = ' AND group_cat3_id ='.$catv3;
                  $qucatv4 = @mysqli_query($conn, "SELECT * FROM s_group_catspare4 WHERE 1 ".$condi4." ORDER BY group_name ASC");
                  while ($row_catv4 = @mysqli_fetch_array($qucatv4)) {
                  ?>
                      <option value="<?php echo $row_catv4['group_id']; ?>" <?php if ($catv4 == $row_catv4['group_id']) {
                                                    echo 'selected';
                                                  } ?>><?php echo $row_catv4['group_name']; ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
                </td>
              </tr>
              <tr >
                <td nowrap class="name">รหัสต่างประเทศ</td>
				  <td><span id="chkDupID" class="hide" style="color: red;">รหัสอะไหล่ซ้ำ<br></span><input name="group_spar_id" type="text" id="group_spar_id"  value="<?php     echo $group_spar_id; ?>" size="60"> <span class="editIDPro hide"><input type="checkbox" name="edit_spar_id" id="edit_spar_id" value="1" disabled> แก้ไขรหัสอะไหล่</span>
                <input name="group_spar_id2" type="hidden" id="group_spar_id2"  value="" size="60">
                </td>
              </tr>
              <tr >
                <td nowrap class="name">รหัสภายใน</td>
                <td><input name="group_spar_account_id" type="text" id="group_spar_account_id"  value="<?php echo $group_spar_account_id; ?>" size="60"></td>
              </tr>
              <tr >
                <td nowrap class="name">รหัส Barcode</td>
                <td><input name="group_spar_barcode" type="text" id="group_spar_barcode"  value="<?php echo $group_spar_barcode; ?>" size="60"></td>
              </tr>
              <tr >
                <td nowrap class="name">ชื่ออะไหล่</td>
                <td><input name="group_name" type="text" id="group_name"  value="<?php     echo $group_name; ?>" size="60"></td>
              </tr>
              <tr>
                <td nowrap class="name">หน่วย</td>
                <td><input name="group_namecall" type="text" id="group_namecall"  value="<?php     echo $group_namecall; ?>" size="60"></td>
              </tr>
              
              <tr>
                <td nowrap class="name">ราคาต้นทุนสินค้า</td>
                <td><input name="group_unit_price" type="text" id="group_unit_price"  value="<?php     echo number_format($group_unit_price); ?>" size="60"></td>
              </tr>
              <!--<tr >
                <td nowrap class="name">จำนวน</td>
                <td><input name="group_stock" type="text" id="group_stock"  value="<?php  echo $group_stock; ?>" size="60"></td>
              </tr>-->
             <!-- <tr >
                <td nowrap class="name">รุ่น</td>
                <td><input name="group_pro_pod" type="text" id="group_pro_pod"  value="<?php  echo $group_pro_pod; ?>" size="60"></td>
              </tr>
              <tr >
                <td nowrap class="name">S/N</td>
                <td><input name="group_pro_sn" type="text" id="group_pro_sn"  value="<?php  echo $group_pro_sn; ?>" size="60"></td>
              </tr>-->
              
          </table></td>
          </tr>
        </table>
        </fieldset>
    </div><br>
    <div class="formArea">
    <input type="button" value="Submit" id="submitF" class="button" onclick="submitForm()">
      <input type="reset" name="Reset" id="resetF" value="Reset" class="button">
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

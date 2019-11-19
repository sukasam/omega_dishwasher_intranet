<?php    
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	if ($_POST["mode"] <> "") { 
		$param = "";
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);
		
		if($_POST['group_spar_id'] == ""){
			$_POST['group_spar_id'] = $_POST['group_spar_id2'];
		}
		
		$_POST['group_unit_price'] = preg_replace("/,/","",$_POST['group_unit_price']);
		$_POST['group_price'] = preg_replace("/,/","",$_POST['group_price']);

		$_POST['group_name'] = addslashes($_POST['group_name']);
		$_POST['group_location'] = addslashes($_POST['group_location']);
		
		if ($_POST["mode"] == "add") { 
			include "../include/m_add.php";
			header ("location:index.php?" . $param); 
		}
		if ($_POST["mode"] == "update" ) { 
			include ("../include/m_update.php");
			header ("location:index.php?" . $param); 
		}
	}
	if ($_GET["mode"] == "add") { 
		 Check_Permission($conn,$check_module,$_SESSION["login_id"],"add");
	}
	if ($_GET["mode"] == "update") { 
		 Check_Permission($conn,$check_module,$_SESSION["login_id"],"update");
		$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";
		$query = @mysqli_query($conn,$sql);
		while ($rec = @mysqli_fetch_array ($query)) { 
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
<TITLE><?php     echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="../css/reset.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/style.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.9.1.min.js"></SCRIPT>
<!--
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
-->
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
	
$( document ).ready(function() {
	
	$( "#group_spar_id" ).blur(function() {
		
		var group_spar_id = $("#group_spar_id").val();
		var group_spar_id2 = $("#group_spar_id2").val();
		
		if(group_spar_id){
			
			if(!$('#edit_spar_id').is(':checked')){
				
				$("#group_spar_id")[0].disabled = true;
				$("#group_name")[0].disabled = true;
				$("#group_namecall")[0].disabled = true;


				$.ajax({
					type: "GET",
					url: "call_return.php?action=chkProID&group_spar_id="+group_spar_id,
					success: function(data){
						//console.log(data);
						var obj = JSON.parse(data);

						if(obj.status === 'yes'){
							$("#group_id").val(obj.group_id);
							$("#group_name").val(obj.group_name);
							$("#group_location").val(obj.group_location);
							$("#group_namecall").val(obj.group_namecall);
							$("#group_type").val(obj.group_type);
							$("#group_unit_price").val(obj.group_unit_price);
							$("#group_price").val(obj.group_price);
							//$("#typespar").val(obj.typespar);
							
							if(obj.typespar == 2){
								$("#typespar2").attr('checked', true);
							}else{
								$("#typespar1").attr('checked', true);
							}
							$("#mode").val('update');
							$("#group_spar_id2").val(obj.group_spar_id);
							$(".editIDPro").removeClass('hide');
						}else{
							$("#mode").val('add');
							$("#group_name").val('');
							$("#group_location").val('');
							$("#group_namecall").val('');
							$("#group_spar_id2").val(group_spar_id);
							$(".editIDPro").addClass('hide');
						}

						$("#group_spar_id")[0].disabled = true;
						$("#group_name")[0].disabled = false;
						$("#group_namecall")[0].disabled = false;
						$("#edit_spar_id")[0].disabled = false;
						//$("#group_name").focus();
					}
				});
			}else{
				//console.log(group_spar_id);
				//console.log(group_spar_id2);
				if(group_spar_id != group_spar_id2 ){
					$.ajax({
						type: "GET",
						url: "call_return.php?action=chkProID&group_spar_id="+group_spar_id,
						success: function(data){
							//console.log(data);
							var obj = JSON.parse(data);

							if(obj.status === 'yes'){
								$("#chkDupID").removeClass('hide');
								$("#chksubmit").val(1);
							}else{
								$("#chkDupID").addClass('hide');
								$("#chksubmit").val(0);
							}
						}
					});
				}else{
					$("#chkDupID").addClass('hide');
					$("#chksubmit").val(0);
				}
			}
		}
	});
	
	$( "#group_name" ).blur(function() {
		var group_spar_id = $("#group_spar_id").val();
		var group_name = $("#group_name").val();
		if(group_spar_id == ""){
			if(group_name){
				$.ajax({
						type: "GET",
						url: "call_return.php?action=chkProName&group_name="+group_name,
						success: function(data){
							//console.log(data);
							var obj = JSON.parse(data);

							if(obj.status === 'yes'){
								$("#group_id").val(obj.group_id);
								$("#group_name").val(obj.group_name);
								$("#group_location").val(obj.group_location);
								$("#group_namecall").val(obj.group_namecall);
								$("#group_type").val(obj.group_type);
								$("#group_unit_price").val(obj.group_unit_price);
								$("#group_price").val(obj.group_price);
								//$("#typespar").val(obj.typespar);
								
								if(obj.typespar == 2){
									$("#typespar2").attr('checked', true);
								}else{
									$("#typespar1").attr('checked', true);
								}
								$("#mode").val('update');
								$("#group_spar_id2").val(obj.group_spar_id);
								$(".editIDPro").removeClass('hide');
							}else{
								$("#mode").val('add');
								$("#group_name").val('');
								$("#group_location").val('');
								$("#group_namecall").val('');
								$("#group_spar_id2").val(group_spar_id);
								$(".editIDPro").addClass('hide');
							}

							$("#group_spar_id")[0].disabled = true;
							$("#group_name")[0].disabled = false;
							$("#group_namecall")[0].disabled = false;
							$("#edit_spar_id")[0].disabled = false;
							//$("#group_name").focus();
						}
					});
			}
		}
		
	});
	
	
	$( "#edit_spar_id" ).change(function() {
	  //$( "#log" ).html( $( "input:checked" ).val() + " is checked!" );
		//console.log();
		var chkBox = $('#edit_spar_id').is(':checked');
		if(chkBox){
			$("#group_spar_id")[0].disabled = false;
		}else{
			$("#group_spar_id")[0].disabled = true;
		}
	});
});
	
function submitForm(){
	if($("#chksubmit").val() == 0){
		//console.log('M0');
		$("#form1").submit();
	}else{
		//console.log('M1');
	}
}
	
</script>
</HEAD>
<?php     include ("../../include/function_script.php"); ?>
<BODY>
<DIV id=body-wrapper>
<?php     include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php     include('../top.php');?>
<P id=page-intro><?php     if ($mode == "add") { ?>Enter new information<?php     } else { ?>แก้ไข	[<?php     echo $page_name; ?>]<?php     } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="index.php"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php     echo $check_module; ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
      <legend><?php     echo $page_name; ?> </legend>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tr>
            <td><table class="formFields" cellspacing="0" width="100%">
              <tr >
                <td nowrap class="name">รหัสอะไหล่</td>
				  <td><span id="chkDupID" class="hide" style="color: red;">รหัสอะไหล่ซ้ำ<br></span><input name="group_spar_id" type="text" id="group_spar_id"  value="<?php     echo $group_spar_id; ?>" size="60"> <span class="editIDPro hide"><input type="checkbox" name="edit_spar_id" id="edit_spar_id" value="1" disabled> แก้ไขรหัสอะไหล่</span>
                <input name="group_spar_id2" type="hidden" id="group_spar_id2"  value="" size="60">
                </td>
              </tr>
              <tr >
                <td nowrap class="name">ชื่ออะไหล่</td>
                <td><input name="group_name" type="text" id="group_name"  value="<?php     echo $group_name; ?>" size="60"></td>
              </tr>
              <tr >
                <td nowrap class="name">สถานที่จัดเก็บ</td>
                <td><input name="group_location" type="text" id="group_location"  value="<?php     echo $group_location; ?>" size="60"></td>
              </tr>
<!--
              <tr >
                <td nowrap class="name">จำนวน</td>
                <td><input name="group_stock" type="text" id="group_stock"  value="<?php     echo $group_stock; ?>" size="60"></td>
              </tr>
              <tr >
                <td nowrap class="name">ราคา/หน่วย</td>
                <td><input name="group_price" type="text" id="group_price"  value="<?php     echo $group_price; ?>" size="60"></td>
              </tr>
-->
              <tr>
                <td nowrap class="name">ชนิดสินค้า</td>
                <td><input name="group_type" type="text" id="group_type"  value="<?php     echo $group_type; ?>" size="60"></td>
              </tr>
              <tr>
                <td nowrap class="name">นาม</td>
                <td><input name="group_namecall" type="text" id="group_namecall"  value="<?php     echo $group_namecall; ?>" size="60"></td>
              </tr>
              
              <tr>
                <td nowrap class="name">ราคาต้นทุนสินค้า</td>
                <td><input name="group_unit_price" type="text" id="group_unit_price"  value="<?php     echo number_format($group_unit_price); ?>" size="60"></td>
              </tr>
              
              <tr>
                <td nowrap class="name">ราคาขาย</td>
                <td><input name="group_price" type="text" id="group_price"  value="<?php     echo  number_format($group_price); ?>" size="60"></td>
              </tr>
              
              <tr style="display: none;">
                <td nowrap class="name">ประเภทอะไหล่</td>
                <td><input type="radio" name="typespar" value="1" id="typespar1">อะไหล่สินค้า&nbsp;&nbsp;&nbsp;<input type="radio" name="typespar" value="2" id="typespar2">สินค้าอื่นๆ</td>
              </tr>
              
<!--
              <tr>
              	<td></td><td></td>
              </tr>
-->
              
              <?php     if ($_GET["mode"] == "add") { ?>
              <?php     } ?>
              <?php     if ($_GET["mode"] == "update") { ?>
              <?php     } ?>
          </table></td>
          </tr>
        </table>
        </fieldset>
    </div><br>
    <div class="formArea">
     
      <input type="button" name="button" value="Submit" class="button" onClick="submitForm();">
      <input type="button" value="Reset" class="button" onClick="window.location.reload();">
      <?php     
			$a_not_exists = array();
			post_param($a_param,$a_not_exists); 
			?>
      <input name="mode" type="hidden" id="mode" value="">
      <input name="group_id" type="hidden" id="group_id" value="">
      <input name="chksubmit" type="hidden" id="chksubmit" value="0">
    </div>
  </form>
</DIV>
</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php     include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
<?php     if($msg_user==1){?>
<script language=JavaScript>alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');</script>
<?php     }?>
</BODY>
</HTML>

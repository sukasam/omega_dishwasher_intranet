<?php
	include_once ("../../include/config.php");
	include_once ("../../include/connect.php");
	include_once ("../../include/function.php");
	include_once ("config.php");
  
  $vowels = array(",");

	if ($_POST['mode'] <> "") {
		$param = "";
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);

		$date_forder = $_POST['date_forder'];
		$a_sdate=explode("/",$_POST['date_forder']);
		$date_forder = $a_sdate[0]."-".$a_sdate[1]."-".($a_sdate[2]+543);
		$_POST['date_forder']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$_POST['remark'] = nl2br($_POST['remark']);

		//$_POST["cprice1"] = str_replace($vowels,"",$_POST["cprice1"]);
		

    // $pro_id[] = $rowOrderList['pro_id'];
    // $pro_code[] = $rowOrderList['pro_code'];
    // $pro_amount[] = $rowOrderList['pro_amount'];
    // $pro_price[] = $rowOrderList['pro_price'];

   // var_dump($_POST['pro_id']);
        

		if ($_POST['mode'] == "add") {

				$_POST['st_setting'] = 0;
			
				$_POST['loc_name'] = addslashes($_POST['loc_name']);

				include_once "../include/m_add.php";
        $id = mysqli_insert_id($conn);
        
        foreach($_POST['chkCode'] as $a => $b){
				
          if($_POST['chkAmount'][$a] != "" && $_POST['chkPrice'][$a] != ""){

            $_POST['chkPrice'][$a] = str_replace($vowels,"",$_POST['chkPrice'][$a]);

            @mysqli_query($conn,"INSERT INTO `s_order_solution_pro` (`id`, `order_id`, `pro_id`, `pro_code`, `pro_amount`, `pro_price`) VALUES (NULL, '".$id."', '".$_POST['chkCode'][$a]."', '".$_POST['chkSproid'][$a]."', '".$_POST['chkAmount'][$a]."', '".$_POST['chkPrice'][$a]."');");
          }
          //echo $a ." ". $b." ".$_POST['chkOrder'][$a]." ".$_POST['chkAmount'][$a]." ".$_POST['chkPrice'][$a]."<br>";
        }	

				//require_once("genpdf.php");

				include_once("../mpdf54/mpdf.php");
				include_once("form_orders.php");
				$mpdf=new mPDF('UTF-8');
				$mpdf->SetAutoFont();
				$mpdf->WriteHTML($form);
				$chaf = str_replace("/","-",$_POST['fs_id']);
				$mpdf->Output('../../upload/order_solution/'.$chaf.'.pdf','F');

       // header("Location:update.php?mode=update&order_id=".$id);
			  header ("location:index.php?" . $param);
    }
    
		if ($_POST['mode'] == "update" ) {
				
        $_POST['loc_name'] = addslashes($_POST['loc_name']);
        
        @mysqli_query($conn,"DELETE FROM `s_order_solution_pro` WHERE `order_id` = '".$_REQUEST[$PK_field]."'");
				
				include_once ("../include/m_update.php");
        $id = $_REQUEST[$PK_field];

        
        foreach($_POST['chkCode'] as $a => $b){
				
          if($_POST['chkAmount'][$a] != "" && $_POST['chkPrice'][$a] != ""){
            $_POST['chkPrice'][$a] = str_replace($vowels,"",$_POST['chkPrice'][$a]);
            @mysqli_query($conn,"INSERT INTO `s_order_solution_pro` (`id`, `order_id`, `pro_id`, `pro_code`, `pro_amount`, `pro_price`) VALUES (NULL, '".$id."', '".$_POST['chkCode'][$a]."', '".$_POST['chkSproid'][$a]."', '".$_POST['chkAmount'][$a]."', '".$_POST['chkPrice'][$a]."');");
          }
          //echo $a ." ". $b." ".$_POST['chkOrder'][$a]." ".$_POST['chkAmount'][$a]." ".$_POST['chkPrice'][$a]."<br>";
        }	

			 // exit();
				//require_once("genpdf.php");
			
				include_once("../mpdf54/mpdf.php");
				include_once("form_orders.php");
				$mpdf=new mPDF('UTF-8');
				$mpdf->SetAutoFont();
				$mpdf->WriteHTML($form);
				$chaf = str_replace("/","-",$_POST['fs_id']);
				$mpdf->Output('../../upload/order_solution/'.$chaf.'.pdf','F');

        //header("Location:update.php?mode=update&order_id=".$id);
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
		
		$a_sdate=explode("-",$date_forder);
		$date_forder=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

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
<SCRIPT type=text/javascript src="../js/popup.js"></SCRIPT>
<SCRIPT type=text/javascript src="ajax.js"></SCRIPT>

<script language="JavaScript" src="../Carlender/calendar_us.js"></script>
<link rel="stylesheet" href="../Carlender/calendar.css">

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

function chksign(vals){
	//alert(vals);
}

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}

function submitForm() {
		document.getElementById("submitF").disabled = true;
		document.getElementById("resetF").disabled = true;
		document.form1.submit()
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
  <LI><A class=shortcut-button href="../order_solution/"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
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
  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
      <legend><?php  echo $page_name; ?> </legend>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td style="padding-bottom:5px;"><img src="../images/form/header-order_solution.jpg" width="100%" /></td>
  </tr>
</table>
  
  <table width="100%" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> <input type="text" name="cd_name" value="<?php  echo $cd_name;?>" id="cd_name" class="inpfoder" style="width:70%;border: 0px;">
            <span id="rsnameid"><input type="hidden" name="cus_id" value="<?php  echo $cus_id;?>"></span><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_c.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
            </td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>เลขที่ใบสั่งน้ำยา:</strong> 
            <input type="text" name="fs_id" value="<?php  if($fs_id == ""){echo check_ordersolution($conn);}else{echo $fs_id;};?>" id="fs_id" class="inpfoder" style="border: 0px;"> 
            </td>

          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong> <input type="text" name="cd_address" value="<?php  echo $cd_address;?>" id="cd_address" class="inpfoder" style="width:80%;border: 0px;"></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong> วันที่สั่งซื้อ :</strong> <input type="text" name="date_forder" readonly value="<?php  if($date_forder==""){echo date("d/m/Y");}else{ echo $date_forder;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_forder'});</script>
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>จังหวัด :</strong>
            <select name="cd_province" id="cd_province" class="inputselect" style="border: 0px;">
                <?php
                	$quprovince = @mysqli_query($conn,"SELECT * FROM s_province ORDER BY province_id ASC");
					while($row_province = @mysqli_fetch_array($quprovince)){
					  ?>
					  	<option value="<?php  echo $row_province['province_id'];?>" <?php  if($cd_province == $row_province['province_id']){echo 'selected';}?>><?php  echo $row_province['province_name'];?></option>
					  <?php
					}
				?>
            </select>
           	</td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>ประเภทลูกค้า :</strong> <input type="radio" name="type_service" value="1" <?php if($type_service == '1' || $type_service == '0' || $type_service == ''){echo 'checked';}?>> ลูกค้าน้ำยา
				&nbsp;&nbsp;<input type="radio" name="type_service" value="2" <?php if($type_service == '2'){echo 'checked';}?>> เช่ารวมน้ำยา
				&nbsp;&nbsp;<input type="radio" name="type_service" value="3" <?php if($type_service == '3'){echo 'checked';}?>> เช่าแยกน้ำยา
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>โทรศัพท์ :</strong> <input type="text" name="cd_tel" value="<?php  echo $cd_tel;?>" id="cd_tel" class="inpfoder" style="border: 0px;">
              <strong>แฟกซ์ :</strong>
              <input type="text" name="cd_fax" value="<?php  echo $cd_fax;?>" id="cd_fax" class="inpfoder" style="border: 0px;"></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>ชื่อผู้ติดต่อ :</strong>
              <input type="text" name="c_contact" value="<?php  echo $c_contact;?>" id="c_contact" class="inpfoder" style="border: 0px;">
              <strong>เบอร์โทร :</strong>
              <input type="text" name="c_tel" value="<?php  echo $c_tel;?>" id="c_tel" class="inpfoder" style="border: 0px;">
            </td>
          </tr>
</table>

  <br>
<table width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;">
    <tr>
      <td width="5%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>เลือก</strong></td>
      <td width="5%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รหัส</strong></td>
      <td width="40%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา/หน่วย</strong></td>
    </tr>
    <?php

     $quOrderList = @mysqli_query($conn,"SELECT * FROM s_order_solution_pro WHERE order_id = '".$order_id."' ORDER BY id ASC");
     while($rowOrderList = @mysqli_fetch_array($quOrderList)){
       $pro_id[] = $rowOrderList['pro_id'];
       $pro_code[] = $rowOrderList['pro_code'];
       $pro_amount[] = $rowOrderList['pro_amount'];
       $pro_price[] = $rowOrderList['pro_price'];
       ?>
       <input type="hidden" name="pro_id[]" value="<?php echo $rowOrderList['pro_id'];?>">
       <input type="hidden" name="pro_code[]" value="<?php echo $rowOrderList['pro_code'];?>">
       <input type="hidden" name="pro_amount[]" value="<?php echo $rowOrderList['pro_amount'];?>">
       <input type="hidden" name="pro_price[]" value="<?php echo $rowOrderList['pro_price'];?>">
       <?php
       }

      $nRow = 1;
      $sumTotal = 0;
      $sumpricevat = 0;
      $sumtotals = 0;
      $sumprice = 0;

      $quOrder = mysqli_query($conn,"SELECT * FROM s_group_typeproduct WHERE 1 AND group_spro_id LIKE '04-%' ORDER BY group_spro_id ASC");
      while($rowOrder = mysqli_fetch_array($quOrder)){
      ?>
      <tr>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
        <input type="checkbox" name="chkOrder[]" id="chkOrder<?php echo $nRow-1;?>" <?php if(in_array($rowOrder['group_id'], $pro_id)){echo 'checked';}?> value="<?php echo $nRow-1;?>">
        <input type="hidden" name="chkCode[]" value="<?php echo $rowOrder['group_id'];?>">
      </td>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
      <?php echo $nRow;?>
      </td>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
      <?php echo $rowOrder['group_spro_id'];?>
       <input type="hidden" name="chkSproid[]" value="<?php echo $rowOrder['group_spro_id'];?>">
      </td>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:left;">
      <?php echo $rowOrder['group_name'].' '.$rowOrder['group_detail'];?>
      </td>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
        <input type="text" name="chkAmount[]" id="chkAmount<?php echo $nRow-1;?>" value="<?php if(in_array($rowOrder['group_id'], $pro_id)){$key = array_search($rowOrder['group_id'], $pro_id);echo number_format($pro_amount[$key]);}?>" style="text-align:center;" onkeypress="return isNumberKey(event);">
      </td>
      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
        <input type="text" name="chkPrice[]" id="chkPrice<?php echo $nRow-1;?>" value="<?php if(in_array($rowOrder['group_id'], $pro_id)){$key = array_search($rowOrder['group_id'], $pro_id);echo number_format($pro_price[$key]);}?>" style="text-align:center;" onkeypress="return isNumberKey(event);">
      </td>
    </tr>
      <?php   
       $nRow++;   

       if(in_array($rowOrder['group_id'], $pro_id)){
         $key = array_search($rowOrder['group_id'], $pro_id);
         $pro_priceR = str_replace($vowels,"",$pro_price[$key]);
         $sumprice =  $sumprice + ($pro_amount[$key]*$pro_priceR);
        }
        
        $sumpricevat = ($sumprice * 7) / 100;
        $sumtotals = $sumprice + $sumpricevat;
      }
    ?>
    <tr>
      <td colspan="4" style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>รวมทั้งหมด</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;"><?php echo number_format($sumprice,2);?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>VAT 7 %</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;"><?php echo number_format($sumpricevat,2);?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" style="text-align:center;border:0px solid #003399;padding:9px 5px;background-color: #ddebf7;"><strong><?php echo baht_text($sumtotals);?></strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>ราคารวมทั้งสิ้น</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;"><?php echo number_format($sumtotals,2);?>&nbsp;&nbsp;</td>
    </tr>
    </table><br>

    <table width="100%" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:left;padding-top:10px;padding-bottom:10px;">
        <strong>หมายเหตุอื่นๆ :</strong>
        <br>
        <textarea name="remark" id="remark" style="height:150px;"><?php  echo strip_tags($remark);?></textarea>
        </td>
      </tr>
    </table>
    </fieldset>
    </div><br>
    <div class="formArea">
      <div style="text-align: center;">
      <input type="button" value=" บันทึก " id="submitF" class="button bt_save" onclick="submitForm()">
      <input type="button" name="Cancel" id="resetF" value=" ยกเลิก " class="button bt_cancel" onClick="window.location='index.php'">
      </div>
      <?php
			$a_not_exists = array();
			post_param($a_param,$a_not_exists);
			?>
      <input name="mode" type="hidden" id="mode" value="<?php  echo $_GET['mode'];?>">
      <input name="st_setting" type="hidden" id="st_setting" value="<?php  echo $st_setting;?>">
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

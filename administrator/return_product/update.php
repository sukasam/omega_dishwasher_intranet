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
        
        // foreach($_POST['chkCode'] as $a => $b){
				
        //   if($_POST['chkAmount'][$a] != ""){

        //     $_POST['chkPrice'][$a] = str_replace($vowels,"",$_POST['chkPrice'][$a]);
        //     //echo "INSERT INTO `s_return_product_pro` (`id`, `order_id`, `pro_id`, `pro_code`, `pro_amount`) VALUES (NULL, '".$id."', '".$_POST['chkCode'][$a]."', '".$_POST['chkSproid'][$a]."', '".$_POST['chkAmount'][$a]."');"."<br>";
        //     @mysqli_query($conn,"INSERT INTO `s_return_product_pro` (`id`, `order_id`, `pro_id`, `pro_code`, `pro_amount`) VALUES (NULL, '".$id."', '".$_POST['chkCode'][$a]."', '".$_POST['chkSproid'][$a]."', '".$_POST['chkAmount'][$a]."');");
        //   }
        //   //echo $a ." ". $b." ".$_POST['chkOrder'][$a]." ".$_POST['chkAmount'][$a]." ".$_POST['chkPrice'][$a]."<br>";
        // }	

        foreach($_POST['chkOrder'] as $a => $b){
          if(!empty($_POST['chkCode'][$b])){
            @mysqli_query($conn,"INSERT INTO `s_return_product_pro` (`id`, `order_id`, `pro_id`, `pro_code`, `pro_sn`, `pro_amount`) VALUES (NULL, '".$id."', '".$_POST['chkCode'][$a]."', '".$_POST['chkSproid'][$a]."', '".$_POST['chkSn'][$a]."', '".$_POST['chkAmount'][$a]."');");
          }
        }	

        @mysqli_query($conn,"UPDATE `s_return_product` SET `who_sale` = '".$_SESSION["login_id"]."' WHERE `order_id` = ".$id.";");

				//require_once("genpdf.php");

				include_once("../mpdf54/mpdf.php");
				include_once("form_return_product.php");
				$mpdf=new mPDF('UTF-8');
				$mpdf->SetAutoFont();
				$mpdf->WriteHTML($form);
				$chaf = str_replace("/","-",$_POST['fs_id']);
				$mpdf->Output('../../upload/return_product/'.$chaf.'.pdf','F');

       // header("Location:update.php?mode=update&order_id=".$id);
			  header ("location:index.php?" . $param);
    }
    
		if ($_POST['mode'] == "update" ) {
				
        $_POST['loc_name'] = addslashes($_POST['loc_name']);
        
        @mysqli_query($conn,"DELETE FROM `s_return_product_pro` WHERE `order_id` = '".$_REQUEST[$PK_field]."'");
				
				include_once ("../include/m_update.php");
        $id = $_REQUEST[$PK_field];

        foreach($_POST['chkOrder'] as $a => $b){
          if(!empty($_POST['chkCode'][$b])){
            @mysqli_query($conn,"INSERT INTO `s_return_product_pro` (`id`, `order_id`, `pro_id`, `pro_code`, `pro_sn`, `pro_amount`) VALUES (NULL, '".$id."', '".$_POST['chkCode'][$b]."', '".$_POST['chkSproid'][$b]."', '".$_POST['chkSn'][$b]."', '".$_POST['chkAmount'][$b]."');");
          }
        }	

			//  exit();
				//require_once("genpdf.php");
			
				include_once("../mpdf54/mpdf.php");
				include_once("form_return_product.php");
				$mpdf=new mPDF('UTF-8');
				$mpdf->SetAutoFont();
				$mpdf->WriteHTML($form);
				$chaf = str_replace("/","-",$_POST['fs_id']);
				$mpdf->Output('../../upload/return_product/'.$chaf.'.pdf','F');

        //header("Location:update.php?mode=update&order_id=".$id);
			header ("location:index.php?" . $param);
    }

  }
  
	if ($_GET['mode'] == "add") {

     Check_Permission($conn,$check_module,$_SESSION['login_id'],"add");
     
     if(isset($_GET['cus_id']) && $_GET['cus_id'] != ""){
     
      $foInfo = get_firstorder($conn, $_GET['cus_id']);
      $cus_id = $foInfo['fo_id'];
      $cd_name = $foInfo['cd_name'];
      $cd_address = $foInfo['cd_address'];
      $cd_tel = $foInfo['cd_tel'];
      $cd_fax = $foInfo['cd_fax'];
      $c_contact = $foInfo['c_contact'];
      $c_tel = $foInfo['c_tel'];
      $cs_sell = $foInfo['cs_sell'];
      $ship_name = $foInfo['loc_name2'];
      $ship_address = $foInfo['loc_address2'];
      $type_service = $foInfo['ctype'];
      $cd_province = $foInfo['cd_province'];
      
    
      $a_sdate=explode("-",date("Y-m-d"));
      $date_forder=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

      $warter = array();

      if(!empty($foInfo['warter01'])){
        array_push($warter,$foInfo['warter01']);
      }
      if(!empty($foInfo['warter02'])){
        array_push($warter,$foInfo['warter02']);
      }
      if(!empty($foInfo['warter03'])){
        array_push($warter,$foInfo['warter03']);
      }
      if(!empty($foInfo['warter04'])){
        array_push($warter,$foInfo['warter04']);
      }
      if(!empty($foInfo['warter05'])){
        array_push($warter,$foInfo['warter05']);
      }

     }

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
<SCRIPT type=text/javascript src="../js/jquery-1.9.1.min.js"></SCRIPT>
<!--<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>-->
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
  <LI><A class=shortcut-button href="../return_product/"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
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
    <td style="padding-bottom:5px;">
    <?php 
    $userCreate = getCreatePaper($conn, $tbl_name, " AND `order_id`= ".$order_id);
    $headerIMG = get_headerPaper($conn, "RP", $userCreate);
    ?>
    <img src="<?php echo $headerIMG;?>" width="100%" /></td>
  </tr>
</table>
  
  <table width="100%" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> <input type="text" name="cd_name" value="<?php  echo $cd_name;?>" id="cd_name" class="inpfoder" style="width:70%;border: 0px;">
            <span id="rsnameid"><input type="hidden" name="cus_id" value="<?php  echo $cus_id;?>"></span><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_c.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
            </td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>เลขที่ใบรับคืนสินค้า:</strong> 
            <input type="text" name="fs_id" value="<?php  if($fs_id == ""){echo check_returnproduct($conn);}else{echo $fs_id;};?>" id="fs_id" class="inpfoder" style="border: 0px;"> 
            </td>

          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong>ที่อยู่ :</strong> <input type="text" name="cd_address" value="<?php  echo $cd_address;?>" id="cd_address" class="inpfoder" style="width:80%;border: 0px;"></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong> วันที่รับคืนสินค้า :</strong> <input type="text" name="date_forder" readonly value="<?php  if($date_forder==""){echo date("d/m/Y");}else{ echo $date_forder;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_forder'});</script>
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
              <strong>ประเภทลูกค้า :</strong> <span id="type_servicetxt"><?php if($cd_name != ""){echo custype_name($conn,$type_service);}?></span><input type="hidden" name="type_service" id="type_service" value="<?php echo $type_service;?>">
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>โทรศัพท์ :</strong> <input type="text" name="cd_tel" value="<?php  echo $cd_tel;?>" id="cd_tel" class="inpfoder" style="border: 0px;">
              <strong>แฟกซ์ :</strong>
              <input type="text" name="cd_fax" value="<?php  echo $cd_fax;?>" id="cd_fax" class="inpfoder" style="border: 0px;"></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
             <strong>สถานที่รับคืนสินค้า :</strong><input type="text" name="ship_name" value="<?php  echo $ship_name;?>" id="ship_name" class="inpfoder" style="width:60%;border: 0px;">
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong>ชื่อผู้ติดต่อ :</strong>
              <input type="text" name="c_contact" value="<?php  echo $c_contact;?>" id="c_contact" class="inpfoder" style="border: 0px;">
              <strong>เบอร์โทร :</strong>
              <input type="text" name="c_tel" value="<?php  echo $c_tel;?>" id="c_tel" class="inpfoder" style="border: 0px;">
          </td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong>พนักงานขาย :</strong><input type="text" name="cs_sell" value="<?php  echo $cs_sell;?>" id="cs_sell" class="inpfoder" style="width:80%;border: 0px;">
            <input type="hidden" name="ship_address" value="<?php  echo $ship_address;?>" id="ship_address" class="inpfoder">
            </td>
          </tr>
</table>

  <br>
  <div id="fo_product">
    <?php

     $quOrderList = @mysqli_query($conn,"SELECT * FROM s_return_product_pro WHERE order_id = '".$_GET['order_id']."' ORDER BY id ASC");
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

      if($_GET['mode'] == 'add'){
        $pro_id = array();
      }else{
        ?>
        <table width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;">
        <tr>
          <td width="5%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>เลือก</strong></td>
          <td width="5%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
          <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รหัสสินค้า</strong></td>
          <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>SN</strong></td>
          <td width="30%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายละเอียด</strong></td>
          <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
          <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>หน่วย</strong></td>
          <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;display:none;"><strong>ราคา/หน่วย</strong></td>
        </tr>
        <?php

        $rowcusFO  = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_first_order WHERE fo_id  = '".$cus_id."'"));

        $arrayProFO = array('cpro1','cpro2','cpro3','cpro4','cpro5','cpro6','cpro7');
        $arrayProFOSN = array('pro_sn1','pro_sn2','pro_sn3','pro_sn4','pro_sn5','pro_sn6','pro_sn7');
        $arrayProFOAmount = array('camount1','camount2','camount3','camount4','camount5','camount6','camount7');

          for($i=0;$i<count($arrayProFO);$i++){
            if(!empty($rowcusFO[$arrayProFO[$i]])){

              $chkProcheck = '';
              if (in_array($rowcusFO[$arrayProFO[$i]], $pro_id)){
                $chkProcheck = 'checked';
              }else{
                $chkProcheck = '';
              }

              $foProductList .= '<tr>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">
                  <input type="checkbox" name="chkOrder[]" id="chkOrder'.$i.'" value="'.$i.'" '.$chkProcheck.'>
                  <input type="hidden" name="chkCode[]" value="'.$rowcusFO[$arrayProFO[$i]].'">
                </td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">'.($i+1).'</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">'.get_probarcode($conn,$rowcusFO[$arrayProFO[$i]]).'
                  <input type="hidden" name="chkSproid[]" value="'.get_probarcode($conn,$rowcusFO[$arrayProFO[$i]]).'">
                </td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">'.$rowcusFO[$arrayProFOSN[$i]].'
                  <input type="hidden" name="chkSn[]" value="'.$rowcusFO[$arrayProFOSN[$i]].'">
                </td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:left;">'.get_proname($conn,$rowcusFO[$arrayProFO[$i]]).'</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">'.$rowcusFO[$arrayProFOAmount[$i]].'
                  <input type="hidden" name="chkAmount[]" id="chkAmount'.$i.'" value="'.$rowcusFO[$arrayProFOAmount[$i]].'">
                </td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">'.get_pronamecall($conn,$rowcusFO[$arrayProFO[$i]]).'</td>
                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;display:none;"></td>
              </tr> ';
            }
            
          }
          echo $foProductList;
        ?>
        </table>
        <?php
      }
      

       ?>
       </div>

    </table>
    <br>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <th width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></th>
          <th width="60%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการแถม</strong></th>
          <th width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></th>
          <th width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>หน่วย</strong></th>
      </tr>
      <tr>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">1</td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro1" value="<?php  echo $cs_pro1;?>" id="cs_pro1" class="inpfoder" style="width:90%;height:27px;"></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount1" value="<?php  echo $cs_amount1;?>" id="cs_amount1" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_namecall1" value="<?php  echo $cs_namecall1;?>" id="cs_namecall1" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
      </tr>
      <tr>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">2</td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro2" value="<?php  echo $cs_pro2;?>" id="cs_pro2" class="inpfoder" style="width:90%;height:27px;"></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount2" value="<?php  echo $cs_amount2;?>" id="cs_amount2" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_namecall2" value="<?php  echo $cs_namecall2;?>" id="cs_namecall2" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
      </tr>
      <tr>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">3</td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro3" value="<?php  echo $cs_pro3;?>" id="cs_pro3" class="inpfoder" style="width:90%;height:27px;"></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount3" value="<?php  echo $cs_amount3;?>" id="cs_amount3" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_namecall3" value="<?php  echo $cs_namecall3;?>" id="cs_namecall3" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
      </tr>
      <tr>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">4</td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro4" value="<?php  echo $cs_pro4;?>" id="cs_pro4" class="inpfoder" style="width:90%;height:27px;"></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount4" value="<?php  echo $cs_amount4;?>" id="cs_amount4" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_namecall4" value="<?php  echo $cs_namecall4;?>" id="cs_namecall4" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
      </tr>
      <tr>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">5</td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro5" value="<?php  echo $cs_pro5;?>" id="cs_pro5" class="inpfoder" style="width:90%;height:27px;"></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount5" value="<?php  echo $cs_amount5;?>" id="cs_amount5" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_namecall5" value="<?php  echo $cs_namecall5;?>" id="cs_namecall5" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>
      </tr>
    </table>
    <br>
    <table width="100%" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <?php 
              if(isset($_GET['order_id']) && !empty($_GET['order_id'])){
                if(!is_null($signature) && !empty($signature)){
                  ?>
                  <tr>
                    <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                    <img src="../../upload/customer/signature/<?php echo base64_encode($fs_id);?>.png" height="50" border="0" />
                      <input type="hidden" name="signature" value="<?php echo $signature;?>">
                      <input type="hidden" name="signature_date" value="<?php echo $signature_date;?>">
                    </td>
                  </tr>
                  <?php
                }else{
                ?>
                <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                  <a href="signature.php?order_id=<?php echo $_GET['order_id'];?>&fs_id=<?php echo $fs_id;?>"><input type="button" value=" ลายเซ็นลูกค้า " class="button bt_save"></a>
                </td>
              </tr>
                <?php
                }
              }
              ?>
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <?php  echo $cd_name;?>
                </td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้ส่งคืนสินค้า</strong></td>
              </tr>
              <!-- <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                วันที่ ________________________
                </td>
              </tr> -->
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	

        </td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>
                <select name="cs_technic" id="cs_technic">
                	<option value="">กรุณาเลือก</option>
                	<?php  
                  $qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
                  while($row_custec = @mysqli_fetch_array($qu_custec)){
                    // if($row_custec['group_id'] == 7 || $row_custec['group_id'] == 11 || $row_custec['group_id'] == 33 || $row_custec['group_id'] == 34){
                    ?>
                    <option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $cs_technic){echo 'selected';}?>><?php  echo $row_custec['group_name'];?></option>
                    <?php 
                    // }
                  }
                ?>
                </select></strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้รับคืนสินค้า</strong></td>
              </tr>
              <tr>
              <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
             </td>
              </tr>
            </table>
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
      <input name="who_sale" type="hidden" id="who_sale" value="<?php  echo $who_sale;?>">
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

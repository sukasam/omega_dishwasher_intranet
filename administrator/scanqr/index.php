<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php  echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel="stylesheet" type=text/css href="../css/reset.css" media=screen>
<LINK rel="stylesheet" type=text/css href="../css/style.css" media=screen>
<!--<LINK rel="stylesheet" type=text/css href="../css/invalid.css" media=screen>-->
<META name=GENERATOR content="MSHTML 8.00.7600.16535">



<style>
input, label {vertical-align:middle}
.qrcode-text {padding-right:1.7em; margin-right:0;border: none;}
.qrcode-text-btn {display:inline-block; background:url(qrcode.svg) 50% 50% no-repeat; height:15em; width:12.7em; margin-left:-1.7em; cursor:pointer}
.qrcode-text-btn > input[type=file] {position:absolute; overflow:hidden; width:1px; height:1px; opacity:0}
.hide{display: none;}
</style>

<script src="jquery-1.9.1.min.js"></script>
<script src="qr_packed.js"></script>
<script src="geo.js"></script>
<script>
function openQRCamera(node) {
  
  document.getElementById('btQR').classList.add("hide");
  document.getElementById('loadQR').classList.remove("hide");
	
  var reader = new FileReader();
  reader.onload = function() {
    node.value = "";
    qrcode.callback = function(res) {
      if(res instanceof Error) {
        alert("ไม่พบรหัส QR โปรดตรวจสอบว่ารหัส QR อยู่ในกรอบของกล้องแล้วลองอีกครั้ง");
		
		document.getElementById('loadQR').classList.add("hide");
  		document.getElementById('btQR').classList.remove("hide");
		  
      } else {
		  
		  
			$.ajax({
				type: "GET",
				url: "call_return.php?action=checkKey&qrcode="+res,
				success: function(data){
					//console.log(data);
					var obj = JSON.parse(data);
//					document.getElementById('btQR').classList.remove("hide");
//	     			document.getElementById('loadQR').classList.add("hide");
					
					var decodedData = window.atob(obj.pk_field); // decode the string
					
					if(obj.status === 'yes'){
						if(geo_position_js.init()){
							geo_position_js.getCurrentPosition(success_callback,error_callback,{enableHighAccuracy:true});
						}
						else{
							alert("Functionality not available");
							//console.log("Functionality not available");
							window.location = '../scanqr/index.php';
						}
						//window.location = '../scanqr_res/index.php';
					}else{
						alert("รหัส S/N "+decodedData+" นี้ยังไม่เรียกใช้ใน FO โปรดตรวจสอบอีกครั้ง");
						window.location = '../scanqr/index.php';
					}
				}
			});
		  
		//node.parentNode.previousElementSibling.value = res;
      }
    };
    qrcode.decode(reader.result);
  };
  reader.readAsDataURL(node.files[0]);
}

function success_callback(p){
	//console.log(p.coords.latitude+' , '+p.coords.longitude);
	//alert(p.coords.latitude+' , '+p.coords.longitude);
	
	var latitude = p.coords.latitude;
	var longitude = p.coords.longitude;
	
	$.ajax({
		type: "GET",
		url: "call_return.php?action=geo_location&latitude="+latitude+"&longitude="+longitude,
		success: function(data){
			//console.log(data);
			var obj = JSON.parse(data);
//			document.getElementById('btQR').classList.remove("hide");
//	     	document.getElementById('loadQR').classList.add("hide");
			
			//alert(JSON.stringify(obj));
			
			window.location = '../scanqr_res/index.php';


		}
	});
}
function error_callback(p){
	//console.log('error='+p.message);
	alert('error='+p.message);
	window.location = '../scanqr/index.php';
}

function showQRIntro() {
  return confirm("ใช้กล้องของคุณเพื่อถ่ายภาพรหัส QR");
}
</script>

</HEAD>

<BODY>
<DIV id=body-wrapper>
<?php  include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php  include('../top.php');?>
<br><br>
  
  <!-- End .shortcut-buttons-set -->

<DIV class=content-box><!-- Start Content Box -->
	<DIV class=content-box-header align="right">
		<H3 align="left"><?php  echo $check_module; ?></H3>
		<DIV class=clear></DIV>
	</DIV>

	<DIV class="content-box-content">
		<center>
<!--		<input type="hidden" size="16" placeholder="" class="qrcode-text">-->
		
			<div id="btQR">
				<label class="qrcode-text-btn" >
					<input type="file" accept="image/*" capture="environment" onclick="return showQRIntro();" onchange="openQRCamera(this);" tabindex="-1">
				</label> 
<!--
				<label>OR</label>
				<label>
					<input type="text" name="" value="" id="">
				</label> 
-->
			</div>
			
			
			<div class="hide" id="loadQR"><center><img src="../images/waiting.gif" width="450"></center></div>
		<!--<input type="button" value="Go" disabled="disabled">-->
		</center>
	</DIV>

</DIV>
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php  include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
</BODY>
</HTML>

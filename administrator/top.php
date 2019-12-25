<?php  
	if($_SESSION['login_name'] == ""){header("Location:../index.php");}
?>
<!--<div style="font-size:20px; font-weight:bold; padding-bottom:20px;">Welcome <?php  echo $_SESSION["login_name"];?></div>-->
<link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" />
<!--[if IE 7]><link rel="stylesheet" href="../css/styleIE7.css" type="text/css" media="screen" /><![endif]-->
<!--[if IE 8]><link rel="stylesheet" href="../css/styleIE8.css" type="text/css" media="screen" /><![endif]-->
<!--[if IE 9]><link rel="stylesheet" href="../css/styleIE9.css" type="text/css" media="screen" /><![endif]-->
<?php  if(chkBrowser("Chrome")==1){?>
<link rel="stylesheet" href="../css/chrome.css" type="text/css" media="screen" />
<?php  }
if(chkBrowser("Chrome")==0 && chkBrowser("Safari")==1){
?>
<link rel="stylesheet" href="../css/safari.css" type="text/css" media="screen" />
<?php  }
if(chkBrowser("Opera")==1){
?>
<link rel="stylesheet" href="../css/opera.css" type="text/css" media="screen" />
<?php  }?>
<LINK rel="stylesheet" type=text/css href="../font/stylesheet.css" media=screen>
<div class="topmainuser">
		<ul>
        	<li><a href="../welcome"><img src="../images/template/logo_main.png" width="260" height="121" border="0" alt="" /></a></li>
            <li style="float:right;">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:inherit;">
              <tr style="background:#f0f0f0;">
                <td style="vertical-align:top;border:none;">
                	<p style="font-family:MyriadProBold;font-size:25px;color:#d47000;padding-right:10px;line-height:25px;text-align:right;">OMEGA Intranet</p>
                    <p style="padding-right:10px;font-size:25px;font-family:Tahoma, Geneva, sans-serif;color:#000000;line-height:25px;text-align:right;padding-top:10px;"><a href="../profiles/?mid=15"><?php  echo $_SESSION["fullname"];?></a></p>
                </td>
                <td style="vertical-align:top;border:none;">
                	<a href="../profiles/?mid=15"><img src="../../upload/user/<?php  echo get_imguser($conn,$_SESSION['login_id']);?>" width="155" height="136" border="0" alt=""></a>
                </td>
              </tr>
            </table>
            </li>
        </ul>
        <div class="clear"></div>
</div>

<style>
.alert-success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
}
.alert {
    padding: 15px;
    margin-bottom: 5px;
    border: 1px solid transparent;
    border-radius: 4px;
}
.close {
    float: right;
    font-size: 21px;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity=20);
    opacity: .2;
}
</style>

<!-- <LINK rel="stylesheet" type=text/css href="../css/bootstrap.min.css" media=screen> -->
<SCRIPT type=text/javascript src="../js/bootstrap.min.js"></SCRIPT>
<!-- <SCRIPT type=text/javascript src="../js/jquery-1.12.2.min.js"></SCRIPT> -->

<?php
  $resultNoti = mysqli_query($conn, "SELECT * FROM s_notification WHERE user_account = '".$_SESSION["login_id"]."' AND view = '0'");
  while ($rowNoti = mysqli_fetch_array($resultNoti, MYSQLI_ASSOC)) {
      //printf("ID: %s  Name: %s", $row["id"], $row["name"]);
      ?>
      <div class="alert alert-success">
        <a href="#" onclick="notiChange(<?php echo $rowNoti['id'];?>)" class="close" data-dismiss="alert" aria-label="close">×</a>
        <?php echo getShowNoti($conn,$rowNoti);?>
      </div>
      <?php
  }
?>

<script>
  function notiChange(id){
    $.ajax({
		type: "GET",
		url: "../api/call_api.php?action=updateNoti&id="+id,
		success: function(data){
			var obj = JSON.parse(data);
			if(obj.status === 'yes'){
				//$("#ccode"+key).html(obj.group_spar_id);
        //console.log(data);
			}
		}
	});
  }
</script>
<br><br>
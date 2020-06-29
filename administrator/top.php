<?php  
  if($_SESSION['login_name'] == ""){header("Location:../index.php");}
  if($_GET['actionSet'] == 'setCloseNoti'){
    @mysqli_query($conn, "UPDATE `s_notification` SET `view` = '1' WHERE `s_notification`.`user_account` = '".$_SESSION["login_id"]."';");
    $pathSet = curPageURL();
    $chkPathSet = explode('actionSet=setCloseNoti',$pathSet);
    header('Location:'.$chkPathSet[0]);
  }

  $conTR = chkContrac($conn,"R");
  $conTS = chkContrac($conn,"S");

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
  //echo "SELECT * FROM s_notification WHERE user_account = '".$_SESSION["login_id"]."' AND view = '0'";
  $resultNoti = mysqli_query($conn, "SELECT * FROM s_notification WHERE user_account = '".$_SESSION["login_id"]."' AND view = '0' ORDER BY id DESC");
  $rowcount=mysqli_num_rows($resultNoti);
  if($rowcount >= 1){
    $pathSet = curPageURL();
    $chkPathSet = explode('?',$pathSet);
    if(count($chkPathSet) >= 2){
      $pathSet .= '&actionSet=setCloseNoti';
    }else{
      $pathSet .= '?actionSet=setCloseNoti';
    }
    echo '<a href="'.$pathSet.'" class="closeNotiBT" onclick="return confirm(\'คุณแน่ใจต้องการปิดการแจ้งเตือนทั้งหมด?\');">ปิดการแจ้งเตือนทั้งหมด</a><br><br><br>';
  }
  $kepNotiTBID = array();
  while ($rowNoti = mysqli_fetch_array($resultNoti, MYSQLI_ASSOC)) {
      if(!in_array($rowNoti['tag_db'].$rowNoti['t_id'],$kepNotiTBID)){

          $cssProcess = '';

          if($rowNoti['tag_db'] == 's_order_solution'){
            $cssProcess = 'processOrderAlert'.$rowNoti['process'];
          }else{
            $cssProcess = 'processAlert'.$rowNoti['process'];
          }

         ?>
        <div class="alert alert-success <?php echo $cssProcess;?>">
          <a href="#" onclick="notiChange(<?php echo $rowNoti['id'];?>)" class="close" data-dismiss="alert" aria-label="close">×</a>
          <?php echo getShowNoti($conn,$rowNoti);?>
        </div>
      <?php
      array_push($kepNotiTBID,$rowNoti['tag_db'].$rowNoti['t_id']);
      }
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
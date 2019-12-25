<?php  
include_once("../../include/connect.php");

//header('Content-Type: text/html; charset=tis-620');

if($_GET['action'] === "updateNoti"){
  
  //echo "UPDATE `s_notification` SET `view` = '1' WHERE `s_notification`.`id` = ".$_GET['id'].";";
  @mysqli_query($conn,"UPDATE `s_notification` SET `view` = '1' WHERE `s_notification`.`id` = ".$_GET['id'].";");
  echo json_encode(array('status' => 'yes'));

}
?>
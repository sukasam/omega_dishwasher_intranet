<?php  
include_once("../../include/connect.php");

//header('Content-Type: text/html; charset=tis-620');

if($_GET['action'] === "updateNoti"){
  
  //echo "UPDATE `s_notification` SET `view` = '1' WHERE `s_notification`.`id` = ".$_GET['id'].";";

  $RowNoti = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `s_notification` WHERE `s_notification`.`id` = ".$_GET['id'].";"));
  $quNoti2 = @mysqli_query($conn,"SELECT * FROM `s_notification` WHERE 1 AND tag_db = '".$RowNoti['tag_db']."' AND t_id = '".$RowNoti['t_id']."' AND user_account = '".$RowNoti['user_account']."'");
  
  while($rowNoti2 = @mysqli_fetch_array($quNoti2)){
    @mysqli_query($conn,"UPDATE `s_notification` SET `view` = '1' WHERE `s_notification`.`id` = ".$rowNoti2['id'].";");
  }

  @mysqli_query($conn,"UPDATE `s_notification` SET `view` = '1' WHERE `s_notification`.`id` = ".$_GET['id'].";");
  echo json_encode(array('status' => 'yes'));

}
?>
<?php
include_once "../../include/config.php";
include_once "../../include/connect.php";
include_once "../../include/function.php";

if ($_GET['action'] === "updateStatus") {

    $code = Check_Permission3($conn, "สถานะใบแจ้งซ่อม", $_SESSION['login_id'], "update");

    if ($code != 0) {
        //Updated service_status
        @mysqli_fetch_assoc(@mysqli_query($conn,"UPDATE `s_service_report` SET `service_status` = '".$_GET['statusSV']."' WHERE `sr_id` = ".$_GET['id'].";"));

        //Add Noti
        addNotification($conn,11,"s_service_report",$_GET['id'],$_GET['statusSV']);
        // Response
        echo json_encode(array('status' => 'update','sv_id'=> $_GET['id'],'service_status'=> $_GET['statusSV'],'code'=> $code));
     
    }else{
        // Response
        echo json_encode(array('status' => 'not have permission','code'=> $code));
    }
}

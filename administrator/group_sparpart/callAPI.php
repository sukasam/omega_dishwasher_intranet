<?php

include ("../../include/config.php");
include ("../../include/connect.php");

$action = $_GET['action'];

if($action === "getcatv1"){
    $catv1 = $_GET['catv1'];
    $opHtml = '<option value="0">กรุณาเลือก</option>';
    $qucatv = @mysqli_query($conn, "SELECT * FROM s_group_catspare2 WHERE 1 AND group_cat_id = '".$catv1."' ORDER BY group_name ASC");
    while ($row_catv = @mysqli_fetch_array($qucatv)) {
        $opHtml .= '<option value="'.$row_catv['group_id'].'">'.$row_catv['group_name'].'</option>';
    }
    echo "|".$opHtml;
}
if($action === "getcatv2"){
    $catv1 = $_GET['catv1'];
    $catv2 = $_GET['catv2'];
    $opHtml = '<option value="0">กรุณาเลือก</option>';
    $qucatv = @mysqli_query($conn, "SELECT * FROM s_group_catspare3 WHERE 1 AND group_cat_id = '".$catv1."' AND group_cat2_id = '".$catv2."' ORDER BY group_name ASC");
    while ($row_catv = @mysqli_fetch_array($qucatv)) {
        $opHtml .= '<option value="'.$row_catv['group_id'].'">'.$row_catv['group_name'].'</option>';
    }
    echo "|".$opHtml."|"."SELECT * FROM s_group_catpro3 WHERE 1 AND group_cat1_id = '".$catv1."' AND group_cat2_id = '".$catv2."' ORDER BY group_name ASC";
}
if($action === "getcatv3"){
    $catv1 = $_GET['catv1'];
    $catv2 = $_GET['catv2'];
    $catv3 = $_GET['catv3'];
    $opHtml = '<option value="0">กรุณาเลือก</option>';
    $qucatv = @mysqli_query($conn, "SELECT * FROM s_group_catspare4 WHERE 1 AND group_cat_id = '".$catv1."' AND group_cat2_id = '".$catv2."' AND group_cat3_id = '".$catv3."' ORDER BY group_name ASC");
    while ($row_catv = @mysqli_fetch_array($qucatv)) {
        $opHtml .= '<option value="'.$row_catv['group_id'].'">'.$row_catv['group_name'].'</option>';
    }
    echo "|".$opHtml;
}
?>
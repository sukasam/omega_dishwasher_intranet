<?php 
	include_once("../../include/aplication_top.php");
	header("Content-type: text/html; charset=windows-874");
	header("Cache-Control: no-cache, must-revalidate");
	@mysql_query("SET NAMES tis620");
	
	if($_GET['action'] == 'getpro'){
		$pid = $_GET['pid'];
		$rowpro  = @mysql_fetch_array(@mysql_query("SELECT * FROM s_group_typeproduct WHERE group_id = '".$pid."'"));
		echo $rowpro['group_pro_pod']."|".$rowpro['group_pro_sn']."|".number_format($rowpro['group_pro_price']);
	}
	
	if($_GET['action'] == 'getprice'){
		$pid = $_GET['pid'];
		$prid = $_GET['prid'];
		$rowpro  = @mysql_fetch_array(@mysql_query("SELECT * FROM s_group_typeproduct WHERE group_id = '".$pid."'"));
		$sumprice = $prid * $rowpro['group_pro_price'];
		echo number_format($sumprice);
	}
?>


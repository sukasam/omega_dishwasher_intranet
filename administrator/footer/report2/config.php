<?php 
	$PK_field = "fo_id";
	//$FR_field = "";
	$check_module = "จัดการรายงาน";
	$page_name = "จัดการรายงาน (Service Report)";
	$tbl_name = "s_first_order";
	$field_confirm_showname= "group_name";
	$fieldlist = array('cd_name','cd_address','cd_province','cd_tel','cd_fax','fs_id','date_forder','cg_type','ctype','pro_type','po_id','c_contact','c_tel','loc_name','loc_address','loc_shopping','cpro1','cpro2','cpro3','cpro4','cpro5','cpro6','cpro7','camount1','camount2','camount3','camount4','camount5','camount6','camount7','ccomment','cs_pro1','cs_pro2','cs_pro3','cs_pro4','cs_pro5','cs_amount1','cs_amount2','cs_amount3','cs_amount4','cs_amount5','date_quf','date_qut','qucomment','cs_contact','cs_tel','cs_ship','cs_setting','cs_company','cs_sell','cs_aceep');
	$search_key = array('cd_name','cd_address','cd_province','cd_tel','cd_fax','fs_id','cg_type','ctype','pro_type','po_id','c_contact','c_tel','loc_name','loc_address','loc_shopping');
	$pagesize = 50;
	$pages="First Order";

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
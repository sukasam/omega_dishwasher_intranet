
<?php 
	$PK_field = "sr_id";
	//$FR_field = "";
	$check_module = "Service Report";
	$page_name = "Service Report (ใบเบิกอะไหล่)";
	$tbl_name = "s_service_report3";
	$field_confirm_showname= "cus_id";
	$fieldlist = array('cus_id','sv_id','srid','sr_ctype','sr_ctype2','job_open','job_close','job_balance','sr_stime','loc_pro','loc_seal','loc_sn','loc_clean','loc_contact','loc_contact2','loc_contact3','cs_sell','loc_tels','cl_01','cl_02','cl_03','cl_04','cl_05','cl_06','cl_07','cl_08','detail_recom','detail_recom2','ckl_list','ckw_list','ckf_list','detail_calpr','approve','supply','approve_return','st_setting','loc_date2','sell_date','loc_date3');
	$search_key = array("sv_id","cd_name","loc_name");
	$pagesize = 50;
	$pages="user";

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
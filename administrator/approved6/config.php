
<?php 
	$PK_field = "sr_id";
	//$FR_field = "";
	$check_module = "อนุมัติเอกสาร";
	$page_name = "อนุมัติเอกสาร (ใบบริการแผนกช่่าง)";
	$tbl_name = "s_service_report";
	$field_confirm_showname= "cus_id";
	$fieldlist = array('cus_id','sv_id','sr_ctype','sr_ctype2','job_open','job_close','job_balance','sr_stime','loc_pro','loc_seal','loc_sn','loc_clean','loc_clean_sn','loc_contact','loc_tels','cl_01','cl_02','cl_03','cl_04','cl_05','cl_06','cl_07','cl_08','detail_recom','detail_recom2','ckl_list','ckw_list','ckf_list','detail_calpr','cpro1','cpro2','cpro3','cpro4','cpro5','camount1','camount2','camount3','camount4','camount5','cprice1','cprice2','cprice3','cprice4','cprice5','approve','supply','st_setting','process');
	
	$PK_field2 = "job_id";
	$fieldlist2 = array('setup','setupP','ot','ot_1','pd','ot_person','ot_day','travel','distance','detail1','detail2','detail3','detail3_1','detail4','detail5','detail6','detail7','detail8','detail9','technician1','technician2','technician3','technician4','technician5','technician6','technician7','technician8','cost_other1','cost_other2','cost_other3','cost_other4','cost_other5','cost_other6','cost_other7','cost_other8','cost_other9','cost_other10','cost_other11','cost_other12','cost_other13','cost_other14');
	$search_key = array("sv_id","cd_name","loc_name");
    $search_key2 = array("sv_id");
	$pagesize = 50;
	$pages="user";

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


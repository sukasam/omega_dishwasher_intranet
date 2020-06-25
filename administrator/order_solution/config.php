
<?php 
	$PK_field = "order_id";
	//$FR_field = "";
	$check_module = "ใบสั่งน้ำยา";
	$page_name = "Orders solution (ใบสั่งน้ำยา)";
	$tbl_name = "s_order_solution";
	$field_confirm_showname= "group_name";
	$fieldlist = array('cus_id','cd_name','cd_address','cd_province','ship_name','ship_address','cd_tel','cd_fax','fs_id','po_id','date_forder','type_service','c_contact','c_tel','remark','st_setting');
	$search_key = array('cd_name','cd_address','cd_province','cd_tel','cd_fax','fs_id');
	$pagesize = 50;
	$pages="Orders solution";

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
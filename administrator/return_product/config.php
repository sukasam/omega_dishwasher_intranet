
<?php 
	$PK_field = "order_id";
	//$FR_field = "";
	$check_module = "ใบรับคืนสินค้า";
	$page_name = "Return Product (ใบรับคืนสินค้า)";
	$tbl_name = "s_return_product";
	$field_confirm_showname= "group_name";
	$fieldlist = array('cus_id','cd_name','cd_address','cd_province','ship_name','ship_address','cd_tel','cs_sell','cs_technic','cs_pro1','cs_pro2','cs_pro3','cs_pro4','cs_pro5','cs_amount1','cs_amount2','cs_amount3','cs_amount4','cs_amount5','cs_namecall1','cs_namecall2','cs_namecall3','cs_namecall4','cs_namecall5','cd_fax','fs_id','date_forder','type_service','c_contact','c_tel','remark','st_setting','who_sale','signature','signature_date');
	$search_key = array('cd_name','cd_address','cd_province','cd_tel','cd_fax','fs_id');
	$pagesize = 50;
	$pages="Return Product";

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
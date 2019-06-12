<?php 
	$PK_field = "user_p_id";
	//$FR_field = "";
	$FR_module="user";
	$check_module = "user permission";
	$tbl_name = "s_user_p";
	$page_name = "User Permission";
	$field_confirm_showname= "user_p_id";
	$fieldlist = array('user_id','group_id','module_id','read_p','add_p','update_p','delete_p');
	$search_key = array ();
	$pages="user";

	$pagesize = 50;	
	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
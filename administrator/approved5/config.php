
<?php 
	$PK_field = "qu_id";
	//$FR_field = "";
	$check_module = "อนุมัติเอกสาร";
	$page_name = "อนุมัติเอกสาร (ใบเสนอราคาเช่า)";
	$tbl_name = "s_quotation2";
	$field_confirm_showname= "group_name";
	$fieldlist = array('cd_name','cd_address','cd_province','cd_tel','cd_fax','fs_id','date_forder','pro_type','pro_pod1','pro_pod2','pro_pod3','pro_pod4','pro_pod5','pro_pod6','pro_pod7','pro_sn1','pro_sn2','pro_sn3','pro_sn4','pro_sn5','pro_sn6','pro_sn7','c_contact','c_tel','cpro1','cpro2','cpro3','cpro4','cpro5','cpro6','cpro7','camount1','camount2','camount3','camount4','camount5','camount6','camount7','cprice1','cprice2','cprice3','cprice4','cprice5','cprice6','cprice7','cs_pro1','cs_pro2','cs_pro3','cs_pro4','cs_pro5','cs_amount1','cs_amount2','cs_amount3','cs_amount4','cs_amount5','cs_sell','cs_hsell','cs_account','spro1','spro2','sqty1','sqty2','sprice1','sprice2','sdisc1','sdisc2','remark','st_setting','type_service','payc','paym','pays','paysa','paysad','type_electric','giveprice','guaran2','date_sell','date_hsell','date_account','tel_sell','tel_hsell','tel_account','quotation','process');
	$search_key = array('cd_name','cd_address','cd_province','cd_tel','cd_fax','fs_id');
	$pagesize = 50;
	$pages="Quotation";

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
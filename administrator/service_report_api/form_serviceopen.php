<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
.bbcusinfo{
	height:120px;
	overflow:hidden;
}
</style>
<?php 
	
	
	$finfos = get_firstorder($conn,$_POST['cus_id']);
	
	$chk = get_fixlist($_POST['ckf_list']);
	
	$tecinfos = get_technician($conn,$_POST['loc_contact']);
	$ty = "460";
	foreach($chk as $vals){
		$sfix .= '<div class="m03" style="margin-top:'.$ty.'px;"> - '.get_fixname($conn,$vals).'</div>';	
		$ty += 20;
	}

	$form = '<style>
	.bgheader{
		font-size:12px;
		position:absolute;
		margin-top:50px;
		padding-left:590px;
	}
	.bbtxt1{
		font-size:10px;
		position:absolute;
		margin-top:105px;
		padding-left:30px;
		width:250px;
	}
	.bbtxt2{
		font-size:10px;
		position:absolute;
		margin-top:135px;
		padding-left:30px;
		width:250px;
	}
	.bbtxt3{
		font-size:10px;
		position:absolute;
		margin-top:175px;
		padding-left:40px;
	}
	.bbtxt31{
		font-size:10px;
		position:absolute;
		margin-top:175px;
		padding-left:240px;
	}
	.bbtxt4{
		font-size:10px;
		position:absolute;
		margin-top:211px;
		padding-left:40px;
	}
	.bbtxt41{
		font-size:10px;
		position:absolute;
		margin-top:211px;
		padding-left:245px;
	}
	
	.bbtxt5{
		font-size:11px;
		position:absolute;
		margin-top:104px;
		padding-left:480px;
	}
	.bbtxt6{
		font-size:10px;
		position:absolute;
		margin-top:140px;
		padding-left:430px;
	}
	.bbtxt7{
		font-size:10px;
		position:absolute;
		margin-top:140px;
		padding-left:580px;
	}
	.bbtxt8{
		font-size:10px;
		position:absolute;
		margin-top:174px;
		padding-left:460px;
	}
	.bbtxt9{
		font-size:10px;
		position:absolute;
		margin-top:211px;
		padding-left:430px;
	}
	.bbtxt91{
		font-size:10px;
		position:absolute;
		margin-top:211px;
		padding-left:630px;
	}
	.bx01{
		font-size:10px;
		position:absolute;
		margin-top:260px;
		padding-left:120px;
		width:200px;
	}
	.bx02{
		font-size:10px;
		position:absolute;
		margin-top:293px;
		padding-left:100px;
		width:300px;
	}
	.bx03{
		font-size:10px;
		position:absolute;
		margin-top:325px;
		padding-left:40px;
		width:300px;
	}
	.bx04{
		font-size:10px;
		position:absolute;
		margin-top:325px;
		padding-left:230px;
		width:300px;
	}
	.bx05{
		font-size:10px;
		position:absolute;
		margin-top:358px;
		padding-left:70px;
		width:300px;
	}
	.bx051{
		font-size:10px;
		position:absolute;
		margin-top:358px;
		padding-left:230px;
		width:300px;
	}
	.bx06{
		font-size:10px;
		position:absolute;
		margin-top:392px;
		padding-left:70px;
		width:300px;
	}
	.bx07{
		font-size:10px;
		position:absolute;
		margin-top:392px;
		padding-left:250px;
		width:300px;
	}
	
	.bt01{
		font-size:10px;
		position:absolute;
		margin-top:292px;
		padding-left:500px;
		width:200px;
	}
	.bt02{
		font-size:10px;
		position:absolute;
		margin-top:324px;
		padding-left:530px;
		width:200px;
	}
	.bt03{
		font-size:10px;
		position:absolute;
		margin-top:358px;
		padding-left:450px;
		width:200px;
	}
	.bt04{
		font-size:10px;
		position:absolute;
		margin-top:391px;
		padding-left:430px;
		width:50px;
	}
	.bt05{
		font-size:10px;
		position:absolute;
		margin-top:391px;
		padding-left:485px;
		width:50px;
	}
	.bt06{
		font-size:10px;
		position:absolute;
		margin-top:391px;
		padding-left:540px;
		width:50px;
	}
	.bt07{
		font-size:10px;
		position:absolute;
		margin-top:391px;
		padding-left:605px;
		width:50px;
	}
	.bt08{
		font-size:10px;
		position:absolute;
		margin-top:391px;
		padding-left:670px;
		width:50px;
	}
	
	.m01{
		font-size:10px;
		position:absolute;
		margin-top:610px;
		padding-left:0px;
		width:300px;
	}
	.m02{
		font-size:10px;
		position:absolute;
		margin-top:610px;
		padding-left:350px;
		width:300px;
	}
	.m03{
		font-size:10px;
		position:absolute;
		margin-top:460px;
		padding-left:350px;
		width:300px;
	}
	</style>
	<div class="bgheader">'.substr($_POST['sv_id'],2).'</div>
	<div class="bbtxt1">'.$finfos['cd_name'].'</div>
	<div class="bbtxt2">'.$finfos['cd_address'].'&nbsp;'.province_name($conn,$finfos['cd_province']).'</div>
	<div class="bbtxt3">'.$finfos['cd_tel'].'</div>
	<div class="bbtxt31">'.$finfos['cd_fax'].'</div>
	<div class="bbtxt4">'.$finfos['c_contact'].'</div>
	<div class="bbtxt41">'.$finfos['c_tel'].'</div>
	
	<div class="bbtxt5">'.get_servicename($conn,$_POST['sr_ctype']).'&nbsp;&nbsp;&nbsp;&nbsp;'.custype_name($conn,$_POST['sr_ctype2']).'</div>
	<div class="bbtxt6">'.$finfos['fs_id'].'</div>
	<div class="bbtxt7">'.format_date($_POST['job_open']).'</div>
	<div class="bbtxt8">'.format_date($_POST['job_balance']).'</div>
	<div class="bbtxt9">'.$_POST['job_last'].'</div>
	<div class="bbtxt91">'.format_date($_POST['sr_stime']).'</div>
	
	<div class="bx01">'.$finfos['loc_name'].'</div>
	<div class="bx02">'.$_POST['loc_pro'].'</div>
	<div class="bx03">'.$_POST['loc_seal'].'</div>
	<div class="bx04">'.$_POST['loc_sn'].'</div>
	<div class="bx05">'.$_POST['loc_clean'].'</div>
	<div class="bx051">'.$_POST['loc_clean_sn'].'</div>
	<div class="bx06">'.$tecinfos['group_name'].'</div>
	<div class="bx07">'.$tecinfos['group_tel'].'</div>
	
	
	<div class="bt01">'.$_POST['cl_01'].'</div>
	<div class="bt02">'.$_POST['cl_02'].'</div>
	<div class="bt03">'.$_POST['cl_03'].'</div>
	<div class="bt04">'.$_POST['cl_04'].'</div>
	<div class="bt05">'.$_POST['cl_05'].'</div>
	<div class="bt06">'.$_POST['cl_06'].'</div>
	<div class="bt07">'.$_POST['cl_07'].'</div>
	<div class="bt08">'.$_POST['cl_08'].'</div>
	
	
	'.$sfix.'
	<div class="m01">'.$_POST['detail_recom'].'</div>
	<div class="m02">'.$_POST['detail_calpr'].'</div>
	';
?>


	

	
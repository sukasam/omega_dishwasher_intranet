<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	
	
	if ($_POST['mode'] <> "") { 
		
		$_POST['sr_stime'] = date("Y-m-d");
		$_POST['job_open'] = date("Y-m-d");
		$_POST['job_close'] = date("Y-m-d");
		$_POST['job_balance'] = date("Y-m-d");
		
		$_POST['cd_names'] = urldecode($_POST['cd_names']);
		$_POST['loc_pro'] = urldecode($_POST['loc_pro']);
		$_POST['loc_seal'] = urldecode($_POST['loc_seal']);
		$_POST['loc_sn'] = urldecode($_POST['loc_sn']);
		$_POST['technic_service'] = urldecode($_POST['technic_service']);
		$_POST['fo_id'] = urldecode($_POST['fo_id']);

		if ($_POST['mode'] == "add") { 

			$_POST['sv_id'] = check_servicereport($conn);
			$_POST['job_last'] = get_lastservice_s($conn,$_POST['cus_id'],"");
			$_POST['approve'] = 0;
			$_POST['supply'] = 0;
			$_POST['st_setting'] = 0;
			
		
			include "../include/m_add.php";
			
			$id = mysqli_insert_id($conn);
				
			include_once("../mpdf54/mpdf.php");
			
			include_once("form_serviceopen.php");
			$mpdf=new mPDF('UTF-8'); 
			$mpdf->SetAutoFont();
			$mpdf->WriteHTML($form);
			$chaf = str_replace("/","-",$_POST['sv_id']); 
			$mpdf->Output('../../upload/service_report_open/'.$chaf.'.pdf','F');
			
			//echo $_POST['sv_id'];
			
			@mysqli_query($conn,"INSERT INTO `service_schedule` (`id`, `month`, `year`, `technician`, `sv_id`, `fo_id`, `pdf`, `created`) VALUES (NULL, '".date("m")."', '".date("Y")."', '".$_POST['loc_contact']."', '".$_POST['sv_id']."', '".$_POST['fo_id']."', '".$chaf.".pdf', CURRENT_TIMESTAMP);");
			
			$pid = mysqli_insert_id($conn);
			
		}
		
		
	}
	;
?>
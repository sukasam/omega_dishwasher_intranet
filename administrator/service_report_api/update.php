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


		if ($_POST['mode'] == "add") { 
		
			
			$_POST['sv_id'] = check_servicereport("SR".date("Y/m/"));
			$_POST['job_last'] = get_lastservice_s($conn,$_POST['cus_id'],"");

			/*echo "<pre>";
			echo print_r($_POST);
			echo "</pre>";
			break;
			*/
			
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
			
			@mysqli_query($conn,"INSERT INTO `service_schedule` (`id`, `month`, `technician`, `sv_id`, `fo_id`, `pdf`, `created`) VALUES (NULL, '".date("m")."', '".$_POST['loc_contact']."', '".$_POST['sv_id']."', '".$_POST['fo_id']."', '".$chaf.".pdf', CURRENT_TIMESTAMP);");
			
			$pid = mysqli_insert_id($conn);
			
			
			
			//echo $pid;
			
			//header ("location:index.php?" . $param); 
		}
		/*if ($_POST['mode'] == "update" ) {
			
			$_POST['detail_recom'] = nl2br($_POST['detail_recom']);
			$_POST['detail_calpr'] = nl2br($_POST['detail_calpr']);
			
			$_POST['job_last'] = get_lastservice_f($conn,$_POST['cus_id'],$_POST['sv_id']);
			
			foreach ($_POST['ckf_list2'] as $value) {
				$checklist .= $value.',';
			}
			
			$_POST['ckf_list'] = substr($checklist,0,-1);
			
			$_POST['ckf_list'];
			 
			include ("../include/m_update.php");
			
			$id = $_REQUEST[$PK_field];			
				
			include_once("../mpdf54/mpdf.php");
			include_once("form_serviceopen.php");
			$mpdf=new mPDF('UTF-8'); 
			$mpdf->SetAutoFont();
			$mpdf->WriteHTML($form);
			$chaf = str_replace("/","-",$_POST['sv_id']); 
			$mpdf->Output('../../upload/service_report_open/'.$chaf.'.pdf','F');
			
			//header ("location:index.php?" . $param); 
		}*/
		
	}
	;
?>
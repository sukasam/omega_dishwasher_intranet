<?php 
	include_once ("../../include/config.php");
	include_once ("../../include/connect.php");
	include_once ("../../include/function.php");
	include_once ("config.php");
    //include_once("../mpdf54/mpdf.php");
	include_once('../vendor/autoload.php');

	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);


	$domain = $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
    $domain = str_replace("schedule","service_report_api",$domain);
    $domain = str_replace("createService","update",$domain);
	$url = $domain;
	

	$condition = "";
	$getMonth = $_GET['month']-1;

	

	$quGen = mysqli_query($conn,"SELECT * FROM service_schedule WHERE month = '".$getMonth."' AND technician = '".$_GET['loccontact']."'");
	$numCreated = mysqli_num_rows($quGen);

//	print_r();
//	exit();
	
	genFile($conn,$getMonth,$_GET['loccontact']);
	
	
	function genFile($conn,$getMonth,$loccontact){
		
		// and now we can use library
		$pdf = new \Jurosh\PDFMerge\PDFMerger;

		
		$quGen2 = mysqli_query($conn,"SELECT * FROM service_schedule WHERE month = '".$getMonth."' AND technician = '".$loccontact."'");
		 $numCreated2 = mysqli_num_rows($quGen2);
			
		
		 while($rowGen2 = mysqli_fetch_array($quGen2)){
			set_time_limit(0);
			$pdf->addPDF("../../upload/service_report_open/".$rowGen2['pdf'], 'all');
		 }

				// call merge, output format `file`
				$pdf->merge("file", "../../upload/schedule/service_report_".date("Y-m")."_".$loccontact.".pdf");

				//echo "<script>window.opener.location.reload();window.close();</script>";
				
				header("Location:../../upload/schedule/service_report_".date("Y-m")."_".$loccontact.".pdf");

//			if(file_exists("../../upload/schedule/service_report_".date("Y-m")."_".$loccontact.".pdf") == ""){
//				 while($rowGen2 = mysqli_fetch_array($quGen2)){
//					 set_time_limit(0);
//					$pdf->addPDF("../../upload/service_report_open/".$rowGen2['pdf'], 'all');
//				 }
//
//				// call merge, output format `file`
//				$pdf->merge("file", "../../upload/schedule/service_report_".date("Y-m")."_".$loccontact.".pdf");
//
//				//echo "<script>window.opener.location.reload();window.close();</script>";
//				
//				header("Location:../../upload/schedule/service_report_".date("Y-m")."_".$loccontact.".pdf");
//
//			}else{
//				header("Location:../../upload/schedule/service_report_".date("Y-m")."_".$loccontact.".pdf");
//				//echo "HAVE";
//				//echo "<script>window.opener.location.reload();window.close();</script>";
//			}
	}
  


?>
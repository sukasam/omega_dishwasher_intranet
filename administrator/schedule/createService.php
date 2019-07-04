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
	
	
	if($numCreated == 0){
		
		if($getMonth % 2 == 0){
			$condition.= " AND type_service != 31";
		}else{
			$condition.= " AND type_service != 1";
		}

		if($getMonth != 3 && $getMonth != 6 && $getMonth != 9 && $getMonth != 12){
			$condition.= " AND type_service != 2";
		}

		if($getMonth != 4 && $getMonth != 8 && $getMonth != 12){
			$condition.= " AND type_service != 3";
		}

		$sqlSched = "SELECT * FROM `s_first_order` WHERE `technic_service` = ".$_GET['loccontact'].$condition." ORDER BY `cd_province` ,`loc_name` ASC;";

		$quSched = mysqli_query($conn,$sqlSched);

		$runRow = 1;
		  while($rowSched = mysqli_fetch_array($quSched)){
			  
			  set_time_limit(0);
			  
			  //echo $runRow++." => ".$rowSched['cpro2']."<br>";
			  //exit();
			  
			  if($rowSched['cpro2'] == 1 || $rowSched['cpro2'] == 2 || $rowSched['cpro2'] == 99 || $rowSched['cpro2'] == 148 || $rowSched['cpro2'] == 201){

				  if($rowSched['cpro1'] == 147){
					  if($getMonth == 3 || $getMonth == 6 || $getMonth == 9 || $getMonth == 12){

						   $fields = array(
								'cd_names' => urlencode($rowSched['cd_name']),
								'cus_id' => urlencode($rowSched['fo_id']),
								'sr_ctype' => urlencode($rowSched['type_service']),
								'sr_ctype2' => urlencode($rowSched['ctype']),
								'bbfpro' => urlencode("0"),
								'loc_pro' => urlencode(get_proname($conn,$rowSched['cpro1'])),
								'loc_seal' => urlencode($rowSched['pro_pod1']),
								'loc_sn' => urlencode($rowSched['pro_sn1']),
								'loc_contact' => urlencode($rowSched['technic_service']),
								'fo_id' => urlencode($rowSched['fs_id']),
							    'loc_clean' => urlencode($rowSched['loc_clean']),
							    'loc_clean_sn' => urlencode($rowSched['loc_clean_sn']),
								'mode' => urlencode("add"),
								'page' => urlencode("1"),
							);

							//url-ify the data for the POST
							foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
							rtrim($fields_string, '&');

							//open connection
							$ch = curl_init();

							//set the url, number of POST vars, POST data
							curl_setopt($ch,CURLOPT_URL, $url);
							curl_setopt($ch,CURLOPT_POST, count($fields));
							curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

							//execute post
							$result = curl_exec($ch);

							//close connection
							curl_close($ch);
					  }
				  }else{

						  $fields = array(
								'cd_names' => urlencode($rowSched['cd_name']),
								'cus_id' => urlencode($rowSched['fo_id']),
								'sr_ctype' => urlencode($rowSched['type_service']),
								'sr_ctype2' => urlencode($rowSched['ctype']),
								'bbfpro' => urlencode("0"),
								'loc_pro' => urlencode(get_proname($conn,$rowSched['cpro1'])),
								'loc_seal' => urlencode($rowSched['pro_pod1']),
								'loc_sn' => urlencode($rowSched['pro_sn1']),
								'loc_contact' => urlencode($rowSched['technic_service']),
								'fo_id' => urlencode($rowSched['fs_id']),
							  	'loc_clean' => urlencode($rowSched['loc_clean']),
							    'loc_clean_sn' => urlencode($rowSched['loc_clean_sn']),
								'mode' => urlencode("add"),
								'page' => urlencode("1"),
							);

							//url-ify the data for the POST
							foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
							rtrim($fields_string, '&');

							//open connection
							$ch = curl_init();

							//set the url, number of POST vars, POST data
							curl_setopt($ch,CURLOPT_URL, $url);
							curl_setopt($ch,CURLOPT_POST, count($fields));
							curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

							//execute post
							$result = curl_exec($ch);

							//close connection
							curl_close($ch);

				  }

				  if($rowSched['cpro2'] == 147){
					  if($getMonth == 3 || $getMonth == 6 || $getMonth == 9 || $getMonth == 12){

							$fields = array(
								'cd_names' => urlencode($rowSched['cd_name']),
								'cus_id' => urlencode($rowSched['fo_id']),
								'sr_ctype' => urlencode($rowSched['type_service']),
								'sr_ctype2' => urlencode($rowSched['ctype']),
								'bbfpro' => urlencode("1"),
								'loc_pro' => urlencode(get_proname($conn,$rowSched['cpro2'])),
								'loc_seal' => urlencode($rowSched['pro_pod2']),
								'loc_sn' => urlencode($rowSched['pro_sn2']),
								'loc_contact' => urlencode($rowSched['technic_service']),
								'fo_id' => urlencode($rowSched['fs_id']),
								'loc_clean' => urlencode($rowSched['loc_clean']),
							    'loc_clean_sn' => urlencode($rowSched['loc_clean_sn']),
								'mode' => urlencode("add"),
								'page' => urlencode("1"),
							);

							//url-ify the data for the POST
							foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
							rtrim($fields_string, '&');

							//open connection
							$ch = curl_init();

							//set the url, number of POST vars, POST data
							curl_setopt($ch,CURLOPT_URL, $url);
							curl_setopt($ch,CURLOPT_POST, count($fields));
							curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

							//execute post
							$result = curl_exec($ch);

							//close connection
							curl_close($ch);

					  }
				  }else{
							$fields = array(
								'cd_names' => urlencode($rowSched['cd_name']),
								'cus_id' => urlencode($rowSched['fo_id']),
								'sr_ctype' => urlencode($rowSched['type_service']),
								'sr_ctype2' => urlencode($rowSched['ctype']),
								'bbfpro' => urlencode("1"),
								'loc_pro' => urlencode(get_proname($conn,$rowSched['cpro2'])),
								'loc_seal' => urlencode($rowSched['pro_pod2']),
								'loc_sn' => urlencode($rowSched['pro_sn2']),
								'loc_contact' => urlencode($rowSched['technic_service']),
								'fo_id' => urlencode($rowSched['fs_id']),
								'loc_clean' => urlencode($rowSched['loc_clean']),
							    'loc_clean_sn' => urlencode($rowSched['loc_clean_sn']),
								'mode' => urlencode("add"),
								'page' => urlencode("1"),
							);

							//url-ify the data for the POST
							foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
							rtrim($fields_string, '&');

							//open connection
							$ch = curl_init();

							//set the url, number of POST vars, POST data
							curl_setopt($ch,CURLOPT_URL, $url);
							curl_setopt($ch,CURLOPT_POST, count($fields));
							curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

							//execute post
							$result = curl_exec($ch);

							//close connection
							curl_close($ch);

				  }


			  }else{
				
							$fields = array(
								'cd_names' => urlencode($rowSched['cd_name']),
								'cus_id' => urlencode($rowSched['fo_id']),
								'sr_ctype' => urlencode($rowSched['type_service']),
								'sr_ctype2' => urlencode($rowSched['ctype']),
								'bbfpro' => urlencode("0"),
								'loc_pro' => urlencode(get_proname($conn,$rowSched['cpro1'])),
								'loc_seal' => urlencode($rowSched['pro_pod1']),
								'loc_sn' => urlencode($rowSched['pro_sn1']),
								'loc_contact' => urlencode($rowSched['technic_service']),
								'fo_id' => urlencode($rowSched['fs_id']),
								'loc_clean' => urlencode($rowSched['loc_clean']),
							    'loc_clean_sn' => urlencode($rowSched['loc_clean_sn']),
								'mode' => urlencode("add"),
								'page' => urlencode("1"),
							);

							//url-ify the data for the POST
							foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
							rtrim($fields_string, '&');
				  			
//				  	 

							//open connection
							$ch = curl_init();

							//set the url, number of POST vars, POST data
							curl_setopt($ch,CURLOPT_URL, $url);
							curl_setopt($ch,CURLOPT_POST, count($fields));
							curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

							//execute post
							echo $result = curl_exec($ch);

							//close connection
							curl_close($ch); 
				  	//echo $url;
     				//exit();

			 }

		  }
		 
		  //sleep(3);
		  //genFile($getMonth,$_GET['loccontact']);
		
		echo "<script>window.opener.location.reload();window.close();</script>";
		 

		}else{
			
			genFile($conn,$getMonth,$_GET['loccontact']);
			
		}
	
	
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
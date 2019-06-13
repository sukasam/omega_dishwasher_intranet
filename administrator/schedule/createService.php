<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
    include_once("../mpdf54/mpdf.php");

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

		  }
		 
		  //sleep(3);
		  //genFile($getMonth,$_GET['loccontact']);
		
		echo "<script>window.opener.location.reload();window.close();</script>";
		 

		}else{
		
			genFile($getMonth,$_GET['loccontact']);
			

		}
	
	
	function genFile($getMonth,$loccontact){
		
		function mergePDFFiles(Array $filenames, $outFile) {
			$mpdf = new mPDF();
			if ($filenames) {
				//  print_r($filenames); die;
				$filesTotal = sizeof($filenames);
				$fileNumber = 1;
				$mpdf->SetImportUse();
				if (!file_exists($outFile)) {
					$handle = fopen($outFile, 'w');
					fclose($handle);
				}
				foreach ($filenames as $fileName) {
					if (file_exists($fileName)) {
						$pagesInFile = $mpdf->SetSourceFile($fileName);
						//print_r($fileName); die;
						for ($i = 1; $i <= $pagesInFile; $i++) {
							$tplId = $mpdf->ImportPage($i);
							$mpdf->UseTemplate($tplId);
							if (($fileNumber < $filesTotal) || ($i != $pagesInFile)) {
								$mpdf->WriteHTML('<pagebreak />');
							}
						}
					}
					$fileNumber++;
				}
				$mpdf->Output($outFile, 'D');
			}
		}
		
		$quGen2 = mysqli_query($conn,"SELECT * FROM service_schedule WHERE month = '".$getMonth."' AND technician = '".$loccontact."'");
		 $numCreated2 = mysqli_num_rows($quGen2);


			$newArray = array();

			if($numCreated2 > 0){
				 while($rowGen2 = mysqli_fetch_array($quGen2)){
					$newArray[] = "../../upload/service_report_open/".$rowGen2['pdf'];
				 }
				mergePDFFiles($newArray,"service_report_".date("Y-m")."_".$loccontact.".pdf");

				echo "<script>window.opener.location.reload();window.close();</script>";

			}else{
				echo "<script>window.opener.location.reload();window.close();</script>";
			}
	}
  


?>
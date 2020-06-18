<?php 
//	include_once ("../../include/config.php");
	include_once ("../../include/connect.php");
    include_once ("../../include/function.php");
	include_once('../vendor/autoload.php');

	$domain = $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
    $domain = str_replace("conjobs","service_report_api",$domain);
    $domain = str_replace("createService","update",$domain);
	$url = $domain;
	
	if(isset($_GET['month']) && isset($_GET['year']) && isset($_GET['loccontact'])){

		$condition = "";
		$getMonth = $_GET['month'];
		$getYear = $_GET['year'];

		$quGen = mysqli_query($conn,"SELECT * FROM service_schedule WHERE month = '".$getMonth."' AND technician = '".$_GET['loccontact']."' AND year = '".$getYear."'");
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
			
			$condition.= " AND `type_service` != '0' AND `process` >= '4'";

			$sqlSched = "SELECT * FROM `s_first_order` WHERE `technic_service` = ".$_GET['loccontact'].$condition." AND status_use != '2' ORDER BY `cd_province` ,`loc_name` ASC;";

			$quSched = mysqli_query($conn,$sqlSched);

			$runRow = 1;

			  while($rowSched = mysqli_fetch_array($quSched)){

				  set_time_limit(0);
				  sleep(1);

	//			  echo $runRow++." => ".$rowSched['cpro2']."<br>".$url;
	//			  exit();

				  if($rowSched['cpro2'] == 1 || $rowSched['cpro2'] == 2 || $rowSched['cpro2'] == 99 || $rowSched['cpro2'] == 148 || $rowSched['cpro2'] == 201){

					  if($rowSched['cpro1'] == 147){
						  if($getMonth == 3 || $getMonth == 6 || $getMonth == 9 || $getMonth == 12){

							  // Get cURL resource
							$curl = curl_init();
							// Set some options - we are passing in a useragent too here
							curl_setopt_array($curl, [
								CURLOPT_RETURNTRANSFER => 1,
								CURLOPT_URL => $url,
								CURLOPT_USERAGENT => 'Codular Sample cURL Request',
								CURLOPT_POST => 1,
								CURLOPT_POSTFIELDS => [
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
								]
							]);
							// Send the request & save response to $resp
							$resp = curl_exec($curl);
							// Close request to clear up some resources
							curl_close($curl);


						  }
					  }else{

						   // Get cURL resource
							$curl = curl_init();
							// Set some options - we are passing in a useragent too here
							curl_setopt_array($curl, [
								CURLOPT_RETURNTRANSFER => 1,
								CURLOPT_URL => $url,
								CURLOPT_USERAGENT => 'Codular Sample cURL Request',
								CURLOPT_POST => 1,
								CURLOPT_POSTFIELDS => [
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
								]
							]);
							// Send the request & save response to $resp
							$resp = curl_exec($curl);
							// Close request to clear up some resources
							curl_close($curl);

					  }

					  if($rowSched['cpro2'] == 147){
						  if($getMonth == 3 || $getMonth == 6 || $getMonth == 9 || $getMonth == 12){

							 // Get cURL resource
							$curl = curl_init();
							// Set some options - we are passing in a useragent too here
							curl_setopt_array($curl, [
								CURLOPT_RETURNTRANSFER => 1,
								CURLOPT_URL => $url,
								CURLOPT_USERAGENT => 'Codular Sample cURL Request',
								CURLOPT_POST => 1,
								CURLOPT_POSTFIELDS => [
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
								]
							]);
							// Send the request & save response to $resp
							$resp = curl_exec($curl);
							// Close request to clear up some resources
							curl_close($curl);

						  }
					  }else{

								// Get cURL resource
							$curl = curl_init();
							// Set some options - we are passing in a useragent too here
							curl_setopt_array($curl, [
								CURLOPT_RETURNTRANSFER => 1,
								CURLOPT_URL => $url,
								CURLOPT_USERAGENT => 'Codular Sample cURL Request',
								CURLOPT_POST => 1,
								CURLOPT_POSTFIELDS => [
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
								]
							]);
							// Send the request & save response to $resp
							$resp = curl_exec($curl);
							// Close request to clear up some resources
							curl_close($curl);

					  }


				  }else{


							// Get cURL resource
							$curl = curl_init();
							// Set some options - we are passing in a useragent too here
							curl_setopt_array($curl, [
								CURLOPT_RETURNTRANSFER => 1,
								CURLOPT_URL => $url,
								CURLOPT_USERAGENT => 'Codular Sample cURL Request',
								CURLOPT_POST => 1,
								CURLOPT_POSTFIELDS => [
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
								]
							]);
							// Send the request & save response to $resp
							$resp = curl_exec($curl);
							// Close request to clear up some resources
							curl_close($curl);

	//				  	echo $url;
	//     				exit();


				 }

			  }
			
				echo "GEN DONE";


			}else{

				//genFile($conn,$getMonth,$_GET['loccontact'],$getYear);
				echo "ALREADY GEN";

			}

	}else{
		echo "ERRORS";
	}
  


?>
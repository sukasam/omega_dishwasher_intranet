<?php
//	include_once ("../../include/config.php");
	date_default_timezone_set("Asia/Bangkok");
	include_once ("../../include/connect.php");
	
	 $qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
	
     $dateMGen = date("m");
	 //$dateMGen = 11;
	 $dateYGen = date("Y");

	 $domain = $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
     $domain = str_replace("index","createService",$domain);
	
	 $numRun = 1;

	  while($row_custec = @mysqli_fetch_array($qu_custec)){
		  
		 set_time_limit(0);
		  
		 $url = $domain.'?month='.$dateMGen.'&year='.$dateYGen.'&loccontact='.$row_custec['group_id'];
		 //$url = $domain.'?month='.$dateMGen.'&year='.$dateYGen.'&loccontact=0';
		  
		//  echo $url;
    	//  exit();

		 //echo $row_custec['group_id']."<br>";
		 // Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, [
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		]);
		// Send the request & save response to $resp
		echo $resp = curl_exec($curl);
		// Close request to clear up some resources
		curl_close($curl);
		  
		$resultfile = fopen("resultGENPDF.txt", "a") or die("Unable to open file!");
		$txt = trim($resp).' => '.$row_custec['group_id'] .' ('.$row_custec['group_name'].')'." => ".date("Y-m-d H:i:s")."\n";
				
		fwrite($resultfile, $txt);
				
		fclose($resultfile);
		  
		sleep(1);
		 
		if($numRun >= 1){
			 //exit();
		}else{
			$numRun++;
		}

	  }
?>
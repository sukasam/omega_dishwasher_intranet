<?php
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	$qu = mysql_query("SELECT * FROM s_service_report2 WHERE srid !=''");
	while($row = mysql_fetch_array($qu)){
		
		$rowReplace = str_replace("","SR",$row['srid']);
		$rowReplace1 = str_replace("SR ","SR",$row['srid']);
		$rowReplace2 = str_replace("SR","SR ",$rowReplace1);
		$rowReplace3 = str_replace("59/","SR 59/",$rowReplace2);
		$rowReplace4 = str_replace("SR SR 59/","SR 59/",$rowReplace3);
		/*$rowReplace5 = str_replace("60/","SR 60/",$rowReplace4);
		$rowReplace6 = str_replace("SR SR 60/","SR 60/",$rowReplace5);
		$rowReplace7 = str_replace("SR SR 60","SR 60",$rowReplace6);*/
		
		
		//echo strtoupper($rowReplace4)."<br>";
		
		$qo2 = mysql_query("SELECT * FROM s_service_report WHERE sv_id = '".$rowReplace4."'");
		$row2 = mysql_fetch_array($qo2);
		
		if($row2['sr_id'] != ""){
			@mysql_query("UPDATE `s_service_report2` SET `srid` = '".$row2['sr_id']."' WHERE `s_service_report2`.`sr_id` = '".$row['sr_id']."';");
			//echo "UPDATE `s_service_report2` SET `srid` = '".$row2['sr_id']."' WHERE `s_service_report2`.`sr_id` = '".$row['sr_id']."';";
			//exit();
		}
		
		/*exit();*/
	}
echo "done";
?>
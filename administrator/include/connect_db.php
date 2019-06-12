<?php  session_start();
	
	$file_ADODB="adodb/adodb.inc.php";
	if (file_exists($file_ADODB))
	 {
		include_once('adodb/adodb.inc.php');
	}else{
		include_once('../adodb/adodb.inc.php');
	}
	global $db;
		$db = ADONewConnection('mysql');
		$server = "localhost";
		$user = "root";//aarhuspuls
		$password = "";//aarhuspuls
		$database = "aarhuspuls";//aarhuspuls
	$db->Connect($server,$user,$password,$database) or die(" :".$db->Errorno()." : ".$db->ErrorMsg());
	$db->Execute('set names utf8');
	

?>

<?php  

	$conn = mysql_connect("localhost","root","") or die("connection to db fail");
	mysql_select_db("omega_intranet");
	@mysql_query("SET NAMES UTF8");
	
?>
<?php  
	include ("../include/config.php");
	include ("../include/connect.php");
	include ("../include/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Separate FO&amp;SR</title>
</head>

<body>

<?php  
	$qu_fq = @mysqli_query($conn,"SELECT * FROM s_first_order ORDER BY fo_id DESC");
	while($row_fq = mysqli_fetch_array($qu_fq)){
		if(substr($row_fq['fs_id'],0,2) == "SV"){
			@mysqli_query($conn,"UPDATE `omega_intranet`.`s_first_order` SET `separate` = '1' WHERE `s_first_order`.`fo_id` ='".$row_fq['fo_id']."' LIMIT 1 ;");
		}
	}
	echo "Update Success";
?>

</body>
</html>
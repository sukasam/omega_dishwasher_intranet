<?php 
	include_once("../../include/aplication_top.php");
	header("Content-type: text/html; charset=utf8");
	header("Cache-Control: no-cache, must-revalidate");
	@mysql_query("SET NAMES  UTF8");
	
	if($_GET['action'] == 'getcus'){
		$cd_name = $_REQUEST['pval'];
		if($cd_name != ""){
			$consd = "WHERE cd_name LIKE '%".$cd_name."%'";
		}
		$qu_cus = mysql_query("SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC");
		while($row_cus = @mysql_fetch_array($qu_cus)){
			?>
			 <tr>
				<td><A href="javascript:void(0);" onclick="get_customer('<?php  echo $row_cus['fo_id'];?>','<?php  echo $row_cus['cd_name'];?>');"><?php  echo $row_cus['cd_name'];?></A></td>
			  </tr>
			<?php 	
		}
		//echo "SELECT cd_name FROM s_first_order ".$consd." ORDER BY cd_name ASC";
	}
?>


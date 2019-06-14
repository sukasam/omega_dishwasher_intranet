<?php 
	$query = @mysqli_query($conn,$sql);
	$all_row = @mysqli_num_rows($query);
// ######### หาจำนวนหน้าทั้งหมด #########
	if (isset($page)=="") {
		$page = 1;
	}

	$mod_page = $all_row%$pagesize;
	if ($mod_page==0) { 
		$pagecount = floor($all_row/$pagesize);	} else { $pagecount = floor($all_row/$pagesize)+1; 
	}

	$start = ($_REQUEST['page'] -1)*$pagesize;
	$sql = $sql . " limit $start, $pagesize";
?>
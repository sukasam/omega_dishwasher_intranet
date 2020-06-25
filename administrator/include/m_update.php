<?php 
		$sqlIns = "update  $tbl_name set  ";
		while(list(,$s_key) = each($fieldlist)){
			$fieldname .=", " .  $s_key . " =  '" .$_POST[$s_key]  . "'" ;
		}
		$fieldname = substr ($fieldname,1, strlen ($fieldname));
		$valuename = substr ($valuename,1, strlen ($fieldname));
		$sqlIns .= $fieldname  ;
		$sqlIns .= ", update_date = '" . date ("Y-m-d H:m:s") . "'";
		$sqlIns .= ", update_by = '" . $_SESSION["login_id"] .  "'";
		$sqlIns .= " where $PK_field = '" . $_REQUEST[$PK_field] . "'";
		//  echo $sqlIns;
		//  exit();
		@mysqli_query($conn,$sqlIns);
		$id = $$PK_field;
		?>

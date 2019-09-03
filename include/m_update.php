<?php 
		$sql = "update  $tbl_name set  ";
			 while(list(,$s_key) = each($fieldlist))
		{
				
				$fieldname .=", " .  $s_key . " =  '" .$_POST[$s_key]  . "'" ;
		}
		$fieldname = substr ($fieldname,1, strlen ($fieldname));
		$valuename = substr ($valuename,1, strlen ($fieldname));
		$sql .= $fieldname  ;
		$sql .= ", update_date = '" . date ("Y-m-d H:m:s") . "'";
		$sql .= ", update_by = '" . $_SESSION["login_name"] .  "'";
		$sql .= " where $PK_field = '" . $_REQUEST[$PK_field] . "'";
//		echo $sql;
//		exit();
		@mysqli_query($conn,$sql);
		$id = $$PK_field;
		?>

<?php
		$field = $value = "";
		reset($fieldlist);
			 while(list(,$s_key) = each($fieldlist))
			 {
				  $field .= ", " . $s_key;
				  $value .= ", '" . $_POST[$s_key] . "'";
			}
		$field = substr ($field,1, strlen ($field));
		$field .= " ,create_date, create_by ";
		$value = substr ($value,1, strlen ($value));
		$value .= ",'" . date ("Y-m-d H:i:s")  . "', '" . $_SESSION["login_id"] . "'";
		$sqlIns = "insert into $tbl_name ( " . $field . ")  values (". $value . ")";
		//  echo $sqlIns;
		//  exit();
		@mysqli_query($conn,$sqlIns);
		$id = mysqli_insert_id ($conn);

		?>

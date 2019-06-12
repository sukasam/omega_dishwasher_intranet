<?php 
/* ******************* 
Last Revised : 1 Dec, 2006
/* ******************* 

Check_Permission ($check_module,$user_id,$action)
Cal_Age($date)
Show_Data ($tbl_name, $key, $value, $fieldname)
Show_Full_Category ($value)
Update_Transaction_DateTime ($sql, $mode)
date_format ($create_date) 
CheckBox ($box_name, $value) 
CmdDropDown ($sql, $box_name, $fieldkey, $value, $fieldshow) 
CmdListBox ($sql, $box_name, $fieldkey, $value, $fieldshow) 
CheckData ($value) 
Show_Sort ($orderby, $cn,  $field_select, $sortby,$page) 
Show_Sort_bg ($field) 
Msg_Error ("Login or password not found")
function calculate_price($cart)
function calculate_items($cart)
function get_product_detail ($product_id) 
function NumToThai($value) 
function gen_random ($length)
function show_check($str) 
function format_date_th ($value,$type) 
function format_date_en ($value,$type) 
function Show_Text ($label,$value) 
function Delete_Photo ($path, $value)
function Upload_Photo ($file, $path, $size, $value)
function Show_Choice ($select_name, $list_array , $value) { 
function Show_Choice_month ($select_name, $list_array , $value) { 
function Cal_Age($date)
function uploadfile($path,$filename,$file,$sizes,$rotate, $quality)
function make_thumb($input_file_name, $input_file_path,$width,$quality)
function Toggle ($value, $tbl_name, $field, $field_change) { 
function get_product_details($product_id)
function Show_Image ($ref_id, $gallery_group, $flag) { 
function Get_Point($member_id){
**********************/
function Show_Image ($ref_id, $gallery_group, $flag, $size) { 
		  $sql = "select * from gallery where ref_id = '$ref_id' and gallery_group = '$gallery_group'";
		  $query  = @mysql_query($sql);
 		  while ($rec  = @mysql_fetch_array ($query)) { 
		  		$filename = "upload/" . $gallery_group . "/" . $rec["gallery_id"] . "_$size.jpg";
 			   if (file_exists ($filename)) {
				$msg = '<img src="' . $filename . '" border="0">';
			   }
		  	}
			return $msg;
}


function get_product_details($product_id)
{
  if (!$product_id || $product_id=="")
     return false;
   $query = "select * from product where product_id='$product_id'";
    $result = @mysql_query($query);
   if (!$result)
     return false;
   $result = @mysql_fetch_array($result);
   return $result;
}	

function Toggle ($value, $tbl_name, $field, $field_change) { 
		$sql = "select * from " . $tbl_name . " where " . $field . " = '$value'";
		$query = @mysql_query ($sql);
		if ($rec = @mysql_fetch_array ($query)) {
			if ($rec[$field_change] == "" || $rec[$field_change] == "0") {  $status = '1'; }  else { $status = ''; }
			$sql = "update  " . $tbl_name . " set " . $field_change . "  = '$status'  where " . $field . " = '$value'";
			@mysql_query ($sql);
			//echo $sql;
 		}
} 
function Cal_Age($birthdate){
   list($dob_year, $dob_month, $dob_day) = explode('-', $birthdate);
   $cur_year  = date('Y');
   $cur_month = date('m');
   $cur_day  = date('d');
   if($cur_month >= $dob_month && $cur_day >= $dob_day) {
       $age = $cur_year - $dob_year;
   }
   else {
       $age = $cur_year - $dob_year - 1;
   }
   echo $age;
}

function Show_Choice ($select_name, $list_array , $prefer_location) { 
		$msg = '<select name="' . $select_name . '">';
		$msg .= '<option value="">Select One</option> ' ;
		  foreach ($list_array as $value)  { 
			if (substr ($value,0,1) == "-") { $msg .= '<option value="" ' ;
			} else 
			{
			$msg .= '<option value="' .  $value . '" ' ;
			}			
			 if ($prefer_location == $value ) { $msg .=  ' selected '  ;} 
			$msg .= '> ' .  $value . '</option>';
		 } 
         $msg .= '</select>';
		 echo $msg;
}
function Show_Choice_month ($select_name, $list_array , $prefer_location) { 
		$msg = '<select name="' . $select_name . '">';
		$msg .= '<option value="">--?????--</option> ' ;
		  foreach ($list_array as $value)  { 
			if (substr ($value,0,1) == "-") { $msg .= '<option value="" ' ;
			} else 
			{
			$msg .= '<option value="' .  $value . '" ' ;
			}			
			 if ($prefer_location == $value ) { $msg .=  ' selected '  ;} 
			$msg .= '> ' .  $value . '</option>';
		 } 
         $msg .= '</select>';
		 echo $msg;
}
function Upload_Photo ($file, $path, $size, $value){
		if ($file <> "") { 
			$path="../../upload/" . $path . "/" . $size . "/";
			$filename=$value . ".jpg";
			copy ($file, $path . $filename);
		}
}
function Delete_Photo ($path, $value){
	$delete_file = "../../upload/" . $path . "/small/" . $value . ".jpg";
	if (file_exists($delete_file)) unlink ($delete_file);
	$delete_file = "../../upload/" . $path . "/large/" . $value . ".jpg";
	if (file_exists($delete_file)) unlink ($delete_file);
}
function Show_Text ($label,$value) { 
	if (trim ($value == "") ) {
	
	}else
	{
		echo "<strong>$label</strong>$value";
	}
}
function format_date_en ($value,$type) { 
	list ($s_date,$s_time)  = split (" ", $value);
	list ($s_year, $s_month, $s_day) = split ("-", $s_date);
	list ($s_hour, $s_minute, $s_second) = split (":", $s_time);
	$s_month +=0;
	$s_day += 0;
	if ($s_day == "0") return "";
	$mktime = mktime ($s_hour, $s_minute, $s_second, $s_month, $s_day, $s_year);
	switch ($type) { 
		case "1" :  // Friday 11 November 2005
			$msg = date ("l d F Y", $mktime);
			break;
		case "2" :  // 11 Nov 05 
			$msg = date ("d M y", $mktime);
			break;
		case "3" :  // Friday 11 November 2005 00:11 
			$msg = date ("l d F Y H:m", $mktime);
			break;
		case "4" :  // 11 Nov 05 00:11 
			$msg = date ("d M y  H:m", $mktime);
			break;
		case "5" :  // 11 Nov 05 00:11 
			$msg = date ("d M Y", $mktime);
			break;
		}
	return ($msg);
}
function format_date_th ($value,$type) { 
	if (strlen ($value) > 10) { 
			list ($s_date,$s_time)  = split (" ", $value);
			list ($s_year, $s_month, $s_day) = split ("-", $s_date);
			list ($s_hour, $s_minute, $s_second) = split (":", $s_time);
	}
	else 
	{
			list ($s_year, $s_month, $s_day) = split ("-", $value);
	}
	$s_month +=0;
	$s_day += 0;
	if ($s_day == "0") return "";
	$s_year += 543;
	$month_full_th = array ('','มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม',' กันยายน', 'ตุลาคม', 'พฤศจิกายน','ธันวาคม');
	$month_brief_th = array ('','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
	$day_of_week = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์"); 
	switch ($type) { 
		case "1" : // ?????? 4 ????????? 2548
			$msg = "วันที่ ". $s_day . " " .  $month_full_th[$s_month]  . " " .  $s_year ;
			break;
		case "2" :  // 4 ?.?. 2548
			$msg =  $s_day . " " .  $month_brief_th[$s_month]  . " " .  $s_year ;
			break;
		case "3" :  // ?????? 4 ????????? 2548 ???? 14.11 ?.
			$msg = "?????? ". $s_day . " " .  $month_full_th[$s_month]  . " " .  $s_year . " ???? " . $s_hour . "." . $s_minute . " ?." ;
			break;
		case "4" :  // 4 ?.?. 2548 14.11 ?. 
			$msg =  $s_day . " " .  $month_brief_th[$s_month]  . " " .  $s_year . "  " . $s_hour . "." . $s_minute . " ?." ;
			break;
		case "5" :  // 4 ?.?. 2548  
			$msg =  $s_day . " " .  $month_brief_th[$s_month]   . " " .  $s_year  ;
			break;
		case "6" :  // 4 ก.พ. 51
			$msg =  $s_day . " " .  $month_brief_th[$s_month]   . " " .  substr($s_year,-2)  ;
			break;
		}
	return ($msg);

}

function format_date_th2($value){
	$date = explode("-",$value);
	$month_full_th = array ('','มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม',' กันยายน', 'ตุลาคม', 'พฤษจิกายน','ธันวาคม');
	$text = (int)$date[2]." ".$month_full_th[$date[1]]." ".($date[0]);
	return($text);
}


function gen_random ($length)
{
	$keychars = "abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ23456789";
	
	// RANDOM KEY GENERATOR
	$randkey = "";
	$max=strlen($keychars)-1;
	for ($i=0;$i<=$length;$i++) {
	  $randkey .= substr($keychars, rand(0, $max), 1);
	}
	return $randkey;

}
function show_check($str) 
{
	$str = trim($str);
	if ($str == "1") $msg =  "<img src = '../images/check1.gif'>";
	if ($str == "" || $str == "0") $msg  = "<img src = '../images/check0.gif'>";
	echo $msg;
}
function NumToThai($value) 
{ 
  // Constant Variable 
  $Unit = Array("", "???", "????", "???", "?????", "???" , "????"); 
  $No  = Array("?????", "????", "??", "???", "???", "???", "??", "????", "???", "????"); 

  // Prepare Variable 
  $NumToThai = ""; 
  $Pos    = 0; 

 list ($Number, $Satang)  = split ("[.]", $value);
  // Process 
  while ($Number > 0 ) 
  { 
    $LastDigit = $Number%10; 

    if ($Pos == 0 && $LastDigit == 1 && $Number > 1) 
      $NumToThai = "????"; 
    elseif ($Pos == 1 && $LastDigit == 1) 
      $NumToThai = "???" . $NumToThai; 
    elseif ($Pos == 1 && $LastDigit == 2) 
      $NumToThai = "??????" . $NumToThai; 
    elseif ($LastDigit != 0) 
      $NumToThai = $No[$LastDigit] . $Unit[$Pos] . $NumToThai; 

    $Number = (int)($Number/10); 
    $Pos  = $Pos+1; 
  } 
	$msg  = $NumToThai .  "???"; 
	if ($Satang+0 == 0) 	$msg  .= "???"; 
// ***************
if ($Satang > 0) {
  $Pos    = 0; 
		$Number = $Satang;
		$NumToThai = "";
		   while ($Number > 0 ) 
			  { 
				$LastDigit = $Number%10; 
				if ($Pos == 0 && $LastDigit == 1 && $Number > 1) 
				  $NumToThai = "????"; 
				elseif ($Pos == 1 && $LastDigit == 1) 
				  $NumToThai = "???" . $NumToThai; 
				elseif ($Pos == 1 && $LastDigit == 2) 
				  $NumToThai = "??????" . $NumToThai; 
				elseif ($LastDigit != 0) 
				  $NumToThai = $No[$LastDigit] . $Unit[$Pos] . $NumToThai; 
			
				$Number = (int)($Number/10); 
				$Pos  = $Pos+1; 
			  } 	
			  $msg  .= $NumToThai .  "?????"; 

	}


// *****************
  if ($NumToThai == "") 
    $NumToThai = "-"; 

  return $msg; 
}
function  convert_price($number)
	{
$num =array('?????','????','??','???','???','???','??','????','???','????'); 
$unit = array('','???','????','???','?????','???','????'); 
$number = explode(".",$number); 
$c_num = $n = strlen($number[0]); 
for($i=0;$i< $c_num;$i++){ 
		$n--; 
		$c_digit = substr($number[0],$i,1); 
		if($c_digit != '0' || $n=='6'){ 
		if ($c_digit=='2'&&$n=='1') $convert .= '???'; 
		elseif ($c_digit=='1'&&$n=='1') $convert .= ''; 
		else $convert .= $num[$c_digit]; 
		$convert .= $unit[$n]; 
} 
} 
return $convert; 
	} 
	
function calculate_price($cart)
{
  $price = 0.0;
  if(is_array($cart))
  {
 // $conn = connect_db("thaigoodstuff");
  foreach($cart as $product_id => $qty)
 {  
    $query = "select price from product where product_id ='$product_id'";
     $result = @mysql_query($query);
     if ($result)
      {
        $item_price = mysql_result($result, 0, "price");
        $price +=$item_price*$qty;
      }
    }
  }
  return $price;
}

function calculate_items($cart)
{
$items = 0;
if(is_array($cart))
{
foreach($cart as $product_id => $qty)
{
$items += $qty;
}
}
return $items;
}

function get_product_detail ($product_id) 
{
	if (!$product_id || $product_id == "") return false;
	$sql = "select * from product where product_id = '$product_id'";
	$query = @mysql_query ($sql);
	
	if (!$query)
		return false;
	$rec = @mysql_fetch_array ($query);
	return $rec;
		
}

function Msg_Error ($msg) 
{
$ret = '<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">';
$ret .= '  <tr>';
$ret .=  '    <td bgcolor="#FF0000"><table width="100%" border="0" cellspacing="1" cellpadding="1">';
$ret .=  '        <tr>';
$ret .=  '          <td align="center" bgcolor="#FFFFFF"><br><br>' . $msg . '<br><br><br></td>';
$ret .=  '        </tr>';
$ret .=  '      </table></td>';
$ret .=  '  </tr>';
$ret .=  '</table>';
return $ret;
}
function Check_Permission2 ($check_module,$user_id,$action)
{
	$sql = "select * from s_user_p where user_id = '$user_id' and s_module like '$check_module' and ";
	if ($action == "read") $sql .= " read_p like '1'";
	if ($action == "add") $sql .= " add_p like '1'";
	if ($action == "update") $sql .= " update_p like '1'";
	if ($action == "delete") $sql .= " delete_p like '1'";
	//echo $sql;
	$query = @mysql_query ($sql) or die ("Can not check permission");
	$code = 0;  
	if   ($rec = @mysql_fetch_array  ($query)) { 
		switch ($action) {
			case "read" : $code = $rec["read_p"]; break;
			case "add" : $code = $rec["add_p"]; break;
			case "update" : $code = $rec["update_p"]; break;
			case "delete" : $code = $rec["delete_p"]; break;
		}
	}
//	echo $sql;
		if ($code == "0") {
			header ("location:/administrator/error/permission.php");
		}
}

function Show_Data ($tbl_name, $key, $value, $fieldname)
{
	$sql = "select * from $tbl_name where $key like '" . $value . "'";
	$query = @mysql_query ($sql);
	$fields = split (":", $fieldname);
	$msg = "";
	if ($rec = @mysql_fetch_array ($query)) { 
		foreach ($fields as $key => $value ) { 
			$msg .= " : " . $rec[$value];
		}
		$msg = substr ($msg, 3);
	} 
	 return $msg;
}
function Show_Full_Category ($value)
{
	$stop = 0;
	$sql = "select * from category where category_id  like '" . $value . "'";
	$query = @mysql_query ($sql);
	$rec = @mysql_fetch_array ($query) 	;
	$url = $rec["category_name"];
	$parent_category_id = $rec["parent_category_id"];
	while ($parent_category_id  <> '0' and !$stop ) { 
		//echo "65555555";
	$sql = "select * from category where category_id  like '" . $parent_category_id . "'";
		$query = @mysql_query ($sql);
		if ($rec = @mysql_fetch_array ($query) )  
		{
			$url = $rec["category_name"] . " > " . $url;
			$parent_category_id = $rec["parent_category_id"];
		}
		else
		{
			$stop = 1;
		}
	}
//	$url = "Home" . " > " . $url;
	echo $url;
}
function Show_Full_Category_data ($value)
{
	$stop = 0;
	$sql = "select * from category where category_id  like '" . $value . "'";
	$query = @mysql_query ($sql);
	$rec = @mysql_fetch_array ($query) 	;
	$url = $rec["category_name"];
	$parent_category_id = $rec["parent_category_id"];
	while ($parent_category_id  <> '0' and !$stop ) { 
		$sql = "select * from category where category_id  like '" . $parent_category_id . "'";
		$query = @mysql_query ($sql);
		if ($rec = @mysql_fetch_array ($query) )  
		{
			$url = $rec["category_name"] . " > " . $url;
			$parent_category_id = $rec["parent_category_id"];
		}
		else
		{
			$stop = 1;
		}
	}
//	$url = "Home" . " > " . $url;
	return $url;
}
function Show_Full_Category_nav ($value)
{
	$stop = 0;
	$sql = "select * from category where category_id  like '" . $value . "'";
	$query = @mysql_query ($sql);
	$rec = @mysql_fetch_array ($query) 	;
	$url = '<a href="list.php?category_id=' . $rec["category_id"] . '">' . $rec["category_name"] .  $url . '</a>';
	$parent_category_id = $rec["parent_category_id"];
	while ($parent_category_id  <> '1' and !$stop ) { 
		$sql = "select * from category where category_id  like '" . $parent_category_id . "'";
		$query = @mysql_query ($sql);
		if ($rec = @mysql_fetch_array ($query) )  
		{
			$url = '<a href="' . $_SERVER['PHP_SELF'] . '?category_id=' . $rec["category_id"] . '">' . $rec["category_name"] . '</a> > ' .  $url ;
			$parent_category_id = $rec["parent_category_id"];
		}
		else
		{
			$stop = 1;
		}
	}
	$url = '<a href="/">Home</a>' . " > " . $url;
	echo $url;
}
function Update_Transaction_DateTime ($sql, $mode)
{
	if ($mode == "add") { 
	
	}
	if ($mode == "update") { 
		$sql .= ", update_date = '" . date ("Y-m-d H:m:s") . "'";
		$sql .= ", update_by = '" . $_SESSION["username"] .  "'";
	}
	if ($mode == "delete") { 
	
	}
	return $sql;
}
/* function date_format ($create_date) { 
	list($year1, $month1, $day1, $hour1, $minute1, $second1 ) = split('[-.]', $create_date);
	return mktime(0,0,0,$month1,$day1,$year1); 
}  */
function CheckBox ($box_name, $value) { 
	if ($value) $value = " checked ";
	echo '<input name="' . $box_name . '" type="checkbox" value="1" ' . $value . '>';
}
function CmdDropDown ($sql, $box_name, $fieldkey, $value, $fieldshow) { 
	if ($value == "0" or $value == "") $select_none = " selected "; else $select_none = "";
	echo '<select name="' . $box_name . '" >';
	echo '<option value="" ' . $select_none . '>Select One</option>';
	
	$query = @mysql_query ($sql);
	
 	while ($rec = @mysql_fetch_array ($query)) { 

		if ($rec[$fieldkey] == $value) $selected = " selected "; else 		$selected= "";
		echo '<option value="' . $rec[$fieldkey] . '" '.  $selected . '>' . $rec[$fieldshow] . '</option>';
	} 
    echo '</select>';
}
function CmdDropDown2 ($sql, $box_name, $fieldkey, $value, $fieldshow,$fieldshow2) { 
	if ($value == "0" or $value == "") $select_none = " selected "; else $select_none = "";
	echo '<select name="' . $box_name . '" >';
	echo '<option value="" ' . $select_none . '>Select One</option>';
	$query = @mysql_query ($sql);
	while ($rec = @mysql_fetch_array ($query)) { 

		if ($rec[$fieldkey] == $value) $selected = " selected "; else 		$selected= "";
		echo '<option value="' . $rec[$fieldkey] . '" '.  $selected . '>' . $rec[$fieldshow] . " ( " . $rec[$fieldshow2] . ' )</option>';
	} 
    echo '</select>';
}
function CmdDropDown3 ($sql, $box_name, $fieldkey, $value, $fieldshow) { 
	if ($value == "0" or $value == "") $select_none = " selected "; else $select_none = "";
	echo '<select name="' . $box_name . '" >';
	echo '<option value="" ' . $select_none . '>Other</option>';
	$query = @mysql_query ($sql);
	while ($rec = @mysql_fetch_array ($query)) { 

		if ($rec[$fieldkey] == $value) $selected = " selected "; else 		$selected= "";
		echo '<option value="' . $rec[$fieldkey] . '" '.  $selected . '>' . $rec[$fieldshow] . '</option>';
	} 
    echo '</select>';
}
function CmdDropDown4 ($sql, $box_name, $fieldkey, $value, $fieldshow) { 
	if ($value == "0" or $value == "") $select_none = " selected "; else $select_none = "";
	echo '<select name="' . $box_name . '" >';
	echo '<option value="" ' . $select_none . '>Select One</option>';
	echo '<option value="" ' . $select_none . '>????</option>';
	$query = @mysql_query ($sql);
	while ($rec = @mysql_fetch_array ($query)) { 

		if ($rec[$fieldkey] == $value) $selected = " selected "; else 		$selected= "";
		echo '<option value="' . $rec[$fieldkey] . '" '.  $selected . '>' . $rec[$fieldshow] . '</option>';
	} 
    echo '</select>';
}
function CmdListBox ($sql, $box_name, $fieldkey, $value, $fieldshow, $total_value) { 
	echo '<select name="' . $box_name . '" size=15 multiple>';
	echo '<option value=""  >Select One</option>';
	$query = @mysql_query ($sql);
	while ($rec = @mysql_fetch_array ($query)) { 
		$selected= "";
		if (in_array ($rec[$fieldkey],$total_value)) $selected = " selected ";
		echo '                    <option value="' . $rec[$fieldkey] . '" '.  $selected . '>' . $rec[$fieldshow] . '</option>';
	} 
    echo '                  </select>';
}
function CmdRadio($box_name, $a_value, $select_value) { 
	foreach ($a_value as $key=>$value) { 
		$check = "";
		if ($key == $select_value) { $check = " checked "; } 
		echo '<input type="radio" name="' . $box_name . '" value="' . $key . '" ' . $check . '>' . $value;
	}
}
function CheckData ($value) { 
	if (isset ($value)) echo $value;
}
function Show_Sort ($orderby, $cn,  $field_select, $sortby,$page) { 
	global $FK_field;
	global $$FK_field;

	if ($sortby <> "" and ($orderby ==  $field_select))  $img = '<img src="/administrator/icons/' . $sortby . '.gif">';
	if ($sortby == "desc" or $sortby == "")  $sortby = "asc"; else 	$sortby  = "desc"; 
	if ($orderby <>  $field_select) $sortby = "asc";
	 $param = "orderby=$orderby";
	if ($FK_field <> "") $param .= "&" . $FK_field . "=" . $$FK_field;
	if ($sortby <> "") $param .= "&sortby=$sortby";
	if ($keyword <> "") $param .= "&keyword=$keyword";

	if ($page <> "") $param .= "&page=$_GET[page]";
	$link_1 = "<a href ='" . $_SERVER['SCRIPT_NAME'] ."?" . $param ."'>";
	$url =  $link_1 . $cn . "</a>" ;
	if ($sortby <> "") $url .= $img;
	echo $url;
}

function Show_Sort_new ($orderby, $cn,  $field_select, $sortby,$page,$param) { 
	global $FK_field;
	global $$FK_field;

	if ($sortby <> "" and ($orderby ==  $field_select))  $img = '<img src="/administrator/icons/' . $sortby . '.gif">';
	if ($sortby == "desc" or $sortby == "")  $sortby = "asc"; else 	$sortby  = "desc"; 
	if ($orderby <>  $field_select) $sortby = "asc";
	$param .= "&orderby=".$orderby."&sortby=".$sortby;
	$link_1 = "<a href ='" . $_SERVER['SCRIPT_NAME'] ."?" . $param ."'>";
	$url =  $link_1 . $cn . "</a>" ;
	if ($sortby <> "") $url .= $img;
	echo $url;
}


function Show_Sort_bg ($field, $sortby) { 
	if ($field == $sortby) { 
		echo 'class="sort"';
	}
	
}

function date_diff($date_from,$date_to,$unit='d') 
/* 
Calculates difference from date_from to date_to, taking into account leap years 
if date_from > date_to, the number of days is returned negative 
date_from and date_to format is: "dd-mm-yyyy" 
It can calculate ANY date difference, for example between 21-04-345 and 11-11-3412 
This is possible by mapping any date to the "range 0" dates, as this table shows: 

   INI            END            RANGE    LEAP YEARS 
   ...            ...            ...        ... 
   01/01/1920    01/01/1939    -3        5 
   01/01/1940    01/01/1959    -2        5 
   01/01/1960    01/01/1979    -1        5 
   01/01/1980    01/01/1999    0        5    * this is the range used for calculations with mktime 
   01/01/2000    01/01/2019    1        5 
   01/01/2020    01/01/2039    2        5 
   01/01/2040    01/01/2059    3        5 
   01/01/2060    01/01/2079    4        5 
   ...            ...            ...        ... 

The difference is calculated in the unit specified by $unit (default is "days") 
$unit: 
   'd' or 'D' = days 
   'y' or 'Y' = years 
*/ 

{ 
   //get parts of the dates 
   $date_from_parts = explode('-', $date_from); 
   $date_to_parts = explode('-', $date_to); 
   $day_from = $date_from_parts[2]; 
   $mon_from = $date_from_parts[1]; 
   $year_from = $date_from_parts[0]; 
   $day_to = $date_to_parts[2]; 
   $mon_to = $date_to_parts[1]; 
   $year_to = $date_to_parts[0]; 

   //if date_from is newer than date to, invert dates 
   $sign=1; 
   if ($year_from>$year_to) $sign=-1; 
   else if ($year_from==$year_to) 
       { 
       if ($mon_from>$mon_to) $sign=-1; 
       else if ($mon_from==$mon_to) 

           if ($day_from>$day_to) $sign=-1; 
       } 

   if ($sign==-1) {//invert dates 
       $day_from = $date_to_parts[2]; 
       $mon_from = $date_to_parts[1]; 
       $year_from = $date_to_parts[0]; 
	   
       $day_to = $date_from_parts[2]; 
       $mon_to = $date_from_parts[1]; 
       $year_to = $date_from_parts[0]; 
       } 

   switch ($unit) 
       { 
       case 'd': case 'D': //calculates difference in days            
       $yearfrom1=$year_from;  //actual years 
       $yearto1=$year_to;      //(yearfrom2 and yearto2 are used to calculate inside the range "0")    
       //checks ini date 
       if ($yearfrom1<1980) 
           {//year is under range 0 
           $deltafrom=-floor((1999-$yearfrom1)/20)*20; //delta t1 
           $yearfrom2=$yearfrom1-$deltafrom;          //year used for calculations 
           } 
       else if($yearfrom1>1999) 
           {//year is over range 0 
           $deltafrom=floor(($yearfrom1-1980)/20)*20; //delta t1 
           $yearfrom2=$yearfrom1-$deltafrom;          //year used for calculations            
           } 
       else {//year is in range 0 
           $deltafrom=0; 
           $yearfrom2=$yearfrom1; 
           } 
           
       //checks end date 
       if ($yearto1<1980) {//year is under range 0 
           $deltato=-floor((1999-$yearto1)/20)*20; //delta t2 
           $yearto2=$yearto1-$deltato;            //year used for calculations 
           } 
       else if($yearto1>1999) {//year is over range 0 
           $deltato=floor(($yearto1-1980)/20)*20; //delta t2 
           $yearto2=$yearto1-$deltato;            //year used for calculations            
           } 
       else {//year is in range 0 
           $deltato=0; 
           $yearto2=$yearto1; 
           } 
   
       //Calculates the UNIX Timestamp for both dates (inside range 0) 
       $ts_from = mktime(0, 0, 0, $mon_from, $day_from, $yearfrom2); 
       $ts_to = mktime(0, 0, 0, $mon_to, $day_to, $yearto2); 
       $diff = ($ts_to-$ts_from)/86400; 
       //adjust ranges 
       $diff += 7305 * (($deltato-$deltafrom) / 20); 
       return $sign*$diff; 
       break; 
       
       case 'y': case 'Y': //calculates difference in years 
       $diff=$year_to-$year_from;        
       $adjust=0; 
       if ($mon_from>$mon_to) $adjust=-1; 
       else if ($mon_from==$mon_to) 
           if ($day_from>$day_to) $adjust=-1; 
       
       return $sign*($diff+$adjust); 
       break;        
       } 
	   
} 
function cal_point($member_id,$action_type,$point){
				$sql = "select point from member where member_id = '$member_id'";
				$query = @mysql_query($sql);
				$rec = @mysql_fetch_array($query);
				$mpoint =  $rec["point"]; 
				if ($action_type == "+"){
				//$mpoint = ???????????? query
					$total_point = $mpoint + $point;
				}
				if ($action_type == "-"){
				//$mpoint = ???????????? query
					$total_point = $mpoint - $point;
				}
				  
				
				echo $total_point;			
}		
function make_thumb($input_file_name, $input_file_path, $width, $quality)
{
	global $config;
 	$config[thumbnail_width] = $width;
 	$config[thumbnail_height] = $width;
	$imagedata = GetImageSize( "$input_file_path" . "$input_file_name" );
	$imagewidth = $imagedata[0];
	$imageheight = $imagedata[1];
	$imagetype = $imagedata[2];
     // type definitions
     // 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP
     // 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order)
     // 9 = JPC, 10 = JP2, 11 = JPX
     $thumb_name = $input_file_name; //by default
	if ($imagetype == 2){
		$shrinkage = 1;
		if ($imagewidth > $imageheight) { 
			if ($imagewidth > $config[thumbnail_width]){
				$shrinkage = $config[thumbnail_width]/$imagewidth;
				$dest_height = $shrinkage * $imageheight;
				$dest_width = $config[thumbnail_width];
			}
			else
			{
				$dest_height =  $imageheight;
				$dest_width = $imagewidth;
			}
		}
		else
		{
			if ($imageheight > $config[thumbnail_height]){
				$shrinkage = $config[thumbnail_height]/$imageheight;
				$dest_width = $shrinkage * $imagewidth;
				$dest_height = $config[thumbnail_height];
			}
			else
			{
				$dest_height =  $imageheight;
				$dest_width = $imagewidth;
			}
		}
		$src_img = imagecreatefromjpeg("$input_file_path/$input_file_name");
 		$dst_img=imagecreatetruecolor($dest_width,$dest_height);
 		imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dest_width,$dest_height, $imagewidth, $imageheight);
		$thumb_name = "$input_file_name";
		imagejpeg($dst_img, "$input_file_path/$thumb_name", $quality);
		imagedestroy($src_img);
		imagedestroy($dst_img);
	} // end if $imagetype == 2
 	return $thumb_name;
} // end function make_thumb

function uploadfile($input_file_path, $input_file_name, $file, $sizes, $quality){
 	$version="linux";
	if ($file != "") {
		if (!copy($file, $input_file_path . $input_file_name)) {
			echo ("failed to copy $file_name...<br>\n");
		}
		if ($version!="windows"){		
 			$pic=$input_file_path.$input_file_name;
			$size = GetImageSize("$pic") ; 
			$w=$size[0] ;
			$h=$size[1];
				make_thumb($input_file_name, $input_file_path, $sizes, $quality); 
 		}
	}
}

function Get_Point($member_id){
	$sql = "select * from transaction where customer_id = '$member_id' order by transaction_id desc";
	$rec = @mysql_fetch_array(@mysql_query($sql));
	$total_point = $rec["total_point"];
	return $total_point;	
}

function Check_Permission ($check_module,$user_id,$action)
{
	$sql = "select * from s_user_group where user_id = '$user_id'";
  	$query = @mysql_query ($sql) or die ("1");
	$groups = "";

	while ($rec = @mysql_fetch_array ($query)) {
		$groups .= "or group_id = '$rec[group_id]'";
  	}
  	if ($groups <> "") {
		$groups = substr ($groups, 3);
		$groups = " and (" . $groups . ")";
	}
	$sql = "select * from s_module where module_name like '$check_module'";
	$query = @mysql_query ($sql) or die ("2");
	$module_id = 0;
	while ($rec = @mysql_fetch_array ($query)) {
		$module_id  = $rec["module_id"];
  	}		
	$sql = "select * from s_user where user_id = '$user_id'";
	$query = @mysql_query ($sql) or die ("3");
	if ($rec = @mysql_fetch_array ($query)) {
		if ($rec["admin_flag"] == '1' or $_SESSION[s_group_all] == "ALL") {
				
		}
		else
		{
/*
if ($action == "read") $sql .= " read_p like '1'";
if ($action == "add") $sql .= " add_p like '1'";
if ($action == "update") $sql .= " update_p like '1'";
if ($action == "delete") $sql .= " delete_p like '1'";
*/

		$sql = "select * from s_user_p where user_id = '$user_id'  and  module_id like '$module_id'";

		$query = @mysql_query ($sql) or die ("4");
		if (@mysql_num_rows ($query)) {

			while ($rec = @mysql_fetch_array ($query)) {
				switch ($action) {
					case "read" : $code = $rec["read_p"]; break;
					case "add" :  $code = $rec["add_p"]; break;
					case "update" : $code = $rec["update_p"]; break;
					case "delete" : $code = $rec["delete_p"]; break;
				} 
			}// end while
			if ( ($code == "0") || ($code == "") ) {
				header ("location:../error/permission.php");
			}

		}
		else
		{
			$code ="";
			if($groups <> "") {
				$sql = "select sum(read_p) as s_read,sum(add_p) as s_add,sum(update_p) as s_update,sum(delete_p) as s_delete,module_id,group_id from s_user_p group by module_id,group_id having module_id like '$module_id' ".$groups ;
				$query = @mysql_query($sql) or die("5");
				if (@mysql_num_rows ($query) == 0) $code = "";
				if ($rec = @mysql_fetch_array  ($query)) {
					switch ($action) {
						case "read" : $code = $rec["s_read"]; break;
						case "add" : $code = $rec["s_add"]; break;
						case "update" : $code = $rec["s_update"]; break;
						case "delete" : $code = $rec["s_delete"]; break;
					}// end switch
				}
			}
  			if (trim($code) == '' or $code == '0') {
  				header ("location:../error/permission.php");
  			}
  }
   }
}
else
{
header ("location:../error/permission.php");
}
}	

function Check_Permission_menu ($check_module,$user_id,$action)
{
	$permission_denine = 0;
	$sql = "select * from s_user_group where user_id = '$user_id'";
  	$query = @mysql_query ($sql) or die ("1");
	$groups = "";

	while ($rec = @mysql_fetch_array ($query)) {
		$groups .= "or group_id = '$rec[group_id]'";
  	}
  	if ($groups <> "") {
		$groups = substr ($groups, 3);
		$groups = " and (" . $groups . ")";
	}
	$sql = "select * from s_module where module_name like '$check_module'";
	$query = @mysql_query ($sql) or die ("2");
	$module_id = 0;
	while ($rec = @mysql_fetch_array ($query)) {
		$module_id  = $rec["module_id"];
  	}		
	$sql = "select * from s_user where user_id = '$user_id'";
	$query = @mysql_query ($sql) or die ("3");
	if ($rec = @mysql_fetch_array ($query)) {
		if ($rec["admin_flag"] == '1' or $_SESSION[s_group_all] == "ALL") {
				
		}
		else
		{
/*
if ($action == "read") $sql .= " read_p like '1'";
if ($action == "add") $sql .= " add_p like '1'";
if ($action == "update") $sql .= " update_p like '1'";
if ($action == "delete") $sql .= " delete_p like '1'";
*/

		$sql = "select * from s_user_p where user_id = '$user_id'  and  module_id like '$module_id'";

		$query = @mysql_query ($sql) or die ("4");
		if (@mysql_num_rows ($query)) {

			while ($rec = @mysql_fetch_array ($query)) {
				switch ($action) {
					case "read" : $code = $rec["read_p"]; break;
					case "add" :  $code = $rec["add_p"]; break;
					case "update" : $code = $rec["update_p"]; break;
					case "delete" : $code = $rec["delete_p"]; break;
				} 
			}// end while
			if ( ($code == "0") || ($code == "") ) {
				//header ("location:/administrator/error/permission.php");
				$permission_denine = 0;
			}

		}
		else
		{
			$code ="";
			if($groups <> "") {
				$sql = "select sum(read_p) as s_read,sum(add_p) as s_add,sum(update_p) as s_update,sum(delete_p) as s_delete,module_id,group_id from s_user_p group by module_id,group_id having module_id like '$module_id' ".$groups ;
				$query = @mysql_query($sql) or die("5");
				
				if (@mysql_num_rows ($query) == 0) $code = "";
				if ($rec = @mysql_fetch_array  ($query)) {
					switch ($action) {
						case "read" : $code = $rec["s_read"]; break;
						case "add" : $code = $rec["s_add"]; break;
						case "update" : $code = $rec["s_update"]; break;
						case "delete" : $code = $rec["s_delete"]; break;
					}// end switch
				}
			}
  			if (trim($code) == '' or $code == '0') {
  				//header ("location:/administrator/error/permission.php");
				$permission_denine = 1;
  			}
  }
   }
}
else
{
//header ("location:/administrator/error/permission.php");
$permission_denine = 1;
}
return $permission_denine;
}	

function Show_Full_Category_spec ($value)
{
	$stop = 0;
	$sql = "select * from category_spec where category_spec_id  like '" . $value . "'";
	$query = @mysql_query ($sql);
	$rec = @mysql_fetch_array ($query) 	;
	$url = $rec["cat_name"];
	$parent_category_id = $rec["parent_category_id"];
	while ($parent_category_id  <> '0' and !$stop ) { 
		//echo "65555555";
	$sql = "select * from category_spec where category_spec_id  like '" . $parent_category_id . "'";
		$query = @mysql_query ($sql);
		if ($rec = @mysql_fetch_array ($query) )  
		{
			$url = $rec["cat_name"] . " > " . $url;
			$parent_category_id = $rec["parent_category_id"];
		}
		else
		{
			$stop = 1;
		}
	}
//	$url = "Home" . " > " . $url;
	return $url;
}

function record_member($page_name){
	$now_date = date("Y-m-d");
	$sql = "select * from member_log where user_id = '$_SESSION[login_id]' and create_date like '$now_date%' ";
	$query = @mysql_query($sql);
	if(@mysql_num_rows($query) == 0){
		$sql = "insert into member_log (user_id,page_log,create_date) values ('$_SESSION[login_id]','$page_name','$now_date') ";
		@mysql_query($sql);
	}else{
		$rec = @mysql_fetch_array($query);
		@reset($a_page_log);
		unset($a_page_log);
		$a_page_log = @explode(",",$rec[page_log]);
		if(!@in_array($page_name,$a_page_log)){
			$page_log = $rec[page_log].",".$page_name;
			$sql = "update member_log set page_log = '$page_log' where member_log_id = '$rec[member_log_id]' ";
			@mysql_query($sql);
		}
	}
}
function check_azAZ09($text){
	if(ereg("[^0-9A-Za-z]",$text)) return false;
	else return true;
}		
function get_param($a_param,$a_not_exists){
	$param = $param2 = "";
	if(count($a_param) > 0) {
		foreach($a_param as $key => $value){ 
			if( (!@in_array($value,$a_not_exists)) && ($_REQUEST[$value] <> "") )
				$param .= "&".$value."=".$_REQUEST[$value];
		}
	}
	if(count($_REQUEST) > 0){
		foreach($_REQUEST as $key => $value){ 
			if( ereg("pre_",$key) && ($value <> "") ) 
				$param2 .= "&".$key."=".$value;
		}
	}
	$param = $param.$param2;
	return substr($param,1);
}
function post_param($a_param,$a_not_exists){
	$param = "";
	if(count($a_param) > 0) {
		foreach($a_param as $key => $value){
			if( (!@in_array($value,$a_not_exists)) && ($_REQUEST[$value] <> "") )
					 echo "<input type=\"hidden\" name=\"$value\" value=\"".$_REQUEST[$value]."\">";
		}// end foreach
	}
	if(count($_REQUEST) > 0) {
		foreach($_REQUEST as $key => $value){
			if( ereg("pre_",$key) && ($value <> "") )
					 echo "<input type=\"hidden\" name=\"$key\" value=\"$value\">";
		}// end foreach
	}
}
function get_pre_param($a_param){
	$param = "";
	if(count($a_param) > 0) {
		foreach($a_param as $key => $value){ 
			if( $_REQUEST[$value] <> "" )
				$param .= "&pre_".$value."=".$_REQUEST[$value];
		}
		$param = substr($param,1);
	}
	return $param;
}
function get_return_param(){
	$param = ""; 
	if(count($_REQUEST) > 0) {
		foreach($_REQUEST as $key => $value){
			if( ereg("pre_",$key) && ($value <> "") )
				$param .= "&".str_replace("pre_","",$key)."=".$value;
		}
		$param = substr($param,1);
	}
	return $param;
}
function check_username($name){
	$return_id = "";
	$sql = "select * from person where name_th = '$name' or name_en = '$name' ";
	$query = @mysql_query($sql);
	if(@mysql_num_rows($query) > 0) {
		$rec = @mysql_fetch_array($query);
		$return_id = $rec[person_id];
	}else{
		$username = gen_random(4);
		$password = '1234';
		$stop = 0;
		while($stop != 0){
			$sql = "select * from s_user where username = '$username' and password = '$password' ";
			$query = @mysql_query($sql);
			if(@mysql_num_rows($query) == 0)
				$stop = 1;
			else
				$uername = gen_random(4);
		}
		$sql = "insert into s_user (username , password , create_date , create_by) values ('$username','$password','".date("Y-m-d H:i:s")."' , '".$_SESSION[login_name]."')";
		@mysql_query($sql);
		$user_id = mysql_insert_id();
		
		$sql = "insert into person (name_th , researcher , user_id , create_date , create_by) values ('$name' , '1' , '$user_id' , '".date("Y-m-d H:i:s")."' , '".$_SESSION[login_name]."')";
		@mysql_query($sql);
		$return_id = mysql_insert_id();
	}
	return $return_id;
}

function show_menu($menu_id,$menu_name){
	if(ereg(",".$menu_id.",",$_SESSION[s_menu_id].",")){
		if($menu_id == $_SESSION[s_now_menu])
			echo "<font color=\"#FF0000\">$menu_name</font>"; 
		else
			echo "<font color=\"#CC6600\">$menu_name</font>"; 
	}else
		echo $menu_name;
}

function check_file_in_path($file_type,$path,$length){
	$filename = gen_random ($length-1).".".$file_type;
	while(1){
		if(!file_exists($path.$filename)){
			break;
		}else{
			$filename = gen_random ($length-1).".".$file_type;
		}
	}
	return $filename;
}
function cropImage($nw, $nh, $source, $stype, $dest) { 
    $size = getimagesize($source);
    $w = $size[0];
    $h = $size[1];
 
    switch($stype) {
        case 'gif':
        $simg = imagecreatefromgif($source);
        break;
        case 'jpg':
        $simg = imagecreatefromjpeg($source);
        break;
        case 'png':
        $simg = imagecreatefrompng($source);
        break;
    }
 
    $dimg = imagecreatetruecolor($nw, $nh);
 
    $wm = $w/$nw;
    $hm = $h/$nh;
 
    $h_height = $nh/2;
    $w_height = $nw/2;
 
    if($w> $h) {
 
        $adjusted_width = $w / $hm;
        $half_width = $adjusted_width / 2;
        $int_width = $half_width - $w_height;
 
        imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
 
    } elseif(($w <$h) || ($w == $h)) {
 
        $adjusted_height = $h / $wm;
        $half_height = $adjusted_height / 2;
        $int_height = $half_height - $h_height;
 
        imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
 
    } else {
        imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
    }
 
    imagejpeg($dimg,$dest,100);
} 
?>
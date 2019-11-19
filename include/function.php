<?php 
/* ******************* 
Last Revised : 1 Dec, 2006
/* ******************* 

Check_Permission($conn,$check_module,$user_id,$action)
Cal_Age($date)
Show_Data($conn,$tbl_name, $key, $value, $fieldname)
Show_Full_Category($conn,$value)
Update_Transaction_DateTime ($sql, $mode)
date_format ($create_date) 
CheckBox ($box_name, $value) 
CmdDropDown($conn,$sql, $box_name, $fieldkey, $value, $fieldshow) 
CmdListBox($conn,$sql, $box_name, $fieldkey, $value, $fieldshow) 
CheckData ($value) 
Show_Sort ($orderby, $cn,  $field_select, $sortby,$page) 
Show_Sort_bg ($field) 
Msg_Error ("Login or password not found")
function calculate_price($conn,$cart)
function calculate_items($cart)
function get_product_detail ($conn,$product_id) 
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
function Toggle ($conn,$value, $tbl_name, $field, $field_change) { 
function get_product_details($conn,$product_id)
function Show_Image ($conn,$ref_id, $gallery_group, $flag) { 
function Get_Point($conn,$member_id){
function resize($fromimage, $toimage, $size=500, $imagesname="jpg") {
function Show_Flash_banner($pathfiles,$width,$height){
**********************/
function Show_Image ($conn,$ref_id, $gallery_group, $flag, $size) { 
		  $sql = "select * from gallery where ref_id = '$ref_id' and gallery_group = '$gallery_group'";
		  $query  = @mysqli_query($conn,$sql);
 		  while ($rec  = @mysqli_fetch_array($query)) { 
		  		$filename = "upload/" . $gallery_group . "/" . $rec["gallery_id"] . "_$size.jpg";
 			   if (file_exists ($filename)) {
				$msg = '<img src="' . $filename . '" border="0">';
			   }
		  	}
			return $msg;
}
//------------------------------------------------------------------------------------------------------

function get_product_details($conn,$product_id)
{
  if (!$product_id || $product_id=="")
     return false;
   $query = "select * from product where product_id='$product_id'";
    $result = @mysqli_query($conn,$query);
   if (!$result)
     return false;
   $result = @mysqli_fetch_array($result);
   return $result;
}	
//------------------------------------------------------------------------------------------------------

function Toggle ($conn,$value, $tbl_name, $field, $field_change) { 
		$sql = "select * from " . $tbl_name . " where " . $field . " = '$value'";
		$query = @mysqli_query($conn,$sql);
		if ($rec = @mysqli_fetch_array($query)) {
			if ($rec[$field_change] == "" || $rec[$field_change] == "0") {  $status = '1'; }  else { $status = ''; }
			$sql = "update  " . $tbl_name . " set " . $field_change . "  = ".$status."  where " . $field . " = '$value'";
			@mysqli_query($conn,$sql);
			//echo $sql;
 		}
} 
//------------------------------------------------------------------------------------------------------

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
//------------------------------------------------------------------------------------------------------


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
//------------------------------------------------------------------------------------------------------

function Show_Choice_month ($select_name, $list_array , $prefer_location) { 
		$msg = '<select name="' . $select_name . '">';
		$msg .= '<option value="">--เดือน--</option> ' ;
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

//------------------------------------------------------------------------------------------------------

function Upload_Photo ($file, $path, $size, $value){
		if ($file <> "") { 
			$path="../../upload/" . $path . "/" . $size . "/";
			$filename=$value . ".jpg";
			copy ($file, $path . $filename);
		}
}
//------------------------------------------------------------------------------------------------------

function Delete_Photo ($path, $value){
	$delete_file = "../../upload/" . $path . "/small/" . $value . ".jpg";
	if (file_exists($delete_file)) unlink ($delete_file);
	$delete_file = "../../upload/" . $path . "/large/" . $value . ".jpg";
	if (file_exists($delete_file)) unlink ($delete_file);
}
//------------------------------------------------------------------------------------------------------

function Show_Text ($label,$value) { 
	if (trim ($value == "") ) {
	
	}else
	{
		echo "<strong>$label</strong>$value";
	}
}
//------------------------------------------------------------------------------------------------------

function format_date_en ($value,$type) { 
	list ($s_date,$s_time)  = explode(" ", $value);
	list ($s_year, $s_month, $s_day) = explode("-", $s_date);
	list ($s_hour, $s_minute, $s_second) = explode(":", $s_time);
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
		case "6" :  // 11/05/2010
			$year=date("Y")+543;
			$msg = date ("d/m/".$year, $mktime);
			break;
		case "7" :  // 11-05-2556
			$year=date("Y")+543;
			$msg = date ("d m ".$year, $mktime);
		}
	return ($msg);
}
//------------------------------------------------------------------------------------------------------

function format_month_th ($value) { 
	$month_full_th = array ('','มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม',' กันยายน', 'ตุลาคม', 'พฤศจิกายน','ธันวาคม');
	switch ($value) { 
		case "January" : 
			$msg = $month_full_th[1];
			break;
		case "February" :
			$msg = $month_full_th[2];
			break;
		case "March" : 
			$msg = $month_full_th[3];
			break;
		case "April" : 
			$msg = $month_full_th[4];
			break;
		case "May" : 
			$msg = $month_full_th[5];
			break;
		case "June" :  
			$msg = $month_full_th[6];
			break;
		case "July" :  
			$msg = $month_full_th[7];
			break;
		case "August" :  
			$msg = $month_full_th[8];
			break;
		case "September" :  
			$msg = $month_full_th[9];
			break;
		case "October" :  
			$msg = $month_full_th[10];
			break;
		case "November" :  
			$msg = $month_full_th[11];
			break;
		case "December" :  
			$msg = $month_full_th[12];
			break;
		}
	return ($msg);

}

function format_year_th ($value) {
	$value += 543;
	$year = substr( $value, -2);
	return ($year);
}

function format_date_th ($value,$type) { 
	if (strlen ($value) > 10) { 
			list ($s_date,$s_time)  = explode(" ", $value);
			list ($s_year, $s_month, $s_day) = explode("-", $s_date);
			list ($s_hour, $s_minute, $s_second) = explode(":", $s_time);
	}
	else 
	{
			list ($s_year, $s_month, $s_day) = explode("-", $value);
	}
	$s_month +=0;
	$s_day += 0;
	if ($s_day == "0") return "";
	$s_year += 543;
	$month_full_th = array ('','มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม',' กันยายน', 'ตุลาคม', 'พฤศจิกายน','ธันวาคม');
	$month_brief_th = array ('','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
	$day_of_week = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์"); 
	switch ($type) { 
		case "1" : // 4 มกราคม 2548
			$msg = $s_day . " " .  $month_full_th[$s_month]  . " " .  $s_year ;
			break;
		case "2" :  // 4 ม.ค. 2548
			$msg =  $s_day . " " .  $month_brief_th[$s_month]  . " " .  $s_year ;
			break;
		case "3" :  // อาทิตย์ที่ 4 มกราคม 2548 เวลา 14.11 น.
			$msg = "วัน ". $s_day . " " .  $month_full_th[$s_month]  . " " .  $s_year . " เวลา " . $s_hour . "." . $s_minute . " น." ;
			break;
		case "4" :  // 4 ม.ค. 2548 14.11 น. 
			$msg =  $s_day . " " .  $month_brief_th[$s_month]  . " " .  $s_year . "  " . $s_hour . "." . $s_minute . " น." ;
			break;
		case "5" :  // 04 ม.ค. 2548  
			$msg =  sprintf("%02d",$s_day) . " " .  $month_brief_th[$s_month]   . " " .  $s_year  ;
			break;
		case "6" :  // 4 ก.พ. 51
			$msg =  $s_day . " " .  $month_brief_th[$s_month]   . " " .  substr($s_year,-2)  ;
			break;
		case "7" :  //มกราคม
			$msg =  $month_full_th[$s_month];
			break;
		}
	return ($msg);

}
//------------------------------------------------------------------------------------------------------

function format_date_th2($value){
	$date = explode("-",$value);
	$month_full_th = array ('','มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม',' กันยายน', 'ตุลาคม', 'พฤษจิกายน','ธันวาคม');
	$text = (int)$date[2]." ".$month_full_th[$date[1]]." ".($date[0]);
	return($text);
}
//------------------------------------------------------------------------------------------------------

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
//------------------------------------------------------------------------------------------------------

function gen_random_num ($length)
{
	$keychars = "0123456789";
	
	// RANDOM KEY GENERATOR
	$randkey = "";
	$max=strlen($keychars)-1;
	for ($i=0;$i<=$length;$i++) {
	  $randkey .= substr($keychars, rand(0, $max), 1);
	}
	return $randkey;

}

//------------------------------------------------------------------------------------------------------

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

 list ($Number, $Satang)  = explode("[.]", $value);
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
//------------------------------------------------------------------------------------------------------

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
//------------------------------------------------------------------------------------------------------	
	
function calculate_price($conn,$cart)
{
  $price = 0.0;
  if(is_array($cart))
  {
 // $conn = connect_db("thaigoodstuff");
  foreach($cart as $product_id => $qty)
 {  
    $query = "select price from product where product_id ='$product_id'";
     $result = @mysqli_query($conn,$query);
     if ($result)
      {
        $item_price = mysql_result($result, 0, "price");
        $price +=$item_price*$qty;
      }
    }
  }
  return $price;
}
//------------------------------------------------------------------------------------------------------

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
//------------------------------------------------------------------------------------------------------

function get_product_detail ($conn,$product_id) 
{
	if (!$product_id || $product_id == "") return false;
	$sql = "select * from product where product_id = '$product_id'";
	$query = @mysqli_query($conn,$sql);
	
	if (!$query)
		return false;
	$rec = @mysqli_fetch_array($query);
	return $rec;
		
}
//------------------------------------------------------------------------------------------------------

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
//------------------------------------------------------------------------------------------------------

function Check_Permission2($conn,$check_module,$user_id,$action)
{
	$sql = "select * from s_user_p where user_id = '$user_id' and s_module like '$check_module' and ";
	if ($action == "read") $sql .= " read_p like '1'";
	if ($action == "add") $sql .= " add_p like '1'";
	if ($action == "update") $sql .= " update_p like '1'";
	if ($action == "delete") $sql .= " delete_p like '1'";
	//echo $sql;
	$query = @mysqli_query($conn,$sql) or die ("Can not check permission");
	$code = 0;  
	if   ($rec = @mysqli_fetch_array  ($query)) { 
		switch ($action) {
			case "read" : $code = $rec["read_p"]; break;
			case "add" : $code = $rec["add_p"]; break;
			case "update" : $code = $rec["update_p"]; break;
			case "delete" : $code = $rec["delete_p"]; break;
		}
	}
//	echo $sql;
		if ($code == "0") {
			header ("location:/inner/error/permission.php");
		}
}
//------------------------------------------------------------------------------------------------------

function Show_Data($conn,$tbl_name, $key, $value, $fieldname)
{
	$sql = "select * from $tbl_name where $key like '" . $value . "'";
	$query = @mysqli_query($conn,$sql);
	$fields = explode(":", $fieldname);
	$msg = "";
	if ($rec = @mysqli_fetch_array($query)) { 
		foreach ($fields as $key => $value ) { 
			$msg .= " : " . $rec[$value];
		}
		$msg = substr ($msg, 3);
	} 
	 return $msg;
}
//------------------------------------------------------------------------------------------------------

function Show_Full_Category($conn,$value)
{
	$stop = 0;
	$sql = "select * from category where category_id  like '" . $value . "'";
	$query = @mysqli_query($conn,$sql);
	$rec = @mysqli_fetch_array($query) 	;
	$url = $rec["category_name"];
	$parent_category_id = $rec["parent_category_id"];
	while ($parent_category_id  <> '0' and !$stop ) { 
		//echo "65555555";
	$sql = "select * from category where category_id  like '" . $parent_category_id . "'";
		$query = @mysqli_query($conn,$sql);
		if ($rec = @mysqli_fetch_array($query) )  
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
function Show_Full_Category_data($conn,$value)
{
	$stop = 0;
	$sql = "select * from category where category_id  like '" . $value . "'";
	$query = @mysqli_query($conn,$sql);
	$rec = @mysqli_fetch_array($query) 	;
	$url = $rec["category_name"];
	$parent_category_id = $rec["parent_category_id"];
	while ($parent_category_id  <> '0' and !$stop ) { 
		$sql = "select * from category where category_id  like '" . $parent_category_id . "'";
		$query = @mysqli_query($conn,$sql);
		if ($rec = @mysqli_fetch_array($query) )  
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
function Show_Full_Category_nav($conn,$value)
{
	$stop = 0;
	$sql = "select * from category where category_id  like '" . $value . "'";
	$query = @mysqli_query($conn,$sql);
	$rec = @mysqli_fetch_array($query) 	;
	$url = '<a href="list.php?category_id=' . $rec["category_id"] . '">' . $rec["category_name"] .  $url . '</a>';
	$parent_category_id = $rec["parent_category_id"];
	while ($parent_category_id  <> '1' and !$stop ) { 
		$sql = "select * from category where category_id  like '" . $parent_category_id . "'";
		$query = @mysqli_query($conn,$sql);
		if ($rec = @mysqli_fetch_array($query) )  
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
	list($year1, $month1, $day1, $hour1, $minute1, $second1 ) = explode('[-.]', $create_date);
	return mktime(0,0,0,$month1,$day1,$year1); 
}  */
function CheckBox ($box_name, $value) { 
	if ($value) $value = " checked ";
	echo '<input name="' . $box_name . '" type="checkbox" value="1" ' . $value . '>';
}
function CmdDropDown($conn,$sql, $box_name, $fieldkey, $value, $fieldshow) { 
	if ($value == "0" or $value == "") $select_none = " selected "; else $select_none = "";
	echo '<select name="' . $box_name . '" >';
	echo '<option value="" ' . $select_none . '>Select One</option>';
	
	$query = @mysqli_query($conn,$sql);
	
 	while ($rec = @mysqli_fetch_array($query)) { 

		if ($rec[$fieldkey] == $value) $selected = " selected "; else 		$selected= "";
		echo '<option value="' . $rec[$fieldkey] . '" '.  $selected . '>' . $rec[$fieldshow] . '</option>';
	} 
    echo '</select>';
}
function CmdDropDown2($conn,$sql, $box_name, $fieldkey, $value, $fieldshow,$fieldshow2) { 
	if ($value == "0" or $value == "") $select_none = " selected "; else $select_none = "";
	echo '<select name="' . $box_name . '" >';
	echo '<option value="" ' . $select_none . '>Select One</option>';
	$query = @mysqli_query($conn,$sql);
	while ($rec = @mysqli_fetch_array($query)) { 

		if ($rec[$fieldkey] == $value) $selected = " selected "; else 		$selected= "";
		echo '<option value="' . $rec[$fieldkey] . '" '.  $selected . '>' . $rec[$fieldshow] . " ( " . $rec[$fieldshow2] . ' )</option>';
	} 
    echo '</select>';
}
function CmdDropDown3($conn,$sql, $box_name, $fieldkey, $value, $fieldshow) { 
	if ($value == "0" or $value == "") $select_none = " selected "; else $select_none = "";
	echo '<select name="' . $box_name . '" >';
	echo '<option value="" ' . $select_none . '>Other</option>';
	$query = @mysqli_query($conn,$sql);
	while ($rec = @mysqli_fetch_array($query)) { 

		if ($rec[$fieldkey] == $value) $selected = " selected "; else 		$selected= "";
		echo '<option value="' . $rec[$fieldkey] . '" '.  $selected . '>' . $rec[$fieldshow] . '</option>';
	} 
    echo '</select>';
}
function CmdDropDown4($conn,$sql, $box_name, $fieldkey, $value, $fieldshow) { 
	if ($value == "0" or $value == "") $select_none = " selected "; else $select_none = "";
	echo '<select name="' . $box_name . '" >';
	echo '<option value="" ' . $select_none . '>Select One</option>';
	echo '<option value="" ' . $select_none . '>????</option>';
	$query = @mysqli_query($conn,$sql);
	while ($rec = @mysqli_fetch_array($query)) { 

		if ($rec[$fieldkey] == $value) $selected = " selected "; else 		$selected= "";
		echo '<option value="' . $rec[$fieldkey] . '" '.  $selected . '>' . $rec[$fieldshow] . '</option>';
	} 
    echo '</select>';
}
function CmdListBox($conn,$sql, $box_name, $fieldkey, $value, $fieldshow, $total_value) { 
	echo '<select name="' . $box_name . '" size=15 multiple>';
	echo '<option value=""  >Select One</option>';
	$query = @mysqli_query($conn,$sql);
	while ($rec = @mysqli_fetch_array($query)) { 
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

	if ($sortby <> "" and ($orderby ==  $field_select))  $img = '<img src="../../inner/icons/' . $sortby . '.gif">';
	if ($sortby == "desc" or $sortby == "")  $sortby = "asc"; else 	$sortby  = "desc"; 
	if ($orderby <>  $field_select) $sortby = "asc";
	 $param = "orderby=$orderby";
	if ($FK_field <> "") $param .= "&" . $FK_field . "=" . $$FK_field;
	if ($sortby <> "") $param .= "&sortby=$sortby";
	if ($keyword <> "") $param .= "&keyword=$keyword";

	if ($page <> "") $param .= "&page=".$_GET['page'];
	$link_1 = "<a href ='" . $_SERVER['SCRIPT_NAME'] ."?" . $param ."'>";
	$url =  $link_1 . $cn . "</a>" ;
	if ($sortby <> "") $url .= $img;
	echo $url;
}

function Show_Sort_new ($orderby, $cn,  $field_select, $sortby,$page,$param) { 
	global $FK_field;
	global $$FK_field;
	global $s_domain;
	
	if ($sortby <> "" and ($orderby ==  $field_select))  $img = '<img src="../../inner/icons/' . $sortby . '.gif">';
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


function cal_point($conn,$member_id,$action_type,$point){
				$sql = "select point from member where member_id = '$member_id'";
				$query = @mysqli_query($conn,$sql);
				$rec = @mysqli_fetch_array($query);
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

function Get_Point($conn,$member_id){
	$sql = "select * from transaction where customer_id = '$member_id' order by transaction_id desc";
	$rec = @mysqli_fetch_array(@mysqli_query($conn,$sql));
	$total_point = $rec["total_point"];
	return $total_point;	
}
//---------------------------------------------------------------------------------------------------------------------------------

function Check_Permission($conn,$check_module,$user_id,$action)
{
	$sql = "select * from s_user_group where user_id = '$user_id'";
  	$query = @mysqli_query($conn,$sql) or die ("1");
	$groups = "";

	while ($rec = @mysqli_fetch_array($query)) {
		$groups .= "or group_id = '$rec[group_id]'";
  	}
  	if ($groups <> "") {
		$groups = substr ($groups, 3);
		$groups = " and (" . $groups . ")";
	}
	$sql = "select * from s_module where module_name like '$check_module'";
	$query = @mysqli_query($conn,$sql) or die ("2");
	$module_id = 0;
	while ($rec = @mysqli_fetch_array($query)) {
		$module_id  = $rec["module_id"];
  	}		
	$sql = "select * from s_user where user_id = '$user_id'";
	$query = @mysqli_query($conn,$sql) or die ("3");
	if ($rec = @mysqli_fetch_array($query)) {
		if ($rec["admin_flag"] == '1' or $_SESSION['s_group_all'] == "ALL") {
				
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

		$query = @mysqli_query($conn,$sql) or die ("4");
		if (@mysqli_num_rows ($query)) {

			while ($rec = @mysqli_fetch_array($query)) {
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
				//echo $sql;
				$query = @mysqli_query($conn,$sql) or die("5");
				if (@mysqli_num_rows ($query) == 0) $code = "";
				if ($rec = @mysqli_fetch_array  ($query)) {
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
return $code;
}	
//---------------------------------------------------------------------------------------------------------------------------------

function Check_Permission_menu($conn,$check_module,$user_id,$action)
{
	$permission_denine = 0;
	$sql = "select * from s_user_group where user_id = '$user_id'";
  	$query = @mysqli_query($conn,$sql) or die ("1");
	$groups = "";

	while ($rec = @mysqli_fetch_array($query)) {
		$groups .= "or group_id = '$rec[group_id]'";
  	}
  	if ($groups <> "") {
		$groups = substr ($groups, 3);
		$groups = " and (" . $groups . ")";
	}
	$sql = "select * from s_module where module_name like '$check_module'";
	$query = @mysqli_query($conn,$sql) or die ("2");
	$module_id = 0;
	while ($rec = @mysqli_fetch_array($query)) {
		$module_id  = $rec["module_id"];
  	}		
	$sql = "select * from s_user where user_id = '$user_id'";
	$query = @mysqli_query($conn,$sql) or die ("3");
	if ($rec = @mysqli_fetch_array($query)) {
		if ($rec["admin_flag"] == '1' or $_SESSION['s_group_all'] == "ALL") {
				
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

		$query = @mysqli_query($conn,$sql) or die ("4");
		if (@mysqli_num_rows ($query)) {

			while ($rec = @mysqli_fetch_array($query)) {
				switch ($action) {
					case "read" : $code = $rec["read_p"]; break;
					case "add" :  $code = $rec["add_p"]; break;
					case "update" : $code = $rec["update_p"]; break;
					case "delete" : $code = $rec["delete_p"]; break;
				} 
			}// end while
			if ( ($code == "0") || ($code == "") ) {
				//header ("location:/inner/error/permission.php");
				$permission_denine = 0;
			}

		}
		else
		{
			$code ="";
			if($groups <> "") {
				$sql = "select sum(read_p) as s_read,sum(add_p) as s_add,sum(update_p) as s_update,sum(delete_p) as s_delete,module_id,group_id from s_user_p group by module_id,group_id having module_id like '$module_id' ".$groups ;
				$query = @mysqli_query($conn,$sql) or die("5");
				
				if (@mysqli_num_rows ($query) == 0) $code = "";
				if ($rec = @mysqli_fetch_array  ($query)) {
					switch ($action) {
						case "read" : $code = $rec["s_read"]; break;
						case "add" : $code = $rec["s_add"]; break;
						case "update" : $code = $rec["s_update"]; break;
						case "delete" : $code = $rec["s_delete"]; break;
					}// end switch
				}
			}
  			if (trim($code) == '' or $code == '0') {
  				//header ("location:/inner/error/permission.php");
				$permission_denine = 1;
  			}
  }
   }
}
else
{
//header ("location:/inner/error/permission.php");
$permission_denine = 1;
}
return $permission_denine;
}	

function Show_Full_Category_spec($conn,$value)
{
	$stop = 0;
	$sql = "select * from category_spec where category_spec_id  like '" . $value . "'";
	$query = @mysqli_query($conn,$sql);
	$rec = @mysqli_fetch_array($query) 	;
	$url = $rec["cat_name"];
	$parent_category_id = $rec["parent_category_id"];
	while ($parent_category_id  <> '0' and !$stop ) { 
		//echo "65555555";
	$sql = "select * from category_spec where category_spec_id  like '" . $parent_category_id . "'";
		$query = @mysqli_query($conn,$sql);
		if ($rec = @mysqli_fetch_array($query) )  
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

function record_member($conn,$page_name){
	$now_date = date("Y-m-d");
	$sql = "select * from member_log where user_id = '".$_SESSION['login_id']."' and create_date like '$now_date%' ";
	$query = @mysqli_query($conn,$sql);
	if(@mysqli_num_rows($query) == 0){
		$sql = "insert into member_log (user_id,page_log,create_date) values ('".$_SESSION['login_id']."','$page_name','$now_date') ";
		@mysqli_query($conn,$sql);
	}else{
		$rec = @mysqli_fetch_array($query);
		@reset($a_page_log);
		unset($a_page_log);
		$a_page_log = @explode(",",$rec[page_log]);
		if(!@in_array($page_name,$a_page_log)){
			$page_log = $rec[page_log].",".$page_name;
			$sql = "update member_log set page_log = '$page_log' where member_log_id = '$rec[member_log_id]' ";
			@mysqli_query($conn,$sql);
		}
	}
}
function check_azAZ09($text){
	if(preg_match("/[^0-9A-Za-z]/",$text)) return false;
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
			if( preg_match("/pre_/",$key) && ($value <> "") ) 
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
			if( preg_match("/pre_/",$key) && ($value <> "") )
					 echo "<input type=\"hidden\" name=\"$key\" value=\"$value\">";
		}// end foreach
	}
}
function get_pre_param($a_param){
	$param = "";
	if(count($a_param) > 0) {
		foreach($a_param as $key => $value){ 
			if( $_REQUEST[$value] <> "" )
				$param .= "&&pre_".$value."=".$_REQUEST[$value];
		}
		$param = substr($param,1);
	}
	return $param;
}
function get_return_param(){
	$param = ""; 
	if(count($_REQUEST) > 0) {
		foreach($_REQUEST as $key => $value){
			if( preg_match("/pre_/",$key) && ($value <> "") )
				$param .= "&&".str_replace("pre_","",$key)."=".$value;
		}
		$param = substr($param,1);
	}
	return $param;
}
function check_username($conn,$name){
	$return_id = "";
	$sql = "select * from person where name_th = '$name' or name_en = '$name' ";
	$query = @mysqli_query($conn,$sql);
	if(@mysqli_num_rows($query) > 0) {
		$rec = @mysqli_fetch_array($query);
		$return_id = $rec[person_id];
	}else{
		$username = gen_random(4);
		$password = '1234';
		$stop = 0;
		while($stop != 0){
			$sql = "select * from s_user where username = '$username' and password = '$password' ";
			$query = @mysqli_query($conn,$sql);
			if(@mysqli_num_rows($query) == 0)
				$stop = 1;
			else
				$uername = gen_random(4);
		}
		$sql = "insert into s_user (username , password , create_date , create_by) values ('$username','$password','".date("Y-m-d H:i:s")."' , '".$_SESSION[login_name]."')";
		@mysqli_query($conn,$sql);
		$user_id = mysqli_insert_id($conn);
		
		$sql = "insert into person (name_th , researcher , user_id , create_date , create_by) values ('$name' , '1' , '$user_id' , '".date("Y-m-d H:i:s")."' , '".$_SESSION[login_name]."')";
		@mysqli_query($conn,$sql);
		$return_id = mysqli_insert_id($conn);
	}
	return $return_id;
}

function show_menu($menu_id,$menu_name){
	if(preg_match("/,".$menu_id.",/",$_SESSION['s_menu_id'].",")){
		if($menu_id == $_SESSION['s_now_menu'])
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
//=====================================================================================

function resize($fromimage, $toimage, $size=500, $imagesname="jpg") {
		
			$input	=	$fromimage;
			$output	=	$toimage;
			$size		=	$size;
			#$image=ImageCreateFromJpeg($input);

			$dot	=	strtolower(end(explode('.',$imagesname)));
			#หาค่าขนาดของรูปต้นฉบับ
			if($dot=="jpg" || $dot=="jpeg"){
				$image=ImageCreateFromJpeg($input);
			}elseif($dot=="gif"){
				$image=ImageCreateFromGif($input);
			}elseif($dot=="png"){
				$image=ImageCreateFromPng($input);
			}else{
				$image=ImageCreateFromJpeg($input);
			}

			
			if(ImagesX($image)<$size && ImagesY($image)<$size){
				$newwidth	 	=	ImagesX($image);
				$newheight	=	ImagesY($image);
			}else{
				/*if(ImagesX($image)>ImagesY($image)){
					#----------รูปแนวนอน
					$percen	 		=	($size/ImagesX($image))*100;
					$newwidth	 	=	(ImagesX($image)*$percen)/100;
					$newheight	=	(ImagesY($image)*$percen)/100;
				}elseif(ImagesX($image)<ImagesY($image)){
					#----------รูปแนวนอน
					$percen	 		=	($size/ImagesY($image))*100;
					$newwidth	 	=	(ImagesX($image)*$percen)/100;
					$newheight	=	(ImagesY($image)*$percen)/100;
				}elseif(ImagesX($image)==ImagesY($image)){
					$newwidth	 	=	$size;
					$newheight	=	$size;
				}
			}*/
			if(ImagesX($image)>130){
					#----------รูปแนวนอน
					$percen	 		=	($size/ImagesX($image))*100;
					$newwidth	 	=	(ImagesX($image)*$percen)/100;
					$newheight	=	(ImagesY($image)*$percen)/100;				
				}elseif(ImagesX($image)==ImagesY($image)){
					$newwidth	 	=	$size;
					$newheight	=	$size;
				}
			
			if(ImagesX($image)<130){
					#----------รูปแนวนอน
					$percen	 		=	($size/ImagesX($image))*100;
					$newwidth	 	=	(ImagesX($image)*$percen)/100;
					$newheight	=	(ImagesY($image)*$percen)/100;				
				}elseif(ImagesX($image)==ImagesY($image)){
					$newwidth	 	=	$size;
					$newheight	=	$size;
				}
			}

			$blank	= ImageCreateTrueColor($newwidth,$newheight);
			ImageCopyResampled($blank, $image, 0, 0, 0, 0, $newwidth, $newheight, ImagesX($image), ImagesY($image));
			#ImageJPEG($blank,$output,95);

			if($dot=="jpg" || $dot=="jpeg"){
				ImageJpeg($blank,$output,95);
			}elseif($dot=="gif"){
				ImageGif($blank,$output,95);
			}elseif($dot=="png"){
				ImagePng($blank,$output,95);
			}else{
				ImageJpeg($blank,$output,95);
			}

			ImageDestroy($blank);
		}
//=====================================================================================
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
//------------------------------------------------------------------------------------------------------------
function Show_Flash_banner($pathfiles,$width,$height){
	// have to include  <script type="text/javascript" src="/Scripts/AC_RunActiveContent.js"><script>  in use page
	
	 $msgfiles= "<script type='text/javascript'>AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','".$width."','height','".$height."','src','".$pathfiles."','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','".$pathfiles."' ); //end AC code
          </script>
          <noscript>
          <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0' width='".$width."' height='".$height."'>
            <param name='movie' value='".$pathfiles.".swf' />
            <param name='quality' value='high' />
            <embed src='".$pathfiles.".swf' quality='high' pluginspage='http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash' type='application/x-shockwave-flash' width='".$width."' height='".$height."'></embed></object></noscript>";

return $msgfiles;
}

//---------------------------------------------------------------------------------------------------------------


function chkBrowser($nameBroser){
	return preg_match("/".$nameBroser."/",$_SERVER['HTTP_USER_AGENT']);
}

function dateConvert($date){
	$list_date = explode("-",$date);
	return $list_date[2].'-'.$list_date[1].'-'.$list_date[0];
}


function checkencodeing(){
	
		if($_SESSION['lang'] == "" || $_SESSION['lang'] == "thai"){
			$_SESSION['encodein'] = 'windows-874';
		}else{
			$_SESSION['encodein'] = 'windows-874';
		}
	$encodein = $_SESSION['encodein'];
	return $encodein;
}


function curPageURL() {
	$isHTTPS = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on");
	$port = (isset($_SERVER["SERVER_PORT"]) && ((!$isHTTPS && $_SERVER["SERVER_PORT"] != "80") || ($isHTTPS && $_SERVER["SERVER_PORT"] != "443")));
	$port = ($port) ? ':'.$_SERVER["SERVER_PORT"] : '';
	$url = ($isHTTPS ? 'https://' : 'http://').$_SERVER["SERVER_NAME"].$port.$_SERVER["REQUEST_URI"];
return $url;
}

function language_file($lang){
	$list_lang = explode("/",$_SERVER['SCRIPT_FILENAME']);
	$numlamg = sizeof($list_lang);
	if($lang != ""){
		if($lang == "english"){
			$_SESSION['lang'] = "english";
		}else{
			$_SESSION['lang'] = "thai";
		}
	}else{
		if($_SESSION['lang'] == "" || $_SESSION['lang'] == "thai"){
			$_SESSION['lang'] = "thai";
		}else{
			$_SESSION['lang'] = "english";
		}
	}
	$f_lang = $_SESSION['lang'].'/'.$list_lang[$numlamg-1];
	return $f_lang;
}

function language(){
	
		if($_SESSION['lang'] == "" || $_SESSION['lang'] == "thai"){
			$_SESSION['langs'] = "thai/thai.php";
		}else{
			$_SESSION['langs'] = "english/english.php";
		}
		
	$f_langs = $_SESSION['langs'];
	return $f_langs;
}

function current_page($lang){
	$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https')  === FALSE ? 'http' : 'https';
	$host     = $_SERVER['HTTP_HOST'];
	$script   = $_SERVER['SCRIPT_NAME'];
	//$params   = $_SERVER['QUERY_STRING'];
	//$currentUrl = $protocol . '://' . $host . $script . '?' . $params;
	$currentUrl = $protocol . '://' . $host . $script . '?lang='.$lang;
	echo $currentUrl;	
}

function check_firstorder($conn){
	
	$thdate = substr(date("Y")+543,2);
	$concheck = "FO ".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_first_order WHERE fs_id like '%".$concheck."%' ORDER BY fs_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['fs_id'] == ""){
		return "FO ".$thdate.date("/m/")."001";
	}else{
		$num_odersum = $num_oder+1;
		return "FO ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}
	
}

function check_quotation($conn){
	
	$thdate = substr(date("Y")+543,2);
	$concheck = "QA-B ".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_quotation WHERE fs_id like '%".$concheck."%' ORDER BY fs_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['fs_id'] == ""){
		return "QA-B ".$thdate.date("/m/")."001";
	}else{
		$runQAA = explode("/",$row_forder['fs_id']);
		$runNum = number_format($runQAA[2]);
		$num_odersum = $runNum+1;
		return "QA-B ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}
	
}
function check_quotation2($conn){
	
	$thdate = substr(date("Y")+543,2);
	$concheck = "QA-H ".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_quotation2 WHERE fs_id like '%".$concheck."%' ORDER BY fs_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['fs_id'] == ""){
		return "QA-H ".$thdate.date("/m/")."001";
	}else{
		$runQAA = explode("/",$row_forder['fs_id']);
		$runNum = number_format($runQAA[2]);
		$num_odersum = $runNum+1;
		return "QA-H ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}
	
}

function check_quotation3($conn){
	
	$thdate = substr(date("Y")+543,2);
	$concheck = "QA-R ".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_quotation3 WHERE fs_id like '%".$concheck."%' ORDER BY fs_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['fs_id'] == ""){
		return "QA-R ".$thdate.date("/m/")."001";
	}else{
		$runQAA = explode("/",$row_forder['fs_id']);
		$runNum = number_format($runQAA[2]);
		$num_odersum = $runNum+1;
		return "QA-R ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}
	
}

function check_quotation4($conn){
	
	$thdate = substr(date("Y")+543,2);
	$concheck = "QA-RC ".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_quotation4 WHERE fs_id like '%".$concheck."%' ORDER BY fs_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['fs_id'] == ""){
		return "QA-RC ".$thdate.date("/m/")."001";
	}else{
		$runQAA = explode("/",$row_forder['fs_id']);
		$runNum = number_format($runQAA[2]);
		$num_odersum = $runNum+1;
		return "QA-RC ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}
	
}

function check_contract_number ($conn){
	$thdate = substr(date("Y")+543,2);
	$concheck = "RU ".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_contract WHERE con_id like '%".$concheck."%' ORDER BY con_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['con_id'] == ""){
		return "RU ".$thdate.date("/m/")."001";
	}else{
		$num_odersum = $num_oder+1;
		return "RU ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}
}

function check_contract2_number ($conn){
	$thdate = substr(date("Y")+543,2);
	$concheck = "S ".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_contract2 WHERE con_id like '%".$concheck."%' ORDER BY con_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['con_id'] == ""){
		return "S ".$thdate.date("/m/")."001";
	}else{
		$num_odersum = $num_oder+1;
		return "S ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}
}

function check_contract3_number ($conn){
	$thdate = substr(date("Y")+543,2);
	$concheck = "ODT ".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_contract3 WHERE con_id like '%".$concheck."%' ORDER BY con_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['con_id'] == ""){
		return "ODT ".$thdate.date("/m/")."001";
	}else{
		$num_odersum = $num_oder+1;
		return "ODT ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}
}



function check_serviceorder($conn){
	
	$thdate = substr(date("Y")+543,2);
	$concheck = "SV ".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_first_order WHERE fs_id like '%".$concheck."%' ORDER BY fs_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['fs_id'] == ""){
		return "SV ".$thdate.date("/m/")."001";
	}else{
		$num_odersum = $num_oder+1;
		return "SV ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}
	
}

function check_contactfo($conn){
	
	$thdate = substr(date("Y")+543,2);
	//$concheck = "R".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_first_order ORDER BY r_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['r_id'] == ""){
		return "R".$thdate.date("/m/")."001";
	}else{
		$num_odersum = $num_oder+1;
		return "R".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}
	
}

function check_contact($conn){
	
	$thdate = substr(date("Y")+543,2);
	$concheck = "RV".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_first_order WHERE r_id like '%".$concheck."%' ORDER BY r_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['r_id'] == ""){
		return "RV".$thdate.date("/m/")."001";
	}else{
		$num_odersum = $num_oder+1;
		return "RV".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}
	
}

function check_servicereport($conn){
	
	$thdate = substr(date("Y")+543,2);
	$concheck = "SR ".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_service_report WHERE sv_id like '%".$concheck."%' ORDER BY sv_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['sv_id'] == ""){
		return "SR ".$thdate.date("/m/")."001";
	}else{
		$num_odersum = $num_oder+1;
		return "SR ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}	
}

function check_servicecard($conn){
	
	$thdate = substr(date("Y")+543,2);
	$concheck = "SC ".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_quotation_jobcard WHERE sv_id like '%".$concheck."%' ORDER BY sv_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['sv_id'] == ""){
		return "SC ".$thdate.date("/m/")."001";
	}else{
		$num_odersum = $num_oder+1;
		return "SC ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}	
}

function check_memo($conn){
	
	$thdate = substr(date("Y")+543,2);
	$concheck = "MO ".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_memo WHERE mo_id like '%".$concheck."%' ORDER BY mo_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['mo_id'] == ""){
		return "MO ".$thdate.date("/m/")."001";
	}else{
		$num_odersum = $num_oder+1;
		return "MO ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}	
}


function check_servicereportinstall($conn){
	
	$thdate = substr(date("Y")+543,2);
	$concheck = "IR ".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_service_report4 WHERE sv_id like '%".$concheck."%' ORDER BY sv_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['sv_id'] == ""){
		return "IR ".$thdate.date("/m/")."001";
	}else{
		$num_odersum = $num_oder+1;
		return "IR ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}	
}

function check_serviceman($conn){
	
	$thdate = substr(date("Y")+543,2);
	$concheck = "RP ".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_service_report2 WHERE sv_id like '%".$concheck."%' ORDER BY sv_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['sv_id'] == ""){
		return "RP ".$thdate.date("/m/")."001";
	}else{
		$num_odersum = $num_oder+1;
		return "RP ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}	
}

function check_serviceman2($conn){
	
	$thdate = substr(date("Y")+543,2);
	$concheck = "LP ".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_service_report3 WHERE sv_id like '%".$concheck."%' ORDER BY sv_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['sv_id'] == ""){
		return "LP ".$thdate.date("/m/")."001";
	}else{
		$num_odersum = $num_oder+1;
		return "LP ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}	
}

//function format_date($conn,$value) {
//	list ($s_year, $s_month, $s_day) = explode("-",$value);
//	$year=intval($s_year)+543;
//	return $s_day.'-'.$s_month.'-'.$year;
//}

function format_date($value) {
	list ($s_year, $s_month, $s_day) = explode("-",$value);
	$year=intval($s_year)+543;
	return $s_day.'-'.$s_month.'-'.$year;
}

function format_date2($value) {
	list ($s_year, $s_month, $s_day) = explode("-", $value);
	$year=$s_year+543;
	return $s_day.'/'.$s_month.'/'.$year;
}

function get_groupcusname($conn,$value) {
	$row_cgroup = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_type WHERE group_id = '".$value."'"));
	return $row_cgroup['group_name'];
}

function province_name($conn,$value) {
	$row_provunce = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_province WHERE province_id = '".$value."'"));
	return $row_provunce['province_name'];
}

function custype_name($conn,$value) {
	$row_cusg = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_custommer WHERE group_id = '".$value."'"));
	return $row_cusg['group_name'];
}

function protype_name($conn,$value) {
	$row_protype = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_group_product WHERE group_id = '".$value."'"));
	return $row_protype['group_name'];
}

function getpod_name($conn,$value) {
	$row_protype = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_pod WHERE group_id = '".$value."'"));
	return $row_protype['group_name'];
}

function get_proname($conn,$value) {
	$row_protype = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_group_typeproduct WHERE group_id = '".$value."'"));
	return $row_protype['group_name'];
}

function get_pronamecall($conn,$value) {
	$row_protype = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_group_typeproduct WHERE group_id = '".$value."'"));
	return $row_protype['group_namecall'];
}

function get_prodetail($conn,$value) {
	$row_protype = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_group_typeproduct WHERE group_id = '".$value."'"));
	return $row_protype['group_detail'];
}

function get_servicename($conn,$value) {
	$row_servtype = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_group_service WHERE group_id = '".$value."'"));
	return $row_servtype['group_name'];
}

function get_serial($conn,$value) {
	$row_protype = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_group_typeproduct WHERE group_id = '".$value."'"));
	return $row_protype['group_pro_pod'];
}
function get_sn($conn,$value) {
	$row_protype = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_group_typeproduct WHERE group_id = '".$value."'"));
	return $row_protype['group_pro_sn'];
}
function get_price($conn,$value) {
	$row_protype = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_group_typeproduct WHERE group_id = '".$value."'"));
	return $row_protype['group_pro_price'];
}

function get_sprice($cprice,$camount) {
	
	if(($cprice * $camount) != 0){
		return $prspro = number_format($cprice * $camount,2);
	}else{
		return "";
	}
}

function get_calsprice($cprice,$camount) {
		return $prspro = $cprice * $camount;
}

function get_sumprice($conn,$value) {
	
	$row_fod = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_first_order WHERE fo_id = '".$value."'"));
	
	$proprice1 = get_calsprice($row_fod['cprice1'],$row_fod['camount1']);
	$proprice2 = get_calsprice($row_fod['cprice2'],$row_fod['camount2']);
	$proprice3 = get_calsprice($row_fod['cprice3'],$row_fod['camount3']);
	$proprice4 = get_calsprice($row_fod['cprice4'],$row_fod['camount4']);
	$proprice5 = get_calsprice($row_fod['cprice5'],$row_fod['camount5']);
	$proprice6 = get_calsprice($row_fod['cprice6'],$row_fod['camount6']);
	$proprice7 = get_calsprice($row_fod['cprice7'],$row_fod['camount7']);
	
	$sumproprice = $proprice1 + $proprice2 + $proprice3 + $proprice4 + $proprice5 + $proprice6 + $proprice7;

	return $sumproprice;
}

function get_vatprice($conn,$value) {
	$sumpro = get_sumprice($conn,$value);
	$getvat = ($sumpro * 7) / 100;
	return $getvat;
}

function get_totalprice($conn,$value) {
	$sum = get_sumprice($conn,$value);
	$vat = get_vatprice($conn,$value);
	
	$total = $sum + $vat;
	
	return $total;
}

function get_firstorder($conn,$fo_id) {
	$row_first_order = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_first_order WHERE fo_id = '".$fo_id."'"));
	return $row_first_order;
}

function get_servicereport($conn,$sv_id) {
	$row_service_report = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_service_report WHERE sv_id = '".$sv_id."'"));
	//var_dump($sv_id);
	return $row_service_report;
}


function get_servicereport2($conn,$sr_id) {
	$row_service_report = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_service_report WHERE sr_id = '".$sr_id."'"));
	//var_dump($sv_id);
	return $row_service_report;
}


function get_customername($conn,$fo_id) {
	$row_first_order = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_first_order WHERE fo_id = '".$fo_id."'"));
	return $row_first_order['cd_name'];
}

function get_localsettingname($conn,$fo_id) {
	$row_first_order = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_first_order WHERE fo_id = '".$fo_id."'"));
	return $row_first_order['loc_name'];
}

function get_fixlist($ckf_list) {
	$ckf = explode(',',$ckf_list);
	foreach($ckf as $val){
		$chkd[] = $val; 
	}
	return $chkd;
}

function get_fixname($conn,$ckf) {
	$row_fix = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_group_fix WHERE group_id = '".$ckf."'"));
	return $row_fix['group_name'];		
}

function get_sparpart($conn,$gid) {
	$row_dea = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_group_sparpart WHERE group_id = '".$gid."'"));
	return $row_dea;		
}

function get_sparpart_name($conn,$gid) {
	$row_dea = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_group_sparpart WHERE group_id = '".$gid."'"));
	return $row_dea['group_name'];		
}


function get_servreport($conn,$ymd,$loc,$ctype) {
	
	if($loc != ""){
		$condi .= " AND loc_contact = '".$loc."'";
	}
	
	if($ctype != ""){
		$condi .= " AND sr_ctype = '".$ctype."'";
	}
	
	$qqu_srv = @mysqli_query($conn,"SELECT * FROM s_service_report WHERE job_close = '".$ymd."' ".$condi." LIMIT 4");
	$numsrv = @mysqli_num_rows($qqu_srv);
	$res = "";
	if($numsrv > 0){
		while($row_dea = @mysqli_fetch_array($qqu_srv)){
			$chaf = str_replace("/","-",$row_dea["sv_id"]);
			if($row_dea['st_setting'] == 0){
				$scstatus = "<span style=\"color:green;\">".$row_dea['sv_id']."</span>";
			}else{
				$scstatus = "<span style=\"color:red;\">".$row_dea['sv_id']."</span>";
			}	
			$res .= "&nbsp;<a href=\"../../upload/service_report_open/".$chaf.".pdf\" target=\"_blank\"><strong>".$scstatus."</strong></a>\n<br>\n";
		}	
	}
	
	return $res;		
}

function get_imguser($conn,$userid) {
	$row_fix = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_user WHERE user_id = '".$userid."'"));
	
	if($row_fix['u_images'] == " "){$img = "none.jpg";}
	else{$img = $row_fix['u_images'];}
			
	return $img;		
}

function get_numprosall($conn,$value) {
		
		$row_fod = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_first_order WHERE fo_id = '".$value."'"));
		$numprosall = 0;
		
		if($row_fod['cpro1'] != ""){$numprosall = $numprosall+1;}
		if($row_fod['cpro2'] != ""){$numprosall = $numprosall+1;}
		if($row_fod['cpro3'] != ""){$numprosall = $numprosall+1;}
		if($row_fod['cpro4'] != ""){$numprosall = $numprosall+1;}
		if($row_fod['cpro5'] != ""){$numprosall = $numprosall+1;}
		if($row_fod['cpro6'] != ""){$numprosall = $numprosall+1;}
		if($row_fod['cpro7'] != ""){$numprosall = $numprosall+1;}
		
		return $numprosall;
}

function get_profirsod($conn,$value) {
		
		$row_fod = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_first_order WHERE fo_id = '".$value."'"));
		
		if($row_fod['cpro1'] != ""){$procp[] = $row_fod['cpro1'];}
		if($row_fod['cpro2'] != ""){$procp[] = $row_fod['cpro2'];}
		if($row_fod['cpro3'] != ""){$procp[] = $row_fod['cpro3'];}
		if($row_fod['cpro4'] != ""){$procp[] = $row_fod['cpro4'];}
		if($row_fod['cpro5'] != ""){$procp[] = $row_fod['cpro5'];}
		if($row_fod['cpro6'] != ""){$procp[] = $row_fod['cpro6'];}
		if($row_fod['cpro7'] != ""){$procp[] = $row_fod['cpro7'];}
		
		return $procp;
}

function get_numprofirsod($conn,$value) {
		
		$row_fod = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_first_order WHERE fo_id = '".$value."'"));
		
		if($row_fod['camount1'] != ""){$procp[] = $row_fod['camount1'];}
		if($row_fod['camount2'] != ""){$procp[] = $row_fod['camount2'];}
		if($row_fod['camount3'] != ""){$procp[] = $row_fod['camount3'];}
		if($row_fod['camount4'] != ""){$procp[] = $row_fod['camount4'];}
		if($row_fod['camount5'] != ""){$procp[] = $row_fod['camount5'];}
		if($row_fod['camount6'] != ""){$procp[] = $row_fod['camount6'];}
		if($row_fod['camount7'] != ""){$procp[] = $row_fod['camount7'];}
		
		return $procp;
}

function get_rpfprosrsn($val){
	
	if(get_proname($conn,$val) != ""){$pname = get_proname($conn,$val);}else{$pname = " - ";}
	if(get_serial($conn,$val) != ""){$psr = get_serial($conn,$val);}else{$psr = " - ";}
	if(get_sn($conn,$val) != ""){$psn = get_sn($conn,$val);}else{$psn = " - ";}
		
	return $pname." / ".$psr." / ".$psn;
}


function get_numfixs($conn,$value) {
		
		$row_fspd = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_service_report WHERE sr_id = '".$value."'"));
		$exfix = explode(",",$row_fspd['ckf_list']);
		
		$numd = 0;
		foreach ($exfix as $val){
			$numd = $numd +1;
		}
		
		return $numd;
}

function get_listfixs($conn,$value) {
		
		$row_fspd = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_service_report WHERE sr_id = '".$value."'"));
		$exfix = explode(",",$row_fspd['ckf_list']);

		return $exfix;
}

function get_numspapartsall($conn,$value) {
		
		$row_fspd = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_service_report WHERE sr_id = '".$value."'"));
		$numspartsall = 0;
		
		if($row_fspd['cpro1'] != ""){$numspartsall = $numspartsall+1;}
		if($row_fspd['cpro2'] != ""){$numspartsall = $numspartsall+1;}
		if($row_fspd['cpro3'] != ""){$numspartsall = $numspartsall+1;}
		if($row_fspd['cpro4'] != ""){$numspartsall = $numspartsall+1;}
		if($row_fspd['cpro5'] != ""){$numspartsall = $numspartsall+1;}
		
		return $numspartsall;
}

function get_prospapart($conn,$value) {
		
		$row_fsd = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_service_report WHERE sr_id = '".$value."'"));
		
		if($row_fsd['cpro1'] != ""){$rso[] = $row_fsd['cpro1'];}
		if($row_fsd['cpro2'] != ""){$rso[] = $row_fsd['cpro2'];}
		if($row_fsd['cpro3'] != ""){$rso[] = $row_fsd['cpro3'];}
		if($row_fsd['cpro4'] != ""){$rso[] = $row_fsd['cpro4'];}
		if($row_fsd['cpro5'] != ""){$rso[] = $row_fsd['cpro5'];}
		
		return $rso;
}


function get_lastservice_f($conn,$cusid,$sevid){
	
		$qu_lastservice = @mysqli_query($conn,"SELECT * FROM s_service_report WHERE cus_id = '".$cusid."' ORDER BY sv_id DESC");
		$numlastservice = mysqli_num_rows($qu_lastservice);
		while($row_lasservice = @mysqli_fetch_array($qu_lastservice)){
			$ser_id[] = $row_lasservice['sv_id'];
			$ser_job_balance[] = $row_lasservice['job_balance'];
		}
	
		$arraysearch = @array_search($sevid,$ser_id);
		
		if($ser_id[$arraysearch+1] != ""){
			return format_date($conn,$ser_job_balance[$arraysearch+1]);
		}else{
			return " - ";		
		}
}

function get_lastservice_s($conn,$cusid,$sevid){
	
		$qu_lastservice = @mysqli_query($conn,"SELECT * FROM s_service_report WHERE cus_id = '".$cusid."' ORDER BY sv_id DESC");
		$numlastservice = mysqli_num_rows($qu_lastservice);
		while($row_lasservice = @mysqli_fetch_array($qu_lastservice)){
			$ser_id[] = $row_lasservice['sv_id'];
			$ser_job_balance[] = $row_lasservice['job_balance'];
		}
	
		$arraysearch = @array_search($sevid,$ser_id);
		
		if($ser_id[$arraysearch] != ""){
			return format_date($conn,$ser_job_balance[$arraysearch]);
		}else{
			return " - ";		
		}
}

function get_technician($conn,$val) {
	$row_dea = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_technician WHERE group_id = '".$val."'"));
	return $row_dea;		
}

function get_technician_name($conn,$val) {
	$row_dea = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_technician WHERE group_id = '".$val."'"));
	return $row_dea['group_name'];		
}

function get_technician_id($conn,$val) {
	$row_dea = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_technician WHERE group_id = '".$val."'"));
	return $row_dea['group_cus_id'];		
}

function get_sale_id($conn,$val) {
	$row_dea = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_sale WHERE group_id = '".$val."'"));
	return $row_dea['group_cus_id'];		
}

function getsalenameFO($conn,$val){
	$row_fod = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_first_order WHERE fo_id = '".$val."'"));
	return getsalename($conn,$row_fod['cs_sell']);
}

function getlocalAddressFO($conn,$val){
	$row_fod = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_first_order WHERE fo_id = '".$val."'"));
	return $row_fod['loc_address'];
}



function getsalename($conn,$val) {
	$row_dea = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_sale WHERE group_id = '".$val."'"));
	return $row_dea['group_name'];		
}

function getcustom_type($conn,$val) {
	$row_dea = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_custommer WHERE group_id = '".$val."'"));
	return $row_dea['group_name'];		
}

function get_profirstorder($conn,$val) {
	$row_pfirst = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_first_order WHERE fo_id = '".$val."'"));
	
	$row_pfirst['cpro1'];
	$row_pfirst['cpro2'];
	$row_pfirst['cpro3'];
	$row_pfirst['cpro4'];
	$row_pfirst['cpro5'];
	$row_pfirst['cpro6'];
	$row_pfirst['cpro7'];
	
	if($row_pfirst['cpro1'] != ""){$prolist[] = $row_pfirst['cpro1'];}
	if($row_pfirst['cpro2'] != ""){$prolist[] = $row_pfirst['cpro2'];}
	if($row_pfirst['cpro3'] != ""){$prolist[] = $row_pfirst['cpro3'];}
	if($row_pfirst['cpro4'] != ""){$prolist[] = $row_pfirst['cpro4'];}
	if($row_pfirst['cpro5'] != ""){$prolist[] = $row_pfirst['cpro5'];}
	if($row_pfirst['cpro6'] != ""){$prolist[] = $row_pfirst['cpro6'];}
	if($row_pfirst['cpro7'] != ""){$prolist[] = $row_pfirst['cpro7'];}

	return $prolist;		
}
function get_podfirstorder($conn,$val) {
	$row_pfirst = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_first_order WHERE fo_id = '".$val."'"));
	
	$row_pfirst['pro_pod1'];
	$row_pfirst['pro_pod2'];
	$row_pfirst['pro_pod3'];
	$row_pfirst['pro_pod4'];
	$row_pfirst['pro_pod5'];
	$row_pfirst['pro_pod6'];
	$row_pfirst['pro_pod7'];

	if($row_pfirst['pro_pod1'] != ""){$propodlist[] = $row_pfirst['pro_pod1'];}
	if($row_pfirst['pro_pod2'] != ""){$propodlist[] = $row_pfirst['pro_pod2'];}
	if($row_pfirst['pro_pod3'] != ""){$propodlist[] = $row_pfirst['pro_pod3'];}
	if($row_pfirst['pro_pod4'] != ""){$propodlist[] = $row_pfirst['pro_pod4'];}
	if($row_pfirst['pro_pod5'] != ""){$propodlist[] = $row_pfirst['pro_pod5'];}
	if($row_pfirst['pro_pod6'] != ""){$propodlist[] = $row_pfirst['pro_pod6'];}
	if($row_pfirst['pro_pod7'] != ""){$propodlist[] = $row_pfirst['pro_pod7'];}
	
	return $propodlist;		
}
function get_snfirstorder($conn,$val) {
	$row_pfirst = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_first_order WHERE fo_id = '".$val."'"));

	$row_pfirst['pro_sn1'];
	$row_pfirst['pro_sn2'];
	$row_pfirst['pro_sn3'];
	$row_pfirst['pro_sn4'];
	$row_pfirst['pro_sn5'];
	$row_pfirst['pro_sn6'];
	$row_pfirst['pro_sn7'];

	if($row_pfirst['pro_sn1'] != ""){$prosnlist[] = $row_pfirst['pro_sn1'];}
	if($row_pfirst['pro_sn2'] != ""){$prosnlist[] = $row_pfirst['pro_sn2'];}
	if($row_pfirst['pro_sn3'] != ""){$prosnlist[] = $row_pfirst['pro_sn3'];}
	if($row_pfirst['pro_sn4'] != ""){$prosnlist[] = $row_pfirst['pro_sn4'];}
	if($row_pfirst['pro_sn5'] != ""){$prosnlist[] = $row_pfirst['pro_sn5'];}
	if($row_pfirst['pro_sn6'] != ""){$prosnlist[] = $row_pfirst['pro_sn6'];}
	if($row_pfirst['pro_sn7'] != ""){$prosnlist[] = $row_pfirst['pro_sn7'];}
	
	return $prosnlist;		
}
function get_snfirstorders($conn,$val) {
	
	$row_pfirst = @mysqli_fetch_array(@mysqli_query($conn,"SELECT fs_id FROM `s_first_order` WHERE fs_id like '%".$val."'"));
	
	if($row_pfirst['fs_id'] != $val){
		return $val;
	}else{
		$row_pfirsts = @mysqli_fetch_array(@mysqli_query($conn,"SELECT `fs_id` FROM `s_first_order` WHERE `fs_id` like '%".substr($val,0,9)."%' ORDER BY `fo_id` DESC"));
		$fsid = $row_pfirsts['fs_id'];
		$fsid = sprintf("%03d",(substr($fsid,-3)+1));
		return substr($val,0,9).$fsid;
		
	}
}

function backup_tables($conn,$host,$user,$pass,$name,$tables = '*'){
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysqli_query($conn,'SHOW TABLES');
		while($row = mysqli_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table){
		$result = mysqli_query($conn,'SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysqli_fetch_row(mysqli_query($conn,'SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysqli_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = preg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	$fildatabase = 'db-backup-'.time().'.sql';
	$handle = fopen('../../upload/database/'.$fildatabase,'w+');
	fwrite($handle,$return);
	fclose($handle);
	
	return $fildatabase;
}

function get_listspart($conn,$db,$val) {
	$qu_pfirst = @mysqli_query($conn,"SELECT * FROM ".$db." WHERE sr_id = '".$val."'");
	$sdc = '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
	while($row = @mysqli_fetch_array($qu_pfirst)){
		$sdc .='<tr>
		  <td>'.$row['lists'].'</td>
		  <td>'.$row['prices'].'</td>
		  <td>'.($row['prices']*$row['amounts']).'</td>
		</tr>';
	}
	$sdc .= '</table>';
	return $sdc;
}

function get_plusminus($conn,$db1,$db2,$rid,$sid){
	$row_open = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM ".$db2." WHERE r_id ='".$rid."'"));
	
	@mysqli_query($conn,"UPDATE `".$db1."` SET `group_stock` = `group_stock` + '".$row_open['opens']."' WHERE `group_id` = '".$sid."';");
	//@mysqli_query($conn,"UPDATE `".$db2."` SET `amounts` = `amounts` + '".$row_open['opens']."' WHERE `r_id` = '".$rid."';");	
}

function get_plusminus2($conn,$db1,$db2,$rid,$sid){
	$row_open = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM ".$db2." WHERE r_id ='".$rid."'"));
	
	@mysqli_query($conn,"UPDATE `".$db1."` SET `group_stock` = `group_stock` - '".$row_open['remains']."' WHERE `group_id` = '".$sid."';");
	//@mysqli_query($conn,"UPDATE `".$db2."` SET `amounts` = `amounts` + '".$row_open['opens']."' WHERE `r_id` = '".$rid."';");	
}

function get_srreport($conn,$fo_id){
	$row_close = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_service_report WHERE cus_id = '".$fo_id."' ORDER BY sr_id DESC"));
	return $row_close['sv_id'];
}

function get_foid($conn,$fo_id){
	$row_close = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_first_order WHERE fo_id = '".$fo_id."'"));
	return $row_close['fs_id'];
}

function get_number_technician_cost($conn,$job_id){
	$row_count = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_service_cost WHERE job_id = '".$job_id."'"));
	
	$num  = 0;
	if($row_count['technician1'] != "0"){$num = $num+1;}
	if($row_count['technician2'] != "0"){$num = $num+1;}
	if($row_count['technician3'] != "0"){$num = $num+1;}
	if($row_count['technician4'] != "0"){$num = $num+1;}
	if($row_count['technician5'] != "0"){$num = $num+1;}
	if($row_count['technician6'] != "0"){$num = $num+1;}
	if($row_count['technician7'] != "0"){$num = $num+1;}
	if($row_count['technician8'] != "0"){$num = $num+1;}
	
	return $num;
}

const BAHT_TEXT_NUMBERS = array('ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า');
const BAHT_TEXT_UNITS = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
const BAHT_TEXT_ONE_IN_TENTH = 'เอ็ด';
const BAHT_TEXT_TWENTY = 'ยี่';
const BAHT_TEXT_INTEGER = 'ถ้วน';
const BAHT_TEXT_BAHT = 'บาท';
const BAHT_TEXT_SATANG = 'สตางค์';
const BAHT_TEXT_POINT = 'จุด';
/**
 * Convert baht number to Thai text
 * @param double|int $number
 * @param bool $include_unit
 * @param bool $display_zero
 * @return string|null
 */
function baht_text($number, $include_unit = true, $display_zero = true)
{
    if(!is_numeric($number))
    {
        return null;
    }
    $log = floor(log($number, 10));
    if($log > 5)
    {
        $millions = floor($log / 6);
        $million_value = pow(1000000, $millions);
        $normalised_million = floor($number / $million_value);
        $rest = $number - ($normalised_million * $million_value);
        $millions_text = '';
        for($i = 0; $i < $millions; $i++)
        {
            $millions_text .= BAHT_TEXT_UNITS[6];
        }
        return baht_text($normalised_million, false) . $millions_text . baht_text($rest, true, false);
    }
    $number_str = (string)floor($number);
    $text = '';
    $unit = 0;
    if($display_zero && $number_str == '0')
    {
        $text = BAHT_TEXT_NUMBERS[0];
    }
    else for($i = strlen($number_str) - 1; $i > -1; $i--)
    {
        $current_number = (int)$number_str[$i];
        $unit_text = '';
        if($unit == 0 && $i > 0)
        {
            $previous_number = isset($number_str[$i - 1]) ? (int)$number_str[$i - 1] : 0;
            if($current_number == 1 && $previous_number > 0)
            {
                $unit_text .= BAHT_TEXT_ONE_IN_TENTH;
            }
            else if($current_number > 0)
            {
                $unit_text .= BAHT_TEXT_NUMBERS[$current_number];
            }
        }
        else if($unit == 1 && $current_number == 2)
        {
            $unit_text .= BAHT_TEXT_TWENTY;
        }
        else if($current_number > 0 && ($unit != 1 || $current_number != 1))
        {
            $unit_text .= BAHT_TEXT_NUMBERS[$current_number];
        }
        if($current_number > 0)
        {
            $unit_text .= BAHT_TEXT_UNITS[$unit];
        }
        $text = $unit_text . $text;
        $unit++;
    }
    if($include_unit)
    {
        $text .= BAHT_TEXT_BAHT;
        $satang = explode('.', number_format($number, 2, '.', ''))[1];
        if($satang == 0)
        {
            $text .= BAHT_TEXT_INTEGER;
        }
        else
        {
            $text .= baht_text($satang, false) . BAHT_TEXT_SATANG;
        }
    }
    else
    {
        $exploded = explode('.', $number);
        if(isset($exploded[1]))
        {
            $text .= BAHT_TEXT_POINT;
            $decimal = (string)$exploded[1];
            for($i = 0; $i < strlen($decimal); $i++)
            {
                $text .= BAHT_TEXT_NUMBERS[$decimal[$i]];
            }
        }
    }
    return $text;
}

function getQaBNumber($conn,$id){

	$rowQA = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_quotation WHERE qu_id = '".$id."'"));
	return $rowQA['fs_id'];
}

function checkNumContractRent($conn,$id){

	$rowNum = @mysqli_num_rows(@mysqli_query($conn,"SELECT * FROM s_contract WHERE cus_id = '".$id."'"));
	return $rowNum;
}

function checkContractRent($conn,$id){

	$rowQA = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_contract WHERE cus_id = '".$id."' ORDER BY ct_id ASC"));
	return $rowQA;
}

function getQaHNumber($conn,$id){

	$rowQA = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_quotation2 WHERE qu_id = '".$id."'"));
	return $rowQA['fs_id'];
}

function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
	$imgsize = getimagesize($source_file);
	$width = $imgsize[0];
	$height = $imgsize[1];
	$mime = $imgsize['mime'];

	switch($mime){
			case 'image/gif':
					$image_create = "imagecreatefromgif";
					$image = "imagegif";
					break;

			case 'image/png':
					$image_create = "imagecreatefrompng";
					$image = "imagepng";
					$quality = 7;
					break;

			case 'image/jpeg':
					$image_create = "imagecreatefromjpeg";
					$image = "imagejpeg";
					$quality = 80;
					break;

			default:
					return false;
					break;
	}
	 
	$dst_img = imagecreatetruecolor($max_width, $max_height);
	$src_img = $image_create($source_file);
	 
	$width_new = $height * $max_width / $max_height;
	$height_new = $width * $max_height / $max_width;
	//if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
	if($width_new > $width){
			//cut point by height
			$h_point = (($height - $height_new) / 2);
			//copy image
			imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
	}else{
			//cut point by width
			$w_point = (($width - $width_new) / 2);
			imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
	}
	 
	$image($dst_img, $dst_dir, $quality);

	if($dst_img)imagedestroy($dst_img);
	if($src_img)imagedestroy($src_img);
}
//usage example

function resizeImage($filename, $max_width, $max_height)
{
    list($orig_width, $orig_height) = getimagesize($filename);

    $width = $orig_width;
    $height = $orig_height;

    # taller
    if ($height > $max_height) {
        $width = ($max_height / $height) * $width;
        $height = $max_height;
    }

    # wider
    if ($width > $max_width) {
        $height = ($max_width / $width) * $height;
        $width = $max_width;
    }

    $image_p = imagecreatetruecolor($width, $height);

    $image = imagecreatefromjpeg($filename);

    imagecopyresampled($image_p, $image, 0, 0, 0, 0, 
                                     $width, $height, $orig_width, $orig_height);

    return $image_p;
}

function getScheduleFile($conn,$technician,$month,$fo_id){
	$rowSchedule = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `service_schedule` WHERE `month` = ".$month." AND `technician` = ".$technician." AND `fo_id` LIKE '".$fo_id."' ORDER BY `sv_id`"));
	return $rowSchedule;
}

function get_quotation($conn,$cus_id,$tab) {
	
	if($tab == 2){
		$table = "s_quotation2";
		$sql = "SELECT * FROM  ".$table." WHERE qu_id = '".$cus_id."'";
	}else if($tab == 3){
		$table = "s_first_order";
		$sql = "SELECT * FROM  ".$table." WHERE fo_id = '".$cus_id."'";
	}else{
		$table = "s_quotation";
		$sql = "SELECT * FROM  ".$table." WHERE qu_id = '".$cus_id."'";
	}
	
	$row_quotation = @mysqli_fetch_array(@mysqli_query($conn,$sql));
	return $row_quotation;
}

function get_technician_signature($conn,$technic_id) {
	
	$rowTechnic = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `s_group_technician` WHERE group_id = '".$technic_id."'"));
	
	$rowAccount = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `s_user` WHERE user_id = '".$rowTechnic['user_account']."'"));
	
	$signature = '';
	
	if($rowAccount['signature'] != ''){
		$signature = $rowAccount['signature'];
	}else{
		$signature = 'none.png';
	}
	
	return $signature;
	
}

function get_sale_signature($conn,$sale_id) {
	
	$rowSale = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `s_group_sale` WHERE group_id = '".$sale_id."'"));
	
	$rowAccount = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `s_user` WHERE user_id = '".$rowSale['user_account']."'"));
	
	$signature = '';
	
	if($rowAccount['signature'] != ''){
		$signature = $rowAccount['signature'];
	}else{
		$signature = 'none.png';
	}
	
	return $signature;
	
}

function get_hsale_signature($conn) {
	
	$rowSale = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `s_group_approve` WHERE group_id = 1"));
	
	$rowAccount = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `s_user` WHERE user_id = '".$rowSale['user_account']."'"));
	
	$signature = '';
	
	if($rowAccount['signature'] != ''){
		$signature = $rowAccount['signature'];
	}else{
		$signature = 'none.png';
	}
	
	return $signature;
	
}

function get_haccount_signature($conn) {
	
	$rowSale = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `s_group_approve` WHERE group_id = 2"));
	
	$rowAccount = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `s_user` WHERE user_id = '".$rowSale['user_account']."'"));
	
	$signature = '';
	
	if($rowAccount['signature'] != ''){
		$signature = $rowAccount['signature'];
	}else{
		$signature = 'none.png';
	}
	
	return $signature;
	
}

function get_hcompany_signature($conn) {
	
	$rowSale = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `s_group_approve` WHERE group_id = 3"));
	
	$rowAccount = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `s_user` WHERE user_id = '".$rowSale['user_account']."'"));
	
	$signature = '';
	
	if($rowAccount['signature'] != ''){
		$signature = $rowAccount['signature'];
	}else{
		$signature = 'none.png';
	}
	
	return $signature;
	
}

function get_htecnic_signature($conn) {
	
	$rowSale = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `s_group_approve` WHERE group_id = 4"));
	
	$rowAccount = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `s_user` WHERE user_id = '".$rowSale['user_account']."'"));
	
	$signature = '';
	
	if($rowAccount['signature'] != ''){
		$signature = $rowAccount['signature'];
	}else{
		$signature = 'none.png';
	}
	
	return $signature;
	
}

function get_user_signature($conn,$user_id) {
	
	$rowAccount = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `s_user` WHERE user_id = '".$user_id."'"));
	
	$signature = '';
	
	if($rowAccount['signature'] != ''){
		$signature = $rowAccount['signature'];
	}else{
		$signature = 'none.png';
	}
	
	return $signature;
	
}

function get_username($conn,$userid) {
	$row_fix = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_user WHERE user_id = '".$userid."'"));	
	return $row_fix['name'];		
}

function get_useraccount($conn,$userid) {
	$row_fix = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_user WHERE user_id = '".$userid."'"));	
	return $row_fix['username'];		
}

function getNameSaleApprove($conn){
	$row_name = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_approve WHERE group_id = 1"));
	$row_user = get_username($conn,$row_name['user_account']);	
	return $row_user;
}

function getNameAccountApprove($conn){
	$row_name = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_approve WHERE group_id = 2"));
	$row_user = get_username($conn,$row_name['user_account']);	
	return $row_user;
}

function getNameBigApprove($conn){
	$row_name = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_approve WHERE group_id = 3"));
	$row_user = get_username($conn,$row_name['user_account']);	
	return $row_user;
}

function getNameTecApprove($conn){
	$row_name = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_approve WHERE group_id = 4"));
	$row_user = get_username($conn,$row_name['user_account']);	
	return $row_user;
}


function checkUserApproved($conn,$userID){
	$row_name = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_approve WHERE user_account = '".$userID."'"));
	if($row_name['group_id'] != ""){
		return $row_name['group_id'];
	}else{
		return '99';
	}
}

function getNumApproveFO($conn,$process){
	$quApprove = mysqli_query($conn,"SELECT * FROM s_first_order WHERE process = '".$process."';");
 	$numApprove = mysqli_num_rows($quApprove);
	return $numApprove;
}

function getNumApproveSVJ($conn,$process){
	$quApprove = mysqli_query($conn,"SELECT * FROM s_quotation_jobcard WHERE process = '".$process."';");
 	$numApprove = mysqli_num_rows($quApprove);
	return $numApprove;
}

function getNumApproveMEMO($conn,$process){
	$quApprove = mysqli_query($conn,"SELECT * FROM s_memo WHERE process = '".$process."';");
 	$numApprove = mysqli_num_rows($quApprove);
	return $numApprove;
}

function getNumApproveQAB($conn,$process){
	$quApprove = mysqli_query($conn,"SELECT * FROM s_quotation WHERE process = '".$process."';");
 	$numApprove = mysqli_num_rows($quApprove);
	return $numApprove;
}

function getNumApproveQAH($conn,$process){
	$quApprove = mysqli_query($conn,"SELECT * FROM s_quotation2 WHERE process = '".$process."';");
 	$numApprove = mysqli_num_rows($quApprove);
	return $numApprove;
}

function getNumApproveSV($conn,$process){
	$quApprove = mysqli_query($conn,"SELECT * FROM s_service_report WHERE process = '".$process."';");
 	$numApprove = mysqli_num_rows($quApprove);
	return $numApprove;
}

function checkSaleMustApprove($conn,$sale_id){
	$rowSale = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_sale WHERE group_id = '".$sale_id."';"));
	return $rowSale['approve'];
}

function checkProcess($conn,$tag_db,$PK_field,$id){
	$rowProcess = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM ".$tag_db." WHERE ".$PK_field." = '".$id."';"));
	return $rowProcess['process'];
}

function checkHSaleApplove($conn,$tag_db,$t_id){
	$quApprove = @mysqli_query($conn,"SELECT * FROM s_approve WHERE tag_db = '".$tag_db."' AND t_id = '".$t_id."' AND process_1 = '1';");
	$numApprove = mysqli_num_rows($quApprove);
	return $numApprove;
}

function checkHAccountApplove($conn,$tag_db,$t_id){
	$quApprove = @mysqli_query($conn,"SELECT * FROM s_approve WHERE tag_db = '".$tag_db."' AND t_id = '".$t_id."' AND process_2 = '1';");
	$numApprove = mysqli_num_rows($quApprove);
	return $numApprove;
}

function checkHCompanyApplove($conn,$tag_db,$t_id){
	$quApprove = @mysqli_query($conn,"SELECT * FROM s_approve WHERE tag_db = '".$tag_db."' AND t_id = '".$t_id."' AND process_3 = '1';");
	$numApprove = mysqli_num_rows($quApprove);
	return $numApprove;
}

function checkHTecnicalApplove($conn,$tag_db,$t_id){
	$quApprove = @mysqli_query($conn,"SELECT * FROM s_approve WHERE tag_db = '".$tag_db."' AND t_id = '".$t_id."' AND process_4 = '1';");
	$numApprove = mysqli_num_rows($quApprove);
	return $numApprove;
}

function checkHCustomerApplove($conn,$id){
	$quApprove = @mysqli_query($conn,"SELECT * FROM s_service_report WHERE sr_id = '".$id."'");
	$numApprove = mysqli_fetch_array($quApprove);
	return $numApprove['signature'];
}

function getServiceImg($conn,$id){
	$quImg = @mysqli_query($conn,"SELECT * FROM s_service_report WHERE sr_id = '".$id."'");
	$numImg = mysqli_fetch_array($quImg);
	return $numImg['service_image'];
}

function getTypeService($id){

	switch ($id) {
		case "2":
			return "เครื่องล้างแก้ว";
			break;
		case "3":
			return "เครื่องผลิตน้ำแข็ง";
			break;
		default:
			return "เครื่องล้างจาน";
	}
}

function getTypeServiceDesc($id,$word){

	switch ($id) {
		case "2":
			$new_str = str_replace('เครื่องผลิตน้ำแข็ง', 'เครื่องล้างแก้ว', $word);
			$new_str = str_replace('เครื่องล้างจาน', 'เครื่องล้างแก้ว', $new_str);
			return $new_str;
			break;
		case "3":
			$new_str = str_replace('เครื่องล้างแก้ว', 'เครื่องผลิตน้ำแข็ง', $word);
			$new_str = str_replace('เครื่องล้างจาน', 'เครื่องผลิตน้ำแข็ง', $new_str);
			return $new_str;
			break;
		default:
			$new_str = str_replace('เครื่องล้างแก้ว', 'เครื่องล้างจาน', $word);
			$new_str = str_replace('เครื่องผลิตน้ำแข็ง', 'เครื่องล้างจาน', $new_str);
			return $new_str;
	}
}


function getpod_id($conn,$value) {
	$row_protype = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_group_pod WHERE group_name = '".$value."'"));
	return $row_protype['group_id'];
}

function get_firstorder_qr($conn,$sn) {
	
	//AND `status_use` != '2' ดาวแดง
	
	$row_first_order = @mysqli_fetch_array(@mysqli_query($conn,"SELECT *  FROM `s_first_order` WHERE 1 AND (`pro_sn1` LIKE '".$sn."' OR `pro_sn1` LIKE '".$sn."' OR `pro_sn2` LIKE '".$sn."' OR `pro_sn3` LIKE '".$sn."' OR `pro_sn4` LIKE '".$sn."' OR `pro_sn5` LIKE '".$sn."' OR `pro_sn6` LIKE '".$sn."' OR `pro_sn7` LIKE '".$sn."') AND `status_use` != '2' ORDER BY `fo_id`  DESC"));
	
	return $row_first_order;
}

function chkSeries($conn,$sn,$foid) {
	
//	$sqlSN = "SELECT *  FROM `s_first_order` WHERE 1 AND (`pro_sn1` LIKE '".$sn."' OR `pro_sn1` LIKE '".$sn."' OR `pro_sn2` LIKE '".$sn."' OR `pro_sn3` LIKE '".$sn."' OR `pro_sn4` LIKE '".$sn."' OR `pro_sn5` LIKE '".$sn."' OR `pro_sn6` LIKE '".$sn."' OR `pro_sn7` LIKE '".$sn."') AND `status_use` != '2' AND fo_id != '".$foid."' ORDER BY `fo_id`  DESC";
	
	$sqlSN = "SELECT *  FROM `s_first_order` WHERE 1 AND (`pro_sn1` LIKE '".$sn."' OR `pro_sn1` LIKE '".$sn."' OR `pro_sn2` LIKE '".$sn."' OR `pro_sn3` LIKE '".$sn."' OR `pro_sn4` LIKE '".$sn."' OR `pro_sn5` LIKE '".$sn."' OR `pro_sn6` LIKE '".$sn."' OR `pro_sn7` LIKE '".$sn."') AND `status_use` != '2' AND fo_id != '".$foid."' AND `fs_id` NOT LIKE 'SV%' ORDER BY `fo_id`  DESC";
	
	$qu_prosn = @mysqli_query($conn,$sqlSN);
	$row_prosn = @mysqli_num_rows($qu_prosn);
	return $row_prosn;
}

function checkFOInputFix($conn,$fo_id){
	
	$sqlFO = "SELECT * FROM s_first_order WHERE fo_id = ".$fo_id;
	$quFO = mysqli_query($conn,$sqlFO);
	$rowFO = mysqli_fetch_array($quFO);
	
	$chkFO = array("cd_name", "cd_address", "cd_tel", "cd_tax", "c_contact", "cg_type", "ctype", "pro_type", "po_id", "loc_name", "loc_address", "date_quf", "date_qut", "name_consign", "qucomment", "cs_contact", "cs_tel", "cs_ship", "cs_setting", "cpro1", "pro_pod1", "pro_sn1", "camount1", "cprice1");
	
	$valChk = 0;
	
	for($i=0;$i<count($chkFO);$i++){
		if($rowFO[$chkFO[$i]] == ""){
			$valChk = 1;
		}
	}
	
	for($j=2;$j<8;$j++){
		if($rowFO['cpro'.$j] != ""){
			if($rowFO['pro_pod'.$j] == "" || $rowFO['pro_sn'.$j] == "" || $rowFO['camount'.$j] == "" || $rowFO['cprice'.$j] == ""){
				$valChk = 1;
			}
		}
	}
	
	if($rowFO['prowithliquid'] == '2'){
		$valChk = 0;
	}
	
	return $valChk;
	
}

function diffMonth($from, $to) {
    $month_in_year = 12;
    $date_from = getdate(strtotime($from));
    $date_to = getdate(strtotime($to));
    return ($date_to['year'] - $date_from['year']) * $month_in_year -
        ($month_in_year - $date_to['mon']) +
        ($month_in_year - $date_from['mon'])+1;
}

function convertDate($date,$fomat){
	
	$date = str_replace('/', '-', $date);
	$newDate = date($fomat, strtotime($date));
	
	return $newDate;
}


function get_sparpart_id($conn,$gid) {
	$row_dea = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_group_sparpart WHERE group_id = '".$gid."'"));
	return $row_dea['group_spar_id'];		
}

function getStockSpar($conn,$gid){
	$row_dea = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM  s_group_sparpart WHERE group_id = '".$gid."'"));
	return $row_dea['group_stock'];	
}

function check_servicerepair($conn){
	
	$thdate = substr(date("Y")+543,2);
	$concheck = "RO ".$thdate.date("/m/");
	
	$qu_forder = @mysqli_query($conn,"SELECT * FROM s_service_report6 WHERE sv_id like '%".$concheck."%' ORDER BY sv_id DESC");
	$num_oder = @mysqli_num_rows($qu_forder);
	$row_forder = @mysqli_fetch_array($qu_forder);
	
	if($row_forder['sv_id'] == ""){
		return "RO ".$thdate.date("/m/")."001";
	}else{
		$num_odersum = $num_oder+1;
		return "RO ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
	}	
}

?>


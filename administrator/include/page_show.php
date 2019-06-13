<!--
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="23%"><div align="left"><?php  echo "Page: " . $page  . " of " . $pagecount . " page(s)";?></div></td>
    <td width="77%"><div align="right">แสดง : page <a href="<?php  echo  $_SERVER['PHP_SELF'] . "?pagesize=10"; ?>">10</a> <a href="<?php  echo  $_SERVER['PHP_SELF'] . "?pagesize=25"; ?>">25</a> <a href="<?php  echo  $_SERVER['PHP_SELF'] . "?pagesize=50"; ?>">50</a> <a href="<?php  echo  $_SERVER['PHP_SELF'] . "?pagesize=100"; ?>">100</a></div></td>
  </tr>
</table>
-->
<?php 
if (!isset ($limit_page)) $limit_page = 15;
$parameter = "";
foreach ($_GET as $key=>$value) {
	if ($key <> "page" ) 
		$parameter .= "&" .  $key  . "=" . $value;
}
$parameter = substr ($parameter, 1, strlen ($parameter)) ;
echo "<br>";
echo "<center>";
// ############### แสดงเลขหน้า, และลิงค์ไปยังหน้าต่างๆ #################
$prevpage = $_REQUEST['page'] -1;
$nextpage = $_REQUEST['page']+1;

	if ($_REQUEST['page']==1) {
		// ไม่แสดงลิงค์ "กลับ"
	} else {
		echo "<a href=\"$PHP_SELF?page=$prevpage" . "&" . $parameter . "\">ก่อนหน้า</a>";
	}

		if ($pagecount==1) {
	// ไม่ต้องแสดงเลขหน้า
		} else {
		$start_page_no = floor (($_REQUEST['page'] -1) / $limit_page ) * $limit_page + 1;
		//	echo floor ($page / $limit_page) . " : " .$start_page_no;
//			if ($start_page_no + $limit_page > $pagecount ) $stop_page_no = $pagecount; else $stop_page_no = $start_page_no + $limit_page-1;
			if ($start_page_no + $limit_page > $pagecount ) $stop_page_no = $pagecount; else $stop_page_no = $start_page_no + $limit_page -1;
			for ($i=$start_page_no;$i<= $stop_page_no ;$i++) {
				if ($i==$_REQUEST['page']) {
				echo " <b>$i</b> ";
				} else {
				echo "  <a href=\"$PHP_SELF?page=$i&" . $parameter ."\">$i</a>  ";
				}
		}
	}

//$page = (int)$page;
	if ($_REQUEST['page']==$pagecount or $pagecount == 0) {
		// ไม่แสดงลิงค์ "ถัดไป"
	} else {
		echo " <a href=\"$PHP_SELF?page=$nextpage&" . $parameter ."\">ถัดไป</a><br>";
	}
// ######################################################
echo "</center>";

?>
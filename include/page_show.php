
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="23%"><div align="left"><?php  echo "Page: " . $page  . " of " . $pagecount . " page(s)";?></div></td>
    <td width="77%"><div align="right">
      <?php 
if (!isset ($limit_page)) $limit_page = 15;
$parameter = "";
foreach ($_GET as $key=>$value) {
	if ($key <> "page" ) 
		$parameter .= "&" .  $key  . "=" . $value;
}
$parameter = substr ($parameter, 1, strlen ($parameter)) ;
$prevpage = $_REQUEST['page'] -1;
$nextpage = $_REQUEST['page']+1;

	if ($_REQUEST['page']==1) {

	} else {
		echo "<a href=\"$PHP_SELF?page=$prevpage" . "&" . $parameter . "\">PREV</a>";
	}

		if ($pagecount==1) {
		echo "Page 1";

		} else {
		$start_page_no = floor (($_REQUEST['page'] -1) / $limit_page ) * $limit_page + 1;

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

	} else {
		echo " <a href=\"$PHP_SELF?page=$nextpage&" . $parameter ."\">NEXT</a><br>";
	}

?>
    </div></td>
  </tr>
</table>


<?php    
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");
	if ($_GET["page"] == ""){$_REQUEST["page"] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	if($_GET["action"] == "delete"){
		$code = Check_Permission($conn,$check_module,$_SESSION["login_id"],"delete");		
		if ($code == "1") {
			$sql = "delete from $tbl_name  where $PK_field = '".$_GET[$PK_field]."'";
			@mysqli_query($conn,$sql);			
			header ("location:index.php");
		} 
	}
?>

<style>
	.tbMain{
		width: 100%;
	}
	.tbMain tr{
		
	}
	.tbMain tr th{
		border: 1px solid #DDDDDD;
		padding: 5px;
	}
	.tbMain tr td{
		border: 1px solid #DDDDDD;
		padding: 5px;
	}
</style>

<script>
function chkPrint(){
	setTimeout(function () { window.print(); }, 500);
	window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
}
</script>

<html>
    <body onLoad="javascript:chkPrint();">
	<TABLE class="tbMain">
      <THEAD>
        <TR>
<!--          <TH width="4%"><INPUT class=check-all type=checkbox name="ca" value="true" onClick="chkAll(this.form, 'del[]', this.checked)"></TH>-->
          <TH width="5%"><a>ลำดับ</a></TH>
          <TH width="10%"><a>รหัสอะไหล่</a></TH>
          <TH width="20%" ><a>ชื่ออะไหล่</a></TH>
          <TH width="10%"><a>คงเหลือ</a></TH>
          <TH width="14%"><a>ชนิดสินค้า</a></TH>
          <TH width="12%"><a>ราคาต้นทุนสินค้า</a></TH>
          <TH width="12%"><a>รวมราคาต้นทุนสินค้า</a></TH>
        </TR>
      </THEAD>
      <TFOOT>
        </TFOOT>
      <TBODY>
        <?php     
//					if($orderby=="") $orderby = $tbl_name.".group_spar_id";
//					if ($sortby =="") $sortby ="ASC";
//					
//				   	$sql = " select *,$tbl_name.create_date as c_date from $tbl_name  where 1 ";
//					if ($_GET[$PK_field] <> "") $sql .= " and ($PK_field  = '" . $_GET[$PK_field] . " ' ) ";					
//					if ($_GET[$FR_field] <> "") $sql .= " and ($FR_field  = '" . $_GET[$FR_field] . " ' ) ";					
// 					if ($_GET["keyword"] <> "") { 
//						$sql .= "and ( " .  $PK_field  . " like '%".$_GET["keyword"]."%' ";
//						if (count ($search_key) > 0) { 
//							$search_text = " and ( " ;
//							foreach ($search_key as $key=>$value) { 
//									$subtext .= "or " . $value  . " like '%" . $_GET["keyword"] . "%'";
//							}	
//						}
//						$sql .=  $subtext . " ) ";
//					} 
//					if ($orderby <> "") $sql .= " order by " . $orderby;
//					if ($sortby <> "") $sql .= " " . $sortby;
//		  
//					include ("../include/page_init.php");
		  
		  			if($_GET['keyword']){
						$keyWord = " AND (group_name like '%".$_GET['keyword']."%' OR group_type like '%".$_GET['keyword']."%')";
					}

					$sql = 'select *,s_group_sparpart.create_date as c_date from s_group_sparpart where 1 '.$keyWord.' order by s_group_sparpart.group_spar_id ASC';
		  
					$query = @mysqli_query($conn,$sql);
					if($_GET["page"] == "") $_GET["page"] = 1;
					$counter = ($_GET["page"]-1)*$pagesize;
					
					while ($rec = @mysqli_fetch_array ($query)) { 
					$counter++;
				   ?>
        <TR>
<!--          <TD><INPUT type=checkbox name="del[]" value="<?php     echo $rec[$PK_field]; ?>" ></TD>-->
          <TD  style="text-align: center;"><span class="text" ><?php     echo sprintf("%04d",$counter); ?></span></TD>
          <TD style="text-align: center;"><span class="text"><?php     echo $rec["group_spar_id"] ; ?></span></TD>
          <TD><span class="text"><?php     echo $rec["group_name"] ; ?></span></TD>
          <TD style="text-align: center;"><span class="text"><?php     echo number_format($rec["group_stock"]); ?></span></TD>
          <TD style="text-align: center;"><span class="text"><?php     echo $rec["group_type"] ; ?></span></TD>
          <TD style="text-align: right;"><span class="text"><?php     echo number_format($rec["group_unit_price"],2); ?></span></TD>
          <TD style="text-align: right;"><span class="text"><?php     echo number_format($rec["group_stock"]*$rec["group_unit_price"],2) ; ?></span></TD>

        </TR>  
		<?php     }?>
      </TBODY>
    </TABLE>
	</body>
</html>

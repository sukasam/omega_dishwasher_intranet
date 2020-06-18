<?php
include("../../include/config.php");
include("../../include/connect.php");
include("../../include/function.php");
include("config.php");
Check_Permission($conn, $check_module, $_SESSION['login_id'], "read");
if ($_GET['page'] == "") {
	$_REQUEST['page'] = 1;
}
$param = get_param($a_param, $a_not_exists);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>ค้าหาชื่อร้าน-ชื่อบริษัท</title>
	<style type="text/css">
		.tv_search {
			font-size: 12px;
			margin-top: 10px;
		}

		.tv_search tr {}

		.tv_search tr th {
			font-weight: bold;
			text-align: left;
			padding-left: 5px;
			padding-right: 5px;
			padding-bottom: 5px;
		}

		.tv_search tr td {
			padding: 5px;
		}

		a {
			color: #000000;
			outline: 0;
			text-decoration: none;
		}

		a:hover {
			text-decoration: underline;
		}
	</style>

	<script type="text/javascript">
		function get_customer(cid, cname) {
			//		alert(cid);
			//		alert(cname);

			var sCustomerName = self.opener.document.getElementById("cd_name");
			sCustomerName.value = cname;
			self.opener.checkfirstorder(cid, 'cd_address', 'cd_province', 'cd_tel', 'cd_fax', 'c_contact', 'c_tel');
			self.opener.document.getElementById("rsnameid").innerHTML = "<input type=\"hidden\" name=\"cus_id\" value=\"" + cid + "\">";

			window.close();
		}
	</script>
	<script type="text/javascript" src="ajax.js"></script>
</head>

<body>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search">
		<tr>
			<td colspan="2"><strong>ค้นหา&nbsp;&nbsp;:&nbsp;&nbsp;</strong>
				<input type="text" name="textfield" id="textfield" style="width:85%;" onkeyup="get_cus2(this.value);" />
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search">
		<tr>
			<th width="50%">ชื่อร้าน-ชื่อบริษัท</th>
		</tr>
	</table>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search" id="rscus">
		<?php
		$conDealer = "";
		if (userGroup($conn, $_SESSION['login_id']) === "Dealer") {
			$conDealer = " AND `create_by` = '" . $_SESSION['login_id'] . "'";
		}
		$qu_cus = mysqli_query($conn, "SELECT fo_id,cd_name,loc_name FROM s_first_order WHERE 1 " . $conDealer . " ORDER BY cd_name ASC");
		while ($row_cus = @mysqli_fetch_array($qu_cus)) {
		?>
			<tr>
				<td><A href="javascript:void(0);" onclick="get_customer('<?php echo $row_cus['fo_id']; ?>','<?php echo $row_cus['cd_name']; ?>');"><?php echo $row_cus['cd_name']; ?> (<?php echo $row_cus['loc_name'] ?>)</A>
				</td>
			</tr>
		<?php
		}
		?>
	</table>

</body>

</html>
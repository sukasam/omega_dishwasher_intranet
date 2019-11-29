<?php  

	include ("../../include/config.php");

	include ("../../include/connect.php");

	include ("../../include/function.php");

	include ("config.php");

	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");

	if ($_GET["page"] == ""){$_REQUEST['page'] = 1;	}

	$param = get_param($a_param,$a_not_exists);


	$a_sdate=explode("/",$_REQUEST['date_fm']);

	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

	$a_sdate=explode("/",$_REQUEST['date_to']);

	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

	

	if($_REQUEST['priod'] == 0){

		$daterriod = " AND `stock_date` between '".$date_fm."' and '".$date_to."'"; 

		$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($date_to); 

	}

	else{

		$dateshow = "วันที่ดำเนินการ : ".format_date(date("Y-m-d")); 

	}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>เลือกตามการรับอะไหล่เข้าสต๊อค</title>

<style type="text/css">

 .tbreport{

 	font-size:10px;

 }

 .tbreport th{

	font-weight:bold;

	text-align:left;

	border-bottom:1px solid #000000;

	padding:5;

 }

 .tbreport td{

	 padding:5px;

	 vertical-align:top;

	 border-bottom:1px solid #000000;

 }

</style>

</head>



<body>

	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">

	  <tr>

	    <th colspan="4" style="text-align:left;font-size:12px;">บริษัท โอเมก้า ดิชวอชเชอร์ (ประเทศไทย) จำกัด<br />

รายงานการรับอะไหล่เข้าสต๊อค</th>

	    <th colspan="4" style="text-align:right;font-size:11px;"><?php  echo $dateshow;?></th>

      </tr>

      <tr>

        <?php  if($_REQUEST['sh9'] == 1){?><th width="5%">วันที่รับเข้า</th><?php  }?>

        <?php  if($_REQUEST['sh1'] == 1){?><th width="16%">ผู้จำหน่าย / ส่งสินค้า</th><?php  }?>

        <?php  if($_REQUEST['sh2'] == 1){?><th width="15%">ที่อยู่ /ผู้จำหน่าย / เบอร์โทร</th><?php  }?>

        <?php  if($_REQUEST['sh3'] == 1){?><th width="10%">เลขที่บิล</th><?php  }?>

        <?php  if($_REQUEST['sh4'] == 1 || $_REQUEST['sh5'] == 1 || $_REQUEST['sh6'] == 1){?><th width="30%"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">

          <tr>

            <?php  if($_REQUEST['sh4'] == 1){?><td style="border-bottom:none;" width="25%"><strong>รหัสอะไหล่</strong></td><?php  }?>

            <?php  if($_REQUEST['sh5'] == 1){?><td style="border-bottom:none;" width="50%"><center><strong>รายการอะไหล่</strong></center></td><?php  }?>

           <?php  if($_REQUEST['sh6'] == 1){?><td style="border-bottom:none;" width="25%"><strong>ราคาซื้อ</strong></td><?php  }?>

          </tr>

        </table></th><?php  }?>

        <?php  if($_REQUEST['sh7'] == 1){?><th width="6%"><strong>รวมราคาซื้ิอ</strong></th><?php  }?>

        <?php  if($_REQUEST['sh8'] == 1){?><th width="6%"><strong>ผู้รับอะไหล่เข้า</strong></th><?php  }?>


      </tr>

      <?php  

	  	

		

		$dbservice = "s_group_sparpart_bill";

		$dbservicesub = "s_group_sparpart_bill_pro";

	  

		$sql = "SELECT * FROM ".$dbservice." as st, ".$dbservicesub." as stp WHERE st.sub_id = stp.id_bill ".$daterriod." GROUP BY st.sub_id ORDER BY st.sub_id DESC";

	  	$qu_fr = @mysqli_query($conn,$sql);

		$sum = 0;

		$totals = 0;

		$sumTotalAll = 0;

		$moneyTCTota = 0;

		while($row_bill = @mysqli_fetch_array($qu_fr)){
			

			?>

			<tr>

              <?php  if($_REQUEST['sh9'] == 1){?><td><?php  echo format_date($row_bill['stock_date']);?></td><?php  }?>

              <?php  if($_REQUEST['sh1'] == 1){?><td><?php  echo $row_bill['sub_name'];?></td><?php  }?>

              <?php  if($_REQUEST['sh2'] == 1){?><td><?php  echo $row_bill['sub_address'].' / '.$row_bill['sub_tel'];?></td><?php  }?>
              
                <?php  if($_REQUEST['sh3'] == 1){?><td><?php  echo $row_bill['sub_billnum'];?></td><?php  }?>
              
              

              <?php  if($_REQUEST['sh4'] == 1 || $_REQUEST['sh5'] == 1 || $_REQUEST['sh8'] == 1){?><td style="padding:0;">

              	<?php  

				$qu_pfirst = @mysqli_query($conn,"SELECT * FROM ".$dbservicesub." WHERE id_bill = '".$row_bill['sub_id']."'");

				?>

				<table border="0" width="90%" cellspacing="0" cellpadding="0" class="tbreport">

				<?php 

				$totalamount = 0;

				$totalTA = 0;

				while($row = @mysqli_fetch_array($qu_pfirst)){

					if($row['sparpart_id'] != ""){

						$total = $row['sparpart_unit_price']*$row['sparpart_qty'];

						$totalamount += $row['sparpart_qty'];

					?>

					<tr>

					  <?php  if($_REQUEST['sh4'] == 1){?><td style="border-bottom:none;" width="25%"><?php  echo get_sparpart_id($conn,$row['sparpart_id']);?></td><?php  }?>

					  <?php  if($_REQUEST['sh5'] == 1){?><td align="left" style="border-bottom:none;" width="50%"><?php  echo get_sparpart_name($conn,$row['sparpart_id']);?></td><?php  }?>

					  <?php  if($_REQUEST['sh6'] == 1){?><td align="right" style="border-bottom:none;" width="25%"><?php  echo number_format($row['sparpart_unit_price'],2);?></td><?php  }?>

					</tr>

				<?php  

					$sumTotalAll += $total;

					$totalTA +=	$total;

					

					}	

				}

					$totals += $totalamount

					

				?>

                </table>

              </td><?php  }?>

              <?php  if($_REQUEST['sh7'] == 1){?><td style="padding:0;"><?php  echo number_format($totalTA+$moneyTC,2);?></td><?php  }?>

              <?php  if($_REQUEST['sh8'] == 1){?><td style="padding:0;"><?php echo $row_bill['create_by'];?></td><?php  }?>

            </tr>

			<?php 

			$sum += 1;

			$moneyTCTota += $moneyTC; 

		}

	  ?>

      <tr>

			  <td colspan="9" style="text-align:right;"> <strong>จำนวนการรับเข้าสต็อคทั้งหมด&nbsp;&nbsp;<?php  echo $sum;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>

	  </tr>

<!--
      <tr>

			  <td colspan="9" style="text-align:right;"> <strong>รวมอะไหล่ที่เบิก&nbsp;&nbsp;<?php  echo $totals;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>

	  </tr>
-->

	  <tr>

			  <td colspan="8" style="text-align:right;"> <strong>คิดเป็นมูลค่ารวมทั้งสิ้น&nbsp;&nbsp;<?php  echo number_format($sumTotalAll+$moneyTCTota,2);?>&nbsp;&nbsp;บาท&nbsp;&nbsp;</strong></td>

	  </tr>

    </table>



</body>

</html>
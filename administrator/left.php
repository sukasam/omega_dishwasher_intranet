<?php
	include_once("../../include/connect.php");
	include_once("../../include/function.php");
	
	$UserProcess = checkUserApproved($conn,$_SESSION['login_id']);
	
	$numApp1 = getNumApproveFO($conn,$UserProcess);
	$numApp2 = getNumApproveSVJ($conn,$UserProcess);
	$numApp3 = getNumApproveMEMO($conn,$UserProcess);
	$numApp4 = getNumApproveQAB($conn,$UserProcess);
	$numApp5 = getNumApproveQAH($conn,$UserProcess);
	$numApp6 = getNumApproveSV($conn,$UserProcess);

	$sumApp = $numApp1+$numApp2+$numApp3+$numApp4+$numApp5+$numApp6;
	
?>
<DIV id=sidebar>
	<div align="center">
    	<ul>
        	<li style="padding-top:20px;"><a href="../first_order?mid=12"><img src="../images/menu/frish_order.png" width="89" height="119" border="0" alt=""></a></li>
            <li style="padding-top:20px;"><a href="../service_report?mid=13"><img src="../images/menu/service-form.png" width="98" height="98" border="0" alt=""></a></li>
            <li style="padding-top:20px;"><a href="../schedule/?mid=14"><img src="../images/menu/service-schedule.png" width="129" height="103" border="0" alt=""></a></li>
            <li style="padding-top:20px;"><a href="../report/?mid=16"><img src="../images/menu/report.png" width="88" height="125" border="0" alt=""></a></li>
            <li style="padding-top:20px;"><a href="../quotation"><img src="../images/menu/quotation.png" width="129" border="0" alt=""></a></li>
            <li style="padding-top:20px;"><a href="../contract"><img src="../images/menu/contract.png" width="129" border="0" alt=""></a></li>
            <li style="padding-top:20px;position: relative;">
            <?php if($sumApp != 0){?><div class="appAlrLeft"><?php echo $sumApp;?></div><?php }?>
            <a href="../approved1"><img src="../images/menu/approved.png" width="129" border="0" alt=""></a></li>
            <li style="padding-top:20px;"><a href="../scanqr/index.php"><img src="../images/menu/scan_qrcode.png" width="125" height="100" border="0" alt=""></a></li>
            <li style="padding-top:20px;"><a href="../order_solution"><img src="../images/menu/camical-solution.png" width="129" height="103" border="0" alt=""></a></li>
            <li style="padding-top:20px;"><a href="../return_product"><img src="../images/menu/return-product.png" width="129" height="103" border="0" alt=""></a></li>
            <li style="padding-top:20px;"><a href="../setting"><img src="../images/menu/setting.png" width="75" height="105" border="0" alt=""></a></li>
            <li style="padding-top:20px;"><a href="../../manual/%e0%b8%84%e0%b8%b9%e0%b9%88%e0%b8%a1%e0%b8%b7%e0%b8%ad%e0%b8%81%e0%b8%b2%e0%b8%a3%e0%b9%83%e0%b8%8a%e0%b9%89%e0%b8%a3%e0%b8%b0%e0%b8%9a%e0%b8%9a%20-%20Omega%20Dishwasher.pdf"><img src="../images/menu/manual.png" width="75" height="105" border="0" alt=""></a></li>
            <li style="padding-top:20px;padding-bottom:20px;"><a href="../logout.php"><img src="../images/menu/logout.png" width="70" height="97" border="0" /></a></li>
        </ul>
    </div>
</DIV>

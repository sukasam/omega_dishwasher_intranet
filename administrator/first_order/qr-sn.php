<?php 
	include ("../../include/connect.php");
	include ("../../include/function.php");

    if(!isset($_GET['id']) || $_GET['id'] === ''){
        header("Location:../first_order");
    }

    $foID = get_firstorder($conn,$_GET['id']);
    $proSN = array($foID['pro_sn1'], $foID['pro_sn2'], $foID['pro_sn3'], $foID['pro_sn4'], $foID['pro_sn5'], $foID['pro_sn6'], $foID['pro_sn7']);
?>
<div style="">
<div style='text-align: left;'>
    <ul style="padding: 0;">
        <?php
        for($i=0;$i<count($proSN);$i++){
            if($proSN[$i] !== ''){
                ?>
                <li style="list-style: none;padding: 25px;float: left;">
                   <center> <img src="../../qrcode_gen/qrcode.php?val=<?php echo $proSN[$i];?>" width="180">
                    <p style="margin: 0;font-weight: bold;">S/N : <?php echo $proSN[$i];?></p></center>
                </li>
                <?php
            }
        }
        ?>
</div>
</div>

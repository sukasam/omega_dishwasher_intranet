<?php
// include ("../../include/config.php");
// include ("../../include/connect.php");
// include ("../../include/function.php");

// $sqlFO = "SELECT *  FROM `s_first_order` WHERE `status_use` != 2 AND (`pro_sn1` != '' OR `pro_sn2` != '') AND `technic_service` != '' AND `technic_service` != '0' ORDER BY `technic_service` ASC";
// $quFO = mysqli_query($conn, $sqlFO);

// $nameTec = array();
// $nameSN = array();
// $nameQR = array();

// while($row = mysqli_fetch_array($quFO, MYSQLI_ASSOC)){

//     $nameTecS = get_technician_name($conn,$row['technic_service'])." ( ".$row['fs_id']." )";

//     if($row['pro_sn1'] != ""){
//         $nameSNS = "<strong>S/N ".$row['pro_sn1']."</strong>";
//         $nameQRS = '<img src="../../qrcode_gen/qrcode.php?val='.$row['pro_sn1'].'" width="250">';
//        array_push($nameTec,$nameTecS);
//        array_push($nameSN,$nameSNS);
//        array_push($nameQR,$nameQRS);
//     }
//     if($row['pro_sn2'] != ""){
//         $nameSNS = "<strong>S/N ".$row['pro_sn2']."</strong>";
//         $nameQRS = '<img src="../../qrcode_gen/qrcode.php?val='.$row['pro_sn2'].'" width="250">';
//         array_push($nameTec,$nameTecS);
//         array_push($nameSN,$nameSNS);
//         array_push($nameQR,$nameQRS);
//     }
// }


// include_once("../mpdf54/mpdf.php");
// include("qr_label.php");
// $mpdf=new mPDF('UTF-8'); 
// $mpdf->SetAutoFont();
// $mpdf->WriteHTML($form);
// $mpdf->Output('qr_label.pdf','F');


?>
<?php

// include composer packages
include "../vendor/autoload.php";

// initiate FPDI
$pdf = new FPDI();

// get the page count
$pageCount = $pdf->setSourceFile('qa1.pdf');
// iterate through all pages
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    // import a page
    $templateId = $pdf->importPage($pageNo);
    // get the size of the imported page
    $size = $pdf->getTemplateSize($templateId);

    // create a page (landscape or portrait depending on the imported page size)
    if ($size['w'] > $size['h']) {
        $pdf->AddPage('L', array($size['w'], $size['h']));
    } else {
        $pdf->AddPage('P', array($size['w'], $size['h']));
    }

    // use the imported page
    $pdf->useTemplate($templateId);

	$pdf->AddFont('THSarabunNew','','THSarabunNew.php');//ธรรมดา
    $pdf->SetFont('THSarabunNew','',13);

    if($templateId == 1){

        //BOX 1 TOP        
        $pdf->SetXY(29, 57);
        $txt = iconv('UTF-8', 'Windows-874', $_POST['cd_name']);
        $pdf->Cell(0, 0, $txt, 0, 0, '');
        
        $pdf->SetXY(24, 65.5);
        $txt = iconv('UTF-8', 'Windows-874', $_POST['cd_address']);
        $pdf->Cell(0, 0, $txt, 0, 0, '');
        
        $pdf->SetXY(29, 74);
        $txt = iconv('UTF-8', 'Windows-874', $_POST['cd_tel']);
        $pdf->Cell(0, 0, $txt, 0, 0, '');
        
        $pdf->SetXY(87, 73.8);
        $txt = iconv('UTF-8', 'Windows-874', $_POST['cd_fax']);
        $pdf->Cell(0, 0, $txt, 0, 0, '');
        
        $pdf->SetXY(32, 82.2);
        $txt = iconv('UTF-8', 'Windows-874', $_POST['c_contact']);
        $pdf->Cell(0, 0, $txt, 0, 0, '');
        
        $pdf->SetXY(91, 82.5);
        $txt = iconv('UTF-8', 'Windows-874', $_POST['c_tel']);
        $pdf->Cell(0, 0, $txt, 0, 0, ''); 


        //BOX 2 TOP
        $pdf->SetXY(150, 57);
        $txt = iconv('UTF-8', 'Windows-874', $date_forder);
        $pdf->Cell(0, 0, $txt, 0, 0, '');

        $pdf->SetXY(165, 65.5);
        $txt = iconv('UTF-8', 'Windows-874', $_POST['fs_id']);
        $pdf->Cell(0, 0, $txt, 0, 0, '');

        $pdf->SetXY(163, 74);
        $txt = iconv('UTF-8', 'Windows-874', protype_name($conn,$_POST['pro_type']));
        //$pdf->Cell(0, 0, $txt, 0, 0, '');
		$pdf->Cell(0,0,$txt,0,1,'');


        $pdf->SetFont('THSarabunNew','',14);
        $xPro = 17;
        $yPro = 100;

		
		
		$data1=array();
		$sumTotal = 0;
		
		if($_POST['cpro1'] != ""){

			$totalSub = $_POST['pro_sn1'] * $_POST['camount1'];
			
			if($_POST['cprice1'] != ""){
				$totalSub = $totalSub - $_POST['cprice1'];
			}else{
				$_POST['cprice1'] = 0;
			}
			
			$sumTotal = $sumTotal+$totalSub;
			
			$datafree = array(
				"1",
				get_proname($conn,$_POST['cpro1']),
				$_POST['pro_sn1'],
				number_format($_POST['camount1']),
				number_format($_POST['cprice1']),
				number_format($totalSub),
			);

			array_push($data1,$datafree);
		}
		
		if($_POST['cpro2'] != ""){

			$totalSub = $_POST['pro_sn2'] * $_POST['camount2'];
			
			if($_POST['cprice2'] != ""){
				$totalSub = $totalSub - $_POST['cprice2'];
			}else{
				$_POST['cprice2'] = 0;
			}
			
			$sumTotal = $sumTotal+$totalSub;
			
			$datafree = array(
				"2",
				get_proname($conn,$_POST['cpro2']),
				$_POST['pro_sn2'],
				number_format($_POST['camount2']),
				number_format($_POST['cprice2']),
				number_format($totalSub),
			);

			array_push($data1,$datafree);
		}
		
		if($_POST['cpro3'] != ""){

			$totalSub = $_POST['pro_sn3'] * $_POST['camount3'];
			
			if($_POST['cprice3'] != ""){
				$totalSub = $totalSub - $_POST['cprice3'];
			}else{
				$_POST['cprice3'] = 0;
			}
			
			$sumTotal = $sumTotal+$totalSub;
			
			$datafree = array(
				"3",
				get_proname($conn,$_POST['cpro3']),
				$_POST['pro_sn3'],
				number_format($_POST['camount3']),
				number_format($_POST['cprice3']),
				number_format($totalSub),
			);

			array_push($data1,$datafree);
		}
		
		if($_POST['cpro4'] != ""){

			$totalSub = $_POST['pro_sn4'] * $_POST['camount4'];
			
			if($_POST['cprice4'] != ""){
				$totalSub = $totalSub - $_POST['cprice4'];
			}else{
				$_POST['cprice4'] = 0;
			}
			
			$sumTotal = $sumTotal+$totalSub;
			
			$datafree = array(
				"4",
				get_proname($conn,$_POST['cpro4']),
				$_POST['pro_sn4'],
				number_format($_POST['camount4']),
				number_format($_POST['cprice4']),
				number_format($totalSub),
			);

			array_push($data1,$datafree);
		}
		
		if($_POST['cpro5'] != ""){

			$totalSub = $_POST['pro_sn5'] * $_POST['camount5'];
			
			if($_POST['cprice5'] != ""){
				$totalSub = $totalSub - $_POST['cprice5'];
			}else{
				$_POST['cprice5'] = 0;
			}
			
			$sumTotal = $sumTotal+$totalSub;
			
			$datafree = array(
				"5",
				get_proname($conn,$_POST['cpro5']),
				$_POST['pro_sn5'],
				number_format($_POST['camount5']),
				number_format($_POST['cprice5']),
				number_format($totalSub),
			);

			array_push($data1,$datafree);
		}
		
		if($_POST['cpro6'] != ""){

			$totalSub = $_POST['pro_sn6'] * $_POST['camount6'];
			
			if($_POST['cprice6'] != ""){
				$totalSub = $totalSub - $_POST['cprice6'];
			}else{
				$_POST['cprice6'] = 0;
			}
			
			$sumTotal = $sumTotal+$totalSub;
			
			$datafree = array(
				"6",
				get_proname($conn,$_POST['cpro6']),
				$_POST['pro_sn6'],
				number_format($_POST['camount6']),
				number_format($_POST['cprice6']),
				number_format($totalSub),
			);

			array_push($data1,$datafree);
		}
		
		if($_POST['cpro7'] != ""){

			$totalSub = $_POST['pro_sn7'] * $_POST['camount7'];
			
			if($_POST['cprice7'] != ""){
				$totalSub = $totalSub - $_POST['cprice7'];
			}else{
				$_POST['cprice7'] = 0;
			}
			
			$sumTotal = $sumTotal+$totalSub;
			
			$datafree = array(
				"7",
				get_proname($conn,$_POST['cpro7']),
				$_POST['pro_sn7'],
				number_format($_POST['camount7']),
				number_format($_POST['cprice7']),
				number_format($totalSub),
			);

			array_push($data1,$datafree);
		}
		

		foreach($data1 as $item){
	
			$callWidth=87;
			$callHeight=5;

			if($pdf->GetStringWidth($item[1]) < $callWidth){
				$line = 1;
			}else{

				$textLength=strlen($item[1]);
				$errMargin=10;
				$startChar=0;
				$maxChar=0;
				$textArray=array();
				$tmpString="";

				while($startChar < $textLength){
					while(
					$pdf->GetStringWidth( $tmpString ) < ($callWidth-$errMargin) && ($startChar+$maxChar) < $textLength
					){
						$maxChar++;
						$tmpString=substr($item[1],$startChar,$maxChar);
					}

					$startChar=$startChar+$maxChar;

					array_push($textArray,$tmpString);

					$maxChar=0;
					$tmpString='';
				}

				$line=count($textArray);

			}
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->Cell(10,5,$item[0],0,0,'C');
			
			$xPro = $xPro+13;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->MultiCell($callWidth,$callHeight,iconv('UTF-8', 'Windows-874', $item[1]),0,'L');
			
			$xPro = $xPro+90;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->Cell(20,5,$item[2],0,0,'C');
			
			$xPro = $xPro+22;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->Cell(28,5,$item[3],0,0,'R');
			
			$xPro = $xPro+31;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->Cell(28,5,$item[4],0,0,'R');
			
			$xPro = $xPro+31;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->Cell(27,5,$item[5],0,1,'R');
			
			$xPro = 17;
			$yPro = $yPro+14;

		}
		
		

        //BOX TOTAL
		
		$tax7 = $sumTotal*0.07;
		$totalSumPay = $sumTotal+$tax7;

        $pdf->SetXY(202, 218.5);
        $txt = iconv('UTF-8', 'Windows-874', number_format($sumTotal,2));
        $pdf->Cell(30, 7, $txt, 0, 0, 'R');

        $pdf->SetXY(202, 226);
        $txt = iconv('UTF-8', 'Windows-874', number_format($tax7,2));
        $pdf->Cell(30, 7, $txt, 0, 0, 'R');

        $pdf->SetXY(202, 233.5);
        $txt = iconv('UTF-8', 'Windows-874', number_format($totalSumPay,2));
        $pdf->Cell(30, 7, $txt, 0, 0, 'R');
		
		$pdf->SetXY(15, 233.5);
        $txt = iconv('UTF-8', 'Windows-874', baht_text($totalSumPay));
        $pdf->Cell(126, 7, $txt, 0, 0, 'C');
		
		$pdf->SetFont('THSarabunNew','',15);
		
		$xPro = 17;
        $yPro = 270;
		
		$data2=array();
		
		if($_POST['cs_pro1'] != ""){
			$datafree = array(
				"1",
				$_POST['cs_pro1'],
				$_POST['cs_amount1']
			);
			array_push($data2,$datafree);
		 }
		if($_POST['cs_pro2'] != ""){
			$datafree = array(
				"2",
				$_POST['cs_pro2'],
				$_POST['cs_amount2']
			);
			array_push($data2,$datafree);
		 }
		if($_POST['cs_pro3'] != ""){
			$datafree = array(
				"3",
				$_POST['cs_pro3'],
				$_POST['cs_amount3']
			);
			array_push($data2,$datafree);
		 }
		if($_POST['cs_pro4'] != ""){
			$datafree = array(
				"4",
				$_POST['cs_pro4'],
				$_POST['cs_amount4']
			);
			array_push($data2,$datafree);
		 }
		if($_POST['cs_pro5'] != ""){
			$datafree = array(
				"5",
				$_POST['cs_pro5'],
				$_POST['cs_amount5']
			);
			array_push($data2,$datafree);
		 }
		
		
		foreach($data2 as $item){
	
			$callWidth=126;
			$callHeight=5;

			if($pdf->GetStringWidth($item[1]) < $callWidth){
				$line = 1;
			}else{

				$textLength=strlen($item[1]);
				$errMargin=10;
				$startChar=0;
				$maxChar=0;
				$textArray=array();
				$tmpString="";

				while($startChar < $textLength){
					while(
					$pdf->GetStringWidth( $tmpString ) < ($callWidth-$errMargin) && ($startChar+$maxChar) < $textLength
					){
						$maxChar++;
						$tmpString=substr($item[1],$startChar,$maxChar);
					}

					$startChar=$startChar+$maxChar;

					array_push($textArray,$tmpString);

					$maxChar=0;
					$tmpString='';
				}

				$line=count($textArray);

			}
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->Cell(23,5,$item[0],0,0,'C');
			
			$xPro = $xPro+25;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->MultiCell($callWidth,$callHeight,iconv('UTF-8', 'Windows-874', $item[1]),0,'L');
			
			$xPro = $xPro+130;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->Cell(60,5,$item[2],0,1,'C');
			
			$xPro = 17;
			$yPro = $yPro+12;

		}
				
        
    }else if($templateId == 2){


		if($_POST['payc'] == 1){
			$pdf->SetFont('THSarabunNew','',20);
			$pdf->SetXY(20.3, 62.3);
			$txt = iconv('UTF-8', 'Windows-874', 'x');
			$pdf->Cell(0, 0, $txt, 0, 0, '');

			$pdf->SetFont('THSarabunNew','',16);
			$pdf->SetXY(66, 68.5);
			$txt = iconv('UTF-8', 'Windows-874', number_format($_POST['paym']));
			$pdf->Cell(26, 5, $txt, 0, 0, 'C');
		}
		
		

       
		
		if($_POST['payc'] == 2){
			$pdf->SetFont('THSarabunNew','',20);
			$pdf->SetXY(20.3, 77.6);
			$txt = iconv('UTF-8', 'Windows-874', 'x');
			$pdf->Cell(0, 0, $txt, 0, 0, '');
			
			$pdf->SetFont('THSarabunNew','',16);
			$pdf->SetXY(44, 76.5);
			$txt = iconv('UTF-8', 'Windows-874', $_POST['pays']);
			$pdf->Cell(16, 5, $txt, 0, 0, 'C');

			$pdf->SetFont('THSarabunNew','',16);
			$pdf->SetXY(48, 84.5);
			$txt = iconv('UTF-8', 'Windows-874', number_format($_POST['paysa']));
			$pdf->Cell(30, 5, $txt, 0, 0, 'C');

			$pdf->SetFont('THSarabunNew','',16);
			$pdf->SetXY(102, 84);
			$txt = iconv('UTF-8', 'Windows-874', $_POST['paysad']);
			$pdf->Cell(10, 5, $txt, 0, 0, 'C');

		}
		

		if($_POST['type_service'] == 6){
			$checkService = 1;
		}else if($_POST['type_service'] == 1 || $_POST['type_service'] == 31){
			$checkService = 2;
		}else if($_POST['type_service'] == 2){
			$checkService = 3;
		}else if($_POST['type_service'] == 3){
			$checkService = 4;
		}

		$pdf->SetFont('THSarabunNew','',16);
        $pdf->SetXY(64, 114.5);
        $txt = iconv('UTF-8', 'Windows-874', $checkService);
        $pdf->Cell(10, 5, $txt, 0, 0, 'C');

    }

}

// Output the new PDF
//$pdf->Output();  
$chaf = str_replace("/","-",$_POST['fs_id']);
$pdf->Output('../../upload/quotation/'.$chaf.'.pdf','F');
//$pdf->Output('QA 62-03-001.pdf','F'); 
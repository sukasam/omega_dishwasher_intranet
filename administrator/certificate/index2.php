<?php

// include composer packages
include "vendor/autoload.php";

// initiate FPDI
$pdf = new FPDI();

function numtothaistring($num){
		$return_str = "";
		$txtnum1 = array('','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า');
		$txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
		$num_arr = str_split($num);
		$count = count($num_arr);

		foreach($num_arr as $key=>$val){
			if($count > 1 && $val == 1 && $key ==($count-1))
			$return_str .= "เอ็ด";
			else
			$return_str .= $txtnum1[$val].$txtnum2[$count-$key-1];
		}
		
		return $return_str ;
	}
	function numtothai($num){
		$return = "";
		$num = str_replace(",","",$num);
		$number = explode(".",$num);
		if(sizeof($number)>2){
			return 'รูปแบบข้อมุลไม่ถูกต้อง';
			exit;
		}
		$return .= numtothaistring($number[0])."บาท";
		$stang = intval($number[1]);
		if($stang > 0)
		$return.= numtothaistring($stang)."สตางค์";
		else
		$return .= "ถ้วน";
		return $return ;
	}

// get the page count
$pageCount = $pdf->setSourceFile('qa2.pdf');
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
        $pdf->SetXY(29, 56.7);
        $txt = iconv('UTF-8', 'Windows-874', 'ดำรัส สุขเกษม');
        $pdf->Cell(0, 0, $txt, 0, 0, '');
        
        $pdf->SetXY(24, 65.1);
        $txt = iconv('UTF-8', 'Windows-874', '173 ถนนดินสอ เสาชิงช้า พระนคร กรุงเทพมหานคร 10200');
        $pdf->Cell(0, 0, $txt, 0, 0, '');
        
        $pdf->SetXY(29, 73.3);
        $txt = iconv('UTF-8', 'Windows-874', '0897833940');
        $pdf->Cell(0, 0, $txt, 0, 0, '');
        
        $pdf->SetXY(80, 73);
        $txt = iconv('UTF-8', 'Windows-874', 'mme_dumrus@hotmail.com');
        $pdf->Cell(0, 0, $txt, 0, 0, '');
        
        $pdf->SetXY(32, 81.8);
        $txt = iconv('UTF-8', 'Windows-874', 'ดำรัส สุขเกษม');
        $pdf->Cell(0, 0, $txt, 0, 0, '');
        
        $pdf->SetXY(84, 82);
        $txt = iconv('UTF-8', 'Windows-874', '0897833940');
        $pdf->Cell(0, 0, $txt, 0, 0, ''); 


        //BOX 2 TOP
        $pdf->SetXY(147, 56.7);
        $txt = iconv('UTF-8', 'Windows-874', '12/03/2562');
        $pdf->Cell(0, 0, $txt, 0, 0, '');

        $pdf->SetXY(162, 65.2);
        $txt = iconv('UTF-8', 'Windows-874', 'QA 62/03/002');
        $pdf->Cell(0, 0, $txt, 0, 0, '');

        $pdf->SetXY(160, 73.5);
        $txt = iconv('UTF-8', 'Windows-874', 'ซื้อ - ขาย');
        //$pdf->Cell(0, 0, $txt, 0, 0, '');
		$pdf->Cell(0,0,$txt,0,1,'');


        $pdf->SetFont('THSarabunNew','',14);
        $xPro = 17;
        $yPro = 100;
		
		$data1=array(
			array(
				"1",
				"OMEGA DEBACT ล้างอุปกรณ์ประกอบ ฆ่าเชื้อ (กว้างxสูง) แรงดันไฟฟ้า 230VAC 50Hr 110V AC60H",
				"18",
				"20,000",
				"5,000",
				"36,000",
			),
			array(
				"2",
				"OMEGA DEBACT ล้างอุปกรณ์ประกอบ ฆ่าเชื้อ (กว้างxสูง) แรงดันไฟฟ้า 230VAC 50Hr 110V AC60H",
				"18",
				"20,000",
				"5,000",
				"36,000",
			),
			array(
				"3",
				"OMEGA DEBACT ล้างอุปกรณ์ประกอบ ฆ่าเชื้อ (กว้างxสูง) แรงดันไฟฟ้า 230VAC 50Hr 110V AC60H",
				"18",
				"20,000",
				"5,000",
				"36,000",
			)
		);
		

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
			$pdf->Cell(9,5,$item[0],0,0,'C');
			
			$xPro = $xPro+13;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->MultiCell($callWidth,$callHeight,iconv('UTF-8', 'Windows-874', $item[1]),0,'L');
			
			$xPro = $xPro+90;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->Cell(18,5,$item[2],0,0,'C');
			
			$xPro = $xPro+22;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->Cell(21,5,$item[3],0,0,'R');
			
			$xPro = $xPro+26;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->Cell(22,5,$item[4],0,0,'R');
			
			$xPro = $xPro+26;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->Cell(23,5,$item[5],0,1,'R');
			
			$xPro = 17;
			$yPro = $yPro+14;

		}
		
		 //BOX TOTAL
		$pdf->SetXY(15, 157.5);
        $txt = iconv('UTF-8', 'Windows-874', numtothai("1234561.50"));
        $pdf->Cell(124, 7, $txt, 0, 0, 'C');

        $pdf->SetXY(192, 142);
        $txt = iconv('UTF-8', 'Windows-874', '36,000');
        $pdf->Cell(27, 7, $txt, 0, 0, 'R');

        $pdf->SetXY(192, 149.5);
        $txt = iconv('UTF-8', 'Windows-874', '253.21');
        $pdf->Cell(27, 7, $txt, 0, 0, 'R');

        $pdf->SetXY(192, 157.5);
        $txt = iconv('UTF-8', 'Windows-874', '36,253.21');
        $pdf->Cell(27, 7, $txt, 0, 0, 'R');
		
	
		
		$pdf->SetFont('THSarabunNew','',14);
        $xPro = 17;
        $yPro = 183;
		
		$data3=array(
			array(
				"1",
				"ค่าบริการขนส่ง/ติดตั้ง",
				"1",
				"20,000",
				"5,000",
				"36,000",
			),
			array(
				"2",
				"เงินประกันเครื่อง",
				"1",
				"20,000",
				"5,000",
				"36,000",
			)
		);
		

		foreach($data3 as $item){
	
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
			$pdf->Cell(9,5,$item[0],0,0,'C');
			
			$xPro = $xPro+13;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->MultiCell($callWidth,$callHeight,iconv('UTF-8', 'Windows-874', $item[1]),0,'L');
			
			$xPro = $xPro+90;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->Cell(18,5,$item[2],0,0,'C');
			
			$xPro = $xPro+22;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->Cell(21,5,$item[3],0,0,'R');
			
			$xPro = $xPro+26;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->Cell(22,5,$item[4],0,0,'R');
			
			$xPro = $xPro+26;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->Cell(23,5,$item[5],0,1,'R');
			
			$xPro = 17;
			$yPro = $yPro+9;

		}
		
		 //BOX TOTAL
		$pdf->SetXY(15, 218);
        $txt = iconv('UTF-8', 'Windows-874', numtothai("1234561.50"));
        $pdf->Cell(124, 7, $txt, 0, 0, 'C');

        $pdf->SetXY(192, 202.5);
        $txt = iconv('UTF-8', 'Windows-874', '36,000');
        $pdf->Cell(27, 7, $txt, 1, 0, 'R');

        $pdf->SetXY(192, 210);
        $txt = iconv('UTF-8', 'Windows-874', '253.21');
        $pdf->Cell(27, 7, $txt, 0, 0, 'R');

        $pdf->SetXY(192, 218);
        $txt = iconv('UTF-8', 'Windows-874', '36,253.21');
        $pdf->Cell(27, 7, $txt, 0, 0, 'R');

		
		$pdf->SetFont('THSarabunNew','',14);
		
		$xPro = 17;
        $yPro = 256;
		
		$data2=array(
			array(
				"1",
				"OMEGA DEBACT ล้างอุปกรณ์ประกอบ ฆ่าเชื้อ (กว้างxสูง) แรงดันไฟฟ้า 230VAC 50Hr 110V AC60H",
				"18"
			),
			array(
				"2",
				"OMEGA DEBACT ล้างอุปกรณ์ประกอบ ฆ่าเชื้อ (กว้างxสูง) แรงดันไฟฟ้า 230VAC 50Hr 110V AC60H",
				"18"
			),
			array(
				"3",
				"OMEGA DEBACT ล้างอุปกรณ์ประกอบ ฆ่าเชื้อ (กว้างxสูง) แรงดันไฟฟ้า 230VAC 50Hr 110V AC60H",
				"18"
			),
			array(
				"4",
				"OMEGA DEBACT ล้างอุปกรณ์ประกอบ ฆ่าเชื้อ",
				"18"
			),
			array(
				"5",
				"OMEGA DEBACT ล้างอุปกรณ์ประกอบ ฆ่าเชื้อ OMEGA DEBACT ล้างอุปกรณ์ประกอบ ฆ่าเชื้อ",
				"18"
			)
		);
		
		foreach($data2 as $item){
	
			$callWidth=124;
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
			$pdf->Cell(20,5,$item[0],0,0,'C');
			
			$xPro = $xPro+23;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->MultiCell($callWidth,$callHeight,iconv('UTF-8', 'Windows-874', $item[1]),0,'L');
			
			$xPro = $xPro+127;
			
			$pdf->SetXY($xPro, $yPro);
			$pdf->Cell(50,5,$item[2],0,1,'C');
			
			$xPro = 17;
			$yPro = $yPro+11;

		}
				
        
    }else if($templateId == 2){

		$pdf->SetFont('THSarabunNew','',17);
        $pdf->SetXY(46, 70.8);
        $txt = iconv('UTF-8', 'Windows-874', '01');
        $pdf->Cell(0, 0, $txt, 0, 0, '');
		
		$pdf->SetFont('THSarabunNew','',17);
        $pdf->SetXY(68, 100.5);
        $txt = iconv('UTF-8', 'Windows-874', '2');
        $pdf->Cell(0, 0, $txt, 0, 0, '');

    }

}

// Output the new PDF
$pdf->Output();  
$pdf->Output('QA 62-03-002.pdf','F'); 
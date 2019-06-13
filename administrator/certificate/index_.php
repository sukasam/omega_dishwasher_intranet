<?php

// include composer packages
include "vendor/autoload.php";

// Create new Landscape PDF
// $pdf = new FPDI('l');
$pdf = new FPDI();

// Reference the PDF you want to use (use relative path)
echo $pagecount = $pdf->setSourceFile( 'qa1-1.pdf');

// Import the first page from the PDF and add to dynamic PDF
$tpl = $pdf->importPage(1);
$pdf->AddPage();

// Use the imported page as the template
$pdf->useTemplate($tpl);

// Set the default font to use
// $pdf->SetFont('Helvetica-Bold');

// adding a Cell using:
// $pdf->Cell( $width, $height, $text, $border, $fill, $align);

$pdf->AddFont('angsa','','angsa.php');//ธรรมดา
$pdf->SetFont('angsa','',13);
$pdf->SetXY(25, 48);
$txt = iconv('UTF-8', 'Windows-874', 'ดำรัส สุขเกษม');
$pdf->Cell(0, 0, $txt, 0, 0, '');

$pdf->SetXY(21, 55.5);
$txt = iconv('UTF-8', 'Windows-874', '173 ถนนดินสอ เสาชิงช้า พระนคร กรุงเทพมหานคร 10200');
$pdf->Cell(0, 0, $txt, 0, 0, '');

$pdf->SetXY(25, 62);
$txt = iconv('UTF-8', 'Windows-874', '0897833940');
$pdf->Cell(0, 0, $txt, 0, 0, '');

$pdf->SetXY(74, 62);
$txt = iconv('UTF-8', 'Windows-874', 'mme_dumrus@hotmail.com');
$pdf->Cell(0, 0, $txt, 0, 0, '');

$pdf->SetXY(27, 69.5);
$txt = iconv('UTF-8', 'Windows-874', 'ดำรัส สุขเกษม');
$pdf->Cell(0, 0, $txt, 0, 0, '');

$pdf->SetXY(77, 69.5);
$txt = iconv('UTF-8', 'Windows-874', '0897833940');
$pdf->Cell(0, 0, $txt, 0, 0, '');

// // add the reason for certificate
// // note the reduction in font and different box position
// $pdf->SetFontSize('20');
// $pdf->SetXY(80, 105);
// $pdf->Cell(150, 10, 'Unicity Marketting', 0, 0, 'C');

// // the day
// $pdf->SetFontSize('20');
// $pdf->SetXY(118,122);
// $pdf->Cell(20, 10, date('d'), 0, 0, 'C');

// // the month
// $pdf->SetXY(160,122);
// $pdf->Cell(30, 10, date('M'), 0, 0, 'C');

// // the year, aligned to Left
// $pdf->SetXY(200,122);
// $pdf->Cell(20, 10, date('y'), 0, 0, 'L');

// render PDF to browser
$pdf->Output();
<?php
// include composer autoload
include "BarcodeGenerator.php";
include "BarcodeGeneratorPNG.php";

function barcode($code){
	
	$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
	$border = 2;//กำหนดความหน้าของเส้น Barcode
	$height = 40;//กำหนดความสูงของ Barcode

	return $generator->getBarcode($code , $generator::TYPE_CODE_128,$border,$height);

}
echo '<div style="display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
text-align: center;
min-height: 100vh;"><div><img src="data:image/png;base64,', base64_encode(barcode($_GET['val'])), '" />
</div></div>';
?>



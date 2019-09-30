<?php
// include composer autoload
require_once 'vendor/autoload.php';
 
//Save to server
// เรียกใช้งานสร้าง qrcode โดยสร้าง qrcode 
// ข้อควม http://www.ninenik.com
// บันทึกเป็นไฟล์ ชื่อ myqrcode.png ไว้ในโฟลเดอร์ images / picqrcode / myqrcode.png 
// กำหนด Error Correction ของ QRcode เท่ากับ L  (มีค่า L,M,Q และ H)
// กำหนด ขนาด pixel เท่ากับ 4
// กำหนดความหนาของกรอบ เท่ากับ 2
//\PHPQRCode\QRcode::png("FO 62/03/001", "../upload/qrcode/fo/myqrcode.png", 'H', 4, 2);


//Show qr code

if(isset($_GET['val']) && $_GET['val']!=""){
    $text_qrcode = urldecode(trim($_GET['val']));
    header('Content-Type: image/png');
    \PHPQRCode\QRcode::png(base64_encode($text_qrcode), 'php://output', 'H', 10, 2);    
}
?>
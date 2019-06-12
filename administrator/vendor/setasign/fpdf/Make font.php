<?php
require('makefont/makefont.php'); // แทรกไฟล์สร้างฟอนต์จากโฟลเดอร์ makefont มาใช้งาน

MakeFont(dirname(__FILE__).'/THSarabunNew.ttf','cp874'); // MakeFont('พาธของฟอนต์','Encode ของฟอนต์');
MakeFont(dirname(__FILE__).'/THSarabunNew Bold.ttf','cp874'); // MakeFont('พาธของฟอนต์','Encode ของฟอนต์');
MakeFont(dirname(__FILE__).'/THSarabunNew BoldItalic.ttf','cp874'); // MakeFont('พาธของฟอนต์','Encode ของฟอนต์');
MakeFont(dirname(__FILE__).'/THSarabunNew Italic.ttf','cp874'); // MakeFont('พาธของฟอนต์','Encode ของฟอนต์');


?>
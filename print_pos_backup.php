<?php 
  
$order = $_GET['orderID'];
// $realBumber = "66-".$order;
// $string = '?infotrax='.$realBumber;
// $key = 'qwerty';
// @$result = bin2hex(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, md5($key), $string, MCRYPT_MODE_CBC, pack('H*', "00000000000000000000000000000000")));

// $link = "https://hydra.unicity.net/v5a/orders/".$result;

$link = $order;

 $linkInvoice = $link."/invoice.html?_httpHeaderAuthorization=Bearer%20programs:9857ce776767e9287fde";

 $result = file_get_contents($linkInvoice);

 
$result = str_replace('height:1008px;POSITION: relative','height:960px;POSITION: relative;overflow: hidden;margin-left: -10px;',$result);

$result = str_replace('LEFT:234px;TOP:-5px;width:229px;clip:rect(0 229 15 0)','LEFT:234px;TOP:0px;width:229px;clip:rect(0 229 15 0)',$result);
$result = str_replace('LEFT:234px;TOP:9px;width:229px;clip:rect(0 229 18 0);font-size:9.75pt','LEFT:234px;TOP:15px;width:229px;clip:rect(0 229 18 0);font-size:9.75pt',$result);

 $result = str_replace('LEFT:38px;TOP:926px;width:715px;clip:rect(0 715 105 0)','display:none;LEFT:38px;TOP:926px;width:715px;clip:rect(0 715 105 0)',$result);
 $result = str_replace('LEFT:265px;TOP:277px;width:249px;clip:rect(0 249 19 0)','LEFT:275px;TOP:277px;width:249px;clip:rect(0 249 19 0)',$result);
 $result = str_replace('LEFT:372px;TOP:302px;width:37px;clip:rect(0 37 22 0)','LEFT:382px;TOP:302px;width:37px;clip:rect(0 37 22 0)',$result);

$result = str_replace('http://localhost/unilogo.jpg', 'https://static.unicity.com/modules/images/logobwwithoutbg150.png', $result);
$result = str_replace('height:68px;width:132px','',$result);
$result = str_replace('กรุณาศึกษารายละเอียด'.hex2bin('e0b8'),'กรุณาศึกษารายละเอียดจาก นโยบายและระเบียบปฎิบัติของยูนิซิตี้ ประเทศไทย ฉบับ วันที่ 1 กันยายน <Br> พ.ศ. 2547 หมวดที่ 5, หน้า 14, ข้อ ค. * *',$result);

$result = str_replace('LEFT:512px;TOP:7px;width:206px;clip:rect(0 206 27 0);font-family:IDAutomationC39S;font-size:12pt','LEFT:490px;TOP: 0px;width:206px;clip: rect(0 206 38 0);font-family:Code39Demo;font-size: 37pt;height: 38px;',$result);

$result = str_replace('LEFT:49px;TOP:912px;width:672px;clip:rect(0 672 105 0)','LEFT:49px;TOP:895px;width:672px;clip:rect(0 672 62 0)',$result);
 //curl_close($ch);

 $result = str_replace('LEFT:175px;TOP:717px;width:24px;clip:rect(0 24 15 0)','LEFT:175px;TOP:717px;width:24px;clip:rect(0 24 15 0);display: none;',$result);
 $result = str_replace('LEFT:146px;TOP:717px;width:34px;clip:rect(0 34 15 0)','LEFT:146px;TOP:717px;width:34px;clip:rect(0 34 15 0);display: none;',$result);
 $result = str_replace('LEFT:139px;TOP:717px;width:8px;clip:rect(0 8 15 0)','LEFT:139px;TOP:717px;width:8px;clip:rect(0 8 15 0);display: none;',$result);


echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css"> @font-face { font-family: Code39Demo; src: url("Code39Demo.eot") } @font-face { font-family: Code39Demo; src: url("Code39Demo.ttf") } div.dData {DISPLAY: inline; POSITION: absolute; font-family:Arial; font-size:8.25pt; OVERFLOW: hidden; TEXT-OVERFLOW: ellipsis; white-space:nowrap; }</style>
<STYLE>
    div.inline {DISPLAY: inline; POSITION: absolute}
    img.inline {DISPLAY: inline; POSITION: absolute; BORDER: none}
    div.dData {DISPLAY: inline; POSITION: absolute; font-family:Arial; font-size:8.25pt; }
    div.dLabel {DISPLAY: inline; POSITION: absolute; font-family:Arial; font-size:8.25pt; }
</STYLE>  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <link rel="icon" type="image/png" href="apple-touch-icon.png" sizes="16x16">
  <link rel="icon" type="image/png" href="apple-touch-icon.png" sizes="32x32">

  <!-- for IE -->
  <link rel="icon" type="image/x-icon" href="favicon.ico" >
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>


      <link rel="shortcut icon" href="/apple-touch-icon.png">
</HEAD>';

//echo ' <br><input id="print" type="button" value="Print"/>';


    echo '<div>'.$result.'</div>';
	echo '<div style="margin-top: 20px;">'.$result.'</div>';
    echo "<script>setTimeout(function() {window.print();window.close();}, 500);</script>";

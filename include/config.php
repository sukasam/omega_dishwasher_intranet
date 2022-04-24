<?php 
error_reporting(0);
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
ob_start();
@session_start();
date_default_timezone_set("Asia/Bangkok");
$cookie_time = time() + (3600 * 24 * 15) ;
$s_title="Omega Dishwasher Intranet";
define("S_TITLE","Omega Dishwasher Intranet");
define("S_DOMAIN","http://omegadishwasher-family.com/");
define("S_PATHS","site/");
define("S_IMAGES","images/");
?>

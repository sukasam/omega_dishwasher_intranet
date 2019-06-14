<?php 
error_reporting(0);
ob_start();
@session_start();
$cookie_time = time() + (3600 * 24 * 15) ;
$s_title="Omega Dishwasher Intranet";
define("S_TITLE","Omega Dishwasher Intranet");
define("S_DOMAIN","http://localhost/");
define("S_PATHS","omega_dishwasher_intranet/");
define("S_IMAGES","images/");
?>

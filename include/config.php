<?php 
error_reporting(0);
ob_start();
@session_start();
$cookie_time = time() + (3600 * 24 * 15) ;
$s_title="Omega Intranet";
define("S_TITLE","Omega Intranet");
define("S_DOMAIN","http://omega-svr1/");
define("S_PATHS","omega_internet/");
define("S_IMAGES","images/");
?>

<?php
error_reporting(0);
//error_reporting (E_ALL ^ E_NOTICE);
@ob_start();
@session_start();
include_once("config.php");
include_once("connect.php");
include_once("function.php");
include_once("ps_pagination.php");
include_once("filename.php");

define("S_TITLE","Omega Intranet");
define("S_DOMAIN","http://omega-svr1/");
define("S_PATHS","omega_internet/");
define("S_IMAGES","images/");
define("S_CONTENT","content/");

define("_BASEURL_",S_DOMAIN.S_PATHS);
define("_BASEIMAGES_",_BASEURL_.S_IMAGES);

if($_COOKIE['setunicode'] != 1){
	setcookie("setunicode","1");
	header("Location:".curPageURL());
}

$listsmenu = explode('/',$_SERVER['SCRIPT_FILENAME']);
$lmenu = strtolower($listsmenu[count($listsmenu)-1]);

if($_SESSION['lang'] == "thai"){
	@mysqli_query($conn,"SET NAMES tis620");
}else{
	@mysqli_query($conn,"SET NAMES utf8");
}
?>

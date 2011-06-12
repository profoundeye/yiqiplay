<?php
define( "WB_AKEY" , '2315480230' ); //key from xweibo 
define( "WB_SKEY" , '23764bff018fd54abba5e277d95adcb9' );
define("SOURCE",dirname($_SERVER['SCRIPT_FILENAME']).'/source/');
define("YQW_PATH",'/weibodemo'); //App Path
include_once(SOURCE.'/client/yiqiplayclient.php');
session_start();
?>
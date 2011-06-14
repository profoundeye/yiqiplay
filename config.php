<?php
define("SOURCE",dirname($_SERVER['document_root']).'/source/');
define("MY_URL","http://localhost");
define("MY_CHECKING",MY_URL."/yiqiplay/index.php");

define("YQW_PATH",'/weibodemo'); //App Path
include_once(SOURCE.'/client/yiqiplayclient.php');
session_start();

//常量定义

//1. yiqiplayclient 常量定义
define("SNSTYPE_SINA","1");
// 设置App的Key和Secret
define( "WB_AKEY" , '2315480230' ); //key from xweibo 
define( "WB_SKEY" , '23764bff018fd54abba5e277d95adcb9' );

// 备用App key& Secret

//define( "WB_AKEY" , '3115905236' ); //key from weav_2009@126.com 
//define( "WB_SKEY" , 'be981b8cc5c07ec277a35286d6c0eb79' );
<?php
// 设置App的Key和Secret
define( "WB_AKEY" , '2315480230' ); //key from xweibo 
define( "WB_SKEY" , '23764bff018fd54abba5e277d95adcb9' );

// 备用App key& Secret

//define( "WB_AKEY" , '3115905236' ); //key from weav_2009@126.com 
//define( "WB_SKEY" , 'be981b8cc5c07ec277a35286d6c0eb79' );


// 定义 SOURCE的路径

//define("SOURCE",dirname($_SERVER['SCRIPT_FILENAME']).'/source/');

define("SOURCE",$_SERVER['DOCUMENT_ROOT'].'/source');
//调试用的定义，临时性的
define("YQW_PATH",'/weibodemo'); //App Path

//yiqiplayclient处理所有和Sina微博相关的操作
include_once(SOURCE."/client/yiqiplayclient.php");

//设置php文件路径
//ini_set("include_path",ini_get("include_path").";".dirname($_SERVER['SCRIPT_FILENAME'])."/source/");


//常量定义

//1. yiqiplayclient 常量定义
define("SNSTYPE_SINA","1");


?>
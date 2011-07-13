<?php
define("SOURCE",dirname($_SERVER['SCRIPT_FILENAME']).'/source/');
define("MY_URL","http://localhost");
define("MY_CHECKING",MY_URL."/yiqiplay/index.php");
define("YQW_PATH",'/weibodemo'); //App Path
include_once(SOURCE.'/client/yiqiplayclient.php');
session_start();
//常量定义
//1. yiqiplayclient 常量定义
define("SNSTYPE_SINA","1");
define("SINA_BASEURL","http://weibo.com/");
// 设置App的Key和Secret
define( "WB_AKEY" , '2315480230' ); //key from xweibo 
define( "WB_SKEY" , '23764bff018fd54abba5e277d95adcb9' );

// 设置yiqiplay官方微博的token和secret
define( "YQP_TOKEN" , 'e9c332833d5ee7b415065bbc5d6a7d41' ); // access key and token for @yiqiplay
define( "YQP_TOKEN_SECRET" , 'b77c76294836ff1b07fc0e378fdb8fb1');


// 备用App key& Secret
//define( "WB_AKEY" , '3115905236' ); //key from weav_2009@126.com 
//define( "WB_SKEY" , 'be981b8cc5c07ec277a35286d6c0eb79' );



function utf8Substr($str, $from, $len)
{
    return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
                       '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
                       '$1',$str);
}
?>
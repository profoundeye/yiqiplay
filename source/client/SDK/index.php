<?php

session_start();
//if( isset($_SESSION['last_key']) ) header("Location: weibolist.php");
include_once( 'config.php' );
include_once( 'weiboclient.php' );

$base_url = isset($_SERVER['SCRIPT_URI'])?$_SERVER['SCRIPT_URI']:'http://'.$_SERVER['SERVER_NAME'].YQW_PATH;

$o = new WeiboOAuth( WB_AKEY , WB_SKEY  );

$keys = $o->getRequestToken();
$aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , $base_url.'/callback.php');

$_SESSION['keys'] = $keys;


?>
<a href="<?=$aurl?>">Token生成，点击链接进入授权页</a>
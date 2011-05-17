<?php

session_start();
include_once( 'config.php' );
include_once( 'weibooauth.php' );



$o = new WeiboOAuth( WB_AKEY , WB_SKEY , $_SESSION['keys']['oauth_token'] , $_SESSION['keys']['oauth_token_secret']  );

$last_key = $o->getAccessToken(  $_REQUEST['oauth_verifier'] ) ;
//$last_key = array();
$_SESSION['last_key'] = $last_key;

echo "<blockquote>";print_r($last_key); echo "</blockquote>";
if(isset($last_key['oauth_token_secret'])&&isset($last_key['oauth_token']))
{
echo "授权完成,<a href=\"weibolist.php\">进入微博官方Demo页面</a><br>";
echo "授权完成,<a href=\"weiboapilist.php\">进入微博api列表页面</a>";
} else {
echo "授权失败，<a href=\"index.php?error_code=$last_key[error_code]\">返回首页</a>";
}

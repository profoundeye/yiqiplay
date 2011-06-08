<html><head><meta http-equiv="Content-Type" content="text/html;charset=utf-8"></head>
<?php

session_start();
include_once('yiqiplayclient.php');


if( !isset($_REQUEST['oauth_verifier']) )
{
	echo "<a href=\"".YiqiplayClient::getAuthURL('http://127.0.0.1/weibodemo/testYiqiplayclient.php')."\">click here </a>";
	exit();
}
//print_r($_SESSION['keys']);

if( !isset($_SESSION['accessKey']))
{
	$_SESSION['accessKey'] = $accessKey = YiqiplayClient::getAccessToken($_SESSION['keys']['oauth_token'] , $_SESSION['keys']['oauth_token_secret'],$_REQUEST['oauth_verifier']);
	print_r($_SESSION['accessKey']);
}
$yqp = new YiqiplayClient($_SESSION['accessKey']['oauth_token'],$_SESSION['accessKey']['oauth_token_secret']);
print_r($yqp->verify_credentials());
// echo "<br /><br /><br /><br /><br />";
// print_r($yqp->show_user("will_zhangv"));
// echo "<br /><br /><br /><br /><br />";
//print_r($yqp->user_timeline("will_zhangv"));
//echo "<br /><br /><br /><br /><br />";
//$key = "我要滑雪";
//print_r($yqp->searchTrend($key));

echo "<br /><br /><br /><br /><br />";

//print_r($yqp->update("测试一条看看吧。。"));

//$yqp->update("测试一条看看");
exit();

?>
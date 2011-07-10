<html><head><meta http-equiv="Content-Type" content="text/html;charset=utf-8"></head>
<?php

include_once("config.php");

echo "session<br/>";
print_r($_SESSION);

$verifyUser = YiqiplayClient::hasWeiboAuth("http://localhost/testYiqiplayclient.php");

print_r($verifyUser);

if( !$verifyUser['value'] )
{
	echo "<a href=\"".$verifyUser['aurl']."\">click here </a>";
	exit();
} else {

	$_SESSION['accessKey'] = $accessKey = $verifyUser['accessKey'];

}

echo "session again <br/>";
print_r($_SESSION);

$yqp = new YiqiplayClient($_SESSION['accessKey']['oauth_token'],$_SESSION['accessKey']['oauth_token_secret']);
print_r($yqp->verify_credentials());
echo "<br /><br /><br /><br /><br />";
print_r($yqp->show_user("小御花园"));

/**
echo "<br /><br /><br /><br /><br />";
print_r($yqp->user_timeline("小御花园"));
//echo "<br /><br /><br /><br /><br />";
//$key = "我要滑雪";
//print_r($yqp->searchTrend($key));

echo "<br /><br /><br /><br /><br />";

//print_r($yqp->update("测试一条看看吧。。"));

//$yqp->update("测试一条看看");
exit();
**/
?>
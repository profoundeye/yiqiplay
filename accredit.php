<?php
include_once('config.php');

session_start();
//if( isset($_SESSION['last_key']) ) header("Location: weibolist.php");

if( !isset($_REQUEST['oauth_verifier']) )
{
	echo "<a href=\"".YiqiplayClient::getAuthURL('http://127.0.0.1/source/client/testYiqiplayclient.php')."\">click here </a>";
	exit();
}


if( !isset($_SESSION['accessKey']))
{
	$_SESSION['accessKey'] = $accessKey = YiqiplayClient::getAccessToken($_SESSION['keys']['oauth_token'] , $_SESSION['keys']['oauth_token_secret'],$_REQUEST['oauth_verifier']);
	print_r($_SESSION['accessKey']);
}
$yqp = new YiqiplayClient($_SESSION['accessKey']['oauth_token'],$_SESSION['accessKey']['oauth_token_secret']);
print_r($yqp->verify_credentials());

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>一起玩</title>
<link type="text/css" rel="stylesheet" href="assets/yq.css" />
<script src="assets/jquery.min.js"></script>
</head>
<body>
<p id="follow_us"><a href="">关注@一起play</a></p>
<div class="main"><div id="accredit">一起玩，给你找玩伴<a href="<?=$aurl?>">Token生成，点击链接进入授权页</a></div></div>
<p id="foot">copyright by yiqiplay@163.com</p>
</body>
</html>

<!DOCTYPE HTML>
<html>
<head>
<?php
include_once('config.php');

//验证用户身份
$verifyUser = YiqiplayClient::hasWeiboAuth("http://127.0.0.1/yiqiplay/post.php");
//print_r($verifyUser);
if( !$verifyUser['value'] )
{
	header("Location: accredit.php");
} else {

	$_SESSION['accessKey'] = $accessKey = $verifyUser['accessKey'];

}

$yqp = new YiqiplayClient($_SESSION['accessKey']['oauth_token'],$_SESSION['accessKey']['oauth_token_secret']);
$cur_user = $yqp->verify_credentials();


?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>一起玩</title>
<link type="text/css" rel="stylesheet" href="assets/yq.css" />
<script src="assets/jquery.min.js"></script>
</head>
<body>
<p id="follow_us"><a href="">关注@一起play</a></p>
<p id="m_head">一人学跳舞没动力？一人看电影觉得无聊？想找个伴去旅行？一个人去健身难坚持？一起play，给你找玩伴！</p>
<div class="main choose" style="overflow:hidden">
	<div class="poster cong">恭喜你！<scan class="large">Say Hi</scan> 成功啦！祝你找到最棒的玩伴。</div>
	<div class="poster btn">
		<button class="btnself" type="button" onclick="javascript:window.location.href='<?=$cur_user->getProfileUrl()?>'"></button><button class="btnplan" type="button" onclick="javascript:window.location.href='step1.php'"></button>
	</div>
		
</div>
<p id="foot">copyright by yiqiplay@163.com</p>
</body>
</html>

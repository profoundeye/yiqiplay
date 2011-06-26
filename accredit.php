<?php
include_once('config.php');
//if( isset($_SESSION['last_key']) ) header("Location: weibolist.php");
if( !isset($_REQUEST['oauth_verifier']) )
{

	$accredit_href = YiqiplayClient::getAuthURL('http://localhost/yiqiplay/index.php');

}
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
<div class="main"><div id="accredit">一起玩，给你找玩伴<a class="accredit_sina" href="<?=$accredit_href?>">点击链接进入授权页</a></div></div>
<p id="foot">copyright by yiqiplay@163.com</p>
</body>
</html>

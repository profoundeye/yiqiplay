<?php
include_once('config.php');

session_start();

$verifyUser = YiqiplayClient::hasWeiboAuth($_REQUEST,$_SESSION);

if( !$verifyUser['value'] )
{
	echo "<a href=\"".$verifyUser['aurl']."\">click here </a>";
	exit();
} else {

	$_SESSION['accessKey'] = $accessKey = $verifyUser['accessKey'];

}

$yqp = new YiqiplayClient($_SESSION['accessKey']['oauth_token'],$_SESSION['accessKey']['oauth_token_secret']);
$cur_user = $yqp->verify_credentials();

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>一起玩</title>
<link type="text/css" rel="stylesheet" href="../assets/yq.css" />
<script src="../assets/jquery.min.js"></script>
</head>
<body>
<p id="follow_us"><a href="">关注@一起play</a></p>
<p id="m_head">一人学跳舞没动力？一人看电影觉得无聊？想找个伴去旅行？一个人去健身难坚持？一起play，给你找玩伴！</p>
<div class="main choose">
	<div class="step xman">
        <em>哇！你太强了，暂时还没有人和你有相同的play计划。不如通过自己和一起play官方微博发布你的计划，等待臭味相投的玩伴认领吧！</em>
        <div class="t">
		<?php 
		$cur_user_raw = json_decode($cur_user->getExtend()); 
		?>
            <img class="avater" src="<?php echo $cur_user_raw->profile_image_url?>" />
            <textarea>@一起play:我想去火星，有人愿意一起吗？</textarea>
            <button class="fb">发布计划</button>
            <button class="xg">发布计划</button>
         </div>
     </div>
</div>
<p id="foot">copyright by yiqiplay@163.com</p>
</body>
</html>
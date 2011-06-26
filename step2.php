<?php

include_once('config.php');
include_once('.\source\service\searchService.php');
include_once(SOURCE.'\data\user.php');
include_once(SOURCE.'\data\message.php');
if(!isset($_SESSION['accessKey'])){
	header('Location: accredit.php');
}


$acttype = "我想去";
$wish = "";
if( isset($_REQUEST["dotype"])) {
	$acttype = $_REQUEST["dotype"];
}
if( isset($_REQUEST["ido"])) {
	$wish = $_REQUEST["ido"];
}

//echo "act=".$acttype."<br/>";
//echo "wish=".$wish."<br/>";

$oAuthToken = $_SESSION['accessKey']['oauth_token'];
$oAuthTokenSecret = $_SESSION['accessKey']['oauth_token_secret'];
	
$searchService = new SearchService();

$msgarr = $searchService->searchWish($oAuthToken, $oAuthTokenSecret, $acttype, $wish);

//var_dump($msgarr);	

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
<p id="m_head">一人学跳舞没动力？一人看电影觉得无聊？想找个伴去旅行？一个人去健身难坚持？一起play，给你找玩伴！</p>
<div class="main choose">
<form >
<div class="step">
	<em class="sayhi">一起play为你找到了以下城玩伴，他们也和你一样想去玩</em>
    <ul class="man-list">

	<?foreach($msgarr as $m){ $user=$m->getUser();?>
    	<li>
        	<a href="<?=$user->getProfileUrl()?>">
        		<img src="<?=$user->getSnsproimg()?>" />
            	<em><?=$user->getUsername()?></em>
                <span>浙江，杭州</span>
            </a>
        </li>
    <?}?>
    </ul>
     <div class="hi">
     	<button type="submit" >say hi，和玩伴们组团</button>
        <span><a href="step3.php?ido=<?=$wish?>&dotype=<?=$acttype?>">算了，让我继续孤独吧</a></span>
     </div>
</div>
</form>
<script type="application/javascript">

</script>
</div>
<p id="foot">copyright by yiqiplay@163.com</p>
</body>
</html>

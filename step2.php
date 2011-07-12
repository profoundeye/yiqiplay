<?php

include_once('config.php');

$result = YiqiplayClient::hasWeiboAuth();
if(!$result){
	header('Location: '.$result['aurl']);
}


include_once('.\source\service\searchService.php');
include_once(SOURCE.'\data\user.php');
include_once(SOURCE.'\data\message.php');

include_once(SOURCE.'\data\location.php');
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

$provinces = unserialize(file_get_contents('provinces.txt'));
//var_dump($msgarr);

function utf8Substr($str, $from, $len)
{
    return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
                       '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
                       '$1',$str);
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
<p id="m_head">一人学跳舞没动力？一人看电影觉得无聊？想找个伴去旅行？一个人去健身难坚持？一起play，给你找玩伴！</p>
<div class="main choose">
<form name="ido" action="post.php" method="post">
<input type="hidden" value="<?=$wish?>" name="ido" />
<input type="hidden" value="<?=$acttype?>" name="dotype" />
<div class="step">
	<em class="sayhi">一起play为你找到了以下城玩伴，他们也和你一样想去<?=$wish?></em>
    <ul class="man-list">

	<?foreach($msgarr as $m){ $user=$m->getUser();?>
    	<li>
        <label>
        	<input name="metionUser[]" class="who" type="checkbox" value="<?=$user->getUsername()?>" checked="checked" /> 
             
             <img src="<?=$user->getSnsproimg()?>" />
         </label>     	
        		
            	<a href="<?=$user->getProfileUrl()?>">
                <em><?=utf8Substr($user->getUsername(),0,8)?></em>
                </a>
                <?$homeid = $user->getHomeid(); $locstr = Location::getLocationFromId($homeid, $provinces);?>
                <span><?=$locstr['province']?>，<?=$locstr['city']?></span>  
           		<p class="comment"><?=utf8Substr($m->getContent(),0,26)?></p>
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

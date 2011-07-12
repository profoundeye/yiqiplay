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

//认为post过来的checkbox数组是metionUser
$yqp = new YiqiplayClient($_SESSION['accessKey']['oauth_token'],$_SESSION['accessKey']['oauth_token_secret']);

$cur_user = $yqp->verify_credentials();



$dotype=isset($_POST['dotype'])?$_POST['dotype']:"我想去";
$ido=isset($_POST['ido'])?$_POST['ido']:"subway";

$act = "去";
if($dotype == "我想学") {
	$act = "学";
} elseif($dotype == "我想玩") {
	$act = "玩";
} 
$metion_str = "hi, $dotype $ido 我通过@一起play 找到了大家，让我们组队一起".$act."吧。";
if(isset($_POST['metionUser'])){

	//$metion_str = "";
	
	foreach($_POST['metionUser'] as $k => $v){
	
		$metion_str.="@$v ";
	}
	
	//echo $metion_str;
	$yqp->update($metion_str."。#一起play#");
}

header('Location: succeed.php');

?>

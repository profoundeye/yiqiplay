
<?php
//是否已经验证，如果已经验证，跳转到step1.php,否则到授权页面
include_once('config.php');

session_start();

$verifyUser = YiqiplayClient::hasWeiboAuth();


if(!$verifyUser['value']){
	header('Location: accredit.php');

	
}else{
	$_SESSION['accessKey'] = $accessKey = $verifyUser['accessKey'];
	header('Location: step1.php');
}


//如果验证未通过，直接跳转到授权页
?>


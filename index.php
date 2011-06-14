
<?php
//是否已经验证，如果已经验证，跳转到step1.php,否则到授权页面
include_once('config.php');

session_start();

if(!isset($_SESSION['accessKey'])){

	//初始化微波对象
	
	if( !isset($_SESSION['accessKey'])){

	$_SESSION['accessKey'] = $accessKey = YiqiplayClient::getAccessToken($_SESSION['keys']['oauth_token'] , $_SESSION['keys']['oauth_token_secret'],$_REQUEST['oauth_verifier']);

	}
	
	echo "session set:<br/>";
	print_r($accessKey);
	//header('Location: step1.php');
	
}else{
	echo "no session set";
	//header('Location: accredit.php');
	
}
?>


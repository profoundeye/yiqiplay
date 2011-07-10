<?php
	/**

		所有全局的身份验证和功能都放在global.php
		global.php 被包含在 /config.php 中，所有页面都包含 /config.php
	
	**/


	// 验证用户有效性，如果验证失败，****处理方式：踢回 index.php ***
	$verifyUser = YiqiplayClient::hasWeiboAuth("http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);

	if( !$verifyUser['value'] )
	{
		header("Location:".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
		
	} else {

		$_SESSION['accessKey'] = $accessKey = $verifyUser['accessKey'];

	}
?>
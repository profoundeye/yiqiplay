<?php
include_once(SOURCE."/client/yiqiplayclient.php");


class SearchService{

	private function initClient($oAuthToken, $oAuthTokenSecret) {
		$yqpClient = new YiqiplayClient($oAuthToken, $oAuthTokenSecret);
		return $yqpClient;
	}
	
	function searchWish($oAuthToken, $oAuthTokenSecret, $acttype, $wish){
		$yqpClient = $this->initClient($oAuthToken, $oAuthTokenSecret);
		$msgArr = $yqpClient->searchKeyword($acttype.$wish, 9);
		return $msgArr;
	}

}
?>
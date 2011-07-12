<?php
include_once(SOURCE."/client/yiqiplayclient.php");


class SearchService{

	private function initClient($oAuthToken, $oAuthTokenSecret) {
		$yqpClient = new YiqiplayClient($oAuthToken, $oAuthTokenSecret);
		return $yqpClient;
	}
	
	function searchWish($oAuthToken, $oAuthTokenSecret, $acttype, $wish){
		$yqpClient = $this->initClient($oAuthToken, $oAuthTokenSecret);
		//$cur_user = $yqpClient->verify_credentials();
		//$msgArr = $yqpClient->searchKeyword($acttype.$wish, 30);
		
		//$msgArrSort = array();
		return $msgArr;
	}

}

?>
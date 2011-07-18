<?php
include_once('..\service\searchService.php');

session_start();

$acttype = "我想去";
$wish = "";
if( isset($_REQUEST["dotype"])) {
	$acttype = $_REQUEST["dotype"];
}
if( isset($_REQUEST["dowhat"])) {
	$wish = $_REQUEST["dowhat"];
}

if( isset($_SESSION['accessKey'])) {
	$oAuthToken = $_SESSION['accessKey']['oauth_token'];
	$oAuthTokenSecret = $_SESSION['accessKey']['oauth_token_secret'];
	
	$searchService = new SearchService();
	
	$msgarr = $searchService->searchWish($oAuthToken, $oAuthTokenSecret, $acttype, $wish);
	
	if ($msgarr == null || count($msgarr) > 0) {
		// redirect to step1
	} else{
		// redirect to step2
	}
}
?>
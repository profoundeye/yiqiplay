<?php

include_once('config.php');
include_once('.\source\service\searchService.php');
session_start();
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

echo "act=".$acttype."<br/>";
echo "wish=".$wish."<br/>";

$oAuthToken = $_SESSION['accessKey']['oauth_token'];
$oAuthTokenSecret = $_SESSION['accessKey']['oauth_token_secret'];
	
$searchService = new SearchService();

$msgarr = $searchService->searchWish($oAuthToken, $oAuthTokenSecret, $acttype, $wish);
print_r($msgarr);	

?>
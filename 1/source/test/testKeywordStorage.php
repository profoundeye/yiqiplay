<?php
include_once("..\storage\keywordStorage.php"); 
include_once("..\data\keyword.php"); 
include_once("..\common\common.php"); 

$keyword = new Keyword();
$keyword->setWord(randStr(10));
$keyword->setType(rand(0,2));

$keywordStorage = new KeywordStorage();
$kid = $keywordStorage->insert($keyword);

if ($kid) echo "insert".$keyword->toString().", successfully with id=".$kid."<br/>";
else echo die ("fail to insert");

$keyword = $keywordStorage->get($kid);
echo "the inserted keyword is ".$keyword->toString();

$keywordarr = $keywordStorage->getAll();
$size = sizeof($keywordarr);
echo "total ".$size." keywords in the database:<br/>";
foreach($keywordarr as $keyword){
	echo $keyword->toString()."<br/>";
}

$upidx = rand(0,$size-1);
$keyword = $keywordarr[$upidx];
echo "Update keyword:<br/>".$keyword->toString()."<br/>";
$keyword->setWord(randStr(10));
$keyword->setType(rand(0,2));
echo "to :<br/>".$keyword->toString()."<br/>";

$result = $keywordStorage->update($keyword);
if ($result) {
	$keyword2 = $keywordStorage->get($keyword->getKid());
	echo "Update keyword successfully:".$keyword2->toString()."<br/>";
} else {
	die("failed to update");
}

$delidx = rand(0,$size-1);
$keyword = $keywordarr[$delidx];
echo "Delete keyword ".$keyword->toString()."<br/>";
$result = $keywordStorage->remove($keyword->getKid());
if ($result) {
	echo "Delete keyword with kid:".$keyword->getKid()." sucessfully<br/>";
}
else {die ("fail to delete");}

?>
<div><a href="/index.php">返回</a></div>
<?php
include_once("..\storage\keyindexStorage.php"); 
include_once("..\data\keyindex.php"); 
include_once("..\common\common.php"); 

$keyindex = new Keyindex();
$keyindex->setWord(randStr(8));
$keyindex->setMid(rand(0,999999));
$keyindex->setUhomeid(rand(0,999999));
$keyindex->setMlocid(rand(0,999999));

$keyindexStorage = new KeyindexStorage();
$result = $keyindexStorage->insert($keyindex);

if ($result) echo "insert successfully:".$keyindex->toString()."<br/>";
else echo die ("fail to insert");

$keyindex2 = $keyindexStorage->get(array($keyindex->getWord(), $keyindex->getMid()));
echo "Get the inserted index:".$keyindex2->toString();

$kidxarr = $keyindexStorage->getAll();
$size = sizeof($kidxarr);
echo "total ".$size." keyindices in the database:<br/>";
foreach($kidxarr as $keyindex){
	echo $keyindex->toString()."<br/>";
}

$delidx = rand(0,$size-1);
$keyindex = $kidxarr[$delidx];
echo "Delete keyindex ".$keyindex->toString()."<br/>";
$result = $keyindexStorage->remove(array($keyindex->getWord(),$keyindex->getMid()));
if ($result) {
	echo "Delete keyindex with word:".$keyindex->getWord().", and mid:"
		.$keyindex->getMid()." sucessfully<br/>";
}
else {die ("fail to delete");}

?>
<div><a href="/index.php">返回</a></div>
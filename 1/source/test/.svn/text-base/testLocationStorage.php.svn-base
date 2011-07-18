<?php
include_once("..\storage\locationStorage.php"); 
include_once("..\data\location.php"); 
include_once("..\common\common.php"); 

$location = new Location();
$location->setProvince(randStr(10));
$location->setCity(randstr(10));
$location->setCounty(randstr(10));
$location->setPoint(randstr(50));

$locationStorage = new LocationStorage();
$lid = $locationStorage->insert($location);

if ($lid) echo "insert".$location->toString().", successfully with id=".$lid."<br/>";
else echo die ("fail to insert");

$location = $locationStorage->get($lid);
echo "the inserted location is ".$location->toString();

$locationarr = $locationStorage->getAll();
$size = sizeof($locationarr);
echo "total ".$size." locations in the database:<br/>";
foreach($locationarr as $location){
	echo $location->toString()."<br/>";
}

$upidx = rand(0,$size-1);
$location = $locationarr[$upidx];
echo "Update location:<br/>".$location->toString()."<br/>";
$location->setProvince(randStr(10));
$location->setCity(randstr(10));
$location->setCounty(randstr(10));
$location->setPoint(randstr(50));
echo "to :<br/>".$location->toString()."<br/>";

$result = $locationStorage->update($location);
if ($result) {
	$location2 = $locationStorage->get($location->getLid());
	echo "Update location successfully:".$location2->toString()."<br/>";
} else {
	die("failed to update");
}

$delidx = rand(0,$size-1);
$location = $locationarr[$delidx];
echo "Delete location ".$location->toString()."<br/>";
$result = $locationStorage->remove($location->getLid());
if ($result) {
	echo "Delete location with lid:".$location->getLid()." sucessfully<br/>";
}
else {die ("fail to delete");}

?>
<div><a href="/index.php">返回</a></div>
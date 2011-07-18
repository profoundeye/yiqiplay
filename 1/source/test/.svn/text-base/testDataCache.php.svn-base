<?php
include_once("..\storage\dataCache.php");

$dataCache = new DataCache();
$obj = $dataCache->get("testkey");
if ($obj == null){
	echo "First time!<br/>";
} else {
	echo "Last value:".$obj."<br/>";
}

$objnew = randStr(9);
echo "To set a new value:".$objnew."<br/>";

$dataCache->set("testkey", $objnew, 600);

?>
<div><a href="/index.php">返回</a></div>
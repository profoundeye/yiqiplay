<?php
include_once("..\storage\messageStorage.php"); 
include_once("..\data\message.php"); 
include_once("..\common\common.php"); 

$message = new Message();
$message->setSnstype(0);
$snsmid = rand(0,99999999);
$message->setSnsmid("$snsmid");
$snsuid = rand(0,99999999);
$message->setSnsuid("$snsuid");
$message->setContent(randStr(20));
$uhomeid = rand(0,99999999);
$message->setUhomeid("$uhomeid");
$locid = rand(0,99999999);
$message->setLocid("$locid");

$messageStorage = new MessageStorage();
$id = $messageStorage->insert($message);
if ($id) echo "inserted message with id:".$id."<br/>";
else {die ("fail to insert");}

$message = $messageStorage->get($id);
echo "the message is:<br/>".$message->toString()."<br/>";

$msgArr = $messageStorage->getAll();
$size = sizeof($msgArr);
echo "total ".$size." messages in the database:<br/>";
foreach($msgArr as $message){
	echo $message->toString()."<br/>";
}

$upidx = rand(0,$size-1);
$message = $msgArr[$upidx];
$message->setSnstype(0);
$snsmid = rand(0,99999999);
$message->setSnsmid("$snsmid");
$snsuid = rand(0,99999999);
$message->setSnsuid("$snsuid");
$message->setContent(randStr(20));
$uhomeid = rand(0,99999999);
$message->setUhomeid("$uhomeid");
$locid = rand(0,99999999);
$message->setLocid("$locid");

echo "Update message ".$message->toString()."<br/>";
$result = $messageStorage->update($message);
if ($result) echo "Update message with id:".$message->getMid()."sucessfully<br/>";
else {die ("fail to update");}

$message = $messageStorage->get($message->getMid());
echo "The updated result:".$message->toString()."<br/>";


$delidx = rand(0,$size-1);
$message = $msgArr[$delidx];
echo "Delete message ".$message->toString()."<br/>";
$result = $messageStorage->remove($message->getMid());
if ($result) echo "Delete message with id:".$message->getMid()."sucessfully<br/>";
else {die ("fail to delete");}

?>
<div><a href="/index.php">返回</a></div>
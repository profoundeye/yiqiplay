<?php
include_once("..\storage\userStorage.php"); 
include_once("..\data\user.php"); 
include_once("..\common\common.php"); 

date_default_timezone_set("Asia/Shanghai");
$user = new User();
$user->setUsername(randStr(10));
$user->setPassword(randStr(12));
$user->setIsregister(rand(0,1));
$user->setGender(rand(0,1));
$user->setAge(rand(12,60));
$user->setBirthday(mktime(rand(0,23),rand(0,59),rand(0,59),
	rand(1,12),rand(0,28),rand(2010,2011)));
$user->setHomeid(rand(0,999999));
$user->setSnstype(rand(0,2));
$user->setSnsuid(randstr(10));

$userStorage = new UserStorage();
$uid = $userStorage->insert($user);

if ($uid) echo "insert".$user->toString().", successfully with id=".$uid."<br/>";
else echo die ("fail to insert");

$user = $userStorage->get($uid);
echo "the inserted user is ".$user->toString();

$userarr = $userStorage->getAll();
$size = sizeof($userarr);
echo "total ".$size." users in the database:<br/>";
foreach($userarr as $user){
	echo $user->toString()."<br/>";
}

$upidx = rand(0,$size-1);
$user = $userarr[$upidx];
echo "Update user:<br/>".$user->toString()."<br/>";
$user->setUsername(randStr(10));
$user->setPassword(randStr(12));
$user->setIsregister(rand(0,1));
$user->setGender(rand(0,1));
$user->setAge(rand(12,60));
$user->setBirthday(mktime(rand(0,23),rand(0,59),rand(0,59),
	rand(1,12),rand(0,28),rand(2010,2011)));
$user->setHomeid(rand(0,999999));
$user->setSnstype(rand(0,2));
$user->setSnsuid(randstr(10));
echo "to :<br/>".$user->toString()."<br/>";

$result = $userStorage->update($user);
if ($result) {
	$user2 = $userStorage->get($user->getUid());
	echo "Update user successfully:".$user2->toString()."<br/>";
} else {
	die("failed to update");
}

$delidx = rand(0,$size-1);
$user = $userarr[$delidx];
echo "Delete user ".$user->toString()."<br/>";
$result = $userStorage->remove($user->getUid());
if ($result) {
	echo "Delete user with uid:".$user->getUid()." sucessfully<br/>";
}
else {die ("fail to delete");}

?>
<div><a href="/index.php">返回</a></div>
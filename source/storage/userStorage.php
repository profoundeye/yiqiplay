<?php
include_once("..\storage\baseStorage.php"); 
include_once("..\data\user.php"); 
class UserStorage extends BaseStorage{

	function insert($user){
		$sql = "insert into user values(DEFAULT,'".$user->getUsername()."','"
			.$user->getPassword()."',".$user->getIsregister().",".$user->getGender().","
			.$user->getAge().",".$user->getBirthday().",".$user->getHomeid().",".
			$user->getSnstype().",'".$user->getSnsuid()."','')";
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$id = mysql_insert_id();
		$this->closeConn();
		if ($result) return $id;
		else return null;
	}
	
	function get($uid){
		$sql = "select * from user where uid=".$uid;
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		$user = null;
		if($ret = mysql_fetch_array($result)) {
			$user = $this->translate($ret);
		}
		return $user;
	}
	
	function getAll() {
		$sql = "select * from user";
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		$userArr = array();
		while($ret = mysql_fetch_array($result)) {
			array_push($userArr, $this->translate($ret));
		}
		return $userArr;
	}
	
	function update($user){
		$sql = "update user set username='".$user->getUsername()."', password='"
			.$user->getPassword()."', isregister=".$user->getIsregister().", gender="
			.$user->getGender().", age=".$user->getAge().", birthday=".$user->getBirthday()
			.", homeid=".$user->getHomeid().", snstype=".$user->getSnstype().", snsuid='"
			.$user->getSnsuid()."' where uid=".$user->getUid();
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		return $result;
	}
	
	function remove($uid){
		$sql = "delete from user where uid=".$uid;
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		return $result;
	}
	
	function translate($ret){
		$user = new User();
		$user->setUid($ret["uid"]);
		$user->setUsername($ret["username"]);
		$user->setPassword($ret["password"]);
		$user->setIsregister($ret["isregister"]);
		$user->setGender($ret["gender"]);
		$user->setAge($ret["age"]);
		$user->setBirthday($ret["birthday"]);
		$user->setHomeid($ret["homeid"]);
		$user->setSnstype($ret["snstype"]);
		$user->setSnsuid($ret["snsuid"]);
		return $user;
	}
}
?>
<?php
include_once("..\storage\baseStorage.php"); 
include_once("..\data\user.php"); 
include_once("..\storage\dataCache.php"); 
class UserStorage extends BaseStorage{

	function insert($user){
		$sql = "insert into user values(DEFAULT,'".$user->getUsername()."','"
			.$user->getPassword()."',".$user->getIsregister().",".$user->getGender().","
			.$user->getAge().",".$user->getBirthday().",".$user->getHomeid().","
			.$user->getSnstype().",'".$user->getSnsuid()."','')";
		$conn = $this->getConn();
		$result = mysql_query($sql, $conn);
		$id = mysql_insert_id();
		$this->closeConn();
		if ($result) {
			$keystr = md5("user".$user->getSnstype().$user->getSnsuid());
			$cache = new DataCache();
			$user->setUid($id);
			$cache->set($keystr, $user, 0);
			return $id;
		}
		else return null;
	}
	
	function get($uid){
		$sql = "select * from user where uid=".$uid;
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
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
			$user = $this->translate($ret);
			array_push($userArr, $user);
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
		
		if ($result != null) {
			$cache = new DataCache();
			$keystr = md5("user".$user->getSnstype().$user->getSnsuid());
			$cache->set($keystr, $user, 0);
		}
		return $result;
	}
	
	function remove($uid){
		$sql = "delete from user where uid=".$uid;
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		
		$cache = new DataCache();
		$keystr = md5("user".$user->getSnstype().$user->getSnsuid());
		$cache->delete($keystr);
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
	
	/**
	 * find a user given snstype and snsuid
	 */
	function findSnsUser($snstype, $snsuid){
		$keystr = md5("user".$snstype.$snsuid);
		$cache = new DataCache();
		$user = $cache->get($keystr);
		if ($user != null){
			return $user;
		}
		
		$sql = "select * from user where snstype=".$snstype.", snsuid='"
			.$snsuid."'";
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		if($ret = mysql_fetch_array($result)) {
			$user = $this->translate($ret);
			$cache->set($keystr, $user, 0);
		}
		return $user;
	}
}
?>
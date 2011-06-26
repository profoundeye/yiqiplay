<?php
include_once("..\storage\baseStorage.php"); 
include_once("..\storage\dataCache.php"); 
include_once("..\data\location.php"); 
class LocationStorage extends BaseStorage{
	
	function insert($location){
		$sql = "insert into location values(DEFAULT, '".
			$location->getProvince()."' , '".$location->getCity()
			."' , '".$location->getCounty()."' , '".$location->getPoint()."' , '')";
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$id = mysql_insert_id();
		$this->closeConn();
		if ($result) {
			$keystr = md5("location".$id);
			$cache = new DataCache();
			$location->setLid($id);
			$cache->set($keystr, $location, 0);
			return $id;
		}
		return $result;
	}

	function get($lid){
		$keystr = md5("location".$lid);
		$cache = new DataCache();
		$location = $cache->get($keystr);
		if ($location != null) {
			return $location;
		}
		$sql = "select * from location where lid=".$lid;
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		if($ret = mysql_fetch_array($result)) {
			$location = $this->translate($ret);
			$cache->set($keystr, $location, 0);
		}
		return $location;
	}
	
	function getAll(){
		$sql = "select * from location";
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		$locationArr = array();
		while($ret = mysql_fetch_array($result)) {
			$location = $this->translate($ret);
			$keystr = md5("location".$location->getLid());
			array_push($locationArr, $location);
			$cache = new DataCache();
			$cache->set($keystr, $location, 0);
		}
		return $locationArr;
	}
	
	function update($location){
		$sql = "update location set province='".$location->getProvince().
			"', city='".$location->getCity()."', county='".$location->getCounty()
			."', point='".$location->getPoint()."' where lid=".$location->getLid();
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		
		if ($result != null) {
			$cache = new DataCache();
			$keystr = md5("location".$location->getLid());
			$cache->set($keystr, $location, 0);
		}
		return $result;
	}
	
	function remove($lid){
		$sql = "delete from location where lid=".$lid;
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		
		$cache = new DataCache();
		$keystr = md5("location".$lid);
		$cache->delete($keystr);
		return $result;
	}
	
	function translate($ret){
		$location = new Location();
		$location->setLid($ret["lid"]);
		$location->setProvince($ret["province"]);
		$location->setCity($ret["city"]);
		$location->setCounty($ret["county"]);
		$location->setPoint($ret["point"]);
		return $location;
	}
}
?>